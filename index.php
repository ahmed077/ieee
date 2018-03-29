<?php
ob_start();
session_start();
$title = 'home';
$returnTop = false;
$caption = '<h2>Welcome to <span>IEEE PUA SB</span></h2><p>Welcome to the world\'s largest professional organization dedicated to advancing technological innovation and excellence for the benefit of humanity.</p>';
require_once 'includes/init.php';
/*
$subscribe = false;
$query = $con->prepare("SELECT * FROM events WHERE event_open = 1");
$query->execute();
if ($query->rowCount() > 0) {
    $subscribe = true;
?>
    <div class="events-item-link">
        <?php
        if ($query->rowCount() === 1) {
            $event = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            ?>
            <a href="event-attendee.php?id==<?php echo $event['id'];?>" class="hvr-push">Subscribe to <?php echo ucfirst($event['title']); ?></a>
        <?php } else { ?>
            <a href="event-attendee.php" class="hvr-push">View Available Events</a>
        <?php } ?>
    </div>
    <?php }*/ ?>
    <section class="featured-box white-bg">

        <div class="row">
            <div class="col-sm-4 col-md-4">
                <div class="box-1">
                    <a href="volunteers.php">
                        Volunteers <!-- <span>Events</span> -->
                    </a>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="box-2">
                    <a href="board.html">
                        Board <!-- <span>Stories</span> -->
                    </a>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="box-3">
                    <a href="committee.html">
                        Committees <!-- <span>Benefits</span> -->
                    </a>
                </div>
            </div>
        </div>

    </section>
<?php
    $query=$con->prepare("SELECT * FROM events WHERE mega = TRUE and event_open = 1");
    $query->execute(array());
    if ($query->rowCount() > 0) {
        $megaEvent = $query->fetch(PDO::FETCH_ASSOC);
        ?>
        <section class="megaEvent">
            <img src="<?php echo $megaEvent['image'];?>" alt="Mega Event">
            <a href="mega.php?r=event&id=<?php echo $megaEvent['id'];?>" class="btn btn-success btn-lg col-xs-12 megaBtn">Read More &amp; Register</a>
        </section>
    <?php } ?>
    <section class="we-have-faith">
        <div class="section-header col-sm-6 pull-left">
            <h3 class="icon"><img src="images/mission-icon.png" alt="Mission Icon" title="Mission Icon" height="100"
                                  width="100"></h3>
            <h3>mission</h3>
            <p>
                IEEE's core purpose is to foster technological innovation and excellence for the benefit of
                humanity.
            </p>
        </div>
        <div class="section-header vision col-sm-6 pull-left">
            <h3 class="icon"><i class="fa fa-eye" aria-hidden="true"></i></h3>
            <h3>vision</h3>
            <p>
                IEEE will be essential to the global technical community and to technical professionals everywhere,
                and be universally recognized for the contributions of technology and of technical professionals in
                improving global conditions.
            </p>
        </div>
    </section>
    <section class="achievements">
        <div class="container">
            <div class="row">
                <div class="section-header">
                    <h2>IEEE PUA SB NUMBERS</h2>
                </div>
            </div>
            <div class="row">
                <div class="section-content">
                    <div class="col-sm-3">
                        <h3 class="home-count">2013</h3>
                        <p>Year Founded</p>
                    </div>
                    <div class="col-sm-3">
                        <h3 class="home-count">32</h3>
                        <p>Event</p>
                    </div>
                    <div class="col-sm-3">
                        <h3 class="home-count">11</h3>
                        <p>Committee</p>
                    </div>
                    <div class="col-sm-3">
                        <h3 class="home-count">62</h3>
                        <p>Volunteer</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
