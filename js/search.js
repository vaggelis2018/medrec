$(document).ready(function(){
	function search(){
        var country = $('#country').val();
        var state = $('#state').val();
        var specialities = $('#specialities').val();
        
        	$.ajax({
        		type:"post",
        		url:"php/search.php",
        		data: {"country": country,"state": state,"specialities": specialities},
        		success:function(data){
        			$("#sresult").html(data);
        		}
        	});
        
	}

	$("#sbutton").click(function(){
		search();
	});
});
