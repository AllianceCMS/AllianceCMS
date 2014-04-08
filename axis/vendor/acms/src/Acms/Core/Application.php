<?php
namespace Acms\Core;

use Acms\Core\HttpKernel;
use Acms\Core\Entities\CurrentUser;
use Acms\Core\Data\Db;
use Acms\Core\ModuleLoader\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Application extends \Pimple implements HttpKernelInterface, TerminableInterface
{
    private $booted = false;
    private $route_collection;

    /**
     * Instantiate a new Application.
     *
     * Objects and parameters can be passed as argument to the constructor.
     *
     * @param array $values The parameters or objects.
     */
    public function __construct(array $values = array())
    {
        // Setup system paths
        if (isset($values['paths'])) {
            // Add systemPaths to request
            $values['paths'] = $this->buildPaths($values['paths']);
        }

        parent::__construct($values);

        $this->buildServiceContainers();

        /*
        // @reminder: Taken from Sillex, may need in the future
        foreach ($values as $key => $value) {
            $this[$key] = $value;
        }
        //*/
    }

    protected function buildServiceContainers()
    {
        /**
         * Service Containers
         */

        $this['logger'] = null;

        $this['class_loader_class'] = 'Symfony\\Component\\ClassLoader\\ClassLoader';
        $this['class_loader'] = function ($c) {
            return new $c['class_loader_class']();
        };

        $this['resolver'] = function ($c) {
            return new ControllerResolver($c, $c['logger']);
        };

        $this['kernel'] = function ($c) {
            return new HttpKernel($c['dispatcher'], $c['resolver'], $c['request_stack']);
        };


        $this['request'] = function () {
            return Request::createFromGlobals();;
        };

        $this['request_stack'] = function () {
            if (class_exists('Symfony\Component\HttpFoundation\RequestStack')) {
                return new RequestStack();
            }

            return null;
        };

        $this['request_context'] = function ($c) {
            $context = new RequestContext();

            $context->setHttpPort($c['request.http_port']);
            $context->setHttpsPort($c['request.https_port']);

            return $context;
        };

        $this['url_matcher'] = function ($c) {
            return new UrlMatcher($c->route_collection, $c['request_context']);
        };

        $this['url_generator'] = function ($c) {
            return new UrlGenerator($c['routes'], $c['request_context']);
        };

        $this['model'] = function ($c) {
            return new Db($c);
        };

        $this['session'] = function () {
            return include $this['paths']->get('dir.vendor') . '/aura/session/scripts/instance.php';
        };

        $this['current_user'] = function ($c) {
            return new CurrentUser($c);
        };

        /*
        // @reminder: Custom stuff from Silex
        $this['url_matcher'] = $this->share(function ($c) {
            return new RedirectableUrlMatcher($c['routes'], $c['request_context']);
        });

        $this['controllers'] = $this->share(function ($c) {
            return $c['controllers_factory'];
        });

        $this['controllers_factory'] = function ($c) {
            return new ControllerCollection($c['route_factory']);
        };

        $this['route_class'] = 'Silex\\Route';
        $this['route_factory'] = function ($c) {
            return new $c['route_class']();
        };

        $this['exception_handler'] = $this->share(function ($c {
            return new ExceptionHandler($c['debug']);
        });
        //*/

        /**
         * Event Dispatcher
         */

        $this['dispatcher_class'] = 'Symfony\\Component\\EventDispatcher\\EventDispatcher';
        $this['dispatcher'] = function ($c) {
            $dispatcher = new $c['dispatcher_class']();

            $dispatcher->addSubscriber(new RouterListener($c['url_matcher'], $c['request_context'], $c['logger'], $c['request_stack']));
            $dispatcher->addSubscriber(new ResponseListener($c['charset']));

            if (isset($c['exception_handler'])) {
                $dispatcher->addSubscriber($c['exception_handler']);
            }

            /*
            // @reminder: Custom stuff from Silex
            $urlMatcher = new LazyUrlMatcher(function ($c) {
                 return $c['url_matcher'];
             });

            $dispatcher->addSubscriber(new RouterListener($urlMatcher, $c['request_context'], $c['logger'], $c['request_stack']));

            $dispatcher->addSubscriber(new StringToResponseListener());
            $dispatcher->addSubscriber(new LocaleListener($c, $urlMatcher, $c['request_stack']));
            $dispatcher->addSubscriber(new MiddlewareListener($c));
            $dispatcher->addSubscriber(new ConverterListener($c['routes']));
            //*/

            return $dispatcher;
        };

        /**
         * Parameters
         */
        $this['request_error'] = $this->protect(function () {
            throw new \RuntimeException('Accessed request service outside of request scope. Try moving that call to a before handler or controller.');
        });

        $this['request'] = $this['request_error'];

        $this['request.http_port'] = 80;
        $this['request.https_port'] = 443;
        $this['debug'] = false;
        $this['charset'] = 'UTF-8';
        $this['locale'] = 'en';
    }

    /**
     * Handles the request and delivers the response.
     *
     * @param Request|null $request Request to process
     */
    public function run(Request $request = null)
    {
        if (null === $request) {
            $request = Request::createFromGlobals();
        }

        $response = $this->handle($request);
        $response->send();
        $this->terminate($request, $response);
    }

    /**
     * {@inheritdoc}
     *
     * If you call this method directly instead of run(), you must call the
     * terminate() method yourself if you want the finish filters to be run.
     */
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        if (!$this->booted) {
            $this->boot();
        }

        $current = HttpKernelInterface::SUB_REQUEST === $type ? $this['request'] : $this['request_error'];

        $this['request'] = $request;

        $this->flush();

        $response = $this['kernel']->handle($request, $type, $catch);

        $this['request'] = $current;

        return $response;
    }

    public function boot()
    {
        // Does 'zones/{zone.folder}/dbConnection.php' exist?
        if (!file_exists($this['paths']->get('file.db_connection'))) {

            // dbConnection.php doesn't exist. Send user to the Site Installation process.
            $this->installSite();

        } else {

            $this->buildRoutes(); // Shoud be in RequestListener
            $this->addKernelListeners();

        }

        $this->booted = true;
    }

    /**
     * Flushes the controller collection.
     *
     * @param string $prefix The route prefix
     */
    public function flush($prefix = '')
    {
        //$this['routes']->addCollection($this['controllers']->flush($prefix));
    }

    public function terminate(Request $request, Response $response)
    {
        $this['kernel']->terminate($request, $response);
    }

    protected function buildPaths($paths = array())
    {
        $acmsBaseDir = $paths['dir.base'];
        $acmsBaseUrl = $this->getBaseUrl();
        $activeZone = $this->getActiveZone($paths['dir.base']);

        return new \Acms\Core\System\PathBag([
            'dir.base' => $acmsBaseDir,
            'dir.axis' => $acmsBaseDir . '/axis',
            'dir.public_html' => $acmsBaseDir . '/public_html' . $paths['folder.subdomain'],
            'dir.zones' => $acmsBaseDir . '/zones',
            'dir.storage' => $acmsBaseDir . '/axis/storage',
            'dir.configs' => $acmsBaseDir . '/axis/configs',
            'dir.includes' => $acmsBaseDir . '/axis/includes',
            'dir.tests' => $acmsBaseDir . '/axis/tests',
            'dir.vendor' => $acmsBaseDir . '/axis/vendor',
            'dir.axis_modules' => $acmsBaseDir . '/axis/modules',
            'dir.zones_modules' => $activeZone . '/modules',
            'dir.www_resources' => $acmsBaseDir . '/public_html/resources',
            'dir.themes' => $acmsBaseDir . '/public_html/themes',
            'dir.templates' => $acmsBaseDir . '/public_html/templates',
            'file.db_connection' => $activeZone . '/dbConnection.php',
            'folder.subDomainFolder' => $paths['folder.subdomain'],
            'url.base' => $acmsBaseUrl,
            'url.resources' => $acmsBaseUrl . '/resources',
        ]);
    }

    /**
     * Get base url, i.e. http://www.mysite.com
     */
    protected function getBaseUrl()
    {
        if (isset($_SERVER['HTTPS'])) {
            return $acmsBaseUrl = 'https://' . $_SERVER['SERVER_NAME'];
        } else {
            return $acmsBaseUrl = 'http://' . $_SERVER['SERVER_NAME'];
        }
    }

    /**
     * Locate/define active zone folder
     */
    protected function getActiveZone($acmsBaseDir)
    {
        $zonesDir = $acmsBaseDir . '/zones';
        $serverPathArray = explode('.', $_SERVER['SERVER_NAME']);

        // If this is localhost or main domain (localhost or mysite.com or www.mysite.com)
        if (((count($serverPathArray)) < 3) || ($serverPathArray[0] == 'www')) {

            $serverName = $_SERVER['SERVER_NAME'];

            if ($serverPathArray[0] == 'www')
                $serverName = substr((string) $serverName, 4);

            if (file_exists($zonesDir . '/' . $serverName)) {
                return $activeZone = $zonesDir . '/' . $serverName;
            } else {
                return $activeZone = $zonesDir . '/default';
            }
        } else {
            // This is a subdomain, do not use '/default/dbConnection.php'
            return $activeZone = $zonesDir . '/' . $_SERVER['SERVER_NAME'];
        }
    }

    protected function installSite()
    {
        $classLoader = $this['class_loader'];
        $classLoader->addPrefix('Install', $this['paths']->get('dir.axis_modules'));
        $classLoader->register();

        // look inside *this* directory
        $locator = new \Symfony\Component\Config\FileLocator(array($this['paths']->get('dir.axis_modules') . '/Install'));
        $loader = new \Symfony\Component\Routing\Loader\PhpFileLoader($locator);
        $this->route_collection = $loader->load('routes.php');

        $this['url_matcher'] = function ($c) {
            return new UrlMatcher($c->route_collection, $c['request_context']);
        };
    }

    protected function buildRoutes()
    {
        $modules = $this->getActiveModules();
        $this->autoloadModules($modules);
        $this->buildModuleRoutes($modules);
    }
    protected function getActiveModules()
    {
        $sql = $this['model'];

        // Include only installed modules 'routes.php' so we have access to routes
        $sql->dbSelect('modules', 'folder_path, folder_name', 'active = :active', ['active' => intval(2)]);

        $result = $sql->dbFetch();

        foreach ($result as $row => $val) {
            $modules[$val['folder_name']] = $this['paths']->get('dir.base') . '/' . $val['folder_path'] . $val['folder_name'];
        }

        return $modules;
    }

    protected function autoloadModules($modules)
    {
        $classLoader = $this['class_loader'];

        foreach ($modules as $row => $val) {

            $classLoader->addPrefix($row, $this['paths']->get('dir.axis_modules'));

        }

        $classLoader->register();

        return true;
    }

    protected function buildModuleRoutes($modules)
    {
        $this->route_collection = new RouteCollection();

        foreach ($modules as $row => $val) {

            // look inside *this* directory
            $locator = new \Symfony\Component\Config\FileLocator(array($this['paths']->get('dir.axis_modules') . '/' . $row));
            $loader = new \Symfony\Component\Routing\Loader\PhpFileLoader($locator);
            $this->route_collection->addCollection($loader->load('routes.php'));

        }
    }

    protected function addKernelListeners()
    {
        $this['listener.system_request'] = function ($c) {
            return new \Acms\Core\EventDispatcher\EventListener\RequestListener($c);
        };

        $this['listener.system_controller'] = function ($c) {
            return new \Acms\Core\EventDispatcher\EventListener\ControllerListener($c);
        };

        $this['listener.system_view'] = function ($c) {
            return new \Acms\Core\EventDispatcher\EventListener\ViewListener($c);
        };

        $this['listener.system_response'] = function ($c) {
            return new \Acms\Core\EventDispatcher\EventListener\ResponseListener($c);
        };

        $this['listener.system_finish_request'] = function ($c) {
            return new \Acms\Core\EventDispatcher\EventListener\FinishRequestListener($c);
        };

        $this['listener.system_terminate'] = function ($c) {
            return new \Acms\Core\EventDispatcher\EventListener\TerminateListener($c);
        };

        $this->extend('dispatcher', function($dispatcher, $c) {
            $dispatcher->addSubscriber($c['listener.system_request']);
            $dispatcher->addSubscriber($c['listener.system_controller']);
            $dispatcher->addSubscriber($c['listener.system_view']);
            $dispatcher->addSubscriber($c['listener.system_response']);
            $dispatcher->addSubscriber($c['listener.system_finish_request']);
            $dispatcher->addSubscriber($c['listener.system_terminate']);

            return $dispatcher;
        });
    }

    protected function loadUser()
    {
        // Start session
        $session = $this['session'];
        $session->start();
        $segmentUser = $session->newSegment('User');
        $session->commit();

        $currentUser = $this['current_user'];


        exit;
        return true;
    }
}