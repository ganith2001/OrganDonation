<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=misc', 'fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$success=false;
if(isset($_POST['fname'])  && isset($_POST['dob'] ) && isset($_POST['street']) && isset($_POST['city']) && isset($_POST['state'] ) && (isset($_POST['phone1'] ) || isset($_POST['phone2'] )) && isset($_POST['ge'] )){

    $sql="INSERT INTO user2 (name1,dob,street,city,state1,signup_id) VALUES (:name1,:dob,:street,:city,:state1,:signup)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(':name1'=>$_POST['fname'],':dob'=>$_POST['dob'],':street'=> $_POST['street'],':city'=> $_POST['city'],':state1'=> $_POST['state'],':signup'=>$_SESSION['id']));
    $success="Record Inserted";

    $stmt=$pdo->prepare("SELECT user_id from user2 where name1=:xyz");
    $stmt->execute(array(":xyz"=>$_POST['fname']));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user_id']=$row['user_id'];


    if(isset($_POST['phone1'])){
    $sql1="INSERT INTO user_ph (user_id,phone_no) VALUES (:user,:phone1)";
    $stmt1=$pdo->prepare($sql1);
    $stmt1->execute(array(':user'=>$_SESSION['user_id'],':phone1'=>$_POST['phone1']));
    $success="Record Inserted";

    }
    if(isset($_POST['phone2'])){
        $sql2="INSERT INTO user_ph (user_id,phone_no) VALUES (:user,:phone2)";
        $stmt2=$pdo->prepare($sql2);
        $stmt2->execute(array(':user'=>$_SESSION['user_id'],':phone2'=>$_POST['phone2']));
        $success="Record Inserted";
    
        }

    //header("Location: home.php");
    if($_POST['ge']=="patient"){
    
        header("Location: http://".$_SERVER['HTTP_HOST']. "/organ/source/patient2.php");
    }
    if($_POST['ge']=="donor"){
        header("Location: http://".$_SERVER['HTTP_HOST']. "/organ/source/donor2.php");
    }
    
}
  

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Transparent Login Form with Blur Background</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
        <link href="style1.css" rel="stylesheet">
    </head>
    <body>
        <div class="contact-form">
            <img alt="" class="avatar" src="https://i.postimg.cc/zDyt7KCv/a1.jpg">
            <h2>USER</h2>
            <form method="POST">
        
                <p>Username</p><input  name="fname" placeholder="Enter Username" type="text">
                <p>Date of Birth</p><input  type="date" name="dob" id="dob"> 
                <p>Street</p><input type="text" name="street" id="street" placeholder="Street"> 
                <p>City</p><input type="text" name="city" id="city" placeholder="City"> 
                <p>State</p><select name="state" id="state"  placeholder="State">
                    <option style="color:grey" disabled selected >State</option>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                    <option value="Assam">Assam</option>
                    <option value="Bihar">Bihar</option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Chhattisgarh">Chhattisgarh</option>
                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                    <option value="Daman and Diu">Daman and Diu</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Lakshadweep">Lakshadweep</option>
                    <option value="Puducherry">Puducherry</option>
                    <option value="Goa">Goa</option>
                    <option value="Gujarat">Gujarat</option>
                    <option value="Haryana">Haryana</option>
                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                    <option value="Jharkhand">Jharkhand</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Kerala">Kerala</option>
                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                    <option value="Maharashtra">Maharashtra</option>
                    <option value="Manipur">Manipur</option>
                    <option value="Meghalaya">Meghalaya</option>
                    <option value="Mizoram">Mizoram</option>
                    <option value="Nagaland">Nagaland</option>
                    <option value="Odisha">Odisha</option>
                    <option value="Punjab">Punjab</option>
                    <option value="Rajasthan">Rajasthan</option>
                    <option value="Sikkim">Sikkim</option>
                    <option value="Tamil Nadu">Tamil Nadu</option>
                    <option value="Telangana">Telangana</option>
                    <option value="Tripura">Tripura</option>
                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                    <option value="Uttarakhand">Uttarakhand</option>
                    <option value="West Bengal">West Bengal</option>
                    </select>
                    <p>Phone 1</p><input type="phone" name="phone1" id="phone" placeholder="Phone 1">
                    <p>Phone 2</p><input type="phone" name="phone2" id="phone" placeholder="Phone 2">
                    <p> User Type</p><select name='ge' id="Type"  placeholder="Type">
                        <option style="color:grey" disabled selected > User Type</option>
                        <option value="donor">Donor</option>
                        <option value="patient">Patient</option>
                             <a href="https://www.w3schools.com">Visit W3Schools.com!</a>
                            <input type="submit" name="sb" value="SUBMIT">
                   
                        
                        
            </form>
      
        </div>
        
    </body>
    </html>