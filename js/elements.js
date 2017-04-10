// Triggered on page load

$(function() {
	if (typeof user === 'undefined') {
		$('nav.navbar').load("pageElements.htm #nav-public");
	}
});


$(function() {
	$('#user-form').load("pageElements.htm #login");
});

$(function() {
 	$('body').on('click', '#register_', function(){
		$('#user-form').load("pageElements.htm #register");
	});

 	$('body').on('click', '#login_', function(){
		$('#user-form').load("pageElements.htm #login");
	});

 	$('body').on('click', '#recover_', function(){
		$('#user-form').load("pageElements.htm #recover");
	});
});

// Triggered by user request

function userRole(user) {

	if (user['role'] == "teacher") {
		$('#user-form').hide();
		$('nav.navbar').load("pageElements.htm #nav-teacher");
	}

}
