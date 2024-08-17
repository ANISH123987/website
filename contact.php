<?php
require_once "config.php";
session_start();
$name = $email = $message = "";
$name_err = $email_err = $message_err = "";

if($_SERVER['REQUEST_METHOD']=="POST"){
    
    if(empty(trim($_POST['name']))){
        $name_err = "Name cannot be blank";
    }
    else{
        $sql = "SELECT id FROM contactform WHERE name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "s", $param_name);

            
            $param_name = trim($_POST['name']);
           
            if(mysqli_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                $name = trim($_POST['name']);
            }
            else{
                echo "<script>alert('Something went wrong');</script>";
            }
        }
    }

   
    if(empty(trim($_POST['message']))){
        $message_err = "Message cannot be blank";
    }
    else{
        $sql = "SELECT id FROM contactform WHERE message = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "s", $param_message);

            
            $param_message = trim($_POST['message']);
           
            if(mysqli_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                $message = trim($_POST['message']);
            }
            else{
                echo "<script>alert('Something went wrong');</script>";
            }
        }
    }
    
   
    if(empty(trim($_POST['email']))){
        $email_err = "Email cannot be blank";
    }
    else{
        $sql = "SELECT id FROM contactform WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "s", $param_email);

           
            $param_email = trim($_POST['email']);
            
            if(mysqli_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                $email = trim($_POST['email']);
            }
            else{
                echo "<script>alert('Something went wrong');</script>";
            }
        }
    }

    if(empty($name_err) && empty($email_err) && empty($message_err)){
        $sql = "INSERT INTO contactform (name, email, message) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_message);
            $param_name = $name;
            $param_email = $email;
            $param_message = $message;
            if(mysqli_stmt_execute($stmt)){
                echo "<script>alert('Submitted Successfully')</script>";
            }
            else{
                echo "<script>alert('Something went wrong.. Cannot Redirect');</script>";
            }
        }
        else{
            echo 'Something went wrong';
        }
    }
    else{
        if(!empty($name_err)){
            echo "<script>alert('$name_err')</script>";
        }
        elseif(!empty($email_err)){
            echo "<script>alert('$email_err')</script>";
        }
        elseif(!empty($message_err)){
            echo "<script>alert('$username_err')</script>";
        }
    }
    mysqli_close($conn);
}


?>


<!doctype html>
<html lang="en">
  <head>
    
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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

    /* Form Styling */
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

    /* Table Styling */
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

    /* Additional Styles */
    .mt-4 {
        margin-top: 1.5rem;
    }
    .text-center {
        text-align: center;
    }
    .text-right {
        text-align: right;
    }

    /* Placeholder for icons - replace with images or custom content if needed */
    .icon-user:before {
        content: "\f007"; /* Placeholder content, replace with actual icon or image */
        font-family: Arial, sans-serif;
    }
    .icon-envelope:before {
        content: "\f0e0";
        font-family: Arial, sans-serif;
    }
    .icon-sign-out:before {
        content: "\f08b";
        font-family: Arial, sans-serif;
    }
</style>

  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Hotel Booking Management</a>
            <ul class="navbar-nav">
            <?php if(!isset($_SESSION['username'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register <i class="fa fa-user-plus" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login <i class="fa fa-sign-in" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="contact.php">Contact <i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="accountInfo.php"><?php echo $_SESSION['fname']?> <i class="fa fa-user" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</i></a>
                </li>
                <?php if($_SESSION["admin"]=='YES'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Admin</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="contact.php">Contact <i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                </li>
            <?php endif; ?>
            </ul>
        </div>
    </nav>

<div class="container mt-4">
    <h2>Contact Us</h2>
    <hr>
    <form action="" method="post">
        <div class="row">
            <div class="col-6">
                <label for="inputname" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="inputname">
            </div>
            <div class="col-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="inputEmail4">
            </div>
        </div>
        <br>
        <div class="col-12">
            <label for="message" class="form-label">Message</label>
            <textarea type="text" class="form-control" name="message" style="height: 300px;text-align: top;"></textarea>
        </div>
        <br>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>