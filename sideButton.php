<a href="" class="btn btn-outline-primary" data-toggle="tooltip" title="Your current Account Balance">Acount Balance : Rs.<?php echo $userData['balance']; ?></a>
        <div class="nav-item dropdown" >
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <h7 style="color:aliceblue;"><?php echo $userData['name']; ?></h7>
            <img src="images\picon.jpeg" alt="User Image" width="30" height="30" class="d-inline-block align-top rounded-circle">   
        </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="changepassword.php">Change Password</a>
                <a class="dropdown-item" href="notice.php">Notice</a>
                <a class="dropdown-item" href="feedback.php">Help</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
               
            </div>
        </div>
    </div>