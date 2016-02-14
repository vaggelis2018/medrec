$(document).ready(function() {

	$("form#profile_data").on('submit',function(e){
 	
      e.preventDefault();
  
 
  //grab all form data  
	  var formData = new FormData(this);
	 
	  $.ajax({
	    url: "php/docprofedit.php",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(data) {
	    	if(data.length>3){
	    		$("#errors").html(data);
	    	}
	    	else{
	    		window.location.href = "docoffedit.php";
	    	}
	    }
	  });
	 
	});
	
	$("form#office_data").on('submit',function(e){
 	
      e.preventDefault();
  
 
  //grab all form data  
	  var formData = new FormData(this);
	 
	  $.ajax({
	    url: "php/docoffedit.php",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(data) {
	    	if(data.length>3){
	    		$("#errors").html(data);
	    	}
	    	else{	
	    		window.location.href = "docprofile.php";
	    	}
	    }
	  });
	 
	});
});
