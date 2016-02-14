<?php
session_start();
include_once 'php/dbconnect.php';
if(!isset($_SESSION['user'])||isset($_COOKIE['type'])=='0' )
{
	header("Location: index.php");
}
$sql=("SELECT * FROM office WHERE users_id=".$_SESSION['user']);
$res=mysqli_query($sql_link,$sql);
$userRow=mysqli_fetch_array($res);
?>



<!doctype html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link href="css/map.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/timepicker.css" rel="stylesheet">
    <link href="css/select.css" rel="stylesheet">



    <title>Edit Your Office</title>
    

    
    <script src = "js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script src = "js/countries.js"></script>
    <script src="js/profile_office.js" ></script> 
    <script src="js/timepicker.js" ></script> 
    <script src="js/select.js" ></script>
    <script>
		$(document).ready(function() {
		    

		    var markers1 = [];
			var mapCenter = new google.maps.LatLng(47.6145, -122.3418); //Google map Coordinates
			var map;
			
			
			
			//############### Google Map Initialize ##############
			function map_initialize()
			{
					var googleMapOptions = 
					{ 
						center: mapCenter, // map center
						zoom: 17, //zoom level, 0 = earth view to higher value
						maxZoom: 18,
						minZoom: 16,
						zoomControlOptions: {
						style: google.maps.ZoomControlStyle.SMALL //zoom control size
					},
						scaleControl: true, // enable scale control
						mapTypeId: google.maps.MapTypeId.ROADMAP // google map type
					};
				
				   	map = new google.maps.Map(document.getElementById("google_map"), googleMapOptions);			
					
					//Load Markers from the XML File, Check (map_process.php)
					$.get("php/map_process.php", function (data) {
						$(data).find("marker").each(function () {
							  var name 		= $(this).attr('name');
							  var address 	= '<p>'+ $(this).attr('address') +'</p>';
							  var type 		= $(this).attr('type');
							  var point 	= new google.maps.LatLng(parseFloat($(this).attr('lat')),parseFloat($(this).attr('lng')));
							  create_marker(point, name, address, false, false, false, "icons/pin_blue.png");
						});
					});	
					
					//Right Click to Drop a New Marker
					google.maps.event.addListener(map, 'rightclick', function(event) {
						//Edit form to be displayed with new marker
						var EditForm = '<p><div class="marker-edit">'+
						'<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">'+
						'<label for="pName"><span>Place Name :</span><input type="text" name="pName" class="save-name" placeholder="Enter Title" maxlength="40" /></label>'+
						'<label for="pDesc"><span>Description :</span><textarea name="pDesc" class="save-desc" placeholder="Enter Description" maxlength="150"></textarea></label>'+
						'<label for="pType"><span>Type :</span> <select name="pType" class="save-type"><option value="office">Office</option><option value="hospital">Hospital</option></select></label>'+
						'</form>'+
						'</div></p><button name="save-marker" class="save-marker">Save Marker Details</button>';

						//Drop a new Marker with our Edit Form
						create_marker(event.latLng, 'New Marker', EditForm, true, true, true, "icons/pin_green.png");
					});
			        

			        // Create the search box and link it to the UI element.
		            var input = /** @type {HTMLInputElement} */(
		            document.getElementById('pac-input'));
		            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

		            var searchBox = new google.maps.places.SearchBox(
		            /** @type {HTMLInputElement} */(input));

		            // [START region_getplaces]
		            // Listen for the event fired when the user selects an item from the
		            // pick list. Retrieve the matching places for that item.
		            google.maps.event.addListener(searchBox, 'places_changed', function() {
		                var places = searchBox.getPlaces();

		                if (places.length == 0) {
		                    return;
		                }
		                for (var i = 0, marker1; marker1 = markers1[i]; i++) {
		                    marker1.setMap(null);
		                }

		                // For each place, get the icon, place name, and location.
		                markers1 = [];
		                var bounds = new google.maps.LatLngBounds();
		                for (var i = 0, place; place = places[i]; i++) {
		                    var image = {
		                        url: place.icon,
		                        size: new google.maps.Size(71, 71),
		                        origin: new google.maps.Point(0, 0),
		                        anchor: new google.maps.Point(17, 34),
		                        scaledSize: new google.maps.Size(25, 25)
		                    };

		                   // Create a marker for each place.
		                    var marker1 = new google.maps.Marker({
		                        map: map,
		                        icon: image,
		                        title: place.name,
		                        position: place.geometry.location
		                    });

		                    markers1.push(marker1);

		                    bounds.extend(place.geometry.location);
		                }

		                    map.fitBounds(bounds);
		                });
		                // [END region_getplaces]

		                // Bias the SearchBox results towards places that are within the bounds of the
		                // current map's viewport.
		                google.maps.event.addListener(map, 'bounds_changed', function() {
		                    var bounds = map.getBounds();
		                    searchBox.setBounds(bounds);
		                });									
		            }
			
					google.maps.event.addDomListener(window, 'load', map_initialize);
					//############### Create Marker Function ##############
					function create_marker(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, Removable, iconPath)
					{	  	  		  
						
						//new marker
						var marker = new google.maps.Marker({
							position: MapPos,
							map: map,
							draggable:DragAble,
							animation: google.maps.Animation.DROP,
							icon: iconPath
						});
						
						//Content structure of info Window for the Markers
						var contentString = $('<div class="marker-info-win">'+
						'<div class="marker-inner-win"><span class="info-content">'+
						'<h1 class="marker-heading">'+MapTitle+'</h1>'+
						MapDesc+ 
						'</span><button name="remove-marker" class="remove-marker" title="Remove Marker">Remove Marker</button>'+
						'</div></div>');	

					
					//Create an infoWindow
					var infowindow = new google.maps.InfoWindow();
					//set the content of infoWindow
					infowindow.setContent(contentString[0]);

					//Find remove button in infoWindow
					var removeBtn 	= contentString.find('button.remove-marker')[0];
					var saveBtn 	= contentString.find('button.save-marker')[0];

					//add click listner to remove marker button
					google.maps.event.addDomListener(removeBtn, "click", function(event) {
						remove_marker(marker);
					});
					
					if(typeof saveBtn !== 'undefined') //continue only when save button is present
					{
						//add click listner to save marker button
						google.maps.event.addDomListener(saveBtn, "click", function(event) {
							var mReplace = contentString.find('span.info-content'); //html to be replaced after success
							var mName = contentString.find('input.save-name')[0].value; //name input field value
							var mDesc  = contentString.find('textarea.save-desc')[0].value; //description input field value
							var mType = contentString.find('select.save-type')[0].value; //type of marker
							var mUser_id = '<?php echo $_SESSION["user"]; ?>';		
							if(mName =='' || mDesc =='')
							{
								alert("Please enter Name and Description!");
							}else{
								save_marker(marker, mName, mDesc, mType, mUser_id, mReplace); //call save marker function
							}
						});
					}
					
					//add click listner to save marker button		 
					google.maps.event.addListener(marker, 'click', function() {
							infowindow.open(map,marker); // click on marker opens info window 
				    });
					  
					if(InfoOpenDefault) //whether info window should be open by default
					{
					  infowindow.open(map,marker);
					}
				}
				
				//############### Remove Marker Function ##############
				function remove_marker(Marker)
				{
					
					/* determine whether marker is draggable 
					new markers are draggable and saved markers are fixed */
					if(Marker.getDraggable()) 
					{
						Marker.setMap(null); //just remove new marker
					}
					else
					{
						//Remove saved marker from DB and map using jQuery Ajax
						var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
						var myData = {del : 'true', latlang : mLatLang}; //post variables
						$.ajax({
						  type: "POST",
						  url: "php/map_process.php",
						  data: myData,
						  success:function(data){
								Marker.setMap(null); 
								alert(data);
							},
							error:function (xhr, ajaxOptions, thrownError){
								alert(thrownError); //throw any errors
							}
						});
					}

				}
				
				//############### Save Marker Function ##############
				function save_marker(Marker, mName, mAddress, mType, mUser_id, replaceWin)
				{
					//Save new marker using jQuery Ajax
					var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
					var myData = {name : mName, address : mAddress, latlang : mLatLang, type : mType, user_id : mUser_id }; //post variables
					console.log(replaceWin);		
					$.ajax({
					  type: "POST",
					  url: "php/map_process.php",
					  data: myData,
					  success:function(data){
							replaceWin.html(data); //replace info window with new html
							Marker.setDraggable(false); //set marker to fixed
							Marker.setIcon('icons/pin_blue.png'); //replace icon
			            },
			            error:function (xhr, ajaxOptions, thrownError){
			                alert(thrownError); //throw any errors
			            }
					});
				}

			});
    </script>

    


    



