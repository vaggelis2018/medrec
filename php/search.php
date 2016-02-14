<?php
include_once "dbconnect.php";

if(isset($_POST['country'])){   
	$country=($_POST['country']);}
if(isset($_POST['state'])){
	$state = mysqli_real_escape_string($sql_link,$_POST['state']);}
if(isset($_POST['specialities'])){	
    $specialities = ($_POST['specialities']);}

if($country)
	{
		if ((!$state)&&(!$specialities))
		{
	        $sql=mysqli_query($sql_link, "SELECT * FROM profile WHERE country='$country'");
	        $found = mysqli_num_rows($sql);
	        if($found){
	        	echo    "<div class='col-xs-12'>
	        	            <div class='row fixed-table'>
	        	            	<div class='table-content'>
	        	            	    <table class='table table-striped text-muted' id='mytable'>
	        	            	    	<tbody>";
	        	            	    		while($row = mysqli_fetch_array($sql)){
	        	            	    			echo "<tr>
	        	            	    				<td>	        	            	    				    
	        	            	    					<img src='$row[image]' alt='' style='width:150px;height:220px';>	        	            	    				
	        	            	    				</td>
	        	            	    				<td>
	        	            	    					<blockquote class='text-muted>
                            								<p class='text-muted'>
                                        					 	$row[fname]$row[last_name],<br>$row[specialities]  
                                                            </p>
                                                            <small><cite title='Source Title'>$row[haddress],<br>$row[state],$row[country],<br>Zip:$row[zcode] <i class='glyphicon glyphicon-map-marker'></i></cite></small>
                                                            <br>
                                                            <a href='docprofile.php?visit=$row[id]' class='forgot-password'>view profile</a>
                                                        </blockquote>                      
	        	            	    				</td>
	        	            	    			</tr>";
	        	            	    		}
	        	            	    	echo "</tbody>
	        	            	    </table>
	        	            	</div>
                            </div>
	        	        </div>";
	        }
            else{
            	echo "No resulsts match with your parametres.";
            }
        }
        if(($state)&&(!$specialities))
        {
        	$sql=mysqli_query($sql_link, "SELECT * FROM profile WHERE country='$country' AND state='$state'");
            $found = mysqli_num_rows($sql);
	        if($found){
	        	echo    "<div class='col-xs-12'>
	        	            <div class='row fixed-table'>
	        	            	<div class='table-content'>
	        	            	    <table class='table table-striped text-muted' id='mytable'>
	        	            	    	<tbody>";
	        	            	    		while($row = mysqli_fetch_array($sql)){
	        	            	    			echo "<tr>
	        	            	    				<td>	        	            	    				    
	        	            	    					<img src='$row[image]' alt='' style='width:150px;height:220px';>	        	            	    				
	        	            	    				</td>
	        	            	    				<td>
	        	            	    					<blockquote class='text-muted>
                            								<p class='text-muted'>
                                        					 	$row[fname],$row[last_name],<br>$row[specialities]  
                                                            </p>
                                                            <small><cite title='Source Title'>$row[haddress],<br>$row[state],$row[country],<br>Zip:$row[zcode] <i class='glyphicon glyphicon-map-marker'></i></cite></small>
                                                            <br>
                                                            <a href='docprofile.php?visit=$row[id]' class='forgot-password'>viewprofile</a>
                                                        </blockquote>                      
	        	            	    				</td>
	        	            	    			</tr>";
	        	            	    		}
	        	            	    	echo "</tbody>
	        	            	    </table>
	        	            	</div>
                            </div>
	        	        </div>";
	        }
            else{
            	echo "No resulsts match with your parametres.";
            }
        }
        if($state&&$specialities)
        {
        	$sql=mysqli_query($sql_link,"SELECT * FROM profile WHERE country='$country' AND state='$state' AND specialities LIKE '%$specialities%'");
	        $found = mysqli_num_rows($sql);
	        if($found){
	        	echo    "<div class='col-xs-12'>
	        	            <div class='row fixed-table'>
	        	            	<div class='table-content'>
	        	            	    <table class='table table-striped text-muted' id='mytable'>
	        	            	    	<tbody>";
	        	            	    		while($row = mysqli_fetch_array($sql)){
	        	            	    			echo "<tr>
	        	            	    				<td>	        	            	    				    
	        	            	    					<img src='$row[image]' alt='' style='width:150px;height:220px';>	        	            	    				
	        	            	    				</td>
	        	            	    				<td>
	        	            	    					<blockquote class='text-muted>
                            								<p class='text-muted'>
                                        					 	$row[fname],$row[last_name],<br>$row[specialities]  
                                                            </p>
                                                            <small><cite title='Source Title'>$row[haddress],<br>$row[state],$row[country],<br>Zip:$row[zcode] <i class='glyphicon glyphicon-map-marker'></i></cite></small>
                                                            <br>
                                                            <a href='docprofile.php?visit=$row[id]' class='forgot-password'>viewprofile</a>
                                                        </blockquote>                      
	        	            	    				</td>
	        	            	    			</tr>";
	        	            	    		}
	        	            	    	echo "</tbody>
	        	            	    </table>
	        	            	</div>
                            </div>
	        	        </div>";
	        }
            else{
            	echo "No resulsts match with your parametres.";
            }
        }
        if((!$state)&&($specialities))	
        {
        	$sql=mysqli_query($sql_link,"SELECT * FROM profile WHERE country='$country' AND specialities LIKE '%$specialities%'");
	        $found = mysqli_num_rows($sql);
	        if($found){
	        	echo    "<div class='col-xs-12'>
	        	            <div class='row fixed-table'>
	        	            	<div class='table-content'>
	        	            	    <table class='table table-striped text-muted' id='mytable'>
	        	            	    	<tbody>";
	        	            	    		while($row = mysqli_fetch_array($sql)){
	        	            	    			echo "<tr>
	        	            	    				<td>	        	            	    				    
	        	            	    					<img src='$row[image]' alt='' style='width:150px;height:220px';>	        	            	    				
	        	            	    				</td>
	        	            	    				<td>
	        	            	    					<blockquote class='text-muted>
                            								<p class='text-muted'>
                                        					 	$row[fname],$row[last_name],<br>$row[specialities]  
                                                            </p>
                                                            <small><cite title='Source Title'>$row[haddress],<br>$row[state],$row[country],<br>Zip:$row[zcode] <i class='glyphicon glyphicon-map-marker'></i></cite></small>
                                                            <br>
                                                            <a href='docprofile.php?visit=$row[id]' class='forgot-password'>viewprofile</a>
                                                        </blockquote>                      
	        	            	    				</td>
	        	            	    			</tr>";
	        	            	    		}
	        	            	    	echo "</tbody>
	        	            	    </table>
	        	            	</div>
                            </div>
	        	        </div>";
	        }
            else{
            	echo "No resulsts match with your parametres.";
            }
        }	 
	}
	else
	{
		echo "Please Select Country";
	}  
	 
?>