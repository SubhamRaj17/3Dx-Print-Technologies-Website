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

if (isset($_POST['name'])) {
	
	$pid = mysql_real_escape_string($_POST['thisID']);
    $name = mysql_real_escape_string($_POST['name']);
    $login = mysql_real_escape_string($_POST['login']);
	$mobile = mysql_real_escape_string($_POST['mobile']);
	$securityanswer = mysql_real_escape_string($_POST['answer']);
	$email = mysql_real_escape_string($_POST['email']);
	$address = mysql_real_escape_string($_POST['address']);
	$city = mysql_real_escape_string($_POST['city']);
	$state = mysql_real_escape_string($_POST['state']);
	$pin = mysql_real_escape_string($_POST['pin']);

	$sql = mysql_query("UPDATE customer SET name='$name',login='$login',mobile='$mobile',securityanswer='$securityanswer',email='$email',address='$address',city='$city', state='$state',pin='$pin' WHERE id='$pid'");
	header("location: user_list.php"); 
    exit();
}
?>
<?php 

if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];
    $sql = mysql_query("SELECT * FROM customer WHERE id='$targetID' LIMIT 1");
    $productCount = mysql_num_rows($sql); 
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             
			$name = $row['name'];
			$login = $row['login'];
			$mobile = $row['mobile'];
			$security = $row['security'];
			$securityanswer = $row['securityanswer'];
			$email = $row['email'];
			$address = $row['address'];
			$city = $row['city'];
			$state = $row['state'];
			$pin = $row['pin'];
        }
    } else {
	    echo "Sorry that doesnt exist.";
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
<meta name="keywords" content="3dx print Technologies,3d printing in india,3d printing in allahabad, Indian Instrumentation" />
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

<script type="text/javascript" language="javascript"> 
<!--
function validateMyForm ( ) { 
    var isValid = true;
    if ( document.userForm.name.value == "" ) { 
	    alert ( "Please type Your Name" ); 
	    isValid = false;
    } else if ( document.userForm.login.value == "" ) { 
	    alert ( "Please type Your Login Name" ); 
	    isValid = false;
    } else if ( document.userForm.security.value == "" ) { 
	    alert ( "Please select security question" ); 
	    isValid = false;
    } else if ( document.userForm.answer.value == "" ) { 
	    alert ( "Please select security question answer" ); 
	    isValid = false;
    } else if ( document.userForm.mobile.value == "" ) { 
            alert ( "Please enter your Mobile Number" ); 
            isValid = false;
    } else if ( document.userForm.email.value == "" ) { 
            alert ( "Please provide your Email" ); 
            isValid = false;
    } else if ( document.userForm.address.value == "" ) { 
            alert ( "Please provide your address" ); 
            isValid = false;
    } else if ( document.userForm.city.value == "" ) { 
            alert ( "Please provide your city" ); 
            isValid = false;
    } else if ( document.userForm.state.value == "" ) { 
            alert ( "Please provide your state" ); 
            isValid = false;
    } else if ( document.userForm.pin.value == "" ) { 
            alert ( "Please provide your pin" ); 
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
    <div align="right" style="margin-right:32px;"><a href="http://localhost/InorbitMall/storeadmin/logout.php">Logout</a></div>
<div align="left" style="margin-left:24px;">
    </div>
    <a name="UserRegistration" id="UserRegistration"></a>
    <h3>
    &darr; Edit User &darr;
    </h3>
    <form action="" enctype="multipart/form-data" name="userForm" id="userForm" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right">Full Name</td>
        <td width="80%"><label>
          <input name="name" type="text" id="name" size="40" value=<?php echo $name;?> />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">Login</td>
        <td width="80%"><label>
          <input name="login" type="text" id="login" size="20" value=<?php echo $login;?> />
        </label></td>
      </tr>
      <tr>
        <td align="right">Security Question  </td>
        <td>  <?php echo $security;?></td>
      </tr>       
      <tr>
        <td width="20%" align="right">Answer</td>
        <td width="80%"><label>
          <input name="answer" type="text" id="answer" size="40" value=<?php echo $securityanswer;?> />
        </label></td>
      </tr>        
      <tr>
        <td align="right">Mobile</td>
        <td><label>
          <input name="mobile" type="text" id="mobile" size="10" value=<?php echo $mobile;?> />
        </label></td>
      </tr>
      <tr>
        <td align="right">Email Id</td>
        <td><label>
          <input name="email" type="text" id="email" size="50" value=<?php echo $email;?> />
        </label></td>
      </tr>
      <tr>
        <td align="right">Address</td>
        <td><label>
          <textarea name="address" id="address" cols="64" rows="5"><?php echo $address; ?></textarea>
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">City</td>
        <td width="80%"><label>
          <input name="city" type="text" id="city" size="20" value=<?php echo $city;?> />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">State</td>
        <td width="80%"><label>
          <input name="state" type="text" id="state" size="20" value=<?php echo $state?> />
        </label></td>
      </tr>
      <tr>
        <td align="right">PinCode</td>
        <td><label>
          <input name="pin" type="text" id="pin" size="6" value=<?php echo $pin;?> />
        </label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
          <input type="submit" name="button" id="button" value="Change Now"  onclick="javascript:return validateMyForm();"/>
        </label></td>
      </tr>
    </table>
    </form>
    <br />
  <br />
  </div>
  </div>
  </div>  
  <?php include_once("template_footer.php");?>
</div>
</body>
</html>