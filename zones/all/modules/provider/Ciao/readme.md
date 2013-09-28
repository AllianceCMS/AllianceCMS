**Here's a quick explanation of how this module was created. I'll go into more detail the closer we get to a full alpha release:**

* First we need to create the routes for the module (what url the pages point to, and which controller/action handles creating the page)
    * There are three pages/routes
        * '/hello/later/{:name*}': If you go to yourdomain.com/hello/hey/John then the controller (class SayStuff) will call the action (class method) sayHi
        * '/hello/later/{:name*}': If you go to yourdomain.com/hello/hey/John then the controller (class SayStuff) will call the action (class method) sayBye
        * '/hello/{:name*}': Because you told the router that this route is the type 'admin' route, when you go to yourdomain.com/admin/hello/Bob then the controller (class SayStuff) will call the action (class method) yoAdmin
* Next we need to create the Controller and Actions (class and class methods)
* Then we create any Views that the actions use in their Templates
* We have to make sure that we create an entry in the 'modules' database table, and that the module is active (active = 2) so the router will map routes correctly
    * The 'ModuleManager' module will take care of this once we've completed it, but for now you will need to manually enter this data into your database (using a MySql client or PHPMyAdmin)
* (Note: We need to make sure the module is PSR-0 compliant so that the internal class autoloader works correctly = Very Important)
