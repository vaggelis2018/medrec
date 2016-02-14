<?php
	session_start();
	include_once 'php/dbconnect.php';
	if(isset($_SESSION['user'])&&($_COOKIE['type']=="1")){
		$user = $_SESSION['user'];
		$users_query = mysqli_query($sql_link,("SELECT * FROM users WHERE id='$user' LIMIT 1"));
		$profile_query = mysqli_query($sql_link,("SELECT * FROM profile WHERE users_id='$user' LIMIT 1"));
		$office_query = mysqli_query($sql_link,("SELECT * FROM office WHERE users_id='$user' LIMIT 1"));
		$identifications_query=mysqli_query($sql_link,("SELECT * FROM identifications WHERE users_id='$user'"));
		$latlng = mysqli_query($sql_link,("SELECT * FROM markers WHERE users_id = '$user' LIMIT 1"));

		$users_query = mysqli_fetch_array($users_query);
		$profile_query = mysqli_fetch_array($profile_query);
		$office_query = mysqli_fetch_array($office_query);	
		$latlng = mysqli_fetch_array($latlng);
	}
	elseif(isset($_SESSION['user'])&&($_COOKIE['type']=="0")){
		$visit = $_GET['visit'];
		$users_query = mysqli_query($sql_link,("SELECT * FROM users WHERE id='$visit' LIMIT 1"));
		$profile_query = mysqli_query($sql_link,("SELECT * FROM profile WHERE users_id='$visit' LIMIT 1"));
		$office_query = mysqli_query($sql_link,("SELECT * FROM office WHERE users_id='$visit' LIMIT 1"));
		$latlng = mysqli_query($sql_link,("SELECT * FROM markers WHERE users_id = '$visit' LIMIT 1"));

		$users_query=mysqli_fetch_array($users_query);
		$profile_query=mysqli_fetch_array($profile_query);
		$office_query=mysqli_fetch_array($office_query);
		$latlng = mysqli_fetch_array($latlng);	
	}
	else{
		header("Location: index.php");
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">


    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo "".$profile_query['fname'].""?>'s personal profile page</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">       
        <!-- Custom CSS -->
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <!-- map CSS -->
        <link href="css/map.css" rel="stylesheet">
        <!-- chat CSS -->
        <link href="css/chat.css" rel="stylesheet">
        <!-- Custom Fonts css -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

        <!-- jQuery -->
        <script src = "js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script> 
        <!-- login-register-logout js-->
   		<script src="js/register.js"></script>
   		<!-- cancel_account js-->
   		<script src="js/cancel_account.js"></script>
        <!-- scrollable table js-->
        <script src="js/table-fixed-header.js"></script>
        <!--handle requests js-->
        <script src="js/add_doctor.js"></script>
        <!--chat js-->
        <script src="js/chat.js"></script>
        <script>
	        $(document).ready(function(){

				$('.chat_head').click(function(){
					$('.chat_body').slideToggle('slow');
				});
			});
		</script>
		<!--Map-->
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
        <script>
        	$(document).ready(function() {
    

			    var markers1 = [];
			    if('<?php echo $latlng["lat"]; ?>'){
			    	var lat = '<?php echo $latlng["lat"]; ?>';
			    	var lng = '<?php echo $latlng["lng"]; ?>';
			    }
			    else{
			    	var lat = 47.6145;
			    	var lng = -122.3418;
			    }
				var mapCenter = new google.maps.LatLng(lat, lng); //Google map Coordinates
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
							'</span>'+
							'</div></div>');	

							
							//Create an infoWindow
							var infowindow = new google.maps.InfoWindow();
							//set the content of infoWindow
							infowindow.setContent(contentString[0]);


							
						
							//add click listner to save marker button		 
							google.maps.event.addListener(marker, 'click', function() {
									infowindow.open(map,marker); // click on marker opens info window 
						    });
							  
							if(InfoOpenDefault) //whether info window should be open by default
							{
							  infowindow.open(map,marker);
							}
						}
						

						
						

					});
        </script>


    </head>


    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        	<div class="container">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
	                    <i class="fa fa-bars"></i>
	                </button>
	                <a class="navbar-brand page-scroll" href="#page-top">
	                    <i class="fa fa-play-circle"></i>  <span class="light">Go</span> Top
	                </a>
	            </div>
            	<!-- Collect the nav links, forms, and other content for toggling -->
	            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
	                <ul class="nav navbar-nav">
	                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
	                    <li class="hidden">
	                        <a href="#page-top"></a>
	                    </li>
	                    <?php
	                        if(($_COOKIE['type']=="0")){
	                    ?>    	
	                            <li>
	                                <a class="page-scroll" href="patient_page.php">Home</a>
	                            </li> 
	                            <li>
	                                <a class="page-scroll" href="patient_page.php#search">Search</a>
	                            </li>
	                            <li>
	                                <a class="page-scroll" href="#profile">Profile</a>
	                            </li>
	                            <li>
	                                <a class="page-scroll" href="#office">Office</a>
	                            </li>
	                            <li>
	                                <a class="page-scroll" href="#map">Map</a>
	                            </li>
	                            <li id="add_btn"></li>
		                    	<script type="text/javascript">
										$(document).ready(function(){
												
											var visitor_id = '<?php echo $_SESSION["user"]; ?>';
											var host = '<?php echo "$visit"; ?>';       
											$.ajax({
												type:"post",
												url:"php/add.php",
												data: {"visitor_id": visitor_id,"host":host},
												success:function(data){
												    $("#add_btn").html(data);
												}
											});
										});
								</script>  
	                    <?php            
	                        }
	                        else{
	                    ?>    	
	                            <li>
	                                <a class="page-scroll" href="#profile">Profile</a>
	                            </li>
	                            <li>
	                                <a class="page-scroll" href="#office">Office</a>
	                            </li>
	                            <li>
	                                <a class="page-scroll" href="#map">Map</a>
	                            </li>
			                    <li>
			                        <a class="page-scroll" href='#' onclick='logout()' id="logout">LogOut</a>
			                    </li>
			                    <li>
			                        <a class="btn-danger" href='#' onclick='cancel_account()' id="cancel_account">Delete</a>
			                    </li>
	                    <?php	
	                    }
	                    ?>  
	                </ul>
	                <div id="sent"></div>
	            </div>
            	<!-- /.navbar-collapse -->
        	</div>
        <!-- /.container -->
    	</nav>
        <section id="profile" class="content-section profile-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2 col-md-offset-4">
                        <h2>Profile</h2> 
                    </div>
                </div>
                <div class="row">                  
                    <div class="well col-sm-3">
                    	<img src="<?php echo "".$profile_query['image']."" ?>" alt="" style="width:250px;height:250px">
                    </div>
                    <div class="col-sm-4">
                        <blockquote class="well text-muted">
                            <p>
                                <?php
                                        echo "".$profile_query['fname'].$profile_query['last_name'].",<br>".$profile_query['specialities']."";   
                                ?>
                            </p>
                            <small><cite title="Source Title"><?php echo "".$profile_query['haddress'].",<br>".$profile_query['state'].",".$profile_query['country'].",<br>Zip:".$profile_query['zcode'].""; ?>  <i class="glyphicon glyphicon-map-marker"></i></cite></small>
                        </blockquote>
                        <blockquote class="well text-muted">
                            <h4 class="text-center">Contact Information</h4>
                            <p>
                                <i class="glyphicon glyphicon-earphone rel="tooltip" title="Home Phone""></i> <?php echo "".$profile_query['hphone']."" ?>
                                <br/> 
                                <i class="glyphicon glyphicon-print rel="tooltip" title="FAX""></i> <?php echo "".$profile_query['fax']."" ?>
                                <br/> 
                                <i class="glyphicon glyphicon-phone rel="tooltip" title="Cell Phone""></i> <?php echo "".$profile_query['cphone']."" ?>
                                </br>
                                <i class="glyphicon glyphicon-envelope rel="tooltip" title="E-mail""> </i> <?php echo "".$users_query['email']."" ?>
                                <br/> 
                                <i class="glyphicon glyphicon-globe rel="tooltip" title="Website""></i> <a href="<?php echo "".$profile_query['pwebsite']."" ?>"><?php echo "".$profile_query['pwebsite']."" ?></a>
                                <br/> 
                                <i class="glyphicon glyphicon-comment rel="tooltip" title="Available on Chat""></i> </i> <?php echo "".$profile_query['aochat']."" ?>
                                <br/>
                            </p>
                        </blockquote>    
                    </div>
                    <div class="col-sm-4">
                        <blockquote class="well text-muted">
                            <h4 class="text-center">RESUME</h4>
                            <p>                       
                                <i class="glyphicon glyphicon-folder-close rel="tooltip" title="Specialities""> </i> <?php echo "".$profile_query['specialities']."" ?>
                                <br/> 
                                <i class="glyphicon glyphicon-folder-close rel="tooltip" title="Other Specialities""></i> <?php echo "".$profile_query['ospecialities']."" ?>
                                <br/> 
                                <i class="glyphicon glyphicon-file rel="tooltip" title="Education""></i> </i> <?php echo "".$profile_query['edu']."" ?>
                                <br/> 
                                <i class="glyphicon glyphicon-file rel="tooltip" title="Previous Experience""></i> </i> <?php echo "".$profile_query['pe']."" ?>
                                <br/> 
                                <i class="glyphicon glyphicon-file rel="tooltip" title="Services""></i> </i> <?php echo "".$profile_query['services']."" ?>
                            </p>
                        </blockquote> 
                        <?php
	                        if(($_COOKIE['type']=="1")){
	                    ?> 
                        <button onclick="location.href = 'docprofedit.php';" id="myButton" class="btn btn-primary" >Edit</button>
                        <button data-toggle="modal" href="#rModal" data-user="<?php echo "".$_SESSION['user'].""; ?>" onclick="requests(this);" class="btn btn-primary" id="showr">Your Requests</button>
                        <button data-toggle="modal" href="#fModal" data-user="<?php echo "".$_SESSION['user'].""; ?>" onclick="patients(this);" class="btn btn-primary" id="showf">Your Patients</button>
                        <?php } ?>
                    </div>
                </div>
            </div>  
            <div class="modal fade text-muted" id="rModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	            <div class="modal-dialog">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                        <h4 class="modal-title">Your Requests</h4>
	                        <div class='row'>
								<div id='decision'> 
								</div>
							</div>  
	                    </div>
	                    <div class="modal-body">
	                        <div class="row">
	                            <div id="requests"> 
	                            </div>
	                        </div>
	                    </div>                   
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                       	   
	                    </div>
	                </div><!-- /.modal-content -->
	            </div><!-- /.modal-dialog -->
        	</div><!-- /.modal -->  
        	<div class="modal fade text-muted" id="fModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	            <div class="modal-dialog">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                        <h4 class="modal-title">Your Patients</h4>
	                        <div class='row'>
								<div id='delpatient'> 
								</div>
							</div>  
	                    </div>
	                    <div class="modal-body">
	                        <div class="row">
	                            <div id="patients"> 
	                            </div>
	                        </div>
	                    </div>                   
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                       	   
	                    </div>
	                </div><!-- /.modal-content -->
	            </div><!-- /.modal-dialog -->
        	</div><!-- /.modal --> 
        </section>
        <section id="office" class="content-section office-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2 col-md-offset-4 text-muted">
                        <h2>OFFICE</h2> 
                    </div>
                </div>
                <div class="row">
                    <div class="well col-sm-3">
                        <blockquote class="text-muted">
                            <h3><?php echo "".$office_query['oname']."" ?></h3>
                            <p>                                
                                <?php echo "".$office_query['pfservice']."" ?><br>
                                <?php echo "".$office_query['trnumber']."" ?><br>
                                <?php echo "".$office_query['director']."" ?>
                            </p>
                            <small><cite title="Source Title"><?php echo "".$office_query['oaddress'].",<br>".$office_query['state'].",".$office_query['country'].",<br>Zip:".$office_query['ozcode'].""; ?>  <i class="glyphicon glyphicon-map-marker"></i></cite></small>
                        </blockquote>    
                    </div>
                    <div class="col-sm-4">
                        <blockquote class="well text-muted">
                            <h4 class="text-center">Contact Information</h4>
                            <p>                       
                                <i class="glyphicon glyphicon-earphone rel="tooltip" title="Office Phone""></i> <?php echo "".$office_query['ophone']."" ?>
                                <br/> 
                                <i class="glyphicon glyphicon-print rel="tooltip" title="FAX""></i> <?php echo "".$office_query['ofax']."" ?>
                                </br>
                                <i class="glyphicon glyphicon-envelope rel="tooltip" title="E-mail""> </i> <?php echo "".$office_query['oemail']."" ?>
                                <br/> 
                            </p>
                        </blockquote> 
                    </div>
                    <div class="col-sm-5">    
                        <blockquote class="well text-muted">
                            <h4 class="text-center">Availability</h4>
                            <div class="tab-content text-muted"> 
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#monday" data-toggle="tab">Monday</a></li>
                                    <li><a href="#Tuesday" data-toggle="tab">Tuesday</a></li>
                                    <li><a href="#Wednesday" data-toggle="tab">Wednesday</a></li>
                                    <li><a href="#Thursday" data-toggle="tab">Thursday</a></li>
                                    <li><a href="#Friday" data-toggle="tab">Friday</a></li>
                                    <li><a href="#Saturday" data-toggle="tab">Saturday</a></li>
                                    <li><a href="#Sunday" data-toggle="tab">Sunday</a></li>
                                </ul> 
                                <div id="monday" class="tab-pane active">
                                	<?php if(!empty($office_query['amonday'])){list($fmonday,$tmonday) = explode(" ", $office_query['amonday']); ?>
                                	From: <?php echo "".$fmonday.""; ?>
                                	To: <?php echo "".$tmonday.""; } ?>
                                </div>     
                                <div id="Tuesday" class="tab-pane">
                                    <?php if(!empty($office_query['atuesday'])){list($ftuesday,$ttuesday) = explode(" ", $office_query['atuesday']); ?>
                                	From: <?php echo "".$ftuesday.""; ?>
                                	To: <?php echo "".$ttuesday.""; } ?>
                                </div>
                                <div id="Wednesday" class="tab-pane">
                                    <?php if(!empty($office_query['awednesday'])){list($fwednesday,$twednesday) = explode(" ", $office_query['awednesday']); ?>
                                	From: <?php echo "".$fwednesday.""; ?>
                                	To: <?php echo "".$twednesday.""; } ?>
                                </div>    
                                <div id="Thursday" class="tab-pane">
                                    <?php if(!empty($office_query['athursday'])){list($fthursday,$tthursday) = explode(" ", $office_query['athursday']); ?>
                                	From: <?php echo "".$fthursday.""; ?>
                                	To: <?php echo "".$tthursday.""; } ?>
                                </div>
                                <div id="Friday" class="tab-pane">
                                    <?php if(!empty($office_query['afriday'])){list($ffriday,$tfriday) = explode(" ", $office_query['afriday']); ?>
                                	From: <?php echo "".$ffriday.""; ?>
                                	To: <?php echo "".$tfriday.""; } ?>
                                </div>                                         
                                <div id="Saturday" class="tab-pane">
                                    <?php if(!empty($office_query['asaturday'])){list($fsaturday,$tsaturday) = explode(" ", $office_query['asaturday']); ?>
                                	From: <?php echo "".$fsaturday.""; ?>
                                	To: <?php echo "".$tsaturday.""; } ?>
                                </div>
                                <div id="Sunday" class="tab-pane">
                                    <?php if(!empty($office_query['asunday'])){list($fsunday,$tsunday) = explode(" ", $office_query['asunday']); ?>
                                	From: <?php echo "".$fsunday.""; ?>
                                	To: <?php echo "".$tsunday.""; } ?>
                                </div> 
                            </div> 
                        </blockquote>
                        <?php
	                        if(($_COOKIE['type']=="1")){
	                    ?> 
                        <button onclick="location.href = 'docoffedit.php';" id="myButton1" class="btn btn-primary" >Edit</button>
                    </div>  
                    <div class="col-sm-4">
                        <blockquote class="well text-muted">
                            <h4 class="text-center">Your Medrecs</h4>  
                             	<div class="row sfixed-table">
                                    <div class="stable-content">
                                        <table class='table table-striped stable-fixed-header text-muted well' id='mytable'>
                                            <thead>
                                                <tr>
                                                    <th>Full Name</th>
                                                    <th>Medrec ID</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($identifications_query)){ ?>   
                                                <tr>
                                                    <td class="text-center"> 
                                    	                <a href="medrecs.php?medrecid=<?php echo "".$row['medrecid'].""?>"><?php echo "".$row['fname']."" ?></a>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo "".$row['medrecid']."" ?>
                                                    </td>
                                                </tr>       
                                                <?php } ?> 
                                            </tbody> 
                                        </table>
                                    </div>
                                </div>                               
                                <a href="medrecs.php?medrecid=" class="btn btn-primary">Add MEDREC</a>
                        </blockquote> 
                    </div>  
                    <?php } ?>  
                </div>
            </div>  
        </section> 
        <section id="map">  
            <input id="pac-input" class="form-control" type="text" placeholder="Search Box" name="searchbar">
            <div id="google_map" class="text-muted"></div>        
        </section>  
        <!--chat-->  
        <section>
	        <div class="chat_box">
				<div class="chat_head" id="chat_head"> Chat Box</div>
				<div id="online_users" class="chat_body text-muted"></div>
	  		</div>
	  		<div id="openbox"></div>
		</section>




			<script type="text/javascript">

				online_users();

				function online_users(){
					var type = '<?php echo $_COOKIE["type"]; ?>'	
					var user = '<?php echo $_SESSION["user"]; ?>';
					        
					$.ajax({
						type:"post",
						url:"php/chat.php",
						data: {"user": user,"type": type},
						success:function(data){
						    $("#online_users").html(data);
						}
					});
					setTimeout(online_users,3000);
				}
			</script>         
    </body>
</html>    
