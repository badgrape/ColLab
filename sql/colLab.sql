CREATE DATABASE collab;
GRANT ALL PRIVILEGES ON collab.* TO 'jim'@'localhost' IDENTIFIED BY 's3ns3nn0s3n' WITH GRANT OPTION;
USE collab;

-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 14, 2017 at 09:43 PM
-- Server version: 5.7.17-0ubuntu0.16.04.2
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collab`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `assignid` int(5) NOT NULL,
  `assigntitle` varchar(64) NOT NULL,
  `instructions` text NOT NULL,
  `course` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`assignid`, `assigntitle`, `instructions`, `course`) VALUES
(1, 'Term paper', 'Cras efficitur metus quam, elementum luctus augue dignissim in. Nunc iaculis gravida mauris et aliquam.', 1),
(2, 'Literature review', 'Nunc dignissim dui ac neque iaculis pulvinar. Praesent commodo eleifend metus, quis molestie neque porta et. Donec in augue at metus finibus porttitor. Fusce interdum sapien sed dictum ultricies.', 2),
(3, 'Inference to the best explanation', 'Cras efficitur metus quam, elementum luctus augue dignissim in. Nunc iaculis gravida mauris et aliquam. Integer vel tempor felis. In hac habitasse platea dictumst. Nulla rutrum efficitur turpis, venenatis ultricies justo congue a.', 3),
(4, 'Recursive algorithms', 'Nunc dignissim dui ac neque iaculis pulvinar. Praesent commodo eleifend metus, quis molestie neque porta et. Donec in augue at metus finibus porttitor. Fusce interdum sapien sed dictum ultricies.', 4);

-- --------------------------------------------------------

--
-- Table structure for table `bibliorevisions`
--

CREATE TABLE `bibliorevisions` (
  `project` int(5) NOT NULL,
  `student` int(5) NOT NULL,
  `dateupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bibliotext` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseid` int(5) NOT NULL,
  `coursename` varchar(64) NOT NULL,
  `discipline` varchar(32) NOT NULL,
  `teacher` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseid`, `coursename`, `discipline`, `teacher`) VALUES
(1, 'Intro to fashion theory', 'Communications', 1),
(2, 'Foucault\'s critical theory', 'Philosophy', 1),
(3, 'Philosophy of science', 'Humanities', 2),
(4, 'Programming LISP', 'Computer Science', 2);

-- --------------------------------------------------------

--
-- Table structure for table `discussreplies`
--

CREATE TABLE `discussreplies` (
  `topic` int(5) NOT NULL,
  `userid` int(5) NOT NULL,
  `dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `replytext` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discusstopics`
--

CREATE TABLE `discusstopics` (
  `topicid` int(5) NOT NULL,
  `project` int(5) NOT NULL,
  `student` int(5) NOT NULL,
  `topictitle` varchar(64) NOT NULL,
  `topictext` text NOT NULL,
  `dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `filename` varchar(32) NOT NULL,
  `project` int(5) NOT NULL,
  `student` int(5) NOT NULL,
  `linktext` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `student` int(5) NOT NULL,
  `project` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`student`, `project`) VALUES
