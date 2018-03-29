<?php
ob_start();
session_start();
$title = 'Mega Event';
$returnTop = false;
$caption = '<span class="tag">MEGA</span><h2>MEGA BRAIN TO BE \'18</h2><p>Bibliotheca Alexandrina | <span>23 , 24 , 25 JUNE 2018</span></p>';
$headerClass = 'events-single-hero';
require_once 'includes/init.php';
if (isset($_SESSION['admin']) && intval($_SESSION['admin']) === 1) {
    $admin = true;
} else {
    $admin = false;
}
?>
<section class="events-single-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
<h3>EVENT</h3>

<p>The human mind is one of the greatest miracles on the earth. There is a terrible amount of nerve cells in which each one has a certain role and which is performed perfectly. But despite this, you are putting pressure on some cells to learn things to be done in a routine way. And since you need more information about the different skills that help your mind to accomplish the tasks better. You need courses and workshops in which you’ll learn new things. But since it’s a special thing to find most of your field weapons joined in one place and starting from this idea we, IEEEPUASB, decided to create our first annual scientific conference which is (Mega Brain To Be). That means in every year we’ll be focusing on a certain skill so that we would benefit you with the largest amount of skills try to upgrade the human mind to the MEGA ( ultimate )which is 10 ^ 6. According to that, we present to you our genius character (Brainy) and every year he’ll be helping you raise your mind one Mega human unit.Starting this year with our first scientific conference we’ll achieve our vision and task by delivering to you through Sessions, Workshops and Skill fair.<br>
<br>
"School education will bring you a job either self-education will bring you a mind" - Albert Einstein<br>
We’ll be starting with self-learning, to obtain the first mega human unit through the first annual scientific conference of IEEE PUA SB and it will be different by all means. Helping you choose the field you love, away from your studies at the college and create your futures plan to complete and be able to study on your own in the field that you love aside from the skills you acquire and learn by yourself . we offer you more skills to help you complete your job and know all the requirements for your work in different fields<br>
And since when you teach yourself get more skills we’ll be providing you with the main keys of the self-learning that will help you achieve your goals and make you special in your field.<br>
<br>
The fees to attend the event are only EGP 50 include:<br>
1. Lunch break<br>
2. Certificate of attendee<br>
Location: Bibliotheca Alexandrina<br>
Date: 23-24-25 June</p>

<p class="arabic">العقل البشرى من اعظم المعجزات على الارض فيه كم رهيب من الخلايا العصبية اللى كل واحده فيهم ليها دور معين و بتقوم بيه على اكمل وجه لكن بالرغم من ده بتحتاج تجهد بعض الخلايا فى تعلم اشياء هتأديها بشكل روتينى -زى المواد اللى بتدرسها لفترة الامتحانات او روتين يوم عمل- ولانك بتحتاج معلومات اكتر عن ال Skills المختلفه تساعد عقلك على انجاز المهام بشكل افضل بتحتاج كورسات و دورات فى انك تتعلم اشياء جديدة مختلفه لكن الامر المختلف انك تلاقى معظم اسلحة مجالك متجمعين فى مكان واحد و من المنطلق ده قررنا و بكل فخر احنا IEEE PUA SB اننا نعمل اول مؤتمر سنوى علمى وهو <strong>Mega brain to be</strong> يعنى احنا كل سنه هنركز على skill معينه علشان نفيدك بأكبر كمية من ال skills الموجوده و نحاول نعلى بالعقل البشرى للميجا وهى 10^6 اخترنالكم شخصيتنا العبقرية <strong>Brainy</strong> وده اللى هيقدر كل سنة يرفع عقلك البشرى وحدة ميجا بشرية و السنادى هتكون بدايتنا بأول مؤتمر علمى هيكون لينا رؤية و مهمة لازم نوصلها ليكم من خلال Sessions و Workshops و Skill fair.<br>
    <br>
    "التعليم المدرسى سيجلب لك وظيفة اما التعليم الذاتى سيجلب لك عقلا"<br>
    البرت انشتاين و بدايتنا هتكون بالتعليم الذاتى <strong>"Self Learning"</strong> علشان نكون اخدنا اول وحدة ميجا بشرية من المؤتمر السنوى العلمى الاول لينا ك IEEE PUA SB اللى هتكون مختلفه من جميع النواحى هتعرف ازاى تختار المجال اللى انت بتحبه بعيداً عن دراستك فى الكلية و تحط خطتك المستقبلية علشان تكمل فيها و تقدر تدرس لوحدك المجال اللى انت بتحبه ده غير المهارات اللى هتكتسبها وانت بتعلم نفسك بنفسك .<br>
    <br>
    سعر التيكت لحضور الايفنت 50 جنيه فقط شاملة :<br>
    <span dir="ltr">1- Lunch break<br>
2- Certificate for attendee </span><br>
    المكان : مكتبة الاسكندرية<br>
    الميعاد : 23-24-25 يونيو</p>
