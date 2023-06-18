<?php
session_start();
if (!isset($_SESSION["designer"])) {
    header("location: designer_login.php"); 
    exit();
}
$id = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); 
$user = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["designer"]); 
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]);

include "../storescripts/connect_to_mysql.php"; 
$sql = mysql_query("SELECT * FROM designer WHERE id='$id' AND login='$user' AND password='$password' LIMIT 1");

$existCount = mysql_num_rows($sql); 
if ($existCount == 0) {
	 echo "Your login session data is not on record in the database.";
     exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>3DX Designer Hub</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Photographer Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
    function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" type="image/png" href="../images/i1.png" />


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



</head>
<body>
<div class="banner-body"  >
<div class="container" style=" box-shadow: 0 14px 18px 0 rgba(0, 0, 0, 1.2), 0 16px 40px 0 rgba(0, 0, 0, 0.34);">
<div class="banner-body-content" >
  <?php include_once("template_header.php");?>
  <div id="pageContent"><br />
    <div align="left" style="margin-left:24px;">
    
      <h2 style="    text-align: center;font-family: cursive;color: chocolate;font-size: 35px;margin-bottom: 50px;">Hello Designer, Have a great day!</h2>
     
      <p style="text-align: center;"><a href="work_list.php" style="color: green;font-size: 25px;">Manage your work</a></p></br>

    	 <p style="text-align: center;"> <a href="more_list.php" style="color: green;font-size: 25px;">More works</a> </p></br>
      <p style="text-align: center;"><a href="logout.php" style="color: green;font-size: 25px;">Logout</a> </p>
      
</div>
    <br />
  <br />
  <br />
  		</div>
  	</div>
  </div>
  </div>
  <?php include_once("template_footer.php");?>  

</body>
</html>