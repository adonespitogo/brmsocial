<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/media-queries.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/jquery.mmenu.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="navigation hidden-xs">
		<div class="container nav-con">
	    	<div class="row">
	   			<div class="col-md-12">
				    <div class="nav-style">
				    	<a><img src='images/brmsocial-logo.png' alt="BRM Social" class="logo"></a>
					    <ul class="nav nav-pills">
					      <li class="dropdown shop">
					        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-th"></i>Shop by Category</a>
					        <ul class="dropdown-menu">
					          <li><a href=""><i class="fa fa-star"></i>Apple /Mac</a></li>
					          <li><a href=""><i class="fa fa-star"></i>Designer</a></li>
					          <li><a href=""><i class="fa fa-star"></i>Developer</a></li>
					          <li><a href=""><i class="fa fa-star"></i>Entrepreneur</a></li>
					          <li><a href=""><i class="fa fa-star"></i>Gamer</a></li>
					          <li><a href=""><i class="fa fa-star"></i>Productivity</a></li>
					        </ul>
					      </li>
					      <li class="dropdown"><a href="#">Free Stuff</a></li>
					    </ul>
				    </div>
				    <div class="login-con">
					    <ul class="">
				          	<li style="padding-left: 15px; padding-right: 15px;border-right: 1px solid #3a3d43;"><a href="javascript:void(0)">Signup</a></li>
				         	<li style="padding-left: 15px;"><a href="javascript:void(0)">Login</a></li>
				           	<li>
				           		<div class="bg-cart">
				            		<span class="cart-dolsign">$</span>
				            		<span class="cart-price totalPrice">17</span>
				            		<i class="fa fa-shopping-cart"></i></span>
				            		<span class="cart-orders totalItem">2</span>
				           		</div>
				           	</li>
					    </ul>
				   </div>
    			</div>
  			</div>
    	</div>
	</div>


	<!-- Mobile View -->
	<div id="mobile-nav" class="visible-xs">
	   	<ul>
		   	<li><a href="#menu" class="mbtn"></a></li>
		   	<li><a href="#"><img src="images/brmsocial-logo.png" alt="BRM Social" style="margin-left:50px;"></a></li>
		   	<li></li>
	    </ul>
        
        <nav id="menu">
			<ul>
				<li><a href="#">Home</a></li>
				<li>
					<a href="javascript:void(0);">Category</a>
					<ul>
						<li><a href="#">Applce/Mac</a></li>
						<li><a href="#">Designer</a></li>
						<li><a href="#">Developer</a></li>
						<li><a href="#">Entrepreneur</a></li>
						<li><a href="#">Gamer</a></li>
						<li><a href="#">Productivity</a></li>
					</ul>
				</li>
				<li><a href="#">Free Stuff</a></li>
				<li><a href="#">Signup</a></li>
				<li><a href="#">Login</a></li>
			</ul>	
		</nav>
    </div>

	<script src='//code.jquery.com/jquery-1.10.2.min.js'></script>
	<script src="js/jquery.mmenu.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	  jQuery(document).ready(function ($) {
	    $('nav#menu').mmenu();
	  });
	</script>
</body>
</html>