(3, 1),
(5, 1),
(4, 2),
(3, 3),
(5, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `projectrevisions`
--

CREATE TABLE `projectrevisions` (
  `project` int(5) NOT NULL,
  `student` int(5) NOT NULL,
  `dateupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projecttext` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projectrevisions`
--

INSERT INTO `projectrevisions` (`project`, `student`, `dateupdated`, `projecttext`) VALUES
(1, 3, '2017-04-15 01:40:04', 'Integer egestas tincidunt dolor elementum posuere. Ut malesuada, enim vitae commodo finibus, velit mi elementum dolor, ullamcorper ornare risus augue convallis mauris. Mauris sed ultrices ex. Curabitur nec ultricies magna, id posuere lacus. Aenean elementum suscipit velit, sed scelerisque eros. Cras nec tellus molestie orci pellentesque ullamcorper at id elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent feugiat dictum dui, semper congue lacus sollicitudin vitae. Praesent nec elit accumsan, condimentum diam quis, ornare nunc. Nam et varius velit, eget posuere leo. Vestibulum ullamcorper nisl vel ligula commodo eleifend. Duis metus lorem, efficitur at magna ut, ultricies tempus lacus. In egestas pulvinar sem sit amet lobortis. Morbi finibus magna mattis dolor dictum lobortis. Pellentesque facilisis, arcu eu tempor vulputate, lorem elit tempus nulla, ac consectetur ante mi et enim. Quisque eu eros in diam convallis facilisis sed at lacus.'),
(2, 4, '2017-04-15 01:40:04', 'Quisque eget ornare neque. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut malesuada nisi eu diam tincidunt blandit. In tristique fringilla lorem nec ultrices. Duis elementum sollicitudin metus. Integer ac mi leo. Phasellus sit amet felis tincidunt ipsum imperdiet aliquet. Vivamus condimentum interdum erat, quis elementum libero ultrices sed. Maecenas sodales ipsum nec tincidunt cursus. Mauris ullamcorper condimentum dolor nec viverra. Donec sit amet risus malesuada, pellentesque nunc in, tincidunt ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(3, 3, '2017-04-15 01:40:04', 'Integer egestas tincidunt dolor elementum posuere. Ut malesuada, enim vitae commodo finibus, velit mi elementum dolor, ullamcorper ornare risus augue convallis mauris. Mauris sed ultrices ex. Curabitur nec ultricies magna, id posuere lacus. Aenean elementum suscipit velit, sed scelerisque eros. Cras nec tellus molestie orci pellentesque ullamcorper at id elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent feugiat dictum dui, semper congue lacus sollicitudin vitae. Praesent nec elit accumsan, condimentum diam quis, ornare nunc. Nam et varius velit, eget posuere leo. Vestibulum ullamcorper nisl vel ligula commodo eleifend. Duis metus lorem, efficitur at magna ut, ultricies tempus lacus. In egestas pulvinar sem sit amet lobortis. Morbi finibus magna mattis dolor dictum lobortis. Pellentesque facilisis, arcu eu tempor vulputate, lorem elit tempus nulla, ac consectetur ante mi et enim. Quisque eu eros in diam convallis facilisis sed at lacus.'),
(4, 4, '2017-04-15 01:40:04', 'Quisque eget ornare neque. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut malesuada nisi eu diam tincidunt blandit. In tristique fringilla lorem nec ultrices. Duis elementum sollicitudin metus. Integer ac mi leo. Phasellus sit amet felis tincidunt ipsum imperdiet aliquet. Vivamus condimentum interdum erat, quis elementum libero ultrices sed. Maecenas sodales ipsum nec tincidunt cursus. Mauris ullamcorper condimentum dolor nec viverra. Donec sit amet risus malesuada, pellentesque nunc in, tincidunt ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `projectid` int(5) NOT NULL,
  `assign` int(5) NOT NULL,
  `projecttitle` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projectid`, `assign`, `projecttitle`) VALUES
(1, 1, 'Our fashion essay'),
(2, 2, 'Deconstructionism and animal rights'),
(3, 3, 'Feyeraband vs. Kuhn'),
(4, 4, 'Recursion is weird (weird (weird + 1))');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `student` int(5) NOT NULL,
  `course` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`student`, `course`) VALUES
(3, 1),
(5, 1),
(3, 2),
(6, 2),
(4, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(5) NOT NULL,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `role` char(7) NOT NULL,
  `email` varchar(64) NOT NULL,
  `salt` varchar(16) NOT NULL,
  `hash` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `fname`, `lname`, `role`, `email`, `salt`, `hash`) VALUES
