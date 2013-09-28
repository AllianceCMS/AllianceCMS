#AllianceCMS: Not Your Typical CMS

##Overview

**We've realized that we haven't been too clear about what AllianceCMS is and what niche AllianceCMS caters to.**

The intent of this article is to let you know why we are creating AllianceCMS, what our intent is behind the decisions we make, how it's designed to be used, to explain the problems we saw in other CMS's, and what solution AllianceCMS offers.

We are going to do this in bullet list format while adding explanations where we feel we need to.

If you have any questions, please contact us at: [support@alliancecms.com](mailto:support@alliancecms.com)

**Terms Used**

* AllianceCMS specific terminology: [AllianceCMS Terminology](https://github.com/AllianceCMS/AllianceCMS/wiki/AllianceCMS-Terminology)
* CMS:  [Content Management System](http://en.wikipedia.org/wiki/Content_management_system)
* GUI: [Graphical User Interface](http://en.wikipedia.org/wiki/Graphical_user_interface)
* Entity: (person, company, brand, organization, interest group, etc...)  

**There are three ways most people communicate on the Internet**

* One-To-One
    * Examples:
        * Instant Messaging
        * Emails
* One-To-Many
    * Examples:
        * Blog Posts
        * News Letters
        * Tweets
* Many-To-Many
    * Examples:
        * Forums
        * Chat Rooms/IRC
        * Facebook

##What a Typical CMS is:

* No need for complex technical knowledge
    * Upload and install using a GUI (Graphical User Interface)
* Simple interface for complex operations
    * Easily create content using a GUI
    * Laying out content using a GUI
    * Configuring settings and permissions using a GUI
    * Upload and install Modules/Themes using a GUI

##What a Typical CMS Offers:

* Provides entities an outlet to share interests with other entities
* Provides entities a creative outlet to express ideas or display products of their creativity
* Provides a way to inform interested parties of an entities activities
* Provides a single location for current/potential customer interaction
* (Fill in the blank)

##The Audience a Typical CMS Targets:

* One-To-Many interaction
    * One entity trying to reach out to its community

##What AllianceCMS is:

* Most of the above
* Our main goal is to help entities build and participate in communities
* Entities can create communities within communities by use of AllianceCMS's Venue system (See [AllianceCMS Terminology](https://github.com/AllianceCMS/AllianceCMS/wiki/AllianceCMS-Terminology))
* We focus on ease of use and simple interfaces without skimping out on verbose, powerful and secure subsystems
* AllianceCMS has a modular design, allowing you to take what you want, build what you need, and leave the rest
* Many-To-Many interaction
    * Many entities communicating with many entities
    
##The Audience AllianceCMS Targets:

* Community Builders
* Entities that want to expand and strengthen their existing community
* Entities that want tools that are designed from conception specifically to maintain and expand existing communities
* Entities that want to give their community members the power to strengthen the community with their contributions
    
##Typical Problems AllianceCMS Helps Solve: Use Cases

There's been an informative bullet list so far, but lets break out of that format for a moment and show you a few 'Use Case' studies that should paint a clear picture of how we intend AllianceCMS to be used.

**Case 1:**

* A Real Estate Broker can install AllianceCMS. The main/landing pages will focus on the agency as a whole. But the Broker's Agents can create Venues, which are specific to that Agent. The Agent will be able to provide contact info, enable modules that will list the MLS listings they manage personally, and much more.

**Case 2:**

* A book club wants to create a web presence. The main/landing pages can represent the club, ongoing events and schedule meetings. But individuals, or the club itself, can create Venues for specific books. Those Venues can use modules to hold discussions regarding the book. Members can supply links or info that's pertinent to the specific title, list author signings, and much more.

**Case 3:**

* A national restaurant chain can install AllianceCMS. It would use the main/landing pages for information/deals nation wide. But then individual locations can have/create a Venue that has information that is specific to their location, like contact info, special deals or events that are specific to their location, and much more.

**Case 4:**

* [AllianceCMS.com](http://www.alliancecms.com) is going to allow Module and Theme developers to create their own Venue to host their creations, offer support, and keep the community informed of their work. We have also been throwing around the idea of allowing multiple Venue 'Types'. This will allow members of the site to create 'Topic/Special Interest' Venues along with Module/Theme Venues. Maybe a group of developers would like to collaborate and make the next killer Forum System. And maybe another group of members want to start a Venue that focuses on mentoring new members of the community.  

As you can see, the main focus is on building and expanding communities. But now you can also see that there are limitless possibilities as to why or how you can use AllianceCMS!

**That's Not All Folks**

Now that sounds great, but how you administrate the system is great too.

First, a user registers for the site. They can then create a Venue (if the main site admin allows it). A registered member can also request to be a member of a Venue (if the Venue admin allows it).

Main site admins can install modules, create links and permissions, and then allow Venues/Venue admins to have access to those modules, links and permissions.

The Venue admin can then have full control as to which modules, links and permissions they would like to use, and they can even choose where module blocks are displayed (left side, right side, footer, etc...). As of right now the main content of a module is displayed in the center of the site.

So there is major flexibility for both Main Site Admins and Venue Admins. AllianceCMS is also designed so that the entire site can be the community, or the main site is the glue that ties together many communities, made up of Venue creators/admins and Venue members.

As you can see, AllianceCMS is not a typical CMS. It's focus is on certain types of sites, not the typical blog/forum, One-To-Many sites most CMS's focus on.

We feel the existing landscape has a great selection of One-To-Many website creation tools and CMS's. We have a few use cases like the ones we mentioned above in the works, but the existing solutions are a One-To-Many platform with very limited Many-To-Many implementations. And to create the use cases that we want to create, we'd spend almost as much time coding trying to bend the existing solutions to our needs/wants as we do working on AllianceCMS, and still be limited in areas that a custom solution can address properly from the get-go.

That's why we have decided to create something from the ground up that focuses on Many-To-Many interaction at it's very core.

Having said that, there's nothing stopping you from restricting access to Venue creation, not creating any Venues on your own, and using AllianceCMS as a One-To-Many solution :-)

##Benefits for Module Developers

* Flexible/Powerful API
    * Module directory structures follow PSR-0 standards in order to take advantage of AllianceCMS's powerful Autoloader
    * Modules are developed using the MVC design pattern using our easy to use:
        * Database Management API
        * Powerful and flexible Routing API used to create routes to your custom Controller/Actions
        * A thin and flexible Templating System, along with our handy HtmlHelper and FormHelper API's
* Automated logic
    * When you create a module you only have to worry about designing for one Venue. The back end system will track which Venue a user is on and automatically display/create/edit/update/save data only for the Venue intended

##What AllianceCMS is Not!

* The best solution for a simple website with a blog or forum
* In competition with currently existing CMS's that provide excellent feature sets for One-To-Many interaction
* A One-To-Many CMS with an 'add-on' installed that tries to bend the system into offering inferior 'Social Networking' features which lack the workflow needed to build and maintain quality communities
