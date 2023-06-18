				<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

?>
<div class="top-nav">
					<nav class="navbar navbar-default">
				
						<div class="navbar-header">
						  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
							<nav class="fill">
								<ul class="nav navbar-nav">
									<li class="active"><a href="index.php" style="padding:15px 46px;">Home</a></li>
									<li><a href="services.php" style="padding:15px 44px;">Services</a></li>
									<li><a href="list_all_products.php" style="padding:15px 44px;">Products</a></li>
									<li><a href="gallery.php" style="padding:15px 46px;">3D Machine</a></li>
																<?php

if(!isset($_SESSION['user']))
{
 ?>
									<li><a href="user_login.php" style="padding:15px 75px;">Login</a></li>
									<li><a href="user_registration.php" style="padding:15px 73px;">Register</a></li>

									<?php } ?>

<?php
if(isset($_SESSION['user']))
{
 ?>
 									<li><a style="padding:15px 33px;">Welcome <?php echo $_SESSION["user"] ?></a></li>
									<li><a href="logout.php" class="logout" style="padding:15px 42px;">Logout</a></li>
<?php } ?>

								</ul>
							</nav>
						</div>

						<!-- /.navbar-collapse -->
					</nav>
				</div>
				<div class="banner">
					<div class="wmuSlider example1">
						<div class="wmuSliderWrapper">
							<article style="position: absolute; width: 100%; opacity: 0;"> 
								<div class="banner-wrap">
									<div class="banner1">
										<div class="banner1-info">
											<a href="index.php">3dx Print Technologies<span>If you can think it, we can Print it!</span></a>
										</div>
									</div>
								</div>
							</article>
							<article style="position: absolute; width: 100%; opacity: 0;"> 
								<div class="banner-wrap">
									<div class="banner2">
										<div class="banner1-info">
											<a href="index.php">3dx Print Technologies<span>If you can think it, we can Print it!</span></a>
										</div>
									</div>
								</div>
							</article>
							<article style="position: absolute; width: 100%; opacity: 0;"> 
								<div class="banner-wrap">
									<div class="banner3">
										<div class="banner1-info">
											<a href="index.php">3dx Print Technologies<span>If you can think it, we can Print it!</span></a>
										</div>
									</div>
								</div>
							</article>
						</div>
					</div>
							<script src="js/jquery.wmuSlider.js"></script> 
							<script>
								$('.example1').wmuSlider();         
							</script> 
				</div>
	





