<?php

include 'admin/dist/functions.php';


//session login
session_start();
if(isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
if(isset($_SESSION['loginAdmin'])) {
  header("Location: admin/dist/index.php");
  exit;
}



//login pelanggan
if(isset($_POST['login'])){
    $UorEorT = $_POST['UET'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username='$UorEorT' OR email='$UorEorT'");
    $resultAdmin = mysqli_query($conn, "SELECT * FROM admin WHERE username='$UorEorT'");

    //cek apakah username ada
    if(mysqli_num_rows($result) === 1){

        //ambil data 
        $row = mysqli_fetch_assoc($result);

    
        // cek password
        if(password_verify($password, $row['password'])){
            //set session
            
            $_SESSION['login'] = $row;
            if (isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang'])) {
                header("Location: checkout.php");
            }
            else {
                header("Location: index.php");
            }

        }
        // login admin
    } else if(mysqli_num_rows($resultAdmin) === 1) {
        $passwordAdmin = mysqli_query($conn, "SELECT * FROM admin WHERE password='$password'");
        $dataAdmin = mysqli_fetch_assoc($resultAdmin);
        if(mysqli_num_rows($passwordAdmin) === 1) {
          $_SESSION['loginAdmin'] = $dataAdmin;
          header("Location: admin/dist/index.php");
          exit;
        }
    }
    echo "
    <script>
    alert('Username/email atau password yang anda masukan salah!');
    </script>";
    

}

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Toko Sembako</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Check-Out-Page-V100.css">
    <link rel="stylesheet" href="assets/css/ebs-contact-form-1.css">
    <link rel="stylesheet" href="assets/css/ebs-contact-form.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Pretty-Product-List.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form-1.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/WOWSlider-about-us-1.css">
    <link rel="stylesheet" href="assets/css/WOWSlider-about-us-2.css">
    <link rel="stylesheet" href="assets/css/WOWSlider-about-us.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color: #979890;">
        <div class="container"><img src="assets/img/toko.png" style="width: 100px;"><a class="navbar-brand" href="#" style="font-size: 23px;">TOKO SALSABILA</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="#">HOME</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">ABOUTB US</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">CONTACT</a></li>
                </ul><span class="navbar-text actions"> <a class="login" name="login" href="#" style="width: 12px;font-size: 26px;height: 15px;margin: 18px;">Log In</a><a class="btn btn-light action-button" role="button" href="#" style="background-color: rgb(206,207,234);font-size: 21px;">Sign Up</a></span></div>
        </div>
    </nav>
    <div class="login-clean">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-android-contact" style="color: rgb(0,155,193);"></i></div>
            <div class="form-group">
                <input class="form-control" type="text" required name="UET" placeholder="username">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" required name="password" placeholder="Password">
            </div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background-color: rgb(0,155,193);" name="login">Log In</button></div><a class="forgot" href="#">Forgot your email or password?</a></form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Profile-Edit-Form.js"></script>
    <script src="assets/js/WOWSlider-about-us.js"></script>
</body>

</html>