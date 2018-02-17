<?php
ob_start();
$returnTop = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title="Event Subscribtion";
    $caption="";
    require_once 'includes/init.php';
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $faculty = filter_var($_POST['Faculty'], FILTER_SANITIZE_STRING);
    $semester = filter_var($_POST['semester'], FILTER_SANITIZE_NUMBER_INT);
    $email = filter_var($_POST['mail'], FILTER_SANITIZE_STRING);
    $facebook = filter_var($_POST['profile'], FILTER_SANITIZE_STRING);
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
    $membership = filter_var($_POST['member'], FILTER_SANITIZE_STRING);
    $id = filter_var(intval($_POST['id']), FILTER_SANITIZE_NUMBER_INT);
    $query = $con->prepare("INSERT INTO `attendees` (`name`,`faculty`, `semester`, `email`, `facebook_profile`, `mobile`, `membership_type`, `event_id`) VALUES (?,?,?,?,?,?,?,?)");
    $query->execute(array($name, $faculty, $semester, $email, $facebook, $mobile, $membership, $id));
    if ($query->rowCount() > 0) { ?>
        <div class="text-success text-center" style="margin: 10px 0;display: flex;flex-direction: column;justify-content: center;"><i class="fa-5x fa fa-check-circle-o"></i>
            <p class="lead">Success</p></div>
    <?php
    } else { ?>
        <div class="alert alert-danger">Sorry Something Went Wrong, Please Try Again.</div>
    <?php }
} else {
    if (isset($_GET['id'])) {
        $title="Event Subscribtion";
        require_once 'includes/connect.php';
        $id = $_GET['id'];
        $query=$con->prepare("SELECT `id`, `title` FROM events WHERE id=?");
        $query->execute(array($id));
        $name = $query->fetchAll(PDO::FETCH_ASSOC)[0]['title'];
        $caption="<h2>".ucfirst($name)."</h2>";
        $title='contact-login contact';
        require_once 'partials/header.html';
    if ($query->rowCount() > 0) { ?>
        <section class="sign-up-form">

            <div class="container">

                <div class="section-content">
                    <h3>Please Fill The Form Below</h3>
                    <div class="um um-register um-2881">

                        <div class="um-form">

                            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

                                <!--<p class="um-notice err">Registration is currently disabled</p>-->
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="um-row _um_row_1 " style="margin: 0 0 30px 0;">

                                    <div class="um-col-1">

                                        <div class="um-field um-field-user_login um-field-text" data-key="user_login">

                                            <div class="um-field-label">
                                                <label for="user_login-2881">Name
                                                </label>

                                                <div class="um-clear">
                                                </div>
                                            </div>

                                            <div class="um-field-area">
                                                <input autocomplete="off" class="um-form-field valid " type="text" name="name" id="name" value="" placeholder="" data-validate="unique_username" data-key="user_login" required/>
                                            </div>
                                        </div>

                                        <div class="um-field um-field-first_name um-field-text" data-key="first_name">

                                            <div class="um-field-label">
                                                <label for="first_name-2881">Faculty
                                                </label>

                                                <div class="um-clear">
                                                </div>
                                            </div>

                                            <div class="um-field-area">
                                                <input autocomplete="off" class="um-form-field valid " type="text" name="Faculty" id="Faculty" value="" placeholder="" data-validate="" data-key="first_name" required/>
                                            </div>
                                        </div>

                                        <div class="um-field um-field-last_name um-field-text" data-key="last_name">

                                            <div class="um-field-label">
                                                <label for="last_name-2881">Academic Semester
                                                </label>

                                                <div class="um-clear">
                                                </div>
                                            </div>

                                            <div class="um-field-area">
                                                <input autocomplete="off" class="um-form-field valid " type="number" min="1" max="20" name="semester" id="Semester" value="" placeholder="" data-validate="" data-key="last_name" required/>
                                            </div>
                                        </div>

                                        <div class="um-field um-field-user_email um-field-text" data-key="user_email">

                                            <div class="um-field-label">
                                                <label for="user_email-2881">E-mail Address
                                                </label>

                                                <div class="um-clear">
                                                </div>
                                            </div>

                                            <div class="um-field-area">
                                                <input autocomplete="off" class="um-form-field valid " type="text" name="mail" id="mail" value="" placeholder="" data-validate="unique_email" data-key="user_email" required/>
                                            </div>
                                        </div>
                                        <div class="um-field um-field-user_email um-field-text" data-key="user_email">

                                            <div class="um-field-label">
                                                <label for="user_mobile-2881">Your Name In Facebook
                                                </label>

                                                <div class="um-clear">
                                                </div>
                                            </div>

                                            <div class="um-field-area">
                                                <input autocomplete="off" class="um-form-field valid " type="text" name="profile" id="profile" value="" placeholder="" data-validate="membership-id" data-key="user_membership-id" required min="0" max="" />
                                            </div>
                                        </div>
                                        <div class="um-field um-field-user_email um-field-text" data-key="user_email">

                                            <div class="um-field-label">
                                                <label for="user_email-2881">Mobile Number
                                                </label>

                                                <div class="um-clear">
                                                </div>
                                            </div>

                                            <div class="um-field-area">
                                                <input autocomplete="off" class="um-form-field valid " type="number" min="0" name="mobile" id="Mobile" value="" placeholder="" data-validate="membership-id" data-key="user_membership-id" required min="0" max="" />
                                            </div>
                                        </div>

                                        <div class="container">
                                            <div class="radio">
                                                <input id="radio-1" value="1" name="member" type="radio" checked>
                                                <label for="radio-1" class="radio-label">Member</label>
                                            </div>

                                            <div class="radio">
                                                <input id="radio-2" value="0" name="member" type="radio">
                                                <label for="radio-2" class="radio-label">Non Member</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="um-col-alt">

                                    <div class="register scl">
                                        <input type="submit" value="Send" class="um-button" />
                                    </div>

                                    <div class="um-clear">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php $title='';?>
        <script src="js/events-form.js"></script>
    <?php
    } else {
        header("refresh:0;url=events.php");
        exit();
    } ?>

<?php } else {
        header("refresh:0;url=events.php");
        exit();
    }
    }
require_once 'partials/footer.html';
ob_end_flush();
?>