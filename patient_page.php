<?php
	session_start();
    include_once 'php/dbconnect.php';
    if(isset($_SESSION['user'])&&($_COOKIE['type']=="0")){
    	 $sql=("SELECT * FROM users WHERE id=".$_SESSION['user']);
                $res=mysqli_query($sql_link,$sql);
                $users_query=mysqli_fetch_array($res);
    } 
?>

<html lang="en">


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Patient's Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!-- Map CSS -->
    <link href="css/map.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <!-- chat CSS -->
    <link href="css/chat.css" rel="stylesheet">
    <!-- select css -->
    <link href="css/select.css" rel="stylesheet">


    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- MAP js-->
    <script src="js/indexmap.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <!-- Countries js-->
    <script src="js/countries.js"></script>
    <!-- Search js-->
    <script src="js/msearch.js"></script>
    <script src="js/search.js"></script>
    <!-- scrollable table js-->
    <script src="js/table-fixed-header.js"></script>
    <!--handle requests js-->
    <script src="js/add_doctor.js"></script>
    <!--chat js-->
    <script src="js/chat.js"></script>
    <!--select js-->
    <script src="js/select.js" ></script>
    <!-- login-register-logout -->
   	<script src="js/register.js"></script>
    <!--cancel account -->
    <script src="js/cancel_account.js"></script>
    <script>
	    $(document).ready(function(){

			$('.chat_head').click(function(){
				$('.chat_body').slideToggle('slow');
			});
		});
	</script>

</head>

