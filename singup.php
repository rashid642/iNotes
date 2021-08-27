<?php 
$showAlert=false;
$showError=false;
$exist=false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    
    require 'partials/dbconnect.php';
    $username=$_POST["username"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];
    
    //check wheater it exist
    $existsql="SELECT * FROM `user` WHERE `username` LIKE '$username'";
    $result=mysqli_query($conn,$existsql);
    $numExistRows=mysqli_num_rows($result);
    if($numExistRows>0){
      $exist=true;
    }
    if(($password==$cpassword) && $exist==false){
        $sql="INSERT INTO `user` (`srno`, `username`, `password`, `date`) VALUES (NULL, '$username', '$password', current_timestamp());";
        $result=mysqli_query($conn,$sql);
        if($result){
            $showAlert=true;
        }
    }
    if($password!=$cpassword){
      $showError=true;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>SignUp</title>
  </head>
  <body>
    <?php require 'partials/_navbar.php';?>
    <?php
    if($showAlert)
    { echo' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account has been created and you can login
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';}
    if($exist)
    { echo' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Username already exist
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';}
    if($showError)
    { echo' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Password did not matched
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';}
    
    ?>
    <div class="container">
    <h1 class="text-center">Singup to our website</h1>
    <form action="/loginsys/singup.php" method="POST">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" maxlenght="20" class="form-control" id="username" name="username" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
    <div id="emailHelp" class="form-text">Make sure it's same password</div>

  </div>
  <button type="submit" class="btn btn-primary">SignUp</button>
</form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>