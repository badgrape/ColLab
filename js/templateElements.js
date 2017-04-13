// Triggered on page load

$(function() {
	if (typeof user === 'undefined') {
		$('nav.navbar').load("staticElements.htm #navpublic");
	}
});


$(function() {
	$('#userform').load("staticElements.htm #login");
});

$(function() {
 	$('body').on('click', '#register_', function(){
		$('#userform').load("staticElements.htm #register");
	});

 	$('body').on('click', '#login_', function(){
		$('#userform').load("staticElements.htm #login");
	});

 	$('body').on('click', '#recover_', function(){
		$('#userform').load("staticElements.htm #recover");
	});
});

// Triggered by user request

function userInit(user) {

	$('#userform').hide();
	$('#userstatus').show();
	$("#userstatus .username").html(user['fname'] + "  " + user['lname']);

	if (user['role'] == "teacher") {
		$('nav.navbar').load("staticElements.htm #navteacher");
	}

	else if(user['role'] == "student") {
		$('nav.navbar').load("staticElements.htm #navstudent");
	}

 	$('body').on('click', '#logout_', function(){
		logout();
	});

}
