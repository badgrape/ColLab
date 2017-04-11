// Triggered on page load

$(function() {
	if (typeof user === 'undefined') {
		$('nav.navbar').load("pageElements.htm #navpublic");
	}
});


$(function() {
	$('#userform').load("pageElements.htm #login");
});

$(function() {
 	$('body').on('click', '#register_', function(){
		$('#userform').load("pageElements.htm #register");
	});

 	$('body').on('click', '#login_', function(){
		$('#userform').load("pageElements.htm #login");
	});

 	$('body').on('click', '#recover_', function(){
		$('#userform').load("pageElements.htm #recover");
	});
});

// Triggered by user request

function userInit(user) {

	$('#userform').hide();
	$('#userstatus').show();
	$("#userstatus .username").html(user['fname'] + "  " + user['lname']);

	if (user['role'] == "teacher") {
		$('nav.navbar').load("pageElements.htm #navteacher");
	}

	else if(user['role'] == "student") {
		$('nav.navbar').load("pageElements.htm #navstudent");
	}

 	$('body').on('click', '#logout_', function(){
		logout();
	});

}
