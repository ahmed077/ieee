<?php
ob_start();
session_start();
$returnTop = false;
$title = 'schedule';
$caption = '<h2>Events Schedule</h2>';
require_once 'includes/init.php';
?>
<div class="schedule-content">
    <div class="container">
        <div class="row">
            <div class="schedule-table-heading">
                <ul>
                    <li><img src="images/schedule-clock.png" alt="images"></li>
                    <li>Sunday</li>
                    <li>Monday</li>
                    <li>Tuesday</li>
                    <li>Wednesday</li>
                    <li>Thursday</li>
                </ul>
            </div>
            <div class="schedule-table-content">
                <ul>
                    <li>week 4<span class="sec-dates">06/03/2018</span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                    <li class="design"><span>12:30pm-2:30pm <strong>Fund Rasing</strong></span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                </ul>
                <ul>
                    <li>week 5<span class="sec-dates">13/03/2018</span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                    <li class="design"><span>12:30pm-2:30pm <strong>Radio 101.1</strong></span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                </ul>
                <ul>
                    <li>week 6<span class="sec-dates">20/03/2018</span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                    <li class="design"><span style="font-size:11px">12:30pm-2:30pm<strong>Career Debate V2</strong></span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                </ul>
                <ul>
                    <li>week 7<span class="sec-dates">27/03/2018</span></li>
                    <li class="day-5 break"><span><strong>Break</strong></span></li>
                </ul>
                <ul>
                    <li>week 8<span class="sec-dates">03/04/2018</span></li>
                    <li class="day-5 break"><span><strong>Break</strong></span></li>
                </ul>
                <ul>
                    <li>week 9<span class="sec-dates">10/04/2018</span></li>
                    <li class="day-5 break"><span><strong>Break</strong></span></li>
                </ul>
                <ul>
                    <li>week 10<span class="sec-dates">17/04/2018</span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                    <li class="design"><span style="font-size:10px;">12:30pm-2:30pm <strong>Human Development</strong></span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                    <li class="psychology"><span>12:30pm-2:30pm <strong>ACM Seminar</strong></span></li>
                </ul>
                <ul>
                    <li>week 11<span class="sec-dates">24/04/2018</span></li>
                    <li class="day-5 break"><span><strong>Break</strong></span></li>
                </ul>
                <ul>
                    <li>week 12<span class="sec-dates">01/05/2018</span></li>
                    <li class="day-5 break"><span><strong>Break</strong></span></li>
                </ul>
                <!--<ul>
                    <li>week 13</li>
                    <li class="psychology"><span>4pm-5pm <strong>Psychology</strong></span></li>
                    <li class="english"><span>4pm-5pm <strong>English</strong></span></li>
                    <li class="biology"><span>4pm-5pm <strong>Biology</strong></span></li>
                    <li class="math"><span>4pm-5pm <strong>Mathemathics</strong></span></li>
                    <li class="design"><span>4pm-5pm <strong>Design</strong></span></li>
                </ul>
                -->
            </div>
            <div class="schedule-table-content-mobile">
                <ul>
                    <li>week 4<span class="sec-dates sec-dates-mob">06/03/2018</span></li>
                    <li class="design"><span>TUESDAY<strong>Fund Rasing</strong></span></li>
                </ul>
                <ul>
                    <li>week 5<span class="sec-dates sec-dates-mob">13/03/2018</span></li>
                    <li class="design"><span><strong>Radio 101.1</strong></span></li>
                </ul>
                <ul>
                    <li>week 6<span class="sec-dates sec-dates-mob">20/03/2018</span></li>
                    <li class="design"><span><strong>Career Debate V2</strong></span></li>
                </ul>
                <ul>
                    <li>week 10<span class="sec-dates sec-dates-mob">17/04/2018</span></li>
                    <li class="design"><span><strong>Human Development</strong></span></li>
                </ul>

                <!--<ul>
                    <li>week 12</li>
                    <li class="psychology"><span>9am-10am <strong>Psychology</strong></span></li>
                    <li class="biology"><span>10am-11am <strong>Biology</strong></span></li>
                    <li class="design"><span>11am-12pm <strong>Design</strong></span></li>
                    <li class="psychology"><span>1pm-2pm <strong>Psychology</strong></span></li>
                    <li class="psychology"><span>2pm-3pm <strong>Psychology</strong></span></li>
                    <li class="biology"><span>3pm-4pm <strong>Biology</strong></span></li>
                    <li class="design"><span>4pm-5pm <strong>Design</strong></span></li>
                </ul>
                 <ul>
                    <li>week 13</li>
                    <li class="psychology"><span>9am-10am <strong>Psychology</strong></span></li>
                    <li class="biology"><span>10am-11am <strong>Biology</strong></span></li>
                    <li class="design"><span>11am-12pm <strong>Design</strong></span></li>
                    <li class="psychology"><span>1pm-2pm <strong>Psychology</strong></span></li>
                    <li class="psychology"><span>2pm-3pm <strong>Psychology</strong></span></li>
                    <li class="biology"><span>3pm-4pm <strong>Biology</strong></span></li>
                    <li class="design"><span>4pm-5pm <strong>Design</strong></span></li>
                </ul>-->
            </div>
        </div>
    </div>
</div>
<?php
require_once 'partials/footer.html';
ob_end_flush();
?>