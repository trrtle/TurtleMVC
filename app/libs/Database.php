<?php
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
        // set dsn
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

}