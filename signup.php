<?php
$con = new mysqli('localhost', 'root', '', 'mybankp', 3306);
define('bankname', 'MONOPOLY');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Set Password</title>
    <?php require 'assets/autoloader.php'; ?>
    <?php require 'assets/function.php'; ?>
</head>

<body>
    <h1 class="alert alert-dark bg-gradient-dark rounded-0">
        <img src="images/logo.png" style="object-fit:cover;object-position:center center" width="50" height="50" class="d-inline-block align-top" alt="">
        <?php echo bankname; ?>
    </h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadowBlack">
                    <div class="card-header">
                        <h2>Set Password</h2>
                    </div>
                    <form method="POST">
                        <div class="form-group">
                            <label for="accountNo">Account Number:</label>
                            <input type="text" class="form-control" id="accountNo" name="accountNo" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Set Password</button>
                    </form>
                    <br>
                    <a href="login.php" class="btn btn-secondary">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['accountNo']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $accountNo = $_POST['accountNo'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Check if passwords match
            if ($password !== $confirm_password) {
                echo '<div class="alert alert-danger" role="alert">Passwords do not match!</div>';
            } else {
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Check if the account number exists in the database
                $result = $con->query("SELECT * FROM `useraccounts` WHERE `accountNo` = '$accountNo'");
                if ($result->num_rows > 0) {
                    // Update the hashed password for the user
                    $con->query("UPDATE `useraccounts` SET `password` = '$hashedPassword' WHERE `accountNo` = '$accountNo'");
                    echo '<div class="alert alert-success" role="alert">Password set successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Account not found!</div>';
                }
            }
        }
    }
    ?>
</body>

</html>
