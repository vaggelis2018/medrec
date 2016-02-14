<script src="js/add_doctor.js"></script>
<?php

	include_once "dbconnect.php";

	if(isset($_POST['visitor_id'])){
		$visitor_id=mysqli_real_escape_string($sql_link,$_POST['visitor_id']);
		$host = mysqli_real_escape_string($sql_link,$_POST['host']);
	

		$request=mysqli_query($sql_link, "SELECT * FROM requests WHERE doctor='$host' AND patient='$visitor_id' LIMIT 1");
		$foundr = mysqli_num_rows($request);
		$friends=mysqli_query($sql_link, "SELECT * FROM friends WHERE doctor_id='$host' AND patient_id='$visitor_id' LIMIT 1");
		$foundf = mysqli_num_rows($friends);
		if($foundr){
			echo "<button class='btn btn-disable'>Pending</button>";
			}		
		elseif($foundf){
			echo "<button class='btn btn-primary' data-patient_id='$visitor_id' data-doctor_id='$host' onclick='delpatient(this);' >Remove</button>";
		}
		else{
			echo "<button class='btn btn-primary' data-receiver='$host' data-sender='$visitor_id' onclick='add(this);'>Add</button>";
		}
	}



	if(isset($_POST['sender'])){
		$sender=mysqli_real_escape_string($sql_link,$_POST['sender']);
		$receiver=mysqli_real_escape_string($sql_link,$_POST['receiver']);
		$sql="INSERT INTO requests(doctor,patient) VALUES ('$receiver','$sender')";
			$res=mysqli_query($sql_link,$sql);
			echo "A request has been sent";
	}



	if(isset($_POST['user'])){
		$user_id=mysqli_real_escape_string($sql_link,$_POST['user']);
		$requests=mysqli_query($sql_link, "SELECT * FROM users LEFT JOIN requests ON users.id=requests.patient WHERE doctor='$user_id'");
		$found = mysqli_num_rows($requests);
	        if($found){
	        	echo    "<div class='col-xs-12'>
	        	            <div class='row fixed-table'>
	        	            	<div class='table-content'>
	        	            	    <table class='table table-striped text-muted' id='mytable'>
	        	            	    	<tbody>";
	        	            	    		while($row = mysqli_fetch_array($requests)){	        	            	    			
	        	            	    			echo "<tr>
	        	            	    				<td class='text-center'>
	        	            	    					<p>
                                        					$row[username] 
                                        				<p>	                                                            
	        	            	    				</td>
	        	            	    				<td class='text-center'>";
	        	            	    				    $patient_id=$row['id'];
                                        			echo"<button id='accept_btn$row[id]' class='btn btn-primary' data-patient_id='$patient_id' data-doctor_id='$user_id' data-decision='accept' onclick='decision(this);'>
                                        			 Accept</button>
                                        			 <button id='reject_btn$row[id]' class='btn btn-primary' data-patient_id='$patient_id' data-doctor_id='$user_id' data-decision='reject' onclick='decision(this);'>
                                        			 Reject</button>
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
	        	echo "No requests!";
	        }

	}	

	if(isset($_POST['decision'])){

		$decision=mysqli_real_escape_string($sql_link,$_POST['decision']);
		$patient_id=mysqli_real_escape_string($sql_link,$_POST['patient_id']);
		$doctor_id=mysqli_real_escape_string($sql_link,$_POST['doctor_id']);
		
		if($decision=="accept"){		
			$add=mysqli_query($sql_link,("INSERT INTO friends(patient_id,doctor_id) VALUES ('$patient_id','$doctor_id')"));
			$remove=mysqli_query($sql_link,("DELETE FROM requests WHERE patient='$patient_id' AND doctor='$doctor_id' LIMIT 1"));
			if($add){
				echo "Patient Added";
			}
			else{
				echo "Something went wrong";
			}
		}
		else{
			$remove=mysqli_query($sql_link,("DELETE FROM requests WHERE patient='$patient_id' AND doctor='$doctor_id' LIMIT 1"));
			if($remove){
				echo "request rejected";
			}
			else{
				echo "something went wrong";
			}
		}
	}

	if(isset($_POST['patients'])){
		$patients=mysqli_real_escape_string($sql_link,$_POST['patients']);
		$friends=mysqli_query($sql_link, "SELECT * FROM users LEFT JOIN friends ON users.id=friends.patient_id WHERE doctor_id='$patients'");
		$found = mysqli_num_rows($friends);
		if($found){
			echo    "<div class='col-xs-12'>
	        	            <div class='row fixed-table'>
	        	            	<div class='table-content'>
	        	            	    <table class='table table-striped text-muted' id='mytable'>
	        	            	    	<tbody>";
	        	            	    		while($row = mysqli_fetch_array($friends)){
	        	            	    			echo "<tr>
	        	            	    				<td class='text-center'>
	        	            	    					<p>
                                        					$row[username] 
                                        				<p>	                                                            
	        	            	    				</td>
	        	            	    				<td class='text-center'>                                       				
                                        			 	<button id='delete_btn$row[id]' class='btn btn-primary' data-patient_id='$row[patient_id]' data-doctor_id='$row[doctor_id]' onclick='delpatient(this);'>
                                        			 	DELETE</button>
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
	        	echo "No patients added!";
	        }
		}

	if(isset($_POST['doctors'])){
		$doctors=mysqli_real_escape_string($sql_link,$_POST['doctors']);
		$friends=mysqli_query($sql_link, "SELECT * FROM profile LEFT JOIN friends ON users_id=doctor_id WHERE patient_id='$doctors' ");
		$found = mysqli_num_rows($friends);
		if($found){
			echo    "<div class='col-xs-12'>
	        	            <div class='row fixed-table'>
	        	            	<div class='table-content'>
	        	            	    <table class='table table-striped text-muted' id='mytable'>
	        	            	    	<tbody>";
	        	            	    		while($row = mysqli_fetch_array($friends)){
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
                                                            <a href='docprofile.php?visit=$row[users_id]' class='forgot-password'>viewprofile</a>
                                                            <button class='btn btn-primary' data-patient_id='$doctors' data-doctor_id='$row[users_id]' onclick='delpatient(this);' >Remove</button>
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
	        	echo "No doctors added!";
	        }
	}
		
	if(isset($_POST['delpatient'])){
		$delpatient=mysqli_real_escape_string($sql_link,$_POST['delpatient']);
		$doctor_id=mysqli_real_escape_string($sql_link,$_POST['doctor_id']);
		$remove=mysqli_query($sql_link,("DELETE FROM friends WHERE patient_id='$delpatient' AND doctor_id='$doctor_id' LIMIT 1"));
		$messages = mysqli_query($sql_link,("DELETE FROM messages WHERE (sender = '$doctor_id' AND reciever = '$delpatient')||(sender = '$delpatient' AND reciever = '$doctor_id')"));
			if($remove){
				echo "Person deleted!";
			}
			else{
				echo "something went wrong!";
			}
	}
?>
