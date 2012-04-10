<?php session_start();                                                          
require 'encryption.php'; ?>                                                    
<script>                                                                        
  function redirectLogin() {                                                    
    document.location = "login.php";                                            
  }                                                                             
                                                                                
  function redirectHome() {                                                     
    document.location = "index.php";                                            
  }                                                                             
</script>                                                                       
<?php                                                                           
                                                                                
if($_SESSION['user_id'] == null) { ?>                                           
  <script>redirectLogin();</script><?php                                        
}else{                                                                          
  $user_id = $_SESSION['user_id'];                                              
}                                                                               
                                                                                
$db = mysql_pconnect("localhost","root","letusout");                            
mysql_select_db("supply_concepts", $db);                                        
                                                                                
if(strlen($_SESSION['username']) > 0) {                                         
  $username = $_SESSION['username'];                                            
  $user_id = $_SESSION['user_id'];                                              
                                                                                
  $query = "SELECT * FROM users WHERE username = '$username'                    
            AND user_id = $user_id ORDER BY user_id DESC LIMIT 1";              
  $results = mysql_query($query,$db);                                           
  $r = mysql_fetch_row($results);                                               
}                                                                               
                                                                                
?> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Supply Concepts</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="upperpan"><!--upper table start -->
<div id="header"><!--header start -->
<img src="images/logo12.gif" width="147" height="51" title="Supply Concepts" alt="Supply Concepts" />
<!--ul>
<li><a href="#" class="sol" title="solution">solution</a></li>
<li><a href="#" class="ser" title="services">services</a></li>
<li><a href="#" class="sup" title="supports">supports</a></li>
</ul-->
<h1>the best for your business</h1>
<ul class="navi">
	<li><a href="index.php" class="na">Home</a></li>
	<li><a href="customers.php" class="na">Customers</a></li>
	<li><a href="orders.php" class="na">Orders</a></li>
	<li><a href="products.php" class="na">Products</a></li>
	<li><a href="employees.php" class="na">Employees</a></li>
	<li><a href="reports.php" class="na">Reports</a></li>
	<li><a href="user_role.php" class="na">Administration</a></li>
	<li><a href="signout.php" class="na">Signout</a></li>
</ul>
</div><!--header end -->
<div id="who"><!--who we are start -->
<h2>who we are</h2>
<p><strong>Supply Concepts</strong> is a company which supplies office equipment and office stationary to a number of Central
London offices.</p><p /><p /><p /><p />

<?php                                 
$encounter_id =  $_GET['encounter_id'];            
$options = "SELECT e.encounter_id,customer_name  FROM encounter e 
            INNER JOIN customer c ON c.customer_id = e.customer_id 
            AND e.encounter_id = $encounter_id LIMIT 1";

$results = mysql_query($options,$db);                             
$n = mysql_num_rows($results);                                   
                                                                  
if($n > 0) {                                                     
 $rc = mysql_fetch_row($results);                               
}
?>
</div><!--who we are send -->
</div><!--upper table end -->
<div id="middle100"><!--middle start -->
<div id="middle"><!--middle -->
  <div id="left" style="width:667px;">
     <table width="99%" style="border-style:solid;border-width:1px;font-size:12px;">
      <caption style="font-size:20px;text-align:left;padding-left:10px;">
      <strong>Order #<?php echo $rc[0]; ?> created<br />
      <span style="font-size:13px;text-align:left;padding-left:0px;">Customer:&nbsp;
      <?php echo encrypt($rc[1]); ?>
      </span>
      </strong></caption>
      <tr style="background-color:lightgrey;color:#6B6854;" id="header-th">
        <th class="cd-details" style="text-align:left;padding-left:5px;width:140px;">Product name</th>
        <th class="cd-details" style="width:100px;text-align:right;padding-right:5px;">Unit price</td>         
        <th class="cd-details" style="width:80px;text-align:right;padding-right:5px;">Quantity</th>            
        <th class="cd-details" style="width:20px;text-align:right;padding-right:5px;">Total</th>           
      </tr>
      <?php                                                               
      $options = "SELECT i.name,o.quantity,o.price  FROM encounter e 
                  INNER JOIN orders o ON e.encounter_id = o.encounter_id 
                  AND e.encounter_id = $encounter_id
                  INNER JOIN customer c ON c.customer_id = e.customer_id
                  INNER JOIN item i ON i.item_id = o.item_id";   
      $results = mysql_query($options,$db);                             
      $nl = mysql_num_rows($results);                                   
                                                                        
      if($nl > 0) {                                                     
        for ($i = 1;$i <= $nl;$i++) {                                   
         $rc = mysql_fetch_row($results);                               
      ?>                                                                
       <td style="text-align:left;padding-left:5px;"><?php echo encrypt($rc[0]); ?></td>
       <td style="text-align:right;padding-right:5px;"><?php echo $rc[2]; ?></td>
       <td style="text-align:right;padding-right:5px;"><?php echo $rc[1]; ?></td>
       <td style="text-align:right;padding-right:5px;"><?php echo ($rc[2] * $rc[1]); ?></td>
      <?php                                                             
       }                                                                
     } ?>
    </table>
    <p>&nbsp;</p>
    <p style="font-size:20px;width:665px;">Welcome&nbsp;<strong><?php echo encrypt($r[2]).' '.encrypt($r[3]); ?></strong></p>
  </div>
</div>
</div>
</body>
</html>
