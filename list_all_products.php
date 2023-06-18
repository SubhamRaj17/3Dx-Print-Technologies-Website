<?php
if(isset($_GET['sortby'])){
	$sortby = $_GET['sortby'];
} else {
	$sortby = "date_added";
}
if(isset($_GET['way'])){
	$way = $_GET['way'];
} else {
	$way = "DESC";
}
if(isset($_GET['filterby'])){
	$filterby = $_GET['filterby'];
}
else {
	$filterby = NULL;	
}
include "storescripts/connect_to_mysql.php";
if($filterby == NULL){
	$sql = mysql_query("SELECT * FROM products ORDER BY $sortby $way");
}
else {
	$sql = mysql_query("SELECT * FROM products WHERE category='$filterby' ORDER BY $sortby $way");	
}
$i = 0;
$dyn_table = '<div style="overflow-x:auto;">
<table align="left" border="1" cellpadding="10" table width="100%" style="    background-color: beige;border: 10px solid burlywood;">';
while($row = mysql_fetch_array($sql)){ 
    
    $id = $row["id"];
    $product_name = $row["product_name"];
	$price = $row["price"];
	$date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
    if ($i % 3 == 0) { 
        $dyn_table .= '	
        				<tr>
        				<div class="col-md-4 latest-news-grid">
						<td width="17%" valign="top" style="padding:30px;"><a href="product.php?id=' . $id . '"><img style="border: 4px solid green;"  src="inventory_images/' . $id . '.jpg" alt="' . $product_name . '" width="77" height="102" border="1" /></a>
						<p style="  font-family: cursive;color: brown;">' . $product_name . '</p><br/>
						<p style="color: brown;font-family: cursive;">₹  ' . $price . '</p><br/>
						<a href="product.php?id=' . $id . '">View Details</a>
						</td>
						
						';
    } else {
        $dyn_table .= '<td width="17%" valign="top" style="padding:30px;"><a href="product.php?id=' . $id . '"><img style="    border: 4px solid green;"  src="inventory_images/' . $id . '.jpg" alt="' . $product_name . '" width="77" height="102" border="1" /></a>
						<p style="    font-family: cursive;color: brown;">' . $product_name . '</p><br/>
						<p style="color: brown;font-family: cursive;">₹  ' . $price . '</p><br/>
						 <a href="product.php?id=' . $id . '">View Details</a>
						</td>';
    }
    $i++;
	if ($i%3 == 0)
		$dyn_table .= '</tr>';
}
$dyn_table .= '</table></div>';	
?>

<!DOCTYPE html>
<html>
<head>
<title>Welcome to 3DX PRINT Technologies</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="3dx print technologies is a website for 3D printing services in India. Just upload your design we will print the product for you. 3Dx Print Technologies, Allahabad" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />


<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Syncopate:400,700' rel='stylesheet' type='text/css'>
<link rel="icon" type="image/png" href="images/logo.png" />
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
<div class="banner-body">
<div class="container">
<div class="banner-body-content">
  <?php include_once("template_header.php");?>
  <div id="pageContent" style="text-align: center;background-color: blanchedalmond;     border: 5px solid burlywood;" >
    <p style="margin-top: 15px;">Sort By: 
<select name="menu" onChange="window.document.location.href=this.options[this.selectedIndex].value;" value="Choose">
		<option value = ''> Choose </option>
        <option value="list_all_products.php?sortby=price&way=DESC&filterby=<?php 
		if(isset($_GET['filterby']))
			echo $filterby; 
		else
			echo NULL;
		?>">Price: High to Low</option>
        <option value="list_all_products.php?sortby=price&way=ASC&filterby=<?php 
		if(isset($_GET['filterby']))
			echo $filterby; 
		else
			echo NULL;
		?>">Price: Low to High</option>
		<option value="list_all_products.php?sortby=date_added&way=DESC&filterby=<?php 
		if(isset($_GET['filterby']))
			echo $filterby; 
		else
			echo NULL;
		?>">Date Added</option>
 </select> 
| Filter By: 
<select name="menu" onChange="window.document.location.href=this.options[this.selectedIndex].value;" value="Choose">
		<option value = ''> Choose </option>
         <option value="list_all_products.php">None</option>
          <option value="list_all_products.php?filterby=Abstract&sortby=<?php 
		if(isset($_GET['sortby']))
			echo $sortby; 
		else
			echo "date_added";
		?>&way=<?php 
		if(isset($_GET['way']))
			echo $way; 
		else
			echo "DESC";
		?>">Abstract</option>
          <option value="list_all_products.php?filterby=Nature&sortby=<?php 
		if(isset($_GET['sortby']))
			echo $sortby; 
		else
			echo "date_added";
		?>&way=<?php 
		if(isset($_GET['way']))
			echo $way; 
		else
			echo "DESC";
		?>">Nature</option>
          <option value="list_all_products.php?filterby=Technology&sortby=<?php 
		if(isset($_GET['sortby']))
			echo $sortby; 
		else
			echo "date_added";
		?>&way=<?php 
		if(isset($_GET['way']))
			echo $way; 
		else
			echo "DESC";
		?>">Technology</option>
          <option value="list_all_products.php?filterby=MobileCases&sortby=<?php 
		if(isset($_GET['sortby']))
			echo $sortby; 
		else
			echo "date_added";
		?>&way=<?php 
		if(isset($_GET['way']))
			echo $way; 
		else
			echo "DESC";
		?>">MobileCases</option>
          <option value="list_all_products.php?filterby=KeyRings&sortby=<?php 
		if(isset($_GET['sortby']))
			echo $sortby; 
		else
			echo "date_added";
		?>&way=<?php 
		if(isset($_GET['way']))
			echo $way; 
		else
			echo "DESC";
		?>">KeyRings</option>
          <option value="list_all_products.php?filterby=Electronics&sortby=<?php 
		if(isset($_GET['sortby']))
			echo $sortby; 
		else
			echo "date_added";
		?>&way=<?php 
		if(isset($_GET['way']))
			echo $way; 
		else
			echo "DESC";
		?>">Electronics</option>
          <option value="list_all_products.php?filterby=Personality&sortby=<?php 
		if(isset($_GET['sortby']))
			echo $sortby; 
		else
			echo "date_added";
		?>&way=<?php 
		if(isset($_GET['way']))
			echo $way; 
		else
			echo "DESC";
		?>">Personality</option>
          <option value="list_all_products.php?filterby=Machine&sortby=<?php 
		if(isset($_GET['sortby']))
			echo $sortby; 
		else
			echo "date_added";
		?>&way=<?php 
		if(isset($_GET['way']))
			echo $way; 
		else
			echo "DESC";
		?>">Machine</option>
        
          <option value="list_all_products.php?filterby=Gaming&sortby=<?php 
		if(isset($_GET['sortby']))
			echo $sortby; 
		else
			echo "date_added";
		?>&way=<?php 
		if(isset($_GET['way']))
			echo $way; 
		else
			echo "DESC";
		?>">Gaming</option>
 </select> 
    </p>
    <h1 style="    font-size: 30px; margin-top: 40px;margin-bottom: 35px; font-family: cursive;color: yellowgreen;">Upload Your .obj and .stl file here and we will print it in Minimal cost!! <span><a href="1/index.php">Upload Here</a></span></h1>
    <?php echo $dyn_table; ?>
  </div>
  </div>
</div>
</div>



<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5879c7c898845558"></script>

 <?php include_once("template_footer.php");?>
</body>
</html>