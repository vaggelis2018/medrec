function add(add){
        var sender = $(add).data('sender');
        var receiver = $(add).data('receiver');
        
        	$.ajax({
        		type:"post",
        		url:"php/add.php",
        		data: {"sender": sender,"receiver": receiver},
        		success:function(data){
        			$("#sent").html(data);
        			$.ajax({
						type:"post",
						url:"php/add.php",
						data: {"visitor_id": sender,"host":receiver},
						success:function(data){
							$("#add_btn").html(data);
						}
					});
        		}
        	});
        
	}

function requests(requests){
        var user = $(requests).data('user');
        
        	$.ajax({
        		type:"post",
        		url:"php/add.php",
        		data: {"user": user},
        		success:function(data){
        			$("#requests").html(data);

        		}
        	});
        
	}	

function decision(made){

        var patient_id = $(made).data('patient_id');
        var doctor_id = $(made).data('doctor_id')
        var decision = $(made).data('decision');
        
        	$.ajax({
        		type:"post",
        		url:"php/add.php",
        		data: {"patient_id": patient_id,"doctor_id": doctor_id,"decision": decision},
        		success:function(data){
        			$("#decision").html(data);
        			var user = $('#user').val();
        
		        	$.ajax({
		        		type:"post",
		        		url:"php/add.php",
		        		data: {"user": user},
		        		success:function(data){
		        			$("#requests").html(data);
		        		}
		        	});

        		}
        	});
        
	}



function patients(who){

        var patients = $(who).data('user');

        
        	$.ajax({
        		type:"post",
        		url:"php/add.php",
        		data: {"patients": patients},
        		success:function(data){
        			$("#patients").html(data);
        			
        		}
        	});
        
	}

function doctors(who){

        var doctors = $(who).data('doctors');

        
        	$.ajax({
        		type:"post",
        		url:"php/add.php",
        		data: {"doctors": doctors},
        		success:function(data){
        			$("#doctors").html(data);
        			
        		}
        	});
        
	}


function delpatient(who){

	var delpatient = $(who).data('patient_id');
	var doctor_id = $(who).data('doctor_id');

        
        	$.ajax({
        		type:"post",
        		url:"php/add.php",
        		data: {"delpatient": delpatient,"doctor_id": doctor_id},
        		success:function(data){
        			$("#delpatient").html(data);
        			var patients = $(who).data('user');

        			$.ajax({
						type:"post",
						url:"php/add.php",
						data: {"visitor_id": delpatient,"host":doctor_id},
						success:function(data){
							$("#add_btn").html(data);
						}
					});
					
					$.ajax({
		        		type:"post",
		        		url:"php/add.php",
		        		data: {"doctors": delpatient},
		        		success:function(data){
		        			$("#doctors").html(data);
		        			
		        		}
		        	});

        
		        	$.ajax({
		        		type:"post",
		        		url:"php/add.php",
		        		data: {"patients": doctor_id},
		        		success:function(data){
		        			$("#patients").html(data);
		        			
		        		}
		        	});
		        	
        		}
        	});
}	