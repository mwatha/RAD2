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
  <div id="left">
    <p>&nbsp;</p>
      <!-- start -->
       <form action="createproduct.php" method="post">                              
        <table>                                                                 
          <caption style="text-align:left;font-size:30px;">New product</caption>
          <tr>                                                                  
            <td>Item name</td>                                                  
            <td><input type="text" name="name" /></td>                          
          </tr>                                                                 
          <tr>                                                                  
            <td>Unit price</td>                                                 
            <td><input type="text" name="price" /></td>                         
          </tr>                                                                 
          <tr>                                                                  
            <td>Quantity</td>                                                   
            <td><input type="text" name="quantity" /></td>                      
          </tr>                                                                 
          <tr>                                                                  
            <td>&nbsp;</td>                                                     
            <td style="text-align:left;">                                       
              <input type="button" onclick="javascript:document:location='customer.php';" value="Cancel" />
              <input type="submit" value="Save" />                              
            </td>                                                               
          </tr>                                                                 
        </table>                                                                
      </form>
      <!-- end -->
  </div>
</div>
</div>
</body>
</html>
