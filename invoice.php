<?php
/**
 * Created by PhpStorm.
 * User: howatt
 * Date: 3/6/2014
 * Time: 6:12 PM
 * a page to display invoices.
 */
include('functions/header.php');
include('functions/footer.php');
include('functions/navbar.php');
include('functions/userProfile.php');
include('functions/database.php');
include('functions/codeTables.php');


displayHeader('TutleZone - Invoices');
displayUserArea();
displayNavigation();

$errorsFound = array();
$reportReady = false;
$tutor = "";
$student = "";
$transactions;

if (isset($_POST['submit']) && isset($_SESSION['USERID'])) {

    //  basic validation, make sure fields aren't empty.
    if (empty($_POST['match'])) {
        $errorsFound[] = "You must select a match.";
    }

    if (empty($_POST['startDate'])) {
        $errorsFound[] = "You must enter a start date..";
    }

    if (empty($_POST['endDate'])) {
        $errorsFound[] = "You must enter an end date..";
    }

    // if no errors found, continue
    if (count($errorsFound) == 0 && loadMatches()) {
        $thisUser = $_SESSION['USERID'];
        $otherUserID = "";

        // loop through the loaded matches to find the other userid
        foreach($_SESSION['matches'] as $thisMatch) {
            if ($thisMatch['match_id'] == $_POST['match']) {
                    $otherUserID = $thisMatch['match_userid'];
                }
        }

        if ($otherUserID == "") {
            $errorsFound[] = "Match not found.. Try again later.";
        }

        // Any errors found yet? If not, continue.
        if (count($errorsFound) == 0){
            $tutor = "";
            $student = "";

            // connect to DB to get all details for both parties..
            $db = connectToDB();
            if ($db)
            {
                try{
                    // if i'm a student, they are a tutor
                    if ($_SESSION['TYPECODE_ID'] == 1){

                        // first, we'll get their details, as the tutor.
                        $sql = "SELECT * FROM tutor WHERE credentials_userid = :userID";
                        $query = $db->prepare($sql);
                        $query->bindValue(':userID', $otherUserID);
                        if ($query->execute() && $query->rowCount() == 1){
                            $row = $query->fetch(PDO::FETCH_ASSOC);
                            $tutor = array('id' => $row['credentials_userid'],
                                           'name' => $row['tutor_fname'] . " " . $row['tutor_lname'],
                                           'address' => $row['tutor_address'] . ", " . $row['tutor_city'] . ", " . $row['tutor_postal'],
                                           'email' => $row['tutor_email'],
                                           'company' => $row['tutor_company'],
                                           'website' => $row['tutor_website']);
                        }

                        // now get our details, as the student.
                        $sql = "SELECT * FROM student WHERE credentials_userid = :userID";
                        $query = $db->prepare($sql);
                        $query->bindValue(':userID', $thisUser);
                        if ($query->execute() && $query->rowCount() == 1){
                            $row = $query->fetch(PDO::FETCH_ASSOC);
                            $student = array('id' => $row['credentials_userid'],
                                'name' => $row['student_fname'] . " " . $row['student_lname'],
                                'address' => $row['student_address'] . ", " . $row['student_city'] . ", " . $row['student_postal'],
                                'email' => $row['student_email'],
                                'about' => $row['student_about']);
                        }

                    } else {
                        // otherwise, I am the tutor, they are the student.
                        $sql = "SELECT * FROM tutor WHERE credentials_userid = :userID";
                        $query = $db->prepare($sql);
                        $query->bindValue(':userID', $thisUser);
                        if ($query->execute() && $query->rowCount() == 1){
                            $row = $query->fetch(PDO::FETCH_ASSOC);
                            $tutor = array('id' => $row['credentials_userid'],
                                'name' => $row['tutor_fname'] . " " . $row['tutor_lname'],
                                'address' => $row['tutor_address'] . ", " . $row['tutor_city'] . ", " . $row['tutor_postal'],
                                'email' => $row['tutor_email'],
                                'company' => $row['tutor_company'],
                                'website' => $row['tutor_website']);
                        }

                        // now get there details, as the student.
                        $sql = "SELECT * FROM student WHERE credentials_userid = :userID";
                        $query = $db->prepare($sql);
                        $query->bindValue(':userID', $otherUserID);
                        if ($query->execute() && $query->rowCount() == 1){
                            $row = $query->fetch(PDO::FETCH_ASSOC);
                            $student = array('id' => $row['credentials_userid'],
                                'name' => $row['student_fname'] . " " . $row['student_lname'],
                                'address' => $row['student_address'] . ", " . $row['student_city'] . ", " . $row['student_postal'],
                                'email' => $row['student_email'],
                                'about' => $row['student_about']);
                        }

                    }

                    // if either details are empty, something went wrong, set an error.
                    if ($tutor == "" || $student == "") {
                        $errorsFound[] = "Couldn't find one of the user accounts, try again later";
                    }

                    // if still no errors, we'll move on to getting the transaction data.
                    if (count($errorsFound) == 0) {
                        $sql = "SELECT transactions.transaction_id, transaction_amount, transaction_date, COALESCE(transaction_notes, '--') as 'transaction_notes', method.method_abbr
                                FROM transactions
                                JOIN method on transactions.method_id = method.method_id
                                WHERE transactions.match_id = :matchID AND (transaction_date BETWEEN :startDate AND :endDate)
                                ORDER BY transaction_date ASC";


                        // bind parameters
                        $query = $db->prepare($sql);
                        $query->bindValue(':matchID', $_POST['match']);
                        $query->bindValue(':startDate', $_POST['startDate']);
                        $query->bindValue(':endDate', $_POST['endDate']);

                        // execute query and fill array of transaction data.
                        if ($query->execute()){
                            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                $transactions[] = array('id'=>$row['transaction_id'],
                                                        'amount'=>$row['transaction_amount'],
                                                        'date'=>$row['transaction_date'],
                                                        'notes'=>$row['transaction_notes'],
                                                        'method'=>$row['method_abbr']);
                            }

                            $reportReady = true;
                        }
                        else {
                            $errorsFound[] = "Could not fetch your transaction data.";
                        }

                    }
                }
                catch(Exception $e){
                    $errorsFound[] = "An issue occured on the server.";
                }
            }


        }
    }
}
?>

