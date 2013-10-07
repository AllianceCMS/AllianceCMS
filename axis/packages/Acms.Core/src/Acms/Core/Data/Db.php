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
     *     (Should not be used in module/theme development)
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
                $dbStmt = self::$connection->query($queryString);
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
     *     (Should not be used in module/theme development)
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
     *         'column' => [
     *             'name' => 'id',
     *             'type' => 'int(11)',
     *             'not_null' => '1',
     *             'signed' => '0',
     *             'autoincrement' => '1',
     *             'default' => '',
     *             'primary_key' => '1',
     *             'unique_keys' => '',
     *         ],
     *     ],
     *     [
     *         'keys' => [
     *             'PRIMARY KEY (id)',
     *         ],
     *     ],
     * ];
     *
     * $tableSchema['0.01']['create']['table']['another_table'] = [
     *     [
     *         'column' => [
     *             'name' => 'id',
     *             'type' => 'int(11)',
     *             'not_null' => '1',
     *             'unsigned' => '1',
     *             'autoincrement' => '1',
     *             'default' => '',
     *         ],
     *     ],
     *     [
     *         'column' => [
     *             'name' => 'name',
     *             'type' => 'varchar(50)',
     *             'not_null' => '1',
     *             'unsigned' => '',
     *             'autoincrement' => '',
     *             'default' => '',
     *         ],
     *     ],
     *     [
     *         'keys' => [
     *             'PRIMARY KEY (id)',
     *             'UNIQUE KEY (name)',
     *         ],
     *     ],
     * ];
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

        foreach ($tableSchema as $key) {
            foreach ($key as $schema_key => $schema_value) {

                if ((string) $schema_key === (string) 'column') {

                    $queryString .= " `" . $schema_value['name'] . "` " . $schema_value['type'];

                    if ($schema_value['unsigned'] == '1') {
                        $queryString .= " UNSIGNED";
                    }

                    if ($schema_value['not_null'] == '1') {
                        $queryString .= " NOT NULL";
                    }

                    if ($schema_value['autoincrement'] == '1') {
                        $queryString .= " AUTO_INCREMENT";
                    }

                    if (!empty($schema_value['default'])) {
                        $queryString .= " DEFAULT " . $schema_value['default'];
                    }

                    $queryString .= ",";

                } elseif ((string) $schema_key === (string) 'keys') {

                    foreach ($schema_value as $db_key) {
                        $queryString .= ' ' . $db_key . ',';
                    }
                }
            }
        }

        $queryString = substr($queryString, 0, -1);

        $queryString .= ");";

        try {
            $dbStmt = self::$connection->query($queryString);
            return true;
        }
        catch (\PDOException $e)
        {
            return false;
        }
    }

    public function dbDropTable($tableName, $tablePrefix = '')
    {
        if (!empty($tablePrefix)) {
            if ($this->getDbPrefix() == null) {
                $this->setDbPrefix($tablePrefix);
            }
        }

        $queryString = 'DROP TABLE IF EXISTS ' . $this->getDbPrefix() . $tableName . ';';

        try {
            $dbStmt = self::$connection->query($queryString);
            return true;
        }
        catch (\PDOException $e)
        {
            return false;
        }
    }

    public function dbAlterTable($table_name, $statement)
    {
        if (!empty($tablePrefix)) {
            if ($this->getDbPrefix() == null) {
                $this->setDbPrefix($tablePrefix);
            }
        }

        $queryString = "ALTER TABLE " . $this->getDbPrefix() . $table_name . " " . $statement;

        try {
            $dbStmt = self::$connection->query($queryString);
            return true;
        }
        catch (\PDOException $e)
        {
            return false;
        }
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
                return self::$connection->fetchAll($this->getQueryText(), $this->getBindValues());
            case 'assoc':
                return self::$connection->fetchAssoc($this->getQueryText(), $this->getBindValues());
            case 'col':
                return self::$connection->fetchCol($this->getQueryText(), $this->getBindValues());
            case 'one':
                return self::$connection->fetchOne($this->getQueryText(), $this->getBindValues());
            case 'pairs':
                return self::$connection->fetchPairs($this->getQueryText(), $this->getBindValues());
            case 'value':
                return self::$connection->fetchValue($this->getQueryText(), $this->getBindValues());
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
     *
     * $sql->dbInsert('users', $tableColumns);
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

        $result = self::$connection->insert($prefixedTableName, $tableColumns);

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

    public function dbUpdate($tableName, $tableColumns, $conditions, $bind, $tablePrefix = '')
    {
        if (!empty($tablePrefix)) {
            if ($this->getDbPrefix() == null) {
                $this->setDbPrefix($tablePrefix);
            }
        }

        $prefixedTableName = $this->getDbPrefix() . $tableName;

        $result = self::$connection->update($prefixedTableName, $tableColumns, $conditions, $bind);

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

    public function dbDelete($tableName, $conditions = null, $bind = array(), $tablePrefix = '') {
        if (!empty($tablePrefix)) {
            if ($this->getDbPrefix() == null) {
                $this->setDbPrefix($tablePrefix);
            }
        }

        $prefixedTableName = $this->getDbPrefix() . $tableName;

        $result = self::$connection->delete($prefixedTableName, $conditions, $bind);

        return $result;
    }

    public function dbLastInsertId()
    {
        return self::$connection->lastInsertId();
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

        $connectionFactory = new \Aura\Sql\ConnectionFactory();
        self::$connection = $connectionFactory->newInstance(

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

        $this->unsetConnectionVars();
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
        self::$connection->connect();
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
            $pdo = self::$connection->getPdo();
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
    static private $connection;
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
        self::$connection = null;
        $this->queryText = null;
        $this->bindValues = null;
        $this->result = null;
    }

    private function unsetConnectionVars()
    {
        unset($this->dbAdapter);
        unset($this->dbHost);
        unset($this->dbUser);
        unset($this->dbPassword);
        unset($this->dbName);
        unset($this->dbPersistent);
        unset($this->dbActive);
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
        if (isset($this->dbAdapter))
            return $this->dbAdapter;

        return null;
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

        self::$connection = NewADOConnection($dbAdapter);
    }

    /**
     * =getDbconnection
     */
    public function getDbconnection()
    {
        return self::$connection;
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
