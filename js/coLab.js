// Web project mockup
// Jim Morris

// Login behaviour

function loginDestination() {

	var user = $("input#user").val();

	if (user == "teacher") {
		window.location.href = "teacher.htm";
	}

	if (user == "student") {
		window.location.href = "student.htm";
	}

}

// fileView behaviour

$(document).ready(function() {

	$("button.changes").click(function() {
			$("p.deleted").show();
			$("p.deleted").css("background-color", "#ffd8d8");
			$("p.added").css("background-color", "#bbffbb");
	});

	$("button.latest").click(function() {
			$("p.deleted").hide();
			$("p").css("background-color", "inherit");
	});

	$("button.emily").click(function() {
			$("p.emily").css("background-color", "#d8d8ff");
	});


	$("button.jim").click(function() {
			$("p.jim").css("background-color", "#ffe3b0");
	});


	$("button.roger").click(function() {
			$("p.roger").css("background-color", "#bbffbb");
	});

	$("button.clear").click(function() {
			$("p").css("background-color", "inherit");
	});

});


