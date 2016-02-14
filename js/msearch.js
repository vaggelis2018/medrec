$(document).ready(function(){
	function search(){

		var medrecid=$("#search").val();

        if(medrecid!=""){
        	$.ajax({
        		type:"post",
        		url:"php/msearch.php",
        		data: "medrecid="+medrecid,
        		success:function(data){
        			$("#result").html(data);
        		}
        	});
        }
	}

	$("#smbutton").click(function(){
		search();
	});
});
