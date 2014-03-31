<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Base Path
    |--------------------------------------------------------------------------
    |
    | The base path is the root of the AllianceCMS installation. Most likely you
    | will not need to change this value. But, if for some wild reason it
    | is necessary you will do so here, just proceed with some caution.
    |
    */

    'base' => $acmsBaseDir,

	/*
	|--------------------------------------------------------------------------
	| Axis Path
	|--------------------------------------------------------------------------
	|
	| Here we just defined the path to the application directory. Most likely
	| you will never need to change this value as the default setup should
	| work perfectly fine for the vast majority of all our applications.
	|
	*/

    'axis' => $acmsBaseDir . '/axis',

	/*
	|--------------------------------------------------------------------------
	| Public Path
	|--------------------------------------------------------------------------
	|
	| The public path contains the assets for your web application, such as
	| your Themes, JavaScript and CSS files, and also contains the primary entry
	| point for web requests into Axis from the outside.
	|
	*/

    'public_html' => $acmsBaseDir . '/public_html' . $subDomainFolder,

    /*
    |--------------------------------------------------------------------------
    | Zones Path
    |--------------------------------------------------------------------------
    |
    | The zones path contains the domain specific configs and Modules for your web application. This enables
    | multi-site installations. This is great for a "dev -> test -> QA -> production" workflow.
    |
    */

    'zones' => $acmsBaseDir . '/zones',

	/*
	|--------------------------------------------------------------------------
	| Storage Path
	|--------------------------------------------------------------------------
	|
	| The storage path is used by AllianceCMS to store cached templates, logs
	| and other pieces of information. You may modify the path here when
	| you want to change the location of this directory.
	|
	*/

    'storage' => $acmsBaseDir . '/axis/storage',

    /*
    |--------------------------------------------------------------------------
    | Subdomain Folder Name
    |--------------------------------------------------------------------------
    |
    | The storage path is used by AllianceCMS to store cached templates, logs
    | and other pieces of information. You may modify the path here when
    | you want to change the location of this directory.
    |
    */

    'storage' => $acmsBaseDir . '/axis/storage',
);
