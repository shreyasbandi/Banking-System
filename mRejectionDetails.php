<?php
session_start();
if (!isset($_SESSION['managerId'])) {
    header('location:login.php');
}

if (!isset($_GET['application_id'])) {
    header('location:mindex.php');
}

$applicationId = $_GET['application_id'];

require 'assets/db.php';
require 'assets/function.php';

// Fetch details of the rejected loan application
$applicationDetails = getLoanApplicationDetails($con, $applicationId);

if (!$applicationDetails || $applicationDetails['status'] !== 'Rejected') {
    header('location:mindex.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Banking</title>
    <?php require 'assets/autoloader.php'; ?>
    <?php require 'assets/db.php'; ?>
    <?php require 'assets/function.php'; ?>
    <?php echo bankname; ?>
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
                <li class="nav-item ">
                    <a class="nav-link active" href="mindex.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item "> <a class="nav-link" href="maccounts.php">Accounts</a></li>
                <li class="nav-item "> <a class="nav-link" href="maddnew.php">Add New Account</a></li>
                <li class="nav-item "> <a class="nav-link" href="mfeedback.php">Feedback</a></li>
            </ul>
            <?php include 'msideButton.php'; ?>
        </div>
    </nav><br><br><br>
    <div class="container">
        <div class="card w-100 text-center shadowBlue">
            <div class="card-header" style="height:70px;">
                <h2> Loan Application Details </h2>
            </div>
            <div class="card-body">
                <h5>Details of the Rejected Loan Application:</h5>
                <p><strong>Application ID:</strong> <?php echo $applicationDetails['id']; ?></p>
                <p><strong>User ID:</strong> <?php echo $applicationDetails['userId']; ?></p>
                <p><strong>User Name:</strong> <?php echo $applicationDetails['name']; ?></p>
                <p><strong>Account No:</strong> <?php echo $applicationDetails['accountNo']; ?></p>
                <p><strong>Amount:</strong> <?php echo $applicationDetails['amount']; ?></p>
                <p><strong>Reason:</strong> <?php echo $applicationDetails['reason']; ?></p>
                <p><strong>Occupation:</strong> <?php echo $applicationDetails['occupation']; ?></p>
                <p><strong>Status:</strong> <?php echo $applicationDetails['status']; ?></p>
                <p><strong>Date:</strong> <?php echo $applicationDetails['date']; ?></p>
                
                <h5>Provide Reason for Rejection:</h5>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="rejectionReason">Reason for Rejection:</label>
                        <textarea class="form-control" id="rejectionReason" name="rejectionReason" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="application_id" value="<?php echo $applicationId; ?>">
                    <button type="submit" name="submitRejectionReason" class="btn btn-danger">Submit Rejection Reason</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['submitRejectionReason'])) {
        $rejectionReason = $_POST['rejectionReason'];
        updateRejectionReason($con, $applicationId, $rejectionReason);
    }

    function updateRejectionReason($con, $applicationId, $rejectionReason)
    {
        $query = "UPDATE loanRejection SET rejectionReason = '$rejectionReason' WHERE id = $applicationId";
        $result = $con->query($query);

        if (!$result) {
            die("Error updating rejection reason: " . $con->error . " Query: " . $query);
        }

        // Redirect to the page showing all rejected loans
        header("Location: mloanRejected.php");
        exit();
    }

    ?>
</body>

</html>
