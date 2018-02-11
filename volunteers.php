<?php
ob_start();
session_start();
$title = 'volunteers';
$caption = '<h2>Volunteers</h2>';
$returnTop = false;
$member = 1;
$action = isset($_GET['r']) ? $_GET['r'] : 'all';
$noBtns = false;
if ($action === 'add' && $member === 1) {
    $caption = '<h2>Add Volunteer</h2>';
}
else if ($action === 'Edit' && $member === 1) {
    $caption = '<h2>Edit Volunteer</h2>';
}
require_once 'includes/init.php';


if ($action === 'all') { 
//    $noBtns = true;
    $query = $con->prepare('SELECT * FROM volunteers');
    $query->execute();
    $events = $query->fetchAll(PDO::FETCH_ASSOC);
    
?>
<section class="volunteersSection">
    <div class="container">
        <div class="rowvolunteer">
            <hr class="hrVolunteer">
            <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){ ?>

            <div class="row add-event">
                <a href="volunteers.php?r=add" id="addS">
                    <div class="btn btn-lg btn-success"><i class="fa fa-plus"></i> Add Volunteers</div>
                </a>
            </div>

            <?php } ?>

            <?php  foreach ($events as $event ) { ?>
           
            
            <div class="col-xs-6 col-md-3 col-lg-3 volunteers">
                <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){ ?>
                <a href="?r=Edit&ID=<?php echo $event['ID']; ?>">
                <?php } ?>
                <img class="imageOfVolunteer" src="<?php echo $event['Img'] ?>" alt="" title="<?php echo $event['Name'] ?>">
                
                <h2> <?php echo $event['Name'] ?> </h2> <!-- to print the name  -->
                <p>Volunteer in <?php echo $event['Committee'] ?> Committee</p> 
                <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){ ?>
                </a>
                <?php } ?>
                <div class="socialOfVol" style="margin-right: 0">
                    <div class="facebook">
                        <a href="<?php echo $event['Facebook'] ?>" target="_blank">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="linkedin">
                        <a href="<?php echo $event['Linkedin'] ?>" target="_blank">
                            <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>

            <?php } ?>

            <div class="clearfix"></div>
            <hr class="hrVolunteer1">
        </div>
    </div>
</section>


<?php
}  
elseif ($action === 'add'&& isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
//elseif ($action === 'add' && isset($_SESSION['admin']) && $_SESSION['admin'] = 1){
//    $noBtns = true;
    ?>
    <section class="add-event-form">
        <div class="container">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?r=insert' ?>" id="event-form" method="post" enctype="multipart/form-data" onsubmit="return Validator()">

                <div class="form-group">
                    <label for="name" class="control-label">Volunteer Name:</label><span class="Error tqw" id="error_name"></span>
                    <input id="name" type="text" data-check="[^A-z]" class="form-control"   placeholder="Volunteer Name" name="name" required="true" >
                </div>

                <div class="form-group">
                    <label for="committee" class="control-label">Committee :</label><span class="Error" id="error_committee"></span>
                    <input id="committee" type="text" data-check="[^A-z0-9 ,\\-]" placeholder="Volunteer Committee"   class="form-control" name="committee" >
                </div>

                <div class="form-group">
                    <label for="image" class="control-label">Image :</label><span class="Error" id="error_image"></span>
<!--                    <label class="control-label">img :</label>-->
                    <input id="image" type="file" class="form-control" name="img">
<!--                    <input type="text" placeholder="Volunteer img"   class="form-control" name="img" required>-->
                </div>

                <div class="form-group">
                    <label for="facebook" class="control-label">Facebook URL :</label><span class="Error" id="error_facebook"></span>
                    <input id="facebook" type="text" class="form-control" data-check="[^A-z0-9 ,\\-\\(.)]" placeholder="Facebook URL" name="facebook">
                </div>

                <div class="form-group">
                    <label for="linkedin" class="control-label">Linkedin URL :</label><span class="Error" id="error_linkedin"></span>
                    <input id="linkedin" type="text" class="form-control" data-check="[^A-z0-9 ,\\-\\(.)]" placeholder="Linkedin URL" name="linkedin">
                </div>

                <input type="submit" class="btn btn-success" id="submit" value="Submit">
            </form>

        </div>
    </section>
    
<?php } 


