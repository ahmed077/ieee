<?php
ob_start();
session_start();
$title = 'volunteers';
$caption = '<h2>Volunteers</h2>';
$returnTop = false;
$action = isset($_GET['r']) ? $_GET['r'] : 'all';
$noBtns = false;
if ($action === 'add' && isset($_SESSION['admin']) && $_SESSION['admin'] === 1) {
    $caption = '<h2>Add Volunter</h2>';
}
require_once 'includes/init.php';

if ($action === 'all') {
    $query = $con->prepare('SELECT * FROM volunteers');
    $query->execute();
    $volunteers = $query->fetchAll(PDO::FETCH_ASSOC);
    
?>
<section class="volunteersSection">
    <div class="container">
        <div class="rowvolunteer">
            <hr class="hrVolunteer">
            <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] === 1){ ?>

            <div class="row add-event">
                <a href="volunteers.php?r=add" id="addS">
                    <div class="btn btn-lg btn-success"><i class="fa fa-plus"></i> Add Volunteers</div>
                </a>
            </div>

            <?php } ?>

            <?php  foreach ($volunteers as $volunteer ) { ?>
           
            
            <div class="col-xs-6 col-md-3 col-lg-3 volunteers">
                <img class="imageOfVolunteer" src="<?php echo $volunteer['Img'] ?>" alt="" title="Abdallah Zaitton">
                <h2> <?php echo $volunteer['Name'] ?> </h2> <!-- to print the name  -->
                <p>Volunteer in <?php echo $volunteer['Committee'] ?> Committee</p> 

                <div class="socialOfVol" style="margin-right: 0">
                    <div class="facebook">
                        <a href="<?php echo $volunteer['Facebook'] ?>" target="_blank">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="linkedin">
                        <a href="<?php echo $volunteer['Linkedin'] ?>" target="_blank">
                            <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] === 1){ ?>
                    <a class="deleteCheck" href="<?php echo $_SERVER['PHP_SELF'];?>?r=delete&id=<?php echo $volunteer['ID'];?>">
                        <div class="btn btn-danger">Delete</div>
                    </a>
                <?php } ?>
            </div>

            <?php } ?>


            <div class="clearfix"></div>
            <hr class="hrVolunteer1">
        </div>
    </div>
</section>
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) { ?>
        <div class="alert-box hidden">
            <div class="alert alert-danger h1">
                Are you Sure You Want to Delete this Volunteer?
            </div>
            <div class="btns" style="display:flex;justify-content: space-around;align-items: center;">
                <div data-val="1" class="btn btn-danger btn-lg confirmDelete">Yes</div>
                <div data-val="0" class="btn btn-info btn-lg cancelDelete" style="margin-left:20px;">No</div>
            </div>
        </div>
    <?php }
} elseif ($action === 'add' && isset($_SESSION['admin']) && $_SESSION['admin'] = 1) {
    $noBtns = true;
    ?>
    <section class="add-event-form">
        <div class="container">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?r=insert' ?>" id="event-form" method="post"
                  enctype="multipart/form-data">

                <div class="form-group">
                    <label class="control-label">Volunteer Name:</label>
                    <input type="text" data-check="[^A-z0-9 ]" class="form-control" placeholder="Volunteer Name"
                           name="name">
                </div>

                <div class="form-group">
                    <label class="control-label">Committee :</label>
                    <input type="text" data-check="[^A-z0-9 ,\\-]" placeholder="Volunteer Committee"
                           class="form-control" name="committee">
                </div>

                <div class="form-group">
                    <label class="control-label">Image :</label>
                    <!--                    <label class="control-label">img :</label>-->
                    <input type="file" class="form-control" name="img">
                    <!--                    <input type="text" placeholder="Volunteer img"   class="form-control" name="img" required>-->
                </div>

                <div class="form-group">
                    <label class="control-label">Facebook URL :</label>
                    <input type="text" class="form-control" data-check="[^A-z0-9 ,\\-\\(.)]" placeholder="Facebook URL"
                           name="facebook">
                </div>

                <div class="form-group">
                    <label class="control-label">Linkedin URL :</label>
                    <input type="text" class="form-control" data-check="[^A-z0-9 ,\\-\\(.)]" placeholder="Linkedin URL"
                           name="linkedin">
                </div>

                <input type="submit" class="btn btn-success" id="submit" value="Submit">
            </form>

        </div>
    </section>

    <?php
} elseif ($action ==='delete') {
    if (isset($_GET['id'])) {
        $query = $con->prepare("DELETE FROM volunteers WHERE id = ?");
        $query->execute(array($_GET['id']));
    }
    header("Location: volunteers.php");
    exit();
} elseif ($action === 'insert') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo $_POST['name']."<br/>";
        echo $_POST['committee']."<br/>";
        echo $_POST['facebook']."<br/>";
        echo $_POST['linkedin']."<br/>";

        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $committee = filter_var($_POST['committee'], FILTER_SANITIZE_STRING);
//        $image = "images/volunters/" . $_POST['img'];
        $facebook = filter_var($_POST['facebook'], FILTER_SANITIZE_URL);
        $linkedin = filter_var($_POST['linkedin'], FILTER_SANITIZE_URL);

        if(empty($facebook)){$facebook="#";}
        if(empty($linkedin)){$linkedin="#";}

        $image = 'images/volunteers/' . sha1(
                substr($_FILES['img']['name'],
                    0,
                    strlen($_FILES['img']['name']) - 5)) . substr($_FILES['img']['name'],
                strlen($_FILES['img']['name']) - 4);
        move_uploaded_file($_FILES['img']['tmp_name'], $image);

        $query = $con->prepare("INSERT INTO volunteers 
                                    (`Name`,`Committee`,`Img`,`Facebook`,`Linkedin`) 
                                    VALUES (?,?,?,?,?)");
        $query->execute(array($name, $committee, $image, $facebook, $linkedin));
     
        header("refresh:0;url=volunteers.php");
        exit();
        } else {
        header("refresh:0;url=volunteers.php");
        exit();
    }
    } else {
    header("refresh:0;url=volunteers.php");
    exit();
}
?>
<?php
    require_once 'partials/footer.html';
    ob_end_flush();
?>



<!--



CREATE TABLE `ieee`.`volunteers` ( `ID` INT NOT NULL AUTO_INCREMENT , `Name` VARCHAR(255) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL , `Committee` VARCHAR(255) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL , `Img` VARCHAR(255) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL , `Facebook` VARCHAR(255) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL DEFAULT '#' , `Linkedin` VARCHAR(255) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL DEFAULT '#' , PRIMARY KEY (`ID`)) ENGINE = InnoDB;

 -->