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
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Supply Concepts</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<script>
function logLocation() {
  var l = document.getElementById("location");
  if (l.value == "")
    return

  document.location="index?location=" + l.value;
}
</script>


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
  <li><a href="#" class="na">Home</a></li>                                      
  <li><a href="#" class="na">Customers</a></li>                                    
  <li><a href="#" class="na">Orders</a></li>                                    
  <li><a href="#" class="na">Products</a></li>                                  
  <li><a href="#" class="na">Employees</a></li>                                 
  <li><a href="#" class="na">Reports</a></li>                                   
  <li><a href="#" class="na">Administration</a></li>                            
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
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <strong>Select user location</strong>&nbsp;<select id="location" onchange="logLocation();">
    <option></option>
    <option value="Teller 1">Teller One</option>
    <option value="Teller 2">Teller Two</option>
    <option value="Teller 3">Teller Three</option>
    <option value="Teller 4">Teller Four</option>
    <option value="Teller 5">Teller Five</option>
  </select>
</div>
</div>
</body>
</html>
