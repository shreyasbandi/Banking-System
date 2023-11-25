<?php
session_start();
if(!isset($_SESSION['managerId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <?php if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from useraccounts where id = '$_GET[delete]'"))
    {
      header("location:mindex.php");
    }
  } ?>

  <?php 
    $destinationPage0="mfirstPage.php";
  ?>
</head>
<body style="background-size: 100%" class="bg-gradient-seconday">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">
    <img src="images/logo.png" style="object-fit:cover;object-position:center center" width="30" height="30" class="d-inline-block align-top" alt="">
   <!--  <i class="d-inline-block  fa fa-building fa-fw"></i> --><?php echo bankname; ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link active" href="mfirstpage.php">Home <span class="sr-only">(current)</span></a>
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
    <div class="container">
        <div class="card w-100 text-center shadowBlue">
            <div class="card-header" style="height:70px;">
                <h2 style="position:relative;right:100px;"> All User Accounts </h2>
                <form method="GET" action="mindex.php" class="mb-4" style="position:relative ;left:650px; bottom:40px">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label class="sr-only" for="searchAccountNo">Search Account No</label>
                            <input type="text" class="form-control mb-2" id="searchAccountNo" name="searchAccountNo" placeholder="Enter Account No">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-2">Search</button>
                            <button type="submit" class="btn btn-primary mb-2">All Accounts</button>
                        </div>
                    </div>
                </form>
             </div>
            <table class="table table-bordered table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Holder Name</th>
                  <th scope="col">Account Number</th>
                  <th scope="col">Branch Name</th>
                  <th scope="col">Current Balance</th>
                  <th scope="col">Account type</th>
                  <th scope="col">Contact</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $searchAccountNo = isset($_GET['searchAccountNo']) ? $_GET['searchAccountNo'] : '';
                    $searchCondition = empty($searchAccountNo) ? '' : " AND useraccounts.accountNo = '$searchAccountNo'";
                    $array = $con->query("SELECT * FROM useraccounts, branch WHERE useraccounts.branch = branch.branchId" . $searchCondition);
                    if ($array->num_rows > 0) {
                        while ($row = $array->fetch_assoc()) {
                            $i++;
                            ?>
                          <tr> 
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['accountNo'] ?></td>
                            <td><?php echo $row['branchName'] ?></td>
                            <td>Rs.<?php echo $row['balance'] ?></td>
                            <td><?php echo $row['accountType'] ?></td>
                            <td><?php echo $row['number'] ?></td>
                            <td style="width:400px;">
                              <a href="show.php?id=<?php echo $row['id'] ?>" class='btn btn-success btn-sm' data-toggle='tooltip' title="View More info">View</a>
                              <a href="mnotice.php?id=<?php echo $row['id'] ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title="Send notice to this">Send Notice</a>
                              <a href="mindex.php?delete=<?php echo $row['id'] ?>" class='btn btn-danger btn-sm' data-toggle='tooltip' title="Delete this account">Delete</a>
                              <a href="mtransaction.php?accountNo=<?php echo $row['accountNo'] ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title="show Transaction">Show Transactions</a>

                            </td>
                          </tr>
                        <?php
                        }
                    } else {
                        echo '<tr><td colspan="8">No accounts found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
            <div class="card-footer text-muted">
                <?php echo bankname; ?>
            </div>
        </div>
    </div>
</body>
</html>
