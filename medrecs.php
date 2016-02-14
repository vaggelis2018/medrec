<?php
session_start();
if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}

include_once 'php/dbconnect.php';

$medrecid = $_GET['medrecid'];

$sql_identification=("SELECT * FROM identifications WHERE medrecid='$medrecid' LIMIT 1");
$sql_address_primary=("SELECT * FROM addresses WHERE medrecid='$medrecid' AND alternate=false LIMIT 1");
$sql_address_alternate=("SELECT * FROM addresses WHERE medrecid='$medrecid' AND alternate=true LIMIT 1");
$sql_icontacts_primary=("SELECT * FROM icontacts WHERE medrecid='$medrecid' AND alternate=false LIMIT 1");
$sql_icontacts_alternate=("SELECT * FROM icontacts WHERE medrecid='$medrecid' AND alternate=true LIMIT 1");
$sql_insurance=("SELECT * FROM insurances WHERE medrecid='$medrecid' LIMIT 1");

if(empty($medrecid)){
	$sql_mhoptions=("SELECT * FROM mh_options LEFT JOIN mhistory ON mh_options.id=mhistory.mh_options_id");
	$sql_idiseases=("SELECT * FROM dis_options LEFT JOIN indiseases ON dis_options.id=indiseases.dis_options_id");
	$sql_immunizations=("SELECT * FROM im_options LEFT JOIN immunizations ON im_options.id=immunizations.im_options_id");
	$sql_fmhistory=("SELECT * FROM fmh_options LEFT JOIN fmhistory ON fmh_options.id=fmhistory.fmh_options_id");
}else{
	$sql_mhoptions=("SELECT * FROM mh_options LEFT JOIN mhistory ON mh_options.id=mhistory.mh_options_id WHERE medrecid='$medrecid'");
	$sql_idiseases=("SELECT * FROM dis_options LEFT JOIN indiseases ON dis_options.id=indiseases.dis_options_id WHERE medrecid='$medrecid'");
	$sql_immunizations=("SELECT * FROM im_options LEFT JOIN immunizations ON im_options.id=immunizations.im_options_id WHERE medrecid='$medrecid'");
	$sql_fmhistory=("SELECT * FROM fmh_options LEFT JOIN fmhistory ON fmh_options.id=fmhistory.fmh_options_id WHERE medrecid='$medrecid'");
}


$sql_current_status=("SELECT * FROM currentstatus WHERE medrecid='$medrecid' LIMIT 1");

$indentification = mysqli_fetch_array(mysqli_query($sql_link,$sql_identification));
$address_primary = mysqli_fetch_array(mysqli_query($sql_link,$sql_address_primary));
$address_alternate = mysqli_fetch_array(mysqli_query($sql_link,$sql_address_alternate));
$icontacts_primary = mysqli_fetch_array(mysqli_query($sql_link,$sql_icontacts_primary));
$icontacts_alternate = mysqli_fetch_array(mysqli_query($sql_link,$sql_icontacts_alternate));
$insurance = mysqli_fetch_array(mysqli_query($sql_link,$sql_insurance));
$current_status = mysqli_fetch_array(mysqli_query($sql_link,$sql_current_status));

