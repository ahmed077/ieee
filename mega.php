<?php
ob_start();
session_start();
$returnTop = false;
$action = isset($_GET['r']) ? $_GET['r'] : 'all';
$noBtns = false;
require_once 'includes/connect.php';
require_once 'includes/functions.php';
$_SESSION['admin'] = isset($_SESSION['admin']) ? $_SESSION['admin'] : 0 ;
if (in_array($_SESSION['admin'],[1,2,3])) {
    $admin = true;
} else {
    $admin = false;
}
if ($action === 'all') {
    $title="Our MEGA Events";
    $caption="<h2>Mega Events</h2>";
    $headerClass='events-hero';
    require_once 'partials/header.html';?>
    <section class="events-list">
            <div class="container">
                <div id="events-list" class="row">
                <?php if (isset($_SESSION['admin']) && in_array($_SESSION['admin'],[1,2])) {?>
                    <div class="row add-event" style="margin-top:0 !important;">
                        <a href="mega.php?r=add" id="addM" style="margin-left:20px;margin-bottom: 30px;">
                            <div class="btn btn-lg btn-success"><i class="fa fa-plus"></i> Add Mega Event</div>
                        </a>
                    </div>
    <?php }
    $query2 = $con->prepare('SELECT * FROM events WHERE `mega` = 1 ORDER BY DATE DESC');
    $query2->execute();
    if ($query2->rowCount() > 0) {
        $megaEvents = $query2->fetchAll(PDO::FETCH_ASSOC);
        ?>
                    <?php foreach ($megaEvents as $megaEvent) { ?>
                        <div class="col-xs-12 col-sm-6 <?php echo $megaEvent['event_type'];?>">
                            <div class="events-item">
                                <div class="events-item-img">
                                    <a href="mega.php?r=event&id=<?php echo $megaEvent['id']; ?>"
                                       style="background-image:url('<?php echo $megaEvent['image']; ?>');">
                                    </a>
                                </div>
                                <div class="events-item-info">
                                    <h3><a href="mega.php?r=event&id=<?php echo $megaEvent['id']; ?>">
                                            <?php echo $megaEvent['title']; ?>
                                        </a></h3><br><br>
                                    <ul class="event-meta">
                                        <li>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $megaEvent['date']; ?>
                                        </li>
                                        <li>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <?php echo $megaEvent['location']; ?>
                                        </li>
                                    </ul>
                                    <p><?php echo substr(decode($megaEvent['description']), 0, 200); ?>...</p>
                                </div>
                                <div class="events-item-link">
                                    <a href="mega.php?r=event&id=<?php echo $megaEvent['id']; ?>" class="hvr-push">Read More</a>
                                </div>
                                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) { ?>
                                    <hr>
                                    <div class="col-xs-12" style="padding-bottom:20px;display:flex;justify-content:space-around">
                                        <a class="deleteCheck"
                                           href="mega.php?r=delete&id=<?php echo $megaEvent['id']; ?>">
                                            <div class="btn btn-danger"><i class="fa fa-remove"></i> Delete</div>
                                        </a>
                                        <a href="mega.php?r=edit&id=<?php echo $megaEvent['id']; ?>">
                                            <div class="btn btn-success"><i class="fa fa-edit"></i> Edit</div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
    <?php } else { ?>
                    <section class="events-list text-center h1">No Mega Events Added</section>
<?php } ?>
                    <div class="alert-box hidden">
                        <div class="alert alert-danger h1">
                            Are you Sure You Want to Delete this Event?
                        </div>
                        <div class="btns" style="display:flex;justify-content: space-around;align-items: center;">
                            <div data-val="1" class="btn btn-danger btn-lg confirmDelete">Yes</div>
                            <div data-val="0" class="btn btn-info btn-lg cancelDelete" style="margin-left:20px;">No</div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
<?php
} elseif ($action === 'event') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = $con->prepare("SELECT * FROM events WHERE `id` = ? and mega = TRUE");
        $query->execute(array($id));
        if ($query->rowCount() > 0) {
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $title = ucfirst($data['title']);
            $date = $data['mega_date'];
            $caption = '<span class="tag">MEGA</span><h2>' . $title . '</h2><p>' . $data["location"] . ' | <span>' . $date . '</span></p>';
            $headerClass = 'events-single-hero';
            $mega = true;
            require_once 'partials/header.html';
            if (intval($data['event_open']) === 1) {
                $open = true;
            } else {
                $open = false;
            }
            ?>
            <section class="events-single-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-<?php echo $open ? '6' : '12'; ?>">
                            <h3>EVENT</h3>
                            <p><?php echo $data['description']; ?></p>
                            <p class="arabic"><?php echo $data['arabic_description']; ?></p>
                            <?php if (isset($_SESSION['admin']) && in_array($_SESSION['admin'], [1, 2])) { ?>
                                <hr>
                                <div class="col-xs-12"
                                     style="padding-bottom:20px;display:flex;justify-content:space-around">
                                    <a class="deleteCheck"
                                       href="mega.php?r=delete&id=<?php echo $id; ?>">
                                        <div class="btn btn-danger"><i class="fa fa-remove"></i> Delete</div>
                                    </a>
                                    <a href="mega.php?r=edit&id=<?php echo $id; ?>">
                                        <div class="btn btn-success"><i class="fa fa-edit"></i> Edit</div>
                                    </a>
                                    <a href="events.php?r=toggle&id=<?php echo $_GET['id']; ?>">
                                        <span
                                            class="btn btn-warning"><?php echo $open ? 'Close Event' : 'Open Event'; ?></span>
                                    </a>
                                </div>
                                <div class="alert-box hidden">
                                    <div class="alert alert-danger h1">
                                        Are you Sure You Want to Delete this Event?
                                    </div>
                                    <div class="btns"
                                         style="display:flex;justify-content: space-around;align-items: center;">
                                        <div data-val="1" class="btn btn-danger btn-lg confirmDelete">Yes</div>
                                        <div data-val="0" class="btn btn-info btn-lg cancelDelete"
                                             style="margin-left:20px;">No
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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
                            <div id="leave-page" class="alert h1 <?php echo $class; ?>"
                                 style="position: fixed;top: -28px;left: 0;width: 100%;height: calc(100% + 28px);display: flex;justify-content: center;align-items: center;z-index: 9999;">
                                <?php echo $content; ?>
                                <script>
                                    document.body.onload = function () {
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
                        <?php if ($open) { ?>
                            <div class="events-single-Registeration col-md-4 col-md-offset-2">
                                <h3>Please Fill Form Below</h3>
                                <form method="POST" action="registration.php?id=<?php echo $id; ?>" id="megaReg">
                                    <style>
                                        .error {
                                            border-color: red;
                                        }
                                    </style>
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input name="name" type="text" data-check="[a-zA-Z][a-zA-Z ]{4,}"
                                               class="form-control name" placeholder="Enter Your Name"
                                               autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email address</label>
                                        <input name="email" type="email" data-check="^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*
                        @[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$;" class="form-control email"
                                               id="exampleInputEmail3" placeholder="Email" autocomplete="off">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email
                                            with anyone else.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mobile Number</label>
                                        <input name="mobile" type="text" data-check="[0-9]{11}"
                                               class="form-control mobile" placeholder="01xxxxxxxxx" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="datepick">Birthday Date</label>
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input name="date" type='text' class="form-control date date" placeholder=""
                                                   required/>
                                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">14 Digit National ID </label>
                                        <input name="nationalid" type="text" data-check="[0-9]{14}"
                                               class="form-control nationalid" placeholder="Enter your national ID"
                                               autocomplete="off">
                                    </div>
                                    <select name="education" class="form-control sel3 education">
                                        <option disabled="disabled" selected="selected" value="0">Education level
                                        </option>
                                        <option value="High School">High School</option>
                                        <option value="Collage">Collage</option>
                                        <option value="Graduated">Graduated</option>
                                    </select>
                                    <div class="form-group">
                                        <label for="">University / School</label>
                                        <input name="university" type="text" pattern="[a-zA-Z][a-zA-Z ]{4,}"
                                               class="form-control university" placeholder="University / School"
                                               autocomplete="off">
                                    </div>
                                    <select name="a_status" class="form-control sel a_status">
                                        <option disabled="disabled" selected="selected" value="0">Acadimic Status
                                        </option>
                                        <option value="Undergraduate">Undergraduate</option>
                                        <option value="Graduate">Graduate</option>
                                    </select>
                                    <select name="ieeemember" id="membershipS" class="form-control sel2 ieeemember">
                                        <option disabled="disabled" selected="selected" value="0">IEEE Membership
                                        </option>
                                        <option value="Member">Membership</option>
                                        <option value="Non-Member">Non-Membership</option>
                                    </select>
                                    <div class="form-group hide membershipid">
                                        <label for="">Membership ID</label>
                                        <input name="membership" type="text" data-check="[0-9]"
                                               class="form-control membership" placeholder="Membership ID"
                                               autocomplete="off">
                                    </div>
                                    <button type="submit" class="btn btn-primary submit">Submit</button>
                                    <?php if ($admin) { ?>
                                        <a href="getdata.php?id=<?php echo $id ?>">
                                            <div class="btn btn-success">Get Data</div>
                                        </a>
                                        <span class="alert alert-success">
                                <?php
                                $query = $con->prepare("SELECT COUNT(`id`) FROM `registeration` WHERE event_id = ?");
                                $query->execute(array($id));
                                echo $query->fetch()['COUNT(`id`)'];
                                ?>
                                </span>
                                    <?php } ?>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <section class="contact-form" style="background-color:#fff;">
                <div class="container">
                    <div id="mapmap" class="google-maps clearfix" style="padding:  0;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1706.2069409499832!2d29.909723558331613!3d31.209260909612375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f5c38a0562fe85%3A0xa34cc632ec23e7!2sBibliotheca+Alexandrina!5e0!3m2!1sen!2seg!4v1519791639941"
                            width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </section>
        <?php } else {
            header("Location:mega.php");
            exit();
        }
    }
} elseif(isset($_SESSION['admin']) && in_array($_SESSION['admin'],[1,2,3])) {
    $title = ucfirst($action) . ' Event';
    $caption = '<h2>' . $title . '</h2>';
    $headerClass='events-hero';
    require_once 'partials/header.html';
    if ($action === 'edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = $con->prepare("SELECT * FROM events WHERE id = ?");
            $query->execute(array($id));
            if ($query->rowCount() > 0) {
                $event = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                <section class="add-event-form" id="edit-event-form">
                    <div class="container">
                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?r=update'; ?>" id="event-form" method="post"
                              enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <div class="form-group">
                                <label class="control-label">Event Name:</label>
                                <input type="text" data-check="[^A-Za-z0-9. ]" class="form-control" id="event-name"
                                       placeholder="Event Title" name="name" value="<?php echo $event['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Event Start Date:</label>
                                <input type="text" class="form-control" name="date" placeholder="MM/DD/YYYY" value="<?php echo $event['date']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Event Location:</label>
                                <input type="text" data-check="[^A-Za-z0-9 ,\\-]" placeholder="Event Location"
                                       id="event-loc" class="form-control" name="location" value="<?php echo $event['location']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Mega Days:</label>
                                <input class="form-control" data-check="[^A-Za-z0-9.\\- ,]" id="event-mega-date"
                                       placeholder="Mega Event Date" name="mega_date" value="<?php date('m-d-Y',strtotime($event['mega_date'])); ?>"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">English Description:</label>
                                <textarea name="description" class="form-control textarea" cols="30" rows="10"
                                          data-check="[^A-Za-z0-9.\\- ,]" placeholder="English Description"><?php echo $event['description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Arabic Description:</label>
                                <!--                        TODO::ARABIC RegEx For Validation-->
                                <textarea class="form-control textarea" id="arabic-description" cols="30" rows="10"
                                          data-check="[.]" placeholder="Arabic Description"
                                          name="arabic_description"><?php echo $event['arabic_description']; ?></textarea>
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
                <?php
            } else {
                header('Location:mega.php');
                exit();
            }
        } else {
            header('Location:mega.php');
            exit();
        }
    } elseif ($action === 'add') {
        ?>
        <section class="add-event-form">
            <div class="container">
                <form action="<?php echo $_SERVER['PHP_SELF'] . '?r=insert' ?>" id="event-form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label">Event Name:</label>
                        <input type="text" data-check="[^A-Za-z0-9. ]" class="form-control"  id="event-name" placeholder="Event Title" name="name">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Event Start Date:</label>
                        <input type="text" class="form-control" name="date" placeholder="MM/DD/YYYY">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Event Location:</label>
                        <input type="text" data-check="[^A-Za-z0-9 ,\\-]" placeholder="Event Location" id="event-loc"  class="form-control" name="location">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Mega Days:</label>
                        <input class="form-control" data-check="[^A-Za-z0-9.\\- ,]" id="event-mega-date"  placeholder="Mega Event Date" name="mega_date"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">English Description:</label>
                        <textarea name="description" class="form-control textarea" cols="30" rows="10" data-check="[^A-Za-z0-9.\\- ,]" placeholder="English Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Arabic Description:</label>
<!--                        TODO::ARABIC RegEx For Validation-->
                        <textarea class="form-control textarea" id="arabic-description" cols="30" rows="10" data-check="[.]" placeholder="Arabic Description" name="arabic_description"></textarea>
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
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $date = date('Y-m-d',strtotime(filter_var($_POST['date'], FILTER_SANITIZE_STRING)));
        $image = 'images/events/' . sha1(substr($_FILES['event_image']['name'], 0, strlen($_FILES['event_image']['name']) - 5)) . substr($_FILES['event_image']['name'], strlen($_FILES['event_image']['name']) - 4);
        $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
        $mega_date = filter_var($_POST['mega_date'], FILTER_SANITIZE_STRING);
        $description = encode(filter_var($_POST['description'], FILTER_SANITIZE_STRING));
        $arabic_description = encode(filter_var($_POST['arabic_description'], FILTER_SANITIZE_STRING));
        $mega = true;
        move_uploaded_file($_FILES['event_image']['tmp_name'], $image);
        $query2 = $con->prepare("SELECT * FROM events WHERE event_open = 1 and mega = 1");
        $query2->execute(array());
        if ($query2->rowCount() > 0) {
            $events = $query2->fetchAll(PDO::FETCH_ASSOC)[0];
            foreach ($events as $event) {
                $query3 = $con->prepare("UPDATE events SET (`event_open`) VALUES (?) WHERE id=?");
                $query3->execute(array($event['id']));
            }
        }
        $query = $con->prepare("INSERT INTO events 
                                    (`title`,`image`,`date`,`location`,`description`,`arabic_description`,`event_open`,`event_type`,`mega`,`mega_date`) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $query->execute(array($name, $image, $date, $location, $description, $arabic_description, 1, 'mega', $mega,$mega_date));
        $title='';
        require_once 'partials/header.html';
        ?>
        <div class="alert alert-success text-center others-section" style="font-size:30px">Adding Your Event</div>
        <?php
        header("refresh:1;url=mega.php");
        exit();
    } elseif ($action === 'update') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //TODO: Put Old Pictures
            //TODO: handle empty speakers name
            if (isset($_POST['id'])) {
                $id = filter_var(intval($_POST['id']), FILTER_SANITIZE_NUMBER_INT);
                $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
                $mega_date = filter_var($_POST['mega_date'], FILTER_SANITIZE_STRING);
                $date = date('Y-m-d',strtotime(filter_var($_POST['date'], FILTER_SANITIZE_STRING)));
                $image = 'images/events/' . sha1(substr($_FILES['event_image']['name'], 0, strlen($_FILES['event_image']['name']) - 5)) . substr($_FILES['event_image']['name'], strlen($_FILES['event_image']['name']) - 4);
                $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
                $description = encode(filter_var($_POST['description'], FILTER_SANITIZE_STRING));
                $arabic_description = encode(filter_var($_POST['arabic_description'], FILTER_SANITIZE_STRING));

                $query3 = $con->prepare("SELECT * FROM events WHERE id = ?");
                $query3->execute(array($id));
                $event = $query3->fetchAll(PDO::FETCH_ASSOC)[0];

                if ($event['image'] !== $image && !empty($_FILES['event_image']['tmp_name'])) {
                    move_uploaded_file($_FILES['event_image']['tmp_name'], $image);
                } else {
                    $image = $event['image'];
                }
                echo '<pre>';print_r($_POST); echo '</pre>';
                $query = $con->prepare("UPDATE `events` SET `title`=?,`image`=?,`date`=?,`location`=?,`description`=?,`arabic_description`=?,`mega_date`=? WHERE id=?");
                $query->execute(array($name, $image, $date, $location, $description,$arabic_description,$mega_date, $id));
            }
            header("refresh:0;url=mega.php");
            exit();
        } else {
            header("refresh:0;url=mega.php");
            exit();
        }
    } elseif ($action === 'delete') {
        $query = $con->prepare("DELETE FROM `events` WHERE `id` = ?");
        $query->execute(array($_GET['id']));
        header("refresh:0;url=mega.php");
        exit();
    } else {
        header("refresh:0;url=mega.php");
        exit();
    }
}
?>
<?php
require_once 'partials/footer.html';
ob_end_flush();
?>