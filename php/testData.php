<?php
require_once("dbConnect.php");
require("contentManage.php");
require("userManage.php");
include("debug.php");

// Test queries

addUser("Emily", "Raine", "teacher", "emily@badgrape.net", "emily");
addUser("Jim", "Morris", "teacher", "jim@badgrape.net", "jim");
addUser("Jujube", "Beagle", "student", "jujube@badgrape.net", "jujube");
addUser("Rogero", "El Lobo", "student", "rogero@badgrape.net", "rogero");
addUser("Ray-Rogers", "Barabe", "student", "ray@badgrape.net", "ray");
addUser("Stevie", "Sharp", "student", "steven@badgrape.net", "steven");

addCourse("Intro to fashion theory", "Communications", 1);
addCourse("Foucault's critical theory", "Philosophy", 1);
addCourse("Philosophy of science", "Humanities", 2);
addCourse("Programming LISP", "Computer Science", 2);

addAssign("Term paper", "Cras efficitur metus quam, elementum luctus augue dignissim in. Nunc iaculis gravida mauris et aliquam.", 1);
addAssign("Literature review", "Nunc dignissim dui ac neque iaculis pulvinar. Praesent commodo eleifend metus, quis molestie neque porta et. Donec in augue at metus finibus porttitor. Fusce interdum sapien sed dictum ultricies.", 2);
addAssign("Inference to the best explanation", "Cras efficitur metus quam, elementum luctus augue dignissim in. Nunc iaculis gravida mauris et aliquam. Integer vel tempor felis. In hac habitasse platea dictumst. Nulla rutrum efficitur turpis, venenatis ultricies justo congue a.", 3);
addAssign("Recursive algorithms", "Nunc dignissim dui ac neque iaculis pulvinar. Praesent commodo eleifend metus, quis molestie neque porta et. Donec in augue at metus finibus porttitor. Fusce interdum sapien sed dictum ultricies.", 4);

registerCourse(3, 1);
registerCourse(6, 2);
registerCourse(5, 1);
registerCourse(3, 2);
registerCourse(4, 3);
registerCourse(5, 4);

$projectId = addProject(1, "Our fashion essay");
joinGroup(3, $projectId);
joinGroup(5, $projectId);
addDraft($projectId, 3, "Integer egestas tincidunt dolor elementum posuere. Ut malesuada, enim vitae commodo finibus, velit mi elementum dolor, ullamcorper ornare risus augue convallis mauris. Mauris sed ultrices ex. Curabitur nec ultricies magna, id posuere lacus. Aenean elementum suscipit velit, sed scelerisque eros. Cras nec tellus molestie orci pellentesque ullamcorper at id elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent feugiat dictum dui, semper congue lacus sollicitudin vitae. Praesent nec elit accumsan, condimentum diam quis, ornare nunc. Nam et varius velit, eget posuere leo. Vestibulum ullamcorper nisl vel ligula commodo eleifend. Duis metus lorem, efficitur at magna ut, ultricies tempus lacus. In egestas pulvinar sem sit amet lobortis. Morbi finibus magna mattis dolor dictum lobortis. Pellentesque facilisis, arcu eu tempor vulputate, lorem elit tempus nulla, ac consectetur ante mi et enim. Quisque eu eros in diam convallis facilisis sed at lacus.");

$projectId = addProject(2, "Deconstructionism and animal rights");
joinGroup(4, $projectId);
addDraft($projectId, 4, "Quisque eget ornare neque. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut malesuada nisi eu diam tincidunt blandit. In tristique fringilla lorem nec ultrices. Duis elementum sollicitudin metus. Integer ac mi leo. Phasellus sit amet felis tincidunt ipsum imperdiet aliquet. Vivamus condimentum interdum erat, quis elementum libero ultrices sed. Maecenas sodales ipsum nec tincidunt cursus. Mauris ullamcorper condimentum dolor nec viverra. Donec sit amet risus malesuada, pellentesque nunc in, tincidunt ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.");

$projectId = addProject(3, "Feyeraband vs. Kuhn");
joinGroup(3, $projectId);
joinGroup(5, $projectId);
addDraft($projectId, 3, "Integer egestas tincidunt dolor elementum posuere. Ut malesuada, enim vitae commodo finibus, velit mi elementum dolor, ullamcorper ornare risus augue convallis mauris. Mauris sed ultrices ex. Curabitur nec ultricies magna, id posuere lacus. Aenean elementum suscipit velit, sed scelerisque eros. Cras nec tellus molestie orci pellentesque ullamcorper at id elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent feugiat dictum dui, semper congue lacus sollicitudin vitae. Praesent nec elit accumsan, condimentum diam quis, ornare nunc. Nam et varius velit, eget posuere leo. Vestibulum ullamcorper nisl vel ligula commodo eleifend. Duis metus lorem, efficitur at magna ut, ultricies tempus lacus. In egestas pulvinar sem sit amet lobortis. Morbi finibus magna mattis dolor dictum lobortis. Pellentesque facilisis, arcu eu tempor vulputate, lorem elit tempus nulla, ac consectetur ante mi et enim. Quisque eu eros in diam convallis facilisis sed at lacus.");

$projectId = addProject(4, "Recursion is weird (weird (weird + 1))");
joinGroup(4, $projectId);
addDraft($projectId, 4, "Quisque eget ornare neque. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut malesuada nisi eu diam tincidunt blandit. In tristique fringilla lorem nec ultrices. Duis elementum sollicitudin metus. Integer ac mi leo. Phasellus sit amet felis tincidunt ipsum imperdiet aliquet. Vivamus condimentum interdum erat, quis elementum libero ultrices sed. Maecenas sodales ipsum nec tincidunt cursus. Mauris ullamcorper condimentum dolor nec viverra. Donec sit amet risus malesuada, pellentesque nunc in, tincidunt ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.");
