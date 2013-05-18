<?php

    /**
     * File Doc Block
     *
     * Database connection/usage class
     *
     */

    /**
     * Class Doc Block
     *
     * Database connection/usage class
     *
     */

    class Db
    {
        /**
         *
         * Methods: In progress
         *
         ********************************************************************************/

        public function __construct() {
            $this->initClassVars();
            
            if (is_file(DBCONNFILE)) {
                if($this->getDbInfo()) {
                    if($this->dbConnect()) {
                        return TRUE;
                    } else {
                        return FALSE;
                    }
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }

        public function debug($value) {
            //return $this->_connObject->debug = $value;
            return $this->_conn->debug = $value;
        }
        
        public function getDbInfo() {
            if (is_file(DBCONNFILE)) {

                $this->setDbSoftware(DB_SOFTWARE);
                $this->setDbHost(DB_HOST);
                $this->setDbUser(DB_USER);
                $this->setDbPassword(DB_PASSWORD);
                $this->setDbName(DB_NAME);
                $this->setDbPrefix(DB_PREFIX);
                $this->setDbPersistent(DB_PERSISTENT);
                $this->setDbActive(DB_ACTIVE);
                
                return TRUE;
            } else {
                return FALSE;
            }
        }

        /**
         * Database connection methods
         ********************************************************************************/

        public function dbConnect($dbHost = NULL,
                                  $dbUser= NULL,
                                  $dbPassword = NULL,
                                  $dbDbName = NULL) {

            if ($dbHost == NULL) {
                $dbHost = $this->getDbHost();
            }

            if ($dbUser == NULL) {
                $dbUser = $this->getDbUser();
            }

            if ($dbPassword == NULL) {
                $dbPassword = $this->getDbPassword();
            }

            if ($dbDbName == NULL) {
                $dbDbName = $this->getDbName();
            }
            
            if ($this->getDbSoftware() == NULL) {
                $dbSoftware = "mysql";
            } else {
                $dbSoftware = $this->getDbSoftware();
            }
            
            $this->_conn = NewADOConnection($dbSoftware);
            
            if($this->_conn->Connect($dbHost, $dbUser, $dbPassword, $dbDbName)) {
                return TRUE;
            } else {
                return FALSE;
            }
            
            /*
            $this->_connObject = NewADOConnection($dbSoftware);
            
            if($this->_connObject->Connect($dbHost, $dbUser, $dbPassword, $dbDbName)) {
                return TRUE;
            } else {
                return FALSE;
            }
            */
            
        }
        
        /**
         * =dbSelectDb
         *
         * Selects database for queries.
         *
         * TODO: Finish converting to ADOdb
         *
         */
        public function dbSelectDb($dbName = "") {
            if ($dbName != "") {
                $this->setDbName($dbName);
            }

            mysql_select_db($this->getDbName(), $this->getDbConnection());
        }

        /**
         * =dbCreateDb
         *
         * Create database.
         *
         * TODO: Finish converting to ADOdb
         *
         */
        public function dbCreateDb($dbName = "") {
            if ($dbName != "") {
                $this->setDbName($dbName);
            }

            mysql_query("CREATE DATABASE IF NOT EXISTS ".$this->getDbName(), $this->getDbConnection());
            //mysql_create_db($this->getDbName(), $this->getDbConnection());
        }

        /**
         * =dbManageTables
         *
         * Create/Alter tables.
         *
         * @param array $queries
         *
         */
        /*public function dbManageTables($queries) {
            for ($i = 0; $i < count($queries); $i++) {
                mysql_query($queries[$i], $this->getDbConnection());
            }
        }*/
        
        
        /**
         * =dbExecuteQueries
         *
         * Execute SQL Queries stored in an array. Must include the table prefix
         * using the 'DB_PREFIX' constant.
         *
         * @param array $queries
         *
         */
        public function dbExecuteQueries($queries) {
            for ($i = 0; $i < count($queries); $i++) {
                $this->setDbRecordSet($this->_conn->Execute($queries[$i]));
            }
        }
        

        /**
         * =dbClose
         *
         * Closes the identified link (usually unnecessary).
         *
         * TODO: Finish converting to ADOdb
         *
         */
        public function dbClose() {
            mysql_close($this->getDbConnection);
        }

        /**
         * Prime Custom Database Methods
         ********************************************************************************/

        /**
         * =dbSelect
         *
         */
        public function dbSelect($queryTableName,
                                 $queryWhatClause   = "*",
                                 $queryWhereClause  = NULL,
                                 $queryLimitClause  = NULL) {

            $query = "SELECT " . $queryWhatClause   .
                     " FROM "  . $this->getDbPrefix() . $queryTableName;

            if (isset($queryWhereClause)) {
                $query .= " WHERE "    . $queryWhereClause;
            }

            if (isset($queryLimitClause)) {
                $query .= " LIMIT "    . $queryLimitClause;
            }
            
            $this->setDbRecordSet($this->_conn->Execute($query));
            //$this->setDbRecordSet($this->_connObject->Execute($query));
        }

        /**
         * =dbQuery
         *
         * Sends query to database. Remember to put the semicolon outside the doublequoted
         * query string.
         *
         */
        public function dbQuery($query) {
            $this->setDbRecordSet($this->_conn->Execute($query));
            //$this->setDbResult(mysql_query($query, $this->getDbConnection()));
        }

        /**
         * =dbInsert
         *
         */
        public function dbInsert($queryTableName, $queryInput) {
            $queryInputColumns   = array_keys($queryInput);
            $queryInputValues    = array_values($queryInput);

            $query = "INSERT INTO " . $this->getDbPrefix() . $queryTableName . " (";

            for ($i=0;$i < count($queryInputColumns); $i++) {
                $query .= $queryInputColumns[$i] . ", ";
            }

            $query = substr($query, 0, -2);
            $query .= ") VALUES (";

            for ($i=0;$i < count($queryInputColumns); $i++) {
                $query .= "'" . $queryInputValues[$i] . "', ";
            }

            $query = substr($query, 0, -2);
            $query .= ")";

            $this->setDbRecordSet($this->_conn->Execute($query));
            //$this->setDbResult(mysql_query($query, $this->getDbConnection()));
        }

        /**
         * =dbUpdate
         *
         */
        public function dbUpdate($queryTableName, $queryInput, $queryWhereClause = NULL) {
            $queryInputColumns = array_keys($queryInput);
            $queryInputValues = array_values($queryInput);

            $query = "UPDATE " . $this->getDbPrefix() . $queryTableName . " " .
                      "SET ";

            for ($i=0; $i < count($queryInputColumns); $i++) {
                $query .= $queryInputColumns[$i] . "='" . $queryInputValues[$i] . "', ";
            }

            $query = substr($query, 0, -2);

            if (isset($queryWhereClause)) {
                $query .= " WHERE " . $queryWhereClause;
            }

            $this->setDbRecordSet($this->_conn->Execute($query));
            //$this->setDbResult(mysql_query($query, $this->getDbConnection()));
        }

        /**
         * =dbDelete
         *
         */
        public function dbDelete($queryTableName, $queryWhereClause) {
            $queryWhereClause = strtolower($queryWhereClause);

            $query = "DELETE FROM " . $this->getDbPrefix() . $queryTableName;

            if ($queryWhereClause != "all") {
                $query .= " WHERE " . $queryWhereClause;
            }

            $this->setDbRecordSet($this->_conn->Execute($query));
            //$this->setDbResult(mysql_query($query, $this->getDbConnection()));
        }

        /**
         * =dbCreateTable
         *
         */
        public function dbCreateTable($queryTableName, $queryInput) {
            $queryInputColumns      = array_keys($queryInput);
            $queryInputDataTypeInfo = array_values($queryInput);

            $query = "CREATE TABLE " . $this->getDbPrefix() . $queryTableName . " (";

            for ($i=0; $i < count($queryInputColumns); $i++) {
                $query .= $queryInputColumns[$i]  . " " .
                          $queryInputDataTypeInfo[$i] . ", ";
            }

            $query = substr($query, 0, -2);

            $query .= ")";

            $this->setDbRecordSet($this->_conn->Execute($query));
            //$this->setDbResult(mysql_query($query, $this->getDbConnection()));
        }

        /**
         * =dbAlterTable
         *
         */
        public function dbAlterTable($queryTableName, $queryFunction, $queryInput) {
            $queryFunction      = strtoupper($queryFunction);

            if (is_array($queryInput)) {
                $queryInputColumns  = array_keys($queryInput);
                $queryInputValues   = array_values($queryInput);
            }

            /*
            $query = "ALTER TABLE table RENAME AS new_table";
            $query = "ALTER TABLE new_table ADD COLUMN col3 VARCHAR(50)";
            $query = "ALTER TABLE new_table DROP COLUMN col2";
            //*/

            switch($queryFunction) {
                case "RENAME":
                    $query = "ALTER TABLE " . $this->getDbPrefix() . $queryTableName . " " .
                             "RENAME AS "   . $queryInput;
                    break;
                case "ADD COLUMN":
                    $query = "ALTER TABLE " . $this->getDbPrefix() . $queryTableName . " ";
                    for ($i=0; $i < count($queryInputColumns); $i++) {
                        $query .= "ADD COLUMN " . $queryInputColumns[$i] . " " . $queryInputValues[$i] . ", ";
                    }
                    $query = substr($query, 0, -2);
                    break;
                case "DROP COLUMN":
                    $query = "ALTER TABLE " . $this->getDbPrefix() . $queryTableName . " ";
                    for ($i=0; $i < count($queryInputColumns); $i++) {
                        $query .= "DROP COLUMN "  . $queryInputValues[$i] . ", ";
                    }
                    $query = substr($query, 0, -2);
                    break;
            }

            $this->setDbRecordSet($this->_conn->Execute($query));
            //$this->setDbResult(mysql_query($query, $this->getDbConnection()));
        }

        /**
         * =dbDropTable
         *
         * TODO: Finish converting to ADOdb
         *
         */
        public function dbDropTable() {

        }

        /**
         * Fetching Data Sets
         ********************************************************************************/

        /**
         * =dbFetch
         *
         * Fetches result set.
         *
         */
        public function dbFetch() {
            //echo "\$this->getDbRecordSet() = ".$this->getDbRecordSet()."<br /><br />";
            return $this->getDbRecordSet();
        }
        
        /**
         * =dbFetchRow
         *
         * Fetches result set as an enumerated array.
         *
         * TODO: Finish converting to ADOdb
         *
         */
        public function dbFetchRow() {
            $this->setDbRow(mysql_fetch_row($this->getDbResult()));
            return $this->getDbRow();
        }

        /**
         * =dbFetchObject
         *
         * Fetches result set as an object. See mysql_fetch_array for result types.
         *
         * TODO: Finish converting to ADOdb
         *
         */
        public function dbFetchObject() {
            $this->setDbObject(mysql_fetch_object($this->getDbResult()));
            return $this->getDbObject();
        }

        /**
         * =dbFetchArray
         *
         * Fetches result set as associative array. Result type can be MYSQL_ASSOC,
         * MYSQL_NUM, or MYSQL_BOTH (default).
         *
         * TODO: Finish converting to ADOdb
         *
         */
        public function dbFetchArray() {
            
            
            
            /*
            $this->setDbArray(mysql_fetch_array($this->getDbResult()));
            return $this->getDbArray();
            */
        }

        /**
         * =dbFetchResult
         *
         * Returns single-field result. Field identifier can be field offset (0), field
         * name (FirstName) or table-dot name (myfield.mytable).
         *
         * TODO: Finish converting to ADOdb
         *
         */
        public function dbFetchResult($queryRowIdentifier=0, $queryField=0) {
            $this->setDbQueryResult(mysql_result($this->getDbResult(),
                                                 $queryRowIdentifier,
                                                 $queryField));
        }

        /**
         * Info about Queries
         ********************************************************************************/

        /**
         * =dbInfo
         *
         * TODO: Finish converting to ADOdb
         *
         */
        public function dbInfo() {
            return mysql_info($this->getDbConnection());
        }

        /**
         * Database pointer functions
         ********************************************************************************/

        /**
         * =dbDataSeek
         *
         * Designate the row number desired
         *
         * TODO: Finish converting to ADOdb
         *
         */

        public function dbDataSeek($queryRowIdentifier) {
            $this->setDbRowIdentifier(mysql_data_seek($this->getDbResult(),
                                                      $queryRowIdentifier));
        }

        /*
        /**
         * Database Attributes
         ********************************************************************************/

        private $_dbSoftware;
        private $_dbHost;
        private $_dbUser;
        private $_dbPassword;
        private $_dbName;
        private $_dbPrefix;
        private $_dbPersistent;
        private $_dbActive;
        private $_conn;
        private $_connObject;
        private $_result;
        
        private $_recordSet;
        private $_queryRow;
        private $_queryObject;
        private $_queryArray;
        private $_queryResult;
        private $_queryRowIdentifier;

        private $_baseUrl;
        private $_baseDir;
        private $_handlersDir;
        private $_includesDir;
        private $_pluginsDir;
        private $_themesDir;
        
        /**
         * =initClassVars
         *
         * Purpose: This method initializes all class variables to NULL
         *
         */
        private function initClassVars() {
            $this->_dbSoftware = NULL;
            $this->_dbHost = NULL;
            $this->_dbUser = NULL;
            $this->_dbPassword = NULL;
            $this->_dbName = NULL;
            $this->_dbPrefix = NULL;
            $this->_dbPersistent = NULL;
            $this->_dbActive = NULL;
            $this->_conn = NULL;
            $this->_connObject = NULL;
            $this->_result = NULL;
            
            $this->_recordSet = NULL;
            $this->_queryRow = NULL;
            $this->_queryObject = NULL;
            $this->_queryArray = NULL;
            $this->_queryResult = NULL;
            $this->_queryRowIdentifier = NULL;
    
            $this->_baseUrl = NULL;
            $this->_baseDir = NULL;
            $this->_handlersDir = NULL;
            $this->_includesDir = NULL;
            $this->_pluginsDir = NULL;
            $this->_themesDir = NULL;
        }

        /**
         * Setters and Getters
         ********************************************************************************/

        /**
         * =setDbSoftware
         */
        public function setDbSoftware($dbSoftware) {
            $this->_dbSoftware = $dbSoftware;
        }

        /**
         * =getDbSoftware
         */
        public function getDbSoftware() {
            return $this->_dbSoftware;
        }
        
        /**
         * =setDbHost
         */
        public function setDbHost($dbHost) {
            $this->_dbHost = $dbHost;
        }

        /**
         * =getDbHost
         */
        public function getDbHost() {
            return $this->_dbHost;
        }

        /**
         * =setDbUser
         */
        public function setDbUser($dbUser) {
            $this->_dbUser = $dbUser;
        }

        /**
         * =getDbUser
         */
        public function getDbUser() {
            return $this->_dbUser;
        }

        /**
         * =setDbPassword
         */
        public function setDbPassword($dbPassword) {
            $this->_dbPassword = $dbPassword;
        }

        /**
         * =getDbPassword
         */
        public function getDbPassword() {
            return $this->_dbPassword;
        }

        /**
         * =setDbName
         */
        public function setDbName($dbName) {
            $this->_dbName = $dbName;
        }

        /**
         * =getDbName
         */
        public function getDbName() {
            return $this->_dbName;
        }

        /**
         * =setDbPrefix
         */
        public function setDbPrefix($dbPrefix) {
            $this->_dbPrefix = $dbPrefix;
        }

        /**
         * =getDbPrefix
         */
        public function getDbPrefix() {
            return $this->_dbPrefix;
        }

        /**
         * =setDbPersistent
         */
        public function setDbPersistent($dbPersistent) {
            $this->_dbPersistent = $dbPersistent;
        }

        /**
         * =getDbPersistent
         */
        public function getDbPersistent() {
            return $this->_dbPersistent;
        }

        /**
         * =setDbActive
         */
        public function setDbActive($dbActive) {
            $this->_dbActive = $dbActive;
        }

        /**
         * =getDbActive
         */
        public function getDbActive() {
            return $this->_dbActive;
        }
        
        /**
         * =setDbConn
         * TODO: Finish working on this method.
         */
        public function setDbConn($dbSoftware = NULL) {
                                            
            if ($dbSoftware == NULL) {
                $dbSoftware = $this->getDbSoftware();
            }
            
            $this->_conn = NewADOConnection($dbSoftware);
        }

        /**
         * =getDbConn
         */
        public function getDbConn() {
            return $this->_conn;
        }
        
        /**
         * =setDbConnObject
         */
        public function setDbConnObject($dbSoftware = NULL) {
            if ($dbSoftware == NULL) {
                $dbSoftware = $this->getDbSoftware();
            }
            
            $this->_connObject = NewADOConnection($dbSoftware);
        }

        /**
         * =getDbConnObject
         */
        public function getDbConnObject() {
            return $this->_connObject;
        }

        /**
         * =setDbResult
         */
        public function setDbResult($dbResult) {
            $this->_result = $dbResult;
        }

        /**
         * =getDbResult
         */
        public function getDbResult() {
            return $this->_result;
        }

        /**
         * =setRecordSet
         */
        public function setDbRecordSet($dbRecordSet) {
            $this->_recordSet = $dbRecordSet;
        }

        /**
         * =getRecordSet
         */
        public function getDbRecordSet() {
            return $this->_recordSet;
        }
        
        /**
         * =setDbRow
         */
        public function setDbRow($dbRow) {
            $this->_queryRow = $dbRow;
        }

        /**
         * =getDbRow
         */
        public function getDbRow() {
            return $this->_queryRow;
        }

        /**
         * =setDbObject
         */
        public function setDbObject($dbObject) {
            $this->_queryObject = $dbObject;
        }

        /**
         * =getDbObject
         */
        public function getDbObject() {
            return $this->_queryObject;
        }

        /**
         * =setDbArray
         */
        public function setDbArray($dbArray) {
            $this->_queryArray = $dbArray;
        }

        /**
         * =getDbArray
         */
        public function getDbArray() {
            return $this->_queryArray;
        }

        /**
         * =setDbQueryResult
         */
        public function setDbQueryResult($dbQueryResult) {
            $this->_queryResult = $dbQueryResult;
        }

        /**
         * =getDbQueryResult
         */
        public function getDbQueryResult() {
            return $this->_queryResult;
        }

        /**
         * =setDbRowIdentifier
         */
        public function setDbRowIdentifier($dbRowIdentifier) {
            $this->_queryRowIdentifier = $dbRowIdentifier;
        }

        /**
         * =getDbRowIdentifier
         */
        public function getDbRowIdentifier() {
            return $this->_queryRowIdentifier;
        }

        /**
         *
         * Methods: Undeveloped
         *
         ********************************************************************************/

        /**
         * Database connection methods
         ********************************************************************************/

        /**
         * =dbPConnect
         *
         * Opens persistent connection to database. All arguments are optional. Be
         * careful, mysql_close and script termination will not close the connection.
         *
         */
        public function dbPConnect() {

        }

        /**
         * =dbChangeUser
         *
         * Changes MySQL user on an open link.
         *
         */
        public function dbChangeUser() {

        }

        /**
         * Info about Queries
         ********************************************************************************/

        /**
         * =dbAffectedRows
         *
         * Use after a nonzero INSERT, UPDATE, or DELETE query to check number of rows
         * changed.
         *
         */
        public function dbAffectedRows() {

        }

        /**
         * =dbNumFields
         *
         * Returns number of fields in a result set.
         *
         */
        public function dbNumFields() {

        }

        /**
         * =dbNumRows
         *
         * Returns number of rows in a result set.
         *
         */
        public function dbNumRows() {

        }

        /**
         * =dbFetchField
         *
         * Returns information about a field as an object.
         *
         */
        public function dbFetchField() {

        }

        /**
         * =dbFieldSeek
         *
         * Moves result pointer to specified field offset. Used with mysql_fetch_field.
         *
         */
        public function dbFieldSeek() {

        }

        /**
         * =dbFetchLengths
         *
         * Returns length of each field in a result set.
         *
         */
        public function dbFetchLengths() {

        }

        /**
         * =dbFieldName
         *
         * Returns name of enumerated field.
         *
         */
        public function dbFieldName() {

        }

        /**
         * =dbFieldTable
         *
         * Returns name of specified fields table.
         *
         */
        public function dbFieldTable() {

        }

        /**
         * =dbFieldType
         *
         * Returns type of offset field (for example, TINYINT, BLOB, VARCHAR).
         *
         */
        public function dbFieldType() {

        }

        /**
         * =dbFieldFlags
         *
         * Returns flags associated with enumerated field (for example, NOT NULL,
         * AUTO_INCREMENT, BINARY).
         *
         */
        public function dbFieldFlags() {

        }

        /**
         * =dbFieldLen
         *
         * Returns length of enumerated field.
         *
         */
        public function dbFieldLen() {

        }

        /**
         * =dbFreeResult
         *
         * Frees memory used by result set (usually unnecessary).
         *
         */
        public function dbFreeResult() {

        }

        /**
         * =dbInsertId
         *
         * Returns AUTO_INCREMENTED ID of INSERT; or FALSE if insert failed or last query
         * was not an insert.
         *
         */
        public function dbInsertId() {

        }

        /**
         * =dbListFields
         *
         * Returns result ID for use in mysql_field functions, without performing an
         * actual query.
         *
         */
        public function dbListFields() {

        }

        /**
         * =dbListDbs
         *
         * Returns result pointer of databases on mysqld. Used with mysql_tablename.
         *
         */
        public function dbListDbs() {

        }

        /**
         * =dbListTables
         *
         * Returns result pointer of tables in database. Used with mysql_tablename.
         *
         */
        public function dbListTables() {

        }

        /**
         * =dbTableName
         *
         * Used with any of the mysql_list functions to return the value referenced by
         * a result pointer.
         *
         */
        public function dbTableName() {

        }

        /**
         * Error Methods
         ********************************************************************************/

        /**
         * =dbErrNo
         *
         * Returns ID of error.
         *
         */
        public function dbErrNo() {
            return $this->_conn->ErrorNo();
        }

        /**
         * =dbError
         *
         * Returns text error message.
         *
         */
        public function dbErrorMsg() {
            return $this->_conn->ErrorMsg();
        }
    }