$mh_options = mysqli_query($sql_link,$sql_mhoptions);
$i_diseases = mysqli_query($sql_link,$sql_idiseases);
$immunizations = mysqli_query($sql_link,$sql_immunizations);
$fmhistory = mysqli_query($sql_link,$sql_fmhistory);
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/datepicker.css" rel="stylesheet">
    <link href="css/select.css" rel="stylesheet">
    



    <title>Medical Record</title>
    


    <script src = "js/jquery.js"></script>
    <script src = "js/countries.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/datepicker.js"></script> 
    <script src="js/medrecs.js"></script> 
    <script src="js/select.js" ></script>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" class="medrecs-section" >
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
	                    <li>
	                        <a class="page-scroll" href="docprofile.php#profile">Profile</a>
	                    </li>	                    	
	                    <li>
	                        <a class="page-scroll" href="docprofile.php#office">Office</a>
	                    </li>      
	                    <li>
	                        <a data-medrecid="<?php echo "".$indentification['medrecid'].""; ?>" onclick="delete_medrec(this);" class="btn-danger" href="#">Delete</a>
	                    </li>
	                </ul>
	                <div id="errors"></div>
	            </div>
            	<!-- /.navbar-collapse -->
        	</div>
        <!-- /.container -->
    	</nav>
    <section class="container content-section text-center">
        <form id="medrecs_form">
            <div class="row">
                <div class="col-xs-10"> 
                    <div class="tab-content"> 
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#a" class="tab_link" data-toggle="tab">A.Identification</a></li>
                            <li><a href="#b" class="tab_link" data-toggle="tab">B.Insurance Provider</a></li>
                            <li><a href="#c" class="tab_link" data-toggle="tab">C.Medical History</a></li>
                            <li><a href="#d" class="tab_link" data-toggle="tab">D.Infectious Diseases</a></li>
                            <li><a href="#e" class="tab_link" data-toggle="tab">E.Immunizations</a></li>
                            <li><a href="#f" class="tab_link" data-toggle="tab">F.Family Member History</a></li>
                            <li><a href="#g" class="tab_link" data-toggle="tab">G.Current Status </a></li>
                        </ul> 
                        <div id="a" class="tab-pane active">
                            <div class="row">
                            	<div class="col-xs-4 col-xs-offset-4">
                                	<h3>General Information</h3>
                                	<input type="text" id="textbox" name="medrecid" class="hidden" value="<?php echo "".$indentification['medrecid']."" ?>">
                                	<input type="text" id="textbox" name="userid" class="hidden" value="<?php echo "".$_SESSION['user'].""?>">
                            	</div>  
                            </div>
                            <div class="row">
	                            <div class="row fixed-table">
		                        	<div class="table-content">
		                            	<table class="table table-striped text-muted well" id="mytable">
			                            	<tbody>
			                            		<tr>
                                             		<td colspan="2" class="text-center"><h3>General Information:</h3></td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Full Name:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="fname" class="form-control" value="<?php echo "".$indentification['fname']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Date of Birth:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-4 controls">
                                    						<div id="dob" class="input-group date">
															    <input type="text" name="dob" value="<?php echo "".$indentification['dob']."" ?>" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
															</div>
															<script type="text/javascript">
															    $('#dob').datepicker({
															        format: "yyyy-mm-dd",
															        startView: 1
															    });
															</script>    
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            SEX:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-6 controls">
                                    						<label class="radio-inline">
                                       							<input type="radio" name="sex" id="inlineRadio1" <?php echo ("".$indentification['sex'].""=='Male')?'checked':'' ?> value="Male"> Male
                                    						</label>
                                    						<label class="radio-inline">
                                        						<input type="radio" name="sex" id="inlineRadio2" <?php echo ("".$indentification['sex'].""=='Female')?'checked':'' ?> value="Female"> Female
                                    						</label>
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Blood Type:
			                                        </td>
			                                        <td>
                                						<div class="col-xs-4 controls">
                                    						<input type="text"  name="btype" placeholder="" class="form-control" value="<?php echo "".$indentification['btype']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Height(m):
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-4 controls">
                                    						<select  id="height" name ="height" class="form-control selectpicker" data-size="5" data-live-search="true">
                                    							<?php
    																for( $h= 0.1 ; $h <= 2.99 ; $h+=0.01 ){
																			echo '<option ' .($h == "".$indentification['height']."" ? 'selected=\'selected\'' : '') . ' value="' . $h . '">' . $h.'m</option>';	
																		}
																?>
															</select>
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Weight(kg):
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-4 controls">
                                    						<select id="weight"  name ="weight" class="form-control selectpicker" data-size="5" data-live-search="true">
                                    							<?php
    																for( $w= 1 ; $w <= 300 ; $w+=1 ){
																			echo '<option ' .($w == "".$indentification['weight']."" ? 'selected=\'selected\'' : '') . ' value="' . $w . '">' . $w.'kg</option>';	
																		}
																?>
															</select>
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Occupation:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="occupation" placeholder="" class="form-control" value="<?php echo "".$indentification['occupation']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Languages Spoken:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text"  name="language" placeholder="" class="form-control" value="<?php echo "".$indentification['language']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>	
			                                    <tr>
                                             		<td colspan="2" class="text-center"><h3>Primary Address:</h3></td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Country:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="country" class="form-control" value="<?php echo "".$address_primary['country']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            City:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="city" class="form-control" value="<?php echo "".$address_primary['city']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Zip Code:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="postal_code" class="form-control" value="<?php echo "".$address_primary['postalcode']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Address:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="address" class="form-control" value="<?php echo "".$address_primary['address']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
                                             		<td colspan="2" class="text-center"><h3>Alternate Address:</h3></td>
			                                    </tr>	
			                                    <tr>
			                                        <td>
			                                            Country:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" id="textbox12" name="acountry" placeholder="" class="form-control" value="<?php echo "".$address_alternate['country']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            City:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" id="textbox9" name="acity" placeholder="" class="form-control" value="<?php echo "".$address_alternate['city']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Zip Code:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" id="textbox11" name="apostal_code" placeholder="" class="form-control" value="<?php echo "".$address_alternate['postalcode']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Address:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="aaddress" class="form-control" value="<?php echo "".$address_primary['address']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr> 
			                                    <tr>
                                             		<td colspan="2" class="text-center"><h3>Primary Contact Information:</h3></td>
			                                    </tr> 
			                                    <tr>
			                                    	<td>
			                                            Home Phone:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" id="textbox13" name="hphone" placeholder="" class="form-control" value="<?php echo "".$icontacts_primary['hphone']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Work Phone:
			                                        </td>
			                                        <td>
			                                           <div class="col-xs-8 controls">
                                    						<input type="text" id="textbox14" name="wphone" placeholder="" class="form-control" value="<?php echo "".$icontacts_primary['wphone']."" ?>">
                                						</div>
			                                		</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                    		Cell Phone:
			                                		</td>
			                                		<td>
			                                    		<div class="col-xs-8 controls">
                                    						<input type="text" id="textbox15" name="cphone" placeholder="" class="form-control" value="<?php echo "".$icontacts_primary['cphone']."" ?>">
                                						</div>
			                                		</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                    		FAX:
			                                		</td>
			                                		<td>
			                                    		<div class="col-xs-8 controls">
                                    						<input type="text" id="textbox76" name="fax" placeholder="" class="form-control" value="<?php echo "".$icontacts_primary['fax']."" ?>">
                                						</div>
			                                		</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                    		E-mail:
			                                		</td>
			                                		<td>
			                                    		<div class="col-xs-8 controls">
                                    						<input type="text" id="textbox16" name="email" placeholder="" class="form-control" value="<?php echo "".$icontacts_primary['email']."" ?>">
                                						</div>
			                                		</td>
			                            		</tr>
			                            		<tr>
                                             		<td colspan="2" class="text-center"><h3>Alternate Contact Information:</h3></td>
			                                    </tr> 
			                            		<tr>
			                                		<td>
			                                    		Home Phone:
			                                		</td>
			                                		<td>
			                                    		<div class="col-xs-8 controls">
                                    						<input type="text" id="textbox78" name="ahphone" placeholder="" class="form-control" value="<?php echo "".$icontacts_primary['hphone']."" ?>">
                                						</div>
			                                		</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                    		Work Phone:
			                                		</td>
			                                		<td>
			                                    		<div class="col-xs-8 controls">
                                    						<input type="text" id="textbox14" name="awphone" placeholder="" class="form-control" value="<?php echo "".$icontacts_alternate['wphone']."" ?>">
                                						</div>
			                                		</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                    		Cell Phone:
			                                		</td>
			                                		<td>
			                                   			<div class="col-xs-8 controls">
                                    						<input type="text" id="textbox15" name="acphone" placeholder="" class="form-control" value="<?php echo "".$icontacts_alternate['cphone']."" ?>">
                                						</div>
			                                		</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                   		    FAX:
			                                		</td>
			                                		<td>
			                                    		<div class="col-xs-8 controls">
                                    						<input type="text" id="textbox76" name="afax" placeholder="" class="form-control" value="<?php echo "".$icontacts_alternate['fax']."" ?>">
                                						</div>
			                               			</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                    		E-mail:
			                                		</td>
			                                		<td>
			                                   		    <div class="col-xs-8 controls">
                                    						<input type="text" id="textbox16" name="aemail" placeholder="" class="form-control" value="<?php echo "".$icontacts_alternate['email']."" ?>">
                                						</div>
			                                		</td>
			                            		</tr>                                  
			                       			</tbody>
		                    			</table>
		                    		</div>	  
		                  		</div>
	                  		</div>
                   		</div>                            
                        <div id="b" class="tab-pane">
                        	<div class="row">
                            	<div class="col-xs-4 col-xs-offset-4">
                                	<h3>Insurance Provider</h3>
                            	</div>
                            </div>	
                            <div class="row">
                            	<div class='row fixed-table'>
			                        <div class='table-content'>
			                            <table class='table table-striped text-muted well' id='mytable'>
			                                <tbody>
			                                    <tr>
			                                        <td>
			                                            Insurance Provider Type:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="iptype" class="form-control" value="<?php echo "".$insurance['iptype']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Company Name:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="ipcname" class="form-control" value="<?php echo "".$insurance['ipcname']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Address:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="ipaddress" class="form-control" value="<?php echo "".$insurance['ipaddress']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            City:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="ipcity" class="form-control" value="<?php echo "".$insurance['ipcity']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Zip Code:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="ipzcode" class="form-control" value="<?php echo "".$insurance['ipzcode']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Country:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="ipcountry" class="form-control" value="<?php echo "".$insurance['ipcountry']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Phone:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="ipphone" class="form-control" value="<?php echo "".$insurance['ipphone']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            E-mail Address:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="ipemail" class="form-control" value="<?php echo "".$insurance['ipemail']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Fax:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="ipfax" class="form-control" value="<?php echo "".$insurance['ipfax']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Web Address:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="ipwaddress" class="form-control" value="<?php echo "".$insurance['ipwaddress']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Member(ID) Number:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="ipmnumber" class="form-control" value="<?php echo "".$insurance['ipmnumber']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Social Security No.:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<input type="text" name="ipssnumber" class="form-control" value="<?php echo "".$insurance['ipssnumber']."" ?>">
                                						</div>
			                                        </td>
			                                    </tr>
			                                </tbody>
			                            </table>
			                        </div>    
	                    		</div>       
                            </div>
                        </div>                                         
                        <div id="c" class="tab-pane">
                        	<div class="row">
                            	<div class="col-xs-4 col-xs-offset-4">
                                	<h3>Medical History</h3>
                            	</div>
                            </div>
                            <div class="row fixed-table">
	                            <div class="table-content">
	                                <table class="table table-striped text-muted well" id="mytable">
	                                    <thead>
	                                        <tr>
	                                            <th>Disease</th>
	                                            <th>Date On Set</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                        <?php while($row = mysqli_fetch_array($mh_options)): ?>
	                                        	<tr>
		                                        	<td>
		                                            	<?php echo $row[1]; ?>
		                                        	</td>	                                        	
		                                        	<td>
		                                        		<div class="col-xs-7 controls">
                                    						<div id="<?php echo 'mh_date'.$row[0]; ?>" class="input-group date">
															    <input type="text" name="<?php echo "mh_date[".$row[0]."]"; ?>" placeholder="Date of Onset" value="<?php if(!empty($medrecid)){echo !empty($row['donset']) ? $row['donset'] : '';} ?>" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
															</div>  
														</div>	
															<script type="text/javascript">
																$('#<?php echo "mh_date".$row[0]; ?>').datepicker({
																	format: "yyyy-mm-dd",
																	startView: 1
																});
															</script> 
		                                        	</td>
		                                    	</tr>
	                                        <?php endwhile; ?>
	                                  </tbody>
	                                </table>
	                            </div>
	                        </div>    
                        </div>
                        <div id="d" class="tab-pane">
                        	<div class="row">
                            	<div class="col-xs-4 col-xs-offset-4">
                                	<h3>Infectious Diseases</h3>
                            	</div>
                            </div>	
                            <div class="col-xs-10 col-xs-offset-1">
                                <table class="table table-striped text-muted well">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Disease</th>
                                            <th class="text-center">Age</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_array($i_diseases)): ?>
                                        <tr>
                                            <td><?php echo $row[1]; ?>:</td>
                                            <td>
                                                <div class="controls">
                                                    <select id="<?php echo "ind_age[".$row[0]."]"; ?>"  name ="<?php echo "ind_age[".$row[0]."]"; ?>" class="form-control selectpicker" data-size="5" data-live-search="true">
                                    					<?php
    														for( $ind_age['$row[0]']= 0 ; $ind_age['$row[0]'] <= 110 ; $ind_age['$row[0]']+=1 ){			
															echo '<option '; if(!empty($medrecid)){echo "".($row['age'])."" == $ind_age['$row[0]'] ? 'selected' : '';} echo '>' . $ind_age['$row[0]'].'</option>';			
															}
														?>
													</select>
                                                </div> 
                                            </td>
                                            <td> 
                                    			<div id="<?php echo 'ind_date_'.$row[0]; ?>" class="input-group date">
													<input type="text" name="<?php echo "ind_date_".$row[0]; ?>" placeholder="Date of Onset" value="<?php if(!empty($medrecid)){echo !empty($row['indate']) ? $row['indate'] : '';} ?>" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
												</div>
												<script type="text/javascript">
													$('#<?php echo "ind_date_".$row[0]; ?>').datepicker({
														format: "yyyy-mm-dd",
														startView: 1
													});
												</script> 
                                            </td>
                                            <td>
                                            	<div class="controls">
                                                    <input type="text" name="<?php echo "ind_remarks_".$row[0]; ?>" class="form-control" value="<?php if(!empty($medrecid)){echo !empty($row['remarks']) ? $row['remarks'] : '';} ?>">
                                                </div> 
                                            </td>
                                        </tr>
                                        <?php endwhile; ?> 
                                    </tbody>
                                </table>
                            </div> 
                        </div> 
                        <div id="e" class="tab-pane">
                        	<div class="row">
                            	<div class="col-xs-4 col-xs-offset-4">
                                	<h3>Immunizations</h3>
                            	</div>
                            </div>	
                            <div class="col-xs-15">
                                <table class="table table-striped text-muted well">
                                    <thead>
                                        <tr>
                                             <th></th>
                                             <th colspan=2 class="text-center">Booster 1</th>
                                             <th colspan=2 class="text-center">Booster 2</th>
                                             <th colspan=2 class="text-center">Booster 3</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Immunization for</th>
                                            <th class="text-center">Age</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Age</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Age</th>
                                            <th class="text-center">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_array($immunizations)): ?>
                                        <tr>
                                            <th><?php echo $row[1]; ?>:</th>
                                            <th>
                                                <div class="controls">
		                                        	<select id="<?php echo "im_agea[".$row[0]."]"; ?>"  name ="<?php echo "im_agea[".$row[0]."]"; ?>" class="form-control selectpicker" data-size="5" data-live-search="true">
                                    					<?php
    														for( $im_agea['$row[0]']= 0 ; $im_agea['$row[0]'] <= 110 ; $im_agea['$row[0]']+=1 ){			
															echo '<option '; if(!empty($medrecid)){echo "".($row['agea'])."" == $im_agea['$row[0]'] ? 'selected' : '';} echo '>' . $im_agea['$row[0]'].'</option>';			
															}
														?>
													</select>			
                                                </div> 
                                            </th>
                                            <th>
                                            	<div id="<?php echo 'im_datea_'.$row[0]; ?>" class="input-group date">
													<input type="text" name="<?php echo "im_datea_".$row[0]; ?>" placeholder="Date of Onset" value="<?php if(!empty($medrecid)){echo !empty($row['datea']) ? $row['datea'] : '';} ?>" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
												</div>
												<script type="text/javascript">
													$('#<?php echo "im_datea_".$row[0]; ?>').datepicker({
														format: "yyyy-mm-dd",
														startView: 1
													});
												</script>
                                            </th>
                                            <th>
                                            	<div class="controls">
                                                    <select id="<?php echo "im_ageb_".$row[0]; ?>"  name ="<?php echo "im_ageb_".$row[0]; ?>" class="form-control selectpicker" data-size="5" data-live-search="true">
                                    					<?php
    														for( $im_ageb_['$row[0]']= 0 ; $im_ageb_['$row[0]'] <= 110 ; $im_ageb_['$row[0]']+=1 ){			
															echo '<option '; if(!empty($medrecid)){echo "".($row['ageb'])."" == $im_ageb_['$row[0]'] ? 'selected' : '';} echo '>' . $im_ageb_['$row[0]'].'</option>';			
															}
														?>
													</select>
                                                </div> 
                                            </th>
                                            <th>
                                            	<div id="<?php echo 'im_dateb_'.$row[0]; ?>" class="input-group date">
													<input type="text" name="<?php echo "im_dateb_".$row[0]; ?>" placeholder="Date of Onset" value="<?php if(!empty($medrecid)){echo !empty($row['dateb']) ? $row['dateb'] : '';} ?>" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
												</div>
												<script type="text/javascript">
													$('#<?php echo "im_dateb_".$row[0]; ?>').datepicker({
														format: "yyyy-mm-dd",
														startView: 1
													});
												</script>
                                            </th>
                                            <th>
                                            	<div class="controls">
                                                    <select id="<?php echo "im_agec_".$row[0]; ?>"  name ="<?php echo "im_agec_".$row[0]; ?>" class="form-control selectpicker" data-size="5" data-live-search="true">
                                    					<?php
    														for( $im_agec_['$row[0]']= 0 ; $im_agec_['$row[0]'] <= 110 ; $im_agec_['$row[0]']+=1 ){			
															echo '<option '; if(!empty($medrecid)){echo "".($row['agec'])."" == $im_agec_['$row[0]'] ? 'selected' : '';} echo '>' . $im_agec_['$row[0]'].'</option>';			
															}
														?>
													</select>
                                                </div> 
                                            </th>
                                            <th>
                                            	<div id="<?php echo 'im_datec_'.$row[0]; ?>" class="input-group date">
													<input type="text" name="<?php echo "im_datec_".$row[0]; ?>" placeholder="Date of Onset" value="<?php if(!empty($medrecid)){echo !empty($row['datec']) ? $row['datec'] : '';} ?>" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
												</div>
												<script type="text/javascript">
													$('#<?php echo "im_datec_".$row[0]; ?>').datepicker({
														format: "yyyy-mm-dd",
														startView: 1
													});
												</script>
                                            </th>
                                        </tr>
                                        <?php endwhile; ?> 
                                    </tbody>
                                </table>    
                            </div>
                        </div>
                        <div id="f" class="tab-pane">
                        	<div class="row">
                            	<div class="col-xs-4 col-xs-offset-4">
                                	<h3>Family Member History</h3>
                            	</div>
                            </div>
                            <div class="col-xs-10 col-xs-offset-1">
                                <table class="table table-striped text-muted well">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th class="text-center">Mother</th>
                                            <th class="text-center">Father</th>
                                            <th class="text-center">Sibling(s)</th>
                                            <th class="text-center">Grandparent(s)</th>
                                            <th class="text-center">Children</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_array($fmhistory)): ?>
                                        <tr>
                                            <th><?php echo $row['1']; ?>:</th>
                                            <th>
                                                <div class="controls">
                                                    <input type="text" name="<?php echo "fm_mother[".$row['0']."]"; ?>" class="form-control" value="<?php if(!empty($medrecid)){
		                                        				echo !empty($row['mother']) ? $row['mother'] : '';} ?>">
                                                </div> 
                                            </th>
                                            <th>
                                            	<div class="controls">
                                                    <input type="text" name="<?php echo "fm_father_".$row['0']; ?>" class="form-control" value="<?php if(!empty($medrecid)){
		                                        				echo !empty($row['father']) ? $row['father'] : '';} ?>">
                                                </div> 
                                            </th>
                                            <th>
                                            	<div class="controls">
                                                    <input type="text" name="<?php echo "fm_sibling_".$row['0']; ?>" placeholder="" class="form-control" value="<?php if(!empty($medrecid)){
		                                        				echo !empty($row['siblings']) ? $row['siblings'] : '';} ?>">
                                                </div> 
                                            </th>
                                            <th>
                                            	<div class="controls">
                                                    <input type="text" name="<?php echo "fm_grandparent_".$row['0']; ?>" placeholder="" class="form-control" value="<?php if(!empty($medrecid)){
		                                        				echo !empty($row['grandparents']) ? $row['grandparents'] : '';} ?>">
                                                </div> 
                                            </th>
                                            <th>
                                            	<div class="controls">
                                                    <input type="text" name="<?php echo "fm_children_".$row['0']; ?>" placeholder="" class="form-control" value="<?php if(!empty($medrecid)){
		                                        				echo !empty($row['children']) ? $row['children'] : '';} ?>">
                                                </div> 
                                            </th>
                                        </tr>
                                        <?php endwhile; ?> 
                                    </tbody>
                                </table>    
                            </div>
                        </div>
                        <div id="g" class="tab-pane">
                        	<div class="row">
                            	<div class="col-xs-4 col-xs-offset-4">
                                	<h3>Current Status</h3>
                            	</div>
                            </div>	
                            <div class="row">
                            	<div class='row fixed-table'>
			                        <div class='table-content'>
			                            <table class='table table-striped text-muted well' id='Gtable'>
			                                <tbody>
			                                    <tr>
			                                        <td>
			                                            Diagnosis:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<textarea name="diagnosis" class="form-control"><?php echo "".$current_status['diagnosis']."" ?></textarea>
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Medical Treatment:
			                                        </td>
			                                        <td>
			                                            <div class="col-xs-8 controls">
                                    						<textarea name="m_treatment" class="form-control"><?php echo "".$current_status['mtreatment']."" ?></textarea>
                                						</div>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Medical Treatment(start-end):
			                                        </td>
			                                        <td>
			                                        	<div class="col-xs-8 controls">
				                                            <div class="input-daterange input-group" id="start_end">
														        <input type="text" class="input-sm form-control" name="start" value="<?php echo "".$current_status['start']."" ?>" />
														        <span class="input-group-addon">to</span>
														        <input type="text" class="input-sm form-control" name="end" value="<?php echo "".$current_status['end']."" ?>" />
														    </div>
													    </div>
													    <script type= "text/javascript">
													    	    $('#start_end').datepicker({
													    	    	format: "yyyy-mm-dd",
															        startView: 1
   																});
													    </script>
			                                        </td>
			                                    </tr>
			                                </tbody>
			                            </table>
			                        </div>    
	                    		</div>       
                            </div>
                        </div>                                         
                    </div>  
                </div>
            </div>
            <div class="col-xs-4 col-xs-offset-8">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <div id="errors"></div>
        </form>
        <br>
        <br>
        <br>
        <br>
        <br>
    </section>
</body>
</html>