<?php
/**
 * models/User.php - Handels user related database interaction.
 *
 * @package    TurtleMVC-Core
 * @license    https://opensource.org/licenses/BSD-3-Clause
 * @author     Micky Aarnoudse
 * @copyright  2020 Micky Aarnoudse
 */

/**
 * User model class  - Handels user related database interaction
 *
 * Creates database connection.
 * Register a user
 * User login
 * Search database for User by username, email or both.
 *
 * @property object $db - Database() object.
 */

class User{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * @method registerUser - Register a user
     *
     * 1. Prepares insert statement.
     * 2. Binds insert statement.
     * 3. execute insert statement.
     *
     * @param array $credentials - array with the following creds: username, email, secret.
     *
     * @return bool
     */
    public function registerUser($credentials){
        // prepare statement
        $this->db->query("INSERT INTO users (username, email, secret) VALUES (:username, :email, :secret)");

        // bind values
        $this->db->bind(':username', $credentials['username']);
        $this->db->bind(':email', $credentials['email']);
        $this->db->bind(':secret', $credentials['secret']);

        // execute statement
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @method login - Login a user
     *
     * 1. Searches for user in the db.
     * 2. if user is found checks if given password match.
     *
     * @param string $username - Username of the user that tries to login
     * @param string $secret - Password of the user that tries to login
     *
     * @return bool
     */
    public function login($username, $secret){
        // search if the user exists
        $row = $this->findUserByLogin($username);
        if($row){
            // check if passwords match
            if(password_verify($secret, $row->secret)){
                return $row;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * @method FindUserbyUsername;
     *
     * 1. prepares statement.
     * 2. binds values.
     * 3. stores result in $row
     * 4. checks if there are more than 0 rows returned
     *
     * @param string $username - Username that must be searched.
     *
     * @return bool
     */
    public function findUserByUsername($username){
        // prepare statement
        $this->db->query("SELECT * FROM users WHERE username = :username ;");
        // bind value
        $this->db->bind(":username", $username);
        // execute and get row
        $row = $this->db->resultRow();

        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @method FindUserbyEmail;
     *
     * 1. prepares statement.
     * 2. binds values.
     * 3. stores result in $row
     * 4. checks if there are more than 0 rows returned
     *
     * @param string $email - Email that must be searched.
     *
     * @return bool
     */
    public function findUserByEmail($email){
        // prepare statement
        $this->db->query("SELECT * FROM users WHERE email = :email ;");
        // bind value
        $this->db->bind(":email", $email);
        // execute and get row
        $row = $this->db->resultRow();

        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @method FindUserbyLogin;
     *
     * 1. prepares statement.
     * 2. binds values.
     * 3. stores result in $row
     * 4. checks if there are more than 0 rows returned
     *
     * @param string $login - Username OR email that must be searched.
     *
     * @return object - PDO row object.
     */
    public function findUserByLogin($login){
        // prepare statement
        $this->db->query("SELECT * FROM users WHERE username = :login OR email = :login ;");
        // bind value
        $this->db->bind(":login", $login);
        // execute and get row
        $row = $this->db->resultRow();

        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }


}