<?php
session_start();
if(!isset($_SESSION['managerId'])){ header('location:login.php');}
?>
<?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>

<?php
// Check if the button is clicked
if (isset($_POST['executeProcedure'])) {
    // Use prepared statement to avoid SQL injection
    $sql = "CALL GetTotalTransactions()";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->execute();
        $stmt->bind_result($totalTransactions);

        if ($stmt->fetch()) {
            $resultMessage = "Total Transactions: " . $totalTransactions/2;
        } else {
            $resultMessage = "Error fetching result: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $resultMessage = "Error executing the stored procedure: " . $con->error;
    }
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
   <style>
      .tbody{
        padding:20px;
      }
  </style>
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
            <li class="nav-item ">  <a class="nav-link" href="maccounts.php">Accounts</a></li>
            <li class="nav-item ">  <a class="nav-link" href="maddnew.php">Add New Account</a></li>
            <li class="nav-item ">  <a class="nav-link" href="mfeedback.php">Feedback</a></li>
            <li class="nav-item ">  <a class="nav-link" href="mloan_application.php">Loan Application</a></li>
            <li class="nav-item ">  <a class="nav-link" href="mstatements.php">Transaction Statements</a></li> 
        </ul>
        <?php include 'msideButton.php'; ?>
    </div>
</nav><br><br><br>

<div class="container">
  <div class="card w-75 mx-auto">
    <div class="card-header text-center">
      Transactions made by all users
    </div>
    
    <div class="card-body">
      <div id="list-group rounded-0">
        <?php 
         $array = $con->query("SELECT t.*, 
                            sender.name AS sender_name, 
                            sender.balance AS sender_balance, 
                            receiver.name AS receiver_name, 
                            receiver.balance AS receiver_balance
                     FROM `transaction` t
                     LEFT JOIN `useraccounts` sender ON t.senderAccountNo = sender.accountNo
                     LEFT JOIN `useraccounts` receiver ON t.receiverAccountNo = receiver.accountNo
                     ORDER BY t.`date` DESC");

                if ($array->num_rows > 0) {
                    while ($row = $array->fetch_assoc()) {
                        // Check if senderInfo is not null before accessing its properties
                        $senderInfo = ($row['sender_name'] !== null) ? [
                            'name' => $row['sender_name'],
                            'balance' => $row['sender_balance']
                        ] : null;

                        // Check if receiverInfo is not null before accessing its properties
                        $receiverInfo = ($row['receiver_name'] !== null) ? [
                            'name' => $row['receiver_name'],
                            'balance' => $row['receiver_balance']
                        ] : null;
              if ($row['action'] == 'withdraw') 
              {
                echo "<div class=' alert alert-secondary tbody'>User {$senderInfo['name']} withdrew Rs.{$row['debit']} from account no. {$row['senderAccountNo']} at {$row['date']}. Balance: Rs.{$senderInfo['balance']}</div>";
              }
              if ($row['action'] == 'deposit') 
              {
                echo "<div class='alert alert-success tbody'>User {$senderInfo['name']} deposited Rs.{$row['credit']} in account no. {$row['senderAccountNo']} at {$row['date']}. Balance: Rs.{$senderInfo['balance']}</div>";
              }
              if ($row['action'] == 'transfer' && $row['debit'] > 0) 
              {
                echo "<div class=' alert alert-warning tbody'>User {$senderInfo['name']} transferred Rs.{$row['debit']} from account no. {$row['senderAccountNo']} to account no. {$row['receiverAccountNo']} at {$row['date']}. Sender's Balance: Rs.{$senderInfo['balance']}.</div>";
              }
              if ($row['action'] == 'transfer1' && $row['credit'] > 0) 
              {
                echo "<div class=' alert alert-success tbody'>User {$receiverInfo['name']} received Rs.{$row['credit']} at {$row['date']} from account no. {$row['senderAccountNo']}. Receiver's Balance: Rs.{$receiverInfo['balance']}</div>";
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
<div style="position:absolute; right:90px; top:100px;">
    <div>
     <form method="post" action="">
      <button type="submit" name="executeProcedure" class="btn btn-primary">Total Number Of Transaction</button>
  </form>
    </div>
    <div>
        <?php if (isset($resultMessage)) : ?>
            <div class="alert alert-info"><?php echo $resultMessage; ?></div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
