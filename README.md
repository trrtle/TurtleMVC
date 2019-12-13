# Quick start

For more information ***<a href="https://github.com/trrtle/TurtleMVC/wiki">go to the wiki</a>***

## <a name="config">Download & Configuration</a>
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
