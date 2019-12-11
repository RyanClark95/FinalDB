
CREATE TABLE IF NOT EXISTS `tbl_contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` text,
  `contact_no1` varchar(255) NOT NULL,
  `contact_no2` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;


INSERT INTO `tbl_contacts` (`contact_id`, `first_name`, `middle_name`, `last_name`, `address`, `contact_no1`, `contact_no2`, `email_address`, `profile_pic`) VALUES
(13, 'Ryan', '', 'Clark', '', '7794352082', '', 'Clark@yahoo.com', '0'),
(14, 'Brittant', '', 'Olson', '', '7785854589', '', 'brittant@yahoo.com', '0'),
(15, 'shaw', 'casey', 'mcconnell', '', '2845784452', '', 'shaw@yahoo.com', '0'),
(11, 'john', '', 'smith', '3056 boston ave', '5788458585', '', 'john@yahoo.com', '0'),
(12, 'nick', '', 'johnson', '', '7758562535', '', 'Nick@yahoo.com', '0'),
(41, 'dafa', 'awawd', 'awda', '', 'awdawdaw', 'aawd', 'awd', ''),
(42, 'Ryan', '', 'gates', '1302 norley ave', '7794352082', '', 'rentmyskillz@gmail.com', ''),
(43, 'Brittany', '', 'O', '404 hiawatha drive', '213214124123', '', 'fdfasdvasv', '');


