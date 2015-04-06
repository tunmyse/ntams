--
-- Table structure for table `tams_schools`
--

DROP TABLE IF EXISTS `tams_schools`;
CREATE TABLE IF NOT EXISTS `tams_schools` (
  `schoolid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `schoolname` text NOT NULL,
  `address` text,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `domainstring` varchar(20) NOT NULL,
  `shortname` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `unitname` varchar(20) NOT NULL DEFAULT 'College',
  PRIMARY KEY (`schoolid`),
  UNIQUE KEY `domainstring` (`domainstring`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tams_users`
--

DROP TABLE IF EXISTS `tams_users`;
CREATE TABLE IF NOT EXISTS `tams_users` (
  `userid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `usertypeid` varchar(11) DEFAULT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `mname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `usertype` enum('student','staff','admin','management') NOT NULL,
  `schoolid` int(255) unsigned NOT NULL,
  `address` text,
  `password` varchar(80) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `usertypeid` (`usertypeid`,`schoolid`),
  UNIQUE KEY `email` (`email`,`schoolid`),
  UNIQUE KEY `phone` (`phone`,`schoolid`),
  KEY `schoolid` (`schoolid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT