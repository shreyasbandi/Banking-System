<!DOCTYPE html>
<html>
<head>
	<title>Banking</title>
	<?php require 'assets/autoloader.php'; ?>
	<?php require 'assets/function.php'; ?>
	<?php
    $con = new mysqli('localhost','root','','mybankp',3306);
    define('bankname', 'MONOPOLY');
	session_start();
	
		$error = "";
		if (isset($_POST['userLogin'])) {
    $error = "";
    $user = $_POST['email'];
    $pass = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $con->prepare("SELECT id, email, password FROM userAccounts WHERE email = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $userEmail, $hashedPassword);
        $stmt->fetch();

        // Verify the hashed password
        if (password_verify($pass, $hashedPassword)) {
            $_SESSION['userId'] = $userId;
            $_SESSION['user'] = ['id' => $userId, 'email' => $userEmail];
            header('location:index.php');
        } else {
            $error = "<div class='alert alert-warning text-center rounded-0'>Username or password is incorrect. Please try again!</div>";
        }
    } else {
        $error = "<div class='alert alert-warning text-center rounded-0'>Username or password is incorrect. Please try again!</div>";
    }

    $stmt->close();
}
		
		if (isset($_POST['cashierLogin']))
		{
			$error = "";
  			$user = $_POST['email'];
		    $pass = $_POST['password'];
		   
		    $result = $con->query("select * from login where email='$user' AND password='$pass'");
		    if($result->num_rows>0)
		    { 
		      $data = $result->fetch_assoc();
		      $_SESSION['cashId']=$data['id'];
		      //$_SESSION['user'] = $data;
		      header('location:cindex.php');
		     }
		    else
		    {
		      $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
		    }
		}
		if (isset($_POST['managerLogin']))
		{
			$error = "";
  			$user = $_POST['email'];
		    $pass = $_POST['password'];
		   
		    $result = $con->query("select * from login where email='$user' AND password='$pass' AND type='manager'");
		    if($result->num_rows>0)
		    { 
		      $data = $result->fetch_assoc();
		      $_SESSION['managerId']=$data['id'];
		      //$_SESSION['user'] = $data;
		      header('location:mfirstPage.php');
		     }
		    else
		    {
		      $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
		    }
		}

	 ?>
</head>
<body style="background: url(images/banking_wp.jpg);background-size: 100%">
<h1 class="alert alert-dark bg-gradient-dark rounded-0"> 
	<img src="images/logo.png" style="object-fit:cover;object-position:center center" width="50" height="50" class="d-inline-block align-top" alt="">
	<?php echo bankname; ?>
</h1>
<br>
<?php echo $error ?>
<br>
<div id="accordion" role="tablist" class="w-25 float-right shadowBlack" style="margin-right: 222px">
	<br><h4 class="text-center">Select Your Session</h4>
  <div class="card rounded-0">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a style="text-decoration: none;" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         <button class="btn btn-outline-primary btn-block">User Login/SignUp</button>
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       <form method="POST">
       	<input type="email" value="" name="email" class="form-control" required placeholder="Enter Email">
       	<input type="password" name="password" value="" class="form-control" required placeholder="Enter Password">
       	<button type="submit" class="btn btn-primary btn-block btn-sm my-2" name="userLogin">Enter </button>
       </form>
	   <a href="signup.php" class="btn btn-primary btn-block btn-sm my-2">signUp</a>
      </div>
    </div>
  </div>
  <div class="card rounded-0">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed btn btn-outline-primary btn-block" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Manager Login
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
         <form method="POST">
       	<input type="email" value="" name="email" class="form-control" required placeholder="Enter Email">
       	<input type="password" name="password" value="" class="form-control" required placeholder="Enter Password">
       	<button type="submit" class="btn btn-primary btn-block btn-sm my-1" name="managerLogin">Enter </button>
       </form>
      </div>
    </div>
  </div>
  <div class="card rounded-0">
    <div class="card-header" role="tab" id="headingThree">
      <h5 class="mb-0">
        <a class="collapsed btn btn-outline-primary btn-block" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
         Cashier Login
        </a>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <form method="POST">
       	<input type="email" value="" name="email" class="form-control" required placeholder="Enter Email">
       	<input type="password" name="password" value="" class="form-control" required placeholder="Enter Password">
       	<button type="submit"  class="btn btn-primary btn-block btn-sm my-1" name="cashierLogin">Enter </button>
       </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>