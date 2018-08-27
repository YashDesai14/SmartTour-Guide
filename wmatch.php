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
  </style>
         
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBz4OR3CW3gz-9a1QPGqRaTMKaUhqV-aGQ&sensor=false&libraries=places"></script>
        <style type="text/css">
            #map {
                height: 400px;
                width: 600px;
                border: 1px solid #333;
				border-radius: 3px;
                margin-top: 0.6em;
            }
			
			.container{
    display: flex;
    justify-content: center;
    align-items: center;
}
.container{
margin: 4% auto;
}
  body {
    
    font-family: 'Open Sans', sans-serif;
    background-color:#F0F8FF;
	
}
.btn{
	padding : 5px;
}

label{
	padding:5px;
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
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" >Support <span class="caret"></span></a>
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
<h1></h1>


<?php

   $con = mysqli_connect('localhost', 'root', '','travel_database') or die("Error connecting to database: ".mysqli_error());
   mysqli_select_db($con,'travel_database') or die(mysqli_error($con));
    $query = $_GET['weather'];
    $min_length = 3;
    $type = $_GET['exp'];

    if(strlen($query) >= $min_length){

        $query = htmlspecialchars($query);


        $query = mysqli_real_escape_string($con,$query);


        $raw_results = mysqli_query($con,"SELECT * FROM places WHERE type='".$type."'") or die(mysqli_error($con));
        
        if(mysqli_num_rows($raw_results) > 0){
            while($results = mysqli_fetch_array($raw_results)){
				    $city=$results['city'];
                    $url="http://api.openweathermap.org/data/2.5/weather?q=".$city."&units=metric&APPID=ec0a55e034d63207887abd7e1d9c0799";
					
                    $json=file_get_contents($url);
                    $data=json_decode($json,true);
					
					
					if($data['weather'][0]['main']==$query){
					echo '<div style="padding:20px; margin:20px; text-color:white;">';
					echo "<h2>".$results['city']."</h2>";	
					echo '<img src='.$results['image'].' height="150px" width="250px">';
					echo "<p >".$results['discription']."</p><hr>";
					echo "</div>";	 
					
			        }
						
					 
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

   

        <script type="text/javascript">
            $(function(){
                $('.chkbox').click(function(){
                    $(':checkbox').attr('checked',false);
                    $('#'+$(this).attr('id')).attr('checked',true);
                    search_types(map.getCenter());
                });
                
            });
            
            var map;
            var infowindow;
            var markersArray = [];
            var pyrmont = new google.maps.LatLng(20.268455824834792, 85.84099235520011);
            var marker;
            var geocoder = new google.maps.Geocoder();
            var infowindow = new google.maps.InfoWindow();
            // var waypoints = [];                  
            function initialize() {
                map = new google.maps.Map(document.getElementById('map'), {
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    center: pyrmont,
                    zoom: 14
                });
                infowindow = new google.maps.InfoWindow();
                //document.getElementById('directionsPanel').innerHTML='';
                search_types();
               }

            function createMarker(place,icon) {
                var placeLoc = place.geometry.location;
                var marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location,
                    icon: icon,
                    visible:true  
                    
                });
                
                markersArray.push(marker);
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent("<b>Name:</b>"+place.name+"<br><b>Address:</b>"+place.vicinity+"<br><b>Reference:</b>"+place.reference+"<br><b>Rating:</b>"+place.rating+"<br><b>Id:</b>"+place.id);
                    infowindow.open(map, this);
                });
               
            }
            var source="";
            var dest='';
            
            function search_types(latLng){
                clearOverlays(); 
              
                if(!latLng){
                    var latLng = pyrmont;
                }
                var type = $('.chkbox:checked').val();
                var icon = "images/"+type+".png";
                
	 
                var request = {
                    location: latLng,
                    radius: 2000,
                    types: [type] //e.g. school, restaurant,bank,bar,city_hall,gym,night_club,park,zoo
                };
               
                var service = new google.maps.places.PlacesService(map);
                service.search(request, function(results, status) {
                    map.setZoom(14);
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        for (var i = 0; i < results.length; i++) {
                            results[i].html_attributions='';
                            createMarker(results[i],icon);
                        }
                    }
                });
                
             }
            
            
            // Deletes all markers in the array by removing references to them
            function clearOverlays() {
                if (markersArray) {
                    for (i in markersArray) {
                        markersArray[i].setVisible(false)
                    }
                    //markersArray.length = 0;
                }
            }
            google.maps.event.addDomListener(window, 'load', initialize);
            
            function clearMarkers(){
                $('#show_btn').show();
                $('#hide_btn').hide();
                clearOverlays()
            }
            function showMarkers(){
                $('#show_btn').hide();
                $('#hide_btn').show();
                if (markersArray) {
                    for (i in markersArray) {
                        markersArray[i].setVisible(true)
                    }
                     
                }
            }
            
            function showMap(){
                
                var imageUrl = 'http://chart.apis.google.com/chart?cht=mm&chs=24x32&chco=FFFFFF,008CFF,000000&ext=.png';
                var markerImage = new google.maps.MarkerImage(imageUrl,new google.maps.Size(24, 32));
                var input_addr=$('#address').val();
                geocoder.geocode({address: input_addr}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();
                        var latlng = new google.maps.LatLng(latitude, longitude);
                        if (results[0]) {
                            map.setZoom(14);
                            map.setCenter(latlng);
                            marker = new google.maps.Marker({
                                position: latlng, 
                                map: map,
                                icon: markerImage,
                                draggable: true 
                                
                            }); 
                            $('#btn').hide();
                            $('#latitude,#longitude').show();
                            $('#address').val(results[0].formatted_address);
                            $('#latitude').val(marker.getPosition().lat());
                            $('#longitude').val(marker.getPosition().lng());
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                            search_types(marker.getPosition());
                            google.maps.event.addListener(marker, 'click', function() {
                                infowindow.open(map,marker);
                                
                            });
                        
                        
                            google.maps.event.addListener(marker, 'dragend', function() {
                              
                                geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {
                                        if (results[0]) {
                                            $('#btn').hide();
                                            $('#latitude,#longitude').show();
                                            $('#address').val(results[0].formatted_address);
                                            $('#latitude').val(marker.getPosition().lat());
                                            $('#longitude').val(marker.getPosition().lng());
                                        }
                                        
                                        infowindow.setContent(results[0].formatted_address);
                                        var centralLatLng = marker.getPosition();
                                        search_types(centralLatLng);
                                        infowindow.open(map, marker);
                                    }
                                });
                            });
                            
                        
                        } else {
                            alert("No results found");
                        }
                    } else {
                        alert("Geocoder failed due to: " + status);
                    }
                });
                
            }   
           
        </script>
    
       
        <div class="container align-middle text-white" ">
            
                   <input type="checkbox" name="mytype" class="chkbox" id="restaurant"  value="restaurant"/><label for="restaurant" >  Restaurant</label>&nbsp;&nbsp;&nbsp;&nbsp;
              
                    <input type="checkbox" name="mytype" class="chkbox"  id="hospital"  value="hospital"/><label for="hospital" >  Hospital</label>&nbsp;&nbsp;&nbsp;&nbsp;
                 
                    <input type="checkbox" name="mytype"  class="chkbox" id="bus_station"  value="bus_station"/><label for="bus_station" >  Bus Stops</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    
                
                    <input type="checkbox" name="mytype"  class="chkbox" id="atm"  value="atm"/><label for="atm" >  ATM</label>&nbsp;&nbsp;&nbsp;&nbsp;
               
                    <input type="checkbox" name="mytype"  class="chkbox" id="spa"  value="spa"/><label for="spa" >  Spa</label>

               

        </div>
		<div class="container align-middle text-white">
        <label >Address: </label><input id="address"  type="text" style="width:400px;" />
        <input type="button" value="submit" id="btn" onClick="showMap();"/>
        <br/>
		</div>
        <div class="container map" id="map"></div>
        <input type="text" id="latitude" style="display:none;" placeholder="Latitude"/>
        <input type="text" id="longitude" style="display:none;" placeholder="Longitude"/>
       <!-- <input type="button"  id="hide_btn" value="hide markers" onClick="clearMarkers();" />-->
        <input type="button" id="show_btn" value="show  markers" onClick="showMarkers();" style="display:none;" />
        
        <div id="test"></div>
		
		
    </body>

</html>