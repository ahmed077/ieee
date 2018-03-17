<?php
ob_start();
session_start();
$title = 'login';
$caption = '<h2>Sign In</h2>';
require_once 'includes/init.php';
?>

    <section class="sign-in-form">

        <div class="container">

            <div class="section-content">
                <h3>Please Fill The Form Below</h3>

                <div class="um um-login um-2882">

                    <div class="um-form">

                        <form method="post" action="login.php" autocomplete="off">

                            <div class="um-row _um_row_1 " style="margin: 0 0 30px 0;">

                                <div class="um-col-131">

                                    <div class="um-field um-field-username um-field-text" data-key="username">

                                        <div class="um-field-label">
                                            <label for="username-2882">Username or E-mail
                                        </label>

                                            <div class="clearfix">
                                            </div>
                                        </div>

                                        <div class="um-field-area">
                                            <input autocomplete="off" class="um-form-field valid " type="text" name="username" id="username-2882" value="" placeholder="" data-validate="unique_username_or_email" data-key="username" />
                                        </div>
                                    </div>

                                    <div class="um-field um-field-user_password um-field-password" data-key="user_password">

                                        <div class="um-field-label">
                                            <label for="user_password-2882">Password
                                            </label>

                                            <div class="clearfix">
                                            </div>
                                        </div>

                                        <div class="um-field-area">
                                            <input class="um-form-field valid " type="password" name="password" id="user_password-2882" value="" placeholder="" data-validate="" data-key="user_password" />
                                        </div>
                                    </div>
                                </div>

                                <div class="um-col-132">
                                </div>

                                <div class="um-col-133">
                                </div>

                                <div class="clearfix">
                                </div>
                            </div>
                            <input type="hidden" name="form_id" id="form_id" value="2882" />
                            <input type="hidden" name="timestamp" id="timestamp" value="1506685772" />

                            <div class="um-col-alt">

                                <div class="um-field um-field-c">

                                    <div class="um-field-area">
                                        <label class="um-field-checkbox active"> 
                                            <input type="checkbox" name="rememberme" value="1" checked />

                                            <span class="um-field-checkbox-option">
                                             Keep me signed in
                                            </span> 
                                        </label>
                                    </div>
                                </div>

                                <div class="clearfix">
                                </div>

                                <div class="um-left um-half scl">
                                    <input type="submit" value="Login" class="um-button" />
                                </div>

                                <div class="um-right um-half scl">
                                    <a href="register.html" class="um-button um-alt">Register</a>
                                </div>

                                <div class="clearfix">
                                </div>
                            </div>

                            <div class="um-col-alt-b col-xs-12 col-sm-12 col-md-12 col-lg-12"> <a href="forget-pass.html" class="um-link-alt">Forgot your password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="colophon" class="site-footer">
        <div class="footer-info">
            <div class="container">
                <div class="row">
                    <div class="footer-logo col-md-3">
                        <a href="index.html" title="Sekolah" rel="home">
								<img src="images/ieee-logo.png" alt=IEEEPUAsb_logo title="IEEE|PUA SB" title="IEEE|PUA SB">
							</a>
                    </div>
                    <div class="footer-menu col-md-9">
                        <div class="footer-links">
                            <ul>
                                <li style="color: white">About</li>
                                <li><a href="contact.html">Contact Us</a></li>
                                <li><a href="committee.html">Committees</a></li>
                            </ul>
                        </div>
                        <div class="footer-links">
                            <ul>
                                <li style="color: white">Membership</li>
                                <li><a href="membership.html">Benefits</a></li>
                                <li><a href="#">Courses</a></li>
                            </ul>
                        </div>
                        <div class="footer-links">
                            <ul>
                                <li style="color: white">Blog</li>
                                <li><a href="news.html">Latest News</a></li>
                                <li><a href="events.html">Events</a></li>
                            </ul>
                        </div>
                        <div class="footer-links">
                            <ul>
                                <li style="color: white">Our Team</li>
                                <li><a href="board.html">Board</a></li>
                                <li><a href="volunteers.html">Volunteers</a></li>
                            </ul>
                        </div>
                        <div class="footer-links">
                            <ul class="social">
                                <li class="facebook">
                                    <a href="https://www.facebook.com/IEEEPUA" target="_blank">
											 <i class="fa fa-facebook" aria-hidden="true"></i>
										    </a>
                                </li>
                                <li class="insta">
                                    <a href="https://www.instagram.com/ieeepuasb/" target="_blank">
											<i class="fa fa-instagram" aria-hidden="true"></i>
										</a>
                                </li>
                                <li class="youtube">
                                    <a href="https://www.youtube.com/channel/UCYQM_YQPQWen7LocvZ0XN2w" target="_blank">
											<i class="fa fa-play" aria-hidden="true"></i>
										</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <p>Copyrights &copy; 2017 | ALL RIGHTS RESERVED TO IEEE PUA SB</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery-3.2.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/featherlight.min.js"></script>
    <script src="js/bootstrap.offcanvas.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>
