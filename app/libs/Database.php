<?php

/**
 * libs/Database.php - General database class
 *
 * @package    TurtleMVC-Core
 * @license    https://opensource.org/licenses/BSD-3-Clause
 * @author     Micky Aarnoudse
 * @copyright  2020 Micky Aarnoudse
 */

/**
 * General Database class
 *
 * Create a database connection using PDO
 * Create prepared statements
 * Bind Values
 * Return rows and results
 * count returned rows
 *
 * @property string $db_host- Database host. set in app/config/config.php
 * @property string $db_user - Database username. set in app/config/config.php
 * @property string $db_secret - Database user password. set in app/config/config.php
 * @property string $db_name - Database name. set in app/config/config.php
 *
 * @property string $dsn - contains the information required to connect to the database.
 * @property string $stmt - contains the prepared statement.
 * @property string error - contains an PDO exception message
 */

class Database{
    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_secret = DB_SECRET;
    private $db_name = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        // set dsn & options
        $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        // create a PDO instance
        try{
            $this->dbh = new PDO($dsn, $this->db_user, $this->db_secret, $options);
        }catch (PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    /**
     * Prepare the given SQL statement
     *
     * @param string $sql - SQL query
     * @return void
     */
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Bind values to the prepared statement
     *
     * @param string $param - the :placeholder where the value must be bind to.
     * @param string|int|bool|null $value - the value that must be bind to the statement
     * @param static $type (optional) - PDO value type static
     * @return void
     */
    public function bind($param, $value, $type = null){

        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * excecute the prepared statement.
     *
     * @return bool
     */
    public function execute(){
        return $this->stmt->execute();
    }

    /**
     * Get an array from query result
     *
     * @return object - Returns an object containing all of the result set rows
     */
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     * Get an array from query result
     *
     * @return object - Fetches the next row of the result set
     */
    public function resultRow(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Counts the amount of rows from an PDO object
     *
     * @return int - Amount of rows
     */
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}