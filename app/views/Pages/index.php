<?php
/**
* pages/index.php - placeholder index page
*
* @package    TurtleMVC-Core
* @license    https://opensource.org/licenses/BSD-3-Clause
* @author     Micky Aarnoudse
* @copyright  2020 Micky Aarnoudse
*/
?>
<?php

require APPROOT . "/views/inc/header.php"
/** @var array $data */
?>

<h1><?php echo $data["title"]; ?></h1>
<hr>
<p>This is the TurtleMVC PHP framework please refer to the readme on Github: <a href="https://github.com/trrtle/TurtleMVC" target="_blank">https://github.com/trrtle/TurtleMVC </a></p>

<?php require APPROOT . "/views/inc/footer.php"?>