<?php
/**
 * Created by PhpStorm.
 * User: Howatt
 * Date: 06/03/14
 * Time: 6:07 PM
 * Purpose:
 * Prints out the footer of the page, ensuring consistency throughout the site.
 */

function displayFooter() {
?>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- Widget 1 -->
                    <div class="widget">
                        <h4>About Us</h4>
                        <p> Tutoring is not the easiest job in the world, we're hoping we can make it a bit more pleasant for you, whether you are the student
                            or the tutor.  Sign up now during our open-beta period and let us know what you think. Welcome to TutleZone  </p>
                        <ul>
                            <li><a href="#">About TutleZone</a></li>
                            <li><a href="#">Frequently Asked Questions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- widget 2 -->
                    <div class="widget">
                        <h4>Our Newest Members!</h4>
                        <ul>
                            <li><a href="#">New Member # 1</a></li>
                            <li><a href="#">New Member # 2</a></li>
                            <li><a href="#">New Member # 3</a></li>
                            <li><a href="#">New Member # 4</a></li>
                            <li><a href="#">New Member # 5</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Widget 3 -->
                    <div class="widget">
                        <h4>The Team</h4>
                        <ul>
                            <li>Justin Murphy</li>
                            <li>justin@tutlezone.ca</li>
                        </ul>
                        <div class="bor" style="opacity:0.6"></div>
                        <ul>
                            <li>Adam Howatt</li>
                            <li>adam@tutlezone.ca</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr />
                <div class="col-md-12"><p class="copy pull-left">
                        <!-- Copyright information. You can remove my site link. -->
                        Copyright &copy; <a href="#">Your Site</a> | Designed by <a href="http://responsivewebinc.com">Responsive Web Design</a></p></div>
            </div>
        </div>
    </footer>

    <!-- JS -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.isotope.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/filter.js"></script>

    <script src="js/jquery.cslider.js"></script>
    <script src="js/modernizr.custom.28468.js"></script>
    <script src="js/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="js/fullcalendar.min.js"></script>
    <script src="js/custom.js"></script>
    <script type="text/javascript">
        $(function() {

            $('#da-slider').cslider({
                autoplay	: true,
                interval : 6000
            });

        });

        $(".user").mouseover(function() {

            $(".user-box").show();

        }).mouseout(function() {

            $(".user-box").hide();
        });

        $(".schedule").mouseover(function() {

            $(".schedule-box").show();

        }).mouseout(function() {

            $(".schedule-box").hide();
        });

        $(".notification").mouseover(function() {

            $(".notification-box").show();

        }).mouseout(function() {

            $(".notification-box").hide();
        });

        $(function() {
            var availableTags = [
                "ActionScript",
                "AppleScript",
                "Asp",
                "BASIC",
                "C",
                "C++",
                "Clojure",
                "COBOL",
                "ColdFusion",
                "Erlang",
                "Fortran",
                "Groovy",
                "Haskell",
                "Java",
                "JavaScript",
                "Lisp",
                "Perl",
                "PHP",
                "Python",
                "Ruby",
                "Scala",
                "Scheme"
            ];
            $("#search").autocomplete({
                source: availableTags
            });
        });

        $(document).ready(function() {

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                theme: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable:false,
                events: [
                    {

                        title: 'All Day Event',
                        start: new Date(y, m, 1)
                    },
                    {
                        title: 'Long Event',
                        start: new Date(y, m, d-5),
                        end: new Date(y, m, d-2)
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d-3, 16, 0),
                        allDay: false
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d+4, 16, 0),
                        allDay: false
                    },
                    {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false
                    },
                    {
                        draggable: false,
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false,
                        color: 'yellow'
                    },
                    {
                        title: 'Birthday Party',
                        start: new Date(y, m, d+1, 19, 0),
                        end: new Date(y, m, d+1, 22, 30),
                        allDay: false,
                        color: 'blue'
                    },
                    {
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        url: 'http://google.com/'
                    }
                ]
            });

        });
    </script>
    </body>
    </html>

<?php
} // end footer
?>