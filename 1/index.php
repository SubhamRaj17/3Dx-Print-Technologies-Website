<!DOCTYPE html>

<html>

<head>

<title>
	Welcome to 3DX PRINT Technologies Upload Section
</title>

<style type="text/css">
#upload_container {
	border-top:#F0F0F0 2px solid;
	background:#FAF8F8;
	padding:10px;
	width:750px;
    height: 600px;
    border: 10px solid cornflowerblue;
}
#upload_container label {
	margin:2px; 
	font-size:1em; 
	font-weight:bold;
	}
.demoInputBox {
	padding:5px; 
	border:#F0F0F0 1px solid; 
	border-radius:4px; 
	background-color:#FFF;
	}
#progress-bar {
	background-color: skyblue;
	height:20px;color: #FFFFFF;
	width:0%;
	-webkit-transition: width .3s;
	-moz-transition: width .3s;
	transition: width .3s;
	}
.btnSubmit {
    background-color: cornflowerblue;
    padding: 10px 40px;
    color: whitesmoke;
    border: skyblue 2px solid;
    border-radius: 4px;
    margin-top: 34px;
	}
#progress-div {
	border:blue 2px solid;
	padding: 5px 0px;
	margin:30px 0px;
	border-radius:4px;
	text-align:center;
	}
#targetLayer {
	width:100%;
	text-align:center;
	}
#targetLayer img {
	border:red 2px solid;
	padding:8px;
	border-radius:8px;
	}
	h1{
		    font-size: 40px;
    font-family: cursive;
    color: whitesmoke;
	}
	body{
		background:url('images/4.jpg');
		background-repeat: no-repeat;
	}
	.BtnPay{
		    padding: 8px 50px;
    background-color: chartreuse;
    color: whitesmoke;
    border: 4px solid royalblue;
	}
</style>
<link rel="icon" type="image/png" href="../images/logo.png" />
<script src="js/code_js.js" type="text/javascript"></script>

<script src="js/code_js1.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() { 
	 $('#upload_container').submit(function(e) {	
		if($('#userImage').val()) {
			e.preventDefault();
			$('#loader-icon').show();
			$(this).ajaxSubmit({ 
				target:   '#targetLayer', 
				beforeSubmit: function() {
				  $("#progress-bar").width('0%');
				},
				uploadProgress: function (event, position, total, percentComplete){	
					$("#progress-bar").width(percentComplete + '%');
					$("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
				},
				success:function (){
					$('#loader-icon').hide();
				},
				resetForm: true 
			}); 
			return false; 
		}
	});
}); 
</script>
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

<center>
<h1>3DX Print Technologies File Upload section</h1>
<form id="upload_container" action="upload.php" method="post">
<div style="    margin-top: 80px;">
<label style="    font-size: 20px; font-family: cursive;color: blue;">Upload your .obj or .stl file</label>
<input name="userImage" id="userImage" type="file" class="demoInputBox" />
</div>
<br />
<div class="container-fluid" style="padding: 20px;">
<label>Please Enter your mobile number . We will get Back to you with our minimum Price Formulae!!!</label>
<br>
<input type="text" name="mobile" id="mobile" style="margin-top: 20px;">
</div>
<div><input type="submit" id="btnSubmit" value="Submit" class="btnSubmit" /></div>
<div id="progress-div"><div id="progress-bar"></div></div>
<div id="targetLayer"></div>
</form>
<div id="loader-icon" style="display:none;"><img src="loading.gif" /></div>
</center>

</body>
</html>