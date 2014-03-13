<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/6/2014
 * Time: 6:12 PM
 */
include('functions/header.php');
include('functions/footer.php');
include('functions/navbar.php');
include('functions/userProfile.php');
include('functions/database.php');


displayHeader('TutleZone - Notifications');
displayUserArea();
displayNavigation();

?>

<!-- Content strats -->

<div class="content">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            
            <!-- Portfolio starts -->
            
            <div class="portfolio">
               <div class="row">
                  <div class="col-md-12">
                  
                     <!-- Notifications hero -->
                     <div class="hero">
                        <h3><span>Notifications</span></h3>
                        <!-- para -->
                        <p>This page represents any notifications you've received over the past year.  The green check mark indicates you've read the message before. Click on any message to mark it as read, or use the buttons along the top to filter.  </p>
                        <p><strong> Notifications are not kept long-term, should there be anything you need to keep, we recommend you make a local copy, outside of TutleZone. </strong></p>
                     </div>
                     <!-- End Notifications hero -->
                     
                     <p>
                        <div class="button">
                           <ul id="filters">
                             <li><a href="#" data-filter="*" > All </a></li>
                             <li><a href="#" data-filter=".read"> Read </a></li>
                             <li><a href="#" data-filter=".unread"> Unread </a></li>
                           </ul>
                        </div>
                    </p>
                        
                        
                    <div id="portfolio">
                        <?php
                        if (isset($_SESSION['USERID'])){
                            $db = connectToDB();
                            if ($db)
                            {
                                try{
                                    $sql = "SELECT * FROM notification WHERE credentials_userid = :userID AND notification_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR) ORDER BY notification_date DESC";
                                    $query = $db->prepare($sql);
                                    $query->bindValue(':userID', $_SESSION['USERID']);
                                    $query->execute();
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC))
                                    {
                                        $date = date_create($row['notification_date']);
                                        $date = date_format($date, 'F jS g:ha');

                                        if ($row['notification_read'] == true){
                                            echo "<div class='element read' style='width:173px'>";
                                            echo "<div class='pcap' onclick='doIt(this)' id='" . $row['notification_id'] . "'>";
                                            echo "<i class='icon-2x icon-check notifRead'></i>";
                                            echo "<h5>" . $date . "</h5>";
                                            echo "<p>" . $row['notification_content'] . "</p>";
                                            echo "</div></div>\n";
                                        }
                                        else {
                                            echo "<div class='element unread' style='width:173px'>";
                                            echo "<div class='pcap' onclick='doIt(this)' id='" . $row['notification_id'] . "'>";
                                            echo "<i class='icon-2x icon-check-empty notifUnread'></i>";
                                            echo "<h5>" . $date . "</h5>";
                                            echo "<p>" . $row['notification_content'] . "</p>";
                                            echo "</div></div>\n";
                                        }
                                    }

                                }catch(PDOException $e){
                                    writeLog('DB', $e);
                                }
                            }
                        }
                        ?>

                    </div>
                     
                  </div>
               </div>
            </div>
            
            
            <!-- Service ends -->

            
         </div>
      </div>
   </div>
</div>   

<!-- Content ends -->

<?php
displayFooter();
?>