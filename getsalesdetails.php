<?php
require 'encryption.php'; 

$customer_id = $_GET["customer_id"];

$db = mysql_pconnect("localhost","root","letusout");                            
mysql_select_db("supply_concepts", $db);


$query = "SELECT * FROM customer WHERE customer_id = $customer_id";
$results = mysql_query($query,$db);
$n = mysql_num_rows($results);     

$customer = "";
                             
if ($n > 0) {                                                   
  $r = mysql_fetch_row($results);
  $customer = $r[0].';'.encrypt($r[1]).';'.encrypt($r[2]);
}

echo $customer;
exit;

?>

