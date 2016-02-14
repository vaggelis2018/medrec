$(document).ready(function() {

	$("form#medrecs_form").on('submit',function(e){
 	
      e.preventDefault();
  
 
  //grab all form data  
	  var formData = new FormData(this);
	 
	  $.ajax({
	    url: "php/medrecs.php",
	    type: "POST",
	    data: formData,
	    async: false,
	    cache: false,
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
	 
	  return false;
	});
});

function delete_medrec(delete_medrec){

    var medrecid = $(delete_medrec).data('medrecid');

  $.ajax ({
        type:"post",
		url:"php/medrecdelete.php",
		data: {"medrecid": medrecid},
		success:function(data){
		if(data.length>3){
			$("#errors").html(data);
		}
		else{
			window.location.href = "docprofile.php";
			}
		}
	});
        
}	