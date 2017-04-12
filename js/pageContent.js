// User account

function userInfo(user) {

	var userData = "<h3>Your details</h3>"

	userData += "<table class='table'>";
	userData += "<tr><th>First name</th><td>" + user['fname'] + "</td>";
	userData += "<tr><th>Last name</th><td>" + user['lname'] + "</td>";
	userData += "<tr><th>Email address</th><td>" + user['email'] + "</td>";
	userData += "<tr><th>Role</th><td>" + user['role'] + "</td>";
	userData += "</table>";

	userData += "<button type='button' id='editaccount_' class='btn btn-default'>";
	userData += "Edit your personal information</button>";
		
	$('#main').html(userData);

 	$('body').on('click', '#editaccount_', function() {
		$('#main').load("pageElements.htm #edituser");
	});

 	$('body').on('click', '#cancel_', function() {
		userInfo(user);
	});
	
}

// This is weird AF
getCourses();

// Courses list

function courseInfo() {

	var coursesHeader = "<h3>Your courses</h3>";

	$('#main').html(coursesHeader);

	var courseList = "<table class='table'>";
	courseList += "<tr><th>Title</th><th>Discipline</th></tr>";

	for (var x in courses) {
		courseList += "<tr>";
		for (var y in courses[x]) {
			if (y != "courseid") {
				courseList += "<td>" + courses[x][y] + "</td>";
			}
		}
		courseList += "</tr>";
	}

	courseList += "</table>";
	courseList += "<button type='button' id='addcourse_' class='btn btn-default'>";
	courseList += "Add a course</button>";

	$('#main').append(courseList);

}
