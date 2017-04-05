// User class 

function User(name, email) {
	
	// Instance variables

	this.username = name;
	this.email = email;

	// Accessors

	this.getName = function() {
		return this.name;
	}

	this.getEmail = function() {
		return this.email;
	}

}
