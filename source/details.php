<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=misc', 'fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if($POST['state']=="Kidney"){
    $kid=1;
    $lun=0;
    $eye=0;
}
else if($POST['state']=="Lungs"){
    $kid=0;
    $lun=1;
    $eye=0;
}
else if($POST['state']=="Eyes"){
    $kid=0;
    $lun=0;
    $eye=1;
}
$stmt=$pdo->query("SELECT distinct donor.donor_id,name1,blood_group,organisation_name,organisation.street,organisation.city,organisation.state,user_ph.phone_no FROM user2 INNER JOIN donor_organ INNER JOIN donor INNER join user_ph ON user2.user_id=user_ph.user_id and donor_organ.donor_id = donor.donor_id and user2.user_id=donor.user_id INNER JOIN organisation on donor.organisation_id=organisation.organisation_id INNER JOIN organisation_ph on organisation_ph.organisation_id=organisation.organisation_id;");

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
        <center><h1>Details </h1></center>
      
        <table>
        
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Blood group</th>
                <th>organisation name</th>\    
                <th>Street</th>
                <th>City</th>
                <th>State</th>
                <th>Organ 1</th>
                <th>Organ 2</th>
                <th>Organ 3</th>
                <th>ph no-1</th>
                <th>ph no-2</th>
            </tr>
     <?php   
     $j=0;
     $z=0;
    foreach($final_id as $val){
$stmt=$pdo->prepare("SELECT distinct donor.donor_id,name1,blood_group,organisation_name,organisation.street,organisation.city,organisation.state,donor_organ.Kidney,donor_organ.Lungs,donor_organ.Eyes FROM user2 INNER JOIN donor_organ INNER JOIN donor INNER join user_ph ON user2.user_id=user_ph.user_id and donor_organ.donor_id = donor.donor_id and user2.user_id=donor.user_id INNER JOIN organisation on donor.organisation_id=organisation.organisation_id INNER JOIN organisation_ph on organisation_ph.organisation_id=organisation.organisation_id where donor.donor_id=:lol;");
$stmt->execute(array(":lol"=>$val));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if(($row['Kidney']==1)){
    $k="Kidney";
}
else{
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
echo(htmlentities($row['blood_group']));
echo"</td><td>";
echo(htmlentities($row['organisation_name']));                     
echo"</td><td>";
echo(htmlentities($row['street']));
echo"</td><td>";
echo(htmlentities($row['city']));
echo"</td><td>";
echo(htmlentities($row['state']));
echo"</td><td>";
echo(htmlentities($k));
echo"</td><td>";
echo(htmlentities($l));
echo"</td><td>";
echo(htmlentities($e));
echo"</td><td>";
echo(htmlentities($final_ph[$z]));
echo"</td><td>";
echo(htmlentities($final_ph[$z+1]));  
echo"</td></tr>";

        $j=$j+1; 
        $z=$z+2;
    }
        ?>           
        </table>
        

      
        
    </body>
</html>