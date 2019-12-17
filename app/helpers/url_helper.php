<?php
/**
 * helpers/url_helper.php - Helps with URL routing
 *
 * @package    TurtleMVC-Addons
 * @subpackage TurtleMVC-Helpers
 * @license    https://opensource.org/licenses/BSD-3-Clause
 * @author     Micky Aarnoudse
 * @copyright  2020 Micky Aarnoudse
 */

// redirects to URLROOT/$page
function redirect($page){
    header('Location: ' . URLROOT . $page);
}