<?php
ob_start();
session_start();
$returnTop = false;
$title = 'courses';
$headerClass = 'events-hero';
$caption = '<h2>Courses &amp; Certification</h2>';
require_once 'includes/init.php';
?>
<section class="details">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="certificate">
                    <div class="color1">
                       <h2>Check Certificate</h2>
                       <form action="">
                           <input type="text" id="serial" placeholder="Enter Certificate Serial">
                           <input type="submit" value="CHECK">
                       </form>
                       <div class="warning hide">
                           <p>Please Enter Correct Serial</p>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="offline">
                    <a href="#">
                        <div class="color2">
                            <h2>Offline Courses</h2>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="online">
                    <a href="#">
                        <div class="color3">
                            <h2>Online Courses</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'partials/footer.html';
ob_end_flush();
?>