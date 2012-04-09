<?php session_start(); 

require 'encryption.php'; 

$db = mysql_pconnect("localhost","root","letusout");                        
mysql_select_db("supply_concepts", $db);      
                                                                                
$username = encrypt($_POST["username"]);                                                       
$password = md5($_POST["password"]);                                                       

$user = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";      
$results = mysql_query($user,$db);                                 
$n = mysql_num_rows($results);                                         
$r = mysql_fetch_row($results);
?>                                                                                 
<script>
<?php
if($n > 0) { 
  $_SESSION['username'] = $username;
  $_SESSION['user_id'] = $r[0];  
?>
  window.location="index.php";
<?php
}else{ ?>
  document.write("Wrong username or password");
  setTimeout("redirect();",4000);
  function redirect() { history.go(-1); }
<?php
} ?>
</script>
