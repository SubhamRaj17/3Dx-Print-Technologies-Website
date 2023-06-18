<?php
session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); 
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); 
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]);

include "../storescripts/connect_to_mysql.php"; 
$sql = mysql_query("SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1");

$existCount = mysql_num_rows($sql); 
if ($existCount == 0) {
	 echo "Your login session data is not on record in the database.";
     exit();
}
?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
if (isset($_GET['deleteid'])) {
	echo 'Do you really want to delete product with ID of ' . $_GET['deleteid'] . '? <a href="inventory_list.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="inventory_list.php">No</a>';
	exit();
}
if (isset($_GET['yesdelete'])) {
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysql_query("DELETE FROM products WHERE id='$id_to_delete' LIMIT 1") or die (mysql_error());
    $pictodelete = ("../inventory_images/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }
	header("location: inventory_list.php"); 
    exit();
}
?>
<?php 
if (isset($_POST['product_name'])) {
	
    $product_name = mysql_real_escape_string($_POST['product_name']);
	$price = mysql_real_escape_string($_POST['price']);
	$category = mysql_real_escape_string($_POST['category']);
	$subcategory = mysql_real_escape_string($_POST['subcategory']);
	$details = mysql_real_escape_string($_POST['details']);
	$sql = mysql_query("SELECT id FROM products WHERE product_name='$product_name' LIMIT 1");
	$productMatch = mysql_num_rows($sql); 
    if ($productMatch > 0) {
		echo 'Sorry you tried to place a duplicate "Product Name" into the system, <a href="inventory_list.php">click here</a>';
		exit();
	}
	$sql = mysql_query("INSERT INTO products (product_name, price, details, category, subcategory, date_added) 
        VALUES('$product_name','$price','$details','$category','$subcategory',now())") or die (mysql_error());
     $pid = mysql_insert_id();
	$newname = "$pid.jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	header("location: inventory_list.php"); 
    exit();
}
?>
<?php 
$product_list = "";
$sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC");
$productCount = mysql_num_rows($sql); 
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $product_list .= "Product ID: $id - <strong>$product_name</strong> - ₹$price - <em>Added $date_added</em> &nbsp; &nbsp; &nbsp; <a href='inventory_edit.php?pid=$id'>edit</a> &bull; <a href='inventory_list.php?deleteid=$id'>delete</a><br />";
    }
} else {
	$product_list = "You have no products listed in your store yet";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome to 3DX PRINT Technologies</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="3dx print Technologies,3d printing in india,3d printing in allahabad, Indian Instrumentation" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" type="image/png" href="../images/logo.png" />


<script src="../js/jquery-1.11.1.min.js"></script>
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



<script type="text/javascript" language="javascript"> 
<!--
function validateMyForm ( ) { 
    var isValid = true;
    if ( document.myForm.product_name.value == "" ) { 
	    alert ( "Please type Product Name" ); 
	    isValid = false;
    } else if ( document.myForm.price.value == "" ) { 
            alert ( "Please enter price" ); 
            isValid = false;
    } else if ( document.myForm.details.value == "" ) { 
            alert ( "Please provide details" ); 
            isValid = false;
    } else if ( document.myForm.fileField.value == "" ) { 
            alert ( "Please provide picture" ); 
            isValid = false;
    }
    return isValid;
}
//-->
</script>
</head>

<body>
<div class="banner-body" >
<div class="container" style="position: relative;left:-15px;">
<div class="banner-body-content" > 

  <?php include_once("template_header.php");?>
    <div id="pageContent"><br />
      <div align="right" > <a href="logout.php">Logout</a> &middot;
      <a href="inventory_list.php#inventoryForm">+ Add New Inventory Item</a></div>
<div align="left" style="text-align: center;padding: 40px 30px;">
      <h2 style="    text-align: center;font-family: cursive;font-size: 50px; color: tomato;margin-bottom: 40px;">Inventory List</h2>
      <?php echo $product_list; ?>
    </div>
    <a name="inventoryForm" id="inventoryForm"></a>
    <h3 style="text-align: center;font-family: cursive;font-size: 30px;color: yellowgreen; margin-bottom: 10px; margin-top: 30px;">
    &darr; Add New Inventory Item Form &darr;
    </h3>
    <form action="inventory_list.php" enctype="multipart/form-data" name="myForm" id="myForm" method="post" style="text-align: center;">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right" style="font-family: cursive;font-size: 20px;color: yellowgreen;"	>Product Name</td>
        <td width="80%"><label>
          <input name="product_name" type="text" id="product_name" size="64" />
        </label></td>
      </tr>
      <tr>
        <td align="right" style="font-family: cursive;font-size: 20px;color: yellowgreen;">Product Price</td>
        <td><label>
          Rs
          <input name="price" type="text" id="price" size="12" />
        </label></td>
      </tr>
      <tr>
        <td align="right" style="font-family: cursive;font-size: 20px;color: yellowgreen;">Category</td>
        <td><label>
          <select name="category" id="category">
          <option value=""></option>
          <option value="Abstract">Abstract</option>
          <option value="Nature">Nature</option>
          <option value="Technology">Technology</option>
          <option value="MobileCases">MobileCases</option>
          <option value="KeyRings">KeyRings</option>
          <option value="Electronics">Electronics</option>
          <option value="Personality">Personality</option>
          <option value="Machine">Machine</option>
          <option value="Gaming">Gaming</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td align="right" style="font-family: cursive;font-size: 20px;color: yellowgreen;">Product Details</td>
        <td><label>
          <textarea name="details" id="details" cols="64" rows="5"></textarea>
        </label></td>
      </tr>
      <tr>
        <td align="right" style="font-family: cursive;font-size: 20px;color: yellowgreen;">Product Image</td>
        <td><label>
          <input type="file" name="fileField" id="fileField" />
        </label></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input type="submit" name="button" id="button" value="Add This Item Now"  onclick="javascript:return validateMyForm();"/>
        </label></td>
      </tr>
    </table>
    </form>
    <p><br />
      <br />
    </p>
  </div>
  </div>
  </div>

  <?php include_once("template_footer.php");?>  
</div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5879c7c898845558"></script>
		 
</body>
</html>