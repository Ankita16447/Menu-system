<?php
$showAlert = false;
$showerror = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
include "partials/_dbconnect.php";
$username = $_POST["username"];
$password = $_POST["password"];
$confirmpassword = $_POST["confirmpassword"];
//$exists = false;

$existSql = "SELECT * FROM users WHERE username = '$username' ";
$result = mysqli_query($conn ,$existSql);
$numExistRows = mysqli_num_rows($result);

if($numExistRows >0)
{
    //$exists = true;
    $showerror = "username already exists";
}

else{
    //$exists = false;
if(($password ==  $confirmpassword))
{
  $hash = password_hash($password, PASSWORD_DEFAULT);
 $sql = "INSERT INTO `users` (`username`, `password`, `date_time`) VALUES ('$username', '$hash', current_timestamp());";

  $result = mysqli_query($conn , $sql);

   if($result){
  $showAlert = true;
}

}

else{
    $showerror = "Password does not match";
   }
}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Signup!</title>
  </head>
  <body>
   <?php require 'partials/_navbar.php' ?>

   <?php
   if($showAlert)
   {
    
   echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account has been created succseefully and you can login now.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if($showerror)
{
 
echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Error!</strong> '. $showerror. '
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>

    <div class="container mt-3">
     <h1 class="text-center">Signup to our website</h1>
     <form action="/menusystem/signon.php" method="post">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">   
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name = "password">
  </div>

  <div class="mb-3">
    <label for="confirmpassword" class="form-label">ConfirmPassword</label>
    <input type="password" class="form-control" id="confirmPassword" name="confirmpassword">
    <div id="emailHelp" class="form-text">Make sure you have entered the correct password.</div>
  </div>

  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Signup</button>
</form>

    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>