elseif ($action === 'insert') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
        $committee = trim(filter_var($_POST['committee'], FILTER_SANITIZE_STRING));
        //$image = 'images/volunters/' . $_FILES['img']['name'];
        $facebook = trim(filter_var($_POST['facebook'], FILTER_SANITIZE_URL));
        $linkedin = trim(filter_var($_POST['linkedin'], FILTER_SANITIZE_URL));

        if(empty($facebook)){$facebook="#";}
        if(empty($linkedin)){$linkedin="#";}


        $image = 'images/volunters/' . sha1(
                substr($_FILES['img']['name'],
                    0,
                    strlen($_FILES['img']['name']) - 5)) . substr($_FILES['img']['name'],
                strlen($_FILES['img']['name']) - 4);
        move_uploaded_file($_FILES['img']['tmp_name'], $image);


        $formErrors = array();


                if (empty($name)) {
                    $formErrors[] = 'Username Can\'t Be <strong>Empty</strong>';
                }

                if (empty($committee)) {
                    $formErrors[] = 'Full Name Can\'t Be <strong>Empty</strong>';
                }

                if (empty($image)) {
                    $formErrors[] = 'image Can\'t Be <strong>Empty</strong>';
                }

                // Loop Into Errors Array And Echo It

                foreach($formErrors as $error) {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }
                
        if(empty($formErrors)){

            $query = $con->prepare("INSERT INTO volunteers 
                                    (`Name`,`Committee`,`Img`,`Facebook`,`Linkedin`) 
                                    VALUES (?,?,?,?,?)");
            $query->execute(array($name, $committee, $image, $facebook, $linkedin));
     
            header("refresh:0;url=volunteers.php");
            exit();

        }
        header("refresh:3;url=volunteers.php");
        exit();


    } else {
        header("refresh:0;url=volunteers.php");
        exit();
    }

}




else if($action=="Edit"&& isset($_SESSION['admin']) && $_SESSION['admin'] == 1){/* edit */
    $userId =isset($_GET["ID"]) && is_numeric($_GET["ID"]) ? intval($_GET["ID"]) :0;
    $stmt = $con->prepare("SELECT * FROM volunteers WHERE ID = ?");
    $stmt->execute(array($userId));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();

    if($count > 0){?>

    <section class="add-event-form">
        <div class="container">
            <form action="?r=Update" id="event-form" method="post" enctype="multipart/form-data" onsubmit="return Validator()">
                <input type="hidden" name="id" value="<?php echo $userId; ?>"/>

                <!-- Start of Name -->
                <div class="form-group">
                    <label for="name" class="control-label">Volunteer Name:</label><span class="Error tqw" id="error_name"></span>
                    <input id="name" type="text" data-check="[^A-z]" class="form-control"   placeholder="Volunteer Name" name="name" required value="<?php echo $row['Name']; ?>">
                </div>
                <!-- End of Name -->

                <!-- Start of Committee -->
                <div class="form-group">
                    <label for="committee" class="control-label">Committee :</label><span class="Error" id="error_committee"></span>
                    <input id="committee" type="text" data-check="[^A-z0-9 ,\\-]" placeholder="Volunteer Committee"   class="form-control" required name="committee" value="<?php echo $row['Committee']; ?>">
                </div>
                <!-- End of Committee -->

                <!-- Start of Image -->
                <div class="form-group">
                    <label for="image" class="control-label">Image :</label><span class="Error" id="error_image"></span>
                    <input id="image" type="file" required class="form-control" name="img" value="images/volunters/' ">
                </div>
                <!-- End of Image -->

                <!-- Start of Facebook -->
                <div class="form-group">
                    <label for="facebook" class="control-label">Facebook URL :</label><span class="Error" id="error_facebook"></span>
                    <input id="facebook" type="text" class="form-control" data-check="[^A-z0-9 ,\\-\\(.)]" placeholder="Facebook URL" name="facebook" value="<?php echo $row['Facebook']; ?>">
                </div>
                <!-- End of Facebook -->

                <!-- Start of Facebook -->
                <div class="form-group">
                    <label for="linkedin" class="control-label">Linkedin URL :</label><span class="Error" id="error_linkedin"></span>
                    <input id="linkedin" type="text" class="form-control" data-check="[^A-z0-9 ,\\-\\(.)]" placeholder="Linkedin URL" name="linkedin" value="<?php echo $row['Linkedin']; ?>">
                </div>
                <!-- End of linkedin -->

                <input type="submit" class="btn btn-success" id="submit" value="Submit">
                <a href="?r=Delete&ID=<?php echo $userId; ?>" class="right btn btn-success" >Delete volunter</a>
            </form>
            

        </div>
    </section>
   <?php


    }else{
      echo "<div class='alert alert-danger'>There's no ID you are not exist</div>";
    }


}

