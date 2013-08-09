**(Last updated for pre-alpha installation: 07-29-13)**

In this tutorial we'll create a simple 'Hello World!' plugin. We'll show you the absolute minimum code needed to display text inside of your theme's output.

##Plugin Structure

All plugins need to be [PSR-0](http://www.php-fig.org/psr/0/) compliant. We suggest that you take a look at the documentation, but for the time being we'll give you enough info to follow along with this tutorial.

* Your plugin folder and class file name should be in 'StudlyCaps' (i.e. Blog, CronJobs, ReallyCoolPlugin)
* Your namespace should be the name of your plugin folder (if your class is in the root of your plugin folder, which is the case in this tutorial)
* The name of your class should be the same name as the file that the class is in (SaySomething.php ==> class SaySomething)

##Plugin Folder

Since we're keeping this nice and simple we're not going to explain advanced plugin installation right now. 

Let's name our plugin HelloWorld.

* Create a folder named 'HelloWorld' in the '/zones/all/plugins/custom/' folder (this is a custom plugin after all). The folder path should now be '/zones/all/plugins/custom/HelloWorld'

##Routes

The URLs in AllianceCMS are completely independent of your website folder structure.

This means that if you navigate to 'www.mysite.com/VenueName/hello' (replace 'VenueName' with your venue name), you're not actually in the 'hello' folder.

Our plugin will define what the URL routes are going to be. This will allow us to move a plugin to another directory and still have the same URL. It will also help strengthen your website's security, plus it's a great way to create SEO friendly URLs!

* Create a file named 'routes.php' inside of the 'HelloWorld' plugin folder
* Open 'routes.php' and enter the following code:

        $pluginRoutes['HelloWorld']['Say Hello'] = [
            'name' => 'say_hi', // Required: Route name
            'path' => '/hello', // Required: Route path
            'type' => 'front', // Required: front, admin
            'specs' => [
                'values' => [
                    'namespace' => 'HelloWorld', // Required
                    'controller' => 'SaySomething', // Required
                    'action' => 'sayHi', // Required
                ]
            ]
        ];
    
This is a single route entry that says, "When a web client navigates to 'www.mysite.com/VenueName/hello', load the controller 'SaySomething' and then call the action 'sayHi'.

Let's go over this one line at a time:

1. Every plugin will contain a $pluginRoutes array. The first array key needs to be unique for each plugin, so we will use the plugin name. The second array key needs to be unique to all pages we create a route for, so we will name it based on what this page will do.
2. This is the name of the route, and needs to be unique for each route in your plugin.
3. This is the actual route path. When a web client navigates to this path, Axis will load the controller and action defined below. You do not need to worry about which venue is loaded; Axis will take care of this for you.
4. Is this page going to be displayed on the front-end, or is this an admin page?
5. Let's define some specs for the route.
6. We are going to add some values to the route. Axis uses some of these values to load the appropriate controller->action (namespace, controller, action). These will also be available in your action. You can also use route values as default values in advanced routes, but that is a topic for another tutorial.
7. This is the namespace of your controller. Including this allows Axis to autoload all classes in this namespace.
8. This is the name of the controller you want to load when the URL matches this route.
9. This is the name of the action you want to call when the URL matches this route.

There are many more specs that can be used, but we'll save that topic for a more advanced tutorial.

##Controllers and Actions

Let's keep this simple:
* A controller is a class
* An action is a class method

In our route we defined that our controller is named 'SaySomething', and our action is named 'sayHi'.

* Create a file named 'SaySomething.php' inside the root of the 'HelloWorld' plugin folder and add this code:

        namespace HelloWorld;

        class SaySomething{

            public function sayHi($values)
            {
                echo "Hello World!";
            }
        }

We need to keep the plugin PSR compliant, so this is what we did:

* We created a class file named 'SaySomething.php', because the class inside is named 'SaySomething'
* The namespace 'HelloWorld' is the same name as the plugin folder because our controller is located in the root of our plugin folder
* Our controller is named 'SaySomething', 
* The action is named 'sayHi', just as we defined in our route. The action will contain any logic we want executed when the user goes to the route '/hello'. Notice that the parameter for out action is '$values'. This will allows us to access route values (defined in the 'spec' array key of $pluginRoutes in routes.php). We'll cover that in a more advanced tutorial.

We have one more step to make before our route will map correctly.

* We need to add our plugin to the 'plugins' database table and make sure it's active.

##Manually Installing the Plugin
**(This will not be necessary once the Axis 'PluginManager' plugin is complete)**

Until the PluginManager plugin is complete you will need to use your favorite database client (phpmyadmin is available on most web hosting servers) to manually add your plugin to the 'plugins' database table and make sure that it's active.

Here are the required fields and the values you should use:

* name = Hello World
* folder_path = zones/all/plugins/custom/
* folder_name = HelloWorld
* active = 2

##Load the Page

* Open your browser and go to the route you have created: mysite.com/VenueName/hello

We know what you are thinking: "Wait a minute, where is the output from my action?"

It's hard to see, but it's there, up on the top left of the screen. It's small, and it's outside of the theme because we just used an echo statement to print output. This is ok for testing purposes, but we want our output to be impressive, and to display in the main content section of our theme.

You will needed to use the Template object and a view template in order for your output to be displayed inside the site's theme.

##MVC

If you've never heard of MVC before (Model, View, Controller), here's a quick break down:

MVC is known as a design pattern. There are a lot of common situations, or problems, that a developer might come across. They are so common that some really intelligent people came up with what are know as design patterns, which is a fancy way of saying 'a solution, or way, to structure your code when you run into a particular situation, or problem'.

MVC is one of those design patterns. MVC is great for the web, and fits nicely with web standards, because it helps you separate your code into segments, or systems, depending on what your code does, or is responsible for.

* Model: The Model handles all things data related, and should be used to represent and pull data from a data source.
* View: The View is the visual look of the system. The view should only focus on how data is presented, not actually created and processed. That's the Controller's job. The only type of logic that should be contained in a View would be looping through arrays (maybe to build a site links navigation bar), or very simple conditional logic. You should do as much processing of data as you can in the Controller, then send the results to your View.
* Controller: The Controller is the brains of the system. The Controller is usually the middle man between the Model and the View. The Controller will pull data from the Model, then use some form of logic to process the data, then it will send any information you may want to display to the View.

In AllianceCMS, your controller/action can pull data using the Db class (we will leave that for a more advanced tutorial). Your controller/action will then process any information it needs to, then the controller will use the Template class to send data to your view, which will be returned to Axis and included when the active theme.tpl.php is rendered.

Some of this happens in the background, but we find it helpful to know what is going on in the background, rather than just having a recipe thrown at us!

##Templates

Now we are going to instantiate a Template object and assign data to a view template

* If you've closed it, open up 'SaySomething.php'
* Change the 'SaySomething' controller so looks like this:

        namespace HelloWorld;

        use Acms\Core\Templates\Template;

        class SaySomething
        {
            public function sayHi($values)
            {
                $content = new Template(dirname(__FILE__) . DS . 'views/greetings.tpl.php');
                $content->set('name', 'World');

                return $content;
            }
        }

* We've added the 'use' statement so we can use the Template class
* When we instantiate the Template object we are going to tell it which view template we want to load
* The Template object is named $content
* We send data to the view template using $content->set('varName', 'varValue'). Notice that we are sending the variable 'name' with the value 'World'. Now your view template will have access to the variable $name, and it's value will be 'World'.
* Then we need to return $content to Axis so it can be rendered in your website's active theme.

Let's create the view template now:

* Create a folder named 'views' (inside the root of your plugin)
* Inside the 'views' folder we want to create the file 'greetings.tpl.php'.
* Open 'greetings.tpl.php' and add this code: 

        <h1>Hello <?php echo $name; ?>, it's so good to see you!</h1>

        <p>Welcome to the Hello plugin, where we show you how to properly create a quality plugin!</p>

Notice that we now have access the the $name variable.

All templates contain valid (X)HTML(5), where we use PHP variables that are sent from our action. Then we use as little logic as possible to display dynamic content (we use as much logic as possible in the action as we can in order to minimize logic in the view template).

You will be using the short form of control structures quite a bit, so you might want to read up on their proper syntax: [Alternative syntax for control structures](http://php.net/manual/en/control-structures.alternative-syntax.php)

##Load the Page Again

* Open your browser and navigate to the route you created: mysite.com/VenueName/hello

**That's what I'm talkin' 'bout!!!**

##Conclusion

You've just finished creating your first AllianceCMS plugin! This is your first step in a very exciting journey, and we're happy we could help you through it!

Now we have a suggestion for you: Take a few minutes and create another route/controller/action/view that says something else, maybe something along the lines of "AllianceCMS Rocks!!!" :-)

**NOTES:**

As AllianceCMS is still in pre-alpha, this tutorial is likely to change as we make AllianceCMS even better, so check back often!

If you notice anything that doesn't work, or have any suggestions to make this tutorial better, please contact us at [contribute@alliancecms.com](mailto:contribute@alliancecms.com).