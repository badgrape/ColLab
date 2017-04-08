set foreign_key_checks = 0;

drop table if exists users;
drop table if exists courses;
drop table if exists registration;
drop table if exists assignments;
drop table if exists projects;
drop table if exists groups;
drop table if exists projectrevisions;
drop table if exists bibliorevisions;
drop table if exists files;
drop table if exists discusstopics;
drop table if exists discussreplies;

set foreign_key_checks = 1;

-- Users ( userid(integer), fname(varchar), lname(varchar), email(varchar), role(varchar), salt(varchar), hash(varchar) );
create table users (
	userid integer(5) not null auto_increment,
	fname varchar(32) not null,
	lname varchar(32) not null,
	email varchar(64) not null,
	salt varchar(16) not null,
	hash varchar(256) not null,
	primary key (userid)
);

-- Courses ( courseid(integer), coursename(varchar), discipline(varchar), teacher(fk: userid) );
create table courses (
	courseid integer(5) not null auto_increment,
	coursename varchar(64) not null,
	discipline varchar(32) not null,
	teacher integer(5) not null,
	primary key (courseid),
	foreign key (teacher) references users(userid)
		on delete cascade
);

-- Registration ( student(fk: userid), course(fk: courseid) );
create table registration (
	student integer(5) not null,
	course integer(5) not null,
	primary key (student, course),
	foreign key (student) references users(userid)
		on delete cascade,
	foreign key (course) references courses(courseid)
		on delete cascade
);

-- Assignments ( assignid(integer), instructions(varchar), courseid(fk: courseid) );
create table assignments (
	assignid integer(5) not null,
	instructions text not null,
	course integer(5) not null,
	primary key (assignid),
	foreign key (course) references courses(courseid)
		on delete cascade
);

-- Projects ( projectid(integer), assign(fk: assignid), projecttitle(varchar) );
create table projects (
	projectid integer(5) not null,
	assign integer(5) not null,
	projecttitle varchar(64) not null,
	primary key (projectid),
	foreign key (assign) references assignments(assignid)
		on delete cascade
);

-- Groups ( student(fk: userid), project(fk: projectid) );
create table groups (
	student integer(5) not null,
	project integer(5) not null,
	primary key (student, project),
	foreign key (student) references users(userid)
		on delete cascade,
	foreign key (project)	references projects(projectid)
		on delete cascade
);

-- ProjectRevisions ( project(fk: projectid), student(fk: userid), dateupdated(timestamp), projecttext(text) );
create table projectrevisions (
	project integer(5) not null,
	student integer(5) not null,
	dateupdated timestamp not null,
	projecttext text not null,
	primary key (project, student, dateupdated),
	foreign key (student) references users(userid)
		on delete cascade,
	foreign key (project)	references projects(projectid)
		on delete cascade
);

-- BiblioRevisions ( project(fk: projectid), student(fk: userid), dateupdated(timestamp), bibliotext(text) );
create table bibliorevisions (
	project integer(5) not null,
	student integer(5) not null,
	dateupdated timestamp not null,
	bibliotext text not null,
	primary key (project, student, dateupdated),
	foreign key (student) references users(userid)
		on delete cascade,
	foreign key (project)	references projects(projectid)
		on delete cascade
);

-- Files ( filename(varchar), project(fk: projectid), student(fk: userid); linktext(varchar) );
create table files (
	filename varchar(32) not null,
	project integer(5) not null,
	student integer(5) not null,
	linktext varchar(32) not null,
	primary key (filename, project),
	foreign key (project)	references projects(projectid)
		on delete cascade,
	foreign key (student) references users(userid)
		on delete cascade
);

-- DiscussTopics ( topicid(int), project(fk: projectid), student(fk: userid), topictitle(varchar), topictext(text), dateposted(timestamp) );
create table discusstopics (
	topicid integer(5) not null,
	project integer(5) not null,
	student integer(5) not null,
	topictitle varchar(64) not null,
	topictext text not null,
	dateposted timestamp not null,
	primary key (topicid),
	foreign key (project)	references projects(projectid)
		on delete cascade,
	foreign key (student) references users(userid)
		on delete cascade
);

-- DiscussReplies ( topic(fk: topicid), userid(fk: userid), dateposted(timestamp), replytext(text) );
create table discussreplies (
	topic integer(5) not null,
	userid integer(5) not null,
	dateposted timestamp not null,
	replytext text not null,
	primary key (topic, userid, dateposted),
	foreign key (topic) references discusstopics(topicid)
		on delete cascade,
	foreign key (userid) references users(userid)
		on delete cascade
);
