<?php
require 'encryption.php'; 

$name = encrypt($_GET["name"]);

$db = mysql_pconnect("localhost","root","letusout");                            
mysql_select_db("supply_concepts", $db);


$query = "SELECT * FROM item WHERE name LIKE '%$name%'";
$results = mysql_query($query,$db);
$n = mysql_num_rows($results);     


$items = "";
                             
if ($n > 0) { 
  for($i=0;$i < $n;$i++) {                                                  
    $r = mysql_fetch_row($results);
    if($items == "") {
      $items = $items.$r[0].';'.encrypt($r[1]).';'.$r[3];
    }else{
      $items = $items.','.$r[0].';'.encrypt($r[1]).';'.$r[3];
    }
  }
}

echo $items;
exit;

?>