<body id="page-top" data-spy="scroll" data-target="navbar-fixed-top">
<!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#login">
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
                    <li>
    					<a data-toggle="modal" href="#fModal" data-doctors="<?php echo "".$_SESSION['user'].""; ?>" onclick="doctors(this);" id="showf">Your Doctors</a>
    				</li> 
                    <li>
                        <a class="page-scroll" href="#medrecs">MEDRECS</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#search">Search</a>
                    </li>
                    <li>
                        <a class="page-scroll" href='#' onclick='logout()' id="logout">LogOut</a>
                    </li> 
                    <li>
                        <a class="btn btn-danger" href='#' onclick='cancel_account()' id="cancel_account">Delete</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <nav class="navbar navbar-custom navbar-fixed-left" role="navigation">
    	<div class="collapse navbar-collapse navbar-top navbar-main-collapse">
    		<ul class="nav navbar-nav">
    			
    		</ul>
    	</div>
    </nav>
    <div class="modal fade text-muted" id="fModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			            <h4 class="modal-title">Your Doctors</h4>
			            <div class='row'>
							<div id='delpatient'> 
							</div>
						</div>  
			    </div>
			    <div class="modal-body">
			        <div class="row">
			            <div id="doctors"> 
			            </div>
			        </div>
			    </div>                   
			    <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                       	   
			    </div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal --> 
	<!-- MEDRECS -->
    <section id="medrecs" class="medrecs-section text-center">
        <div class="container">
        	<h2>FIND YOUR MEDREC</h2>
	        <div class="row">
				<div class="col-xs-4 col-xs-offset-4">
					<div class="input-group">
		                <input type="text" class="form-control" id="search" placeholder="Your Medrec ID">
		                <span class="input-group-btn">
					        <input type="button" class="btn btn-primary" id="smbutton" value="Go">
					    </span>
		                
		            </div>    
	            </div>
	            <div class="row">
                    <div class="col-xs-10">
	                    <div id="result"></div>
                    </div> 
	            </div>  
	         </div>
        </div>      
    </section>
    <!--Search -->
    <section id="search" class="container content-section text-center">
        <h2>FIND DOCTORS YOU NEED</h2>
        <div class="row">
            <div class="col-md-6">
                <label class="control-label" for="searchbar">Search with Google map</label>
                <input id="pac-input" class="form-control" type="text" placeholder="Search Box" name="searchbar">
                <div id="google_map" class="text-muted"></div>    
            </div> 
            <br>
            <br>
            <br>
            <br> 
            <div class="col-md-6 text-muted well">
                <label class="control-label">Search our datebase</label>
                <div class="controls">
                    <label class="control-label" for="country">Select Country:</label>
                    <select id="country" name ="country" class="form-control selectpicker"></select>                
                    <label class="control-label" for="state">Select State:</label>                  
                    <select id="state" name ="state" class="form-control selectpicker"></select>
                    <script language="javascript">populateCountries("country", "state");</script>               
                    <label class="control-label" for"specialities">Select Speciality</label>                  
                    <select data-placeholder="" class="form-control selectpicker" id="specialities"name="specialities">
                            <option value=""></option>
                            <option >Addiction psychiatrist</option>
                            <option>Adolescent medicine specialist</option>
                            <option>Allergist (immunologist)</option>
                            <option>Anesthesiologist</option>
                            <option>Cardiac electrophysiologist</option>
                            <option>Cardiologist</option>
                            <option>Cardiovascular surgeon</option>
                            <option>Colon and rectal surgeon</option>
                            <option>Critical care medicine specialist </option>
                            <option>Dentist </option>
                            <option>Dermatologist</option>
                            <option>Developmental pediatrician</option>
                            <option>Emergency medicine specialist</option>
                            <option>Endocrinologist </option>
                            <option>Family medicine physician </option>
                            <option>Forensic pathologist </option>
                            <option>Gastroenterologist  </option>
                            <option>Geriatric medicine specialist </option>
                            <option>Gynecologist </option>
                            <option>Gynecologic oncologist </option>
                            <option>Hand surgeon </option>
                            <option>Hematologist </option>
                            <option>Hepatologist </option>
                            <option>Hospitalist </option>
                            <option>Hospice and palliative medicine specialist </option>
                            <option>Hyperbaric physician </option>
                            <option>Infectious disease specialist </option>
                            <option>Internist </option>
                            <option>Interventional cardiologist </option>
                            <option>Medical examiner </option>
                            <option>Medical geneticist </option>
                            <option>Neonatologist </option>
                            <option>Nephrologist </option>
                            <option>Neurological surgeon </option>
                            <option>Neurologist </option>
                            <option>Nuclear medicine specialist </option>
                            <option>Obstetrician </option>
                            <option>Occupational medicine specialist </option>
                            <option>Oncologist </option>
                            <option>Ophthalmologist </option>
                            <option>Oral surgeon (maxillofacial surgeon) </option>
                            <option>Orthopedic surgeon </option>
                            <option>Otolaryngologist (ear, nose, and throat specialist) </option>
                            <option>Pain management specialist </option>
                            <option>Pathologist </option>
                            <option>Pediatrician </option>
                            <option>Perinatologist </option>
                            <option>Physiatrist </option>
                            <option>Plastic surgeon </option>
                            <option>Psychiatrist </option>
                            <option>Pulmonologist </option>
                            <option>Radiation oncologist </option>
                            <option>Radiologist </option>
                            <option>Reproductive endocrinologist </option>
                            <option>Rheumatologist </option>
                            <option>Sleep disorders specialist </option>
                            <option>Spinal cord injury specialist </option>
                            <option>Sports medicine specialist </option>
                            <option>Surgeon </option>
                            <option>Thoracic surgeon </option>
                            <option>Urologist </option>
                            <option>Vascular surgeon </option>
                    </select>
                    <br>
                    <input type="button" data-toggle="modal" href="#sModal" class="btn btn-primary" id="sbutton" value="Go">
                </div>    
            </div>           
        </div> 
        <br>
        <br>
        <br>
        <br>    
        <!--modal-->
        <div class="modal fade text-muted" id="sModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Your Search Results</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div id="sresult"> 
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
    
    <script language="javascript" type="text/javascript" >
   	 	$(document).ready(function(){
      	// make the header fixed on scroll
      	$('.table-fixed-header').fixedHeader();
    	});
    </script>
  </body>

</html>