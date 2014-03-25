<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/22/2014  JM              INITIAL CREATION
 *      03/23/2014  JM              FIXED QUERIES
 *      03/24/2014  JM              ADDED JQUERY EVENTS
 *
 * DESCRIPTION:
 * THIS PAGE IS FOR TUTORS TO CREATE PAYMENTS AND VIEW PAST PAYMENTS
 */

// guests shouldn't be here.
if (!isset($_SESSION['USERID'])) {
    header("Location: index.php");
    exit;
}

// neither should students.
if (isset($_SESSION['TYPECODE_ID']) && $_SESSION['TYPECODE_ID'] == 1) {
    header("Location: index.php");
    exit;
}
//include needed classes
include('functions/footer.php');
include('functions/header.php');
include('functions/navbar.php');
include('functions/userProfile.php');
include('functions/database.php');
include('functions/codeTables.php');


displayHeader('TutleZone - Home');
displayUserArea(0);
displayNavigation(0);
?>
    <!--create payment form: this will only appear when a user clicks create payment -->
    <div id="dialog-form3" class="form" title="Create Payment">
        <p id="dialogPurpose"> Create A Payment! </p>

        <form id="paymentForm" class="form-horizontal" method="POST" action="#">

            <input type="hidden" name="methodID" id="methodID" value="1">

            <!-- student -->
            <div class="form-group">
                <label class="control-label col-md-3" for="student">Student</label>
                <div class="col-md-9">
                    <select name="matchID" class="form-control" id="matchID">
                        <?php
                        //populates the student dropdown by invoking the loadMatches function
                        if (loadMatches()){
                            foreach($_SESSION['matches'] as $thisMatch){
                                echo "<option value='" . $thisMatch['match_id'] . "'>" . $thisMatch['fname'] ." ".$thisMatch['lname']."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- amount -->
            <div class="form-group">
                <label class="control-label col-md-3" for="amount">Amount</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="amount" name="amount">
                </div>
            </div>

            <!-- date -->
            <div class="form-group">
                <label class="control-label col-md-3" for="date">Date</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="date" name="date">
                </div>
            </div>

            <!-- notes -->
            <div class="form-group">
                <label class="control-label col-md-3" for="notes">Notes</label>
                <div class="col-md-9">
                    <textarea class="form-control" name="notes" id="notes"></textarea>
                </div>
            </div>

        </form>
    </div>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- Features starts -->

                <div class="feature-alt">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Features list. Note down the class name before editing. -->
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <a id="newPayment">
                                    <div class="afeature">
                                        <div class="afmatter">
                                            <i class="icon-cloud"></i>
                                            <h4>Create New Payment</h4>
                                            <p> Create A Payment </p>
                                        </div>
                                    </div>
                                    </a>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <h4 style="padding-top:84px; padding-left:70px">Past Payments -------- ></h4>
                                </div>
                                <?php
                                //writes the past payments to the page
                                $resultArray;
                                $resultArray1;
                                    $db = connectToDB();
                                    if($db){
                                        $sql = "SELECT * FROM matches WHERE tutor_userid = :userid";
                                        $query = $db->prepare($sql);
                                        $query->bindValue(':userid', $_SESSION['USERID']);

                                        try{
                                            $query->execute();
                                            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                                                $resultArray[]= array('id'=> $row['match_id']);
                                            }
                                        }
                                        catch(PDOException $e){
                                            writeLog('DB', $e);
                                        }
                                        foreach($resultArray as $oneMatch){
                                            $sql = "SELECT * FROM transactions WHERE match_id = :thisMatchID AND method_id = 1 ORDER BY transaction_date DESC";
                                            $query = $db->prepare($sql);
                                            $query->bindValue(':thisMatchID', $oneMatch['id']);
                                            try{
                                                $query->execute();

                                                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                                                    $resultArray1[] = array('date'=>   $row['transaction_date'],
                                                                         'amount'=> $row['transaction_amount'],
                                                    );
                                                }
                                            }
                                            catch(PDOException $e){
                                                writeLog('DB', $e);
                                            }
                                        }
                                        foreach($resultArray1 as $payments){
                                            $dateSubStr = substr($payments['date'], 0, 10);
                                            $payAmount = number_format(floatval($payments['amount']),2,'.','');
                                            echo"
                                                <div class='col-md-3 col-sm-6 time' style='padding-top:65px'>
                                                    <div class='timatter'>
                                                        <h4>Date: ".$dateSubStr."</h4>
                                                        <p>Amount: $".$payAmount." </p>
                                                     </div>
                                                </div>";
                                        }
                                    }
                                    ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
displayFooter(0);
?>