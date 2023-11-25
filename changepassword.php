<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header('location:login.php');
    exit;
}

// Include your database connection and other necessary files here
require 'assets/autoloader.php';
require 'assets/db.php';
require 'assets/function.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changePassword'])) {
    // Get user input
    $userId = $_SESSION['userId'];
    $oldPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Retrieve the current hashed password from the database
    $stmt = $con->prepare("SELECT password FROM useraccounts WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($currentHashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Verify the old password
    if (password_verify($oldPassword, $currentHashedPassword)) {
        // Verify that the new password and confirmation match
        if ($newPassword == $confirmPassword) {
            // Hash the new password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the hashed password in the database
            $updateStmt = $con->prepare("UPDATE useraccounts SET password = ? WHERE id = ?");
            $updateStmt->bind_param("si", $hashedNewPassword, $userId);

            if ($updateStmt->execute()) {
                // Display success message using JavaScript
                echo '<script>alert("Password changed successfully!");</script>';
            } else {
                echo "Error changing password: " . $updateStmt->error;
            }

            $updateStmt->close();
        } else {
            echo "New password and confirmation do not match.";
        }
    } else {
        echo "Invalid old password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadowBlack">
                <div class="card-header">
                    <h2>Change Password</h2>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($errorMessage)) {
                        echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
                    } elseif (isset($successMessage)) {
                        echo '<div class="alert alert-success">' . $successMessage . '</div>';
                    }
                    ?>
                    <form method="POST">
                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <button type="submit" name="changePassword" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
