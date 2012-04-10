<?php session_start();                                                          
require 'encryption.php'; ?>                                                    


<script type="text/javascript">

var item_name = {};
var item_price = {};
var selected_customer_email = null;
var selected_customer_name = null;

  function select() {
    var customer_id = document.getElementById("search_string").value;
    var salesDetails = document.getElementById("sales_details");
    var searchItem = document.getElementById("search_item");
    total =  document.getElementById('total_amount');
    total.innerHTML = "<td colspan='7'>&nbsp;</td>";

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        var results = xmlhttp.responseText;
        var html = "<tr>";

        selected_customer_email = results.split(';')[2];
        selected_customer_name = results.split(';')[1];
        if(selected_customer_name == '' || selected_customer_name == null){
          return;
        }
        html += "<td class='cname' style='text-align:left;padding-left:5px;'>" + selected_customer_name + "</td>";
        html += "<td style='text-align:center;'>" + selected_customer_email + "</td>";
        html += "<td style='text-align:center;' class='blank_item'>&nbsp;</td>";
        html += "<td style='text-align:center;' class='blank_price'>&nbsp;</td>";
        html += "<td style='text-align:center;' class='blank_quantity'>&nbsp;</td>";
        html += "<td style='text-align:center;' class='blank_total'>&nbsp;</td>";
        
        salesDetails.innerHTML = html;

        html = "<table style='width:100%;'><tr><td colspan='6' style='text-align:right;padding-right:10px;'>";
        html += "Search Item&nbsp;";
        html +="<input type='text' id='search_item_id' name='search_item' onkeyup='searchItem();' />";
        html += "&nbsp;<button onclick='addItem();'>Add Item</button></td></tr></table>";
        searchItem.innerHTML = html;
      }
    }

    xmlhttp.open("GET","getsalesdetails.php?customer_id="+customer_id,true);
    xmlhttp.send();
  }

  function searchItem() {
    var itemList = document.getElementById("item_list_results");
    var searchItem = document.getElementById("search_item_id").value;

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        var results = xmlhttp.responseText.split(",");
        var html = "<table style='width:100%;'>";
        item_name = {};
        item_price = {};
        for(var i = 0; i < results.length;i++){
          var item_id = results[i].split(';')[0];
          var name = results[i].split(';')[1];
          var price = results[i].split(';')[2];
        
          if(price == '' || price == null){
            return;
          }

          html += "<tr>";
          html += "<td style='text-align:left;padding-left:10px;'>" + name + "</td>";
          html += "<td style='text-align:left;padding-left:10px;'><strong>Unit price</strong>&nbsp;$" + price + "</td>";
          html += "<td style='text-align:center;'><button onclick='selectItem(" + item_id + ")'>Add</button></td>";
          html += "</tr>";
          item_name[item_id] = name;
          item_price[item_id] = price;
        }
        html+="</table>"
        itemList.innerHTML = html;
      }
    }

    xmlhttp.open("GET","getitems.php?name="+searchItem,true);
    xmlhttp.send();

  }

  function selectItem(item_id) {
    document.getElementById("item_list_results").innerHTML = null;
    itemPriceTD = document.getElementsByClassName('blank_price');
    itemNameTD = document.getElementsByClassName('blank_item');
    itemQuantityTD = document.getElementsByClassName('blank_quantity');
    itemTotalTD = document.getElementsByClassName('blank_total');
    quantityValues = document.getElementsByClassName('quantity_values');

    /* starts */
    var addNewRow = false;
    for(var i = 0; i < itemNameTD.length; i++){
      if(itemNameTD[i].innerHTML != "&nbsp;"){
        addNewRow = true;
        break;
      }
    }
   
    if(addNewRow){
      document.getElementById("header-th").style.display = "none";

      newTable =  "<td colspan='6'><table id='sales_details_table' width='106%' style='font-size:12px;'>";
      newTable +="<tr style='background-color:lightgrey;color:#6B6854;'>";
      newTable +="<th class='cd-details' style='text-align:left;padding-left:5px;width:140px;'>Customer name</th>";
      newTable +="<th class='cd-details' style='width:100px;'>E-mail</td>"
      newTable +="<th class='cd-details' style='width:80px;'>Item</th>";           
      newTable +="<th class='cd-details' style='width:20px;'>Price</th>";           
      newTable +="<th class='cd-details' style='width:10px;'>Quantity</th>";        
      newTable +="<th class='cd-details' style='width:20px;'>Total</th>";           
      newTable +="</tr>";
    

      for(var i = 0; i < itemNameTD.length; i++){
        newTable += "<tr><td class='cname' style='text-align:left;padding-left:5px;width:140px;font-size:12px;'>" + selected_customer_name + "</td>";
        newTable += "<td style='text-align:center;width:100px;font-size:12px;'>" + selected_customer_email + "</td>";
        newTable += "<td style='text-align:center;width:80px;font-size:12px;' class='blank_item'>" + itemNameTD[i].innerHTML + "</td>";
        for(var x = 0; x < itemPriceTD.length; x++){
          newTable += "<td style='text-align:center;width:20px;font-size:12px;' class='blank_price'>" + itemPriceTD[i].innerHTML + "</td>";
          break;
        }
        for(var x = 0; x < itemQuantityTD.length; x++){
          name = quantityValues[i].name;
          id = quantityValues[i].id;
          value = quantityValues[i].value;
          selected_item_id = quantityValues[i].id.split("quantity")[0];
          sQty = "<input type='text' class='quantity_values' name='" + name + "' id='" + id + "' size=2 onkeyup='calcualateQ(" + selected_item_id + ");' value='" + value +"' />";
          newTable += "<td style='text-align:center;width:10px;font-size:12px;' class='blank_quantity'>" + sQty + "</td>";
          break;
        }
        for(var x = 0; x < itemTotalTD.length; x++){
          newTable += "<td style='text-align:center;width:20px;font-size:12px;' class='blank_total'>" + itemTotalTD[i].innerHTML + "</td></tr>";
          break;
        }
      }
      
      var newRow = document.getElementById("sales_details");
      newTable += "<tr><td class='cname' style='text-align:left;padding-left:5px;width:140px;font-size:12px;'>" + selected_customer_name + "</td>";
      newTable += "<td style='text-align:center;width:100px;font-size:12px;'>" + selected_customer_email + "</td>";
      newTable += "<td style='text-align:center;width:80px;font-size:12px;' class='blank_item'>&nbsp;</td>";
      newTable += "<td style='text-align:center;width:20px;font-size:12px;' class='blank_price'>&nbsp;</td>";
      newTable += "<td style='text-align:center;width:10px;font-size:12px;' class='blank_quantity'>&nbsp;</td>";
      newTable += "<td style='text-align:center;width:20px;font-size:12px;' class='blank_total'>&nbsp;</td></tr></table></td>";
      newRow.innerHTML = newTable;
      itemPriceTD = document.getElementsByClassName('blank_price');
      itemNameTD = document.getElementsByClassName('blank_item');
      itemQuantityTD = document.getElementsByClassName('blank_quantity');
    }

    /* ends */
 
    for(var i = 0; i < itemNameTD.length; i++){
      if(itemNameTD[i].innerHTML == "&nbsp;"){
        itemNameTD[i].innerHTML = item_name[item_id];
      }
    }
    
    for(var i = 0; i < itemPriceTD.length; i++){
      if(itemPriceTD[i].innerHTML == "&nbsp;"){
        itemPriceTD[i].innerHTML = item_price[item_id];
      }
    }
    
    
    for(var i = 0; i < itemQuantityTD.length; i++){
      if(itemQuantityTD[i].innerHTML == "&nbsp;"){
        itemQuantityTD[i].innerHTML = "<input type='text' class='quantity_values' name='quantity"+ item_id + "' id='quantity" + item_id + "' size=2 onkeyup='calcualateQ(" + item_id + ");' value='' />";
      }
    }

    for(var i = 0; i < itemTotalTD.length; i++){
      if(itemTotalTD[i].innerHTML == "&nbsp;"){
        itemTotalTD[i].innerHTML = "<label class='item_total' id='label_" + item_id + "'></label>";
      }
    }

/*
        html += "<td style='text-align:left;padding-left:5px;'>" + name + "</td>";
        html += "<td style='text-align:center;'>" + email + "</td>";
        html += "<td class='blank_item'>&nbsp;</td>";
        html += "<td class='blank_price'>&nbsp;</td>";
        html += "<td class='blank_quantity'>&nbsp;</td>";
        html += "<td class='blank_total'>&nbsp;</td>";
  */      
  }

  function calcualateQ(item_id) {
    quantity = document.getElementById("quantity" + item_id).value;
    label = document.getElementById("label_" + item_id);
    label.innerHTML = (parseFloat(item_price[item_id]))*(parseFloat(quantity));
    totals = document.getElementsByClassName("item_total");
  
    total = 0;

    for(var i=0;i<totals.length;i++){
      total+=parseFloat(totals[i].innerHTML);
    }
    var t = ""
    t += "<td width='50px'><button onclick='processOrder();'>Create order(s)</button><td colspan='6'>";
    t += "<span style='text-align:right;padding-right:10px;float:right;font-weight:bold;font-size:15px;'>";
    t += total + "</span>";

    t += "<span style='text-align:left;padding-left:10px;float:left;font-weight:bold;font-size:15px;'>";
    t +="Total</span>";
    document.getElementById("total_amount").innerHTML = t + "</td>";
  }

  function addItem() {
    document.location="itemsdetails";
  }

  function redirectLogin() {                                                    
    document.location = "login.php";                                            
  }                                                                             
                                                                                
  function redirectHome() {                                                     
    document.location = "index.php";                                            
  }                          
  
  
  function processOrder() {
    itemPriceTD = document.getElementsByClassName('blank_price');               
    itemNameTD = document.getElementsByClassName('blank_item');                 
    customerName = document.getElementsByClassName('cname');         
    itemTotalTD = document.getElementsByClassName('item_total');               
    quantityValues = document.getElementsByClassName('quantity_values');

    selectItems = {}

    for(var i = 0; i < itemTotalTD.length; i++) {
      if(itemTotalTD[i].innerHTML.length > 0){
        name = itemNameTD[i].innerHTML;                                        
        price = itemPriceTD[i].innerHTML;
        quantity = quantityValues[i].value;         
        cname = customerName[i].innerHTML;                             
        selected_item_id = quantityValues[i].id.split("quantity")[0];

        selectItems[name] = quantity + ";" + price + ";" + cname;
      }
    }

    var str = "";

    for(key in selectItems) {
      if(str==""){
        str = key + ";" + selectItems[key];
      }else{
        str+= "," + key + ";" + selectItems[key];
      }
    }

    submitForm = document.getElementById("orders");                        
                                                                                
    newElement = document.createElement("input");                               
    newElement.setAttribute("name","orders");      
    newElement.setAttribute("type","hidden");                                   
    newElement.value = str;                                               
    submitForm.appendChild(newElement);

    submitForm.submit();                                                        
    return;

  }                                                   