(1, 'Emily', 'Raine', 'teacher', 'emily@badgrape.net', '<_4A=v', '336ba4daea46b88fb942bbce646774df'),
(2, 'Jim', 'Morris', 'teacher', 'jim@badgrape.net', '6wj:JsS zJm?', 'e988de2098a4cc1fab241630a5f70c04'),
(3, 'Jujube', 'Beagle', 'student', 'jujube@badgrape.net', ' *Jb!*^2@p9', '22d2cf8c0c358d6aa67398daa7ad87c6'),
(4, 'Rogero', 'El Lobo', 'student', 'rogero@badgrape.net', '~ma;yWrqB,<', '1cfce82fbb7b8675d5aacacc2f989390'),
(5, 'Ray-Rogers', 'Barabe', 'student', 'ray@badgrape.net', '5\0\\/JIokt9M', '86b59a994da2adedc77be493d5c0337d'),
(6, 'Stevie', 'Sharp', 'student', 'steven@badgrape.net', 'Vwt8dAWb/9', 'bd382dafbca51511ff5b9c9102e77c2a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`assignid`),
  ADD KEY `course` (`course`);

--
-- Indexes for table `bibliorevisions`
--
ALTER TABLE `bibliorevisions`
  ADD PRIMARY KEY (`project`,`student`,`dateupdated`),
  ADD KEY `student` (`student`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseid`),
  ADD KEY `teacher` (`teacher`);

--
-- Indexes for table `discussreplies`
--
ALTER TABLE `discussreplies`
  ADD PRIMARY KEY (`topic`,`userid`,`dateposted`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `discusstopics`
--
ALTER TABLE `discusstopics`
  ADD PRIMARY KEY (`topicid`),
  ADD KEY `project` (`project`),
  ADD KEY `student` (`student`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`filename`,`project`),
  ADD KEY `project` (`project`),
  ADD KEY `student` (`student`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`student`,`project`),
  ADD KEY `project` (`project`);

--
-- Indexes for table `projectrevisions`
--
ALTER TABLE `projectrevisions`
  ADD PRIMARY KEY (`project`,`student`,`dateupdated`),
  ADD KEY `student` (`student`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`projectid`),
  ADD KEY `assign` (`assign`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`student`,`course`),
  ADD KEY `course` (`course`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `assignid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `discusstopics`
--
ALTER TABLE `discusstopics`
  MODIFY `topicid` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projectid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`course`) REFERENCES `courses` (`courseid`) ON DELETE CASCADE;

--
-- Constraints for table `bibliorevisions`
--
ALTER TABLE `bibliorevisions`
  ADD CONSTRAINT `bibliorevisions_ibfk_1` FOREIGN KEY (`student`) REFERENCES `users` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `bibliorevisions_ibfk_2` FOREIGN KEY (`project`) REFERENCES `projects` (`projectid`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `discussreplies`
--
ALTER TABLE `discussreplies`
  ADD CONSTRAINT `discussreplies_ibfk_1` FOREIGN KEY (`topic`) REFERENCES `discusstopics` (`topicid`) ON DELETE CASCADE,
  ADD CONSTRAINT `discussreplies_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `discusstopics`
--
ALTER TABLE `discusstopics`
  ADD CONSTRAINT `discusstopics_ibfk_1` FOREIGN KEY (`project`) REFERENCES `projects` (`projectid`) ON DELETE CASCADE,
  ADD CONSTRAINT `discusstopics_ibfk_2` FOREIGN KEY (`student`) REFERENCES `users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`project`) REFERENCES `projects` (`projectid`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`student`) REFERENCES `users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`student`) REFERENCES `users` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `groups_ibfk_2` FOREIGN KEY (`project`) REFERENCES `projects` (`projectid`) ON DELETE CASCADE;

--
-- Constraints for table `projectrevisions`
--
ALTER TABLE `projectrevisions`
  ADD CONSTRAINT `projectrevisions_ibfk_1` FOREIGN KEY (`student`) REFERENCES `users` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `projectrevisions_ibfk_2` FOREIGN KEY (`project`) REFERENCES `projects` (`projectid`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`assign`) REFERENCES `assignments` (`assignid`) ON DELETE CASCADE;

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`student`) REFERENCES `users` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`course`) REFERENCES `courses` (`courseid`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
