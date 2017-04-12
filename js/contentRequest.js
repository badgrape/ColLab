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
