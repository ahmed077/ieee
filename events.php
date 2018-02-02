<?php
ob_start();
$title = 'events';
$caption = '<h2>Our Events</h2>';
$returnTop = false;
$member = 1;
$action = isset($_GET['r']) ? $_GET['r'] : 'all';
$noBtns = false;
if ($action === 'add' && $member === 1) {
    $caption = '<h2>Add Event</h2>';
}
require_once 'includes/init.php';
if ($action === 'all') { ?>
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
            <div class="row add-event">
                <a href="events.php?r=add" id="addS">
                    <div class="btn btn-lg btn-success"><i class="fa fa-plus"></i> Add Event</div>
                </a>
            </div>
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
    <?php foreach ($events as $event) {?>
                <div class="col-xs-6 col-lg-3 workshop">
                    <div class="events-item">
                        <div class="events-item-img">
                            <a href="events.php?r=event&id=<?php echo $event['id'];?>" style="background-image:url('<?php echo $event['image'];?>');">
                            </a>
                        </div>
                        <div class="events-item-info">
                            <h3><a href="events.php?r=event&id=<?php echo $event['id'];?>">
                                    <?php echo $event['title'];?>
                                </a></h3><br><br>
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
                            <p><?php echo substr($event['description'], 0, 60);?>...</p>
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
<?php } else {
        echo '<section class="events-list text-center">No Events Added</section>';
    }
} elseif ($action === 'event') {
    if (isset($_GET['id'])) {
        $query = $con->prepare('SELECT * FROM events WHERE id=?');
        $query->execute(array($_GET['id']));
        if ($query->rowCount() > 0) {
            echo "Event Does Exist";
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

        ?>

            <section class="events-single-content">
                <div class="container">
                    <div class="row">
                        <div class="events-single-about col-md-4">
                            <h3><?php echo $event['title'];?></h3>

                            <h4>Mission:</h4><br>
                            <div class="event-des">
                                <ol class="event-list">
                                    <li>Debating the different careers and showing the possible ways to achieve that career through education or using different skills.</li>
                                    <li>Getting to know more about the labor market and understanding how graduates start their career in it.</li>
                                    <li>Learning how to create your own C.V. and know how to design and paln for your future.</li>
                                    <li>Having a chance to know tips and how they achieved their goals.</li>
                                    <li>Showing the difference between career and avocation.</li>
                                    <li>Teaching how to make decisions by the experience of the others.</li>
                                </ol>
                            </div>

                            <h4>More About this Event:</h4><br>
                            <p><?php echo $event['description'];?></p>
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
                                <div class="col-xs-6 col-lg-3 workshop">
                                    <div class="events-item">
                                        <div class="events-item-img">
                                            <a href="events.php?r=event&id=<?php echo $event['id'];?>">
                                                <img src="<?php echo $event['image'];?>" alt="Event Image">
                                            </a>
                                        </div>
                                        <div class="events-item-info">
                                            <h3><a href="events.php?r=event&id=<?php echo $event['id'];?>">
                                                    <?php echo $event['title'];?>
                                                </a></h3><br><br>
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
                                            <p><?php echo substr($event['description'], 0, 60);?>...</p>
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
            <?php } else {
                echo '<section class="events-list text-center">No Other Events</section>';
            }
        } else {
            echo "Event Does Not Exist";
        }
    } else {
        echo "Event's ID Does Not Exist";
    }
} elseif ($action === 'add' && $member === 1) {
    $noBtns = true;
    ?>
    <section class="add-event-form">
        <div class="container">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?r=insert' ?>" id="event-form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Event Name:</label>
                    <input type="text" data-check="[^A-z0-9 ]" class="form-control"  id="event-name" placeholder="Event Title" name="name">
                </div>
                <div class="form-group">
                    <label class="control-label">Event Date:</label>
                    <input type="text" class="form-control" name="date" placeholder="MM/DD/YYYY">
                </div>
                <div class="form-group">
                    <label class="control-label">Event Location:</label>
                    <input type="text" data-check="[^A-z0-9 ,\\-]" placeholder="Event Location" id="event-loc"  class="form-control" name="location">
                </div>
                <div class="form-group">
                    <label class="control-label">Speakers Names: <i id="addSpeaker" class="fa fa-plus btn btn-success"></i></label>
                    <div class="speakers">
                        <input type="text" data-check="[^A-z ]" class="form-control" id="speaker-name" placeholder="Speaker's Name" name="speaker_name_1">
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
                    <input type="text" class="form-control" data-check="[^A-z0-9 ,\\-\\(.)]" id="event-mission"  placeholder="Event Mission" name="mission">
                </div>
                <div class="form-group">
                    <label class="control-label">Event Goals:</label>
                    <input type="text" class="form-control" id="event-goals" data-check="[^A-z0-9 ,\\-\\(.)]" placeholder="Event Goals" name="goals">
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
                    <textarea name="description" class="form-control" cols="30" rows="10" data-check="[^\w ,\\-\\(.)]"></textarea>
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
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
        $image = 'images/events/' . sha1(substr($_FILES['event_image']['name'], 0, strlen($_FILES['event_image']['name']) - 5)) . substr($_FILES['event_image']['name'], strlen($_FILES['event_image']['name']) - 4);
        $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $speakersArray = array();
        $speakers_imagesArray = array();
        $mission = filter_var($_POST['mission'], FILTER_SANITIZE_STRING);
        $goals = filter_var($_POST['goals'], FILTER_SANITIZE_STRING);
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
                    move_uploaded_file($_FILES[$key]['tmp_name'], __DIR__ . $speakerImgName);
                } else {
                    $speakerImgName = 'images/speakers/person-vector.jpg';
                }
                $speakers_imagesArray[] = $speakerImgName;
            }
        }
        echo '<pre>'; print_r($_POST);echo '</pre>';
        echo '<pre>'; print_r($_FILES);echo '</pre>';
        $speakers_imagesArray = filter_var_array($speakers_imagesArray, FILTER_SANITIZE_STRING);
        $speakers_images = implode(',', $speakers_imagesArray);
        move_uploaded_file($_FILES['event_image']['tmp_name'], $image);
        $query = $con->prepare("INSERT INTO events 
                                    (`title`,`image`,`date`,`location`,`description`,`speakers`,`speakers_images`,`mission`,`goals`,`event_type`) 
                                    VALUES (?,?,?,?,?,?,?,?,?,?)");
        $query->execute(array($name, $image, $date, $location, $description, $speakers, $speakers_images, $mission, $goals, $event_type));
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

