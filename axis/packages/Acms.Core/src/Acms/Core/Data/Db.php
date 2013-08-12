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

/**
 * Db
 *
 * Database connection/usage class.
 *
 * The routines here define the methods and properties needed to handle database connectivity and functionality.
 *
 * We use Aura.Sql for minor database abstraction. The available databases (at this time) are: MySQL
 */

class Db
{

    /**
     * 1. Initialize all class properties to null
     * 2. Checks if dbConnection.php exists
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
            if ($this->setDbInfo()) {
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

    /**
     * Uses dbConnection.php to Initialize database connection properties
     *
     * @return boolean
     */

    private function setDbInfo()
    {
        if (is_file(DBCONNFILE)) {

            require_once(DBCONNFILE);

            $this->setDbAdapter(DB_ADAPTER);
            $this->setDbHost(DB_HOST);
            $this->setDbUser(DB_USER);
            $this->setDbPassword(DB_PASSWORD);
            $this->setDbName(DB_NAME);
            $this->setDbPrefix(DB_PREFIX);
            $this->setDbActive(DB_ACTIVE);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Creates a new database
     *     (Should not be used in plugin/theme development)
     *
     * @param string $dbName
     *     Name of the database you want to create
     * @param string $dbCharset
     *     Default database charset
     * @param string $dbCollation
     *     Default database collation
     *
     * @return boolean
     */

    public function dbCreateDatabase($dbName = '', $dbCharset = 'utf8', $dbCollation = 'utf8_general_ci')
    {
        if ($dbName != '') {
            $this->setDbName($dbName);

            // @todo: Maybe we should escape values at some point, but binding values adds surrounding quotes to bound values in $queryString, which causes CREATE DATABASE to fail

            $queryString = 'CREATE DATABASE IF NOT EXISTS ' . $dbName . ' CHARACTER SET ' . $dbCharset . ' COLLATE ' . $dbCollation . ';';

            try {
                $dbStmt = $this->connection->query($queryString);
            }
            catch (\PDOException $e)
            {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Creates a new database table
     *     (Should not be used in plugin/theme development)
     *
     * @param string $tableName
     *     Name of the table you want to create
     * @param string $tableSchema
     *     A table schema array (See example below)
     * @param string $tablePrefix
     *     The prefix you would like to place in front of every table (If omitted Axis will add this for you)
     *         * Needs to match value of your dbConnection.php DB_PREFIX
     *
     * @return boolean True if the table was created successfully, false if table creation fails
     *
     * Example: $tableSchema
     * @code
     * $tableSchema['0.01']['create']['table']['my_table'] = [
     *     [
     *         'name' => 'id',
     *         'type' => 'int(11)',
     *         'not_null' => '1',
     *         'signed' => '0',
     *         'autoincrement' => '1',
     *         'default' => '',
     *         'primary_key' => '1',
     *         'unique_keys' => '',
     *     ],
     * ],
     * $tableSchema['0.01']['create']['table']['my_table'] = [
     *     [
     *         'name' => 'field_02',
     *         'type' => 'string',
     *         'not_null' => '1',
     *         'signed' => '0',
     *         'autoincrement' => '',
     *         'default' => 'Hello',
     *         'primary_key' => '',
     *         'unique_key' => '',
     *     ],
     * ],
     * @endcode
     *
     */

    public function dbCreateTable($tableName, $tableSchema, $tablePrefix = '')
    {
        if (!empty($tablePrefix)) {
            if ($this->getDbPrefix() == null) {
                $this->setDbPrefix($tablePrefix);
            }
        }

        $queryString = "CREATE TABLE IF NOT EXISTS " . $this->getDbPrefix() . $tableName." (";

        /*
        echo '<br /><pre>$tableSchema: ';
        echo print_r($tableSchema);
        echo '</pre><br />';
        //exit;
        //*/
        
        foreach ($tableSchema as $key) {
            
            /*
            echo '<br /><pre>$key: ';
            echo print_r($key);
            echo '</pre><br />';
            //exit;
            //*/

            $queryString .= " `" . $key['name'] . "` " . $key['type'];

            if ($key['unsigned'] == '1') {
                $queryString .= " UNSIGNED";
            }
            
            if ($key['not_null'] == '1') {
                $queryString .= " NOT NULL";
            }

            if ($key['autoincrement'] == '1') {
                $queryString .= " AUTO_INCREMENT";
            }

            if (!empty($key['default'])) {
                $queryString .= " DEFAULT " . $key['default'];
            }

            if ($key['index_key'] == '1') {
                $index_key = $key['name'];
            }

            if ($key['unique_key'] == '1') {
                $unique_keys[] = $key['name'];
            }
            
            if ($key['primary_key'] == '1') {
                $primary_key = $key['name'];
            }

            if (!empty($key['foreign_key'])) {
                $foreign_key = $key['name'];
                $reference_key = $key['foreign_key'];
            }
            
            $queryString .= ",";

        }

        $queryString = substr($queryString, 0, -1);

        if (!empty($index_key)) {
            $queryString .= ", INDEX (" . $index_key . ")";
        }

        if (!empty($unique_keys)) {
            // Create UNIQUE KEY
            $queryString .= ", UNIQUE KEY (";
        
            foreach ($unique_keys as $unique_key) {
                $queryString .= $unique_key . ',';
            }
        
            $queryString = substr($queryString, 0, -1);
            $queryString .= ")";
        }
        
        if (!empty($primary_key)) {
            $queryString .= ", PRIMARY KEY (" . $primary_key . ")";
        }

        if (!empty($foreign_key)) {
            $queryString .= ", FOREIGN KEY (" . $foreign_key . ") REFERENCES (" . $reference_key . ")";
        }
        
        $queryString .= ");";
        
        /*
        echo '<br />$queryString is: ' . $queryString . '<br />';
        //exit;
        //*/

        try {
            $dbStmt = $this->connection->query($queryString);
            return true;
        }
        catch (\PDOException $e)
        {
            return false;
        }
        
        /*
        echo '<br /><pre>$dbStmt: ';
        echo var_dump($dbStmt);
        echo '</pre><br />';
        //exit;
        //*/
    }

    public function dbAlterTable($table_name, $statement)
    {
        if (!empty($tablePrefix)) {
            if ($this->getDbPrefix() == null) {
                $this->setDbPrefix($tablePrefix);
            }
        }

        $queryString = "ALTER TABLE " . $this->getDbPrefix() . $table_name . " " . $statement;
        
        /*
        echo '<br />$queryString is: ' . $queryString . '<br />';
        //exit;
        //*/
        
        try {
            $dbStmt = $this->connection->query($queryString);
            return true;
        }
        catch (\PDOException $e)
        {
            /*
            echo '<br /><pre>$e: ';
            echo var_dump($e);
            echo '</pre><br />';
            //exit;
            //*/
            return false;
        }
        
        /*
        echo '<br /><pre>$dbStmt: ';
        echo var_dump($dbStmt);
        echo '</pre><br />';
        //exit;
        //*/
    }

    /**
	 * Select data from the database
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
	 * Example selecting data from the database:
	 * @code
	 * $sql->dbSelect('links', 'label, url', 'id > :id AND active = :active', ['id' => inval(5), 'active' => intval(2)], 'ORDER BY link_order');
	 * $result = $sql->dbFetch();
	 * @endcode
	 *
	 * @todo: Re-evaluate using Aura.SQL Query Objects
	 */

    public function dbSelect($queryTableName, $queryWhatClause = "*", $queryWhereClause = null, $queryBindValues = null, $queryAdditionalClauses = null)
    {
        $queryText = 'SELECT ' . $queryWhatClause . ' FROM ' . $this->getDbPrefix() . $queryTableName;

        if (isset($queryWhereClause)) {
            $queryText .= ' WHERE ' . $queryWhereClause;
        }

        if (isset($queryAdditionalClauses)) {
            $queryText .= ' ' . $queryAdditionalClauses;
        }

        if (isset($queryBindValues)) {
            $bindValues = $queryBindValues;
        }

        $this->setQueryText($queryText);
        $this->setBindValues($bindValues);
    }

    /**
     * Fetches result set.
     *
     * @param string $fetchType
     *     Type of fetch you would like to perform:
     *         1. **all**: Returns a sequential array of all rows. The rows themselves are associative arrays where the keys are the column names
     *         2. **assoc**: Returns an associative array of all rows where the key is the first column
     *         3. **col**: Returns a sequential array of all values in the first column
     *         4. **one**: Returns the first row as an associative array where the keys are the column names
     *         5. **pairs**: Returns an associative array where each key is the first column and each value is the second column
     *         6. **value**: Returns the value of the first row in the first column
     *
     * @return Returns result set depending on $fetchType, false if no matching $fetchType
     */

    public function dbFetch($fetchType = 'all')
    {

        switch ($fetchType) {
            case 'all':
                return $this->connection->fetchAll($this->getQueryText(), $this->getBindValues());
            case 'assoc':
                return $this->connection->fetchAssoc($this->getQueryText(), $this->getBindValues());
            case 'col':
                return $this->connection->fetchCol($this->getQueryText(), $this->getBindValues());
            case 'one':
                return $this->connection->fetchOne($this->getQueryText(), $this->getBindValues());
            case 'pairs':
                return $this->connection->fetchPairs($this->getQueryText(), $this->getBindValues());
            case 'value':
                return $this->connection->fetchValue($this->getQueryText(), $this->getBindValues());
            default:
                return false;
        }
    }

    /**
     *
     * @param string $tableName
     *     Name of the table you want to insert into (Without the table prefix! Axis will add this for you)
     * @param array $tableColumns
     *     An array of 'column' => 'value' pairs (See example below)
     * @param string $tablePrefix
     *     The table prefix you want to use (Axis will add this for you)
     *
     * @return mixed Returns the last ID inserted on the connection
     *
     * Example: $tableColumns
     * @code
     * $tableColumns = [
     *     'first_name' => 'John',
     *     'last_name' => 'Doe',
     * ];
     * @endcode
     */

    public function dbInsert($tableName, $tableColumns, $tablePrefix = '')
    {
        if (!empty($tablePrefix)) {
            if ($this->getDbPrefix() == null) {
                $this->setDbPrefix($tablePrefix);
            }
        }

        $prefixedTableName = $this->getDbPrefix() . $tableName;

        $result = $this->connection->insert($prefixedTableName, $tableColumns);

        // Save this for PostgreSQL implementation
        //$id = $connection->lastInsertId($table, 'id');

        return $result;
    }

    /**
     * Update Table Rows
     *
     * @param string $tableName
     * @param array $tableColumns
     * @param string $conditions
     * @param array $bind
     * @param string $tablePrefix
     *
     * @return integer Number of rows affected
     *
     * @todo: Document with examples
     */

    public function dbUpdate($tableName, $tableColumns, $conditions, $bind, $tablePrefix = '') {
        if (!empty($tablePrefix)) {
            if ($this->getDbPrefix() == null) {
                $this->setDbPrefix($tablePrefix);
            }
        }

        $prefixedTableName = $this->getDbPrefix() . $tableName;

        $result = $this->connection->update($prefixedTableName, $tableColumns, $conditions, $bind);

        return $result;
    }

    /**
     * Delete Table Rows
     *
     * @param string $tableName
     * @param string $conditions
     * @param array $bind
     * @param string $tablePrefix
     *
     * @return integer Number of rows affected
     *
     * @todo: Document with examples
     */

    public function dbDelete($tableName, $conditions, $bind, $tablePrefix = '') {
        if (!empty($tablePrefix)) {
            if ($this->getDbPrefix() == null) {
                $this->setDbPrefix($tablePrefix);
            }
        }

        $prefixedTableName = $this->getDbPrefix() . $tableName;

        $result = $this->connection->delete($prefixedTableName, $conditions, $bind);

        return $result;
    }

    /*
     * Database connection methods
     */

    /**
     * Connects to database server and selects database.
     *
     * Db::__construct will do this for you if 'dbConnection.php' exists.
     *
     * Db::__construct should be the only one using this method.
     *
     * @param string $dbAdapter
     *     Database adapter name: i.e. MySQL = mysql
     * @param string $dbHost
     *     IP or hostname of the database server
     * @param string $dbDbName
     *     Database name
     * @param string $dbUser
     *     Database Username
     * @param string $dbPassword
     *     Database Password
     *
     * @return object
     *
     * Example: Manually creating 'lazy-connect' connection (Should not have to instantiate a new Db object. Use Axis $sql Db object, which is already available to you):
     * @code
     * $sql = new Acms\Core\Data\Db;
     * $sql->dbConnect(
     *     $dbAdapter,
     *     $dbHost,
     *     $dbDatabase,
     *     $dbUserName,
     *     $dbPassword
     * );
     * @endcode
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

        $connection_factory = new \Aura\Sql\ConnectionFactory();
        $this->connection = $connection_factory->newInstance(

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
    }

    /**
     * Actively create database connection.
     *
     * A good way to test database connectivity.
     *
     * @return true | exception Returns true if database connection is successful, PDOException if database connection fails.
     *
     * Example:
     * @code
     * $sql = new Acms\Core\Data\Db;
     * $sql->dbConnect(); // Needed to create active connection. Creates lazy-load connection. Will only create active connection once a query is executed.
     *
     * try {
     *     $sql->dbActiveConnect();
     *     // Active connection success
     * }
     * catch (PDOException $e) {
     *     // Active connection failed
     *     // Handle exception
     * }
     *
     * // Continue script...
     *
     * @endcode
     */

    public function dbActiveConnect()
    {
        $this->connection->connect();
    }

    /**
     * Tests for valid database connection.
     *
     * A good way to test database credentials.
     *
     * @return true | exception Returns true if database connection is successful, PDOException if database connection fails.
     *
     * Example:
     * @code
     * $sql->dbConnect(); // Needed to create active connection. Creates lazy-load connection. Will only create active connection once a query is executed.
     *
     * try {
     *     $sql->dbValidConnection();
     *     // Active connection success
     *     $validConnection = 1;
     * }
     * catch (PDOException $e) {
     *     // Active connection failed
     *     $validConnection = '';
     * }
     *
     * // Continue script...
     *
     * @endcode
     */

    public function dbValidConnection()
    {
        $pdo = null;
        try {
            $pdo = $this->connection->getPdo();
            return true;
        } catch (\PDOException $e) {
            // Continue on failure
            return false;
        }
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
    private $connection;
    private $queryText;
    private $bindValues;
    private $result;

    /**
     * Initialize all class variables to null
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
        $this->connection = null;
        $this->queryText = null;
        $this->bindValues = null;
        $this->result = null;
    }

    /*
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
     * =setDbconnection
     *
     * @todo:: Finish converting to Aura.Sql
     */
    public function setDbconnection($dbAdapter = null)
    {
        if ($dbAdapter == null) {
            $dbAdapter = $this->getDbAdapter();
        }

        $this->connection = NewADOConnection($dbAdapter);
    }

    /**
     * =getDbconnection
     */
    public function getDbconnection()
    {
        return $this->connection;
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
     * @todo: Do I implement this, or get rid of it?
     */
    public function setDbResult($dbResult)
    {
        $this->result = $dbResult;
    }

    /**
     * =getDbResult
     *
     * @todo: Do I implement this, or get rid of it?
     */
    public function getDbResult()
    {
        return $this->result;
    }
}

/** @} */ // End group database */
