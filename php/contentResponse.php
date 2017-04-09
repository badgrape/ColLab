<?php
require_once("dbConnect.php");
require("dbUtils.php");

// Test queries

addUser("Emily", "Raine", "teacher", "mochi@badgrape.net", "many5cats");
addUser("Jim", "Morris", "teacher", "jim@badgrape.net", "s3ns3nn0s3n");
addUser("Jujube", "Beagle", "student", "tubetube@badgrape.net", "jujube");
addUser("Rogero", "El Lobo", "student", "rog@badgrape.net", "rogero");
addUser("R2", "Kid Hacker", "student", "dirtyflash@badgrape.net", "r2d2v2b3");

addCourse("Intro to fashion theory", "Communications", 1);
addCourse("Anarchism and philosophy of science", "Humanities", 2);

addAssign("Term paper", "This is going to be REALLY HARD, so don't screw it up.", 1);
addAssign("Literature review", "Write whatever you want. You're all getting the same mark.", 2);

registerCourse(3, 1);
registerCourse(4, 2);
registerCourse(5, 1);

$projectId = addProject(1, "Best essay ever!");
joinGroup(3, $projectId);
joinGroup(5, $projectId);
addDraft($projectId, 3, "Colourless green ideas sleep furiously.");
addBiblio($projectId, 5, "Hilary Putnam, Representation and Reality.");

$projectId = addProject(2, "Progress not perfection.");
joinGroup(4, $projectId);
editProject($projectId, 2, "Smash the cistern!");
addDraft($projectId, 4, "Oh and as I was young and easy in the mercy of his means, time held me green and dying, though I sang in my chains like the sea.");
addBiblio($projectId, 4, "Dylan Thomas, Fern Hill.");


?>
