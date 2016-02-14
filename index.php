<?php
	include_once 'php/dbconnect.php'; 
    session_start(); 
    if(isset($_SESSION['user'])!="" && ($_COOKIE['type']=="1")){
        header("Location: docprofile.php");
    }
    if(isset($_SESSION['user'])!="" && ($_COOKIE['type']=="0")){
        header("Location: patient_page.php");
    }   
?>


<html lang="en">


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MEDREC</title>

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

   
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>    
    <!-- login-register-logout -->
   	<script src="js/register.js"></script>
    

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
                    <i class="fa fa-play-circle"></i>  <span class="light">INSERT</span> MEDREC in your life
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
                        <a class="page-scroll" href="#about">About</a>
                    </li>	
                    <li>
                        <a class="page-scroll" href="#login">Login</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav> 

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">MEDREC</h1>
                        <p class="intro-text">Here Your Life Is Safe With Us</p> 
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div> 
                </div>
            </div>
        </div>
    </header> 
    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div>
                <h2>About MEDREC</h2>
                <p>Purpose of MEDREC is to keep your health records and your medication online and accessible everytime you need them.</p>
                <p>MEDREC also provides you instant communication with your personal doctor in case of queries about your medication or anything else you need to know about your health condition.</p>
                <p>Last but not least MEDERC helps you find useful information about your personal doctor.Phone numbers and Adresses are some them.A google-map also lets you know the location of your personal doctor's office for an easy transition or search for other doctors.</p>
            </div>
        </div>
    </section>
    <!-- Login Section -->
    <section id="login" class="content-section text-center ">
        <div class="login-section text=muted">
            <h2>LOGIN TO MEDREC</h2>
            <div class="container">
    	        <div class="row">
			        <div class="col-md-6 col-md-offset-3">	
			        	<div class="row">		        	
							<div class="form-group">
								<div style="margin-bottom: 25px" class="input-group">
	                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	                                <input type="email" class="form-control" id="email1" placeholder="E-mail">                                        
	                            </div>
							</div>
						</div>
						<div class="row">	
							<div class="form-group">
								<div style="margin-bottom: 25px" class="input-group">
	                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	                                <input type="password" class="form-control" id="pass" placeholder="Password">
	                            </div> 
	                            <div class="row text-muted">
	                           		<div id="login_errors" class="text-danger">
	                        	</div>                         
	                        </div>  
	                    </div> 
	                </div>       
                    <div class="col-sm-6 col-sm-offset-3">                     
						<div class="form-group">
							<div class="row">
								<button type="button" id="login" class="form-control btn btn-login">Log In</button>									
							</div>
							<div class="row">	
								<a data-toggle="modal" href="#rModal" class="form-control btn btn-register">Sign Up</a>
							</div>	
						</div>
					</div>
		        </div>
	        </div>
        </div>
        <!--modal-->
        <div class="modal fade text-muted" id="rModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Be A MEDREC Member</h4>
                    </div>
                    <div class="modal-body">
                        <div class="control-group">
                            <label class="control-label"  for="uname">Username:</label>
                            <div class="controls">
                                <input type="text" id="uname" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="email">Email Adress:</label>
                            <div class="controls">
                                <input type="email" id="email2" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="upass">Password:</label>
                            <div class="controls">
                                <input type="password" id="upass" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"  for="upass2">Password (Confirm)</label>
                            <div class="controls">
                                <input type="password" id="upass2" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="type">Account Type:</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input type="radio" name="type" id="type" value="doctor"> Doctor
                                    </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" id="type" value="patient"> Patient
                                </label>
                            </div>
                            <div class="row">
                            	<div id="register_errors" class="text-danger"> 
                            	</div>
                        	</div>
                        </div>
                    </div>                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="register" class="btn btn-primary">Sign Up</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->        
    </section>
    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact With Medrec</h2>
                <p>Feel free to contact with us<br>Phone:6981130988</p>
                <p><a href="mailto:vaggelis2018@hotmail.gr">vaggelis2018@hotmail.gr</a>
                </p>
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://twitter.com/MEDREC" class="btn btn-info btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                    </li>
                    <li>
                        <a href="https://github.com/IronSummitMedia/MEDREC" class="btn btn-info btn-lg"><i class="fa fa-facebook fa-fw"></i> <span class="network-name">facebook</span></a>
                    </li>
                    <li>
                        <a href="https://plus.google.com/+Startbootstrap/MEDREC" class="btn btn-info btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright Vaggelis Kasapis MEDREC 2015</p>
        </div>
    </footer> 	
    
</body>

</html>

