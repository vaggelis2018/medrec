$(document).ready(function(){
	

	function login(){
        var email1 = $('#email1').val();
        var pass = $('#pass').val();

        if((email1!="")&&(pass!="")){
	        $.ajax({
	        		type:"post",
	        		url:"php/login.php",
	        		data: {"email1": email1,"pass": pass},
	        		success:function(data){
	        			if(data=="doctor"){
	        				window.location.href = "docprofile.php";}
	        			else if(data=="patient"){
	        				window.location.href = "patient_page.php";
	        			}
	        			else{
	        				$("#login_errors").html(data);}
	        		}
	        	});
			}
		}

	function register(){
        var uname = $('#uname').val();
        var email2 = $('#email2').val();
        var upass = $('#upass').val();
        var upass2 = $('#upass2').val();
        var type = $('input[type="radio"]:checked').val();

        
        	$.ajax({
        		type:"post",
        		url:"php/register.php",
        		data: {"uname": uname,"email2": email2,"upass": upass,"upass2": upass2,"type": type},
        		success:function(data){
        			if(data=="doctor"){
        				window.location.href = "docprofedit.php";}
        			else if(data=="patient"){
        				window.location.href = "patient_page.php";
        			}
        			else{
        				$("#register_errors").html(data);}
        		}
        	});
	}

	

	$("#login").click(function(){
		login();
	});
	

	$("#register").click(function(){
		register();
	});
	

});

function logout(){
        
        	$.ajax({
        		url:"php/logout.php",
        		success:function(data){
        			window.location.href = "index.php";
        			
        		}
        	});
        
	}