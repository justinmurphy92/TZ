<?php
/**
 * Programmer:  Adam Howatt
 * Analyst:     Justin Murphy
 *      DATE        INITIALS        CHANGES
 *      03/06/2014  AH              INITIAL CREATION
 *
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
                            <?php
                            newestMembers();
                            ?>
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
                        Copyright &copy; <a href="http://www.redvoid.ca">redVoid Development</a> | In Partnership with C.A.I.S.S.Y</a></p></div>
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
    <script src="js/timepicker.js"></script>
    <script src="js/fullcalendar.min.js"></script>
    <script src="js/custom.js"></script>
    <script type="text/javascript">
        $(function() {

            $('#da-slider').cslider({
                autoplay	: true,
                interval : 6000
            });

        });

        function doIt(element){
            var elementI = element.children[0];

            if (elementI.classList.contains('notifUnread')) {
                $.post("ajax/markNotificationRead.php",{notifID:element.id},
                    function(data) {
                        if (data == 'worked') {
                            elementI.className = 'icon-2x icon-check notifRead';
                            $(element.parentNode).removeClass("unread");
                            $(element.parentNode).addClass("read");
                        }

                    }
                )

            }
        }

        /* Isotope */
        var $container = $('#portfolio');
        // initialize isotope
        $container.isotope({

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

        $(function(){
            $("#search").autocomplete({
                source: "ajax/autocomplete.php"
                })
            });




        $(document).ready(function() {

            $(function() {
                $('#date').datetimepicker({
                    stepMinute: 15,
                    dateFormat: 'yy-mm-dd'

                });
            });

            $(function() {
                $('#startDate').datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            });

            $(function() {
                $('#endDate').datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            });

            $(function() {
                $('#lessonDate').datetimepicker({
                    stepMinute: 15,
                    dateFormat: 'yy-mm-dd'

                });
            });

            $('#calendar').fullCalendar({
                theme: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable:false,
                events: 'ajax/scheduleCalendar.php',
                eventClick: function(calEvent, jsEvent, view) {
                    $( "#updateForm").trigger("reset");
                    $( "#lessonID").val(calEvent.id);
                    $( "#matchID").val(calEvent.matchID);
                    $( "#title").val(calEvent.title);
                    $( "#date").val(calEvent.start);
                    $('[name=subjectID]').val(calEvent.subject);
                    $('[name=status]').val(calEvent.lessonStatus);
                    $('#date').datetimepicker('setDate', calEvent.start);
                    $( "#length").val(calEvent.lessonLength);
                    $( "#location").val(calEvent.lessonLocation);
                    $( "#comments").val(calEvent.lessonComments);
                    $( "#desc").val(calEvent.lessonDesc);
                    $( "#dialog-form" ).dialog( "open" );
                }
            });



            // Dialogue box for updating a lesson.
            $( "#dialog-form" ).dialog({
                autoOpen: false,
                height:600,
                width: 450,
                modal: true,
                buttons: {
                    <?php
                    // only tutors should have an update lesson button.
                    if (isset($_SESSION['TYPECODE_ID']) && $_SESSION['TYPECODE_ID'] == 2) {
                    ?>

                    "Update Lesson": function() {
                        //alert($( "#updateForm" ).serialize());
                        $.post("ajax/updateLesson.php",$( "#updateForm" ).serialize(),
                            function(data) {
                                if (data == 'success') {
                                    $('.ui-dialog-content').dialog('close');
                                    alert("Successfully Updated!");
                                    $('#calendar').fullCalendar('refetchEvents');
                                }
                                else if(data == 'unauthorized') {
                                    $('.ui-dialog-content').dialog('close');
                                    alert("Unauthorized Access Detected.. tisk tisk..");
                                }
                                else if(data == 'missing') {
                                    $('.ui-dialog-content').dialog('close');
                                    alert("Not all required data was entered.. Try again.");
                                }
                                else{
                                    $('.ui-dialog-content').dialog('close');
                                    alert("An Unknown Error Occured!");
                                }
                            }
                        )
                            .fail( function(xhr, textStatus, errorThrown) {
                                alert("An Unknown Error Occured!");
                            })
                    },<?php } // CLOSE TUTOR SELECT ?>
                    Cancel: function() {
                        $( this ).dialog( "close" );
                    }
                },
                close: function() {

                }
            });

            <?php
            // only tutors can add new lessons.
            if (isset($_SESSION['TYPECODE_ID']) && $_SESSION['TYPECODE_ID'] == 2) {
                ?>

            // dialogue form for creating new lessons
            $( "#dialog-form2" ).dialog({
                autoOpen: false,
                height:700,
                width: 500,
                modal: true,
                buttons: {
                    "Create Lesson": function() {
                        //alert($( "#createForm" ).serialize());
                       $.post("ajax/createLesson.php",$( "#createForm" ).serialize(),
                            function(data) {
                                if (data == 'success') {
                                    $('.ui-dialog-content').dialog('close');
                                    alert("Successfully Created!");
                                    $('#calendar').fullCalendar('refetchEvents');
                                }
                                else if(data == 'unauthorized') {
                                    $('.ui-dialog-content').dialog('close');
                                    alert("Unauthorized Access Detected.. tisk tisk..");
                                }
                                else if(data == 'missing') {
                                    $('.ui-dialog-content').dialog('close');
                                    alert("Not all required data was entered.. Try again.");
                                }
                                else{
                                    $('.ui-dialog-content').dialog('close');
                                    alert("An Unknown Error Occured!");
                                }
                            }
                        )
                            .fail( function(xhr, textStatus, errorThrown) {
                               // this is a failsafe for any network issues as the above will not capture it.
                                alert("An Unknown Error Occured!");
                            })
                    },
                    Cancel: function() {
                        $( this ).dialog( "close" );
                    }
                },
                close: function() {

                }
            });

            $("#newLessonLink").click(function(){
                $("#createForm").trigger("reset");
                $('[name=lessonStatus]').val(1); // default to "pending"
                $( "#dialog-form2" ).dialog( "open" );
            });
                <?php
                    } // end create lesson form
                ?>

            <?php
            // only those logged in can take sick days.
            if (isset($_SESSION['USERID'])) {
                ?>
            // dialogue form for taking a sick day
            $( "#sickday" ).dialog({
                autoOpen: false,
                height: 'auto',
                width: 500,
                modal: true,
                buttons: {
                    "Take Sick Day": function() {
                        //alert($( "#sickForm" ).serialize());
                        $.post("ajax/sickDay.php",$( "#sickForm" ).serialize(),
                            function(data) {
                                if (data == 'error' || data == 'failure') {
                                    $('.ui-dialog-content').dialog('close');
                                    alert("Could not process your request.");
                                }
                                else if (data == 'missing') {
                                    $('.ui-dialog-content').dialog('close');
                                    alert("Not all required fields were filled in.");
                                }
                                else{
                                    $('#calendar').fullCalendar('refetchEvents');
                                    $('.ui-dialog-content').dialog('close');
                                    alert("Sick Day Request Successful. " + data + " Lessons Cancelled.");
                                }
                            }
                        )
                            .fail( function(xhr, textStatus, errorThrown) {
                                // this is a failsafe for any network issues as the above will not capture it.
                                alert("An Unknown Error Occured!");
                            })
                    },
                    Cancel: function() {
                        $( this ).dialog( "close" );
                    }
                },
                close: function() {

                }
            });

            $("#sickDayLink").click(function(){
                $("#sickForm").trigger("reset");
                $( "#sickday" ).dialog( "open" );
            });
            <?php
                } // end sick day
            ?>

            $( "#dialog-form3" ).dialog({
                autoOpen: false,
                height: 'auto',
                width: 500,
                modal: true,
                buttons: {
                    "Submit Payment": function() {
                        //alert($( "#paymentForm" ).serialize());
                        $.post("ajax/createPayment.php",$( "#paymentForm" ).serialize(),
                            function(data) {
                                if (data == 'success') {
                                    $('.ui-dialog-content').dialog('close');
                                    alert("Payment Added Successfully.");
                                }
                                else{
                                    $('.ui-dialog-content').dialog('close');
                                    alert("Failure");
                                }
                            }
                        )
                            .fail( function(xhr, textStatus, errorThrown) {
                                // this is a failsafe for any network issues as the above will not capture it.
                                alert("An Unknown Error Occured!");
                            })
                    },
                    Cancel: function() {
                        $( this ).dialog( "close" );
                    }
                },
                close: function() {

                }
            });

            $("#newPayment").click(function(){
                $("#paymentForm").trigger("reset");
                $( "#dialog-form3" ).dialog( "open" );
            });

            // ajax call for notifications
            $.ajax({ // ajax call starts
                url: 'ajax/notificationQuickList.php',
                dataType: 'json',
                success: function(data) // Variable data contains the data we get from serverside
                {
                    $('#notificationList').html('');
                    $('#notificationList').append('<li><a href="notifications.php">GOTO: Notifications Page</a></li>');


                        $.each(data, function(index, element) {
                            if (index == 0)
                            {
                                $('#notificationCount').html('');
                                $('#notificationCount').append(element.notificationCount);
                            }

                            $('#notificationList').prepend('<li><a href="notifications.php?id=' + element.id + '"><strong style="font-size:70%;">' + element.date + '</strong> - ' + element.content + '</li>');
                        });

                    }

                });


            // ajax call for schedule events
            $.ajax({ // ajax call starts
                url: 'ajax/scheduleQuickList.php',
                dataType: 'json',
                success: function(data) // Variable data contains the data we get from serverside
                {
                    $('#scheduleList').html('');
                    $('#scheduleList').append('<li><a href="lessons.php">GOTO: Lessons Page</a></li>');


                    $.each(data, function(index, element) {
                        $('#scheduleCount').html('');
                        $('#scheduleCount').append(index + 1);
                        $('#scheduleList').prepend('<li><a href="lessons.php?id=' + element.id + '"><strong style="font-size:70%;">' + element.date + '</strong><br/>With: ' + element.party + '</li>');
                    });

                }

            });
            });

    </script>
    </body>
    </html>

<?php
} // end footer
?>