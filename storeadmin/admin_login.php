<?php 
session_start();
if (isset($_SESSION["manager"])) {
    header("location: index.php"); 
    exit();
}
?>
<?php 
if (isset($_POST["username"]) && isset($_POST["password"])) {

	$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]);
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]);

    include "../storescripts/connect_to_mysql.php"; 
    $sql = mysql_query("SELECT id FROM admin WHERE username='$manager' AND password='$password' LIMIT 1"); 
	
    $existCount = mysql_num_rows($sql);
    if ($existCount == 1) { 
	     while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
		 }
		 $_SESSION["id"] = $id;
		 $_SESSION["manager"] = $manager;
		 $_SESSION["password"] = $password;
		 header("location: index.php");
         exit();
    } else {
		echo 'That information is incorrect, try again <a href="index.php">Click Here</a>';
		exit();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>3DX Admin Login</title>
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
<div class="container" style="position: relative;left:-15px;">
<div class="banner-body-content" > 

  <?php include_once("template_header.php");?>
  <div id="pageContent"><br />
    <div align="left" style="margin-left:24px;">
      <h2 style="    font-size: 30px; margin-top: 35px; margin-bottom:40px;font-family: cursive;color: yellowgreen; text-align: center;">Please Log In To Manage Your Website</h2>
      <form id="form1" name="form1" method="post" action="admin_login.php" style="text-align: center;">
        User Name:<br />
          <input name="username" type="text" id="username" size="40" />
        <br /><br />
        Password:<br />
       <input name="password" type="password" id="password" size="40" />
       <br />
       <br />
       <br />
       
         <input type="submit" name="button" id="button" value="Log In" style="    margin-bottom: 70px;background-color: lightyellow;border-color: chartreuse;padding: 5px; margin-left: 20px;"/>
       
      </form>
      <p>&nbsp; </p>
    </div>
    <br />
  <br />
  <br />
  </div>
  </div>
  </div><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5879c7c898845558"></script>
  <?php include_once("template_footer.php");?>
</div>
</body>
</html>