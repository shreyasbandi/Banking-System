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
    <title>Banking</title>
    <?php require 'assets/autoloader.php'; ?>
    <?php require 'assets/db.php'; ?>
    <?php require 'assets/function.php'; ?>

    <?php
    $destinationPage = "mfirstPAge.php";
    ?>

</head>
<body style="background-size: 100%" class="bg-gradient-seconday">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">
        <img src="images/logo.png" style="object-fit:cover;object-position:center center" width="30" height="30"
             class="d-inline-block align-top" alt="">
        <?php echo bankname; ?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link active" href="mindex.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">  <a class="nav-link" href="maccounts.php">Staff Accounts</a></li>
            <li class="nav-item ">  <a class="nav-link" href="maddnew.php">Add New Account</a></li>
            <li class="nav-item ">  <a class="nav-link" href="mfeedback.php">Feedback</a></li>
            <li class="nav-item ">  <a class="nav-link" href="mloan_application.php">Loan Application</a></li>
            <li class="nav-item ">  <a class="nav-link" href="mstatements.php">Transaction Statements</a></li>


        </ul>
        <?php include 'msideButton.php'; ?>

    </div>
</nav><br><br><br>
<div class="container-fluid">
    <!-- Three cards above -->
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card shadowBlack ">
                <img class="card-img-top" src="images\information.webp" style="max-height: 155px;min-height: 155px;"
                     alt="Card image cap">
                <div class="card-body">
                    <a href="mindex.php" class="btn btn-outline-info shadow btn-block">All User Accounts</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadowBlack ">
                <img class="card-img-top" src="images\staff.webp" alt="Card image cap"
                     style="max-height: 155px;min-height: 155px">
                <div class="card-body">
                    <a href="maccounts.php" class="btn btn-outline-info shadow btn-block">staff Accounts</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadowBlack ">
                <img class="card-img-top" src="images/newu.gif" alt="Card image cap"
                     style="max-height: 155px;min-height: 155px">
                <div class="card-body">
                    <a href="maddnew.php" class="btn btn-outline-info shadow btn-block">new user Accounts</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Three cards below -->
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card shadowBlack ">
                <img class="card-img-top" src="images/tran.gif" style="max-height: 155px;min-height: 155px"
                     alt="Card image cap">
                <div class="card-body">
                    <a href="mstatements.php" class="btn btn-outline-primary btn-block">Transaction History</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadowBlack ">
                <img class="card-img-top" src="images/feed.gif" alt="Card image cap"
                     style="max-height: 155px;min-height: 155px">
                <div class="card-body">
                    <a href="mfeedback.php" class="btn btn-outline-primary btn-block">Feedback</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadowBlack ">
                <img class="card-img-top" src="images/loan.gif" alt="Card image cap"
                     style="max-height: 155px;min-height: 155px">
                <div class="card-body">
                    <a href="mloan_application.php" class="btn btn-outline-primary btn-block">Loan Application</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
