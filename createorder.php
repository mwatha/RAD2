<?php session_start();
require 'encryption.php';

$db = mysql_pconnect("localhost","root","letusout");                            
mysql_select_db("supply_concepts", $db);

$hour =  date("G") - 1;                                                         
if ($hour < 9) {                                                                
  $hour = "0".$hour;                                                            
}                                                                               
$time =  $hour.date(":i:s");                                                    
$datetime = date("Y-m-d ").$time;

$str = $_POST["orders"];
$orders = explode(",", $str); 

for($i=0;$i<count($orders);$i++){
  $order = explode(";", $orders[$i]); 
  $customer = encrypt($order[3]);
}

$creator = $_SESSION['user_id'];

$query = "SELECT customer_id FROM customer WHERE customer_name = '$customer' LIMIT 1";                   
$results = mysql_query($query,$db);                                         
$n = mysql_num_rows($results);

if($n > 0){
  $r = mysql_fetch_row($results);
  $customer_id = $r[0];
  $location = encrypt($_SESSION['location']);
  
  $query = "INSERT INTO encounter VALUES(NULL,$creator,$customer_id,'$location','$datetime')";
  mysql_query($query,$db);

  $query = "SELECT encounter_id FROM encounter WHERE user_id = $creator 
  AND customer_id = $customer_id AND date_created = '$datetime' LIMIT 1";                   
  $results = mysql_query($query,$db);                                         
  $n = mysql_num_rows($results);

  if($n > 0){
    $r = mysql_fetch_row($results);
    $encounter_id = $r[0];
  }  
}

for($i=0;$i<count($orders);$i++){
  $order = explode(";", $orders[$i]); 
  $item = encrypt($order[0]);
  $quantity = $order[1];
  $price = $order[2];

  $query = "SELECT item_id FROM item WHERE name = '$item' LIMIT 1";                   
  $results = mysql_query($query,$db);                                         
  $n = mysql_num_rows($results);

  if($n > 0){
    $r = mysql_fetch_row($results);
    $item_id = $r[0];
  }

  $query = "INSERT INTO orders VALUES(NULL,$encounter_id,$item_id,$quantity,$price,$creator,'$datetime')";
  mysql_query($query,$db);
} 
?>

<script>
  document.location = "created_order?encounter_id=<?php echo $encounter_id ?>";
</script>
