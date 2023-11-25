<?php
session_start();
if (!isset($_SESSION['userId'])) {
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

    $destinationPage = "index.php";
    ?>

</head>
<body style="background-size: 100%" class="bg-gradient-seconday">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="<?php echo $destinationPage ?>">
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
                <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">  <a class="nav-link" href="accounts.php">Accounts</a></li>
            <li class="nav-item ">  <a class="nav-link" href="statements.php">Account Statements</a></li>
            <li class="nav-item ">  <a class="nav-link" href="transfer.php">Funds Transfer</a></li>
            <li class="nav-item ">  <a class="nav-link" href="loanApplication.php">Loan Application</a></li>
        </ul>
        <?php include 'sideButton.php'; ?>
    </div>
</nav><br><br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="jumbotron shadowBlack" style="padding: 25px; min-height: 241px; max-height: 531px; max-width: 500px; overflow-y: auto;">
                <h4 class="display-5">Welcome to MONOPOLY </h4>
                <p class="lead alert alert-warning"><b>Latest Notification:</b>
                    <?php
                    $array = $con->query("select * from notice where userId = '$_SESSION[userId]' order by date desc");
                    if ($array->num_rows > 0) {
                        $row = $array->fetch_assoc();
                        echo $row['notice'];
                    } else {
                        echo "<div class='alert alert-info'>Notice box empty</div>";
                    }
                    ?>
                </p>
            </div>
        </div>

        <!-- Two cards beside the notification card -->
        <div class="col-md-4">
            <div class="card shadowBlack ">
                <img class="card-img-top" src="images\information.webp" style="max-height: 155px;min-height: 155px;" alt="Card image cap">
                <div class="card-body">
                    <a href="accounts.php" class="btn btn-outline-info shadow btn-block">Account Details</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadowBlack ">
                <img class="card-img-top" src="images/tansfer.gif" alt="Card image cap" style="max-height: 155px;min-height: 155px">
                <div class="card-body">
                    <a href="transfer.php" class="btn btn-outline-info shadow btn-block">Transfer Money</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Three cards below the notification card in a row -->
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card shadowBlack ">
                <img class="card-img-top" src="images/notif.gif" style="max-height: 155px;min-height: 155px" alt="Card image cap">
                <div class="card-body">
                    <a href="notice.php" class="btn btn-outline-primary btn-block">Check Notification</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadowBlack ">
                <img class="card-img-top" src="images/send_mail.gif" alt="Card image cap" style="max-height: 155px;min-height: 155px">
                <div class="card-body">
                    <a href="feedback.php" class="btn btn-outline-primary btn-block">Contact Us</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadowBlack ">
                <img class="card-img-top" src="images/loan.gif" alt="Card image cap" style="max-height: 155px;min-height: 155px">
                <div class="card-body">
                    <a href="loanApplication.php" class="btn btn-outline-primary btn-block">Loan Application</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