</script>











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

<style>
#menu-buttons-container {                                                       
  width: 100%;                                                                  
} 
</style>


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
	<li><a href="#" class="na">Reports</a></li>
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
  <div id="left" style="width:667px;">
    <!-- starts -->
    
    <table id="menu-buttons-container">
      <caption style="text-align:left;padding-left:10px;"><strong>Orders</strong></caption>
	    <tr>	
	      <td style="vertical-align:top;text-align:right;padding-right:10px;">
          <label>Select customer:&nbsp;</label><select id = "search_string" name="customers" onchange="select();">
            <option></option>
            <?php                                                                         
              $options = "SELECT customer_id , customer_name FROM customer";                                     
              $results = mysql_query($options,$db);                               
              $nl = mysql_num_rows($results);                                         
                                                                                
              if($nl > 0) {                                                           
                for ($i = 1;$i <= $nl;$i++) {                                         
                 $rc = mysql_fetch_row($results);                                        
              ?>                                                                            
                 <option value="<?php echo $rc[0]; ?>"><?php echo encrypt($rc[1]); ?></option>       
              <?php                                                                   
               }                                                                          
             } ?>
          </select>&nbsp;
          <button onclick="javascript:location='newcustomer'">New customer</button>
        </td>
      </tr>	
	

        <tr>
        <!-- -->
          <td style="vertical-align:top;">
            <table width="99%" style="border-style:solid;border-width:1px;font-size:12px;">
              <tr id="search_item">
                <td colspan="6" style="text-align:left;padding-left:10px;">&nbsp;</td>
              </tr>
              <tr style="background-color:lightgrey;color:#6B6854;" id="header-th">
                <th class="cd-details" style="text-align:left;padding-left:5px;width:140px;">Customer name</th>
                <th class="cd-details" style="width:100px;">E-mail</td>
                <th class="cd-details" style="width:80px;">Item</th>
                <th class="cd-details" style="width:20px;">Price</th>
                <th class="cd-details" style="width:10px;">Quantity</th>
                <th class="cd-details" style="width:20px;">Total</th>
              </tr>
              <tr id="sales_details"><td colspan="6" style="text-align:center;">
                <table id="sales_details_table">
                  <tr><td style="text-align:center;">&nbsp;</td></tr>
                </table></td>
              </tr>
              <tr style="background-color:lightgrey;">
                <td colspan="7">&nbsp;</td>
              </tr>
              <tr id="total_amount">
                <td colspan="7">&nbsp;</td>
              </tr>
              <tr style="background-color:silver;">
                <td colspan="7" id = "item_list_results"></td>
              </tr>
            </table>
          </td>
          
        <!-- -->
        </tr>
      </table>
    </div>
  

    <!-- ends -->
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p style="font-size:20px;width:665px;">Welcome&nbsp;<strong><?php echo encrypt($r[2]).' '.encrypt($r[3]); ?></strong></p>
  </div>
</div>
</div>

<form id="orders" method="post" action="createorder.php" type="hidden">         
</form> 

</body>
</html>
