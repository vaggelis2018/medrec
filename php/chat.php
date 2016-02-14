<script type="text/javascript" src="js/chat.js"></script>
<?php
	include_once "dbconnect.php";
	
	if(isset($_POST['type'])){
		$type = mysqli_real_escape_string($sql_link,$_POST['type']);
		$user = mysqli_real_escape_string($sql_link,$_POST['user']);
		if($type=="1"){
			$friends=mysqli_query($sql_link, "SELECT * FROM users LEFT JOIN friends ON users.id=friends.patient_id WHERE doctor_id='$user' AND status='online'");
			while($row = mysqli_fetch_array($friends)){
				echo "<div class='user' data-pcontact='$row[patient_id]' data-type='$type' data-user='$user' data-pcontact_username='$row[username]' onclick='openbox(this);'>
						$row[username]
					</div>
					<div id='$row[username]'></div>";
			}
		}
		else{
			$friends=mysqli_query($sql_link, "SELECT * FROM users LEFT JOIN friends ON users.id=friends.doctor_id LEFT JOIN profile ON users.id=profile.users_id WHERE patient_id='$user' AND status='online'");
			while($row = mysqli_fetch_array($friends)){
				echo "<div class='user' data-pcontact='$row[doctor_id]' data-type='$type' data-user='$user' data-pcontact_username='$row[last_name]' onclick='openbox(this);'>
						$row[last_name]
					</div>
					<div id='$row[username]'></div>";
			}
		}

	}

	if(isset($_POST['pcontact'])){
		$pcontact_id = mysqli_real_escape_string($sql_link,$_POST['pcontact']);
		$pcontact_username = mysqli_real_escape_string($sql_link,$_POST['pcontact_username']);
		$user = mysqli_real_escape_string($sql_link,$_POST['user']);
		echo "<div id='$pcontact_username' class='msg_box' style='right:290px'>
						<div class='msg_head' id='$user'>$pcontact_username
							<div class='close'>x</div>
						</div>
						<div class='msg_wrap'>
							<div id='$pcontact_id' class='msg_body'>
								<div id='logs'></div>
								<div class='msg_push'></div>
							</div>
							<div class='msg_footer'><textarea id='user' data-user='$user' data-contact='$pcontact_id' class='msg_input text-muted' rows='4'></textarea></div> 
						</div>
					</div>";				
	}

	if(isset($_POST['msg'])){
		$msg = mysqli_real_escape_string($sql_link,$_POST['msg']);
		$from = mysqli_real_escape_string($sql_link,$_POST['from']);
		$to = mysqli_real_escape_string($sql_link,$_POST['to']);
		if(!empty($msg)){
			$send_sql=mysqli_query($sql_link,("INSERT INTO messages(sender,reciever,message) VALUES('$from','$to','$msg')"));
		}
	}
	
	if(isset($_POST['contact_id'])){
		$contact_id = mysqli_real_escape_string($sql_link,$_POST['contact_id']);
		$user_id = mysqli_real_escape_string($sql_link,$_POST['user_id']);
		$sql_msg = mysqli_query($sql_link,("SELECT * FROM messages WHERE (sender='$user_id' AND reciever='$contact_id')||(sender='$contact_id' AND reciever='$user_id')"));
		
		while($row = mysqli_fetch_array($sql_msg)){
			if($row['sender'] == $user_id){
				echo "<div class='msg_b'>$row[message]</div>";
			}
			else{
				echo "<div class='msg_a'>$row[message]</div>";
			}
		}

	}
?>
