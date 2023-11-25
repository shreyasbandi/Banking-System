<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('location:login.php');
}

require 'assets/db.php';
require 'assets/autoloader.php';
require 'assets/function.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $userId = $_SESSION['userId'];
    $amount = $_POST['amount'];
    $interestRate = $_POST['interest_rate'];
    $reason = $_POST['reason'];
    $occupation = $_POST['occupation'];

    // Perform any necessary validations

    // Insert data into the 'loan_applications' table
    $insertQuery = "INSERT INTO loan_applications (userId, amount, reason, occupation) 
                    VALUES ('$userId', '$amount',  '$reason', '$occupation')";

    if ($con->query($insertQuery) === TRUE) {
        // Loan application successful
        header('location: loan_success.php'); // Redirect to a success page
        exit();
    } else {
        // Loan application failed
        header('location: loan_failure.php'); // Redirect to a failure page
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add necessary meta tags, stylesheets, and scripts -->
    <title>Loan Application</title>
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
            <li class="nav-item ">  <a class="nav-link" href="changepassword.php">change password</a></li>
            

        </ul>
        <?php include 'sideButton.php'; ?>
    </div>
</nav><br><br><br>
</head>
<body>
    <div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadowBlack">
                <div class="card-header">
                     <h2> Loan Applications </h2>
                </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="UserNmae" required class="form-control"><br>
                    </div>

                    <div class="form-group">
                    <label for="amount">Loan Amount:</label>
                    <input type="text" name="amount" required class="form-control"><br>
                    </div>

                    <div class="form-group">
                    <label for="reason">Reason for Loan:</label>
                    <textarea name="reason" required class="form-control"></textarea><br>
                    </div>

                    <div class="form-group">
                    <label for="occupation">Occupation:</label>
                    <input type="text" name="occupation" required class="form-control" ><br>
                    </div>

                    <input type="submit" value="Submit Application" class="btn btn-primary">
            </form>
            </div>
    </div>
    </div>
    </div>
</div>
</div>
<div style="position:absolute; right:70px;top:50px;"><a href="loanStatus.php" class="btn btn-primary mt-3 mb-3">Application Status</a></div>


</body>
</html>
