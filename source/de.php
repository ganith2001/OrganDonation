<?php 
		session_start(); 
        $pdo = new PDO('mysql:host=localhost;dbname=misc', 'fred', 'zap');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_POST['del']) && isset($_SESSION['id'])){
            $stmt=$pdo->prepare("DELETE patient_organ from user2 inner join patient on user2.user_id = patient.user_id inner join patient_organ on patient.patient_id=patient_organ.patient_id where signup_id=:asd;");
            $stmt->execute(array(":asd"=>$_SESSION['id']));

            $stmt=$pdo->prepare("DELETE patient FROM user2 INNER JOIN patient ON user2.user_id = patient.user_id WHERE signup_id=:tyu");
            $stmt->execute(array(":tyu"=>$_SESSION['id']));

            $stmt=$pdo->prepare("DELETE donor_organ from user2 inner join donor on user2.user_id = donor.user_id inner join donor_organ on donor.donor_id=donor_organ.donor_id where signup_id=:asd;");
            $stmt->execute(array(":asd"=>$_SESSION['id']));

            $stmt=$pdo->prepare("DELETE donor FROM user2 INNER JOIN donor ON user2.user_id = donor.user_id WHERE signup_id=:tyu");
            $stmt->execute(array(":tyu"=>$_SESSION['id']));

            $stmt=$pdo->prepare("DELETE user_ph FROM user2 INNER JOIN user_ph ON user2.user_id = user_ph.user_id WHERE signup_id=:abc");
            $stmt->execute(array(":abc"=>$_SESSION['id']));

            $stmt=$pdo->prepare("DELETE FROM user2 where signup_id=:qwe");
            $stmt->execute(array(":qwe"=>$_SESSION['id']));

            $stmt=$pdo->prepare("DELETE FROM signup where signup_id=:xyz");
            $stmt->execute(array(":xyz"=>$_SESSION['id']));
            header("Location: logout.php");
        }

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>DEACTIVATION</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
        <link href="st.css" rel="stylesheet">
    </head>
    <body>
        <div class="contact-form">
            <img alt="" class="avatar" src="https://i.postimg.cc/50p8Jxff/1070482.jpg">
            <h2>DEACTIVATION</h2>
            <form method="post">
                <center>
            <?php echo('<h1 style="color:white">'.$_SESSION['name']."</h1>");
                echo('<h1 style="color:white">'.$_SESSION['email']."</h1>"); ?>
               </center>
                       
            </form>
            <form method="post">
<center><input type="submit" name="del" value="deactivate"></center>
    </form>
        </div>
    </body>
    </html>`1