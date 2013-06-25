<?php

    error_reporting(0);
    
    $dbCreateDatabase = "";

    if (!empty($_POST['dbCreateDatabase'])) {
        $dbCreateDatabase = intval($_POST['dbCreateDatabase']);
    }

    define("ADODB_ERROR_HANDLER_TYPE", E_USER_WARNING);

    // Create Database if needed, Establish Database Connection

   	require_once(DBCONNFILE);
   	require_once(HANDLERS."db".DS."adodb".DS."adodb.inc.php");
   	require_once(HANDLERS."db".DS."adodb".DS."adodb-xmlschema03.inc.php");
   	require_once(HANDLERS."db".DS."adodb".DS."adodb-exceptions.inc.php");

   	if ($dbCreateDatabase == 1) {

   		// Create Database, connect to new Database

   	    try {
	    	$sql = NewADOConnection(DB_SOFTWARE);
	   		$sql->debug = 0;
			$sql->Connect(DB_HOST, DB_USER, DB_PASSWORD);

	    	$dataDict = NewDataDictionary($sql);

	    	$sqlArray = $dataDict->CreateDatabase(DB_NAME);
    		$executedSqlArray = $dataDict->ExecuteSQLArray($sqlArray);
	    } catch (exception $e) {
	    	var_dump($e);
			adodb_backtrace($e->gettrace());
	    }

   		try {
			$sql->Connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	    } catch (exception $e) {
	    	var_dump($e);
			adodb_backtrace($e->gettrace());
	    }

    	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		$ADODB_COUNTRECS = false;
    } else {

    	// Database exists, connect to Database

        try {
	    	$sql = NewADOConnection(DB_SOFTWARE);
	    	$sql->debug = 0;
			$sql->Connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	    } catch (exception $e) {
	    	var_dump($e);
			adodb_backtrace($e->gettrace());
	    }

	    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		$ADODB_COUNTRECS = false;
	}

	try {
		$schema = new adoSchema($sql);
		$schema->SetPrefix(DB_PREFIX);
		$parsedSchema = $schema->ParseSchema(HANDLERS."db".DS."schemata".DS."core.xml");
        $schema->ExecuteSchema($parsedSchema);
    } catch (exception $e) {
    	var_dump($e);
		adodb_backtrace($e->gettrace());
    }