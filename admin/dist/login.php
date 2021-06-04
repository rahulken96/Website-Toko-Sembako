<?php
include 'functions.php';

session_start();
if(isset($_SESSION['loginAdmin'])) {
  header("Location: index.php");
  exit;

}
if(isset($_SESSION['login'])) {
  header("Location: C:/xampp/htdocs/projek_web/index.php");
  exit;
}
//login admin
if(isset($_POST['login'])){
  $UorEorTAdmin = $_POST['username'];
  $passwordAdmin = $_POST['password'];

  $resultAdmin = mysqli_query($conn, "SELECT * FROM admin WHERE username='$UorEorTAdmin'");

  //cek apakah username ada
  if(mysqli_num_rows($resultAdmin) === 1){


      $resultPasswordAdmin = mysqli_query($conn, "SELECT * FROM admin WHERE password='$passwordAdmin'");
   $row = mysqli_fetch_assoc($resultAdmin);
      // cek password
      if(mysqli_num_rows($resultPasswordAdmin) === 1){

          $_SESSION['loginAdmin'] = $row;
          header("Location: index.php");
          exit;
      }
  }
  echo "
  <script>
  alert('Username atau password yang anda masukan salah!');
  </script>";
  

}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login.css">
    <script src="https://kit.fontawesome.com/8bf6e38d9a.js" crossorigin="anonymous"></script>

    <title>LOGIN</title>
  </head>
  <body>
    <div class="container">
      <a class="fas fa-user-circle" style="text-align:center"></a>
      <h4 class="text-center">LOGIN ADMIN</h4>
      <hr> 
    </hr>

      <form action="" method="post">
        <div class="form-group">
          <i class="far fa-user"></i>
          <label>Username</label>
          <input type="text" name="username" class="form-control" placeholder="Masukkan Username Anda">
        </div>
        <div class="form-group">
          <i class="fas fa-lock"></i>
          <label>Password</label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda">
        </div>
        
          <button type="submit" name="login" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-danger">Reset</button>
      </form>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>