// User account

function userInfo(user) {

	var userData = "<h3>Your Account Details</h3>"

	userData += "<table id='userdata' class='table'>";
	userData += "<tr><th>First name</th><td>" + user['fname'] + "</td>";
	userData += "<tr><th>Last name</th><td>" + user['lname'] + "</td>";
	userData += "<tr><th>Email address</th><td>" + user['email'] + "</td>";
	userData += "<tr><th>Role</th><td>" + user['role'] + "</td>";
	userData += "</table>";

	userData += "<button type='button' id='editaccount_' class='btn btn-default'>";
	userData += "Edit your personal information</button>";
		
	$('#main').html(userData);

 	$('body').on('click', '#editaccount_', function() {
		$('#main').load("staticElements.htm #edituser");
	});

 	$('body').on('click', '#cancel_', function() {
		getUser();
	});
	
}

// Courses list

function courseInfo(courses) {

	var courseList = "<h3>Your Courses</h3>";

	courseList += "<table id='courselist' class='table table-hover'>";
	courseList += "<tr><th>Title</th><th>Discipline</th></tr>";
	for (var x in courses) {
		courseList += "<tr><td><button type='button' id='"
		courseList += courses[x]['courseid'] + "' class='btn btn-link'>";
		courseList += courses[x]['coursename'] + "</button></td>";
		courseList += "<td>" + courses[x]['discipline'] + "</td>";
		courseList += "</tr>";
	}

	courseList += "</table>";
	courseList += "<button type='button' id='addcourse_' class='btn btn-default'>";
	courseList += "Add a course</button>";

	$('#main').html(courseList);

 	$('body').on('click', '#courselist .btn', function() {
		console.log($(this).attr("id"));
		getStudents($(this).attr("id"));
	});

 	$('body').on('click', '#addcourse_', function() {
		$('#main').load("staticElements.htm #addcourse");
	});

 	$('body').on('click', '#cancel_', function() {
		getCourses("list");
	});

}

// Student list

function studentInfo(students) {

	var studentList = "<h3>Students in this Course</h3>";

	studentList += "<table id='courselist' class='table table-hover'>";
	studentList += "<tr><th>First name</th><th>Last name</th></tr>";

	for (var x in students) {
		studentList += "<tr>";
			for (var y in students[x]) {
				studentList += "<td>"	+ students[x][y] + "</td>";
			}
		studentList += "</tr>";
	}

	studentList += "</table>";
	studentList += "<button type='button' id='goback_' class='btn btn-default'>";
	studentList += "Go back</button>";

	$('#main').html(studentList);

 	$('body').on('click', '#goback_', function() {
		getCourses("list");
	});
	
}

// Assignments list

function assignInfo(assigns) {

	var assignList = "<h3>Your Assignments</h3>";

	assignList += "<table id='assignlist' class='table table-hover'>";
	assignList += "<tr><th>Title</th><th>Course</th></tr>";
	for (var x in assigns) {
		assignList += "<tr><td><button type='button' id='"
		assignList += assigns[x]['assignid'] + "' class='btn btn-link'>";
		assignList += assigns[x]['assigntitle'] + "</button></td>";
		assignList += "<td>" + assigns[x]['coursename'] + "</td>";
		assignList += "</tr>";
	}

	assignList += "</table>";
	assignList += "<button type='button' id='addassign_' class='btn btn-default'>";
	assignList += "Add an assignment</button>";

	$('#main').html(assignList);

	/*
 	$('body').on('click', '#assignlist .btn', function() {
		showAssign($("#courselist .btn").attr("id"));
	});
	*/

 	$('body').on('click', '#addassign_', function() {
		getCourses("options");
	});

 	$('body').on('click', '#cancel_', function() {
		getAssigns();
	});

}

// Add assignment form

function assignForm(courses) {

	var form = "<h3>Add an Assignment</h3>";
	
	form += "<form id='addassign' action='javascript:addAssign()'>";
	
	form += "<div class='form-group'><label for='title'>Title:</label>";
	form += "<input type='text' class='form-control' name='title' id='title' /></div>";
	form += "<div class='form-group'><label>Course:</label>";
	
	for (var x in courses) {
		form += "<div class='radio'><label><input type='radio' name='course' value='";
		form += courses[x]['courseid'] + "'>" + courses[x]['coursename'] + "</label></div>";
	}
	
	form += "<div class='form-group'><label for='instructions'>Instructions:</label>";
	form += "<textarea name='instructions' class='form-control' id='instructions' rows='5' required='required'>";
	form += "</textarea></div><div class='btn-group'>";
	form += "<input type='submit' class='btn btn-primary' name='submit' value='Add' />";
	form += "<button type='button' id='cancel_' class='btn btn-default'>Cancel</button>";
	form += "</div></form>";
	
	$('#main').html(form);

 	$('body').on('click', '#cancel_', function() {
		getAssigns();
	});

}

function projectList(projects) {
	var projectList = "<h3>Your Projects</h3>";

	projectList += "<table id='projectlist' class='table table-hover'>";
	projectList += "<tr><th>Title</th><th>Course</th></tr>";

	for (var x in projects) {
		projectList += "<tr><td><button type='button' id='"
		projectList += projects[x]['projectid'] + "' class='btn btn-link'>";
		projectList += projects[x]['projecttitle'] + "</button></td>";
		projectList += "<td>" + projects[x]['assigntitle'] + "</td>";
		projectList += "</tr>";
	}

	projectList += "</table>";
	projectList += "<button type='button' id='addproject_' class='btn btn-default'>";
	projectList += "Add a project</button>";

	$('#main').html(projectList);

 	$('body').on('click', '#projectlist .btn', function() {
		console.log($(this).attr("id"));
		getDraft($(this).attr("id"));
	});

}

function draftView(draft) {

	var version = "<div id='fileBox'><div id='fileinfo'><div id='fileName'>File: ";
	version += draft['projecttitle'] + "</div><div id='fileOps'>";
	version += "<button type='button' class='btn btn-default btn-sm goback'>Go back</button>";
	version += "<button type='button' class='btn btn-default btn-sm changes'>View most recent changes</button>";
	version += "<button type='button' class='btn btn-primary btn-sm edit'>Edit</button></div>";
	version += "</div><div id='fileView'>" + draft['projecttext'];
	version += "</div></div>";

	$('#main').html(version);

 	$('body').on('click', '#fileBox .goback', function() {
		getProjects();
	});

 	$('body').on('click', '#fileBox .edit', function() {
		draftEdit(draft);
	});
}

function draftEdit(draft) {

	var editor = "<div id='fileBox'><form id='savedraft' action='javascript:saveDraft()'>";
	editor += "<div class='form-group'>File: " + draft['projecttitle'];
	editor += "<input type='submit' class='btn btn-primary btn-sm save' value='Save'/>";
	editor += "<button type='button' class='btn btn-default btn-sm cancel'>Cancel</button></div>";
	editor += "<textarea name='text' id='text' class='form-control' rows='15' required='required'>";
	editor += draft['projecttext'] + "</textarea></form></div>";

	$('#main').html(editor);

 	$('body').on('click', '#savedraft .cancel', function() {
		getDraft(draft['project']);
	});

}
