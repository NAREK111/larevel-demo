<?php
session_start();
?>
<div class="row">

    <div class="col-md-offset-4 col-md-4">
        <form action="/user/register" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="firstName"
                               value="<?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : ''; ?>"
                               type="text" class="form-control" placeholder="First name">
                        <?php
                        if (isset($_SESSION['error_firstname'])) {
                            ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['error_firstname']; ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="lastName"
                               value="<?php echo isset($_SESSION['lastname']) ? $_SESSION['lastname'] : ''; ?>"
                               type="text" class="form-control" placeholder="Last name">
                        <?php
                        if (isset($_SESSION['error_lastname'])) {
                            ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['error_lastname']; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input name="email" id="email"
                       value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" type="email"
                       class="form-control" placeholder="Enter email">
                <?php
                if (isset($_SESSION['error_email'])) {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error_email']; ?>
                    </div>
                <?php } ?>
                <?php
                if (isset($_SESSION['error_emptyEmail'])) {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error_emptyEmail']; ?>
                    </div>
                <?php } ?>

                <?php if (isset( $_SESSION['Email_repeat'])) {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo  $_SESSION['Email_repeat']; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Password">
                <?php
                if (isset($_SESSION['error_password'])) {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error_password']; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="form-group">
                <input name="conf" type="password" class="form-control" placeholder="Confirm-Password">
                <?php
                if (isset($_SESSION['error_conf_password'])) {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error_conf_password']; ?>
                    </div>

                    <?php } ?>
                <?php
                if (isset($_SESSION['pass_error'])) {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['pass_error']; ?>
                    </div>
                <?php } ?>
            </div>
            <label class="form-check-label">
                <input class="form-check-input" <?php echo $_SESSION['gender'] == 'female' ? 'checked' : ''; ?>
                       type="radio" name="gender" id="inlineRadio1" value="female">Female
            </label>
            <label class="form-check-label">
                <input class="form-check-input" <?php echo $_SESSION['gender'] == 'male' ? 'checked' : ''; ?>
                       type="radio" name="gender" id="inlineRadio2" value="male">Male
            </label>
            <br>
            <input type="submit" value="Register"><br>

        </form>
        <br><br>
    </div>
</div>