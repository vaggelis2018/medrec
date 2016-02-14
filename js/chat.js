$(document).ready(function(){
	$('#user').keypress(
    function(e){
        if (e.keyCode == 13) {
            var msg = $(this).val();
            var from = $(this).data('user');
            var to = $(this).data('contact');
            if(msg!=''){
	            $.ajax({
	            	type:"post",
	            	url:"php/chat.php",
	            	data:{"msg" : msg,"from" : from,"to" : to}
	            });
        	}
			$(this).val('');
        }
    });	
});



function openbox(who){
	var pcontact = $(who).data('pcontact');
	var pcontact_username = $(who).data('pcontact_username');
 	var user = $(who).data('user');
 	var attribute = $(who).data('type');
	$.ajax({
		type:"post",
		url:"php/chat.php",
		data: {"pcontact": pcontact,"pcontact_username":pcontact_username,"user":user,"attribute":attribute},
		success:function(data){
			$('#openbox').html(data);
			logs();		
			$('.msg_head').click(function(){
				$('.msg_wrap').slideToggle('slow');
			});		
			$('.close').click(function(){
				$('.msg_box').hide();
			});	
			}
		});
	}

function logs(){
	var pcontact = $('div.msg_body').attr('id');
 	var user = $('div.msg_head').attr('id');
		$.ajax({
			type:"post",
			url:"php/chat.php",
					data:{"contact_id": pcontact,"user_id":user},
					success:function(data){
						$('#logs').html(data);
						$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
					}
				});
	setTimeout(logs,3000);
}

