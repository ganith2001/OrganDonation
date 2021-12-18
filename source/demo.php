<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=misc', 'fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$failure=false;
$salt = 'abcd*_';
if(isset($_POST['mail'])  && isset($_POST['buttn'] ) && isset($_POST['passw'] )){
    unset($_SESSION['name']);
    $stored = hash('md5', $salt.$_POST['passw']);
$stmt=$pdo->prepare("SELECT signup_id,name1,email,pass from signup where email=:xyz and pass=:zyx ");
$stmt->execute(array(":xyz"=>$_POST['mail'],":zyx"=>$stored));

$row=$stmt->fetch(PDO::FETCH_ASSOC);


}

  
   

 if(isset($row)){
    $_SESSION['success']="success";
    $_SESSION['id']=$row['signup_id'];
    $_SESSION['name']=$row['name1'];
    $_SESSION['email']=$row['email'];
    if(isset($_POST['mail']) && isset($_POST['passw']) && $_SESSION['email']==$_POST['mail']){
    header("Location: home.php");
    return;
    }
    else{
        $failure="Incorrect userID or password";
    }
    
}


?>


<html>
<head>
<title>Amplify-Log In</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    
  
        
     
<body>
    <div   class="loginbox">
    <img src="../images/person.jpg" class="avatar">
    
        <h1>Login Here</h1>
       <?php
       if ( $failure !== false ) {
  
        echo('<p style="color: yellow;">'. htmlentities($failure)."</p>\n");
        //unset($_SESSION['error']);
    }
    
    
    ?>
        <form method="POST">
            <p>UserID</p>
            <input type="text" name="mail" placeholder="Enter UserID" required>
            <p>Password</p>
            <input type="password" name="passw" placeholder="Enter Password" required>
            <input type="submit" name="buttn" value="Login">
            <a href="forgot.html">Lost your password?</a><br>
            <a href="signup.php">Don't have an account?</a>
        </form>
        
    </div>

</body>
</head>
</html>
