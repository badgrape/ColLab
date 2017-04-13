CREATE DATABASE collab;
GRANT ALL PRIVILEGES ON collab.* TO 'jim'@'localhost' IDENTIFIED BY 's3ns3nn0s3n' WITH GRANT OPTION;

-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2017 at 07:34 AM
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
(1, 'Term paper', 'This is going to be REALLY HARD, so don\'t screw it up.', 1),
(2, 'Literature review', 'Write whatever you want. You\'re all getting the same mark.', 2),
(3, 'Environmental challenge', 'This exercise is worth 10% of your final grade. Start a project and learn something.', 3),
(4, 'Make some clothes!', 'H&M sucks! Save your money.', 1),
(5, 'Go play something dangerous', '3-2-1 Polo!!', 8);

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

--
-- Dumping data for table `bibliorevisions`
--

INSERT INTO `bibliorevisions` (`project`, `student`, `dateupdated`, `bibliotext`) VALUES
(1, 5, '2017-04-09 21:51:05', 'Hilary Putnam, Representation and Reality.'),
(2, 4, '2017-04-09 21:51:05', 'Dylan Thomas, Fern Hill.');

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
(2, 'Anarchism and philosophy of science', 'Humanities', 2),
(3, 'Perspectives on ecology and environmental activism', 'Philosophy', 2),
(8, 'Sport and counterculture', 'Humanities', 2),
(9, 'Deleuze and Guattari', 'Philosophy', 1);

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

--
-- Dumping data for table `discussreplies`
--

INSERT INTO `discussreplies` (`topic`, `userid`, `dateposted`, `replytext`) VALUES
(1, 1, '2017-04-09 21:51:05', 'Don\'t be so hard on yourself'),
(1, 5, '2017-04-09 21:51:05', 'Quisque eu mauris vitae magna pellentesque auctor'),
(2, 2, '2017-04-09 21:51:05', 'Love yourself to death, because that\'s where you\'re headed anyway (a guy named Marcel).'),
(2, 4, '2017-04-09 21:51:05', 'Sound advice. Cras dictum lectus non pellentesque sodales.');

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

--
-- Dumping data for table `discusstopics`
--

