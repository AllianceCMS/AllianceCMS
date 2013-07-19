<?php

// Check if current venue's active theme is active
// Get current venue's active theme info (folder_path, ???folder_name???)
// Load theme templates
// Load axis templates (html helper, form helper, media/css/js helper)
// ???Load custom templates???
// Create

//*
use Acms\Core\Templates\Menus;
use Acms\Core\Templates\Template;
//*/

/*
echo '<br />Begin Testing Acms.Core.Template<br />';
echo '<br />';
//*/

$select = $connection->newSelect();
$select->cols(['name, folder_path, folder_name, author, author_email, author_site'])
    ->from('a_themes')
    ->where('id = :id');
$bind = ['id' => intval(VENUE_THEME)];
$fields = $connection->fetchOne($select, $bind);
$theme_path = $fields['folder_path'] . $fields['folder_name'];

include TEMPLATES . 'nav.php';

/*
$setupMenu = new Menus("1");
$menu1 = $setupMenu->getMenus();

$setupMenu = new Menus("2");
$menu2 = $setupMenu->getMenus();

$setupMenu = new Menus("3");
$menu3 = $setupMenu->getMenus();

$setupMenu = new Menus("4");
$menu4 = $setupMenu->getMenus();

$setupMenu = new Menus("5");
$menu5 = $setupMenu->getMenus();
//*/

$tpl = new Template();
$tpl->set('base_url', BASE_URL);
$tpl->set('theme_folder', BASE_URL . $theme_path);
//$tpl->set("themeImages", THEMES.THEME_FOLDER_NAME."images");
$tpl->set("venue_title", VENUE_TITLE);
//$tpl->set("venue_author", SITE_ADMIN_NAME);
$tpl->set("venue_description", VENUE_DESCRIPTION);
$tpl->set("venue_tagline", VENUE_TAGLINE);
//$tpl->set("venue_styleSheet", THEMES.THEME_FOLDER_NAME."style.css");

$tpl->set("nav1", $nav1);
/*
$tpl->set("menu1", $menu1);
$tpl->set("menu2", $menu2);
$tpl->set("menu3", $menu3);
$tpl->set("menu4", $menu4);
$tpl->set("menu5", $menu5);
//*/

/*
echo '<br />';
echo '<br />End Testing Acms.Core.Template<br />';
//*/


/*
echo '<br />Begin Testing Twig<br />';
echo '<br />';
//*/

/*
$select = $connection->newSelect();
$select->cols(['name, folder_path, folder_name, author, author_email, author_site'])
->from('a_themes')
->where('id = :id');
$bind = ['id' => intval(VENUE_THEME)];
$fields = $connection->fetchOne($select, $bind);
//*/

/*
echo '<br />$fields = ';
echo print_r($fields);
echo '<br />';

echo '$fields["name"] = ' . $fields['name'];
exit;
//*/

/*
$theme_path = $fields['folder_path'] . $fields['folder_name'];

$loader = new Twig_Loader_Filesystem($theme_path);
$twig = new Twig_Environment($loader, array(
    //'cache' => '/path/to/compilation_cache',
));

$template_vars['base_url'] = BASE_URL;

$template_vars['theme_folder'] = BASE_URL . $theme_path;

$template_vars['main_venue_name'] = MAIN_VENUE_NAME;
$template_vars['main_venue_title'] = MAIN_VENUE_TITLE;
$template_vars['main_venue_tagline'] = MAIN_VENUE_TAGLINE;
$template_vars['main_venue_description'] = MAIN_VENUE_DESCRIPTION;
$template_vars['main_venue_theme'] = MAIN_VENUE_THEME;
$template_vars['main_venue_admin_id'] = MAIN_VENUE_ADMIN_ID;

echo $twig->render('theme.tpl.php', $template_vars);
//*/

/*
echo $twig->render('theme.tpl.php', array(
    'theme_folder' => BASE_URL . $theme_path,

    'base_url' => BASE_URL,

    'main_venue_name' => MAIN_VENUE_NAME,
    'main_venue_title' => MAIN_VENUE_TITLE,
    'main_venue_tagline' => MAIN_VENUE_TAGLINE,
    'main_venue_description' => MAIN_VENUE_DESCRIPTION,
    'main_venue_theme' => MAIN_VENUE_THEME,
    'main_venue_admin_id' => MAIN_VENUE_ADMIN_ID,

    'body' => 'Main Content',
));
//*/

/*
echo '<br />';
echo '<br />End Testing Twig<br />';
//*/

/*
echo '<br />Begin Testing Acms.Core.Template<br />';
echo '<br />';

$tpl = new Acms\Core\Template();



echo $tpl->fetch(THEMES. 'core/ZensWay/theme.tpl.php');

echo '<br />';
echo '<br />End Testing Acms.Core.Template<br />';
//*/

/*
echo '<br />Begin Testing Aura.View<br />';
echo '<br />';

use Aura\View\Template;
use Aura\View\EscaperFactory;
use Aura\View\TemplateFinder;
use Aura\View\HelperLocator;

$template = new Template(
    new EscaperFactory,
    new TemplateFinder,
    new HelperLocator
);


// business logic
$template->addData([
    'theme_folder' => 'themes/core/zerofour/',
    ]);

echo $template->fetch(THEMES. 'core/zerofour/theme.tpl.php');

echo '<br />';
echo '<br />End Testing Aura.View<br />';
//*/
