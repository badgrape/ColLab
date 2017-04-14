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

			if ($postLike['role'] == "student")	{
				$_SESSION['currentData'] = getAllCourses();
			}

			else {
				$_SESSION['currentData'] = getCoursesByTeacher($_SESSION['user']['userid']);
			}

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
		
			if ($postLike['filter'] == "course") {
				$_SESSION['currentData'] = getAssignsByCourse($postLike['course']);
			}

			else{
				$_SESSION['currentData'] = getAssignsByTeacher($_SESSION['user']['userid']);
			}

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

	// Return a student's projects
	if ($postLike['operation'] == "getProjects") {
	
		try {
		
			$_SESSION['currentData'] = getProjectsByStudent($_SESSION['user']['userid']);

			$projects = json_encode($_SESSION['currentData']);
			echo $projects;

		}

		catch(PDOException $e) {echo $e->getMessage();}

	}

	// return group members of a given project
	if ($postLike['operation'] == "getProjectGroups") {
	
		try {
		
			$projects = getProjectsByAssign($postLike['assign']);

			for ($i = 0; $i < count($projects); $i++) {
				
				$projects[$i]['members'] = [];
				$group = getGroup($projects[$i]['projectid']);

					for ($j = 0; $j < count($group); $j++) {
						$projects[$i]['members'][$j] = $group[$j];
					}

			}

			$_SESSION['currentData'] = $projects;

			$groups = json_encode($_SESSION['currentData']);
			echo $groups;

		}

		catch(PDOException $e) {echo $e->getMessage();}

	}

	if ($postLike['operation'] == "joinGroup") {

		try {

			joinGroup($_SESSION['user']['userid'], $postLike['group']);

			$message = "You were succesfully added to the group.";
			echo $message;

		}

		catch(PDOException $e) {echo $e->getMessage();}

	}

	if ($postLike['operation'] == "addProject") {

		try {

			$newProject = addProject($_SESSION['currentData'][0]['assign'], $postLike['newgroup']);

			joinGroup($_SESSION['user']['userid'], $newProject);

			$message = "You succesfully added a new project.";
			echo $message;

		}

		catch(PDOException $e) {echo $e->getMessage();}

	}
	
	
	// Return lastest project version	
	if ($postLike['operation'] == "getDraft") {
	
		try {
		
			if (getLatestDraft($postLike['project']) == null) {

				addDraft($postLike['project'], $_SESSION['user']['userid'],
					"This the first draft of your new project. Click \"edit\" to get started.");

			}

			$_SESSION['currentData'] = getLatestDraft($postLike['project']);

			$draft = json_encode($_SESSION['currentData']);
			echo $draft;

		}

		catch(PDOException $e) {echo $e->getMessage();}

	}
	
	if ($postLike['operation'] == "saveDraft") {
	
		try {
		
			addDraft($_SESSION['currentData']['project'], $_SESSION['user']['userid'], $postLike['text']);

			$_SESSION['currentData'] = getLatestDraft($_SESSION['currentData']['project'], $_SESSION['user']['userid']);

			$draft = json_encode($_SESSION['currentData']);
			echo $draft;

		}

		catch(PDOException $e) {echo $e->getMessage();}

	}

}

else {echo "No data";}

?>
