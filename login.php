<?php
ob_start();
session_start();
$title = 'login';
$caption = '<h2>Sign in</h2>';
$returnTop = false;
$noBtns = true;

if(isset($_SESSION["name"])){
    header("Location: index.php");
    exit();
}

$error = false;

require_once 'includes/init.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $query = $con->prepare('SELECT * FROM users Where username = ? and password = ?');
    $query->execute(array($name,$pass));
    $row = $query->fetchAll(PDO::FETCH_ASSOC)[0];
    $count = $query->rowCount();
    if ($count > 0) {

        $_SESSION["name"] = $row['name'];
        $_SESSION["ID"] = intval($row["id"]);
        $_SESSION['admin'] = intval($row['admin']);
        header("Location: index.php");
        exit();
//        print_r($_SESSION);
//        print_r($row);
//        echo var_dump($_SESSION['admin']);
    } else {
        $error = true;
    }
echo $error;
}
?>

    <section class="sign-in-form">

        <div class="container">

            <div class="section-content">
                <h3>Please Fill The Form Below</h3>

                <div class="um um-login um-2882">

                    <div class="um-form">

                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" autocomplete="off">

                            <div class="um-row _um_row_1 " style="margin: 0 0 30px 0;">

                                <div class="um-col-131">

                                    <div class="um-field um-field-username um-field-text" data-key="username">

                                        <div class="um-field-label">
                                            <label>Username or E-mail
                                            </label>

                                            <div class="clearfix">
                                            </div>
                                        </div>

                                        <div class="um-field-area">
                                            <input autocomplete="off" class="um-form-field valid " type="text" name="username" id="username-2882" value="" placeholder="" data-validate="unique_username_or_email" data-key="username" />
                                        </div>
                                    </div>

                                    <div class="um-field um-field-user_password um-field-password" data-key="user_password">

                                        <div class="um-field-label">
                                            <label>Password
                                            </label>

                                            <div class="clearfix">
                                            </div>
                                        </div>

                                        <div class="um-field-area">
                                            <input class="um-form-field valid " type="password" name="password" id="user_password-2882" value="" placeholder="" data-validate="" data-key="user_password" />
                                        </div>
                                    </div>
                                    <?php if ($error) { ?>
                                        <div class="alert alert-danger">Username/Password is not correct</div>
                                    <?php }?>
                                </div>

                                <div class="um-col-132">
                                </div>

                                <div class="um-col-133">
                                </div>

                                <div class="clearfix">
                                </div>
                            </div>
                            <input type="hidden" name="form_id" id="form_id" value="2882" />
                            <input type="hidden" name="timestamp" id="timestamp" value="1506685772" />

                            <div class="um-col-alt">

                                <div class="um-field um-field-c">

                                    <div class="um-field-area">
                                        <label class="um-field-checkbox active">
                                            <input type="checkbox" name="rememberme" value="1" checked />

                                            <span class="um-field-checkbox-option">
                                             Keep me signed in
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="clearfix">
                                </div>

                                <div class="um-left um-half scl">
                                    <input type="submit" value="Login" class="um-button" />
                                </div>

                                <div class="um-right um-half scl">
                                    <a href="register.html" class="um-button um-alt">Register</a>
                                </div>

                                <div class="clearfix">
                                </div>
                            </div>

                            <div class="um-col-alt-b col-xs-12 col-sm-12 col-md-12 col-lg-12"> <a href="forget-pass.html" class="um-link-alt">Forgot your password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
require_once 'partials/footer.html';
ob_end_flush();