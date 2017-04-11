<?php
require_once("dbConnect.php");
require("dbOperations.php");
require("userManage.php");
include("debug.php");

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

addFile("research.odt", 2, 4, "Important information");
addFile("projectjournal.docx", 1, 3, "Random thoughts");

addDiscussion(1, 3, "I'm so confused", "Lorem ipsum dolor sit amet, consectetur adipiscing elit.");
addDiscussion(2, 4, "I got it!", "Ut vitae nibh ut justo lacinia pretium.");

addReply(1, 1, "Don't be so hard on yourself");
addReply(1, 5, "Quisque eu mauris vitae magna pellentesque auctor");
addReply(2, 2, "Love yourself to death, because that's where you're headed anyway (a guy named Marcel).");
addReply(2, 4, "Sound advice. Cras dictum lectus non pellentesque sodales.");

echo "getUser";
printObject(getUser(4));
echo "getProjectByAssign";
printObject(getProjectsByAssign(2));
echo "getProjectsByStudent";
printObject(getProjectsByStudent(5));
echo "getGroup";
printObject(getGroup(1));
echo "getCoursesByTeacher";
printObject(getCoursesByTeacher(2));
echo "getCoursesByStudent";
printObject(getCoursesByStudent(5));
echo "getAssignsByCourse";
printObject(getAssignsByCourse(1));
echo "getAssignsByTeacher";
printObject(getAssignsByTeacher(2));
echo "getAllDrafts";
$drafts = getAllDrafts(1);
printObject($drafts);
echo "getOneDraft";
printObject(getOneDraft(1, 3, $drafts[0]['dateupdated']));
echo "getAllBiblios";
$biblios = getAllBiblios(2);
printObject($biblios);
echo "getOneBiblio";
printObject(getOneBiblio(2, 4, $biblios[0]['dateupdated']));
echo "getFiles";
printObject(getFiles(1));
echo "getAllDiscussions";
printObject(getAllDiscussions(2));
echo "getOneDiscussion";
printObject(getOneDiscussion(1));
echo "getReplies";
printObject(getReplies(1));

?>
