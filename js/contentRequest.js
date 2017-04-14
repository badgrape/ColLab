function sendEmail() {

	var request = $("#contact").serializeArray();
	request.push({ name: "operation", value: "sendEmail" });

	$.post("php/mailer/sendEmail.php", JSON.stringify(request),
		function(data, status){
		$("#message").html(data);
	});
}

function getCourses(purpose) {

	var request = [];
	request[0] = { name: "operation", value: "getCourses" };
	request[1] = { name: "role", value: user['role'] };

	$.post("php/contentResponse.php", JSON.stringify(request),
		function(data, status){
			courses = JSON.parse(data);

			if (user['role'] == "teacher") {
				if (purpose == "list") {
					courseInfo(courses);
				}
				else if (purpose == "options") {
					assignForm(courses);
				}
			}

			else if (user['role'] == "student") {
				registerCourse(courses)	
			}
	});
}

function addCourse() {

	var request = $("#addcourse").serializeArray();
	request.push({ name: "operation", value: "addCourse" });

	$.post("php/contentResponse.php", JSON.stringify(request),
		function(data, status){
			courses = JSON.parse(data);
			courseInfo(courses);
	});
}

function getStudents(course) {

	var request = [];
	request[0] = { name: "course", value: course };
	request[1] = { name: "operation", value: "getStudents" };

	$.post("php/contentResponse.php", JSON.stringify(request),
		function(data, status){
			students = JSON.parse(data);
			studentInfo(students);
	});
}

function getAssigns(filter) {

	var request = $("#projectcourse").serializeArray();
	request.push({ name: "operation", value: "getAssigns" });

	if (filter == "course") {
		request.push({ name: "filter", value: filter });
	}

	$.post("php/contentResponse.php", JSON.stringify(request),
		function(data, status){
			assigns = JSON.parse(data);
			
			if (filter == "course") {
				selectAssign(assigns);
			}
			else {
				assignInfo(assigns);
			}
	});
}

function addAssign() {

	var request = $("#addassign").serializeArray();
	request.push({ name: "operation", value: "addAssign" });

	$.post("php/contentResponse.php", JSON.stringify(request),
		function(data, status){
			assigns = JSON.parse(data);
			assignInfo(assigns);
	});
}

function getProjects() {

	var request = [];
	request[0] = { name: "operation", value: "getProjects" };

	$.post("php/contentResponse.php", JSON.stringify(request),
		function(data, status){

		projects = JSON.parse(data);
		projectList(projects);
	});
}

function projectGroups() {

	var request = $('#projectassign').serializeArray();
	request.push({ name: "operation", value: "getProjectGroups" });

	$.post("php/contentResponse.php", JSON.stringify(request),
		function(data, status){
		$("#message").html(data);

		groups = JSON.parse(data);
		console.log(groups);
		projectSelect(projects);
	});
}

function getDraft(project) {

	var request = [];
	request[0] = { name: "project", value: project };
	request[1] = { name: "operation", value: "getDraft" };

	$.post("php/contentResponse.php", JSON.stringify(request),
		function(data, status){

			draft = JSON.parse(data);
			draftView(draft);
	});
}

function saveDraft() {

	var request = $('#savedraft').serializeArray();
	request.push({ name: "operation", value: "saveDraft" });

	$.post("php/contentResponse.php", JSON.stringify(request),
		function(data, status){

		draft = JSON.parse(data);
		draftView(draft);
	});
}

