# TurtleMVC
a PHP MVC framework 

Welcome to the TurtleMVC wiki!

* [What is a MVC framework?](#whatismvc)
  - [View](#view)
  - [Controller](#controller)
  - [Model](#model)
* [Getting started](#getstarted)
  - [Download & Configuration](#config)

## <a name="whatismvc"> What is a MVC framework? </a>


MVC stands for Model View Controller.
it is a building pattern that separates an application into three main components: The model, the view and the controller.
Each of these components are built to handle a specific tasks of an application. MVC is one of the most used web development
frameworks to create scalable and extensible projects.

### <a name="view">View</a>
The View component is used for all the UI logic of the application. This component is what the user sees and interacts with.

### <a name="controller">Controller</a>
The controller is the middle man. It controls which view will be loaded and the kind of data is being send with it.

### <a name="model">Model</a>
The model component handels all the data related logic that the user works with. For example, a user object wil retrieve all the user information from the database, manipulate it in the view and update it back to the database or use it to render data.

## <a name="getstarted">Getting started</a>
this part is still under construction.

### <a name="config">Download & Configuration</a>
1. download the archive and unzip in your projects directory.
2. edit the following line in file: public/.htaccess 
  ```
  RewriteBase /_YOUR_PROJECT_DIR_/public
  ```
3. then edit the database configuration in the file: app/config/config.php
```
define('DB_HOST', "YOUR_DB_HOST");
define('DB_USER', '_YOUR_USER_');
define('DB_SECRET', '_YOUR_PASSWORD_');
define('DB_NAME', '_YOUR_DB_NAME_');
```
4. last but not least edit the following lines in the same file: app/config/config.php
```
// URL root example: localhost/TurtleMVC/
define("URLROOT", "__YOUR_URL_)");
// Site name
define("SITENAME", "_YOUR_SITE_NAME_");
```
Configuration done!
