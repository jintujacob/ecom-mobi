$(document).ready(function() {

	$('#logmein').click(function () {		
		
		alert('im in');
		var username = $('input[name=username]');
		var password = $('input[name=password]');
		
		alert(username.val() + '- '+ password.val());
		
		if (username.val()=='') {
			return false;
		} 
		if (password.val()=='') {
			return false;
		} 

		var data = 	'action=' + 'doLogin' +
					'&username=' + username.val() +
					'&password=' + password.val() +
					'&type=consumer' ;
					
		var serviceurl = '../services/accesscontrolaction.php' ;
		var targeturl  = '../index.html' ;	  			
		$.ajax({
			url: serviceurl ,	
			type: "POST",
			data: data,		
			success: function (result) {
				if(result == "TRUE"){				
					$.mobile.changePage(
						targeturl 
						//{ transition: "slideup"} 
					);
				}
				else if(result == "FALSE"){		
					$('#loginerrorwarning').append(
						"username and password doesn't matched. Please try again."
					);
				}
			}			
		});
		return false;
	});
	
	/*
	
	$('#logsellerin').click(function () {		
		
		var username = $('input[name=username]');
		
		if (username.val()=='') {
			return false;
		} 
		
		var data = 	'action=' + 'doLogin' +
					'&username=' + username.val() +
					'&type=S' ;
		
		$.ajax({
			url: "./actionhandler/accesscontrolaction.php",	
			type: "POST",
			data: data,		
			success: function (result) {
				if(result == true){				
					$.mobile.changePage(
						"./sellerchat.html#chattechadvice", 
						{ transition: "slideup"} 
					);
				}	
			}		
		});
		return false;
	});
	*/
	

});	


