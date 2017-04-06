function talkToServer() {

	// Ajax with jQuery to talk to the server
	// Send some data in JSON format (httpRequest)
	// Wait for the httpResponse (JSON format)
	var username = $("#username").val();
	var email = $("#email").val();
	var password = $("#password").val();
	var submit = $("#submit").val();

	// String to create JSON object
	var text =  '{' +
				   '"username":"' + username + '",' +
				   '"email":"' + email + '",' +
				   '"password":"' + password + '",' +
				   '"submit":"' + submit + '"' +
				'}';

	var jsonData = JSON.parse(text);

	$.post("php/response.php", JSON.stringify(jsonData),
		function(data, status){
			$("#usersJson").html(data);

			var jsonData = JSON.parse(data);
			console.log(jsonData);
			var users = [];
			$.each(jsonData, function(index, value) {
				users.push("<p>" + value['name'] + ": " + value['email'] + "</p>");
			});
			$("#users").html(users.join(""));
	});

	}
