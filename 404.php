<?php
/**
 * Programmer:  Adam Howatt
 * Analyst:     Justin Murphy
 *      DATE        INITIALS        CHANGES
 *      03/06/2014  AH              INITIAL CREATION
 *
 * DESCRIPTION:
 * A SIMPLE 404 PAGE TO BE DISPLAYED WHEN THE USER TRIES TO NAVIGATE TO A PAGE THAT DOES NOT EXIST
 *
 */
include('functions/footer.php');
include('functions/header.php');
include('functions/database.php');
include('functions/navbar.php');
include('functions/userProfile.php');
include('functions/database.php');

displayHeader('TutleZone - 404!');
displayUserArea(0);
displayNavigation(0);

?>

<!-- Content strats -->

<div class="content">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            
            <!-- 404 starts -->
            
            <div class="error">
               <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                     <div class="error-page">

                        <p class="error-med">Oops! Something broke.</p>
                        <p class="error-big"><i class="color icon-frown"></i> Error 404</p>
                        <p class="error-small">This means the page wasn't found.  We've logged the error. Don't hesitate to get in touch if you're not sure why this appeared!</p>
                     </div>
                  </div>
               </div>
            </div>
            
            <!-- 404 ends -->

            
         </div>
      </div>
   </div>
</div>   

<!-- Content ends -->

<?php
displayFooter(0);
?>