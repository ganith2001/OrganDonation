<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=misc', 'fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$success=false;
if(isset($_POST['blood'])  && isset($_POST['reason']) ){
    if( isset($_POST['cars1'] ) || isset($_POST['cars2'] ) ){
        if($_POST['cars1']=="kidney"){
            $cost=10000;
        }
        else if($_POST['cars1']=="lungs")
    {
        $cost=30000;
    }
    else if($_POST['cars1']=="eyes")
    {
        $cost=40000;
    }

    if($_POST['cars2']=="kidney"){
        $cost=10000;
    }
    else if($_POST['cars2']=="lungs")
{
    $cost=30000;
}
else if($_POST['cars2']=="eyes")
{
    $cost=40000;
}

$sql="INSERT INTO patient (blood_group,reason,cost,user_id) VALUES (:blood,:reason,:cost,:userid)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(':blood'=>$_POST['blood'],':reason'=>$_POST['reason'],':cost'=>$cost,':userid'=> $_SESSION['user_id']));
    
    $success="Record Inserted";



$stmt=$pdo->query("SELECT MAX(patient_id) as max from patient");
   
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    


    $g=1; 
    $kid=0;
    $lun=0;
    $eye=0;

while($g<=2){
if(isset($_POST["cars".$g])){
    
    if($_POST["cars".$g]=="Kidney"){  
        $kid=1;
    }
    if($_POST["cars".$g]=="Lungs"){
        $lun=1;
    }
    if($_POST["cars".$g]=="Eyes"){
        $eye=1;
    }
     
    
      
    
   
}
$g=$g+1; 
}
    $sql="INSERT INTO patient_organ (patient_id,Kidney,Lungs,Eyes) VALUES (:did,:kid,:lung,:eye)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(':did'=>$row['max'],':kid'=>$kid,':lung'=>$lun,':eye'=>$eye)); 
}
}
  

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Patient</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
        <link href="./patientstyle.css" rel="stylesheet">
    </head>
    <body>
        <div class="contact-form">
            <img alt="" class="avatar" src="https://i.postimg.cc/Ss9VgzZB/patient-icon-medical-health-care-260nw-554075098.png">
            <h2>PATIENT</h2>
            <?php
        if ( $success !== false ) {
          echo('<h1 style="color: red;">'.htmlentities($success)."</h1>\n");
        }
     ?>
            <form method="POST">
                <p> Blood Group</p><select name="blood" id="bg"  placeholder="Bg">
                    <option style="color:grey" disabled selected > Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="O+">O+</option>
                
                    <option value="B+">B+</option>
                    <option value="AB+">AB+</option>
                    <option value="A-">A-</option>
                    <option value="O-">O-</option>
                    <option value="AB-">AB-</option>
                    <option value="B-">B-</option></select>
                    
                    <p> Organ procuring 1</p><select name="cars1" id="bg"  placeholder="Bg">
                        <option style="color:grey" disabled selected >Organ procuring 1</option>
                        <option value="Kidney">Kidney</option>
                        <option value="Lungs">Lungs</option>

                    
                        <option value="Eyes">Eyes</option></select>
                   
                        <p> Organ procuring 2</p><select name="cars2" id="bg"  placeholder="Bg">
                            <option style="color:grey" disabled selected > Organ procuring 2</option>
                            <option value="Kidney">Kidney</option>
                            <option value="Lungs">Lungs</option>

                        
                            <option value="Eyes">Eyes</option></select>

                            <P>Reason</P><input  name="reason" placeholder="Reason" type="text">
                    <input type="submit" value="Register">

            </form>
            <form action="home.php">
            <input type="submit" name="sb" value="Home">
            </form>
        </div>
    </body>
    </html>
