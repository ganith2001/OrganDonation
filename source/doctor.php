<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=misc', 'fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$success=false;
if(isset($_POST['hname'])  && isset($_POST['dname'] ) && (isset($_POST['phone1'] ) || isset($_POST['phone2'] )) && isset($_POST['area'] )){

    $stmt=$pdo->prepare("SELECT organisation_id from organisation where organisation_name=:name1 and street=:street and city=:city and state=:state1");
    $stmt->execute(array(":name1"=>$_POST['hname'],":street"=>$_POST['street'],":city"=>$_POST['city'],":state1"=>$_POST['state']));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['organisation_id']=$row['organisation_id'];

    $a=0;
    while(1){
    if($_POST['hname']=="vol".$a){
    $sql="INSERT INTO doctor (name,area_of_specialisation,organisation_id) VALUES (:name2,:area,:id)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(':name2'=>$_POST['dname'],':area'=> $_POST['area'],':id'=> $_SESSION["vol".$a]));
    $success="Record Inserted";
    break;
    }
    $a=$a+1;
    }
    
    $stmt=$pdo->prepare("SELECT doctor_id from doctor where name=:xyz");
    $stmt->execute(array(":xyz"=>$_POST['dname']));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['doctor_id']=$row['doctor_id'];

    if(isset($_POST['phone1'])){
        $sql4="INSERT INTO doctor_ph (doctor_id,phone_no) VALUES (:doc,:phone1)";
        $stmt4=$pdo->prepare($sql4);
        $stmt4->execute(array(':doc'=>$_SESSION['doctor_id'],':phone1'=>$_POST['phone1']));
        $success="Record Inserted";
    
        }
        if(isset($_POST['phone2'])){
            $sql5="INSERT INTO doctor_ph (doctor_id,phone_no) VALUES (:doc,:phone2)";
            $stmt5=$pdo->prepare($sql5);
            $stmt5->execute(array(':doc'=>$_SESSION['doctor_id'],':phone2'=>$_POST['phone2']));
            $success="Record Inserted";
        
            }
    //header("Location: home.php");
   
    
}
  

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
      
        <title>DOCTOR</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
        <link href="doc.css" rel="stylesheet">
    </head>
    <body>
        <div class="contact-form">
            <img alt="" class="avatar" src="https://i.postimg.cc/15h8b7Bn/pngtree-vector-doctor-icon-png-image-515568.jpg">
            <h2>DOCTOR</h2>
            <?php
        if ( $success !== false ) {
          echo('<h1 style="color: red;">'.htmlentities($success)."</h1>\n");
        }
     ?>
            <form method="POST">
                <p>Doctor's Name</p><input name="dname" placeholder="Enter Doctor Name" type="text">
                <p>Area of Specialisation</p><select name="area" id="state"  placeholder="AOS">
                    <option style="color:grey" disabled selected >AOS</option>
                    <option value="Kidney">Kidney</option>
                    <option value="Lungs">Lungs</option>
                    <option value="Eyes">Eyes</option></select>
                <p>Hospital Name</p>
                <p>
    <?php
    $stmt=$pdo->query("SELECT organisation_id,organisation_name,street,city,state from organisation ");
   
echo('<select id="cars" name="hname" placeholder="Hospital Name">');
$i=0;

echo('<option value="volvo">'."Hospital Name".'</option>');
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    $_SESSION["vol".$i]=$row['organisation_id'];
    echo('<option value='."vol".$i.'>'.$row['organisation_name'].",".$row['street'].",".$row['city'].",".$row['state'].'</option>');
    
    $i=$i+1;
} 
 echo("</select>");

 ?>
  </P>
                
                
                     
                    <p>Phone 1</p><input type="phone" name="phone1" id="phone" placeholder="Phone 1">
                    <p>Phone 2</p><input type="phone" name="phone2" id="phone" placeholder="Phone 2">
                   
                    
                    
                        <input type="submit" value="Register">
                        <a href="/organ/source/home.php" class="text-sec text-decoration-none" style="color:white">Go Back to Home page</a>
            </form>
        </div>
    </body>
    </html>`1