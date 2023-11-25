<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <style>
      .tbody{
        padding:5px;
      }
  </style>
</head>
<body style="background-size: 100%" class="bg-gradient-seconday">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="index.php">  
    <img src="images/logo.png" style="object-fit:cover;object-position:center center" width="30" height="30" class="d-inline-block align-top" alt="">
    <?php echo bankname; ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="accounts.php">Accounts</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="statements.php">Account Statements</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="transfer.php">Funds Transfer</a>
      </li>
    </ul>
    <?php include 'sideButton.php'; ?>
  </div>
</nav><br><br><br>
<div class="container">
  <div class="card w-75 mx-auto">
    <div class="card-header text-center">
      Transactions
    </div>
    <div class="card-body">
      <div id="list-group rounded-0">
        <?php 
          $array = $con->query("SELECT * FROM `transaction` WHERE `senderAccountNo` = '$userData[accountNo]' ORDER BY `date` DESC");
          $array2 = $con->query("SELECT * FROM `transaction` WHERE  `receiverAccountNo` = '$userData[accountNo]' ORDER BY `date` DESC");
          if ($array->num_rows > 0) 
          {
            while ($row = $array->fetch_assoc()) 
            {
              if ($row['action'] == 'withdraw') 
              {
                echo "<div class=' alert alert-secondary tbody'>You withdrew Rs.{$row['debit']} from your account at {$row['date']}</div>";
              }
              if ($row['action'] == 'deposit') 
              {
                echo "<div class=' alert alert-success tbody'>You deposited Rs.{$row['credit']} in your account at {$row['date']}</div>";
              }
              // if ($row['action'] == 'deduction') 
              // {
              //   echo "<div class='list-group-item alert alert-danger'>Deduction made for Rs.{$row['debit']} from your account</div>";
              // }
              if ($row['action'] == 'transfer' && $row['debit'] > 0) 
              {
                echo "<div class=' alert alert-warning tbody'>Transfer made for Rs.{$row['debit']} from your account at {$row['date']} to account no. {$row['receiverAccountNo']}</div>";
              }
              
            }
          } 
          if ($array2->num_rows > 0) 
          {
            while ($row = $array2->fetch_assoc()) 
            {
              if ($row['action'] == 'transfer1' && $row['credit']>0) 
              { 
                 echo "<div class=' alert alert-success tbody'>Amount Rs.{$row['credit']} credited to your account at {$row['date']} from account no. {$row['senderAccountNo']}</div>";
              }
              
            }
          }
          else {
            echo "<div class='text-center'><small class='text-muted'><i>No transactions have been made yet.</i></small></div>";
          }
        ?>  
      </div>
    </div>
    <div class="card-footer text-muted">
      <?php echo bankname ?>
    </div>
  </div>
</div>
</body>
</html>
