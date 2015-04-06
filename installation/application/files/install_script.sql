DROP TABLE IF EXISTS `tams_access_assigns`;
CREATE TABLE IF NOT EXISTS `tams_access_assigns` (
  `assignid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(255) unsigned NOT NULL,
  `parenttype` enum('group','role','user') NOT NULL,
  `childid` int(255) unsigned NOT NULL,
  `childtype` enum('role','perm') NOT NULL,
  `extradata` text,
  PRIMARY KEY (`assignid`),
  KEY `parentid` (`parentid`),
  KEY `childid` (`childid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


-- --------------------------------------------------------

--
-- Table structure for table `tams_colleges`
--

DROP TABLE IF EXISTS `tams_colleges`;
CREATE TABLE IF NOT EXISTS `tams_colleges` (
  `colid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `colname` varchar(255) NOT NULL,
  `colcode` varchar(10) NOT NULL,
  `coltitle` varchar(10) DEFAULT NULL,
  `remark` text,
  `special` enum('TRUE','FALSE') DEFAULT 'FALSE',
  PRIMARY KEY (`colid`),
  UNIQUE KEY `colcode` (`colcode`),
  UNIQUE KEY `colname` (`colname`),
  UNIQUE KEY `coltitle` (`coltitle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_departments`
--

DROP TABLE IF EXISTS `tams_departments`;
CREATE TABLE IF NOT EXISTS `tams_departments` (
  `deptid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `deptname` varchar(255) NOT NULL,
  `deptcode` varchar(10) DEFAULT NULL,
  `colid` int(255) unsigned NOT NULL,
  `remark` text,
  PRIMARY KEY (`deptid`),
  UNIQUE KEY `deptname` (`deptname`),
  UNIQUE KEY `deptcode` (`deptcode`),
  KEY `colid_idx` (`colid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_exams`
--

DROP TABLE IF EXISTS `tams_exams`;
CREATE TABLE IF NOT EXISTS `tams_exams` (
  `examid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `groupid` int(255) unsigned NOT NULL,
  `examname` varchar(255) NOT NULL,
  `shortname` varchar(20) NOT NULL,
  `validyears` tinyint(3) unsigned NOT NULL DEFAULT '10',
  `minsubject` tinyint(3) unsigned NOT NULL DEFAULT '7',
  `scorebased` enum('true','false') NOT NULL DEFAULT 'false',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`examid`),
  UNIQUE KEY `examname` (`examname`),
  UNIQUE KEY `shortname` (`shortname`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_exam_grades`
--

DROP TABLE IF EXISTS `tams_exam_grades`;
CREATE TABLE IF NOT EXISTS `tams_exam_grades` (
  `examgradeid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `examid` int(255) unsigned NOT NULL,
  `gradeid` int(255) unsigned NOT NULL,
  PRIMARY KEY (`examgradeid`),
  KEY `examid` (`examid`),
  KEY `gradeid` (`gradeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_exam_groups`
--

DROP TABLE IF EXISTS `tams_exam_groups`;
CREATE TABLE IF NOT EXISTS `tams_exam_groups` (
  `groupid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(50) NOT NULL,
  `required` enum('TRUE','FALSE') NOT NULL DEFAULT 'FALSE',
  `maxentries` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`groupid`),
  UNIQUE KEY `groupname` (`groupname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_exam_periods`
--

DROP TABLE IF EXISTS `tams_exam_periods`;
CREATE TABLE IF NOT EXISTS `tams_exam_periods` (
  `periodid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `examid` int(255) unsigned NOT NULL,
  `periodname` varchar(50) NOT NULL,
  PRIMARY KEY (`periodid`),
  UNIQUE KEY `periodname` (`periodname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_exam_subjects`
--

DROP TABLE IF EXISTS `tams_exam_subjects`;
CREATE TABLE IF NOT EXISTS `tams_exam_subjects` (
  `examsubjectid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `examid` int(255) unsigned NOT NULL,
  `subjectid` int(255) unsigned NOT NULL,
  PRIMARY KEY (`examsubjectid`),
  KEY `examid` (`examid`),
  KEY `subjectid` (`subjectid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_grades`
--

DROP TABLE IF EXISTS `tams_grades`;
CREATE TABLE IF NOT EXISTS `tams_grades` (
  `gradeid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `gradename` varchar(20) NOT NULL,
  `gradeweight` tinyint(1) unsigned NOT NULL,
  `gradedesc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`gradeid`),
  UNIQUE KEY `gradename` (`gradename`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_groups`
--

DROP TABLE IF EXISTS `tams_groups`;
CREATE TABLE IF NOT EXISTS `tams_groups` (
  `groupid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `owner` int(255) unsigned NOT NULL,
  `schoolid` int(255) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`groupid`),
  UNIQUE KEY `name` (`name`,`owner`,`schoolid`),
  KEY `owner` (`owner`),
  KEY `schoolid` (`schoolid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tams_groups`
--

INSERT INTO `tams_groups` (`groupid`, `name`, `owner`, `schoolid`, `description`) VALUES
(1, 'Student', 1, 1, ''),
(2, 'Staff', 1, 1, 'Used to manage tams users\r\n'),
(3, 'Management', 1, 1, 'Used to manage management users\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tams_group_users`
--

DROP TABLE IF EXISTS `tams_group_users`;
CREATE TABLE IF NOT EXISTS `tams_group_users` (
  `groupuserid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `groupid` int(255) unsigned NOT NULL,
  `userid` int(255) unsigned NOT NULL,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`groupuserid`),
  KEY `userid` (`userid`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_link_perms`
--

DROP TABLE IF EXISTS `tams_link_perms`;
CREATE TABLE IF NOT EXISTS `tams_link_perms` (
  `linkpermid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `linkid` int(255) unsigned NOT NULL,
  `permid` int(255) unsigned NOT NULL,
  PRIMARY KEY (`linkpermid`),
  KEY `permid` (`permid`),
  KEY `linkid` (`linkid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tams_link_perms`
--

INSERT INTO `tams_link_perms` (`linkpermid`, `linkid`, `permid`) VALUES
(2, 4, 1),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tams_modules`
--

DROP TABLE IF EXISTS `tams_modules`;
CREATE TABLE IF NOT EXISTS `tams_modules` (
  `moduleid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `dispname` varchar(50) NOT NULL,
  `urlprefix` varchar(20) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `tileicon` varchar(30) NOT NULL DEFAULT 'icon-folder-close-alt',
  `tilecolor` varchar(20) NOT NULL DEFAULT 'blue',
  `description` text,
  PRIMARY KEY (`moduleid`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `urlprefix` (`urlprefix`),
  UNIQUE KEY `dispname` (`dispname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tams_modules`
--

INSERT INTO `tams_modules` (`moduleid`, `name`, `dispname`, `urlprefix`, `status`, `tileicon`, `tilecolor`, `description`) VALUES
(1, 'academic_set_up', 'Academic Set-Up', 'setup', 'active', 'icon-cogs', 'blue', NULL),
(2, 'access_control', 'Access Control', 'access', 'active', 'icon-exchange', 'green', NULL),
(3, 'admission', 'Admision', 'admission', 'active', 'icon-folder-close-alt', 'teal', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tams_module_links`
--

DROP TABLE IF EXISTS `tams_module_links`;
CREATE TABLE IF NOT EXISTS `tams_module_links` (
  `linkid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `moduleid` int(255) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(50) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `description` text,
  PRIMARY KEY (`linkid`),
  UNIQUE KEY `moduleid_2` (`moduleid`,`name`),
  KEY `moduleid` (`moduleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tams_module_links`
--

INSERT INTO `tams_module_links` (`linkid`, `moduleid`, `name`, `url`, `status`, `description`) VALUES
(1, 1, 'Exam link', 'admission/exam', 'inactive', NULL),
(2, 1, 'Admission link', 'admission/admission', 'inactive', NULL),
(3, 2, 'Manage Groups', 'groups', 'active', NULL),
(4, 3, 'Admission', 'admission/exam', 'active', NULL),
(5, 2, 'Manage Roles', 'roles', 'active', NULL),
(6, 2, 'Manage Permissions', 'permissions', 'active', NULL),
(7, 2, 'Manage Users', 'users', 'active', NULL),
(8, 1, 'Setup College', 'college', 'active', NULL),
(9, 1, 'Setup Department', 'department', 'active', NULL),
(10, 1, 'Setup Programme', 'programme', 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tams_permissions`
--

DROP TABLE IF EXISTS `tams_permissions`;
CREATE TABLE IF NOT EXISTS `tams_permissions` (
  `permid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `moduleid` int(255) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`permid`),
  UNIQUE KEY `moduleid_2` (`moduleid`,`name`),
  KEY `moduleid` (`moduleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tams_permissions`
--

INSERT INTO `tams_permissions` (`permid`, `moduleid`, `name`, `description`) VALUES
(1, 1, 'jdjdjfjdkdk', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tams_programmes`
--

DROP TABLE IF EXISTS `tams_programmes`;
CREATE TABLE IF NOT EXISTS `tams_programmes` (
  `progid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `progname` varchar(255) NOT NULL,
  `progcode` varchar(10) NOT NULL,
  `deptid` int(255) unsigned NOT NULL,
  `duration` tinyint(1) NOT NULL,
  `registration` enum('Allow','Disallow') NOT NULL DEFAULT 'Allow',
  `remark` text,
  PRIMARY KEY (`progid`),
  UNIQUE KEY `progname` (`progname`),
  UNIQUE KEY `progcode` (`progcode`),
  KEY `deptid` (`deptid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tams_programmes`
--

-- --------------------------------------------------------

--
-- Table structure for table `tams_prospective`
--

DROP TABLE IF EXISTS `tams_prospective`;
CREATE TABLE IF NOT EXISTS `tams_prospective` (
  `userid` int(255) unsigned NOT NULL,
  `formnum` varchar(15) DEFAULT NULL,
  `healthStatus` varchar(10) DEFAULT NULL,
  `examsitnum` int(4) DEFAULT NULL,
  `prog1` int(3) DEFAULT NULL,
  `prog2` int(3) DEFAULT NULL,
  `offerd` int(225) DEFAULT NULL,
  `score` int(3) DEFAULT NULL,
  `status` enum('Not Admitted','Admitted') DEFAULT NULL,
  `sesid` int(255) unsigned NOT NULL,
  `applied` enum('Yes','No') NOT NULL DEFAULT 'No',
  `formpayment` enum('Yes','No') DEFAULT 'No',
  `maritalstatus` varchar(10) DEFAULT NULL,
  `maidenname` varchar(225) DEFAULT NULL,
  `religion` varchar(10) DEFAULT NULL,
  `nationality` int(3) unsigned DEFAULT NULL,
  `stid` int(3) DEFAULT NULL,
  `lga` int(3) DEFAULT NULL,
  `extracurricular` text,
  `sponsorfname` varchar(100) DEFAULT NULL,
  `sponsoroname` varchar(225) DEFAULT NULL,
  `sponsoraddress` text,
  `sponsorphone` varchar(13) DEFAULT NULL,
  `sponsoremail` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  KEY `sesid` (`sesid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tams_reset_request`
--

DROP TABLE IF EXISTS `tams_reset_request`;
CREATE TABLE IF NOT EXISTS `tams_reset_request` (
  `resetid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(255) unsigned NOT NULL,
  `uid` varchar(32) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`resetid`),
  UNIQUE KEY `uid` (`uid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_roles`
--

DROP TABLE IF EXISTS `tams_roles`;
CREATE TABLE IF NOT EXISTS `tams_roles` (
  `roleid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `schoolid` int(255) unsigned NOT NULL,
  `type` enum('role','sys_role') NOT NULL DEFAULT 'role',
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`roleid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_role_users`
--

DROP TABLE IF EXISTS `tams_role_users`;
CREATE TABLE IF NOT EXISTS `tams_role_users` (
  `roleuserid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `roleid` int(255) unsigned NOT NULL,
  `userid` int(255) unsigned NOT NULL,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`roleuserid`),
  KEY `userid` (`userid`),
  KEY `roleid` (`roleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_session`
--

DROP TABLE IF EXISTS `tams_session`;
CREATE TABLE IF NOT EXISTS `tams_session` (
  `sesid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `sesname` varchar(50) NOT NULL,
  `tnumin` tinyint(2) unsigned NOT NULL,
  `tnumax` tinyint(2) unsigned NOT NULL,
  `status` enum('active','closed') NOT NULL DEFAULT 'active',
  `registration` enum('open','closed','reopened') NOT NULL DEFAULT 'open',
  PRIMARY KEY (`sesid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_states`
--

DROP TABLE IF EXISTS `tams_states`;
CREATE TABLE IF NOT EXISTS `tams_states` (
  `stateid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `statename` varchar(50) NOT NULL,
  PRIMARY KEY (`stateid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `tams_states`
--

INSERT INTO `tams_states` (`stateid`, `statename`) VALUES
(1, 'Abia'),
(2, 'Abuja'),
(3, 'Adamawa'),
(4, 'Akwa Ibom'),
(5, 'Anambara'),
(6, 'Bauchi'),
(7, 'Bayelsa'),
(8, 'Benue'),
(9, 'Borno'),
(10, 'Cross River'),
(11, 'Delta'),
(12, 'Ebonyi'),
(13, 'Edo'),
(14, 'Ekiti'),
(15, 'Enugu'),
(16, 'Gombe'),
(17, 'Imo'),
(18, 'Jigawa'),
(19, 'Kaduna'),
(20, 'Kano'),
(21, 'Katsina'),
(22, 'Kebbi'),
(23, 'Kogi'),
(24, 'Kwara'),
(25, 'Lagos'),
(26, 'Nassarawa'),
(27, 'Niger'),
(28, 'Ogun'),
(29, 'Ondo'),
(30, 'Osun'),
(31, 'Oyo'),
(32, 'Plateau'),
(33, 'Rivers'),
(34, 'Sokoto'),
(35, 'Taraba'),
(36, 'Yobe'),
(37, 'Zamfara');

-- --------------------------------------------------------

--
-- Table structure for table `tams_subjects`
--

DROP TABLE IF EXISTS `tams_subjects`;
CREATE TABLE IF NOT EXISTS `tams_subjects` (
  `subid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `subname` varchar(255) NOT NULL,
  PRIMARY KEY (`subid`),
  UNIQUE KEY `subname` (`subname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tams_user_sessions`
--

DROP TABLE IF EXISTS `tams_user_sessions`;
CREATE TABLE IF NOT EXISTS `tams_user_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `tams_departments`
--
ALTER TABLE `tams_departments`
  ADD CONSTRAINT `tams_departments_ibfk_1` FOREIGN KEY (`colid`) REFERENCES `tams_colleges` (`colid`) ON UPDATE CASCADE;

--
-- Constraints for table `tams_exams`
--
ALTER TABLE `tams_exams`
  ADD CONSTRAINT `tams_exams_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `tams_exam_groups` (`groupid`) ON UPDATE CASCADE;

--
-- Constraints for table `tams_exam_grades`
--
ALTER TABLE `tams_exam_grades`
  ADD CONSTRAINT `tams_exam_grades_ibfk_1` FOREIGN KEY (`gradeid`) REFERENCES `tams_grades` (`gradeid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tams_exam_grades_ibfk_2` FOREIGN KEY (`examid`) REFERENCES `tams_exams` (`examid`) ON UPDATE CASCADE;

--
-- Constraints for table `tams_exam_subjects`
--
ALTER TABLE `tams_exam_subjects`
  ADD CONSTRAINT `tams_exam_subjects_ibfk_1` FOREIGN KEY (`examid`) REFERENCES `tams_exams` (`examid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tams_exam_subjects_ibfk_2` FOREIGN KEY (`subjectid`) REFERENCES `tams_subjects` (`subid`) ON UPDATE CASCADE;

--
-- Constraints for table `tams_groups`
--
ALTER TABLE `tams_groups`
  ADD CONSTRAINT `tams_groups_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `tams_users` (`userid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tams_groups_ibfk_2` FOREIGN KEY (`schoolid`) REFERENCES `tams_schools` (`schoolid`) ON UPDATE CASCADE;

--
-- Constraints for table `tams_group_users`
--
ALTER TABLE `tams_group_users`
  ADD CONSTRAINT `tams_group_users_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tams_users` (`userid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tams_group_users_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `tams_groups` (`groupid`) ON UPDATE CASCADE;

--
-- Constraints for table `tams_link_perms`
--
ALTER TABLE `tams_link_perms`
  ADD CONSTRAINT `tams_link_perms_ibfk_1` FOREIGN KEY (`linkid`) REFERENCES `tams_module_links` (`linkid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tams_link_perms_ibfk_2` FOREIGN KEY (`permid`) REFERENCES `tams_permissions` (`permid`) ON UPDATE CASCADE;

--
-- Constraints for table `tams_module_links`
--
ALTER TABLE `tams_module_links`
  ADD CONSTRAINT `tams_module_links_ibfk_1` FOREIGN KEY (`moduleid`) REFERENCES `tams_modules` (`moduleid`) ON UPDATE CASCADE;

--
-- Constraints for table `tams_permissions`
--
ALTER TABLE `tams_permissions`
  ADD CONSTRAINT `tams_permissions_ibfk_1` FOREIGN KEY (`moduleid`) REFERENCES `tams_modules` (`moduleid`) ON UPDATE CASCADE;

--
-- Constraints for table `tams_programmes`
--
ALTER TABLE `tams_programmes`
  ADD CONSTRAINT `tams_programmes_ibfk_1` FOREIGN KEY (`deptid`) REFERENCES `tams_departments` (`deptid`) ON UPDATE CASCADE;

--
-- Constraints for table `tams_prospective`
--
ALTER TABLE `tams_prospective`
  ADD CONSTRAINT `tams_prospective_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tams_users` (`userid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tams_prospective_ibfk_2` FOREIGN KEY (`sesid`) REFERENCES `tams_session` (`sesid`) ON UPDATE CASCADE;

--
-- Constraints for table `tams_reset_request`
--
ALTER TABLE `tams_reset_request`
  ADD CONSTRAINT `tams_reset_request_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tams_users` (`userid`) ON UPDATE CASCADE;

--
-- Constraints for table `tams_role_users`
--
ALTER TABLE `tams_role_users`
  ADD CONSTRAINT `tams_role_users_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `tams_users` (`userid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tams_role_users_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `tams_roles` (`roleid`) ON UPDATE CASCADE;

--
-- Constraints for table `tams_users`
--
ALTER TABLE `tams_users`
  ADD CONSTRAINT `tams_users_ibfk_2` FOREIGN KEY (`schoolid`) REFERENCES `tams_schools` (`schoolid`) ON UPDATE CASCADE