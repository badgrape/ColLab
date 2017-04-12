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

	if ($postLike['operation'] == "getCourses") {
	
		try {
		
			$_SESSION['currentData'] = getCoursesByTeacher(1);

			$courses = json_encode($_SESSION['currentData']);
			echo $courses;

		}

		catch(PDOException $e) {echo $e->getMessage();}

	}


}

else {echo "No data";}

?>
