var courses;

function getCourses() {

	var courseRequest = [];
	courseRequest[0] = { name: "operation", value: "getCourses" };

	$.post("php/contentResponse.php", JSON.stringify(courseRequest),
		function(data, status){

			courses = JSON.parse(data);
			console.log(courses);
	});
}

function addCourse() {

	var newCourse = $("#addcourse").serializeArray();
	newCourse.push({ name: "operation", value: "addCourse" });

	$.post("php/contentResponse.php", JSON.stringify(newCourse),
		function(data, status){

			courses = JSON.parse(data);
			console.log(courses);
	});
}
