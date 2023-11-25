<?php
session_start();
if (!isset($_SESSION['managerId'])) {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Details</title>
    <?php require 'assets/autoloader.php'; ?>
    <?php require 'assets/db.php'; ?>
    <?php require 'assets/function.php'; ?>
</head>
<body style="background-size: 100%" class="bg-gradient-seconday">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" style="object-fit:cover;object-position:center center" width="30" height="30" class="d-inline-block align-top" alt="">
            <?php echo bankname; ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="mindex.php">Back to Accounts</a>
                </li>
            </ul>
            <?php include 'msideButton.php'; ?>
        </div>
    </nav><br><br><br>

    <div class="container">
        <div class="card w-75 mx-auto">
            <div class="card-header text-center">
                Transaction Details for <?php echo "$_GET[accountNo]"?>
            </div>
            
            <div class="card-body">
                <?php
                if (isset($_GET['accountNo'])) {
                    $accountNo = $_GET['accountNo'];

                    // Retrieve transactions for the specified account
                    $result = $con->query("SELECT  * FROM `transaction` WHERE (`senderAccountNo` = '$accountNo' and `Action`='transfer') or (`receiverAccountNo`='$accountNo' and `Action`='transfer1')  ORDER BY `date` DESC");

                    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Display transaction details
          
                echo "<div class='alert alert-info'>Transaction ID: {$row['transactionId']}<br>";
                echo "Action: {$row['action']}<br>";

        
            
            // Display credit if the account is the receiver
            if ($row['receiverAccountNo'] == $accountNo  && $row['credit'] != 0) {
                echo "Credit: Rs.{$row['credit']}<br>";
            }

            // Display debit if the account is the sender
            if ($row['senderAccountNo'] == $accountNo && $row['debit'] != 0) {
                echo "Debit: Rs.{$row['debit']}<br>";
            }
                        echo "Receiver Account No: {$row['receiverAccountNo']}<br>";
                        echo "Sender Account No: {$row['senderAccountNo']}<br>";
                        echo "Date: {$row['date']}</div>";
                        }
                    } else {
                        echo "<div class='text-center'><small class='text-muted'><i>No transactions found for this account.</i></small></div>";
                    }
                } else {
                    echo "<div class='text-center'><small class='text-muted'><i>Invalid account ID.</i></small></div>";
                }
                ?>
            </div>
            
            <div class="card-footer text-muted">
                <?php echo bankname; ?>
            </div>
        </div>
    </div>
</body>
</html>
