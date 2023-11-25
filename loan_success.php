<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php');}
?>

<!DOCTYPE html>
<html>
    
<head>
    <?php require 'assets/autoloader.php'; ?>
    <?php require 'assets/db.php'; ?>
    <?php require 'assets/function.php'; ?>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .card-container {
            text-align: center;
        }

        .card {
            width: 18rem;
        }
    </style>





</head>
<body style="background-color:white">
<div style="color: black; font-size: 16px;">
        <div class="card">
            <img class="card-img-top" src="https://www.edgeineersclub.com/images/transaction-successful.png" alt="Card image cap">
            <div class="card-body">
                <p class="card-text" style="left:60px"><h6><strong>Loan Application Successfully Submited</strong></h6></p>
            </div>
        </div>
    </div>
    <div>
    <form action="index.php">
        <button type="submit" class="btn btn-primary" style="position:absolute;bottom:130px; left:795px;"> back</button>

    </form>
    </div>
</div>




    </div>
    

</body>
</html>
