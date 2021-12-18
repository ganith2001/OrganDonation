<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=misc', 'fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$success=false;
if(isset($_POST['blood'])  && isset($_POST['cars']) ){
    if( isset($_POST['organ1'] ) || isset($_POST['organ2'] ) || isset($_POST['organ3'] ) ){
$a=0;
while(1){
    if($_POST['cars']=="vol".$a){
    $sql="INSERT INTO donor (blood_group,user_id,organisation_id) VALUES (:blood,:userid,:orgid)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(':blood'=>$_POST['blood'],':userid'=> $_SESSION['user_id'],':orgid'=> $_SESSION["vol".$a]));
    
    $success="Record Inserted";
    
    break;
    }
    $a=$a+1;
}


$stmt=$pdo->query("SELECT MAX(donor_id) as max from donor");
   
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    

    $g=1; 
    $kid=0;
    $lun=0;
    $eye=0;

while($g<=3){
if(isset($_POST["organ".$g])){
    
    if($_POST["organ".$g]=="Kidney"){  
        $kid=1;
    }
    if($_POST["organ".$g]=="Lungs"){
        $lun=1;
    }
    if($_POST["organ".$g]=="Eyes"){
        $eye=1;
    }
     
    
       
   
}
$g=$g+1;
    
}
    $sql="INSERT INTO donor_organ (donor_id,Kidney,Lungs,Eyes) VALUES (:did,:kid,:lung,:eye)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(':did'=>$row['max'],':kid'=>$kid,':lung'=>$lun,':eye'=>$eye)); 
}
}
  if(isset($POST['sb'])){
    header("Location: home.php");
  }

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Donor</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
        <link href="./patientstyle.css" rel="stylesheet">
    </head>
    <body>
        <div class="contact-form">
            <img alt="" class="avatar" src="https://i.postimg.cc/qMNS9QmK/561ad2ebe0289ce57bee98ce0f845aed.jpg">
            <h2>Donor</h2>
            <?php
        if ( $success !== false ) {
          echo('<h1 style="color: red;">'.htmlentities($success)."</h1>\n");
        }
     ?>
            <form method="POST" >
       
     
                <p> Blood Group</p><select name="blood" id="bg"  placeholder="Bg">
                    <option style="color:grey" disabled selected > Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="O+">O+</option>
                
                    <option value="B+">B+</option>
                    <option value="AB+">AB+</option>
                    <option value="A-">A-</option>
                    <option value="O-">O-</option>
                    <option value="AB-">AB-</option>
                    <option value="B-">B-</option></select> </P>
                    
                    <p> Organ donating 1</p><select name="organ1" id="bg"  placeholder="Bg">
                        <option style="color:grey" disabled selected >Organ Donating 1</option>
                        <option value="Kidney">Kidney</option>
                        <option value="Lungs">Lungs</option>

                    
                        <option value="Eyes">Eyes</option></select> </p>
                    
                        <p> Organ Donating 2</p><select name="organ2" id="bg"  placeholder="Bg">
                            <option style="color:grey" disabled selected > Organ Donating 2</option>
                            <option value="Kidney">Kidney</option>
                            <option value="Lungs">Lungs</option>

                        
                            <option value="Eyes">Eyes</option></select> </p>
                            <p> Organ Donating 3</p><select name="organ3" id="bg"  placeholder="Bg">
                                <option style="color:grey" disabled selected > Organ Donating 3</option>
                                <option value="Kidney">Kidney</option>
                                <option value="Lungs">Lungs</option>
                                
                            
                                <option value="Eyes">Eyes</option></select>
    </P>
                                    <p> Hospital</p>
    <?php
    $stmt=$pdo->query("SELECT organisation_id,organisation_name,street,city,state from organisation ");
   
echo('<select name="cars" id="bg"  placeholder="Bg">');
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
                    <input type="submit" name="sb" value="Register">

            </form>
            <form action="home.php">
            <input type="submit" name="sb" value="Home">
            </form>
        </div>
    </body>
    </html>
