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
  $rc = mysql_fetch_row($results);      
}                                                                               
                                                                                
?> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Supply Concepts</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<style>
.report-data th , .report-data td {
  text-align: left;
  padding-left: 5px;
}

.report-data th {
  border-style: solid;
  border-width: 0px 0px 1px 0px;
  
}
</style>

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
  <div id="left" style="width:745px;">
    <p>&nbsp;</p>
    <!-- starts -->
    <?php
      $start_date = $_POST['startdate'].' 00:00:00';
      $end_date = $_POST['enddate'].' 23:59:59';
      $username = $_POST['username'];
      $customer = $_POST['customer_name'];
      $location = $_POST['location_name'];
    
      if($location and $customer and $username) {
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE e.location = '$location' AND c.customer_name = '$customer'
              AND u.username = '$username'";
      }elseif($location and $customer) {
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE e.location = '$location' AND c.customer_name = '$customer'";
      }elseif($customer and $username) {
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE c.customer_name = '$customer' AND u.username = '$username'";
      }elseif($location and $username) {
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE e.location = '$location' AND u.username = '$username'";
      }elseif($location) {
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE e.location = '$location'";
      }elseif($username) {
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE u.username = '$username'";
      }elseif($customer) {
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE c.customer_name = '$customer'";
      }else{
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id";
      }
      $results = mysql_query($query,$db);                               
      $n = mysql_num_rows($results);                                    
        
      ?>
      <table style="width:100%;font-size:10px;" class = 'report-data' >
        <tr>
          <th>Customer name</th>                                                                  
          <th>Product</th>                                                                  
          <th style="text-align:right;padding-right:5px;">Quantity</th>                                                                  
          <th style="text-align:right;padding-right:5px;">Unit price</th>                                                                  
          <th>User</th>                                                                  
          <th>Location</th>                                                                  
          <th>Order date</th>                                                                  
        </tr>                                                                  
      <?php 
      if($n > 0) { 
        for($i = 0; $i < $n; $i++) {                                
          $r = mysql_fetch_row($results); ?>
        <tr>
          <td><?php echo encrypt($r[0]); ?></td> 
          <td><?php echo encrypt($r[1]); ?></td> 
          <td style="text-align:right;padding-right:5px;"><?php echo $r[2]; ?></td> 
          <td style="text-align:right;padding-right:5px;"><?php echo $r[3]; ?></td> 
          <td><?php echo encrypt($r[5]).' '.encrypt($r[6]); ?></td> 
          <td><?php echo encrypt($r[4]); ?></td> 
          <td><?php echo $r[7]; ?></td> 
        </tr>                                                                 
   <?php }
      } 
    ?>
    </table>
    <!-- endss -->
    <p>&nbsp;</p>
    <p style="font-size:20px;width:665px;">Welcome&nbsp;<strong><?php echo encrypt($rc[2]).' '.encrypt($rc[3]); ?></strong></p>
  </div>
</div>
</div>
</body>
</html>
