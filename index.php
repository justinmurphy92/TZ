<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/6/2014
 * Time: 6:12 PM
 */
include('functions/footer.php');
include('functions/header.php');
include('functions/navbar.php');
include('functions/userProfile.php');
include('functions/database.php');


displayHeader('TutleZone - Home');
displayUserArea(0);
displayNavigation(0);

?>
<!-- Content strats -->

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- Slider (Parallax Slider) -->

                <div id="da-slider" class="da-slider">
                    <div class="da-slide">
                        <h2>Learning: Made Easy</h2>
                        <p>Learning shouldn't be dreaded, neither should setting up lessons! Whether you are a student or a tutor, <span class="color">TutleZone</span> will make your life easier.</p>
                        <a href="#" class="da-link">Read more</a>
                        <div class="da-img"><img src="img/parallax/success.png" alt="Success Meme with TutleZone Logo" /></div>
                    </div>
                    <div class="da-slide">
                        <h2>Stay Focused!</h2>
                        <p> It can be hard enough to learn.  Let TutleZone help you worry about the learning, while we worry about the scheduling & tracking</p>
                        <a href="#" class="da-link">Read more</a>
                        <div class="da-img"><img src="img/parallax/learn.png" alt="Brain Mapping" /></div>
                    </div>
                    <div class="da-slide">
                        <h2>Open Your Mind</h2>
                        <p> With TutleZone, you can connect with professionals in all sorts of fields.  Why not dive in & brush up on your artistic talents?</p>
                        <a href="#" class="da-link">Read more</a>
                        <div class="da-img"><img src="img/parallax/artistic.png" alt="Why not Arts?" /></div>
                    </div>
                    <div class="da-slide">
                        <h2>Open Beta</h2>
                        <p> TutleZone is free for a limited time, as we work on polishing the software.  There's no better time than now to sign up!</p>
                        <a href="#" class="da-link">Read more</a>
                        <div class="da-img"><img src="img/parallax/beta.png" alt="Limited Open Beta" /></div>
                    </div>
                    <nav class="da-arrows">
                        <span class="da-arrows-prev"></span>
                        <span class="da-arrows-next"></span>
                    </nav>
                </div>

                <!-- Slider ends -->

                <div class="bor"></div>

                <div class="main-content">
                    <div class="row">
                        <div class="col-md-7">
                            <h2>TutleZone</h2>
                            <p class="main-meta"> Because tutoring is hard </p>
                            <p> Tutoring ain't easy, and neither is learning! As guitar teachers ourselves, we know how difficult it can be to keep track of lessons, assignments, payments, rescheduling, etc. and unfortunately
                                it just comes along with the business. To be completely honest, we designed TutleZone for ourselves, so we could stay focused on helping others learn, rather than master our excel abilities. We hope you can benefit from TutleZone the same way we have.
                                We hope you consider signing up for TutleZone, and hopefully you remain forgiving while we're within the growing stages. We're open to feedback, let us know what's broken or what you want and we'll do what we can
                                to make your experience better. </p>
                        </div>
                        <div class="col-md-5">
                            <div class="main-box">
                                <h4>Feature Highlight - Scheduling! </h4>
                                <p>Let's look at one of the features of TutleZone: </p>
                                <ul>
                                    <li>feature #1</li>
                                    <li>feature #2</li>
                                    <li>feature #3</li>
                                </ul>
                                <div class="button">
                                    <a href="#"><i class="icon-shopping-cart"></i> Buy Now</a> <a href="#"><i class="icon-magic"></i> Try Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA starts -->

                <div class="cta">
                    <div class="row">
                        <div class="col-md-9">
                            <!-- First line -->
                            <p class="cbig">It's Free! </p>
                            <!-- Second line -->
                            <p class="csmall">TutleZone is free while we're ironing out the kinks.  Give TutleZone a shot today, it only takes minutes. What do you have to lose?</p>
                        </div>
                        <div class="col-md-2">
                            <!-- Button -->
                            <br/>
                            <div class="button"><a href="#">Register Now!</a></div>
                        </div>
                    </div>
                </div>

                <!-- CTA Ends -->

                <!-- Features list. Note down the class name before editing. -->
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="afeature">
                            <div class="afmatter">
                                <i class="icon-calendar"></i>
                                <h4>Scheduling</h4>
                                <p>Never forget a lesson again.  The TutleZone calendar consolidates all your lessons in one place. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="afeature">
                            <div class="afmatter">
                                <i class="icon-envelope-alt"></i>
                                <h4>Notifications</h4>
                                <p> Our real-time notification system alerts you of any rescheduled lessons, overdue payments, etc.  </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="afeature">
                            <div class="afmatter">
                                <i class="icon-bar-chart"></i>
                                <h4>Reporting</h4>
                                <p> On-demand and automated reporting for things that matter. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="afeature">
                            <div class="afmatter">
                                <i class="icon-archive"></i>
                                <h4>Tracking</h4>
                                <p>Track your old and upcoming lessons, never go to your next session unprepared! </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features ends -->

                <div class="bor"></div>

                <!-- Testimonials -->

                <div class="testimonial">
                    <div class="container">
                        <div class="row">
                            <?php
                            $db = connectToDB();
                            if (!$db)
                            {
                              try{
                                  $sql = "SELECT * FROM TESTIMONIALS ORDER BY RAND() LIMIT 3";
                                  foreach ($db->query($sql) as $row)
                                  {
                                      echo "<div class='col-md-4 col-sm-4'>";
                                      echo "<div class='test'>";
                                      echo $row['content'];
                                      echo "</div>";
                                      echo "<div class='test-arrow'></div>";
                                      echo "<div class='tauth'><i class='icon-user'></i>";
                                      echo $row['name'];
                                      echo "<span class='color'>";
                                      echo $row['vistor_type'];
                                      echo "</span></div></div>";
                                  }

                              }catch(PDOException $e){
                                echo $e->getMessage();
                              }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="bor"></div>
            </div>
        </div>
    </div>
</div>
<!-- Content ends -->

<?php
displayFooter(0);
?>