else if($action == "Update"){
  // save the variable from the form
      echo "<h1 class='text-center'>Update Member</h1>";
            echo "<div class='container'>";

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                // Get Variables From The Form

                $id     = $_POST['id'];
                $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
                $committee = trim(filter_var($_POST['committee'], FILTER_SANITIZE_STRING));
                $facebook = trim(filter_var($_POST['facebook'], FILTER_SANITIZE_URL));
                $linkedin = trim(filter_var($_POST['linkedin'], FILTER_SANITIZE_URL));

                if(empty($facebook)){$facebook="#";}
                if(empty($linkedin)){$linkedin="#";}

                $image = 'images/volunters/' . sha1(
                        substr($_FILES['img']['name'],
                            0,
                            strlen($_FILES['img']['name']) - 5)) . substr($_FILES['img']['name'],
                        strlen($_FILES['img']['name']) - 4);
                move_uploaded_file($_FILES['img']['tmp_name'], $image);


                // Validate The Form

                $formErrors = array();


                if (empty($name)) {
                    $formErrors[] = 'Username Can\'t Be <strong>Empty</strong>';
                }

                if (empty($committee)) {
                    $formErrors[] = 'Full Name Can\'t Be <strong>Empty</strong>';
                }

                if (empty($image)) {
                    $formErrors[] = 'image Can\'t Be <strong>Empty</strong>';
                }

                // Loop Into Errors Array And Echo It

                foreach($formErrors as $error) {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }
                

            if(empty($formErrors)){
              //start updating
                $stmt = $con->prepare("UPDATE volunteers SET Name = ? ,Committee = ? ,Img = ?,Facebook = ?,Linkedin=?  WHERE ID = ?");
                $stmt->execute(array($name,$committee,$image,$facebook,$linkedin,$id));
                //echo "<div class='alert alert-success'>row effected changed saved</div>";
                header("refresh:0;url=volunteers.php");
                exit();

            }
            header("refresh:3;url=volunteers.php");
                exit();



    }else{
        header("refresh:0;url=volunteers.php");
        exit();
    }


}

else if ($action=="Delete"&& isset($_SESSION['admin']) && $_SESSION['admin'] == 1){

    echo '<h1 class="text-center">Delete Member</h1>';
    $id =isset($_GET["ID"]) && is_numeric($_GET["ID"]) ? intval($_GET["ID"]) :0;
    $stmt = $con->prepare("DELETE FROM volunteers WHERE ID=?");
    $stmt->execute(array($id));
    header("refresh:0;url=volunteers.php");
    exit();

}



else {
    header("refresh:0;url=volunteers.php");
    exit();
}
?>
<?php
    require_once 'partials/footer.html';
    ob_end_flush();
?>


