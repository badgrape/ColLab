<?php

// for testing:
require_once("dbConnect.php");

// Password encryption

function getSalt($string, $max) {
	if (strlen($string) == $max) {
		return $string;
	}

	else {
		$string .= chr(rand(0, 127));
		return getSalt($string, $max);
	}
}

function encrypt($salt, $pass) {
	$saltedPass = $salt . $pass;
	$token = hash('ripemd128', $saltedPass);
	return $token;
}

// Users

function addUser($fname, $lname, $role, $email, $password) {
	GLOBAL $pdo;

	$salt = getSalt("", 12);
	$hash = encrypt($salt, $password);

	$sql = "insert into users (fname, lname, role, email, salt, hash)
		values (:fname, :lname, :role, :email, :salt, :hash)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':fname', $fname);
	$stmt->bindParam(':lname', $lname);
	$stmt->bindParam(':role', $role);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':salt', $salt);
	$stmt->bindParam(':hash', $hash);

	$stmt->execute();
}

function editUser($userid, $fname, $lname, $email, $password) {
	GLOBAL $pdo;

	$salt = getSalt("", 12);
	$hash = encrypt($salt, $password);
	
	$sql = "update users set fname = :fname, lname = :lname, email = :email,
		salt = :salt, hash = :hash where userid = :userid";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':userid', $userid);
	$stmt->bindParam(':fname', $fname);
	$stmt->bindParam(':lname', $lname);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':salt', $salt);
	$stmt->bindParam(':hash', $hash);

	$stmt->execute();
}

function removeUser($userid) {
	GLOBAL $pdo;

	$sql = "delete from users where userid = :userid";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':userid', $userid);

	$stmt->execute();
}

// Courses: teachers

function addCourse($coursename, $discipline, $teacher) {
	GLOBAL $pdo;

	$sql = "insert into courses (coursename, discipline, teacher)
		values (:coursename, :discipline, :teacher)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':coursename', $coursename);
	$stmt->bindParam(':discipline', $discipline);
	$stmt->bindParam(':teacher', $teacher);
 	
	$stmt->execute();
}

function editCourse($courseid, $coursename, $discipline, $teacher) {
	GLOBAL $pdo;

	$sql = "update courses set coursename = :coursename, discipline = :discipline,
	 teacher = :teacher where courseid = :courseid";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':courseid', $courseid);
	$stmt->bindParam(':coursename', $coursename);
	$stmt->bindParam(':discipline', $discipline);
	$stmt->bindParam(':teacher', $teacher);
 	
	$stmt->execute();
}

function removeCourse($courseid) {
	GLOBAL $pdo;

	$sql = "delete from courses where courseid = :courseid";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':courseid', $courseid);

	$stmt->execute();
}

// Courses: students

function registerCourse($student, $course) {
	GLOBAL $pdo;

	$sql = "insert into registration (student, course)
		values (:student, :course)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':student', $student);
	$stmt->bindParam(':course', $course);
 	
	$stmt->execute();
}

function dropCourse($student, $course) {
	GLOBAL $pdo;

	$sql = "delete from registration where student = :student
		and course = :course";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':student', $student);
	$stmt->bindParam(':course', $course);

	$stmt->execute();
}

// Assignments: teachers only

function addAssign($title, $instructions, $course) {
	GLOBAL $pdo;

	$sql = "insert into assignments (assigntitle, instructions, course)
		values (:title, :instructions, :course)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':title', $title);
	$stmt->bindParam(':instructions', $instructions);
	$stmt->bindParam(':course', $course);
 	
	$stmt->execute();
}


function editAssign($assignid, $title, $instructions, $course) {
	GLOBAL $pdo;

	$sql = "update assignments set assigntitle = :title,
		instructions = :instructions, course = :course
		where assignid = :assignid";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':assignid', $assignid);
	$stmt->bindParam(':title', $title);
	$stmt->bindParam(':instructions', $instructions);
	$stmt->bindParam(':course', $course);
 	
	$stmt->execute();
}

function removeAssign($assignid) {
	GLOBAL $pdo;

	$sql = "delete from assignments where assignid = :assignid";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':assignid', $assignid);

	$stmt->execute();
}

// Projects: students only

function addProject($assignment, $title) {
	GLOBAL $pdo;

	$sql = "insert into projects (assign, projecttitle)
		values (:assign, :title)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':assign', $assignment);
	$stmt->bindParam(':title', $title);
 	
	$stmt->execute();
	
	// Get project ID to auto-join first member
	$projectID = $pdo->lastInsertId();

	return $projectID;
}

function editProject($projectid, $assign, $title) {
	GLOBAL $pdo;

	$sql = "update projects set projecttitle = :title,
		assign = :assign
		where projectid = :projectid";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':projectid', $projectid);
	$stmt->bindParam(':title', $title);
	$stmt->bindParam(':assign', $assign);
 	
	$stmt->execute();

}

// Only delete project if no group members remain
function removeProject($projectid) {
	GLOBAL $pdo;

	$sql = "delete from projects where projectid = :projectid";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':projectid', $projectid);

	$stmt->execute();
}

function joinGroup($student, $project) {
	GLOBAL $pdo;

	$sql = "insert into groups (student, project)
		values (:student, :project)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':student', $student);
	$stmt->bindParam(':project', $project);
 	
	$stmt->execute();
}

function leaveGroup($student, $project) {
	GLOBAL $pdo;

	$sql = "delete from groups where student = :student
		and project = :project";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':student', $student);
	$stmt->bindParam(':project', $project);

	$stmt->execute();
}

// Project drafts and bibliographies: students only

function addDraft($project, $student, $text) {
	GLOBAL $pdo;

	$sql = "insert into projectrevisions (project, student, projecttext)
		values (:project, :student, :text)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':project', $project);
	$stmt->bindParam(':student', $student);
	$stmt->bindParam(':text', $text);
 	
	$stmt->execute();
}

function addBiblio($project, $student, $text) {
	GLOBAL $pdo;

	$sql = "insert into bibliorevisions (project, student, bibliotext)
		values (:project, :student, :text)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':project', $project);
	$stmt->bindParam(':student', $student);
	$stmt->bindParam(':text', $text);
 	
	$stmt->execute();
}

// Files: students only

//function addFile
//function removeFile($filename, $project, $student)

//Discussion topics: students only

//function addDiscussion
//function editDiscussion
//function removeDiscussion($topicid, $student)

// Discussion replies: students and teachers

//function addReply
//function editReply
//function removeReply($topicid, $user)

/*
Data to be retrieved
By teachers and students:
- Account information; user verification for password recovery
- Project drafts and bibliographies (current and previous versions)
- Discussion topics and replies
- Files: file path follows pattern files/courseid/projectid and href is generated dynamically with session data
 */

?>
