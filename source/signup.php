<?php

$pdo = new PDO('mysql:host=localhost;dbname=misc', 'fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$salt = 'abcd*_';
$success=false;
$faiure=false;
if(isset($_POST['txt'])  && isset($_POST['email'] ) && isset($_POST['pass1']) && isset($_POST['pass2'])){
    if($_POST['pass1']==$_POST['pass2']){
      if(strlen($_POST['pass1']) >= 8)
  {
    $stored = hash('md5', $salt.$_POST['pass1']);
    $sql="INSERT INTO signup (name1,email,pass) VALUES (:name1,:email,:pass)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(':name1'=>$_POST['txt'],':email'=>$_POST['email'],':pass'=>$stored));
    $success="Record Inserted";
    header("Location: home.php");
  }
  else
  {
    $faiure="Password should have atleast 8 charecters";
  }
    }
    else{
      $faiure="Password and confirm password not matching";
    }
   
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style2.css">
    
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
    

  </head>
  <body>
    <div class="signup-form">
    

      <form method="POST">
      
        <h1>Sign Up</h1>
        <?php
        if ( $faiure !== false ) {
          echo('<p style="color: red;">'.htmlentities($faiure)."</p>\n");
        }
     ?>
        <input type="text" name="txt" placeholder="Full Name" class="txtb" required>
        <input type="email" name="email" placeholder="Email" id="email" class="txtb" required>
        <input type="password" name="pass1"  placeholder="Password" id="pass" class="txtb" required>
        <input type="password" name="pass2" placeholder="Confirm Password" id="cp" class="txtb" required>
        
        <input type="submit" value="Create Account" class="signup-btn">
        <a href="demo.php">Already Have one ?</a>
      </form>

    </div>
  
  </body>
</html>
