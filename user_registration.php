<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
include "storescripts/connect_to_mysql.php";
if (isset($_POST['name'])) {
    $name = mysql_real_escape_string($_POST['name']);
    $login = mysql_real_escape_string($_POST['login']);
    $password = mysql_real_escape_string($_POST['password']);
    $cpassword = mysql_real_escape_string($_POST['cpassword']);	
	$mobile = mysql_real_escape_string($_POST['mobile']);
	$security = mysql_real_escape_string($_POST['security']);
	$securityanswer = mysql_real_escape_string($_POST['answer']);
	$email = mysql_real_escape_string($_POST['email']);
	$address = mysql_real_escape_string($_POST['address']);
	$city = mysql_real_escape_string($_POST['city']);
	$state = mysql_real_escape_string($_POST['state']);
	$pin = mysql_real_escape_string($_POST['pin']);
	if($password != $cpassword){
		echo 'Your passwords do not match., <a href="user_registration.php">Refill here</a>';
		exit();
	}
	$sql = mysql_query("SELECT id FROM customer WHERE mobile='$mobile' LIMIT 1");
	$userMatch = mysql_num_rows($sql); 
    if ($userMatch > 0) {
		echo 'Sorry your mobile number is already registered into the system, <a href="user_registration.php">click here</a>';
		exit();
	}
	$sql = mysql_query("INSERT INTO customer (login, password, name, mobile, security, securityanswer, email, address, city, state, pin) 
        VALUES('$login', '$password','$name','$mobile','$security','$securityanswer','$email','$address','$city','$state','$pin')") or die (mysql_error());
     $pid = mysql_insert_id();
	header("location: index.php?success"); 
    exit();
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
    } else if ( document.userForm.password.value == "" ) { 
	    alert ( "Please type Your Password" ); 
	    isValid = false;
    } else if ( document.userForm.cpassword.value == "" ) { 
	    alert ( "Please confirm Your Password" ); 
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
<div class="container">
<div class="banner-body-content" > 

  <?php include_once("template_header.php");?>
    <div id="pageContent" style="background-color: beige;border: 10px solid burlywood;"><br />
    <a name="UserRegistration" id="UserRegistration"></a>
    <h3 style="text-align: center;font-size: 40px;font-family: cursive;color: tomato;">
    &darr; New User Registration &darr;
    </h3>

    <form action="" enctype="multipart/form-data" name="userForm" id="userForm" method="post" style="text-align: center; margin-top: 120px;">
        <div style="overflow-x:auto;">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right"  style="font-size: 20px;font-family: cursive;color: yellowgreen;">Full Name</td>
        <td width="80%"><label>
          <input name="name" type="text" id="name" size="40" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right"  style="font-size: 20px;font-family: cursive;color: yellowgreen;">Login</td>
        <td width="80%"><label>
          <input name="login" type="text" id="login" size="20" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right"  style="font-size: 20px;font-family: cursive;color: yellowgreen;">Password</td>
        <td width="80%"><label>
          <input name="password" type="password" id="password" size="20" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right"  style="font-size: 20px;font-family: cursive;color: yellowgreen;">Confirm Password</td>
        <td width="80%"><label>
          <input name="cpassword" type="password" id="cpassword" size="20" />
        </label></td>
      </tr>
	  <tr>
        <td align="right"  style="font-size: 20px;font-family: cursive;color: yellowgreen;">Security Question</td>
        <td><label>
          <select name="security" id="security">
          <option value=""></option>
          <option value="What is your school name?">What is your school name?</option>
          <option value="What is your mother's first maiden name?">What is your mother's first maiden name?</option>
          <option value="What is your favourite hobby?">What is your favourite hobby?</option>
          <option value="What is your nick name?">What is your nick name?</option>
          <option value="What is your pet name?">What is your pet name?</option>
          <option value="What is your favourite game?">What is your favourite game?</option>
          </select>
        </label></td>
      </tr>       
      <tr>
        <td width="20%" align="right" style="font-size: 20px;font-family: cursive;color: yellowgreen;">Answer</td>
        <td width="80%"><label>
          <input name="answer" type="text" id="answer" size="40" />
        </label></td>
      </tr>        
      <tr>
        <td align="right"  style="font-size: 20px;font-family: cursive;color: yellowgreen;" >Mobile</td>
        <td><label>
          <input name="mobile" type="text" id="mobile" size="10" />
        </label></td>
      </tr>
      <tr>
        <td align="right"  style="font-size: 20px;font-family: cursive;color: yellowgreen;">Email Id</td>
        <td><label>
          <input name="email" type="text" id="email" size="50" />
        </label></td>
      </tr>
      <tr>
        <td align="right"  style="font-size: 20px;font-family: cursive;color: yellowgreen;">Address</td>
        <td><label>
          <textarea name="address" id="address" cols="64" rows="5"></textarea>
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right"  style="font-size: 20px;font-family: cursive;color: yellowgreen;">City</td>
        <td width="80%"><label>
          <input name="city" type="text" id="city" size="20" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right"  style="font-size: 20px;font-family: cursive;color: yellowgreen;">State</td>
        <td width="80%"><label>
          <input name="state" type="text" id="state" size="20" />
        </label></td>
      </tr>
      <tr>
        <td align="right"  style="font-size: 20px;font-family: cursive;color: yellowgreen;">PinCode</td>
        <td><label>
          <input name="pin" type="text" id="pin" size="6" />
        </label></td>
      </tr>

      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input type="submit" name="button" id="button" value="Register Now" style="padding: 6px 50px; background-color: papayawhip;border: 3px solid burlywood; margin-top: 60px;" onclick="javascript:return validateMyForm();"/>
        </label></td>
      </tr>
    </table>
    </div>
    </form>
    <p><br />
      <br />
    </p>
  </div>
  </div>
  </div><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5879c7c898845558"></script>
</div>
  <?php include_once("template_footer.php");?>  
</body>
</html>
