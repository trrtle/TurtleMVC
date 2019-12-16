<?php

/**
 * libs/Database.php - General database class
 *
 * @package    TurtleMVC-Core
 * @license    https://opensource.org/licenses/BSD-3-Clause
 * @author     Micky Aarnoudse
 * @copyright  2020 Micky Aarnoudse
 */

/*
 * PDO Databae class
 * Connect to database
 * Create prepared statements
 * Bind values
 * Return rows and results
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
            echo $this->error;
        }
    }

    // Prepare statement with query
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind values
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

    //execute statement
    public function execute(){
        return $this->stmt->execute();
    }

    // get result in array of objects
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // get single result in object
    public function resultRow(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}