INSERT INTO `discusstopics` (`topicid`, `project`, `student`, `topictitle`, `topictext`, `dateposted`) VALUES
(1, 1, 3, 'I\'m so confused', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '2017-04-09 21:51:05'),
(2, 2, 4, 'I got it!', 'Ut vitae nibh ut justo lacinia pretium.', '2017-04-09 21:51:05');

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

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`filename`, `project`, `student`, `linktext`) VALUES
('projectjournal.docx', 1, 3, 'Random thoughts'),
('research.odt', 2, 4, 'Important information');

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
(4, 2);

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
(1, 3, '2017-04-09 21:51:05', 'Colourless green ideas sleep furiously.'),
(2, 4, '2017-04-09 21:51:05', 'Oh and as I was young and easy in the mercy of his means, time held me green and dying, though I sang in my chains like the sea.'),
(2, 4, '2017-04-13 06:07:25', 'p'),
(2, 4, '2017-04-13 06:55:46', 'Oh and as I was young and easy in the mercy of his means, time held me green and dying, though I sang in my chains like the sea.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam semper dictum. In odio diam, varius ac est in, elementum blandit lacus. Vivamus ut risus vitae metus hendrerit suscipit. Sed vel libero vel quam dictum pellentesque at vitae odio. Vivamus sit amet elit a est blandit sollicitudin. Donec id congue urna. Maecenas id bibendum nunc, sit amet consectetur ex. Donec aliquam tortor felis, eget iaculis elit vehicula non. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed elementum eget enim posuere vulputate. Aliquam dictum libero nec laoreet cursus. Mauris ligula eros, luctus sed fermentum maximus, euismod a felis. Vestibulum nec augue sit amet arcu facilisis sollicitudin. Nam justo libero, elementum vel sem sit amet, laoreet venenatis ipsum. Nam volutpat posuere feugiat. In tincidunt, sapien sit amet laoreet pellentesque, ipsum eros rhoncus urna, sed sollicitudin odio orci ut felis.\r\n'),
(2, 4, '2017-04-13 07:01:55', 'Oh and as I was young and easy in the mercy of his means, time held me green and dying, though I sang in my chains like the sea.'),
(2, 4, '2017-04-13 07:03:34', 'Oh and as I was young and easy in the mercy of his means, time held me green and dying, though I sang in my chains like the sea.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam semper dictum. In odio diam, varius ac est in, elementum blandit lacus. Vivamus ut risus vitae metus hendrerit suscipit. Sed vel libero vel quam dictum pellentesque at vitae odio. Vivamus sit amet elit a est blandit sollicitudin. Donec id congue urna. Maecenas id bibendum nunc, sit amet consectetur ex. Donec aliquam tortor felis, eget iaculis elit vehicula non. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed elementum eget enim posuere vulputate. Aliquam dictum libero nec laoreet cursus. Mauris ligula eros, luctus sed fermentum maximus, euismod a felis. Vestibulum nec augue sit amet arcu facilisis sollicitudin. Nam justo libero, elementum vel sem sit amet, laoreet venenatis ipsum. Nam volutpat posuere feugiat. In tincidunt, sapien sit amet laoreet pellentesque, ipsum eros rhoncus urna, sed sollicitudin odio orci ut felis.\r\n'),
(2, 4, '2017-04-13 07:24:32', '<p>Oh and as I was young and easy in the mercy of his means, time held me green and dying, though I sang in my chains like the sea.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam semper dictum. In odio diam, varius ac est in, elementum blandit lacus. Vivamus ut risus vitae metus hendrerit suscipit. Sed vel libero vel quam dictum pellentesque at vitae odio. Vivamus sit amet elit a est blandit sollicitudin. Donec id congue urna. Maecenas id bibendum nunc, sit amet consectetur ex. Donec aliquam tortor felis, eget iaculis elit vehicula non. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed elementum eget enim posuere vulputate. Aliquam dictum libero nec laoreet cursus. Mauris ligula eros, luctus sed fermentum maximus, euismod a felis. Vestibulum nec augue sit amet arcu facilisis sollicitudin. Nam justo libero, elementum vel sem sit amet, laoreet venenatis ipsum. Nam volutpat posuere feugiat. In tincidunt, sapien sit amet laoreet pellentesque, ipsum eros rhoncus urna, sed sollicitudin odio orci ut felis.</p>\r\n'),
(2, 4, '2017-04-13 07:25:28', '<p>Oh and as I was young and easy in the mercy of his means, time held me green and dying, though I sang in my chains like the sea.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam semper dictum. In odio diam, varius ac est in, elementum blandit lacus. Vivamus ut risus vitae metus hendrerit suscipit. Sed vel libero vel quam dictum pellentesque at vitae odio. Vivamus sit amet elit a est blandit sollicitudin. Donec id congue urna. Maecenas id bibendum nunc, sit amet consectetur ex. Donec aliquam tortor felis, eget iaculis elit vehicula non. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed elementum eget enim posuere vulputate. Aliquam dictum libero nec laoreet cursus. Mauris ligula eros, luctus sed fermentum maximus, euismod a felis. Vestibulum nec augue sit amet arcu facilisis sollicitudin. Nam justo libero, elementum vel sem sit amet, laoreet venenatis ipsum. Nam volutpat posuere feugiat. In tincidunt, sapien sit amet laoreet pellentesque, ipsum eros rhoncus urna, sed sollicitudin odio orci ut felis.</p>\r\n'),
(2, 4, '2017-04-13 07:26:34', '<p>Oh and as I was young and easy in the mercy of his means, time held me green and dying, though I sang in my chains like the sea.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam semper dictum. In odio diam, varius ac est in, elementum blandit lacus. Vivamus ut risus vitae metus hendrerit suscipit. Sed vel libero vel quam dictum pellentesque at vitae odio. Vivamus sit amet elit a est blandit sollicitudin. Donec id congue urna. Maecenas id bibendum nunc, sit amet consectetur ex. Donec aliquam tortor felis, eget iaculis elit vehicula non. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed elementum eget enim posuere vulputate. Aliquam dictum libero nec laoreet cursus. Mauris ligula eros, luctus sed fermentum maximus, euismod a felis. Vestibulum nec augue sit amet arcu facilisis sollicitudin. Nam justo libero, elementum vel sem sit amet, laoreet venenatis ipsum. Nam volutpat posuere feugiat. In tincidunt, sapien sit amet laoreet pellentesque, ipsum eros rhoncus urna, sed sollicitudin odio orci ut felis.</p>\r\n'),
(2, 4, '2017-04-13 07:27:33', '<p><strong>Oh and as I was young and easy in the mercy of his means, time held me green and dying, though I sang in my chains like the sea.</strong></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam semper dictum. In odio diam, varius ac est in, elementum blandit lacus. Vivamus ut risus vitae metus hendrerit suscipit. Sed vel libero vel quam dictum pellentesque at vitae odio. Vivamus sit amet elit a est blandit sollicitudin. Donec id congue urna. Maecenas id bibendum nunc, sit amet consectetur ex. Donec aliquam tortor felis, eget iaculis elit vehicula non. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed elementum eget enim posuere vulputate. Aliquam dictum libero nec laoreet cursus. Mauris ligula eros, luctus sed fermentum maximus, euismod a felis. Vestibulum nec augue sit amet arcu facilisis sollicitudin. Nam justo libero, elementum vel sem sit amet, laoreet venenatis ipsum. Nam volutpat posuere feugiat. In tincidunt, sapien sit amet laoreet pellentesque, ipsum eros rhoncus urna, sed sollicitudin odio orci ut felis.</p>\r\n'),
(2, 4, '2017-04-13 07:29:12', '<h1>Oh and as I was young and easy in the mercy of his means, time held me green and dying, though I sang in my chains like the sea.</h1>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam semper dictum. In odio diam, varius ac est in, elementum blandit lacus. Vivamus ut risus vitae metus hendrerit suscipit. Sed vel libero vel quam dictum pellentesque at vitae odio. Vivamus sit amet elit a est blandit sollicitudin. Donec id congue urna. Maecenas id bibendum nunc, sit amet consectetur ex. Donec aliquam tortor felis, eget iaculis elit vehicula non. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed elementum eget enim posuere vulputate. Aliquam dictum libero nec laoreet cursus. Mauris ligula eros, luctus sed fermentum maximus, euismod a felis. Vestibulum nec augue sit amet arcu facilisis sollicitudin. Nam justo libero, elementum vel sem sit amet, laoreet venenatis ipsum. Nam volutpat posuere feugiat. In tincidunt, sapien sit amet laoreet pellentesque, ipsum eros rhoncus urna, sed sollicitudin odio orci ut felis.</p>\r\n'),
(2, 4, '2017-04-13 07:48:01', '<h1>Oh and as I was young and easy in the mercy of his means, time held me green and dying, though I sang in my chains like the sea.</h1>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam semper dictum. In odio diam, varius ac est in, elementum blandit lacus. Vivamus ut risus vitae metus hendrerit suscipit. Sed vel libero vel quam dictum pellentesque at vitae odio. Vivamus sit amet elit a est blandit sollicitudin. Donec id congue urna. Maecenas id bibendum nunc, sit amet consectetur ex. Donec aliquam tortor felis, eget iaculis elit vehicula non. <strong>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed elementum eget enim posuere vulputate. Aliquam dictum libero nec laoreet cursus. Mauris ligula eros, luctus sed fermentum maximus, euismod a felis.</strong> Vestibulum nec augue sit amet arcu facilisis sollicitudin. Nam justo libero, elementum vel sem sit amet, laoreet venenatis ipsum. Nam volutpat posuere feugiat. In tincidunt, sapien sit amet laoreet pellentesque, ipsum eros rhoncus urna, sed sollicitudin odio orci ut felis.</p>\r\n'),
(2, 4, '2017-04-13 11:02:40', '<h1>Oh and as I was young and easy in the mercy of his means, time held me green and dying, though I sang in my chains like the sea.</h1>\r\n<p>Lorem ipsum dolor sit amet, <big>consectetur</big> adipiscing elit. Nunc aliquam semper dictum. In odio diam, varius ac est in, elementum blandit lacus. Vivamus ut risus vitae metus hendrerit suscipit. Sed vel libero vel quam dictum pellentesque at vitae odio. Vivamus sit amet elit a est blandit sollicitudin. Donec id congue urna. Maecenas id bibendum nunc, sit amet consectetur ex. Donec aliquam tortor felis, eget iaculis elit vehicula non. <strong>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed elementum eget enim posuere vulputate. Aliquam dictum libero nec laoreet cursus. Mauris ligula eros, luctus sed fermentum maximus, euismod a felis.</strong> Vestibulum nec augue sit amet arcu facilisis sollicitudin. Nam justo libero, elementum vel sem sit amet, laoreet venenatis ipsum. Nam volutpat posuere feugiat. In tincidunt, sapien sit amet laoreet pellentesque, ipsum eros rhoncus urna, sed sollicitudin odio orci ut felis.</p>\r\n');

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
(1, 1, 'Best essay ever!'),
(2, 2, 'Smash the cistern!');

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
(4, 2);

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
(1, 'Emily', 'Raine', 'teacher', 'mochi@badgrape.net', 'qE(w-yD\0=[j', '62f1af67a4ef36f4150547f019aca4ce'),
(2, 'Jim', 'Morris', 'teacher', 'jim@badgrape.net', 'xph(>)Q4c"e4', 'be07ef34135f6d2df5267fc088394eba'),
(3, 'Jujube', 'Beagle', 'student', 'tubetube@badgrape.net', 'Qy;k\\cc\\', '25078690273d40eb966407af5b2cf73e'),
(4, 'Rogero', 'El Lobo', 'student', 'rog@badgrape.net', '\nL2\rvCj?l', '839875651802ed7b15dd6b54726e8b7f'),
(5, 'R2', 'Kid Hacker', 'student', 'dirtyflash@badgrape.net', 'f=^Ug``', '4ee4c54b84e30382ae13d5647fe53d7d');

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
  MODIFY `assignid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `discusstopics`
--
ALTER TABLE `discusstopics`
  MODIFY `topicid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projectid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
