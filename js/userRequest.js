var user;

function login() {

	var authenticate = $("#login").serializeArray();
	authenticate.push({ name: "operation", value: "login" });

	$.post("php/userResponse.php", JSON.stringify(authenticate),
		function(data, status){

			user = JSON.parse(data);
			console.log(user);
			userInit(user);

	});
}

function register() {

	var newUser = $("#register").serializeArray();
	newUser.push({ name: "operation", value: "register" });

	$.post("php/userResponse.php", JSON.stringify(newUser),
		function(data, status){
			$("#message").html(data);

			user = JSON.parse(data);
			userInit(user);
	});

}

function recover() {

	var resetPass = $("#recover").serializeArray();
	resetPass.push({ name: "operation", value: "recover" });

	$.post("php/userResponse.php", JSON.stringify(resetPass),
		function(data, status){
			$("#message").html(data);

			user = JSON.parse(data);
			userInit(user);
	});

}

// edit

function editUser() {
	var userData = $("#edituser").serializeArray();
	userData.push({ name: "operation", value: "editUser" });

	$.post("php/userResponse.php", JSON.stringify(userData),
		function(data, status){
			$("#message").html(data);

			user = JSON.parse(data);
			console.log(user);
			userInfo(user);
	});
}

function logout() {

	delete user;

	var signOut = [];
	signOut[0] = { name: "operation", value: "logout" };

	$.post("php/userResponse.php", JSON.stringify(signOut),
		function(data, status){

			window.location.href = data;

	});


}

