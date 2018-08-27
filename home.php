<?php session_start(); ?>
<!DOCTYPE html>
<html>
<title>MOOD</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="weather.js"></script>
  <style>
.navbar{
margin:0px;
}

.container{
    display: flex;
    justify-content: center;
    align-items: center;
}
.container{
margin: 4% auto;
}
#icon {
max-width: 200px;
margin: 5% auto;

}
.wetbtn{
width:500px
height:300px;
}
.elements{
background-color:white;
}

</style>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	  <span class="icon-bar"></span>
	  <span class="icon-bar"></span>
	  <span class="icon-bar"></span>
	  </button>
      <a class="navbar-brand" href="home.php">TRAVEL</a>
    </div>
	<div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#index.html">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Support <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">About Us</a></li>
        </ul>
      </li>
      <li><a href="explore.html">Explore</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
	  <li><a href="home.html"><span ></span> <?php echo $_SESSION['user']; ?></a></li>
	  <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
  </div>
</nav>
<!-- login page -->

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	  <div class="modal-dialog">
				<div class="loginmodal-container">
					<h1>Login to Your Account</h1><br>
				  <form method="post" action="CheckUserLogin.php">
					<input type="text" name="user" placeholder="Username">
					<input type="password" name="pass" placeholder="Password">
					<input type="submit" name="login" class="login loginmodal-submit" value="Login">
				  </form>
					
				  <div class="login-help">
					<a href="register.html">Register</a> 
				  </div>
				</div>
			</div>
		  </div>
<!-- image slider -->

<div id="theCarousel" class="carousel slide " data-ride="carousel">

  <!-- Define how many slides to put in the carousel -->
  <ol class="carousel-indicators">
    <li data-target="#theCarousel" data-slide-to="0" class="active"> </li >
    <li data-target="#theCarousel" data-slide-to="1"> </li>
    <li data-target="#theCarousel" data-slide-to="2"> </li>
  </ol >
 
  <!-- Define the text to place over the image -->
  <div class="carousel-inner" role="listbox">
    <div class="item active" >
    <div class ="slide1"></div>
	<img src="spiritual.jpg" height="50%" width="100%">
    <div class="carousel-caption">
      
	  
    </div>
  </div>
  <div class="item">
  <div class="slide2"></div>
  <img src="heritage.jpg">
  <div class="carousel-caption">
  
  </div>
  </div>
  <div class="item">
  <div class="slide3"></div>
  <img src="adventure.jpg">
  <div class="carousel-caption">
  
  </div>
  </div>
  </div>
 
  <!-- Set the actions to take when the arrows are clicked -->
  <a class="left carousel-control" href="#theCarousel" data-slide="prev">
  <span class="glyphicon glyphicon-chevron-left"> </span>
  </a>
  <a class="right carousel-control" href="#theCarousel" data-slide="next">
  <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
  </div>
<br>
<!--experiences-->


<div class="container text-center">
	<form class="elements btn-group btn-group-lg " method="get" action="search.php">
	
	<div class="row">
		<div class="col-sm-3">
		<button type="submit" class="btn btn-lg btn-default wetbtn" id="placetype" name="place" value="heritage">
		<img src="heritagelogo.jpg" width="150px" height="150px" id="icon">
		<h3>HERITAGE</h3>
		</button>
		
		</div>
		<div class="col-sm-3">
		<button type="submit" class="btn btn-lg btn-default wetbtn" id="placetype" name="place" value="adventure">
		<img src="adventurelogo.png" width="150px" height="150px" id="icon">
		<h3>ADVENTURE</h3>
		</button>
		
		</div>
		<div class="col-sm-3">
		<button type="submit" class="btn btn-lg btn-default wetbtn" id="placetype" name="place" value="spiritual">
		<img src="spirituatlogo.jpg" width="150px" height="150px" id="icon">
		<h3>SPIRITUAL</h3>
        </button>
		
		</div>
		<div class="col-sm-3">
		<button type="submit" class="btn btn-lg btn-default wetbtn" id="placetype" name="place" value="luxury">
		<img src="luxurylogo.png" width="150px" height="150px" id="icon">
		<h3>LUXURY</h3>
		</button>
		</div>
		</div>
	</form>
</div>


</body>
    <script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


</html>
