<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
if (isset($_GET['id'])) {
    include "storescripts/connect_to_mysql.php"; 
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 

	$sql = mysql_query("SELECT * FROM products WHERE id='$id' LIMIT 1");
	$productCount = mysql_num_rows($sql); 
    if ($productCount > 0) {
		while($row = mysql_fetch_array($sql)){ 
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $details = $row["details"];
			 $category = $row["category"];
			 $subcategory = $row["subcategory"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
         }
		 
	} else {
		echo "That item does not exist.";
	    exit();
	}
		
} else {
	echo "Data to render this page is missing.";
	exit();
}
mysql_close();
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $product_name; ?>|3Dx</title>
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
<div class="banner-body-content" > 

  <?php include_once("template_header.php"); ?>
  <div id="pageContent">
  <div style="overflow-x:auto;">
  <table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr>
    <td width="19%" valign="top" style="text-align: center;padding-top: 160px;"><img src="inventory_images/<?php echo $id; ?>.jpg" width="142" height="188" alt="<?php echo $product_name; ?>" style=" border: 5px solid greenyellow;" onmouseover="bigImg(this)" onmouseout="normalImg(this)"/><br />
      <a href="inventory_images/<?php echo $id; ?>.jpg">View Full Size Image</a></td>
    <td width="81%" valign="top" style="padding: 120px 35px;"><h3 style="text-align: center; font-family: cursive;color: yellowgreen; "><?php echo $product_name; ?></h3>
      <p style="  font-family: cursive; "><b>Price   </b><?php echo "₹".$price; ?></p><br />
        <br />
       <p style="  font-family: cursive;"><b>Category   </b> <?php echo "$subcategory $category"; ?></p> <br />
<br />
      <p style="  font-family: cursive;"><b>Product details  </b> <?php echo $details; ?>
      <?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();
if(!isset($_SESSION['user']))
{
 ?>
     <br>
      <button onclick="cart2()" class="btn btn-danger" style="margin-top: 25px; ">Add to cart</button>
      <?php } ?>
<br />
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();
if(isset($_SESSION['user']))
{
 ?>
            </p>
      <form id="form1" name="form1" method="post" action="cart.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
        <input type="hidden" name="cid" id="cid" value="<?php echo $_SESSION["id"]?>" />
        <input type="submit" name="button" id="button" value="Add to Shopping Cart"  style="     background-color: lightyellow;    border-color: chartreuse;   padding: 5px; margin-top: 30px;"      />
      </form></td>
<?php } ?>
      </td>
    </tr>
</table>
</div>
  </div>
  </div>
  </div><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5879c7c898845558"></script>
 </div>
  <?php include_once("template_footer.php");?>
<script>
function bigImg(x) {
    x.style.height = "420px";
    x.style.width = "600px";
}

function normalImg(x) {
    x.style.height = "188px";
    x.style.width = "142px";
}
</script>
<script>
  function cart2(){
    window.alert("Please Login To add to cart");
  }
</script>
</body>
</html>