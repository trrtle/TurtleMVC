<?php
/**
 * controllers/Users.php - Handles User related logic.
 *
 * @package    TurtleMVC-Addons
 * @subpackage TurtleMVC-Users
 * @license    https://opensource.org/licenses/BSD-3-Clause
 * @author     Micky Aarnoudse
 * @copyright  2020 Micky Aarnoudse
 */


// always use plurals for controllers
class Users extends Controller {

        private $userModel;

    public function __construct(){
        $this->userModel = $this->model("User");
    }

    public function register(){
        // check for POST
        if($_SERVER["REQUEST_METHOD"] == 'POST'){

            // Sanitize POST data. 1. call htmlspecialchars() on entire array. 2. set every value as a string
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            // process form
            $data =[
                'username'=>trim($_POST["username"]),
                'email'=>trim($_POST["email"]),
                'secret'=>$_POST["secret"],
                'secret_confirm'=>$_POST["secret_confirm"],
                'username_err'=>'',
                'email_err'=>'',
                'secret_err'=>'',
                'secret_confirm_err'=>''
            ];

            // validate user input
            if(empty($data["username"])){
                $data["username_err"] = "Please fill in your username";
            }elseif ($this->userModel->findUserByUsername($data['username'])){
                $data["username_err"] = "Username already exists";
            }

            if(empty($data["email"])){
                $data["email_err"] = "Please fill in your email address";
            }elseif ($this->userModel->findUserByEmail($data['email'])){
                $data["email_err"] = "Email already exists";
            }

            if(empty($data["secret"])){
                $data["secret_err"] = "Please fill your password";
            }elseif (strlen($data['secret']) < 6 ){
                $data["secret_err"] = "Password should be atleast 6 characters";
            }
            if(empty($data["secret_confirm"])){
                $data["secret_confirm_err"] = "Please confirm your password";
            }elseif ($data['secret'] !== $data["secret_confirm"]){
                $data["secret_confirm_err"] = "Passwords do not match";
            }

            // check if errors are empty
            if(empty($data['username_err']) && empty($data['email_err'])
                && empty($data['secret_err']) && empty($data['secret_confirm_err'])){

                // Hash password
                $data['secret'] = password_hash($data['secret'], PASSWORD_DEFAULT);

                // Register user
                if($this->userModel->registerUser($data)){
                    $_SESSION["flash"] = new Flash("Registration complete!");
                    redirect("/Users/login");
                }else{
                    die("Something went wrong");
                }

            }else{
                // load page with erros
                $this->view("Users/register", $data);
            }

        }else{
            // initialize form
            $data =[
                'username'=>'',
                'email'=>'',
                'secret'=>'',
                'secret_confirm'=>'',
                'username_err'=>'',
                'email_err'=>'',
                'secret_err'=>'',
                'secret_confirm_err'=>''
            ];

            $this->view('/Users/register', $data);
        }

    }

    public function login(){
        // check for POST
        if($_SERVER["REQUEST_METHOD"] == 'POST'){

            // Sanitize POST data. 1. call htmlspecialchars() on entire array. 2. set every value as a string
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // process form
            $data =[
                'username'=>trim($_POST['username']),
                'secret'=>$_POST['secret'],
                'username_err'=>'',
                'secret_err'=>'',
            ];

            // validate user input
            if(empty($data["username"])){
                $data["username_err"] = "Please fill in your username or email";
            }
            if(empty($data["secret"])){
                $data["secret_err"] = "Please fill in your password";
            }

            // check if errors are empty
            if(empty($data['username_err']) && empty($data['secret_err'])){

                // try logging in
                $loggedInUser = $this->userModel->login($data['username'], $data['secret']);

                if($loggedInUser){

                    $this->createUserSession($loggedInUser);

                }else{

                    // if password or username is incorrect load login with errors.
                    $data['username_err'] = 'Credentials are incorrect';
                    $data['secret_err'] = 'Credentials are incorrect';
                    $this->view('/Users/login', $data);
                }

            }else{
                // load page with erros
                $this->view("Users/login", $data);
            }

        }else{
            // initialize form
            $data =[
                'username'=>'',
                'secret'=>'',
                'username_err'=>'',
                'secret_err'=>'',
            ];

            $this->view('/Users/login', $data);
        }

    }

    public function createUserSession($user){
        $_SESSION['id'] = $user->id;
        $_SESSION['email'] = $user->email;
        $_SESSION['username'] = $user->username;
        redirect("pages/index");
    }

    public function logout(){
        unset($_SESSION['id']);
        unset($_SESSION['email']);
        unset($_SESSION['username']);
        redirect("users/login");
    }

    public function isLoggedIn(){
        if(isset($_SESSION['id']) && isset($_SESSION['email'])){
            return true;
        }
        else{
            return false;
        }
    }
}