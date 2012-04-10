<?php

$db = mysql_pconnect("localhost","root","letusout");                        
mysql_select_db("supply_concepts", $db);      
 
$user_id = $_POST["user_id"];                                                   
$select_user_role = $_POST["userrole"];                                                   
 
$query = "UPDATE user_role SET role = '$select_user_role' WHERE user_id = $user_id;";                                     
mysql_query($query,$db); 

?>
<script>
  location.href = "index";
</script>
