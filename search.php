<?php session_start(); ?>
<!DOCTYPE html><html >
<head>
<title>MOOD</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body {
    
    font-family: 'Open Sans', sans-serif;
    background-image: url("advback.jpg");
	
}

.lib-panel {
    margin-bottom: 20Px;
}
.lib-panel img {
    width: 100%;
    background-color: transparent;
}

.lib-panel .row,
.lib-panel .col-md-6 {
    padding: 0;
    background-color: #FFFFFF;
}


.lib-panel .lib-row {
    padding: 0 20px 0 20px;
}

.lib-panel .lib-row.lib-header {
    background-color: #FFFFFF;
    font-size: 20px;
    padding: 10px 20px 0 20px;
}

.lib-panel .lib-row.lib-header .lib-header-seperator {
    height: 2px;
    width: 26px;
    background-color: #d9d9d9;
    margin: 7px 0 7px 0;
}

.lib-panel .lib-row.lib-desc {
    position: relative;
    height: 100%;
    display: block;
    font-size: 13px;
}
.lib-panel .lib-row.lib-desc a{
    position: absolute;
    width: 100%;
    bottom: 10px;
    left: 20px;
}

.row-margin-bottom {
    margin-bottom: 20px;
}

.box-shadow {
    -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,.10);
    box-shadow: 0 0 10px 0 rgba(0,0,0,.10);
}

.no-padding {
    padding: 0;
}

h2{
	color:white;
}



#weather {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
	margin : 40px;
	margin-left: 100px;
}

.wetbtn{
height:100px;
}




  </style>
</head>

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
      <li class="active"><a href="home.php">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Support <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">About Us</a></li>
        </ul>
      </li>
      <li><a href="explore.html">Explore</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="home.php"><span ></span> <?php echo $_SESSION['user']; ?></a></li>
	  <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>      
    </ul>
  </div>
  </div>
</nav>
<?php

   $con = mysqli_connect('localhost', 'root', '','travel_database') or die("Error connecting to database: ".mysqli_error());
   mysqli_select_db($con,'travel_database') or die(mysqli_error($con));
    $query = $_GET['place'];
    $min_length = 3;
     

    if(strlen($query) >= $min_length){

        $query = htmlspecialchars($query);

        
        $query = mysqli_real_escape_string($con,$query);

		$x=0;
        $raw_results = mysqli_query($con,"SELECT * FROM places WHERE type='".$query."'") or die(mysqli_error($con));

        if(mysqli_num_rows($raw_results) > 0){
            while($results = mysqli_fetch_array($raw_results)){
				    $city[$x]=$results['city'];
					$type[$x]=$results['type'];
					$disc[$x]=$results['discription'];
					$image[$x]=$results['image'];
					$x=$x+1;
			        }
						
					 
            

        }
        else{
            echo "No results";
        }

    }
    else{
        echo "Minimum length is ".$min_length;
    }

?>

<div class="container ">
	<div class="row">
		<h2 class="text-center"><?php echo $query ?> </h2> 

	 </div>
		</div>
		

    <hr>
            <div class="row row-margin-bottom">
            <div class="col-md-5 no-padding lib-item" data-category="view">
                <div class="lib-panel">
                    <div class="row box-shadow">
                       <div class="col-md-6">
                            <img class="lib-img-show" src="<?php echo $image[0] ?>">
                        </div>
                        <div class="col-md-6">
                            <div class="lib-row lib-header">
                             <?php echo $city[0] ?>
                                <div class="lib-header-seperator"></div>
                            </div>
                            <div class="lib-row lib-desc">
                              <p> <?php echo $disc[0] ?></p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
			 <div class="col-md-5 no-padding lib-item" data-category="view">
                <div class="lib-panel">
                    <div class="row box-shadow">
                        <div class="col-md-6">
                            <img class="lib-img-show" src="<?php echo $image[1] ?>">
                        </div>
                        <div class="col-md-6">
                            <div class="lib-row lib-header">
                                <?php echo $city[1] ?>
                                <div class="lib-header-seperator"></div>
                            </div>
                            <div class="lib-row lib-desc">
                              <p> <?php echo $disc[1] ?></p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			</div>
			<div class="row row-margin-bottom">
            <div class="col-md-1"></div>
			 <div class="col-md-5 no-padding lib-item" data-category="view">
                <div class="lib-panel">
                    <div class="row box-shadow">
                        <div class="col-md-6">
                            <img class="lib-img-show" src="<?php echo $image[2] ?>">
                        </div>
                        <div class="col-md-6">
                            <div class="lib-row lib-header">
                                <?php echo $city[2] ?>
                                <div class="lib-header-seperator"></div>
                            </div>
                            <div class="lib-row lib-desc">
                              <p> <?php echo $disc[2] ?></p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
			 <div class="col-md-5 no-padding lib-item" data-category="view">
                <div class="lib-panel">
                    <div class="row box-shadow">
                        <div class="col-md-6">
                            <img class="lib-img-show" src="<?php echo $image[3] ?>">
                        </div>
                        <div class="col-md-6">
                            <div class="lib-row lib-header">
                                <?php echo $city[3] ?>
                                <div class="lib-header-seperator"></div>
                            </div>
                            <div class="lib-row lib-desc">
                              <p> <?php echo $disc[3] ?></p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            
        </div>
