<?php
ob_start();
session_start();
$title = 'events';
$caption = '<h2>Our Events</h2>';
$returnTop = false;
$action = isset($_GET['r']) ? $_GET['r'] : 'all';
$noBtns = false;
$_SESSION['admin'] = isset($_SESSION['admin']) ? $_SESSION['admin'] : 0 ;
if ($action === 'add' && isset($_SESSION) && $_SESSION['admin'] === 1) {
    $caption = '<h2>Add Event</h2>';
}
require_once 'includes/connect.php';
require_once 'includes/functions.php';
if ($action === 'all') {
    $title = 'events';
    $caption = '<h2>Our Events</h2>';
    require_once 'partials/header.html';
    ?>
    <section class="events-search-filter">
        <div class="container">
            <div class="row">
                <div class="section-content clearfix">
                    <div class="col-sm-4 btn-body">
                        <a href="#" id="visits" class="btn" data-title="Visits" data-index='0'></a>
                    </div>
                    <div class="col-sm-4 btn-body">
                        <a href="#" id="workshop" class="btn" data-title="Workshops" data-index='1'></a>
                    </div>
                    <div class="col-sm-4 btn-body">
                        <a href="#" id="sessions" class="btn" data-title="Sessions" data-index='2'></a>
                    </div>
                </div>
            </div>
    <?php if (isset($_SESSION['admin']) && in_array($_SESSION['admin'],[1,2])) {?>
            <div class="row add-event">
                <a href="events.php?r=add" id="addS">
                    <div class="btn btn-lg btn-success"><i class="fa fa-plus"></i> Add Event</div>
                </a>
            </div>
        <?php } ?>
        </div>
    </section>
    <?php
    $query = $con->prepare('SELECT * FROM events ORDER BY DATE DESC');
    $query->execute();
    if ($query->rowCount() > 0) {
        $events = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <section class="events-list">
            <div class="container">
                <div id="events-list" class="row">
    <?php foreach ($events as $event) { ?>
        <div class="col-xs-6 col-lg-3 <?php echo $event['event_type']; ?>">
            <div class="events-item">
                <div class="events-item-img">
                    <a href="events.php?r=event&id=<?php echo $event['id']; ?>"
                       style="background-image:url('<?php echo $event['image']; ?>');">
                    </a>
                </div>
                <div class="events-item-info">
                    <h3><a href="events.php?r=event&id=<?php echo $event['id']; ?>">
                            <?php echo $event['title']; ?>
                        </a></h3><br><br>
                    <ul class="event-meta">
                        <li>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $event['date']; ?>
                        </li>
                        <li>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <?php echo $event['location']; ?>
                        </li>
                    </ul>
                    <p><?php echo substr(decode($event['description']), 0, 60); ?>...</p>
                </div>
                <div class="events-item-link">
                    <a href="events.php?r=event&id=<?php echo $event['id']; ?>" class="hvr-push">Read More</a>
                </div>
                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) { ?>
                <hr>
                <div class="col-xs-12" style="padding-bottom:20px;display:flex;justify-content:space-around">
                    <a class="deleteCheck"
                       href="<?php echo $_SERVER['PHP_SELF'] ?>?r=delete&id=<?php echo $event['id']; ?>">
                        <div class="btn btn-danger"><i class="fa fa-remove"></i> Delete</div>
                    </a>
                    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?r=edit&id=<?php echo $event['id']; ?>">
                        <div class="btn btn-success"><i class="fa fa-edit"></i> Edit</div>
                    </a>
                </div>
            <?php } ?>
            </div>
        </div>
            <?php } ?>
            </div>
            </div>
            </section>
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) { ?>
                <div class="alert-box hidden">
                    <div class="alert alert-danger h1">
                        Are you Sure You Want to Delete this Event?
                    </div>
                    <div class="btns" style="display:flex;justify-content: space-around;align-items: center;">
                        <div data-val="1" class="btn btn-danger btn-lg confirmDelete">Yes</div>
                        <div data-val="0" class="btn btn-info btn-lg cancelDelete" style="margin-left:20px;">No</div>
                    </div>
                </div>
            <?php } ?>
                <?php
            } else {
                echo '<section class="events-list text-center h1">No Events Added</section>';
            }
} elseif ($action === 'event') {
    if (isset($_GET['id'])) {

        $query = $con->prepare('SELECT * FROM events WHERE id=?');
        $query->execute(array($_GET['id']));
        if ($query->rowCount() > 0) {
            $event = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            $speakersNames = explode(',', $event['speakers']);
            $speakersImages = explode(',', $event['speakers_images']);
            $speakers = [];
            $i = 0;
            foreach($speakersNames as $speaker) {
                $speakers[] = [
                        'name'  => $speaker,
                        'image' => $speakersImages[$i]
                ];
                $i++;
            }
            $title = ucfirst($event['title']);
            $caption = "<span class=\"tag\">" . ucfirst($event['event_type']) . "</span>
                    <h2>". $title ."</h2>
                    <p>" . $event['location'] . " | <span>" . date("M d, Y",strtotime($event['date'])) . "</span></p>";
            $headerClass = "events-single-hero";
            require_once 'partials/header.html';
        ?>

            <section class="events-single-content">
                <div class="container">
                    <div class="row">
                        <div class="events-single-about col-md-4">
                            <h3><?php echo $event['title'];?></h3>

                            <h4>Mission:</h4><br>
                            <div class="event-des">
                                <p>
                                <?php echo decode($event['mission']);?>
                                </p>
                            </div>
                            <h4>Goals:</h4><br>
                            <div class="event-des">
                                <p>
                                <?php echo decode($event['goals']);?>
                                </p>
                            </div>
                            <h4>More About this Event:</h4><br>
                            <p><?php echo decode($event['description'])?></p>
                            <?php
                                if (intval($event['event_open']) === 1) {
                                    $open = true;
                                ?>
                            <a href="event-attendee.php?id=<?php echo $_GET['id']; ?>"><div class="btn btn-info">Register Attendance</div></a>
                            <?php
                                } else {
                                    $open = false;
                                }
                                if (isset($_SESSION) && $_SESSION['admin'] === 1) {
                                    ?>
                            <a href="events.php?r=toggle&id=<?php echo $_GET['id']; ?>">
                                <span class="btn btn-warning"><?php echo $open?'Close Registeration':'Open Registeration';?></span>
                            </a>
                                    <hr>
                            <a href="get-attendees.php?id=<?php echo $_GET['id']; ?>">
                                <span class="btn btn-primary">Get Attendees File.</span>
                            </a>
                            <?php } ?>
                        </div>
                        <div class="events-single-speakers col-md-4">
                            <h3>SPEAKERS</h3>
                            <?php if (count($speakers) > 0) {
                                foreach($speakers as $speaker) {?>
                                <div class="speaker-item">
                                    <div class="col-sm-3">
                                        <img src="<?php echo $speaker['image'];?>" alt="image">
                                        <div style="background-image:url('<?php echo $speaker['image'];?>')"></div>
                                    </div>
                                    <div class="col-sm-9">
                                        <h4><?php echo $speaker['name'];?></h4>
                                        <!--<p>Graphic Designer</p>-->
                                    </div>
                                </div>
                                <?php }
                            } else {?>
                                <div class="speaker-item">
                                    <div class="alert alert-info">
                                        No Speakers Added.
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                        <div class="events-single-location col-md-4">
                            <h3>LOCATION</h3>
                            <p><?php echo $event['location'];?></p>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6824.982541309847!2d29.963499116865766!3d31.207116081474375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6aa3847bf78e707d!2z2KzYp9mF2LnYqSDZgdin2LHZiNizINio2KfZhNil2LPZg9mG2K_YsdmK2Kk!5e0!3m2!1sar!2seg!4v1506517535097" width="800" height="300" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            $query = $con->prepare('SELECT * FROM events ORDER BY DATE DESC LIMIT 4');
            $query->execute();
            $noBtns = true;
            if ($query->rowCount() > 0) {
                $events = $query->fetchAll(PDO::FETCH_ASSOC);

                ?>
                <section class="events-list-single">
                    <div class="container">
                        <h2 class="related-heading"><span>See Other Events</span></h2>
                        <div class="row">
                            <?php foreach ($events as $event) {?>
                                <div class="col-xs-6 col-lg-3 <?php echo $event['event_type'];?>">
                                    <div class="events-item">
                                        <div class="events-item-img">
                                            <a href="events.php?r=event&id=<?php echo $event['id'];?>">
                                                <img src="<?php echo $event['image'];?>" alt="Event Image">
                                            </a>
                                        </div>
                                        <div class="events-item-info">
                                            <h3><a href="events.php?r=event&id=<?php echo $event['id'];?>">
                                                    <?php echo $event['title'];?>
                                                </a>
                                            </h3>
                                            <br><br>
                                            <ul class="event-meta">
                                                <li>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $event['date'];?>
                                                </li>
                                                <li>
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <?php echo $event['location'];?>
                                                </li>
                                            </ul>
                                            <p><?php echo substr(decode($event['description']), 0, 60);?>...</p>
                                        </div>
                                        <div class="events-item-link">
                                            <a href="events.php?r=event&id=<?php echo $event['id'];?>" class="hvr-push">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>
                <div class="alert-box hidden">
                    <div class="alert alert-danger h1">
                        Are you Sure You Want to Delete this Event?
                    </div>
                    <div class="btns" style="display:flex;justify-content: space-around;align-items: center;">
                        <div data-val="1" class="btn btn-danger btn-lg confirmDelete">Yes</div>
                        <div data-val="0" class="btn btn-info btn-lg cancelDelete" style="margin-left:20px;">No</div>
                    </div>
                </div>
            <?php } else {
                echo '<section class="events-list text-center">No Other Events</section>';
            }
        } else {
            header("Location:events.php");
            exit();
        }
    } else {
        header("Location:events.php");
        exit();
    }
} elseif ($action === 'toggle' && $_SESSION['admin'] === 1) {
    $query=$con->prepare("SELECT event_open FROM events WHERE id = ?");
    $query->execute(array($_GET['id']));
    if ($query->rowCount() > 0) {
        $next = intval($query->fetchAll()[0]['event_open']) === 0 ? 1 : 0;
        $query2 = $con->prepare("UPDATE events SET event_open=? WHERE id =?");
        $query2->execute(array($next,$_GET['id']));
    }
    header("Location:". $_SERVER['HTTP_REFERER']);
    exit();
} elseif ($action === 'add' && $_SESSION['admin'] === 1) {
    $noBtns = true;
    require_once 'partials/header.html';
    ?>
    <section class="add-event-form">
        <div class="container">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?r=insert' ?>" id="event-form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Event Name:</label>
                    <input type="text" data-check="[^A-Za-z0-9. ]" class="form-control"  id="event-name" placeholder="Event Title" name="name">
                </div>
                <div class="form-group">
                    <label class="control-label">Event Date:</label>
                    <input type="text" class="form-control" name="date" placeholder="MM/DD/YYYY">
                </div>
                <div class="form-group">
                    <label class="control-label">Event Location:</label>
                    <input type="text" data-check="[^A-Za-z0-9 ,\\-]" placeholder="Event Location" id="event-loc"  class="form-control" name="location">
                </div>
                <div class="form-group">
                    <label class="control-label">Speakers Names: <i id="addSpeaker" class="fa fa-plus btn btn-success"></i></label>
                    <div class="speakers">
                        <input type="text" data-check="[^A-Za-z ]" class="form-control" id="speaker-name" placeholder="Speaker's Name" name="speaker_name_1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Speakers Images:</label>
                    <div class="speakers">
                        <input name="speaker_image_1" type="file" onchange="ValidateSingleInput(this);">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Event Mission:</label>
                    <textarea class="form-control textarea" data-check="[^A-Za-z0-9.\\- ,]" id="event-mission"  placeholder="Event Mission" name="mission"></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Event Goals:</label>
                    <textarea class="form-control textarea" id="event-goals" data-check="[^A-Za-z0-9.\\- ,]" placeholder="Event Goals" name="goals"></textarea>
                </div>
                <div class="form-group">
                    <select class="form-control" name="event_type">
                        <option selected value="">Select Type</option>
                        <option value="workshop">Workshops</option>
                        <option value="visit">Visits</option>
                        <option value="session">Sessions</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Event Description:</label>
                    <textarea name="description" class="form-control textarea" cols="30" rows="10" data-check="[^A-Za-z0-9.\\- ,]"></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Upload Event Image:</label>
                    <input name="event_image" type="file" onchange="ValidateSingleInput(this);">
                </div>
                <input type="submit" class="btn btn-success" id="submit" value="Submit">
            </form>
        </div>
    </section>
    <script src="js/event_validation.js"></script>
<?php } elseif ($action === 'insert') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //TODO: handle empty speakers name
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $date = date('Y-m-d',strtotime(filter_var($_POST['date'], FILTER_SANITIZE_STRING)));
        $image = 'images/events/' . sha1(substr($_FILES['event_image']['name'], 0, strlen($_FILES['event_image']['name']) - 5)) . substr($_FILES['event_image']['name'], strlen($_FILES['event_image']['name']) - 4);
        $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
        $description = encode(filter_var($_POST['description'], FILTER_SANITIZE_STRING));
        $speakersArray = array();
        $speakers_imagesArray = array();
        $mission = encode(filter_var($_POST['mission'], FILTER_SANITIZE_STRING));
        $goals = encode(filter_var($_POST['goals'], FILTER_SANITIZE_STRING));
        $event_type = filter_var($_POST['event_type'], FILTER_SANITIZE_STRING);
        foreach ($_POST as $key => $value) {
            if (preg_match('/(speaker_name)/', $key)) {
                $speakersArray[] = $value;
            }
        }
        $speakersArray = filter_var_array($speakersArray, FILTER_SANITIZE_STRING);
        $speakers = implode(',', $speakersArray);
        foreach ($_FILES as $key => $value) {
            if (preg_match('/(speaker_image)/', $key)) {
                if (strlen($_FILES[$key]['name']) > 0) {
                    $speakerImgName = 'images/speakers/' . sha1(substr($_FILES[$key]['name'], 0, strlen($_FILES[$key]['name']) - 5)) . '_' . $key . substr($_FILES[$key]['name'], strlen($_FILES[$key]['name']) - 4);
                    move_uploaded_file($_FILES[$key]['tmp_name'], __DIR__ . '/' . $speakerImgName);
                } else {
                    $speakerImgName = 'images/speakers/person-vector.jpg';
                }
                $speakers_imagesArray[] = $speakerImgName;
            }
        }
        $speakers_imagesArray = filter_var_array($speakers_imagesArray, FILTER_SANITIZE_STRING);
        $speakers_images = implode(',', $speakers_imagesArray);
        move_uploaded_file($_FILES['event_image']['tmp_name'], $image);
        $query = $con->prepare("INSERT INTO events 
                                    (`title`,`image`,`date`,`location`,`description`,`speakers`,`speakers_images`,`mission`,`goals`,`event_type`) 
                                    VALUES (?,?,?,?,?,?,?,?,?,?)");
        $query->execute(array($name, $image, $date, $location, $description, $speakers, $speakers_images, $mission, $goals, $event_type));
        $title='';
        require_once 'partials/header.html';
        ?>
        <div class="alert alert-success text-center others-section" style="font-size:30px">Adding Your Event</div>
        <?php
        header("refresh:1;url=events.php");
        } else {
        header("refresh:0;url=events.php");
        exit();
    }
    } elseif ($action === 'delete') {
        $query = $con->prepare("DELETE FROM `events` WHERE `id` = ?");
        $query->execute(array($_GET['id']));
        header("refresh:0;url=events.php");
        exit();
    } elseif ($action === 'edit') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query=$con->prepare("SELECT * FROM `events` WHERE id = ?");
        $query->execute(array($id));
        if ($query->rowCount() > 0) {
            $event = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            $speakersNames = explode(',', $event['speakers']);
            $speakersImages = explode(',', $event['speakers_images']);
            $speakers = [];
            $i = 0;
            foreach($speakersNames as $speaker) {
                $speakers[] = [
                    'name'  => $speaker,
                    'image' => $speakersImages[$i]
                ];
                $i++;
            }
            require_once 'partials/header.html';
            ?>
    <section class="add-event-form">
        <div class="container">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?r=update' ?>" id="edit-event-form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label class="control-label">Event Name:</label>
                    <input type="text" data-check="[^A-z0-9 ]" class="form-control"  id="event-name" placeholder="Event Title" name="name" value="<?php echo $event['title'];?>">
                </div>
                <div class="form-group">
                    <label class="control-label">Event Date:</label>
                    <input type="text" class="form-control" name="date" placeholder="MM/DD/YYYY"  value="<?php echo $event['date'];?>">
                </div>
                <div class="form-group">
                    <label class="control-label">Event Location:</label>
                    <input type="text" data-check="[^A-z0-9 ,\\-]" placeholder="Event Location" id="event-loc"  class="form-control" name="location"  value="<?php echo $event['location'];?>">
                </div>

                <div class="form-group">
                    <label class="control-label">Speakers Names: <i id="addSpeaker"
                                                                    class="fa fa-plus btn btn-success"></i></label>
                    <div class="speakers">
                        <?php
                    if (count($speakers) > 0) {
                        $i = 0;
                        foreach ($speakers as $speaker) {
                            $i++;
                            ?>
                        <input type="text" data-check="[^A-z ]" class="form-control" id="speaker-name"
                               placeholder="Speaker's Name" name="speaker_name_<?php echo $i;?>" value="<?php echo $speaker['name']; ?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Speakers Images:</label>
                    <div class="speakers">
                    <?php $i = 0;
                        foreach ($speakers as $speaker) {
                            $i++;
                            ?>
                        <input name="speaker_image_<?php echo $i;?>" type="file" onchange="ValidateSingleInput(this);">
                        <?php } ?>
                    </div>
                </div>
            <?php } else {
                ?>
                    <div class="speakers">
                        <input type="text" data-check="[^A-z ]" class="form-control" id="speaker-name" placeholder="Speaker's Name" name="speaker_name_1" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Speakers Images:</label>
                    <div class="speakers">
                        <input name="speaker_image_1" type="file" onchange="ValidateSingleInput(this);">
                    </div>
                </div>
                <?php } ?>
                <div class="form-group">
                    <label class="control-label">Event Mission:</label>
                    <textarea class="form-control textarea" data-check="[^A-Za-z0-9.\\- ,]" id="event-mission"  placeholder="Event Mission" name="mission"><?php echo preg_replace("<<br />>", "",decode($event['mission']));?></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Event Goals:</label>
                    <textarea class="form-control textarea" id="event-goals" data-check="[^A-Za-z0-9.\\- ,]" placeholder="Event Goals" name="goals"><?php echo preg_replace("<<br />>", "",decode($event['goals']));?></textarea>
                </div>
                <div class="form-group">
                    <select class="form-control" name="event_type">
                        <option <?php echo $event['event_type'] === 'workshop' ? 'selected' : null ;?> value="workshop">Workshops</option>
                        <option <?php echo $event['event_type'] === 'visits' ? 'selected' : null ;?>value="visit">Visits</option>
                        <option <?php echo $event['event_type'] === 'sessions' ? 'selected' : null ;?>value="session">Sessions</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Event Description:</label>
                    <textarea name="description" class="form-control" cols="30" rows="10" data-check="[^\w ,\\-\\(.)]"> <?php echo preg_replace("<<br />>", "",decode($event['description']));?></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Upload Event Image:</label>
                    <input name="event_image" type="file" onchange="ValidateSingleInput(this);">
                </div>
                <input type="submit" class="btn btn-success editCheck" id="submit" value="Submit">
            </form>
        </div>
    </section>
            <div class="alert-box hidden">
                <div class="alert alert-danger h1">
                    Are you Sure You Want to Edit this Event?
                </div>
                <div class="btns" style="display:flex;justify-content: space-around;align-items: center;">
                    <div data-val="1" class="btn btn-danger btn-lg confirmDelete">Yes</div>
                    <div data-val="0" class="btn btn-info btn-lg cancelDelete" style="margin-left:20px;">No</div>
                </div>
            </div>
    <script src="js/event_validation.js"></script>
    <?php
        } else {
            header("refresh:0;url=events.php");
            exit();
        }
    } else {
        header("refresh:0;url=events.php");
        exit();
    }
        } elseif ($action === 'update') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //TODO: Put Old Pictures
        //TODO: handle empty speakers name
        if (isset($_POST['id'])) {
            $id = filter_var(intval($_POST['id']), FILTER_SANITIZE_NUMBER_INT);
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $date = date('Y-m-d',strtotime(filter_var($_POST['date'], FILTER_SANITIZE_STRING)));
            $image = 'images/events/' . sha1(substr($_FILES['event_image']['name'], 0, strlen($_FILES['event_image']['name']) - 5)) . substr($_FILES['event_image']['name'], strlen($_FILES['event_image']['name']) - 4);
            $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
            $description = encode(filter_var($_POST['description'], FILTER_SANITIZE_STRING));
            $speakersArray = array();
            $speakers_imagesArray = array();
            $mission = encode(filter_var($_POST['mission'], FILTER_SANITIZE_STRING));
            $goals = encode(filter_var(htmlspecialchars($_POST['goals']), FILTER_SANITIZE_STRING));
            $event_type = filter_var($_POST['event_type'], FILTER_SANITIZE_STRING);
            foreach ($_POST as $key => $value) {
                if (preg_match('/(speaker_name)/', $key)) {
                    $speakersArray[] = $value;
                }
            }
            $speakersArray = filter_var_array($speakersArray, FILTER_SANITIZE_STRING);
            $speakers = implode(',', $speakersArray);
            $query3 = $con->prepare("SELECT * FROM events WHERE id = ?");
            $query3->execute(array($id));
            $event = $query3->fetchAll(PDO::FETCH_ASSOC)[0];
            foreach ($_FILES as $key => $value) {
                if (preg_match('/(speaker_image)/', $key)) {
                    if (strlen($_FILES[$key]['name']) > 0) {
                        $speakerImgName = 'images/speakers/' . sha1(substr($_FILES[$key]['name'], 0, strlen($_FILES[$key]['name']) - 5)) . '_' . $key . substr($_FILES[$key]['name'], strlen($_FILES[$key]['name']) - 4);
                        move_uploaded_file($_FILES[$key]['tmp_name'], __DIR__ . $speakerImgName);
                    } else {
                        $speakerImgName = 'images/speakers/person-vector.jpg';
                    }
                    $speakers_imagesArray[] = $speakerImgName;
                }
            }
            $speakers_imagesArray = filter_var_array($speakers_imagesArray, FILTER_SANITIZE_STRING);
            $speakers_images = implode(',', $speakers_imagesArray);
            if ($event['image'] !== $image && !empty($_FILES['event_image']['tmp_name'])) {
                move_uploaded_file($_FILES['event_image']['tmp_name'], $image);
            } else {
                $image = $event['image'];
            }
            $query = $con->prepare("UPDATE `events` SET `title`=?,`image`=?,`date`=?,`location`=?,`description`=?,`speakers`=?,`speakers_images`=?, `mission`=?, `goals`=?, `event_type`=? WHERE id=?");
            $query->execute(array($name, $image, $date, $location, $description, $speakers, $speakers_images, $mission, $goals, $event_type, $id));
        }
        header("refresh:0;url=events.php");
        exit();
    } else {
        header("refresh:0;url=events.php");
        exit();
    }
    } else {
    header("refresh:0;url=events.php");
    exit();
}
?>
<?php
    require_once 'partials/footer.html';
    ob_end_flush();
?>

