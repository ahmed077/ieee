<?php
ob_start();
session_start();
$title = 'gallery';
$returnTop = false;
$action = isset($_GET['r']) ? $_GET['r'] : 'all';
$noBtns = false;
$_SESSION['admin'] = isset($_SESSION['admin']) ? $_SESSION['admin'] : 0 ;
require_once 'includes/connect.php';
require_once 'includes/functions.php';
if ($action === 'all') {
    $caption = '<h2>Gallery IEEE PUA SB</h2>';
if (isset($_SESSION['admin']) && in_array($_SESSION['admin'],[1,2])) {
    $caption .= '<div class="row add-image">
        <a href="gallery.php?r=add" id="addG" style="margin-left:20px;">
            <div class="btn btn-lg btn-warning"><i class="fa fa-plus"></i> Add Image</div>
        </a>
    </div>';
}
    require_once 'partials/header.html';
    $query=$con->prepare("SELECT t1.*, t2.title FROM gallery AS t1 INNER JOIN events AS t2 WHERE t2.id=t1.event_id");
    $query->execute(array());
    $images = $query->fetchAll(PDO::FETCH_ASSOC);
    $admin = (isset($_SESSION['admin']) && in_array(intval($_SESSION['admin']),[1,2,3]))? true : false;
    ?>
    <section class="gallery-list">
        <div class="container">
            <div class="row">
            <?php if (count($images) > 0) { $i=0;?>
                <?php foreach ($images as $image) {$i++; ?>
                <div class="col-sm-4 gallery-item">
                    <span class="gallery-img bg flex" data-featherlight="#content-<?php echo $i;?>" style="background-image:url('<?php echo $image['url'];?>')">
                        <?php if ($admin) { ?>
                            <a href="<?php echo $_SERVER['PHP_SELF'] . '?r=delete&id='.$image['id'];?>" class="delete text-danger deleteCheck">
                                <i class="fa fa-remove fa-2x"></i>
                            </a>
                        <?php } ?>
                    </span>
                    <div id="content-<?php echo $i;?>" class="gallery-lightbox">
                        <img src="<?php echo $image['url'];?>" alt="<?php echo $image['title'];?>">
                        <div class="gallery-lightbox-content">
                            <p><?php echo $image['description'];?>
                                <br>
                                <a href="events.php?r=event&id=<?php echo $image['event_id'];?>">
                                    <?php echo $image['title'];?>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($admin) { ?>
                    <div class="alert-box hidden">
                        <div class="alert alert-danger h1">
                            Are you Sure You Want to Delete this Image?
                        </div>
                        <div class="btns" style="display:flex;justify-content: space-around;align-items: center;">
                            <div data-val="1" class="btn btn-danger btn-lg confirmDelete">Yes</div>
                            <div data-val="0" class="btn btn-info btn-lg cancelDelete" style="margin-left:20px;">No</div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <section class="events-list text-center h1">No Images Added</section>
            <?php } ?>
            </div>

            <!--
<a href="#" class="gallery-load-more">
					<span>Load More <i class="fa fa-angle-down" aria-hidden="true"></i></span>
				</a>
-->
        </div>
    </section>
<?php } elseif (isset($_SESSION['admin']) && in_array(intval($_SESSION['admin']),[1,2,3])) {
    if ($action === 'add') {
        $caption = '';
        $headerClass = 'default-hero';
        require_once 'partials/header.html';
        $query = $con->prepare("SELECT id,title FROM events");
        $query->execute(array());
        $events = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <section class="add-event-form">
            <div class="container">
                <h2 class="h1 text-center" style="margin-top:-70px;margin-bottom:20px;">Add Image(s)</h2>
                <form action="<?php echo $_SERVER['PHP_SELF'] . '?r=insert' ?>" id="gallery-form" method="post"
                      enctype="multipart/form-data">
                    <div class="form-group" id="mainInput">
                        <input name="image_1" type="file">
                    </div>
                    <div class="form-group">
                        <label class="control-label">News Content:</label>
                        <textarea name="description" class="form-control textarea" cols="30" rows="3"
                                  data-check="[^A-Za-z0-9.\\- ,]" placeholder="Image Description"></textarea>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="event">
                            <?php foreach ($events as $event) { ?>
                                <option value="<?php echo $event['id']; ?>"><?php echo ucfirst($event['title']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-success" id="submit" value="Submit">
                    <i id="addImage" class="fa fa-plus btn btn-success"></i>
                </form>
            </div>
        </section>
        <?php

    } elseif ($action === 'insert') {
        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $event_id = filter_var($_POST['event'], FILTER_SANITIZE_NUMBER_INT);
        $query = $con->prepare("SELECT id FROM events WHERE id = ?");
        $query->execute(array($event_id));
        if ($query->rowCount()>0) {
            foreach ($_FILES as $key => $value) {
                if (preg_match('/^(image_[0-9]+)$/', $key)) {
                    if (strlen($_FILES[$key]['name']) > 0) {
                        $img = 'images/gallery/' . sha1(substr($_FILES[$key]['name'], 0, strlen($_FILES[$key]['name']) - 5)) . '_' . $key . substr($_FILES[$key]['name'], strlen($_FILES[$key]['name']) - 4);
                        move_uploaded_file($_FILES[$key]['tmp_name'], __DIR__ . '/' . $img);
                        $query = $con->prepare("INSERT INTO gallery (`url`,`description`,`event_id`) VALUES (?,?,?)");
                        $query->execute(array($img,$description,$event_id));
                    }
                }
            }
        }
        header("Location:gallery.php");
        exit();
    } elseif ($action === 'delete') {
        $id=$_GET['id'];
        $query=$con->prepare("DELETE FROM gallery WHERE id = ?");
        $query->execute(array($id));
        header("Location:". $_SERVER['HTTP_REFERER']);
    } else {
        header('Location:gallery.php');
        exit();
    }
} else {
    header('Location:gallery.php');
    exit();
}
require_once 'partials/footer.html';
ob_end_flush();
?>