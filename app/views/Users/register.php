<?php
/**
 * inc/register.php - Page where a user can be created.
 *
 * @package    TurtleMVC-Core
 * @license    https://opensource.org/licenses/BSD-3-Clause
 * @author     Micky Aarnoudse
 * @copyright  2020 Micky Aarnoudse
 * @uses bootstrap4
 */

require APPROOT . "/views/inc/header.php"
/** @var array $data */
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Create an account</h2>
            <p>Please fill in this form to register with us</p>
            <form action="<?php echo URLROOT?>users/register" method="POST">
                <div class="form-group">
                    <label for="username">Username<sup>*</sup></label>
                    <input type="text" name="username" class="form-control form-control-lg
                    <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['username']; ?>">
                    <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email <sup>*</sup></label>
                    <input type="email" name="email" class="form-control form-control-lg
                    <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="secret">Password <sup>*</sup></label>
                    <input type="password" name="secret" class="form-control form-control-lg
                    <?php echo (!empty($data['secret_err'])) ? 'is-invalid' : ''; ?>" value="">
                    <span class="invalid-feedback"><?php echo $data['secret_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="secret_confirm">Confirm password <sup>*</sup></label>
                    <input type="password" name="secret_confirm" class="form-control form-control-lg
                    <?php echo (!empty($data['secret_confirm_err'])) ? 'is-invalid' : ''; ?>" value="">
                    <span class="invalid-feedback"><?php echo $data['secret_confirm_err']; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-block">Register</button>
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT?>users/login"><button type="button" class="btn btn-light">Already have an account?</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . "/views/inc/footer.php"?>