<!-- Content starts -->

<div class="content">
   <div class="container">
      <div class="row">
         <div class="col-md-12">

            <!-- Service starts -->
            
            <div class="invoice">
               <div class="row">
                  <div class="col-md-12">

                     <div class="hero">
                        <h3><span>Invoices</span></h3>
                        <!-- para -->
                        <p>Select a match & insert a date range using the form below to generate an invoice. All fields are required.</p>
                         <?php
                         // if any errors were found (ie the form was submitted and processed, display the errors.
                         if (count($errorsFound) > 0) {
                             echo "<h5 style='color:red'> Errors Found! </h5>";
                             echo "<ol>";
                             foreach($errorsFound as $error){
                                 echo "<li>" . $error . "</li>";
                             }
                             echo "</ol>";
                         }
                         ?>
                         <form id="invoiceForm" class="form-horizontal" method="POST" action="invoice.php">

                             <div class="row">

                                     <div class="form-group col-md-4">
                                         <label class="control-label col-md-3" for="Match">Match</label>
                                         <div class="col-md-9">
                                             <select name="match" class="form-control" id="match">
                                                 <?php
                                                 if (loadMatches()){
                                                     foreach($_SESSION['matches'] as $thisMatch){
                                                         echo "<option value='" . $thisMatch['match_id'] . "'>" . $thisMatch['fname'] . " " . $thisMatch['lname'] . "</option>";
                                                     }
                                                 }
                                                 ?>
                                             </select>
                                         </div>
                                     </div>
                                     <!-- start date -->
                                     <div class="form-group col-md-4">
                                         <label class="control-label col-md-5" for="startDate">Start Date</label>
                                         <div class="col-md-7">
                                             <input type="text" class="form-control" id="startDate" name="startDate">
                                         </div>
                                     </div>

                                     <!-- start date -->
                                     <div class="form-group col-md-4">
                                         <label class="control-label col-md-5" for="endDate">End Date</label>
                                         <div class="col-md-7">
                                             <input type="text" class="form-control" id="endDate" name="endDate">
                                         </div>
                                     </div>

                                 </div>

                             <div class="row">
                                 <!-- submit -->
                                 <div class="form-group col-md-4 pull-right">
                                     <div class="col-md-12">
                                         <input type="submit" class="form-control" id="submit" name="submit" value="Submit">
                                     </div>
                                 </div>
                             </div>




                         </form>
                     </div>

                      <?php
                        // only display the below HTML if the report has been generated successfully.
                        if ($reportReady) {
                      ?>

                      <!-- start of report -->
                     <div class="row">
                        <div class="col-md-6">
                           <div class="">
                              <div class="serv">
                                 <div class="simg">
                                    <i class="icon-user"></i>
                                 </div>
                                 <h4>Tutor Details</h4>
                                  <ol>
                                      <?php
                                      echo "<li> Name: " . $tutor['name'] . "</li>";
                                      echo "<li> Address: " . $tutor['address'] . "</li>";
                                      echo "<li> Company: " . $tutor['company'] . "</li>";
                                      echo "<li> Website: " . $tutor['website'] . "</li>";
                                      echo "<li> Email: " . $tutor['email'] . "</li>";
                                      ?>
                                  </ol>
                              </div>
                           </div>

                        </div>                        
                        <div class="col-md-6">
                           <div>
                              <div class="serv">
                                 <div class="simg">
                                    <i class="icon-user"></i>
                                 </div>
                                 <h4>User Details</h4>
                                  <ol>
                                      <?php
                                      echo "<li> Name: " . $student['name'] . "</li>";
                                      echo "<li> Address: " . $student['address'] . "</li>";
                                      echo "<li> Email: " . $student['email'] . "</li>";
                                      ?>
                                  </ol>
                              </div>
                           </div>
                        </div>
                     </div>

                     <hr />
                     
                     <div class="testimonial">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="testi">
                                 <div class="tquote">

                                     <?php
                                     if (count($transactions) > 0) {
                                         $paymentTotal = 0.0;
                                         $chargeTotal = 0.0;
                                         $balance = 0.0;
                                         echo "<table style='width:100%;border:1px solid black; border-collapse:collapse;'>";
                                         echo "<tr> <td> ID </td> <td> Amount</td> <td> Date </td> <td> Method </td> <td> Notes:</td></tr>";
                                         foreach($transactions as $aTransaction) {
                                             if ($aTransaction['method'] == "Charge"){
                                                 $chargeTotal += $aTransaction['amount'];
                                             } else {
                                                 $paymentTotal += $aTransaction['amount'];
                                             }
                                             echo "<tr>";
                                             echo "<td> " . $aTransaction['id'] . " </td><td> " . $aTransaction['amount'] . " </td><td> " . $aTransaction['date'] . " </td><td> " . $aTransaction['method'] . " </td><td> " . $aTransaction['notes'] . " </td> ";
                                             echo "</tr>";
                                         }
                                         echo "</table>";
                                         echo "<h5 style='text-align:right'> Total Charges: $" . $chargeTotal . "</h5><br/>";
                                         echo "<h5 style='text-align:right'> Total Payments: $" . $paymentTotal . "</h5><br/>";
                                         echo "<h5 style='text-align:right'> Balance: $" . ($chargeTotal - $paymentTotal) . "</h5>";
                                     } else {
                                         echo "<h5> No transaction data for the selected match and/or range </h5>";
                                     }
                                     ?>

                                 </div>
                              </div>
                              
                           </div>

                        </div>
                     </div>

                   <?php
                        }
                      ?>
                      <!-- end of report -->
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>
</div>   

<!-- Content ends -->
<?php
displayFooter();
?>