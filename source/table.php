
<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=misc', 'fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt=$pdo->prepare("SELECT donor.donor_id,name1,dob,street,city,state1,phone_no,blood_group,Kidney,Lungs,Eyes from user_ph inner join user2 on user2.user_id=user_ph.user_id inner join donor on user2.user_id=donor.user_id inner join donor_organ on donor.donor_id=donor_organ.donor_id  where signup_id=:xyz;");
$stmt->execute(array(":xyz"=>$_SESSION['id']));
$i=0;
$idd=array();
$name=array();
$ph=array();


while($row=$stmt->fetch(PDO::FETCH_ASSOC)){


    array_push( $idd,$row['donor_id']);
    array_push( $ph,$row['phone_no']); 
  

  
}
$final_id = array_unique($idd);
$final_ph = array_unique($ph);

//------------------------//
$stmt2=$pdo->prepare("SELECT patient.patient_id,name1,dob,street,city,state1,phone_no,blood_group,Kidney,Lungs,Eyes from user_ph inner join user2 on user2.user_id=user_ph.user_id inner join patient on user2.user_id=patient.user_id inner join patient_organ on patient.patient_id=patient_organ.patient_id  where signup_id=:xyz;");
$stmt2->execute(array(":xyz"=>$_SESSION['id']));
$i=0;
$idp=array();

$php=array();


while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){


    array_push( $idp,$row2['patient_id']);
    array_push( $php,$row2['phone_no']); 
  

  
}
$final_idp = array_unique($idp);
$final_php = array_unique($php);



?>
<html>
    <head>
        <title>DBMSTable</title>

        <style>
            body{
                background:skyblue;
            }
            table{
                width:100%;
                margin:auto;
                text-align:center;
                table-layout: fixed;
            }

            table,tr,th,td{
                padding: 20px;
                color: white;
                border: 1px solid #080808;
                border-collapse: collapse;
                font-size: 18px;
                font-family: Arial;
                background:linear-gradient(top,#3c3c3c 0%,#222222 100%);
                background: -webkit-linear-gradient(top,#3c3c3c 0%,#222222 100%);
            }
            td:hover{
                background: purple;
            }
        </style>    
    
    </head>

    <body>
        <center><h1>Donor details </h1></center>

        
        <table>
        
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>DOB</th>
                <th>Address</th>
                <th>ph no-1</th>
                <th>ph no-2</th>
                <th>Blood group</th>
                <th>organ 1</th>
                <th>organ 2</th>
                <th>organ 3</th>
            </tr>
     <?php   
     $j=0;
     $z=0;
    foreach($final_id as $val){
$stmt=$pdo->prepare("SELECT distinct donor.donor_id,name1,dob,street,city,state1,blood_group,Kidney,Lungs,Eyes from user_ph inner join user2 on user2.user_id=user_ph.user_id inner join donor on user2.user_id=donor.user_id inner join donor_organ on donor.donor_id=donor_organ.donor_id  where signup_id=:xyz and donor.donor_id=:lol;");
$stmt->execute(array(":xyz"=>$_SESSION['id'],":lol"=>$val));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if($row['Kidney']==1){
    $k="Kidney";
    
}
else
{
    $k=" - ";
}
if($row['Lungs']==1){
    $l="Lungs";
}
else{
    $l=" - ";
}

if($row['Eyes']==1){
    $e="Eyes";
}
else{
    $e=" - ";
}
echo "<tr><td>";
echo(htmlentities($j+1));
echo"</td><td>";
echo(htmlentities($row['name1']));
echo"</td><td>";
echo(htmlentities($row['dob']));
echo"</td><td>";
echo(htmlentities($row['state1']));                     
echo"</td><td>";
echo(htmlentities($final_ph[$z]));
echo"</td><td>";
echo(htmlentities($final_ph[$z+1]));
echo"</td><td>";
echo(htmlentities($row['blood_group']));
echo"</td><td>";
echo(htmlentities($k));
echo"</td><td>";
echo(htmlentities($l));
echo"</td><td>";
echo(htmlentities($e));   
echo"</td></tr>";
        $j=$j+1; 
        $z=$z+2;
    }
        ?>           
        </table>
        

        <center><h1>Patient details </h1></center>

        
        <table>
        
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>DOB</th>
                <th>Address</th>
                <th>ph no-1</th>
                <th>ph no-2</th>
                <th>Blood group</th>
                <th>organ 1</th>
                <th>organ 2</th>
                <th>organ 3</th>
            </tr>
            <?php   
     $j=0;
     $z=0;
    foreach($final_idp as $val){
$stmt=$pdo->prepare("SELECT distinct patient.patient_id,name1,dob,street,city,state1,blood_group,Kidney,Lungs,Eyes from user_ph inner join user2 on user2.user_id=user_ph.user_id inner join patient on user2.user_id=patient.user_id inner join patient_organ on patient.patient_id=patient_organ.patient_id  where signup_id=:xyz and patient.patient_id=:ld;");
$stmt->execute(array(":xyz"=>$_SESSION['id'],":ld"=>$val));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if($row['Kidney']==1){
    $k="Kidney";
    
}
else
{
    $k=" - ";
}
if($row['Lungs']==1){
    $l="Lungs";
}
else{
    $l=" - ";
}

if($row['Eyes']==1){
    $e="Eyes";
}
else{
    $e=" - ";
}
echo "<tr><td>";
echo(htmlentities($j+1));
echo"</td><td>";
echo(htmlentities($row['name1']));
echo"</td><td>";
echo(htmlentities($row['dob']));
echo"</td><td>";
echo(htmlentities($row['state1']));                     
echo"</td><td>";
echo(htmlentities($final_php[$z]));
echo"</td><td>";
echo(htmlentities($final_php[$z+1]));
echo"</td><td>";
echo(htmlentities($row['blood_group']));
echo"</td><td>";
echo(htmlentities($k));
echo"</td><td>";
echo(htmlentities($l));
echo"</td><td>";
echo(htmlentities($e));   
echo"</td></tr>";
        $j=$j+1; 
        $z=$z+2;
    }
        ?>           
        </table>
        
    </body>
</html>