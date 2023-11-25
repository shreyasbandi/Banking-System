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
            <img class="card-img-top" src="https://th.bing.com/th/id/OIP.4XZko78ev0JEDx2a1pxn9wHaHa?pid=ImgDet&w=900&h=900&rs=1" alt="Card image cap">
            <div class="card-body">
                <p class="card-text" style="left:60px"><h5><strong>Transaction Failed !</strong></h5></p>
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
