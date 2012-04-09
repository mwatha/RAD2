<?php session_start(); 
require 'encryption.php';
?>

<script>

  function successfullCreated() {
    location.href = "customers";
  }
  
  function redirect() {
    history.go(-1);
  }
</script>

<?php

$db = mysql_pconnect("localhost","root","letusout");                        
mysql_select_db("supply_concepts", $db);      
 
$name = encrypt($_POST["name"]);                                                       
$phone_number = encrypt($_POST["phone_number"]);
$address = encrypt($_POST["address"]);                                                   
$email = encrypt($_POST["email"]);                                                   

$hour =  date("G") - 1;                                                         
if ($hour < 9) {                                                                
  $hour = "0".$hour;                                                            
}                                                                               
                                                                                
$time =  $hour.date(":i:s");                                                    
$datetime = date("Y-m-d ").$time;

$query = "INSERT INTO customer VALUES(NULL,'$name','$email','$phone_number','$address','$datetime');";                                     
mysql_query($query,$db); 

?>

<script>
  successfullCreated();
</script>
