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

</div><!--who we are send -->
</div><!--upper table end -->
<div id="middle100"><!--middle start -->
<div id="middle"><!--middle -->
  <div id="left">
    <p>&nbsp;</p>
      <!-- start -->
        <form action="createcustomer.php" method="post">                          
        <table>                                                                 
          <caption style="text-align:left;font-size:30px;">New customer</caption>
          <tr>                                                                  
            <td>Customer name</td>                                              
            <td><input type="text" name="name" /></td>                          
          </tr>                                                                 
          <tr>                                                                  
            <td>E-mail</td>                                                     
            <td><input type="text" name="email" /></td>                         
          </tr>                                                                 
          <tr>                                                                  
            <td>Phone number</td>                                               
            <td><input type="text" name="phone_number" /></td>                  
          </tr>                                                                 
          <tr>                                                                  
            <td>Address</td>                                                    
            <td><textarea name="address" rows="5" cols="30"></textarea></td>    
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
