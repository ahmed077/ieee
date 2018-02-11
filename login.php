<?php
ob_start();
session_start();
$title = 'events';
$caption = '<h2>Sign in</h2>';
$returnTop = false;
$member = 1;
$noBtns = true;

if(isset($_SESSION["USERNAME"])){
    header("Location: index.html");
    exit();
}


require_once 'includes/init.php';
?>

<section class="add-event-form">
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" id="event-form" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label class="control-label">Name :</label>
                <input type="text" class="form-control" placeholder="Name" name="name">
            </div>

            <div class="form-group">
                <label class="control-label">Password :</label>
                <input type="Password" class="form-control"  placeholder="Password" name="password">
            </div>

            <input type="submit" class="btn btn-success" id="submit" value="log in">
        </form>

    </div>
</section>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = $_POST['name'];
	$pass = $_POST['password'];


	$query = $con->prepare('SELECT * FROM users Where username = ? and password = ? and admin = 1');
    $query->execute(array($name,$pass));
    $row = $query->fetch();
    $count = $query->rowCount();

    if($count>0){
    	
        $_SESSION["USERNAME"] = $name;
        $_SESSION["ID"] = $row["UserId"];
        $_SESSION['admin'] = $row['admin'];
        header("Location: index.html");
        exit();
      }

}

require_once 'partials/footer.html';
ob_end_flush();