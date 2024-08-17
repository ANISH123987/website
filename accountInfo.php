<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: login.php");
        exit();
    }
    require_once "config.php";

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
        header('location: login.php');
    }

    $username = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">
  <head>
    <script type="text/javascript"> 
        function printArea(areaID){
            var printContent = document.getElementById(areaID);
            var WinPrint = window.open('', '', 'width=900,height=650');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
           
        }
    </script>  
        
    <
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hotel Booking Management</title>


    <title>Hotel Booking Management</title>

    <style>
        
        body, h1, h2, h3, h4, h5, h6, p, ul {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            line-height: 1.6;
            background-color: #f8f9fa;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px;
        }

        .navbar {
            background-color: #343a40;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand {
            color: #ffffff;
            text-decoration: none;
            font-size: 1.5rem;
        }
        .navbar-nav {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        .navbar-nav .nav-item {
            margin-right: 15px;
        }
        .navbar-nav .nav-link {
            color: #ffffff;
            text-decoration: none;
            font-size: 1.2rem;
        }
        .navbar-nav .nav-link:hover {
            color: #adb5bd;
        }
        
        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #343a40;
        }
        p {
            margin-bottom: 15px;
            color: #343a40;
        }
      
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #ffffff;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            background-color: #007bff;
            border: 1px solid transparent;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
      
        img {
            max-width: 100%;
            height: auto;
            display: block;
        }
        
        input[type="text"], input[type="date"], input[type="number"], select {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        
        .account-details {
            font-size: 20px;
        }
        .account-details th, .account-details td {
            border: 1px solid black;
            padding: 15px;
        }
        .account-details th {
            text-align: left;
        }
        .account-details td {
            text-align: right;
        }
     
        .reservation-section h2 {
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .reservation-section h4 {
            color: grey;
        }
        .reservation-section .btn {
            float: right;
        }
        .cancel {
            color: red;
            font-size: 16.5px;
            text-decoration: none;
        }
        .cancel:hover {
            color: rgb(170, 0, 0);
        }
        .services {
            color: purple;
            font-size: 16.5px;
            text-decoration: none;
        }
        .services:hover {
            color: blueviolet;
        }
    </style>
  </head>
  <body>
    <nav class="navbar">
        <a class="navbar-brand" href="#">Hotel Booking Management</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="accountInfo.php"><?php echo $_SESSION['fname']?> <i class="fa fa-user" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <?php if($_SESSION["admin"] == 'YES'): ?>
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Admin</a></li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact <i class="fa fa-envelope-o" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </li>
        </ul>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div style="width: 50%;">
                <img src="https://i.imgur.com/H2EpCV0.png" title="source: imgur.com" style="width:50%"/>
            </div>
            <div style="width: 50%;">
                <h1 style="font-size: 75px; font-family: Brush Script MT; margin-top: 30px; margin-left: -200px; text-align: center;">Hotel Booking Management</h1>
                <h1 style="font-size: 40px; font-family: Lucida Handwriting; margin-left: -200px; text-align: center;">
                    <?php
                        if($_SESSION["admin"] == 'YES'){
                            echo "Admin";
                        } else {
                            echo "Client";
                        }
                        echo " Account Details";
                    ?>
                </h1>
            </div>
        </div>
        <br><br>
        <table class="account-details">
            <tr>
                <th>Name:</th>
                <td><?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?></td>
            </tr>
            <tr>
                <th>Username:</th>
                <td><?php echo $_SESSION['username']?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo $_SESSION['email']?></td>
            </tr>
            <tr>
                <th>Created On:</th>
                <td><?php echo $_SESSION["created_at"]?></td>
            </tr>
        </table>
    </div>
    <br><br>

<?php if($_SESSION["admin"] == 'NO'): ?>
    <form action="" method="post">
        <?php
            date_default_timezone_set("Asia/Calcutta");
            $dt = date('Y-m-d');
            $sql = "SELECT * FROM bookings WHERE username='" . $_SESSION['username'] . "' AND checkInDate<='$dt' AND checkOutDate>='$dt'";
            $results = mysqli_query($conn, $sql);
        ?>
        <div class="container reservation-section">
            <h2>On-going Reservations</h2>
            <hr style='color: black; height: 1.5px;'>
            <?php if(mysqli_num_rows($results) == 0): ?>
                <h4>No On-going Reservations!</h4>
            <?php else: ?>
                <?php $bkd = ''; $f = 0; ?>
                <?php while($bk = mysqli_fetch_assoc($results)): ?>
                    <?php if($bkd != $bk['booking_id']): ?>
                        <?php if($f == 1): $f = 0; ?>
                            </table>
                            </div><br>
                        <?php endif; ?>
                        <?php $bkd = $bk['booking_id']; $f = 1; ?>
                        <div class="row">
                            <div style="width: 50%;">
                                <h4>Booking ID: <?= $bkd?></h4>
                            </div>
                            <?php if($bk['checked_in'] == 'YES'): ?>
                            <div style="width: 33%;">
                                <h5 style='color: teal;'>Checked In</h5>
                            </div>
                            <div style="width: 17%;">
                            <?php else: ?>
                            <div style="width: 50%;">
                            <?php endif; ?>
                                <button type="submit" name="print" onclick="printArea(<?php echo $bkd; ?>)" class="btn">View</button>
                            </div>
                            <?php if($bk['checked_in'] == 'NO'): ?>
                            <div style="width: 17%;">
                                <a href="delete.php?booking_id=<?=$bk['booking_id']?>" class="cancel">Cancel</a>
                            </div>
                            <?php else: ?>
                            <div style="width: 17%;">
                                <a href="#services.php?booking_id=<?=$bk['booking_id']?>" class="services">Services</a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class='container' id='<?=$bkd?>' style='width: 800px; display: none;'>
                            <h1 style="font-family: Brush Script MT; font-size: 50px; text-align: center;">Hotel Booking Management System</h1>
                            <hr style="color: black; height: 1.5px; opacity: 1;">
                            <br>
                            <div class='row'>
                                <div style="width: 50%;">Booking ID: <?= $bk['booking_id']?></div>
                                <div style="width: 50%;">Reserved On: <?= $bk['reserved_on']?></div>
                                <div style="width: 50%;">Name: <?= $bk['name']?></div>
                                <div style="width: 50%;">Email: <?= $bk['email']?></div>
                                <div style="width: 50%;">Check-In Date: <?= $bk['checkInDate']?></div>
                                <div style="width: 50%;">Check-Out Date: <?= $bk['checkOutDate']?></div>
                            </div>
                            <br>
                            <table style="width: 100%; border: 1px solid black">
                                <tr>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;">Room Type</th>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;">Rooms No.</th>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;">Nightly Price</th>
                                </tr>
                    <?php endif; ?>
                                <tr>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;"><?= $bk['room_type'] ?></th>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;"><?= $bk['room_no'] ?></th>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;"><?= $bk['price'] ?></th>
                                </tr>
                <?php endwhile; ?>
            <?php endif; ?>
            </table>
            </div><br>

        <?php
            $sql = "SELECT * FROM bookings WHERE username='" . $_SESSION['username'] . "' AND checkInDate>'$dt'";
            $results = mysqli_query($conn, $sql);
        ?>
        <div class="container reservation-section">
            <h2>Upcoming Reservations</h2>
            <hr style='color: black; height: 1.5px;'>
            <?php if(mysqli_num_rows($results) == 0): ?>
                <h4>No Upcoming Reservations!</h4>
            <?php else: ?>
                <?php $bkd = ''; $f = 0; ?>
                <?php while($bk = mysqli_fetch_assoc($results)): ?>
                    <?php if($bkd != $bk['booking_id']): ?>
                        <?php if($f == 1): $f = 0; ?>
                            </table>
                            </div><br>
                        <?php endif; ?>
                        <?php $bkd = $bk['booking_id']; $f = 1; ?>
                        <div class="row">
                            <div style="width: 83%;">
                                <h4>Booking ID: <?= $bkd?></h4>
                            </div>
                            <div style="width: 17%;">
                                <button type="submit" name="print" onclick="printArea(<?php echo $bkd; ?>)" class="btn">View</button>
                            </div>
                            <div style="width: 17%;">
                                <a href="delete.php?booking_id=<?=$bk['booking_id']?>" class="cancel">Cancel</a>
                            </div>
                        </div>
                        <div class='container' id='<?=$bkd?>' style='width: 800px; display: none;'>
                            <h1 style="font-family: Brush Script MT; font-size: 50px; text-align: center;">Hotel Booking Management System</h1>
                            <hr style="color: black; height: 1.5px; opacity: 1;">
                            <br>
                            <div class='row'>
                                <div style="width: 50%;">Booking ID: <?= $bk['booking_id']?></div>
                                <div style="width: 50%;">Reserved On: <?= $bk['reserved_on']?></div>
                                <div style="width: 50%;">Name: <?= $bk['name']?></div>
                                <div style="width: 50%;">Email: <?= $bk['email']?></div>
                                <div style="width: 50%;">Check-In Date: <?= $bk['checkInDate']?></div>
                                <div style="width: 50%;">Check-Out Date: <?= $bk['checkOutDate']?></div>
                            </div>
                            <br>
                            <table style="width: 100%; border: 1px solid black">
                                <tr>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;">Room Type</th>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;">Rooms No.</th>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;">Nightly Price</th>
                                </tr>
                    <?php endif; ?>
                                <tr>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;"><?= $bk['room_type'] ?></th>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;"><?= $bk['room_no'] ?></th>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;"><?= $bk['price'] ?></th>
                                </tr>
                <?php endwhile; ?>
            <?php endif; ?>
            </table>
            </div><br>


        <?php
            $sql = "SELECT * FROM bookings WHERE username='" . $_SESSION['username'] . "' AND checkOutDate<'$dt'";
            $results = mysqli_query($conn, $sql);
        ?>
        <div class="container reservation-section">
            <h2>Past Reservations</h2>
            <hr style='color: black; height: 1.5px;'>
            <?php if(mysqli_num_rows($results) == 0): ?>
                <h4>No Past Reservations!</h4>
            <?php else: ?>
                <?php $bkd = ''; $f = 0; ?>
                <?php while($bk = mysqli_fetch_assoc($results)): ?>
                    <?php if($bkd != $bk['booking_id']): ?>
                        <?php if($f == 1): $f = 0; ?>
                            </table>
                            </div><br>
                        <?php endif; ?>
                        <?php $bkd = $bk['booking_id']; $f = 1; ?>
                        <div class="row">
                            <div style="width: 83%;">
                                <h4>Booking ID: <?= $bkd?></h4>
                            </div>
                            <div style="width: 17%;">
                                <button type="submit" name="print" onclick="printArea(<?php echo $bkd; ?>)" class="btn">View</button>
                            </div>
                        </div>
                        <div class='container' id='<?=$bkd?>' style='width: 800px; display: none;'>
                            <h1 style="font-family: Brush Script MT; font-size: 50px; text-align: center;">Hotel Booking Management System</h1>
                            <hr style="color: black; height: 1.5px; opacity: 1;">
                            <br>
                            <div class='row'>
                                <div style="width: 50%;">Booking ID: <?= $bk['booking_id']?></div>
                                <div style="width: 50%;">Reserved On: <?= $bk['reserved_on']?></div>
                                <div style="width: 50%;">Name: <?= $bk['name']?></div>
                                <div style="width: 50%;">Email: <?= $bk['email']?></div>
                                <div style="width: 50%;">Check-In Date: <?= $bk['checkInDate']?></div>
                                <div style="width: 50%;">Check-Out Date: <?= $bk['checkOutDate']?></div>
                            </div>
                            <br>
                            <table style="width: 100%; border: 1px solid black">
                                <tr>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;">Room Type</th>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;">Rooms No.</th>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;">Nightly Price</th>
                                </tr>
                    <?php endif; ?>
                                <tr>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;"><?= $bk['room_type'] ?></th>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;"><?= $bk['room_no'] ?></th>
                                    <th style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px; border: 1px solid black;"><?= $bk['price'] ?></th>
                                </tr>
                <?php endwhile; ?>
            <?php endif; ?>
            </table>
            </div><br>

    </form>
<?php endif; ?>
  </body>
</html>