$query = $con->prepare('SELECT * FROM events ORDER BY DATE DESC LIMIT 4');
$query->execute();
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
                                <a class="home-event-img bg" href="events.php?r=event&id=<?php echo $event['id'];?>" style="background-image:url(<?php echo $event['image'];?>);">
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
<?php } else {
    echo '<section class="events-list text-center h1">No Events Added</section>';
}
    $query = $con->prepare("SELECT * FROM gallery LIMIT 5");
    $query->execute(array());
    if ($query->rowCount()>0) {
        $images = $query->fetchAll(PDO::FETCH_ASSOC);
        $admin = (isset($_SESSION['admin']) && in_array(intval($_SESSION['admin']),[1,2,3]))? true : false;
        $i=0;
?>

    <section class="featured-gallery">
        <div class="row home-gallery">
            <?php foreach ($images as $image) {$i++;?>
            <div class="col-sm-<?php echo $i==1?6:3;?> gallery-item">
                    <span class="gallery-img bg flex" data-featherlight="#content-<?php echo $i;?>" style="background-image:url('<?php echo $image['url'];?>')">
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
        </div>
    </section>
<?php } ?>

    <section class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="tab-content">
                        <div class="tab-pane arabic active" id="testimonial-1">
                            " لن اجامل ان قلت اني اشرف الان على افضل فريق عمل انضممت اليه ، انا فخور و ممتن لليوم الذي شغلت فيه هذا المنصب الذي اعتبره واحد من اهم المناصب التي تقلدتها يوما او ساكون فيها في المستقبل " </div>
                        <div class="tab-pane" id="testimonial-2">
                            "The only place where you can have fun while you learn."
                        </div>
                        <div class="tab-pane " id="testimonial-3">
                            "We have always been fueled by an eager passion for sharing knowledge."
                        </div>
                        <div class="tab-pane" id="testimonial-4">
                            "Each one of us has the power to change the world. This is how we started IEEE PUA Student Branch."
                        </div>
                        <div class="tab-pane" id="testimonial-5">
                            "For true volunteers, I would like to thank all the people working in IEEEPUASB organization.This organization provides opportunities to learn and practice the soft and hard skills that you need so don't miss this opportunity."
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <ul class="nav">
                        <li>
                            <a href="#testimonial-2" data-toggle="tab">
                                <img src="images/quotes/abdelrahman-nasr.png" alt="image">
                                <strong>Abdelrahman Nasr El-Din</strong>
                                <span>Former Chairman</span>
                            </a>
                        </li>

                        <li>
                            <a href="#testimonial-5" data-toggle="tab">
                                <img src="images/quotes/ahmed-hesham.png" alt="image">
                                <strong>Ahmed Hesham</strong>
                                <span>Co-founder</span>
                            </a>
                        </li>

                        <li class="active">
                            <a href="#testimonial-1" data-toggle="tab">
                                <img src="images/quotes/karim-soliman.jpg" alt="image">
                                <strong>Karim Soliman</strong>
                                <span>Counselor of IEEE PUA SB</span>
                            </a>
                        </li>

                        <li>
                            <a href="#testimonial-4" data-toggle="tab">
                                <img src="images/quotes/osama-abulkhair.jpg" alt="image">
                                <strong>Osama Abulkhair</strong>
                                <span>Counselor of IEEE PUA SB</span>
                            </a>
                        </li>
                        <li>
                            <a href="#testimonial-3" data-toggle="tab">
                                <img src="images/quotes/abdelrahman-geddawi.png" alt="image">
                                <strong>Abdelrahman El-Gedawi</strong>
                                <span>Former Chairman</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!--
    <section class="featured-video">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Watch Our Video</h2>
                    <p>This Video talking about bla blaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa blaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa blaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                </div>
                <div class="col-sm-6">
                    <div class="content-video">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/wJyQwLfPtZ4?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
-->


    <!--<section class="sponsor">
			<div class="container">
				<div class="row">
					<div class="sponsor-logo">
						<div class="col-sm-3">
							<img src="images/sponsor-logo-1.png" alt="image">
						</div>
						<div class="col-sm-3">
							<img src="images/sponsor-logo-2.png" alt="image">
						</div>
						<div class="col-sm-3">
							<img src="images/sponsor-logo-3.png" alt="image">
						</div>
						<div class="col-sm-3">
							<img src="images/sponsor-logo-4.png" alt="image">
						</div>
					</div>
				</div>
			</div>
		</section>-->

    <!--<section class="newsletter">
			<div class="container">
				<div class="row">
					<div class="newsletter-content">
						<div class="col-md-6">
							<h2><strong>Get The Latest News From Sekolah!</strong> Join our newsletter now</h2>
						</div>
						<div class="col-md-6">
							<input type="email" placeholder="Enter your e-mail address">
							<input class="hvr-push" type="submit" value="Subscribe">
						</div>
					</div>
				</div>
			</div>
		</section> -->
<?php
require_once 'partials/footer.html';
ob_end_flush();
?>