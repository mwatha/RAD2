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
  $rc = mysql_fetch_row($results);                                               
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
  <div id="left" style="width:745px;">
    <!-- starts -->
    <p>&nbsp;</p>
    <p style="font-size:20px;width:665px;"><strong>Assign user privelege</strong></p>
    <form method="post" action="runreport.php">
    <table style="width:345px;">
      <tr>
        <td>User</td>
        <td>
          <select id="user_name" name="username">
           <?php                                                               
              $query = "SELECT username FROM users;";            
              $results = mysql_query($query,$db);                           
              $n = mysql_num_rows($results);                                    
                                                                                
              if($n > 0) { ?>                                                   
                <option value=""></option>                                      
              <?php for($i = 0; $i < $n; $i++) {                                
                $r = mysql_fetch_row($results);                                 
             ?>                                                                 
                <option value="<?php echo $r[0]; ?>"><?php echo encrypt($r[0]); ?></option>
              <?php                                                             
                }                                                               
              }                                                                 
             ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>User privelege</td>
        <td>
          <select name="userrole">                                    
            <option value=""></option>                                        
            <option value="sales">Sales</option>                              
            <option value="admin">Administrator</option>                      
          </select> 
        </td>
      </tr>
      <tr>                                                                  
        <td>&nbsp;</td>                                                     
        <td style="text-align:left;">                                       
          <input type="button" onclick="javascript:document:location='index';" value="Cancel" />
          <input type="submit" value="Assign" />                              
        </td>                                                               
      </tr>
    </table></form>
    <!-- endss -->
    <p>&nbsp;</p>
    <p style="font-size:20px;width:665px;">Welcome&nbsp;<strong><?php echo encrypt($rc[2]).' '.encrypt($rc[3]); ?></strong></p>
  </div>
</div>
</div>
</body>
</html>
