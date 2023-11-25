<?php
session_start();
if (!isset($_SESSION['managerId'])) {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Banking</title>
    <?php require 'assets/autoloader.php'; ?>
    <?php require 'assets/db.php'; ?>
    <?php require 'assets/function.php'; ?>
    <?php
    $destinationPage0 = "mfirstPage.php";
    ?>
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
            <div class="card-header" style="height:70px; position:relative; right:40px;">
                <h2 style="position:relative;right:80px;"> Pending Applications </h2>
                <form method="GET" action="mloan_application.php" class="mb-4" style="position:relative ;left:650px; bottom:40px">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label class="sr-only" for="searchAccountNo">Search Account No</label>
                            <input type="text" class="form-control mb-2" id="searchAccountNo" name="searchAccountNo" placeholder="Enter Account No">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-2">Search</button>
                            <button type="submit" class="btn btn-primary mb-2">Pending Applications</button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>user Id</th>
                        <th>User Name</th>
                        <th>Account No</th>
                        <th>Amount</th>
                        <th>Reason</th>
                        <th>Occupation</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $searchAccountNo = isset($_GET['searchAccountNo']) ? $_GET['searchAccountNo'] : '';
                    $searchCondition = empty($searchAccountNo) ? '' : " AND useraccounts.accountNo = '$searchAccountNo'";
                    $array = $con->query("SELECT la.id,la.userId,la.amount,la.reason,la.occupation,la.status,la.date,ua.name, ua.accountNo from loan_applications as la inner join useraccounts as ua on ua.id=la.userId where la.status = 'Pending'". $searchCondition);
                    if ($array->num_rows > 0) {
                        while ($row = $array->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td><?php echo $row["id"] ?></td>
                                <td><?php echo $row["userId"]?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['accountNo'] ?></td>
                                <td> <?php echo $row["amount"] ?></td>
                                <td><?php echo $row["reason"] ?></td>
                                <td><?php echo $row["occupation"] ?> </td>
                                <td><?php echo $row["status"] ?></td>
                                <td><?php echo $row["date"] ?></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="application_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="approve" class='btn btn-success btn-sm' data-toggle='tooltip' title="Approve">Approve</button>
                                        <button type="submit" name="reject" class='btn btn-danger btn-sm' data-toggle='tooltip' title="Reject">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        echo '<tr><td colspan="8">No Application Found</td></tr>';
                    }
                    ?>
                </tbody>
                <?php
                                if (isset($_POST['approve'])) {
                        $applicationId = $_POST['application_id'];
                        updateApplicationStatus($con, $applicationId, 'Approved');
                    }

                    if (isset($_POST['reject'])) {
                        $applicationId = $_POST['application_id'];
                        updateApplicationStatus($con, $applicationId, 'Rejected');
                    }


              function updateApplicationStatus($con, $applicationId, $status)
                {
                    
                    $query = "UPDATE loan_applications SET status = '$status' WHERE id = $applicationId";
                    
                    $result = $con->query($query);

                    if (!$result) {
                        die("Error updating status: " . $con->error . " Query: " . $query);
                    }
                }


                ?>
            </table>
            <div class="card-footer text-muted">
                <?php echo bankname; ?>
            </div>
        </div>
    </div>
    <div style="padding:22px; position:absolute; left:550px;">
        <a href="mloanApproved.php" class="btn btn-primary" style="width:200px;"> Approved Loan</a>
        <a href="mloanRejected.php" class="btn btn-primary" style="width:200px;"> Rejected Loan</a>
    </div>


</body>

</html>
