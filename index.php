<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
include "storescripts/connect_to_mysql.php"; 
$dynamicList = "";
$sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC LIMIT 5");
$productCount = mysql_num_rows($sql); 
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $dynamicList .= '<table width="100%" border="0" cellspacing="0" cellpadding="6" style="margin-bottom:20px;">	
        <tr>
          <td width="17%" valign="top"><a href="product.php?id=' . $id . '"><img style="border:#666 1px solid;" src="inventory_images/' . $id . '.jpg" alt="' . $product_name . '" width="77" height="102" border="1" /></a></td>
          <td width="83%" valign="top"> <h4 style=" font-size:22px;    font-family: cursive; -webkit-border-before-color: blueviolet;-webkit-text-fill-color: tomato;margin-left:30px;">' .$product_name. '</h4><br /><p style="color: darkolivegreen;font-family: cursive;padding-left:30px;">Rs  '. $price.'<br />
            <a href="product.php?id=' . $id . '" style="color:olivedrab;	font-family: cursive; ">View Product Details</a></p></td>
        </tr>
      </table>';
    }
} else {
	$dynamicList = "We have no products listed in our store yet";
}
mysql_close();
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome to 3Dx PRINT Technologies</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="google-site-verification" content="P3-0GIKbgFUTraxLGA4Ql9biPQ7f38dR93CqWVspF7Q" />

<meta name="description" content="3Dx Print Technologies is start Up by Subham Choudhury and Prashant Nayak. In 3Dx Print Technologies, We provide our clients printed 3D design. Our Clients upload their designs in the website and we print for them at Minimal cost!">

<meta name="keywords" content="3dprint,3d design,3d,3Dx,3Dxprints,3Dxprinttech.in,3d printing,3d printing websites,designing company,3d printing startup ,printing soloutions,3d printing projects,print online,3d print online,cheapest 3d printing,3d printing solutions,3d printing in allahabad,3d printing in India,prototyping,prototype solutions,3d design to real,manufacturing process,3d printers" />

<meta name="description" content="At 3Dx Print Technologies, We provide our clients printed 3D design. Our Clients upload their designs in the website and we print for them at Minimal cost!3Dx Print Technologies is start Up by Subham Choudhury and Prashant Nayak. ">


<meta name="Home" content="http://www.3Dxprinttech.in/index.php" />
<meta name="Our Services" content="http://www.3Dxprinttech.in/services.php" />
<meta name="Products" content="http://www.3Dxprinttech.in/list_all_products.php" />
<meta name="Photoes" content="http://www.3Dxprinttech.in/gallery.php" />
<meta name="author" content="Subham Choudhury,Prashant Nayak">


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

  <?php include_once("template_header.php");
  	if (isset($_GET['success'])){
			echo "<p style='color:red;background-color:greenyellow; text-align:center;'>Successful Registration.</p>";
	}
  	if (isset($_GET['userloginsuccess'])){
			echo "<p style='color:red;background-color:greenyellow; text-align:center;'>Successful Login! Welcome to 3Dx Print Technologies</p>";
	}
	if (isset($_GET['resetsuccess'])){
			echo "<p style='color:red;background-color:greenyellow; text-align:center;'>Password Successfully Changed.</p>";
	}
  ?>
				<div class="banner-bottom" style="background-color: #F8F8F8;">
					<div class="col-md-7 banner-bottom-left">
						<div class="banner-bottom-left1">
							<h2>Welcome to 3Dx Print Technologies</h2>
							<div class="col-md-4 banner-bottom-left1-gridl">
								<img src="images/w1.jpg" alt=" " class="img-responsive" style="border: 4px solid greenyellow;" />
							</div>
							<div class="col-md-8 banner-bottom-left1-gridr">
								<p>3Dx Print Technologies is start Up by <b>Prashant Nayak</b> and <b>Subham Choudhury</b>. In 3Dx Print Technologies, We provide our clients printed 3D design. Our Clients upload their designs in the website and we print for them at Minimal cost!</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="banner-bottom-left2">
							<h3>Offered Services</h3>
							<div class="col-md-4 banner-bottom-left2l">
								<img src="images/logo.png" alt=" " class="img-responsive"  style="    height: 135px;    width: 200px; border: 3px solid orange;" />
							</div>
							<div class="col-md-8 banner-bottom-left2r">
								<ul>
									<li><a href="services.php">3D Printing at Minimal cost!!</a></li>
									<li><a href="services.php">Only 3D printing at allahabad</a></li>
									<li><a href="services.php">Free Home delivery</a></li>
									<li><a href="services.php">Online Payment!! No cash worries!!</a></li>
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="col-md-10 banner-bottom-left2" style="display:none;">
							<h2 style="text-align: center;"><a href="designers/designer_login.php" >Designers Login here</a></h2>
						</div>
						<div class="banner-bottom-left1" style="background-color: #F8F8F8; margin-top: 80px;">
								<div class="fb-comments" data-href="https://www.facebook.com/3DxPrintTech/" data-width="600px" data-numposts="5"></div>
								<div class="fb-like" data-href="https://www.facebook.com/3DxPrintTech/" data-width="600px" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>

						</div>
					</div>
					<div class="col-md-5 banner-bottom-right">
						<div class="newsletter">
							<h1>Newsletter</h1>

							<form action="newsletter.php" method="post">
								<input type="text" value=""  required="" id="email" name="email">
								<input type="submit" value="Subscribe" >
							</form>
						</div>

						<div class="news">
							<h3>Our Products</h3>
							<p>Following are our Products for display. You can upload your design and get featured here!!</p>
							 <table width="100%" border="0" cellspacing="0" cellpadding="10">
 							 <tr>

   							 <td width="35%" valign="top"><h3 style="font-size: 26px; font-family: cursive; color: grey;">Our Latest Designs</h3>
     						 <p><?php echo $dynamicList; ?><br />
        						</p>
     						 <p><br />
      						</p></td>

   
 								 </tr>
						</table>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>

 

		</div>

		</div>

	</div><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5879c7c898845558"></script>
		  <?php include_once("template_footer.php");?>
		  </div>


		  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>