</div>

	<!--weather-->
<div id="weather" class="center-text" tabindex="-1" role="dialog">
<form class="elements btn-group btn-group-lg" action="wmatch.php" method="get"> 
    <div >
       
      <div class=" elements btn-group btn-group-lg ">
		<form class="elements btn-group btn-group-lg" action="wmatch.php" method="get"> 
        <!-- Cloudy -->
        <button type="submit" class="btn btn-lg btn-danger wetbtn" id="checkweather" name="weather" value="Clouds">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60.7 40" style="enable-background:new 0 0 60.7 40;" xml:space="preserve">
            <g id="Cloud_1">
              <g id="White_cloud_1">
                  <path id="XMLID_2_" class="white" d="M47.2,40H7.9C3.5,40,0,36.5,0,32.1l0,0c0-4.3,3.5-7.9,7.9-7.9h39.4c4.3,0,7.9,3.5,7.9,7.9v0 C55.1,36.5,51.6,40,47.2,40z"/>
                  <circle id="XMLID_3_" class="white" cx="17.4" cy="22.8" r="9.3"/>
                  <circle id="XMLID_4_" class="white" cx="34.5" cy="21.1" r="15.6"/>
                <animateTransform attributeName="transform"
                  attributeType="XML"
                  dur="6s"
                  keyTimes="0;0.5;1"
                  repeatCount="indefinite"
                  type="translate"
                  values="0;5;0"
                  calcMode="linear">
                </animateTransform>
              </g>
              <g id="Gray_cloud_1">
                  <path id="XMLID_6_" class="gray" d="M54.7,22.3H33.4c-3.3,0-6-2.7-6-6v0c0-3.3,2.7-6,6-6h21.3c3.3,0,6,2.7,6,6v0 C60.7,19.6,58,22.3,54.7,22.3z"/>
                  <circle id="XMLID_7_" class="gray" cx="45.7" cy="10.7" r="10.7"/>
                <animateTransform attributeName="transform"
                  attributeType="XML"
                  dur="6s"
                  keyTimes="0;0.5;1"
                  repeatCount="indefinite"
                  type="translate"
                  values="0;-3;0"
                  calcMode="linear">
                </animateTransform>
              </g>
            </g>
          </svg><P>Cloudy</P>
            </button>

        <!-- Rainy -->
        <button type="submit" class="btn btn-lg btn-danger wetbtn" id="checkweather" name="weather" value="Rain">
            
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 55.1 60" style="enable-background:new 0 0 55.1 49.5;" xml:space="preserve">
            <g id="Cloud_2">
                <g id="Rain_2">
                <path id="rain_2_left" class="white" d="M20.7,46.4c0,1.7-1.4,3.1-3.1,3.1s-3.1-1.4-3.1-3.1c0-1.7,3.1-7.8,3.1-7.8 S20.7,44.7,20.7,46.4z"></path>
                    <path id="rain_2_mid" class="white" d="M31.4,46.4c0,1.7-1.4,3.1-3.1,3.1c-1.7,0-3.1-1.4-3.1-3.1c0-1.7,3.1-7.8,3.1-7.8 S31.4,44.7,31.4,46.4z"></path>
                <path id="rain_2_right" class="white" d="M41.3,46.4c0,1.7-1.4,3.1-3.1,3.1c-1.7,0-3.1-1.4-3.1-3.1c0-1.7,3.1-7.8,3.1-7.8 S41.3,44.7,41.3,46.4z"></path>
                <animateTransform attributeName="transform"
                  attributeType="XML"
                  dur="1s"
                  keyTimes="0;1"
                  repeatCount="indefinite"
                  type="translate"
                  values="0 0;0 10"
                  calcMode="linear">
                </animateTransform>
                <animate attributeType="CSS"
                attributeName="opacity"
                attributeType="XML"
                dur="1s"
                keyTimes="0;1"
                repeatCount="indefinite"
                values="1;0"
                calcMode="linear"/>
                </g>
                <g id="White_cloud_2">
                    <path id="XMLID_14_" class="white" d="M47.2,34.5H7.9c-4.3,0-7.9-3.5-7.9-7.9l0,0c0-4.3,3.5-7.9,7.9-7.9h39.4c4.3,0,7.9,3.5,7.9,7.9 v0C55.1,30.9,51.6,34.5,47.2,34.5z"/>
                    <circle id="XMLID_13_" class="white" cx="17.4" cy="17.3" r="9.3"/>
                    <circle id="XMLID_10_" class="white" cx="34.5" cy="15.6" r="15.6"/>
                </g>
            </g>
          </svg>
            <p>Rainy</p>  
        </button>

        <!-- Sunny -->
        <button type="submit" class="btn btn-lg btn-danger wetbtn" id="checkweather" name="weather" value="Sun">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 44.9 44.9" style="enable-background:new 0 0 44.9 44.9;" xml:space="preserve" height="40px" width="40px">
            <g id="Sun">
                <circle id="XMLID_61_" class="yellow" cx="22.4" cy="22.6" r="11"/>
              <g>
                <path id="XMLID_60_" class="yellow" d="M22.6,8.1h-0.3c-0.3,0-0.6-0.3-0.6-0.6v-7c0-0.3,0.3-0.6,0.6-0.6l0.3,0c0.3,0,0.6,0.3,0.6,0.6 v7C23.2,7.8,22.9,8.1,22.6,8.1z"/>
                <path id="XMLID_59_" class="yellow" d="M22.6,36.8h-0.3c-0.3,0-0.6,0.3-0.6,0.6v7c0,0.3,0.3,0.6,0.6,0.6h0.3c0.3,0,0.6-0.3,0.6-0.6v-7 C23.2,37,22.9,36.8,22.6,36.8z"/>
                <path id="XMLID_58_" class="yellow" d="M8.1,22.3v0.3c0,0.3-0.3,0.6-0.6,0.6h-7c-0.3,0-0.6-0.3-0.6-0.6l0-0.3c0-0.3,0.3-0.6,0.6-0.6h7 C7.8,21.7,8.1,21.9,8.1,22.3z"/>
                <path id="XMLID_57_" class="yellow" d="M36.8,22.3v0.3c0,0.3,0.3,0.6,0.6,0.6h7c0.3,0,0.6-0.3,0.6-0.6v-0.3c0-0.3-0.3-0.6-0.6-0.6h-7 C37,21.7,36.8,21.9,36.8,22.3z"/>
                <path id="XMLID_56_" class="yellow" d="M11.4,31.6l0.2,0.3c0.2,0.2,0.2,0.6-0.1,0.8l-5.3,4.5c-0.2,0.2-0.6,0.2-0.8-0.1l-0.2-0.3 c-0.2-0.2-0.2-0.6,0.1-0.8l5.3-4.5C10.9,31.4,11.2,31.4,11.4,31.6z"/>
                <path id="XMLID_55_" class="yellow" d="M33.2,13l0.2,0.3c0.2,0.2,0.6,0.3,0.8,0.1l5.3-4.5c0.2-0.2,0.3-0.6,0.1-0.8l-0.2-0.3 c-0.2-0.2-0.6-0.3-0.8-0.1l-5.3,4.5C33,12.4,33,12.7,33.2,13z"/>
                <path id="XMLID_54_" class="yellow" d="M11.4,13.2l0.2-0.3c0.2-0.2,0.2-0.6-0.1-0.8L6.3,7.6C6.1,7.4,5.7,7.5,5.5,7.7L5.3,7.9 C5.1,8.2,5.1,8.5,5.4,8.7l5.3,4.5C10.9,13.5,11.2,13.5,11.4,13.2z"/>
                <path id="XMLID_53_" class="yellow" d="M33.2,31.9l0.2-0.3c0.2-0.2,0.6-0.3,0.8-0.1l5.3,4.5c0.2,0.2,0.3,0.6,0.1,0.8l-0.2,0.3 c-0.2,0.2-0.6,0.3-0.8,0.1l-5.3-4.5C33,32.5,33,32.1,33.2,31.9z"/>
                <animate attributeType="CSS"
                  attributeName="opacity"
                  attributeType="XML"
                  dur="0.5s"
                  keyTimes="0;0.5;1"
                  repeatCount="indefinite"
                  values="1;0.6;1"
                  calcMode="linear"/>
              </g>
            </g>
          </svg><p>Sunny</p>
        </button>

        <!-- Clear night -->
        <button type="submit" class="btn btn-lg btn-danger wetbtn" id="checkweather" name="weather" value="Clear">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30.8 42.5" style="enable-background:new 0 0 30.8 42.5;" xml:space="preserve" height="40px" width="40px">
            <path id="Moon" class="yellow" d="M15.3,21.4C15,12.1,21.1,4.2,29.7,1.7c-2.8-1.2-5.8-1.8-9.1-1.7C8.9,0.4-0.3,10.1,0,21.9 c0.3,11.7,10.1,20.9,21.9,20.6c3.2-0.1,6.3-0.9,8.9-2.3C22.2,38.3,15.6,30.7,15.3,21.4z"/>
            </svg><p>Clear</p>
        </button>



        <!-- Snowy -->
        <button type="submit" class="btn btn-lg btn-danger wetbtn" id="checkweather" name="weather" value="snow">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 55.1 52.5" style="enable-background:new 0 0 55.1 52.5;" xml:space="preserve">
            <g id="Cloud_7">
              <g id="White_cloud_7">
                  <path id="XMLID_8_" class="white" d="M47.2,34.5H7.9c-4.3,0-7.9-3.5-7.9-7.9l0,0c0-4.3,3.5-7.9,7.9-7.9h39.4c4.3,0,7.9,3.5,7.9,7.9 v0C55.1,30.9,51.6,34.5,47.2,34.5z"/>
                  <circle id="XMLID_5_" class="white" cx="17.4" cy="17.3" r="9.3"/>
                  <circle id="XMLID_1_" class="white" cx="34.5" cy="15.6" r="15.6"/>
              </g>
              <circle class="white" cx="37" cy="43.5" r="3">
                <animateTransform attributeName="transform"
                  attributeType="XML"
                  dur="1.5s"
                  keyTimes="0;0.33;0.66;1"
                  repeatCount="indefinite"
                  type="translate"
                  values="1 -2;3 2; 1 4; 2 6"
                  calcMode="linear">
                </animateTransform>
              </circle>
              <circle class="white" cx="27" cy="43.5" r="3">
                <animateTransform attributeName="transform"
                  attributeType="XML"
                  dur="1.5s"
                  keyTimes="0;0.33;0.66;1"
                  repeatCount="indefinite"
                  type="translate"
                  values="1 -2;3 2; 1 4; 2 6"
                  calcMode="linear">
                </animateTransform>
              </circle>
              <circle class="white" cx="17" cy="43.5" r="3">
                <animateTransform attributeName="transform"
                  attributeType="XML"
                  dur="1.5s"
                  keyTimes="0;0.33;0.66;1"
                  repeatCount="indefinite"
                  type="translate"
                  values="1 -2;3 2; 1 4; 2 6"
                  calcMode="linear">
                </animateTransform>
              </circle>
            </g>
          </svg><p>Snowy</p>
        </button>
		
		 <input type="hidden" name="exp" value="<?php echo $query ?>">

		
		</form>
        </div>
		
    </div>
</body>
</html>


