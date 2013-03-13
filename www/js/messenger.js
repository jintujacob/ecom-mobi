$(document).ready(function() {
	
	var pageid =  $('.ui-page-active').attr('id');
	
	//setInterval("getUnreadMessages()",5000);
	
	$('#submitchat').click(function () {		
		var message = $('textarea[name=chatmessage]');
		var data = 	'action=' + 'doAddMessage' +
					'&message=' + message.val();
		
		$('.loading').show();

		$.ajax({
			url: "./actionhandler/chataction.php",	
			type: "GET",
			data: data,		
			success: function (html) {				
				showUnreadMessage("me", message.val(), "" );
				$('textarea[name=chatmessage]').val(null);
			}		
		});
		
		//cancel the submit button default behaviours
		return false;
	});
	
	
	/*
	$('#getonlinesellerlist').click(function () {		
		var data = 	'action=' + 'viewOnlineAdmins' ;
	
		$.ajax({
			url: "./actionhandler/chataction.php",	
			type: "GET",
			data: data,		
			success: function (result) {				
				var resObj = jQuery.parseJSON(result);
				for(var i = 0; i < resObj.length; i++){
					showOnlineUsers(resObj[i].username);
				}
			}		
		});
	});
	*/
	
});	

function getUnreadMessages(){
	var data = 	'action=' + 'getUnreadMessages' ;
	
	$.ajax({
		url: "./actionhandler/chataction.php",	
		type: "GET",
		data: data,		
		success: function (result) {				
			var resObj = jQuery.parseJSON(result);
			for(var i = 0; i < resObj.length; i++){
				showUnreadMessage(resObj[i].sender, resObj[i].message, resObj[i].time);
			}
		}		
	});
}
	
function showUnreadMessage(sender, message, time ){
	$('#chathistory tr:last').after(
		'<tr>'+
			'<td><b>'+ sender  + ':</b></td>' +
			'<td>'+ message + '</td>'	+
		'</tr>'
	);
	
}



function showOnlineUsers(username){
	$('#onlinesellerslist').append(
		'<div><a href="#chattechadvice">' + 
			username +
		'</a></div>'
	);	
}

