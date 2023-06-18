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
<!-- js -->
<link rel="icon" type="image/png" href="images/logo.png" />
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Syncopate:400,700' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
<style>
    .thumbnail {
      padding: 0 0 15px 0;
      border: none;
      border-radius: 0;
  }
  .thumbnail p {
      margin-top: 15px;
      color: #555;
  }
  .btn {
      padding: 10px 20px;
      background-color: peru;
      color: #f1f1f1;
      border-radius: 0;
      transition: .2s;
      margin-top: 30px;
  }
  .btn:hover, .btn:focus {
      border: 1px solid #333;
      background-color: #fff;
      color: #000;
  }

</style>
</head>
  
<body>
<div class="banner-body" >
<div class="container" >
<div class="banner-body-content" > 

  <?php include_once("template_header.php");
    if (isset($_GET['success'])){
      echo "Successful Registration.";
  }
    if (isset($_GET['userloginsuccess'])){
      echo "Successful Login.";
  }
  if (isset($_GET['resetsuccess'])){
      echo "Password Successfully Changed.";
  }
  ?>
 <div id="tour" class="bg-1">
  <div class="container">
    <h3 class="text-center" style="    margin-top: 100px;margin-bottom: 70px; font-size: 35px;color: saddlebrown; font-family: cursive;">OWNERS OF 3Dx Print Technologies</h3>

    
    <div class="row text-center">
          <div class="col-sm-6">
        <div class="thumbnail">
          <img src="images/Subham.jpg" alt="Subham Choudhury" width="400" height="300" style="    height: 512px; border: 4px solid #756515;;">
          <p><strong>Subham Choudhury</strong></p>
          <p>Founer & CEO</p>
          <p>3Dx Print Technologies</p>
          <button class="btn"><a href="https://subhamraj.github.io/SubhamChoudhury/" style="color: white;">View Profile</a></button>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="thumbnail">
          <img src="images/pnayak.jpg" alt="Prashant Nayak" width="400" height="300" style="    height: 512px; border: 4px solid #756515;">
          <p><strong>Prashant Nayak</strong></p>
          <p>Co-Founder & Managing Director</p>
          <p>3Dx Print Technologies</p>
          <button class="btn"><a href="https://www.facebook.com/nawab.e.nayak/" style="color: white;">View Profile</a></button>
        </div>
      </div>


    </div>
  </div>
  

</div>



  </div>
  </div>
  </div>

    <?php include_once("template_footer.php");?>
  </body>
  </html>