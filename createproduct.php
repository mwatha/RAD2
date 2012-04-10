<?php session_start(); 
require 'encryption.php';
?>

<script>

  function successfullCreated() {
    location.href = "products";
  }
  
  function redirect() {
    history.go(-1);
  }
</script>

<?php

$db = mysql_pconnect("localhost","root","letusout");                        
mysql_select_db("supply_concepts", $db);      
 
$name = encrypt($_POST["name"]);                                                       
$price = $_POST["price"];                                                   
$quantity = $_POST["quantity"];                                                   

$query = "INSERT INTO item VALUES(NULL,'$name',$quantity,$price);";                                     
mysql_query($query,$db); 

?>

<script>
  successfullCreated();
</script>
