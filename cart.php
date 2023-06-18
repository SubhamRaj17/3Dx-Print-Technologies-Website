<?php  
error_reporting(E_ALL);
ini_set('display_errors', '1');
include "storescripts/connect_to_mysql.php"; 
?>
<?php 
if(isset($_POST['cid']) && isset($_POST['pid'])){
	$cid = $_POST['cid'];
	$pid = $_POST['pid'];
	$sql = mysql_query("SELECT * FROM customer_cart WHERE customerid='$cid' LIMIT 1");
	$count = mysql_num_rows($sql);
	$prodquery = mysql_query("SELECT * FROM products WHERE id='$pid' LIMIT 1");
	while($row = mysql_fetch_array($prodquery)){
		$product_name = $row["product_name"];
		$details = $row["details"];
		$price = $row["price"];
		$date_added = $row["date_added"];
	}
	$quantity=1;	
	if($count==0){
		$ssql = mysql_query("INSERT INTO customer_cart (productid, customerid, product_name, details, price, quantity, date_added) VALUES('$pid','$cid','$product_name','$details','$price','$quantity',now())") or die (mysql_error());
	} else {
		$already = mysql_query("SELECT * FROM customer_cart WHERE productid='$pid' AND customerid='$cid' LIMIT 1");
		$acount = mysql_num_rows($already);
		if($acount!=0){
			while($row = mysql_fetch_array($already)){
				$aquantity = $row["quantity"];
				}
			$aquantity=$aquantity+1;
			$ssql = mysql_query("UPDATE customer_cart SET quantity='$aquantity' WHERE productid='$pid' AND customerid='$cid' ") or die (mysql_error());
		} else {
			$ssql = mysql_query("INSERT INTO customer_cart (productid, customerid, product_name, details, price, quantity, date_added) 
        	VALUES('$pid','$cid','$product_name','$details','$price','$quantity',now())") or die (mysql_error());
		}	
	}
	header("location: cart.php"); 
    exit();
}

?>
<?php
session_start();
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart" && isset($_SESSION["id"])) {
		$cid = $_SESSION["id"];
		$sql = mysql_query("SELECT * FROM customer_cart WHERE customerid='$cid' LIMIT 1");
		$count = mysql_num_rows($sql);
		if($count!=0){
			$sql = mysql_query("DELETE FROM customer_cart WHERE customerid='$cid'") or die(mysql_error());
		}
}
?>

<?php
if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "" && isset($_SESSION["id"])) {
	$cid = $_SESSION["id"];
	$item_to_adjust = $_POST['item_to_adjust'];
	$quantity = $_POST['quantity'];
	$quantity = preg_replace('#[^0-9]#i', '', $quantity); 
	if ($quantity >= 100) { $quantity = 99; }
	if ($quantity < 1) { $quantity = 1; }
	if ($quantity == "") { $quantity = 1; }
	$ssql = mysql_query("UPDATE customer_cart SET quantity='$quantity' WHERE productid='$item_to_adjust' AND customerid='$cid' ") or die (mysql_error());
}
?>

<?php
if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != ""  && isset($_SESSION["id"])) {
	$cid = $_SESSION["id"];
	$toremove = $_POST['index_to_remove'];
	$sql = mysql_query("DELETE FROM customer_cart WHERE customerid='$cid' AND productid='$toremove'") or die(mysql_error());
}
?>

<?php
$cartOutput = "";
$cartTotal = "";
if(isset($_SESSION["id"])){
	$cid=$_SESSION["id"];
	$sql = mysql_query("SELECT * FROM customer_cart WHERE customerid='$cid'") or die(mysql_error());
	$count = mysql_num_rows($sql);	
	if($count==0){
		$cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
	}
	else {
		$i=0;
		while ($lists = mysql_fetch_array($sql)) {
				$item_id = $lists["productid"];
				$sqls = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1") or die(mysql_error());
				$list = mysql_fetch_array($sqls);
				$product_name = $list["product_name"];
				$price = $list["price"];
				$details = $list["details"];
				$quantity = $lists["quantity"];
				$pricetotal = $price * $quantity;
				$cartTotal = $pricetotal + $cartTotal;
				$cartOutput .= "<tr style='text-align:center;'>";
		$cartOutput .= '<td><a href="product.php?id=' . $item_id . '" style="color:orangered;">' . $product_name . '</a><br /><img src="inventory_images/' . $item_id . '.jpg" alt="' . $product_name. '" width="40" height="52" border="1" /></td>';
		$cartOutput .= '<td>' . $details . '</td>';
		$cartOutput .= '<td>₹ 	' . $price . '</td>';
		$cartOutput .= '<td><form action="cart.php" method="post">
		<input name="quantity" type="text" value="' . $quantity . '" size="1" maxlength="2" />
		<input name="adjustBtn' . $item_id . '" type="submit" value="change" />
		<input name="item_to_adjust" type="hidden" value="' . $item_id . '" />
		</form></td>';
		$cartOutput .= '<td style="color:red;">' . $pricetotal . '*</td>';
		$cartOutput .= '<td><form action="cart.php" method="post"><input name="deleteBtn' . $item_id . '" type="submit" value="X" /><input name="index_to_remove" type="hidden" value="' . $item_id . '" /></form></td>';
		$cartOutput .= '</tr>';
		}
		$cartTotal = "<div style='color:red;font-size:35px; margin-top:30px;' >Cart Total : ₹".$cartTotal." </div>";

	}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Welcome to 3DX PRINT Technologies</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Photographer Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" type="image/png" href="images/logo.png" />


<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Syncopate:400,700' rel='stylesheet' type='text/css'>
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5879c2002438f53b0a290186/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>



</head>
	
<body> 

<div class="banner-body" >
<div class="container" >
<div class="banner-body-content"> 
  <?php include_once("template_header.php");?>
  <div id="pageContent" style="background-color: whitesmoke;">
    <div style=" text-align:center;padding: 40px 30px;">
	<h2 style="    text-align: center;font-size: 50px;font-family: cursive;color: tomato; margin-bottom: 60px; " >Your Cart</h2>
    <br />
    <div style="overflow-x:auto;">
    <table width="100%" border="1" cellspacing="0" cellpadding="6">
      <tr>
        <td width="18%" bgcolor="#C5DFFA"><strong>Product</strong></td>
        <td width="45%" bgcolor="#C5DFFA"><strong>Product Description</strong></td>
        <td width="10%" bgcolor="#C5DFFA"><strong>Unit Price</strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Quantity</strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Total</strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Remove</strong></td>
      </tr>
     <?php echo $cartOutput; ?>
     <!-- <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr> -->
    </table>
    </div>
    <?php echo $cartTotal; ?>
    <br />
<br />
    <br />
    <br />
   <button class="btn btn-danger" style="    padding: 15px 20px; margin-bottom: 50px;border: 2px solid yellowgreen;"><a href="payumoney/PayUMoney_form.php" style="color: whitesmoke;">Proceed to Checkout</a></button>
    <p style="
    color: #459e28; margin-bottom: 40px;"><b>*</b> This price is at 100*100*100 cube at 35% infill density<br>You can always change the infill density and volume according to your choice!</p>
    <a href="cart.php?cmd=emptycart" style="    color: orangered;font-size: 20px;font-family: cursive;">Click Here to Empty Your Shopping Cart</a>
    </div>
   <br />
  </div>
  </div>
  </div>
  </div><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5879c7c898845558"></script>
  <?php include_once("template_footer.php");?>


</body>
</html>