// User account

function userInfo(user) {

	var userData = "<div id='userinfo'><h3>Your details</h3>"

	userData += "<table class='table'>";
	userData += "<tr><th>First name</th><td>" + user['fname'] + "</td>";
	userData += "<tr><th>Last name</th><td>" + user['lname'] + "</td>";
	userData += "<tr><th>Email address</th><td>" + user['email'] + "</td>";
	userData += "<tr><th>Role</th><td>" + user['role'] + "</td>";
	userData += "</table>";

	userData += "<button type='button' id='editaccount_' class='btn btn-default'>";
	userData += "Edit your personal information</button></div>";
		
	$('#main').html(userData);

 	$('body').on('click', '#editaccount_', function() {
		$('#main').load("pageElements.htm #edituser");
	});

 	$('body').on('click', '#cancel_', function() {
		userInfo(user);
	});
	
}

