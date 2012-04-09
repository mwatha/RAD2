<?php session_start(); 
require 'encryption.php';
?>

<script>

  function successfullLogin() {
    location.href = "index.php";
  }
  
  function redirect() {
    history.go(-1);
  }
</script>

<?php

$db = mysql_pconnect("localhost","root","letusout");                        
mysql_select_db("supply_concepts", $db);      
 
$fname = encrypt($_POST["fname"]);                                                       
$lname = encrypt($_POST["lname"]);                                                       
$dob = $_POST["birthdate"]; 
$job = encrypt($_POST["job"]);
$sex = $_POST["gender"]; 
$username = encrypt($_POST["username"]);                                                   
$email = encrypt($_POST["email"]);                                                   
$password = md5($_POST["password"]);                                                   

$hour =  date("G") - 1;                                                         
if ($hour < 9) {                                                                
  $hour = "0".$hour;                                                            
}                                                                               
                                                                                
$time =  $hour.date(":i:s");                                                    
$datetime = date("Y-m-d ").$time;

$query = "INSERT INTO users VALUES(NULL,'$username','$fname','$lname','$sex',
         '$dob','$email','$password','$job','$datetime');";                                     
mysql_query($query,$db); 


$query = "SELECT user_id FROM users WHERE username = '$username'
          ORDER BY user_id DESC LIMIT 1";
$results = mysql_query($query,$db); 
$r = mysql_fetch_row($results);
                                                                                
$_SESSION['username'] = $username;                                            
$_SESSION['user_id'] = $r[0]; 

?>

<script>
  successfullLogin();
</script>