</div>
                <?php
                if (isset($_SESSION['req'])) {
                    $r = $_SESSION['req'];
                    /*
                     * success : full success
                     * successEmailError : success but email failed to send
                     * error : Error Registeration
                     * duplicated : National ID exists
                     * unavailable : Problem Connecting to server
                     * */
                    switch ($r) {
                        case "success" :
                            $class = "alert-success";
                            $content = "Successfully Registered, Check Your Email";
                            break;
                        case "successEmailError" :
                            $class = "alert-warning";
                            $content = "Successfully Registered, Problem Sending Email";
                            break;
                        case "error" :
                            $class = "alert-danger";
                            $content = "Error Registering, Please Try Again.";
                            break;
                        case "duplicated" :
                            $class = "alert-warning";
                            $content = "You Have Already Registered Before.";
                            break;
                        case "unavailable" :
                            $class = "alert-danger";
                            $content = "Sorry, Registration is Not Available Now, Please Try Again Later.";
                            break;
                        default :
                            $class = "";
                            $content = "";
                            break;
                    }
                    ?>
                <div id="leave-page" class="alert h1 <?php echo $class;?>" style="position: fixed;top: -28px;left: 0;width: 100%;height: calc(100% + 28px);display: flex;justify-content: center;align-items: center;z-index: 9999;">
                    <?php echo $content; ?>
                    <script>
                        document.body.onload= function () {
                            setTimeout(function () {
                                $('#leave-page').fadeOut(400, function () {
                                    $(this).remove();
                                });
                            }, 2000);
                        }
                    </script>
                </div>
                <?php
                    $_SESSION['req'] = null;
                } ?>
                <div class="events-single-Registeration col-md-4 col-md-offset-2">
                   <h3>Please Fill Form Below</h3>
                    <form method="POST" action="registration.php" id="megaReg">
                        <style>
                            .error {
                                border-color:red;
                            }
                        </style>
                     <div class="form-group">
                        <label for="">Name</label>
                        <input name = "name" type="text" data-check="[a-zA-Z][a-zA-Z ]{4,}" class="form-control name" placeholder="Enter Your Name" autocomplete="off" >
                      </div>
                      <div class="form-group">
                        <label for="">Email address</label>
                        <input name = "email" type="email" data-check="^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*
                        @[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$;" class="form-control email" id="exampleInputEmail3" placeholder="Email" autocomplete="off" >
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                      </div>
                      <div class="form-group">
                        <label for="">Mobile Number</label>
                        <input name="mobile" type="text" data-check="[0-9]{11}" class="form-control mobile" placeholder="01xxxxxxxxx" autocomplete="off" >
                      </div>
                     <div class="form-group">
                        <label for="" class="datepick">Birthday Date</label>
                         <div class='input-group date' id='datetimepicker1'>
                            <input name="date" type='text' class="form-control date date" placeholder="" required/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                     </div>
                      <div class="form-group">
                        <label for="">14 Digit National ID </label>
                        <input name = "nationalid" type="text" data-check="[0-9]{14}" class="form-control nationalid" placeholder="Enter your national ID" autocomplete="off" >
                      </div>
                      <select name = "education" class="form-control sel3 education" >
                          <option disabled="disabled" selected="selected" value="0">Education level</option>
                          <option value = "High School">High School</option>
                          <option value = "Collage">Collage</option>
                          <option value = "Graduated">Graduated</option>
                      </select>
                      <div class="form-group">
                        <label for="">University / School</label>
                        <input name="university" type="text" pattern="[a-zA-Z][a-zA-Z ]{4,}" class="form-control university" placeholder="University / School" autocomplete="off" >
                      </div>
                      <select name = "a_status" class="form-control sel a_status" >
                          <option disabled="disabled" selected="selected" value="0">Acadimic Status</option>
                          <option value="Undergraduate">Undergraduate</option>
                          <option value="Graduate">Graduate</option>
                      </select>
                      <select name="ieeemember" id="membershipS" class="form-control sel2 ieeemember" >
                          <option disabled="disabled" selected="selected" value="0">IEEE Mebership</option>
                          <option value = "Member">Membership</option>
                          <option value = "Non-Member">Non-Membership</option>
                      </select>
                      <div class="form-group hide membershipid">
                        <label for="">Membership ID</label>
                        <input name="membership" type="text" data-check="[0-9]" class="form-control membership" placeholder="Membership ID" autocomplete="off" >
                      </div>
                      <button type="submit" class="btn btn-primary submit">Submit</button>
                        <?php if ($admin) { ?>
                            <a href="getdata.php"><div class="btn btn-success">Get Data</div></a>
                            <span class="alert alert-success">
                                <?php
                                $query = $con->prepare("SELECT COUNT(`id`) FROM `registeration`");
                                $query->execute(array());
                                echo $query->fetch()['COUNT(`id`)'];
                                ?>
                            </span>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-form" style="background-color:#fff;">
        <div class="container">
            <div id="mapmap" class="google-maps clearfix" style="padding:  0;">
           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1706.2069409499832!2d29.909723558331613!3d31.209260909612375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f5c38a0562fe85%3A0xa34cc632ec23e7!2sBibliotheca+Alexandrina!5e0!3m2!1sen!2seg!4v1519791639941" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </section>
<?php
require_once 'partials/footer.html';
ob_end_flush();
?>