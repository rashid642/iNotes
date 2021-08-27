 <?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?> 
<?php
require 'partials/dbconnect.php';

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <title>Welcome</title>
    <style>
    footer{
      height: 200px;
    }
    </style>
  </head>
  <body>
    <?php require 'partials/_navbar.php';?>
    <?php
     $sql="CREATE TABLE `user123`.`".$_SESSION['username']."` ( `srno` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(20) NOT NULL , `note` VARCHAR(50) NOT NULL , `action` VARCHAR(20) NOT NULL , PRIMARY KEY (`srno`)) ENGINE = InnoDB;
     ";

     $result=mysqli_query($conn,$sql);
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $title=$_POST['title'];
      $note=$_POST['note'];
   
    
    //echo "connection successfull";
$sqlIns="INSERT INTO `".$_SESSION['username']."` (`title`, `note`) VALUES ('$title', '$note');";
$resultIns=mysqli_query($conn,$sqlIns);
if($resultIns){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Your Note has been Submitted- </strong>Note Title-'. $title .'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';}
else{
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong>Your notes are not submitted
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';}
    }
    ?>
    
    <div class="container">
    <div class="alert alert-success my-3" role="alert">
    <h4 class="alert-heading"><h1>welcome <?php echo $_SESSION['username'] ?></h1></h4>
   <p>Hey, how are you? Your are logged in</p>
   <p class="mb-0">Whenever you need to logout be sure <a href="/loginsys/logout.php">using this link<a></p>
   <hr>
   
   
   </div>
   <div class="container my-3">
        <h2>Add Notes</h2>
        <form action="/loginsys/welcome.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="texarea" class="form-label">Note-</label>
                <textarea class="form-control" name="note" id="note" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
    
    <div class="container">
    <table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">Sr No.</th>
        <th scope="col">Title</th>
        <th scope="col">Note</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
//            $sql="SELECT * FROM `".$_SESSION['username']."`";
//            $result=mysqli_query($conn,$sql);
//            $num= mysqli_num_rows($result);
// if($num!=0)
// { $count=1;
//     while($row=mySqli_fetch_assoc($result)){
    
//     echo ' 
//       <tr>
//         <th scope="row">'.$count.'</th>
//         <td>'.$row['title'].'</td>
//         <td>'.$row['note'].'</td>
//         <td>Update coming soon     
//         </td>
//       </tr>
//    ';
//   $count=$count+1;

// }
// }

$sql="SELECT * FROM `".$_SESSION['username']."`";

          $resultRow = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($resultRow)){
            $sno = $sno + 1;
            echo ' <tr>
                    <th scope="row">'.$sno.'</th>
                    <td>'.$row['title'].'</td>
                    <td>'.$row['note'].'</td>
                    <td>Update coming soon     
                    </td>
                  </tr>';
          }
        ?>
    </tbody>
  </table>
       
       
    </div>
    <footer>
    </footer>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
      } );
        </script>
 <script>
      let edits=document.getElementsByClassName('edit');
      Array.from(edits).forEach(element=>{
          element.addEventListener("click",(e)=>{
            console.log("edit",e.target);
          })
      })
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>