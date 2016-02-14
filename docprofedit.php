<?php
session_start();
include_once 'php/dbconnect.php';
if(!isset($_SESSION['user'])||isset($_COOKIE['type'])=='0' )
{
	header("Location: index.php");
}
$sql=("SELECT * FROM profile WHERE users_id=".$_SESSION['user']);
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
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/select.css" rel="stylesheet">



    <title>Edit Your Profile</title>
    


    <script src = "js/jquery.js"></script>
    <script src = "js/countries.js"></script>
    <script src="js/bootstrap.js" ></script> 
    <script src="js/profile_office.js" ></script> 
    <script src="js/select.js" ></script> 
   


    



</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" class="register-section " >
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
                            <a class="page-scroll" href="#cd">Location&Contact</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#rs">Resume&Servises</a>
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
            <h2>Edit your profile</h2>
        </div>
                <form id="profile_data">
                	<input type="text" name="user_id" class="hidden" value="<?php echo "".$_SESSION['user']."" ?>">
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label"  for="fname">First Name:</label>
                            <div class="controls">
                                <input type="text" name="fname" class="form-control" value="<?php echo "".$userRow['fname']."" ?>">
                            </div>
                    	</div>        
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label"  for="last_name">Last Name:</label>
                            <div class="controls">
                                <input type="text"  name="last_name" class="form-control" value="<?php echo "".$userRow['last_name']."" ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label"  for="fileToUpload">Select image to upload:</label>
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-primary btn-file">
                                            Browse&hellip; <input type="file" name="uploaded_file" id="fileToUpload">
                                        </span>
                                    </span>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">   
                        <div class="col-xs-4 col-xs-offset-4" id="cd">
                            <br>
                            <br>
                            <h3>Location And Contact Details</h3>
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
                            <label class="control-label"  for="haddress">Home Adress:</label>
                            <div class="controls">
                                <input type="text" name="haddress" class="form-control" value="<?php echo "".$userRow['haddress']."" ?>">
                            </div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label"  for="zcode">Zip Code:</label>
                            <div class="controls">
                                <input type="text"  name="zcode" class="form-control" value="<?php echo "".$userRow['zcode']."" ?>">
                            </div>
                        </div>
                    </div>  
                    <div class="row">  
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label"  for="hphone">Home Phone:</label>
                            <div class="controls">
                                <input type="tel"  name="hphone" class="form-control" value="<?php echo "".$userRow['hphone']."" ?>">
                            </div>
                        </div>
                    </div>  
                    <div class="row">  
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label"  for="fax">FAX:</label>
                            <div class="controls">
                                <input type="tel"  name="fax" class="form-control" value="<?php echo "".$userRow['fax']."" ?>">
                            </div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label"  for="cphone">Cell Phone:</label>
                            <div class="controls">
                                <input type="tel"  name="cphone" class="form-control" value="<?php echo "".$userRow['cphone']."" ?>">
                            </div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label"  for="pwebsite">Personal Website:</label>
                            <div class="controls">
                                <input type="url"  name="pwebsite" placeholder="https://" class="form-control" value="<?php echo "".$userRow['pwebsite']."" ?>">
                            </div>
                        </div>
                    </div>  
                    <div class="row">  
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label"  for="aochat">Available On Chat:</label>
                            <div class="controls">
                                <textarea  name="aochat" class="form-control"><?php echo "".$userRow['aochat']."" ?></textarea>
                            </div>
                        </div>
                    </div>  
                    <div class="row">  
                        <div class="col-xs-4 col-xs-offset-4" id="rs">
                            <br>
                            <br>
                            <h3>RESUME AND SERVICES</h3>
                        </div>
                    </div>   
                    <div class="row"> 
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label" for"specialities[]">Select Speciality</label>
                            <div class="controls">
                                <select  multiple class="form-control selectpicker" name="specialities[]">
                                    <option value=""></option>
                                    <option <?php if("".$userRow['specialities'].""!='') echo "selected"; ?>><?php echo "".$userRow['specialities']."" ?></option>
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
                            </div>    
                        </div>
                    </div>    
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label"  for="ospecialities">Other Specialities:</label>
                            <div class="controls">
                                <textarea  name="ospecialities" class="form-control"><?php echo "".$userRow['ospecialities']."" ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label"  for="edu">Education:</label>
                            <div class="controls">
                                <textarea  name="edu" class="form-control"><?php echo "".$userRow['edu']."" ?></textarea>
                            </div>
                        </div>
                    </div>   
                    <div class="row"> 
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label"  for="pe">Previous Experience:</label>
                            <div class="controls">
                                <textarea name="pe" class="form-control"><?php echo "".$userRow['pe']."" ?></textarea>
                            </div>
                        </div>
                    </div> 
                    <div class="row">   
                        <div class="col-xs-4 col-xs-offset-4">
                            <label class="control-label"  for="services">Services:</label>
                            <div class="controls">
                                <textarea name="services" class="form-control"><?php echo "".$userRow['services']."" ?></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>    
                    <div id="submit" class="row">
                    	<div id="errors" class="text-danger"></div>
	                    <div class="col-xs-4 col-xs-offset-8">
	                        <input type="submit" class="btn btn-primary" value="Submit">
	                    </div> 
	                </div>    
                </form>            
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>     
    </section>
</body>
</html>
    