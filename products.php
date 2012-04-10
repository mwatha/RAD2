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



$db = mysql_pconnect("localhost","root","letusout");                            
mysql_select_db("supply_concepts", $db);                                        
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
$user_role = "SELECT role FROM user_role WHERE user_id = $user_id LIMIT 1";     
$results = mysql_query($user_role,$db);                                         
$r = mysql_fetch_row($results);                                                 
$n = mysql_num_rows($results);                                                  
                                                                                
if ($n > 0) {                                                                   
  if ($r[0] !="admin") { ?>                                                     
    <script>                                                                    
      document.write('You dont have permission to view this page.');            
      setTimeout("redirectHome();", 4000);                                      
    </script><?php                                                              
    exit;                                                                       
  }                                                                             
}else{ ?>                                                                       
    <script>                                                                    
      document.write('You dont have permission to view this page.');            
      setTimeout("redirectHome();", 4000);                                      
    </script><?php                                                              
    exit;                                                                       
} 


                                                                                
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
	<li><a href="#" class="na">Administration</a></li>
  <li><a href="signout.php" class="na">Signout</a></li>
</ul>
</div><!--header end -->
<div id="who"><!--who we are start -->
<h2>who we are</h2>
<p><strong>Supply Concepts</strong> is a company which supplies office equipment and office stationary to a number of Central
London offices.</p><p /><p /><p /><p />

</div><!--who we are send -->
</div><!--upper table end -->
<div id="middle100"><!--middle start -->
<div id="middle"><!--middle -->
  <div id="left" style="width:667px;">
    <p style="font-size:20px;"><strong>Products</strong></p>
    <!-- starts -->
       <table width="99%" style="border-style:solid;border-width:1px;font-size:12px;">
              <tr style="background-color:lightgrey;color:white;">                
                <th style="text-align:left;padding-left:5px;" class="cd-details">Product name</th>                       
                <th style="text-align:right;padding-right:5px;" class="cd-details">Available quantity</td>                              
                <th style="text-align:right;padding-right:5px;" class="cd-details">Unit price</th>                        
                <th class="cd-details">&nbsp;</th>                              
              </tr>                                                             
              <?php                                                             
                $query = "SELECT * FROM item";                              
                $results = mysql_query($query,$db);                             
                //$r = mysql_fetch_row($results);                                                 
                $n = mysql_num_rows($results);                                  
                if ($n > 0) {                                                   
                  for($i=0;$i < $n ; $i++) {                                    
                   $record = mysql_fetch_row($results);                         
              ?>                                                                
              <tr style="text-align:right;padding-right:5px;">                                                              
                <td style="text-align:left;padding-left:5px;"><?php echo encrypt($record[1]); ?></td>                     
                <td><?php echo $record[2]; ?></td>                     
                <td><?php echo $record[3]; ?></td>                     
                <td style="text-align:center;"><a href="#">Edit</a></td>
              </tr>                                                             
              <?php                                                             
               }                                                                
              }?>                                                               
              <tr style="background-color:lightgrey;">                            
                <td colspan="3">&nbsp;</td>                                     
                <td style="text-align:center;"><button onclick="javascript:location='itemsdetails';">Add new</button></td>                              
              </tr>                                                             
            </table> 
    <!-- ends -->
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p style="font-size:20px;width:665px;">Welcome&nbsp;<strong><?php echo encrypt($r[2]).' '.encrypt($r[3]); ?></strong></p>
  </div>
</div>
</div>
</body>
</html>
