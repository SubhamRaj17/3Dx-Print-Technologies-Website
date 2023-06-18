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

if (isset($_POST['product_name'])) {
	
	$pid = mysql_real_escape_string($_POST['thisID']);
    $product_name = mysql_real_escape_string($_POST['product_name']);
	$price = mysql_real_escape_string($_POST['price']);
	$category = mysql_real_escape_string($_POST['category']);
	$subcategory = mysql_real_escape_string($_POST['subcategory']);
	$details = mysql_real_escape_string($_POST['details']);

	$sql = mysql_query("UPDATE products SET product_name='$product_name', price='$price', details='$details', category='$category', subcategory='$subcategory' WHERE id='$pid'");
	if ($_FILES['fileField']['tmp_name'] != "") {

	    $newname = "$pid.jpg";
	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	}
	header("location: inventory_list.php"); 
    exit();
}
?>
<?php 

if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];
    $sql = mysql_query("SELECT * FROM products WHERE id='$targetID' LIMIT 1");
    $productCount = mysql_num_rows($sql); 
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $category = $row["category"];
			 $subcategory = $row["subcategory"];
			 $details = $row["details"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        }
    } else {
	    echo "Sorry dude that crap dont exist.";
		exit();
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
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />


<script src="../js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Syncopate:400,700' rel='stylesheet' type='text/css'>
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
  <?php include_once("../template_header.php");?>
  <div id="pageContent"><br />
  
<div align="left" style="margin-left:24px;">
      <h2 style="    text-align: center;font-family: cursive;font-size: 50px; color: tomato;">Inventory list</h2>
    </div>
    <hr />
    <a name="inventoryForm" id="inventoryForm"></a>
    <h3 style="text-align: center;font-family: cursive;font-size: 30px;color: yellowgreen; margin-bottom: 10px;">
    &darr; Edit Inventory Item Form &darr;
    </h3>
    <form action="inventory_edit.php" enctype="multipart/form-data" name="myForm" id="myForm" method="post" style="text-align: center;">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right" style="font-family: cursive;font-size: 20px;color: yellowgreen;">Product Name</td>
        <td width="80%"><label>
          <input name="product_name" type="text" id="product_name" size="64" value="<?php echo $product_name; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right" style="font-family: cursive;font-size: 20px;color: yellowgreen;">Product Price</td>
        <td><label>
          Rs
          <input name="price" type="text" id="price" size="12" value="<?php echo $price; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right" style="font-family: cursive;font-size: 20px;color: yellowgreen;">Category</td>
        <td><label>
          <select name="category" id="category">
          <option value="Clothing">Clothing</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td align="right" style="font-family: cursive;font-size: 20px;color: yellowgreen;">Subcategory</td>
        <td><select name="subcategory" id="subcategory">
          <option value="<?php echo $subcategory; ?>"><?php echo $subcategory; ?></option>
          <option value="Hats">Hats</option>
          <option value="Pants">Pants</option>
          <option value="Shirts">Shirts</option>
          </select></td>
      </tr>
      <tr>
        <td align="right" style="font-family: cursive;font-size: 20px;color: yellowgreen;">Product Details</td>
        <td><label>
          <textarea name="details" id="details" cols="64" rows="5"><?php echo $details; ?></textarea>
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
          <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
          <input type="submit" name="button" id="button" value="Make Changes" onclick="javascript:return validateMyForm();" style="    margin-top: 40px;    padding: 10px; background-color: yellowgreen;border-bottom-color: yellow;" />
        </label></td>
      </tr>
    </table>
    </form>
    <br />
  <br />
  </div>
  </div>
  </div>
  <?php include_once("../template_footer.php");?>
</div>
</body>
</html>