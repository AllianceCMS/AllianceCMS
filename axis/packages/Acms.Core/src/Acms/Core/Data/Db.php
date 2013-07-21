<?php
/**
 * @file
 * Generic Database Handler.
 */

/**
 * @defgroup database Database Abstraction Layer
 * @{
 * Documentation for all Database related functionality.
 */

namespace Acms\Core\Data;

use Aura\Sql\ConnectionFactory;

/**
 * Db
 *
 * Database connection/usage class.
 *
 * The routines here define the methods and properties needed to handle database connectivity and functionality.
 *
 * We use Aura.Sql for minor database abstraction. The available databases are: MySQL, PostgreSQL, SQLite3 and Microsoft SQL Server
 */
class Db
{

    /**
     * 1. Sets all class properties to null
     * 2. Checks if dbConnections.php exists
     * 3. Sets up class properies related to database connection
     * 4. Creates database connection using a lazy-connect method
     *
     *     From the Aura.Sql documentation: "The connection will lazy-connect to the database the first time you issue a query
     *     of any sort. This means you can create the connection object, and if you never issue a query, it will never connect
     *     to the database."
     */
    public function __construct()
    {
        $this->initClassVars();

        if (is_file(DBCONNFILE)) {
            if ($this->getDbInfo()) {
                if ($this->dbConnect()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /*
    public function debug($value)
    {
        // return $this->connObject->debug = $value;
        return $this->conn->debug = $value;
    }
    //*/

    private function getDbInfo()
    {
        if (is_file(DBCONNFILE)) {

            require_once(DBCONNFILE);

            $this->setDbAdapter(DB_ADAPTER);
            $this->setDbHost(DB_HOST);
            $this->setDbUser(DB_USER);
            $this->setDbPassword(DB_PASSWORD);
            $this->setDbName(DB_NAME);
            $this->setDbPrefix(DB_PREFIX);
            //$this->setDbPersistent(DB_PERSISTENT);
            $this->setDbActive(DB_ACTIVE);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Connects to database server and selects database.
     *
     * Db::__construct should be the only one using this method.
     *
     * @param string $dbAdapter
     *     Database adapter name: i.e. mysql, pgsql, sqlite, sqlsrv
     * @param string $dbHost
     *     IP or hostname of the database server
     * @param string $dbDbName
     *     Database name
     * @param string $dbUser
     *     Database Username
     * @param string $dbPassword
     *     Database Password
     *
     * @return true|false Returns true if database connection is successful, false if database connection fails.
     */

    public function dbConnect($dbAdapter = null, $dbHost = null, $dbDbName = null, $dbUser = null, $dbPassword = null)
    {

        if ($this->getDbAdapter() == null) {
            $dbAdapter = "mysql";
        } else {
            $dbAdapter = $this->getDbAdapter();
        }

        if ($dbHost == null) {
            $dbHost = $this->getDbHost();
        }

        if ($dbDbName == null) {
            $dbDbName = $this->getDbName();
        }

        if ($dbUser == null) {
            $dbUser = $this->getDbUser();
        }

        if ($dbPassword == null) {
            $dbPassword = $this->getDbPassword();
        }

        $connection_factory = new ConnectionFactory();
        $this->conn = $connection_factory->newInstance(

            // adapter name
            $dbAdapter,

            // DSN elements for PDO; this can also be
            // an array of key-value pairs
            'host='.$dbHost.';dbname='.$dbDbName,

            // username for the connection
            $dbUser,

            // password for the connection
            $dbPassword
        );

        if ($this->conn) {
            return true;
        } else {
            return false;
        }

        /*
        $this->conn = NewADOConnection($dbAdapter);

        if ($this->conn->Connect($dbHost, $dbUser, $dbPassword, $dbDbName)) {
            return true;
        } else {
            return false;
        }
        //*/

        /*
         * $this->connObject = NewADOConnection($dbAdapter); if($this->connObject->Connect($dbHost, $dbUser, $dbPassword, $dbDbName)) { return true; } else { return false; }
         */
    }

    /**
     * =dbSelectDb
     *
     * Selects database for queries.
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function dbSelectDb($dbName = "")
    {
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
     * @todo:: Finish converting to Aura.Sql
     */
    public function dbCreateDb($dbName = "")
    {
        if ($dbName != "") {
            $this->setDbName($dbName);
        }

        mysql_query("CREATE DATABASE IF NOT EXISTS " . $this->getDbName(), $this->getDbConnection());
        // mysql_create_db($this->getDbName(), $this->getDbConnection());
    }

    /**
     * =dbManageTables
     *
     * Create/Alter tables.
     *
     * @param array $queries
     *
     * @todo:: Finish converting to Aura.Sql
     */

    /*
     * public function dbManageTables($queries) { for ($i = 0; $i < count($queries); $i++) { mysql_query($queries[$i], $this->getDbConnection()); } }
     */

    /**
     * =dbExecuteQueries
     *
     * Execute SQL Queries stored in an array. Must include the table prefix
     * using the 'DB_PREFIX' constant.
     *
     * @param array $queries
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function dbExecuteQueries($queries)
    {
        for ($i = 0; $i < count($queries); $i ++) {
            $this->setDbRecordSet($this->conn->Execute($queries[$i]));
        }
    }

    /**
     * =dbClose
     *
     * Closes the identified link (usually unnecessary).
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function dbClose()
    {
        mysql_close($this->getDbConnection);
    }

    /**
	 * Select data from the database
	 *
	 * Example selecting data from the database:
	 * @code
	 * $sql = new Db;
	 *
	 * $sql->dbSelect('links', 'label, url', 'active = :active', ['active' => intval(2)], 'ORDER BY link_order');
	 * @endcode
	 *
	 * @param string $queryTableName
	 *     Name of the table you want to query
	 * @param string $queryWhatClause
	 *     Table colums you want to return in your result set
	 * @param string $queryWhereClause
	 *     Where clause for query: i.e. 'id > :id AND active = :active'
	 * @param array $queryBindValues
	 *     Values to bind to WHERE clause: i.e. ['id' = intval(3), 'active' = intval(2)]
	 * @param string $queryAdditionalClauses
	 *     Add additional clauses to query: i.e. 'ORDER BY link_order'
	 *
	 * @todo: Re-evaluate using Aura.SQL Query Objects
	 */

    public function dbSelect($queryTableName, $queryWhatClause = "*", $queryWhereClause = null, $queryBindValues = null, $queryAdditionalClauses = null)
    {
        $queryText = 'SELECT ' . $queryWhatClause . ' FROM ' . $this->getDbPrefix() . $queryTableName;

        if (isset($queryWhereClause)) {
            $queryText .= ' WHERE ' . $queryWhereClause;
        }

        //*
        if (isset($queryAdditionalClauses)) {
            $queryText .= ' ' . $queryAdditionalClauses;
        }
        //*/

        if (isset($queryBindValues)) {
            $bindValues = $queryBindValues;
        }

        $this->setQueryText($queryText);
        $this->setBindValues($bindValues);

        //return $this->conn->fetchOne($text, $bind);
        //$this->setDbRecordSet($this->conn->Execute($query));
        // $this->setDbRecordSet($this->connObject->Execute($query));
    }

    /**
     * =dbQuery
     *
     * Sends query to database. Remember to put the semicolon outside the doublequoted
     * query string.
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function dbQuery($query)
    {
        $this->setDbRecordSet($this->conn->Execute($query));
        // $this->setDbResult(mysql_query($query, $this->getDbConnection()));
    }

    /**
     * =dbInsert
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function dbInsert($queryTableName, $queryInput)
    {
        $queryInputColumns = array_keys($queryInput);
        $queryInputValues = array_values($queryInput);

        $query = "INSERT INTO " . $this->getDbPrefix() . $queryTableName . " (";

        for ($i = 0; $i < count($queryInputColumns); $i ++) {
            $query .= $queryInputColumns[$i] . ", ";
        }

        $query = substr($query, 0, - 2);
        $query .= ") VALUES (";

        for ($i = 0; $i < count($queryInputColumns); $i ++) {
            $query .= "'" . $queryInputValues[$i] . "', ";
        }

        $query = substr($query, 0, - 2);
        $query .= ")";

        $this->setDbRecordSet($this->conn->Execute($query));
        // $this->setDbResult(mysql_query($query, $this->getDbConnection()));
    }

    /**
     * =dbUpdate
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function dbUpdate($queryTableName, $queryInput, $queryWhereClause = null)
    {
        $queryInputColumns = array_keys($queryInput);
        $queryInputValues = array_values($queryInput);

        $query = "UPDATE " . $this->getDbPrefix() . $queryTableName . " " . "SET ";

        for ($i = 0; $i < count($queryInputColumns); $i ++) {
            $query .= $queryInputColumns[$i] . "='" . $queryInputValues[$i] . "', ";
        }

        $query = substr($query, 0, - 2);

        if (isset($queryWhereClause)) {
            $query .= " WHERE " . $queryWhereClause;
        }

        $this->setDbRecordSet($this->conn->Execute($query));
        // $this->setDbResult(mysql_query($query, $this->getDbConnection()));
    }

    /**
     * =dbDelete
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function dbDelete($queryTableName, $queryWhereClause)
    {
        $queryWhereClause = strtolower($queryWhereClause);

        $query = "DELETE FROM " . $this->getDbPrefix() . $queryTableName;

        if ($queryWhereClause != "all") {
            $query .= " WHERE " . $queryWhereClause;
        }

        $this->setDbRecordSet($this->conn->Execute($query));
        // $this->setDbResult(mysql_query($query, $this->getDbConnection()));
    }

    /**
     * =dbCreateTable
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function dbCreateTable($queryTableName, $queryInput)
    {
        $queryInputColumns = array_keys($queryInput);
        $queryInputDataTypeInfo = array_values($queryInput);

        $query = "CREATE TABLE " . $this->getDbPrefix() . $queryTableName . " (";

        for ($i = 0; $i < count($queryInputColumns); $i ++) {
            $query .= $queryInputColumns[$i] . " " . $queryInputDataTypeInfo[$i] . ", ";
        }

        $query = substr($query, 0, - 2);

        $query .= ")";

        $this->setDbRecordSet($this->conn->Execute($query));
        // $this->setDbResult(mysql_query($query, $this->getDbConnection()));
    }

    /**
     * =dbAlterTable
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function dbAlterTable($queryTableName, $queryFunction, $queryInput)
    {
        $queryFunction = strtoupper($queryFunction);

        if (is_array($queryInput)) {
            $queryInputColumns = array_keys($queryInput);
            $queryInputValues = array_values($queryInput);
        }

        /*
         * $query = "ALTER TABLE table RENAME AS new_table"; $query = "ALTER TABLE new_table ADD COLUMN col3 VARCHAR(50)"; $query = "ALTER TABLE new_table DROP COLUMN col2"; //
         */

        switch ($queryFunction) {
            case "RENAME":
                $query = "ALTER TABLE " . $this->getDbPrefix() . $queryTableName . " " . "RENAME AS " . $queryInput;
                break;
            case "ADD COLUMN":
                $query = "ALTER TABLE " . $this->getDbPrefix() . $queryTableName . " ";
                for ($i = 0; $i < count($queryInputColumns); $i ++) {
                    $query .= "ADD COLUMN " . $queryInputColumns[$i] . " " . $queryInputValues[$i] . ", ";
                }
                $query = substr($query, 0, - 2);
                break;
            case "DROP COLUMN":
                $query = "ALTER TABLE " . $this->getDbPrefix() . $queryTableName . " ";
                for ($i = 0; $i < count($queryInputColumns); $i ++) {
                    $query .= "DROP COLUMN " . $queryInputValues[$i] . ", ";
                }
                $query = substr($query, 0, - 2);
                break;
        }

        $this->setDbRecordSet($this->conn->Execute($query));
        // $this->setDbResult(mysql_query($query, $this->getDbConnection()));
    }

    /**
     * =dbDropTable
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function dbDropTable()
    {}

    /**
     * Fetching Data Sets
     * ******************************************************************************
     */

    /**
     * Fetches result set.
     *
	 * @param string $fetchType
	 *     Type of fetch you would like to perform:
	 *         1. **all**: Returns a sequential array of all rows. The rows themselves are associative arrays where the keys are the column names.
	 *         2. **assoc**: Returns an associative array of all rows where the key is the first column.
	 *         3. **col**: Returns a sequential array of all values in the first column.
	 *         4. **one**: Returns the first row as an associative array where the keys are the column names.
	 *         5. **pairs**: Returns an associative array where each key is the first column and each value is the second column.
	 *         6. **value**: Returns the value of the first row in the first column.
	 *
     * @return Returns result set depending on $fetchType, false if no matching $fetchType
     */
    public function dbFetch($fetchType = 'all')
    {

        switch ($fetchType) {
            case 'all':
                return $this->conn->fetchAll($this->getQueryText(), $this->getBindValues());
            case 'assoc':
                return $this->conn->fetchAssoc($this->getQueryText(), $this->getBindValues());
            case 'col':
                return $this->conn->fetchCol($this->getQueryText(), $this->getBindValues());
            case 'one':
                return $this->conn->fetchOne($this->getQueryText(), $this->getBindValues());
            case 'pairs':
                return $this->conn->fetchPairs($this->getQueryText(), $this->getBindValues());
            case 'value':
                return $this->conn->fetchValue($this->getQueryText(), $this->getBindValues());
            default:
                return false;
        }
        // echo "\$this->getDbRecordSet() = ".$this->getDbRecordSet()."<br /><br />";
        //return $this->getDbRecordSet();
    }

    /**
     * =dbFetchRow
     *
     * Fetches result set as an enumerated array.
     *
     * @todo:: Finish converting to Aura.Sql
     */
    /*
    public function dbFetchRow()
    {
        $this->setDbRow(mysql_fetch_row($this->getDbResult()));
        return $this->getDbRow();
    }
    //*/

    /**
     * =dbFetchObject
     *
     * Fetches result set as an object. See mysql_fetch_array for result types.
     *
     * @todo:: Finish converting to Aura.Sql
     */
    /*
    public function dbFetchObject()
    {
        $this->setDbObject(mysql_fetch_object($this->getDbResult()));
        return $this->getDbObject();
    }
    //*/

    /**
     * =dbFetchArray
     *
     * Fetches result set as associative array. Result type can be MYSQL_ASSOC,
     * MYSQL_NUM, or MYSQL_BOTH (default).
     *
     * @todo:: Finish converting to Aura.Sql
     */
    /*
    public function dbFetchArray()
    {

        //this->setDbArray(mysql_fetch_array($this->getDbResult())); return $this->getDbArray();
    }
    //*/

    /**
     * =dbFetchResult
     *
     * Returns single-field result. Field identifier can be field offset (0), field
     * name (FirstName) or table-dot name (myfield.mytable).
     *
     * @todo:: Finish converting to Aura.Sql
     */
    /*
    public function dbFetchResult($queryRowIdentifier = 0, $queryField = 0)
    {
        $this->setDbQueryResult(mysql_result($this->getDbResult(), $queryRowIdentifier, $queryField));
    }
    //*/

    /**
     * Info about Queries
     * ******************************************************************************
     */

    /**
     * =dbInfo
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function dbInfo()
    {
        return mysql_info($this->getDbConnection());
    }

    /**
     * Database pointer functions
     * ******************************************************************************
     */

    /**
     * =dbDataSeek
     *
     * Designate the row number desired
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function dbDataSeek($queryRowIdentifier)
    {
        $this->setDbRowIdentifier(mysql_data_seek($this->getDbResult(), $queryRowIdentifier));
    }

    /*
     * /** Database Attributes ******************************************************************************
     */
    private $dbAdapter;

    private $dbHost;

    private $dbUser;

    private $dbPassword;

    private $dbName;

    private $dbPrefix;

    private $dbPersistent;

    private $dbActive;

    private $conn;

    private $connObject;

    private $queryText;

    private $bindValues;

    private $result;

    private $recordSet;

    private $queryRow;

    private $queryObject;

    private $queryArray;

    private $queryResult;

    private $queryRowIdentifier;

    private $baseUrl;

    private $baseDir;

    private $handlersDir;

    private $includesDir;

    private $pluginsDir;

    private $themesDir;

    /**
     * This method initializes all class variables to null
     */
    private function initClassVars()
    {
        $this->dbAdapter = null;
        $this->dbHost = null;
        $this->dbUser = null;
        $this->dbPassword = null;
        $this->dbName = null;
        $this->dbPrefix = null;
        $this->dbPersistent = null;
        $this->dbActive = null;
        $this->conn = null;
        $this->connObject = null;
        $this->queryText = null;
        $this->bindValues = null;
        $this->result = null;

        $this->recordSet = null;
        $this->queryRow = null;
        $this->queryObject = null;
        $this->queryArray = null;
        $this->queryResult = null;
        $this->queryRowIdentifier = null;

        $this->baseUrl = null;
        $this->baseDir = null;
        $this->handlersDir = null;
        $this->includesDir = null;
        $this->pluginsDir = null;
        $this->themesDir = null;
    }

    /**
     * Setters and Getters
     * ******************************************************************************
     */

    /**
     * Sets $this->dbAdapter
     *
     */
    public function setDbAdapter($dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * Gets $this->bAdapter
     */
    public function getDbAdapter()
    {
        return $this->dbAdapter;
    }

    /**
     * =setDbHost
     */
    public function setDbHost($dbHost)
    {
        $this->dbHost = $dbHost;
    }

    /**
     * =getDbHost
     */
    public function getDbHost()
    {
        return $this->dbHost;
    }

    /**
     * =setDbUser
     */
    public function setDbUser($dbUser)
    {
        $this->dbUser = $dbUser;
    }

    /**
     * =getDbUser
     */
    public function getDbUser()
    {
        return $this->dbUser;
    }

    /**
     * =setDbPassword
     */
    public function setDbPassword($dbPassword)
    {
        $this->dbPassword = $dbPassword;
    }

    /**
     * =getDbPassword
     */
    public function getDbPassword()
    {
        return $this->dbPassword;
    }

    /**
     * =setDbName
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;
    }

    /**
     * =getDbName
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * =setDbPrefix
     */
    public function setDbPrefix($dbPrefix)
    {
        $this->dbPrefix = $dbPrefix;
    }

    /**
     * =getDbPrefix
     */
    public function getDbPrefix()
    {
        return $this->dbPrefix;
    }

    /**
     * =setDbPersistent
     */
    public function setDbPersistent($dbPersistent)
    {
        $this->dbPersistent = $dbPersistent;
    }

    /**
     * =getDbPersistent
     */
    public function getDbPersistent()
    {
        return $this->dbPersistent;
    }

    /**
     * =setDbActive
     */
    public function setDbActive($dbActive)
    {
        $this->dbActive = $dbActive;
    }

    /**
     * =getDbActive
     */
    public function getDbActive()
    {
        return $this->dbActive;
    }

    /**
     * =setDbConn
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function setDbConn($dbAdapter = null)
    {
        if ($dbAdapter == null) {
            $dbAdapter = $this->getDbAdapter();
        }

        $this->conn = NewADOConnection($dbAdapter);
    }

    /**
     * =getDbConn
     */
    public function getDbConn()
    {
        return $this->conn;
    }

    /**
     * =setDbConnObject
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function setDbConnObject($dbAdapter = null)
    {
        if ($dbAdapter == null) {
            $dbAdapter = $this->getDbAdapter();
        }

        $this->connObject = NewADOConnection($dbAdapter);
    }

    /**
     * =getDbConnObject
     */
    public function getDbConnObject()
    {
        return $this->connObject;
    }

    /**
     * Set $this->queryText for use in fetch methods
     */
    public function setQueryText($queryText)
    {
        $this->queryText = $queryText;
    }

    /**
     * Get  $this->queryText for use in fetch methods
     */
    public function getQueryText()
    {
        return $this->queryText;
    }

    /**
     * Set $this->bindValues for use in fetch methods
     */
    public function setBindValues($bindValues)
    {
        $this->bindValues = $bindValues;
    }

    /**
     * Get  $this->bindValues for use in fetch methods
     */
    public function getBindValues()
    {
        return $this->bindValues;
    }

    /**
     * =setDbResult
     *
     */
    public function setDbResult($dbResult)
    {
        $this->result = $dbResult;
    }

    /**
     * =getDbResult
     */
    public function getDbResult()
    {
        return $this->result;
    }

    /**
     * =setRecordSet
     */
    public function setDbRecordSet($dbRecordSet)
    {
        $this->recordSet = $dbRecordSet;
    }

    /**
     * =getRecordSet
     */
    public function getDbRecordSet()
    {
        return $this->recordSet;
    }

    /**
     * =setDbRow
     */
    public function setDbRow($dbRow)
    {
        $this->queryRow = $dbRow;
    }

    /**
     * =getDbRow
     */
    public function getDbRow()
    {
        return $this->queryRow;
    }

    /**
     * =setDbObject
     */
    public function setDbObject($dbObject)
    {
        $this->queryObject = $dbObject;
    }

    /**
     * =getDbObject
     */
    public function getDbObject()
    {
        return $this->queryObject;
    }

    /**
     * =setDbArray
     */
    public function setDbArray($dbArray)
    {
        $this->queryArray = $dbArray;
    }

    /**
     * =getDbArray
     */
    public function getDbArray()
    {
        return $this->queryArray;
    }

    /**
     * =setDbQueryResult
     */
    public function setDbQueryResult($dbQueryResult)
    {
        $this->queryResult = $dbQueryResult;
    }

    /**
     * =getDbQueryResult
     */
    public function getDbQueryResult()
    {
        return $this->queryResult;
    }

    /**
     * =setDbRowIdentifier
     */
    public function setDbRowIdentifier($dbRowIdentifier)
    {
        $this->queryRowIdentifier = $dbRowIdentifier;
    }

    /**
     * =getDbRowIdentifier
     */
    public function getDbRowIdentifier()
    {
        return $this->queryRowIdentifier;
    }

    /**
     * Methods: Undeveloped
     *
     * ******************************************************************************
     */

    /**
     * Database connection methods
     * ******************************************************************************
     */

    /**
     * =dbPConnect
     *
     * Opens persistent connection to database. All arguments are optional. Be
     * careful, mysql_close and script termination will not close the connection.
     */
    public function dbPConnect()
    {}

    /**
     * =dbChangeUser
     *
     * Changes MySQL user on an open link.
     */
    public function dbChangeUser()
    {}

    /**
     * Info about Queries
     * ******************************************************************************
     */

    /**
     * =dbAffectedRows
     *
     * Use after a nonzero INSERT, UPDATE, or DELETE query to check number of rows
     * changed.
     */
    public function dbAffectedRows()
    {}

    /**
     * =dbNumFields
     *
     * Returns number of fields in a result set.
     */
    public function dbNumFields()
    {}

    /**
     * =dbNumRows
     *
     * Returns number of rows in a result set.
     */
    public function dbNumRows()
    {}

    /**
     * =dbFetchField
     *
     * Returns information about a field as an object.
     */
    public function dbFetchField()
    {}

    /**
     * =dbFieldSeek
     *
     * Moves result pointer to specified field offset. Used with mysql_fetch_field.
     */
    public function dbFieldSeek()
    {}

    /**
     * =dbFetchLengths
     *
     * Returns length of each field in a result set.
     */
    public function dbFetchLengths()
    {}

    /**
     * =dbFieldName
     *
     * Returns name of enumerated field.
     */
    public function dbFieldName()
    {}

    /**
     * =dbFieldTable
     *
     * Returns name of specified fields table.
     */
    public function dbFieldTable()
    {}

    /**
     * =dbFieldType
     *
     * Returns type of offset field (for example, TINYINT, BLOB, VARCHAR).
     */
    public function dbFieldType()
    {}

    /**
     * =dbFieldFlags
     *
     * Returns flags associated with enumerated field (for example, NOT null,
     * AUTO_INCREMENT, BINARY).
     */
    public function dbFieldFlags()
    {}

    /**
     * =dbFieldLen
     *
     * Returns length of enumerated field.
     */
    public function dbFieldLen()
    {}

    /**
     * =dbFreeResult
     *
     * Frees memory used by result set (usually unnecessary).
     */
    public function dbFreeResult()
    {}

    /**
     * =dbInsertId
     *
     * Returns AUTO_INCREMENTED ID of INSERT; or false if insert failed or last query
     * was not an insert.
     */
    public function dbInsertId()
    {}

    /**
     * =dbListFields
     *
     * Returns result ID for use in mysql_field functions, without performing an
     * actual query.
     */
    public function dbListFields()
    {}

    /**
     * =dbListDbs
     *
     * Returns result pointer of databases on mysqld. Used with mysql_tablename.
     */
    public function dbListDbs()
    {}

    /**
     * =dbListTables
     *
     * Returns result pointer of tables in database. Used with mysql_tablename.
     */
    public function dbListTables()
    {}

    /**
     * =dbTableName
     *
     * Used with any of the mysql_list functions to return the value referenced by
     * a result pointer.
     */
    public function dbTableName()
    {}

    /**
     * Error Methods
     * ******************************************************************************
     */

    /**
     * =dbErrNo
     *
     * Returns ID of error.
     */
    public function dbErrNo()
    {
        return $this->conn->ErrorNo();
    }

    /**
     * =dbError
     *
     * Returns text error message.
     */
    public function dbErrorMsg()
    {
        return $this->conn->ErrorMsg();
    }
}

/** @} */ // End group database */
