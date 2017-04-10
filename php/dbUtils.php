<?php

/* Mutators */

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

	$sql = "update courses set coursename = :coursename, discipline = :discipline
		where courseid = :courseid and teacher = :teacher";
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

function addFile($filename, $project, $student, $linktext) {
	GLOBAL $pdo;

	$sql = "insert into files (filename, project, student, linktext)
		values (:filename, :project, :student, :linktext)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':filename', $filename);
	$stmt->bindParam(':project', $project);
	$stmt->bindParam(':student', $student);
	$stmt->bindParam(':linktext', $linktext);
 	
	$stmt->execute();
}

function removeFile($filename, $project, $student) {
	GLOBAL $pdo;

	$sql = "delete from files where filename = :filename and
		project = :project and student = :student";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':filename', $filename);
	$stmt->bindParam(':student', $student);
	$stmt->bindParam(':project', $project);

	$stmt->execute();
}

// Discussion topics: students only

function addDiscussion($project, $student, $title, $text) {
	GLOBAL $pdo;

	$sql = "insert into discusstopics (project, student, topictitle, topictext)
		values (:project, :student, :title, :text)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':project', $project);
	$stmt->bindParam(':student', $student);
	$stmt->bindParam(':title', $title);
	$stmt->bindParam(':text', $text);
 	
	$stmt->execute();
	
}

function editDiscussion($topicid, $student, $title, $text) {
	GLOBAL $pdo;

	$sql = "update discusstopics set topictitle = :title, topictext = :text
		where topicid = :topicid and student = :student";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':topicid', $topicid);
	$stmt->bindParam(':student', $student);
	$stmt->bindParam(':title', $title);
	$stmt->bindParam(':text', $text);
 	
	$stmt->execute();
}

function removeDiscussion($topicid, $student){
	GLOBAL $pdo;

	$sql = "delete from discusstopics where topicid = :topicid and student = :student";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':topicid', $topicid);
	$stmt->bindParam(':student', $student);

	$stmt->execute();
	
}

// Discussion replies: students and teachers

function addReply($topic, $userid, $text) {
	GLOBAL $pdo;

	$sql = "insert into discussreplies (topic, userid, replytext)
		values (:topic, :userid, :text)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':topic', $topic);
	$stmt->bindParam(':userid', $userid);
	$stmt->bindParam(':text', $text);
 	
	$stmt->execute();
	
}

function editReply($topic, $userid, $date, $text) {
	GLOBAL $pdo;

	$sql = "update discussreplies set replytext = :text
		where topic = :topic and userid = :userid and dateposted = :date";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':topic', $topic);
	$stmt->bindParam(':userid', $userid);
	$stmt->bindParam(':date', $date);
	$stmt->bindParam(':text', $text);
 	
	$stmt->execute();
}

function removeReply($topic, $userid, $date){
	GLOBAL $pdo;

	$sql = "delete from discussreplies
		where topic = :topic and userid = :userid and dateposted = :date";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':topic', $topic);
	$stmt->bindParam(':userid', $userid);
	$stmt->bindParam(':date', $date);

	$stmt->execute();
	
}

/* Accessors */

// Users

function getUser($userid) {
	GLOBAL $pdo;

	$sql = "select fname, lname, role, email from users where userid = :userid";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':userid', $userid);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

// Courses

function getCoursesByTeacher($teacher) {
	GLOBAL $pdo;

	$sql = "select courseid, coursename, discipline from courses where teacher = :teacher";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':teacher', $teacher);
	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getCoursesByStudent($student) {
	GLOBAL $pdo;

	$sql = "select c.courseid, c.coursename, c.discipline, c.teacher
		from courses c, registration r
		where c.courseid = r. course and r.student = :student";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':student', $student);
	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

// Assignments

function getAssignsByCourse($course) {
	GLOBAL $pdo;

	$sql = "select assignid, assigntitle, instructions from assignments
		where course = :course";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':course', $course);
	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getAssignsByTeacher($teacher) {
	GLOBAL $pdo;

	$sql = "select a.assignid, a.assigntitle, a.instructions, a.course
		from assignments a, courses c
		where a.course = c.courseid and c.teacher = :teacher";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':teacher', $teacher);
	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

// Projects

function getProjectsByAssign($assign) {
	GLOBAL $pdo;

	$sql = "select projectid, projecttitle from projects where assign = :assign";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':assign', $assign);
	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getProjectsByStudent($student) {
	GLOBAL $pdo;

	$sql = "select p.projectid, p.assign, p.projecttitle from projects p, groups g
		where p.projectid = g.project and g.student = :student";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':student', $student);
	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

// Groups

function getGroup($project) {
	GLOBAL $pdo;

	$sql = "select u.userid, u.fname, u.lname from users u, groups g
		where u.userid = g.student and g.project = :project";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':project', $project);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

// Drafts and bibliographies

function getAllDrafts($project) {
	GLOBAL $pdo;

	$sql = "select student, dateupdated, projecttext from projectrevisions
		where project = :project";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':project', $project);
	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getOneDraft($project, $student, $date) {
	GLOBAL $pdo;

	$sql = "select projecttext from projectrevisions
		where project = :project and student = :student and dateupdated = :date";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':project', $project);
	$stmt->bindParam(':student', $student);
	$stmt->bindParam(':date', $date);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function getAllBiblios($project) {
	GLOBAL $pdo;

	$sql = "select student, dateupdated, bibliotext from bibliorevisions
		where project = :project";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':project', $project);
	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getOneBiblio($project, $student, $date) {
	GLOBAL $pdo;

	$sql = "select bibliotext from bibliorevisions
		where project = :project and student = :student and dateupdated = :date";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':project', $project);
	$stmt->bindParam(':student', $student);
	$stmt->bindParam(':date', $date);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

// Files

function getFiles($project) {
	GLOBAL $pdo;

	$sql = "select filename, student, linktext from files
		where project = :project";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':project', $project);
	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

// Discussion topics and replies

function getAllDiscussions($project) {
	GLOBAL $pdo;

	$sql = "select topicid, student, topictitle, topictext, dateposted from discusstopics
		where project = :project";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':project', $project);
	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getOneDiscussion($topicid) {
	GLOBAL $pdo;

	$sql = "select project, student, topictitle, topictext, dateposted from discusstopics
		where topicid = :topicid";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':topicid', $topicid);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function getReplies($topic) {
	GLOBAL $pdo;

	$sql = "select userid, dateposted, replytext from discussreplies
		where topic = :topic";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':topic', $topic);
	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

?>
