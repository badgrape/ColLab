<?php

session_start();

require_once("dbConnect.php");
require("contentManage.php");
require("userManage.php");
include("debug.php");

$requestJson = file_get_contents('php://input');

$requestPhp = json_decode($requestJson, true);

$postlike = [];

for ($i = 0; $i < count($requestPhp); $i++) {
	$postLike[$requestPhp[$i]['name']] = $requestPhp[$i]['value'];
}

if (isset($postLike['operation'])) {

	// Return a teacher's courses
	if ($postLike['operation'] == "getCourses") {
	
		try {
		
			$_SESSION['currentData'] = getCoursesByTeacher($_SESSION['user']['userid']);

			$courses = json_encode($_SESSION['currentData']);
			echo $courses;

		}

		catch(PDOException $e) {echo $e->getMessage();}

	}
	
	// Add a course
	if ($postLike['operation'] == "addCourse") {
	
		try {
		
			addCourse($postLike['title'], $postLike['discipline'], $_SESSION['user']['userid']);
			$_SESSION['currentData'] = getCoursesByTeacher($_SESSION['user']['userid']);

			$courses = json_encode($_SESSION['currentData']);
			echo $courses;

		}

		catch(PDOException $e) {echo $e->getMessage();}

	}
	
	// Return a course's students
	if ($postLike['operation'] == "getStudents") {
	
		try {
		
			$_SESSION['currentData'] = getStudents($postLike['course']);

			$students = json_encode($_SESSION['currentData']);
			echo $students;

		}

		catch(PDOException $e) {echo $e->getMessage();}

	}
	
	// Return a teacher's assignments
	if ($postLike['operation'] == "getAssigns") {
	
		try {
		
			$_SESSION['currentData'] = getAssignsByTeacher($_SESSION['user']['userid']);

			$assigns = json_encode($_SESSION['currentData']);
			echo $assigns;

		}

		catch(PDOException $e) {echo $e->getMessage();}

	}

	// Add an assignment
	if ($postLike['operation'] == "addAssign") {
	
		try {
		
			addAssign($postLike['title'], $postLike['instructions'], $postLike['course']);
			$_SESSION['currentData'] = getAssignsByTeacher($_SESSION['user']['userid']);

			$assigns = json_encode($_SESSION['currentData']);
			echo $assigns;

		}

		catch(PDOException $e) {echo $e->getMessage();}

	}
	
}

else {echo "No data";}

?>