</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" class="register-section" >
    <section id="profile" class="container content-section text-center">
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="#page-top">
                        <i class="fa fa-play-circle"></i>  <span class="light">Go</span>  Top
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#od">OFFICE DATA</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#cd">Location&Contact Details</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#submit">Submit</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        <!-- /.container -->
        </nav> 

        <div class="row">
            <h2>Edit Your Office</h2>
        </div>
        <form id="office_data">  
        	<input type="text" name="user_id" class="hidden" value="<?php echo "".$_SESSION['user']."" ?>">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4" id="od">
                    <br>
                    <br>
                    <h3>OFFICE DATA</h3>
                </div> 
            </div>    
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
                    <label class="control-label" for="oname">Office Name:</label>
                    <div class="controls">
                        <input type="text" name="oname" class="form-control" value="<?php echo "".$userRow['oname']."" ?>">
                    </div>
                </div>
            </div>   
            <div class="row"> 
                <div class="col-xs-4 col-xs-offset-4">
                    <label class="control-label" for="pfservice">Tax Office/Public Fiscal Service:</label>
                    <div class="controls">
                        <input type="text" name="pfservice" class="form-control" value="<?php echo "".$userRow['pfservice']."" ?>">
                    </div>
                </div>
            </div>
            <div class="row">    
                <div class="col-xs-4 col-xs-offset-4">
                    <label class="control-label" for="trnumber">Tax Registration Number:</label>
                    <div class="controls">
                        <input type="text" name="trnumber" class="form-control" value="<?php echo "".$userRow['trnumber']."" ?>">
                    </div>
                </div>
            </div>
            <div class="row">    
                <div class="col-xs-4 col-xs-offset-4">
                    <label class="control-label" for="director">Director:</label>
                    <div class="controls">
                        <input type="text" name="director" class="form-control" value="<?php echo "".$userRow['director']."" ?>">
                    </div>
                </div>
            </div>
            <div class="row">            
                <div class="col-xs-4 col-xs-offset-4" id="cd">
                    <br>
                    <br>
                    <h3>LOCATION AND CONTACT DETAILS</h3>
                </div>       
            </div>
            <div class="row">         
                <div class="col-xs-4 col-xs-offset-4">
                    <label class="control-label" for="country">Select Country:</label>
                    <div class="controls">
                        <select id="country" name ="country" class="form-control selectpicker"></select>
                    </div>
                </div>  
            </div>
            <div class="row">          
                <div class="col-xs-4 col-xs-offset-4">
                    <label class="control-label" for="state">Select State:</label>
                    <div class="controls">
                        <select id="state" name ="state" class="form-control selectpicker"></select>
						<script type="text/javascript">
                            $(document).ready(function () {
                               	populateCountries("country", "state")
                            });
                        </script> 
                    </div>
                </div>
            </div>
            <div class="row">            
                <div class="col-xs-4 col-xs-offset-4">
                    <label class="control-label" for="oaddress">Office Address:</label>
                    <div class="controls">
                        <input type="text" name="oaddress" class="form-control" value="<?php echo "".$userRow['oaddress']."" ?>">
                    </div>
                </div> 
            </div>
            <div class="row">    
                <div class="col-xs-4 col-xs-offset-4">
                    <label class="control-label" for="ozcode">Office Zip Code:</label>
                    <div class="controls">
                        <input type="text" name="ozcode" class="form-control" value="<?php echo "".$userRow['ozcode']."" ?>">
                    </div>
                </div>   
            </div>
            <div class="row">    
                <div class="col-xs-4 col-xs-offset-4">
                    <label class="control-label" for="ophone">Office Phone:</label>
                    <div class="controls">
                        <input type="tel" name="ophone" class="form-control" value="<?php echo "".$userRow['ophone']."" ?>">
                    </div>
                </div>
            </div>
            <div class="row">               
                <div class="col-xs-4 col-xs-offset-4">
                    <label class="control-label" for="ofax">Office FAX:</label>
                    <div class="controls">
                        <input type="tel" name="ofax" class="form-control" value="<?php echo "".$userRow['ofax']."" ?>">
                    </div>
                </div>  
            </div>
            <div class="row">           
                <div class="col-xs-4 col-xs-offset-4">
                    <label class="control-label" for="oemail">Office E-mail::</label>
                    <div class="controls">
                        <input type="email" name="oemail" class="form-control" value="<?php echo "".$userRow['oemail']."" ?>">
                    </div>
                </div> 
            </div>  
            <div class="row">             
                <div class="col-xs-4 col-xs-offset-4"> 
                    <div class="tab-content"> 
                        <label for="ul" >Availability</label>
                        <ul class="nav nav-tabs">
                            <li class="active"><a class="tab_link" href="#mondey" data-toggle="tab">Monday</a></li>
                            <li><a class="tab_link" href="#Tuesday" data-toggle="tab">Tuesday</a></li>
                            <li><a class="tab_link" href="#Wednesday" data-toggle="tab">Wednesday</a></li>
                            <li><a class="tab_link" href="#Thursday" data-toggle="tab">Thursday</a></li>
                            <li><a class="tab_link" href="#Friday" data-toggle="tab">Friday</a></li>
                            <li><a class="tab_link" href="#Saturday" data-toggle="tab">Saturday</a></li>
                            <li><a class="tab_link" href="#Sunday" data-toggle="tab">Sunday</a></li>
                        </ul> 
                        <div id="mondey" class="tab-pane active">
                            <label class="control-label" for="fmonday">From:</label>
                            <div class="input-group clockpicker">
                            	<?php if(!empty($userRow['amonday'])){list($fmonday,$tmonday) = explode(" ", $userRow['amonday']);} ?>
							    <input type="text" id="fmonday" name="fmonday" class="form-control" value="<?php if (isset($fmonday)){ echo "".$fmonday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span> 
							</div>    
							<label class="control-label" for="fmonday">To:</label>
							<div class="input-group clockpicker">   
							    <input type="text" id="tmonday" name="tmonday" class="form-control" value="<?php if (isset($tmonday)){ echo "".$tmonday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span>
							</div>
							<script type="text/javascript">
								$('.clockpicker').clockpicker();
							</script>
                        </div>     
                        <div id="Tuesday" class="tab-pane">
                            <label class="control-label" for="ftuesday">From:</label>
                            <div class="input-group clockpicker">
                            	<?php if(!empty($userRow['atuesday'])){list($ftuesday,$ttuesday) = explode(" ", $userRow['atuesday']);} ?>
							    <input type="text" id="ftuesday" name="ftuesday" class="form-control" value="<?php if (isset($ftuesday)){ echo "".$ftuesday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span> 
							</div>    
							<label class="control-label" for="ttuesday">To:</label>
							<div class="input-group clockpicker">   
							    <input type="text" id="ttuesday" name="ttuesday" class="form-control" value="<?php if (isset($ttuesday)){ echo "".$ttuesday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span>
							</div> 
							<script type="text/javascript">
								$('.clockpicker').clockpicker();
							</script>
                        </div>
                        <div id="Wednesday" class="tab-pane">
                            <label class="control-label" for="fawednesday">From:</label>
                            <div class="input-group clockpicker">
                            	<?php if(!empty($userRow['awednesday'])){list($fwednesday,$twednesday) = explode(" ", $userRow['awednesday']);} ?>
							    <input type="text" id="fwednesday" name="fwednesday" class="form-control" value="<?php if (isset($fwednesday)){ echo "".$fwednesday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span> 
							</div>    
							<label class="control-label" for="twednesday">To:</label>
							<div class="input-group clockpicker">   
							    <input type="text" id="twednesday" name="twednesday" class="form-control" value="<?php if (isset($twednesday)){ echo "".$twednesday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span>
							</div> 
							<script type="text/javascript">
								$('.clockpicker').clockpicker();
							</script>
                        </div>    
                        <div id="Thursday" class="tab-pane">
                            <label class="control-label" for="fthursday">From:</label>
                            <div class="input-group clockpicker">
                            	<?php if(!empty($userRow['athursday'])){list($fthursday,$tthursday) = explode(" ", $userRow['athursday']);} ?>
							    <input type="text" id="fthursday" name="fthursday" class="form-control" value="<?php if (isset($fthursday)){ echo "".$fthursday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span> 
							</div>    
							<label class="control-label" for="tthursday">To:</label>
							<div class="input-group clockpicker">   
							    <input type="text" id="tthursday" name="tthursday" class="form-control" value="<?php if (isset($tthursday)){ echo "".$tthursday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span>
							</div> 
							<script type="text/javascript">
								$('.clockpicker').clockpicker();
							</script>
                        </div>
                        <div id="Friday" class="tab-pane">
                            <label class="control-label" for="ffriday">From:</label>
                            <div class="input-group clockpicker">
                            	<?php if(!empty($userRow['afriday'])){list($ffriday,$tfriday) = explode(" ", $userRow['afriday']);} ?>
							    <input type="text" id="ffriday" name="ffriday" class="form-control" value="<?php if (isset($ffriday)){ echo "".$ffriday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span> 
							</div>    
							<label class="control-label" for="tfriday">To:</label>
							<div class="input-group clockpicker">   
							    <input type="text" id="tfriday" name="tfriday" class="form-control" value="<?php if (isset($tfriday)){ echo "".$tfriday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span>
							</div> 
							<script type="text/javascript">
								$('.clockpicker').clockpicker();
							</script>
                        </div>                                         
                        <div id="Saturday" class="tab-pane">
                            <label class="control-label" for="fsaturday">From:</label>
                            <div class="input-group clockpicker">
                            	<?php if(!empty($userRow['asaturday'])){list($fsaturday,$tsaturday) = explode(" ", $userRow['asaturday']);} ?>
							    <input type="text" id="fsaturday" name="fsaturday" class="form-control" value="<?php if (isset($fsaturday)){ echo "".$fsaturday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span> 
							</div>    
							<label class="control-label" for="tsaturday">To:</label>
							<div class="input-group clockpicker">   
							    <input type="text" id="tsaturday" name="tsaturday" class="form-control" value="<?php if (isset($tsaturday)){ echo "".$tsaturday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span>
							</div> 
							<script type="text/javascript">
								$('.clockpicker').clockpicker();
							</script>
                        </div>
                        <div id="Sunday" class="tab-pane">
                            <label class="control-label" for="fsunday">From:</label>
                            <div class="input-group clockpicker">
                            	<?php if(!empty($userRow['asunday'])){list($fsunday,$tsunday) = explode(" ", $userRow['asunday']);} ?>
							    <input type="text" id="fsunday" name="fsunday" class="form-control" value="<?php if (isset($fsunday)){ echo "".$fsunday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span> 
							</div>    
							<label class="control-label" for="tsunday">To:</label>
							<div class="input-group clockpicker">   
							    <input type="text" id="tsunday" name="tsunday" class="form-control" value="<?php if (isset($tsunday)){ echo "".$tsunday."";}?>">
							    <span class="input-group-addon">
							        <span class="glyphicon glyphicon-time"></span>
							    </span>
							</div> 
							<script type="text/javascript">
								$('.clockpicker').clockpicker();
							</script>
                        </div> 
                    </div>    
                </div>  
                <div class="col-md-4 col-md-offset-4">
                    <hr>
                </div>              
            </div>
            <div id="submit" class="row"> 
	            <div class="col-xs-4 col-xs-offset-8">
	                <input type="submit" class="btn btn-primary" value="Submit">
	            </div>  
	        </div>    
        </form>   
        <br> 
        <br>
        <div class="col-md-6 col-md-offset-3" id="ms">
            <label class="control-label" for="searchbar">Right Click to Drop a New Marker</label>
            <div class="controls">
                <input id="pac-input" class="form-control" type="text" placeholder="Search Box" name="searchbar">
                <div id="google_map" class="text-muted"></div>
            </div>    
        </div> 
        <br>
        <br>
        <br>
    </section>  
    <br>
    <br> 
    <br>
    <br>
    <br>
    <br>
    <br>        
</body>            