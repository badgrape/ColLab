<?php

session_start();

require_once("dbConnect.php");
require("dbOperations.php");
require("userManage.php");
include("debug.php");

$requestJson = file_get_contents('php://input');

$requestPhp = json_decode($requestJson, true);

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


}

else {echo "No data";}

?>
