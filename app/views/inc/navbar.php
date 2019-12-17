<?php
/**
 * inc/navbar.php - navigation menu that is included on the header
 *
 * @package    TurtleMVC-Core
 * @license    https://opensource.org/licenses/BSD-3-Clause
 * @author     Micky Aarnoudse
 * @copyright  2020 Micky Aarnoudse
 * @uses bootstrap4
 */
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URLROOT;?>">
            <?php echo SITENAME;?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT;?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT . "pages/about";?>">About</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if(isset($_SESSION["id"]) && isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT . "users/logout";?>">logout</a>
                    </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT . "users/register";?>">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT . "users/login";?>">login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
