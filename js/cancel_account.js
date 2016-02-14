function cancel_account(){

   

  $.ajax ({
		url:"php/cancel_account.php",
		success:function(){
			window.location.href = "index.php";
			}
		});
        
}