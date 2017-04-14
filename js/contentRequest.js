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
	request.push({ name: "filter", value: filter });

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

function projectGroups(projectID) {

	var forStudent = projectID == undefined;

	var request = [];
	

	if (forStudent) {
		request = $('#projectassign').serializeArray();	
	}

	else {
		request[0] = { name: "assign", value: projectID };
	}
	
	request.push({ name: "operation", value: "getProjectGroups" });

	$.post("php/contentResponse.php", JSON.stringify(request),
		function(data, status){

		groups = JSON.parse(data);
		
		if (forStudent) {
			selectProject(groups);
		}

		else {
			listProjects(groups);
		}

		console.log(groups);
	});
}

function addProject() {

	var request = $('#projectselect').serializeArray();
	
	var joinGroup = $("#projectselect .radio input").is(":checked");
	var newProject = $("#projectselect #newgroup").val().length > 0;
	// Input validation
	if (joinGroup && newProject) {
		$("#message").html("Either join an existing group or start a new one. You can't do both");
	}

	else if (joinGroup) {
		request.push({ name: "operation", value: "joinGroup" });
	}

	else if (newProject) {
		request.push({ name: "operation", value: "addProject" });
	}

	else {
		$("#message").html("Do something or click \"cancel.\"");
	
	}

	$.post("php/contentResponse.php", JSON.stringify(request),
		function(data, status){
		$("#message").html(data);

		getProjects();
			
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

