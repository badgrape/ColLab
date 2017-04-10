function login() {

	var authenticate = $("#login").serializeArray();
	authenticate.push({ name: "operation", value: "login" });

	//var jsonData = JSON.stringify(authenticate);
	//console.log(jsonData);

	$.post("php/userResponse.php", JSON.stringify(authenticate),
		function(data, status){
			$("#message").html(data);

			var user = JSON.parse(data);
			console.log(user);
	});
	}
