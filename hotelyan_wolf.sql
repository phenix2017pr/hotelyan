-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 25, 2015 at 11:27 PM
-- Server version: 5.6.23
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hotelyan_wolf`
--

-- --------------------------------------------------------

--
-- Table structure for table `wolf_album`
--

DROP TABLE IF EXISTS `wolf_album`;
CREATE TABLE IF NOT EXISTS `wolf_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `sequence` int(10) NOT NULL DEFAULT '0',
  `date_added` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wolf_album`
--

INSERT INTO `wolf_album` (`id`, `page_id`, `name`, `status`, `sequence`, `date_added`) VALUES
(1, 0, 'Fnb Gallery', 1, 0, '2015-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `wolf_attraction`
--

DROP TABLE IF EXISTS `wolf_attraction`;
CREATE TABLE IF NOT EXISTS `wolf_attraction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `distance` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opening_hour` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `location_link` text NOT NULL,
  `sequence` int(11) NOT NULL,
  `filename` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `wolf_attraction`
--

INSERT INTO `wolf_attraction` (`id`, `name`, `description`, `distance`, `opening_hour`, `latitude`, `longitude`, `location_link`, `sequence`, `filename`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`) VALUES
(16, 'Popular', NULL, '', '', '', '', '', 1, NULL, '2015-09-08 11:49:31', NULL, 1, NULL),
(17, 'Sip', NULL, '', '', '', '', '', 2, NULL, '2015-09-08 11:49:38', NULL, 1, NULL),
(18, 'Indulge', NULL, '', '', '', '', '', 3, NULL, '2015-09-08 11:49:50', NULL, 1, NULL),
(19, 'Design', NULL, '', '', '', '', '', 4, NULL, '2015-09-08 11:50:04', NULL, 1, NULL),
(20, 'Fashion', NULL, '', '', '', '', '', 5, NULL, '2015-09-08 11:50:18', NULL, 1, NULL),
(21, 'Glam', NULL, '', '', '', '', '', 6, NULL, '2015-09-08 11:50:27', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_attractionimage`
--

DROP TABLE IF EXISTS `wolf_attractionimage`;
CREATE TABLE IF NOT EXISTS `wolf_attractionimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attractionid` int(11) DEFAULT NULL,
  `title` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `distance` varchar(255) NOT NULL,
  `source` text,
  `sequence` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `wolf_attractionimage`
--

INSERT INTO `wolf_attractionimage` (`id`, `attractionid`, `title`, `filename`, `distance`, `source`, `sequence`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`) VALUES
(36, 16, 'Potato Head', 'attraction1.jpg', 'Distance from Hotel: 0.6 mile | Walking:12 min', NULL, 1, '2015-09-08 11:51:12', NULL, 1, NULL),
(37, 16, 'Mama San', 'attraction2.jpg', 'Distance from Hotel: 0.6 mile | Walking:12 min', NULL, 2, '2015-09-08 11:51:38', NULL, 1, NULL),
(38, 17, 'Ku De Ta', 'attraction2_1.jpg', 'Distance from Hotel: 0.6 mile | Walking:12 min', NULL, 1, '2015-09-08 11:52:00', NULL, 1, NULL),
(39, 17, 'The Holy Crab', 'attraction4.jpg', 'Distance from Hotel: 0.6 mile | Walking:12 min', NULL, 2, '2015-09-08 11:52:15', NULL, 1, NULL),
(40, 18, 'Ku De Ta', 'attraction4_1.jpg', 'Distance from Hotel: 0.6 mile | Walking:12 min', NULL, 1, '2015-09-08 11:52:28', NULL, 1, NULL),
(41, 19, 'Mama San', 'attraction1_1.jpg', 'Distance from Hotel: 2.9 miles ', NULL, 1, '2015-09-08 11:52:40', NULL, 1, NULL),
(42, 20, 'The Holy Crab', 'attraction3.jpg', 'Distance from Hotel: 2.9 miles ', NULL, 1, '2015-09-08 11:52:54', NULL, 1, NULL),
(43, 21, 'Potato Head', 'attraction1_2.jpg', 'Distance from Hotel: 0.6 mile | Walking:12 min', NULL, 1, '2015-09-08 11:53:13', NULL, 1, NULL),
(44, 16, 'Potato Head', 'attraction1_2_1.jpg', 'Distance from Hotel: 0.6 mile | Walking:12 min', NULL, 3, '2015-09-11 09:21:31', NULL, 1, NULL),
(45, 16, 'Potato Head', 'attraction1_2_2.jpg', 'Distance from Hotel: 0.6 mile | Walking:12 min', NULL, 4, '2015-09-11 09:21:41', NULL, 1, NULL),
(46, 16, 'test', 'attraction3_1.jpg', 'Distance from Hotel: 0.6 mile | Walking:12 min', NULL, 5, '2015-09-11 09:21:54', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_banner`
--

DROP TABLE IF EXISTS `wolf_banner`;
CREATE TABLE IF NOT EXISTS `wolf_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `source` text,
  `external_url` varchar(200) DEFAULT NULL,
  `book_url` varchar(200) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `type` varchar(10) NOT NULL,
  `location` varchar(10) DEFAULT NULL,
  `page_id` int(10) DEFAULT NULL,
  `caption` text,
  `sequence` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `wolf_banner`
--

INSERT INTO `wolf_banner` (`id`, `name`, `filename`, `source`, `external_url`, `book_url`, `status`, `type`, `location`, `page_id`, `caption`, `sequence`) VALUES
(54, 'Hotel Yan', 'home-1.jpg', 'http://hotel-yan.com/public/banner/home-1.jpg', NULL, '', 1, 'home', 'background', NULL, NULL, 42),
(56, 'Bistro & Bar', 'bigbanner2.jpg', 'http://hotel-yan.com/public/banner/bigbanner2.jpg', NULL, '', 1, 'inner', 'background', 3, NULL, 44),
(58, NULL, 'bigbanner2.jpg', 'http://hotel-yan.com/public/banner/bigbanner2.jpg', NULL, '', 1, 'inner', 'background', 8, NULL, 46),
(61, 'Dining 2', 'home-attractions.jpg', 'http://hotel-yan.com/public/banner/home-attractions.jpg', NULL, '', 1, 'home', 'dining', NULL, NULL, 49),
(62, 'About Us', 'home-offer-bg.jpg', 'http://hotel-yan.com/public/banner/home-offer-bg.jpg', NULL, '', 1, 'home', 'aboutus', NULL, NULL, 50),
(63, 'Left Slide', 'home-left-1.jpg', 'http://hotel-yan.com/public/banner/home-left-1.jpg', NULL, '', 1, 'home', 'leftslide', NULL, NULL, 51),
(64, 'Left Slide', 'home-left-2.jpg', 'http://hotel-yan.com/public/banner/home-left-2.jpg', NULL, '', 1, 'home', 'leftslide', NULL, NULL, 52),
(65, 'Hotel Yan home', 'home-2.jpg', 'http://hotel-yan.com/public/banner/home-2.jpg', NULL, '', 1, 'home', 'background', NULL, NULL, 53),
(66, 'Left slide', 'home-left-3.jpg', 'http://hotel-yan.com/public/banner/home-left-3.jpg', NULL, '', 1, 'home', 'leftslide', NULL, NULL, 54),
(67, NULL, 'hm-slide2.jpg', 'http://hotel-yan.com/public/banner/hm-slide2.jpg', NULL, '', 1, 'home', 'leftslide', NULL, NULL, 55);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_country`
--

DROP TABLE IF EXISTS `wolf_country`;
CREATE TABLE IF NOT EXISTS `wolf_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) NOT NULL,
  `country_iso_code` char(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_COUNTRIES_NAME` (`country_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=244 ;

--
-- Dumping data for table `wolf_country`
--

INSERT INTO `wolf_country` (`id`, `country_name`, `country_iso_code`) VALUES
(1, 'Afghanistan', 'af'),
(2, 'Albania', 'al'),
(3, 'Algeria', 'dz'),
(4, 'American Samoa', 'as'),
(5, 'Andorra', 'ad'),
(6, 'Angola', 'ao'),
(7, 'Anguilla', 'ai'),
(8, 'Antarctica', 'aq'),
(9, 'Antigua and Barbuda', 'ag'),
(10, 'Argentina', 'ar'),
(11, 'Armenia', 'am'),
(12, 'Aruba', 'aw'),
(13, 'Australia', 'au'),
(14, 'Austria', 'at'),
(15, 'Azerbaijan', 'az'),
(16, 'Bahamas', 'bs'),
(17, 'Bahrain', 'bh'),
(18, 'Bangladesh', 'bd'),
(19, 'Barbados', 'bb'),
(20, 'Belarus', 'by'),
(21, 'Belgium', 'be'),
(22, 'Belize', 'bz'),
(23, 'Benin', 'bj'),
(24, 'Bermuda', 'bm'),
(25, 'Bhutan', 'bt'),
(26, 'Bolivia', 'bo'),
(27, 'Bosnia and Herzegovina', 'ba'),
(28, 'Botswana', 'bw'),
(29, 'Bouvet Island', 'bv'),
(30, 'Brazil', 'br'),
(31, 'British Indian Ocean Territory', 'io'),
(32, 'Brunei Darussalam', 'bn'),
(33, 'Bulgaria', 'bg'),
(34, 'Burkina Faso', 'bf'),
(35, 'Burundi', 'bi'),
(36, 'Cambodia', 'kh'),
(37, 'Cameroon', 'cm'),
(38, 'Canada', 'ca'),
(39, 'Cape Verde', 'cv'),
(40, 'Cayman Islands', 'ky'),
(41, 'Central African republic', 'cf'),
(42, 'Chad', 'td'),
(43, 'Chile', 'cl'),
(44, 'China', 'cn'),
(45, 'Christmas Island', 'cx'),
(46, 'Cocos (Keeling) Islands', 'cc'),
(47, 'Colombia', 'co'),
(48, 'Comoros', 'km'),
(49, 'Congo', 'cg'),
(50, 'Cook islands', 'ck'),
(51, 'Costa rica', 'cr'),
(52, 'Croatia', 'hr'),
(53, 'Cuba', 'cu'),
(54, 'Cyprus', 'cy'),
(55, 'Czech republic', 'cz'),
(56, 'Côte D&acute;Ivoire', 'ci'),
(57, 'Denmark', 'dk'),
(58, 'Djibouti', 'dj'),
(59, 'Dominica', 'dm'),
(60, 'Dominican republic', 'do'),
(61, 'Ecuador', 'ec'),
(62, 'Egypt', 'eg'),
(63, 'El Salvador', 'sv'),
(64, 'Equatorial Guinea', 'gq'),
(65, 'Eritrea', 'er'),
(66, 'Estonia', 'ee'),
(67, 'Ethiopia', 'et'),
(68, 'Falkland Islands (Malvinas)', 'fk'),
(69, 'Faroe Islands', 'fo'),
(70, 'Fiji', 'fj'),
(71, 'Finland', 'fi'),
(72, 'France', 'fr'),
(73, 'French Guiana', 'gf'),
(74, 'French Polynesia', 'pf'),
(75, 'French Southern Territories', 'tf'),
(76, 'Gabon', 'ga'),
(77, 'Gambia', 'gm'),
(78, 'Georgia', 'ge'),
(79, 'Germany', 'de'),
(80, 'Ghana', 'gh'),
(81, 'Gibraltar', 'gi'),
(82, 'Greece', 'gr'),
(83, 'Greenland', 'gl'),
(84, 'Grenada', 'gd'),
(85, 'Guadeloupe', 'gp'),
(86, 'Guam', 'gu'),
(87, 'Guatemala', 'gt'),
(88, 'Guernsey', 'gg'),
(89, 'Guinea', 'gn'),
(90, 'Guinea-bissau', 'gw'),
(91, 'Guyana', 'gy'),
(92, 'Haiti', 'ht'),
(93, 'Heard Island and McDonald Islands', 'hm'),
(94, 'Honduras', 'hn'),
(95, 'Hong Kong', 'hk'),
(96, 'Hungary', 'hu'),
(97, 'Iceland', 'is'),
(98, 'India', 'in'),
(99, 'Indonesia', 'id'),
(100, 'Iraq', 'iq'),
(101, 'Ireland', 'ie'),
(102, 'Isle Of Man', 'im'),
(103, 'Israel', 'il'),
(104, 'Italy', 'it'),
(105, 'Jamaica', 'jm'),
(106, 'Japan', 'jp'),
(107, 'Jersey', 'je'),
(108, 'Jordan', 'jo'),
(109, 'Kazakhstan', 'kz'),
(110, 'Kenya', 'ke'),
(111, 'Kiribati', 'ki'),
(112, 'Korea', 'kr'),
(113, 'Kuwait', 'kw'),
(114, 'Kyrgyzstan', 'kg'),
(115, 'Lao People&acute;s Democratic Republic', 'la'),
(116, 'Latvia', 'lv'),
(117, 'Lebanon', 'lb'),
(118, 'Lesotho', 'ls'),
(119, 'Liberia', 'lr'),
(120, 'Libyan Arab Jamahiriya', 'ly'),
(121, 'Liechtenstein', 'li'),
(122, 'Lithuania', 'lt'),
(123, 'Luxembourg', 'lu'),
(124, 'Macao', 'mo'),
(125, 'Macedonia', 'mk'),
(126, 'Madagascar', 'mg'),
(127, 'Malawi', 'mw'),
(128, 'Malaysia', 'my'),
(129, 'Maldives', 'mv'),
(130, 'Mali', 'ml'),
(131, 'Malta', 'mt'),
(132, 'Marshall Islands', 'mh'),
(133, 'Martinique', 'mq'),
(134, 'Mauritania', 'mr'),
(135, 'Mauritius', 'mu'),
(136, 'Mayotte', 'yt'),
(137, 'Mexico', 'mx'),
(138, 'Micronesia, Federated States Of', 'fm'),
(139, 'Moldova', 'md'),
(140, 'Monaco', 'mc'),
(141, 'Mongolia', 'mn'),
(142, 'Montenegro', 'me'),
(143, 'Montserrat', 'ms'),
(144, 'Morocco', 'ma'),
(145, 'Mozambique', 'mz'),
(146, 'Myanmar', 'mm'),
(147, 'Namibia', 'na'),
(148, 'Nauru', 'nr'),
(149, 'Nepal', 'np'),
(150, 'Netherlands', 'nl'),
(151, 'Netherlands antilles', 'an'),
(152, 'New caledonia', 'nc'),
(153, 'New zealand', 'nz'),
(154, 'Nicaragua', 'ni'),
(155, 'Niger', 'ne'),
(156, 'Nigeria', 'ng'),
(157, 'Niue', 'nu'),
(158, 'Norfolk island', 'nf'),
(159, 'Northern Mariana Islands', 'mp'),
(160, 'Norway', 'no'),
(161, 'Oman', 'om'),
(162, 'Pakistan', 'pk'),
(163, 'Palau', 'pw'),
(164, 'Palestinian Territory, Occupied', 'ps'),
(165, 'Panama', 'pa'),
(166, 'Papua New Guinea', 'pg'),
(167, 'Paraguay', 'py'),
(168, 'Peru', 'pe'),
(169, 'Philippines', 'ph'),
(170, 'Pitcairn', 'pn'),
(171, 'Poland', 'pl'),
(172, 'Portugal', 'pt'),
(173, 'Puerto rico', 'pr'),
(174, 'Qatar', 'qa'),
(175, 'Romania', 'ro'),
(176, 'Russian federation', 'ru'),
(177, 'Rwanda', 'rw'),
(178, 'Réunion', 're'),
(179, 'Saint Barthélemy', 'bl'),
(180, 'Saint Helena', 'sh'),
(181, 'Saint Kitts and Nevis', 'kn'),
(182, 'Saint Lucia', 'lc'),
(183, 'Saint Martin', 'mf'),
(184, 'Saint Pierre and Miquelon', 'pm'),
(185, 'Saint Vincent and The Grenadines', 'vc'),
(186, 'Samoa', 'ws'),
(187, 'San Marino', 'sm'),
(188, 'Sao Tome and Principe', 'st'),
(189, 'Saudi Arabia', 'sa'),
(190, 'Senegal', 'sn'),
(191, 'Serbia', 'rs'),
(192, 'Seychelles', 'sc'),
(193, 'Sierra Leone', 'sl'),
(194, 'Singapore', 'sg'),
(195, 'Slovakia', 'sk'),
(196, 'Slovenia', 'si'),
(197, 'Solomon Islands', 'sb'),
(198, 'Somalia', 'so'),
(199, 'South Africa', 'za'),
(200, 'South Georgia and Islands', 'gs'),
(201, 'Spain', 'es'),
(202, 'Sri Lanka', 'lk'),
(203, 'Sudan', 'sd'),
(204, 'Suriname', 'sr'),
(205, 'Svalbard and Jan Mayen', 'sj'),
(206, 'Swaziland', 'sz'),
(207, 'Sweden', 'se'),
(208, 'Switzerland', 'ch'),
(209, 'Syrian arab Republic', 'sy'),
(210, 'Taiwan, Province Of China', 'tw'),
(211, 'Tajikistan', 'tj'),
(212, 'Tanzania, United Republic of', 'tz'),
(213, 'Thailand', 'th'),
(214, 'Timor-leste', 'tl'),
(215, 'Togo', 'tg'),
(216, 'Tokelau', 'tk'),
(217, 'Tonga', 'to'),
(218, 'Trinidad and Tobago', 'tt'),
(219, 'Tunisia', 'tn'),
(220, 'Turkey', 'tr'),
(221, 'Turkmenistan', 'tm'),
(222, 'Turks and Caicos Islands', 'tc'),
(223, 'Tuvalu', 'tv'),
(224, 'Uganda', 'ug'),
(225, 'Ukraine', 'ua'),
(226, 'United Arab Emirates', 'ae'),
(227, 'United Kingdom', 'gb'),
(228, 'United States', 'us'),
(229, 'United States Minor Outlying Islands', 'um'),
(230, 'Uruguay', 'uy'),
(231, 'Uzbekistan', 'uz'),
(232, 'Vanuatu', 'vu'),
(233, 'Vatican City State', 'va'),
(234, 'Venezuela', 've'),
(235, 'Viet Nam', 'vn'),
(236, 'Virgin Islands, British', 'vg'),
(237, 'Virgin Islands, United States', 'vi'),
(238, 'Wallis and Futuna', 'wf'),
(239, 'Western Sahara', 'eh'),
(240, 'Yemen', 'ye'),
(241, 'Zambia', 'zm'),
(242, 'Zimbabwe', 'zw'),
(243, 'Åland Islands', 'ax');

-- --------------------------------------------------------

--
-- Table structure for table `wolf_cron`
--

DROP TABLE IF EXISTS `wolf_cron`;
CREATE TABLE IF NOT EXISTS `wolf_cron` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lastrun` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wolf_dine`
--

DROP TABLE IF EXISTS `wolf_dine`;
CREATE TABLE IF NOT EXISTS `wolf_dine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_name` varchar(50) NOT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url_name2` varchar(50) NOT NULL,
  `url2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url_name3` varchar(50) NOT NULL,
  `url3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dine_date` date NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_by_id` int(11) NOT NULL,
  `sequence` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wolf_dine`
--

INSERT INTO `wolf_dine` (`id`, `title`, `url_name`, `url`, `url_name2`, `url2`, `url_name3`, `url3`, `description`, `filename`, `dine_date`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`, `sequence`) VALUES
(1, 'Restaurant Name', 'Menu A', 'index.php', 'Menu B', 'dine', 'Menu C', 'facilities', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. ', 'dinepic1.png', '0000-00-00', '2015-04-03 05:06:09', '2015-04-03 05:08:03', 4, 4, 0),
(2, 'Bar Name', 'Menu A', 'index.php', '', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. ', 'dinepic1_1.png', '0000-00-00', '2015-04-03 05:08:41', '0000-00-00 00:00:00', 4, 0, 0),
(3, 'Cafe Name', 'Menu A', 'index.php', 'Menu B', 'dine', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. ', 'dinepic1_2.png', '0000-00-00', '2015-04-03 05:09:02', '0000-00-00 00:00:00', 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_facilities`
--

DROP TABLE IF EXISTS `wolf_facilities`;
CREATE TABLE IF NOT EXISTS `wolf_facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageid` int(10) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `anchor_name` varchar(255) NOT NULL,
  `url_name` varchar(50) NOT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `facilities_date` date NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_by_id` int(11) NOT NULL,
  `sequence` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `wolf_facilities`
--

INSERT INTO `wolf_facilities` (`id`, `pageid`, `name`, `anchor_name`, `url_name`, `url`, `description`, `filename`, `facilities_date`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`, `sequence`) VALUES
(13, 0, 'Free Wifi', '', '', '', '<p>\r\n	test</p>\r\n', 'select-tv.jpg', '0000-00-00', '2015-09-08 13:34:45', '0000-00-00 00:00:00', 1, 0, 0),
(14, 0, 'Lounge Bar', '', '', '', '<p>\r\n	description here test</p>\r\n', 'home-lounge.jpg', '0000-00-00', '2015-09-08 13:36:28', '0000-00-00 00:00:00', 1, 0, 0),
(15, 0, 'Meeting Room', '', '', '', '<p>\r\n	test</p>\r\n', 'room-images2_1.jpg', '0000-00-00', '2015-10-02 05:52:30', '2015-10-02 05:54:39', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_facilitiesimage`
--

DROP TABLE IF EXISTS `wolf_facilitiesimage`;
CREATE TABLE IF NOT EXISTS `wolf_facilitiesimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facilitiesid` int(11) DEFAULT NULL,
  `title` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` text,
  `sequence` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `wolf_facilitiesimage`
--

INSERT INTO `wolf_facilitiesimage` (`id`, `facilitiesid`, `title`, `filename`, `source`, `sequence`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`) VALUES
(44, 13, '', 'internet-lounge.jpg', NULL, 0, '2015-09-08 13:35:29', NULL, 1, NULL),
(45, 15, '', 'room-images2_3.jpg', NULL, 0, '2015-10-02 05:52:35', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_fnb`
--

DROP TABLE IF EXISTS `wolf_fnb`;
CREATE TABLE IF NOT EXISTS `wolf_fnb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageid` int(10) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `opening_hour` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `quick_reference` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `additional_description` text NOT NULL,
  `filename` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `left_bg` varchar(150) NOT NULL,
  `right_bg` varchar(150) NOT NULL,
  `fnb_date` date NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_by_id` int(11) NOT NULL,
  `sequence` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `wolf_fnb`
--

INSERT INTO `wolf_fnb` (`id`, `pageid`, `name`, `opening_hour`, `quick_reference`, `description`, `additional_description`, `filename`, `left_bg`, `right_bg`, `fnb_date`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`, `sequence`) VALUES
(6, 3, 'Menu', NULL, 'Download Food Menu Here', '', '', 'test_1.pdf', '', '', '0000-00-00', '2015-09-10 08:19:40', '0000-00-00 00:00:00', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_fnbgallery`
--

DROP TABLE IF EXISTS `wolf_fnbgallery`;
CREATE TABLE IF NOT EXISTS `wolf_fnbgallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `filename` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `sequence` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `wolf_fnbgallery`
--

INSERT INTO `wolf_fnbgallery` (`id`, `album_id`, `title`, `filename`, `status`, `sequence`) VALUES
(75, 1, NULL, 'dining-fnb2.jpg', 1, 9),
(74, 1, NULL, 'dining-fnb.jpg', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_fnbimage`
--

DROP TABLE IF EXISTS `wolf_fnbimage`;
CREATE TABLE IF NOT EXISTS `wolf_fnbimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fnbid` int(11) DEFAULT NULL,
  `title` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` text,
  `sequence` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `wolf_fnbimage`
--

INSERT INTO `wolf_fnbimage` (`id`, `fnbid`, `title`, `filename`, `source`, `sequence`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`) VALUES
(3, 2, 'Menu 1', 'menu1.png', NULL, 0, '2015-04-26 20:53:17', NULL, 1, NULL),
(12, 1, 'Mee Siam 4', '1-1.jpg', NULL, 0, '2015-04-30 14:30:55', '2015-07-14 05:42:05', 1, 1),
(13, 1, '2', '2-1.jpg', NULL, 0, '2015-04-30 14:31:39', '2015-07-14 05:42:38', 1, 1),
(14, 1, 'Nasi Lemak', 'nasilemak_1.jpg', NULL, 0, '2015-04-30 14:32:45', '2015-07-14 05:43:25', 1, 1),
(15, 1, '4', '4_1.jpg', NULL, 0, '2015-04-30 14:33:40', '2015-07-14 05:43:57', 1, 1),
(16, 1, 'Grilled Chorizo Sausage', 'seafood-p.jpg', NULL, 0, '2015-04-30 14:34:29', '2015-07-29 08:17:25', 1, 1),
(17, 1, 'Prawn Thermidor', 'Prawn-Thermidor_1.jpg', NULL, 0, '2015-04-30 14:35:26', '2015-07-14 05:44:49', 1, 1),
(18, 1, 'Sandwich', 'Sandwich_1.jpg', NULL, 0, '2015-04-30 14:36:07', '2015-07-14 05:45:17', 1, 1),
(19, 1, 'Traditional Beef Wellington', 'Traditional-Beef-Wellington_2.jpg', NULL, 0, '2015-04-30 14:37:00', '2015-07-14 05:45:49', 1, 1),
(20, 4, '', 'LOBBY-BAR-2.JPG', NULL, 0, '2015-07-29 08:30:26', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_gallery`
--

DROP TABLE IF EXISTS `wolf_gallery`;
CREATE TABLE IF NOT EXISTS `wolf_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageid` int(10) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(10) NOT NULL,
  `sequence` int(10) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_by_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wolf_gallery`
--

INSERT INTO `wolf_gallery` (`id`, `pageid`, `title`, `url`, `filename`, `type`, `sequence`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`) VALUES
(1, 0, '1', '', 'bigbanner.jpg', '', 0, '2015-10-17 08:18:32', '2015-10-17 08:18:57', 1, 1),
(2, 0, '2', '', 'bigbanner2.jpg', '', 0, '2015-10-17 08:19:10', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_homeimage`
--

DROP TABLE IF EXISTS `wolf_homeimage`;
CREATE TABLE IF NOT EXISTS `wolf_homeimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageid` int(10) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `filename_hover` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) NOT NULL,
  `sequence` int(10) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_by_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `wolf_layout`
--

DROP TABLE IF EXISTS `wolf_layout`;
CREATE TABLE IF NOT EXISTS `wolf_layout` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `content_type` varchar(80) DEFAULT NULL,
  `content` text,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `position` mediumint(6) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `wolf_layout`
--

INSERT INTO `wolf_layout` (`id`, `name`, `content_type`, `content`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`, `position`) VALUES
(1, 'home-page', 'text/html', '<?php include("home-page.php");?>', '2012-04-25 02:59:32', '2015-10-11 14:32:13', 1, 1, 1),
(2, 'sub-page', 'text/html', '<?php include("sub-page.php");?>', '2012-05-04 17:53:12', '2015-10-11 14:32:13', 1, 1, 6),
(13, 'gallery-page', 'text/html', '<?php include(''gallery-page.php'') ?>', '2015-04-23 10:09:33', '2015-10-17 08:16:02', 4, 1, 4),
(14, 'room-page', 'text/html', '<?php include("room-page.php");?>', '2015-04-23 11:39:39', '2015-10-11 14:32:13', 4, 1, 2),
(17, 'dining-page', 'text/html', '<?php include("f&b-page.php");?>', '2015-04-26 13:39:28', '2015-10-11 14:32:13', 1, 1, 3),
(19, 'attraction-page', 'text/html', '<?php include("attraction-page.php");?>', '2015-09-04 10:20:57', '2015-10-11 14:32:13', 1, 1, 7),
(20, 'contact-page', 'text/html', '<?php include("contact-page.php");?>', '2015-09-04 10:21:15', '2015-10-11 14:32:13', 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_offer`
--

DROP TABLE IF EXISTS `wolf_offer`;
CREATE TABLE IF NOT EXISTS `wolf_offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageid` int(10) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `anchor_name` varchar(255) NOT NULL,
  `url_name` varchar(50) NOT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_home` text NOT NULL,
  `filename` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `filename_home` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `offer_date` date NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_by_id` int(11) NOT NULL,
  `sequence` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `wolf_offer`
--

INSERT INTO `wolf_offer` (`id`, `pageid`, `name`, `anchor_name`, `url_name`, `url`, `description`, `description_home`, `filename`, `filename_home`, `offer_date`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`, `sequence`) VALUES
(27, 0, 'Opening Special', '', '', 'index.php', '<div>\r\n	<div style="text-align: center;">\r\n		&nbsp;</div>\r\n</div>\r\n<div style="text-align: center;">\r\n	<div style="line-height: 23.4px;">\r\n		<span style="font-size: 14.44px; line-height: 21.66px;">Whether is it for Leisure or Business, Hotel YAN is your best choice of accommodation with a combination of both industrial and chic touch.&nbsp;</span></div>\r\n	<div style="line-height: 23.4px;">\r\n		&nbsp;</div>\r\n	<div style="line-height: 23.4px;">\r\n		<span style="font-size: 14.44px; line-height: 21.66px;">Book directly with us and take advantage of our opening offers.&nbsp;</span></div>\r\n	<div style="line-height: 23.4px;">\r\n		&nbsp;</div>\r\n	<div style="line-height: 23.4px;">\r\n		<span style="font-size: 14.44px; line-height: 21.66px;">Our opening special starts from $128 Nett!</span></div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', '<div>\r\n	<div style="text-align: center;">\r\n		&nbsp;</div>\r\n	<div style="text-align: center;">\r\n		<div>\r\n			<span style="font-size: 14.44px; line-height: 21.66px;">Whether is it for Leisure or Business, Hotel YAN is your best choice of accommodation with a combination of both industrial and chic touch.&nbsp;</span></div>\r\n		<div>\r\n			&nbsp;</div>\r\n		<div>\r\n			<span style="font-size: 14.44px; line-height: 21.66px;">Book directly with us and take advantage of our opening offers.&nbsp;</span></div>\r\n		<div>\r\n			&nbsp;</div>\r\n		<div>\r\n			<span style="font-size: 14.44px; line-height: 21.66px;">Our opening special starts from $128 Nett!</span></div>\r\n	</div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 'offer-ima.jpg', 'offer-ima-h.jpg', '0000-00-00', '2015-10-12 17:42:34', '2015-10-22 02:18:26', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_offerimage`
--

DROP TABLE IF EXISTS `wolf_offerimage`;
CREATE TABLE IF NOT EXISTS `wolf_offerimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offerid` int(11) DEFAULT NULL,
  `title` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` text,
  `sequence` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `wolf_offerimage`
--

INSERT INTO `wolf_offerimage` (`id`, `offerid`, `title`, `filename`, `source`, `sequence`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`) VALUES
(21, 22, '', 'offer-slide.jpg', NULL, 0, '2015-10-11 11:34:52', NULL, 1, NULL),
(22, 22, '', 'room-04.jpg', NULL, 0, '2015-10-11 11:35:03', NULL, 1, NULL),
(23, 24, '', 'room-04.jpg', NULL, 0, '2015-10-12 17:29:00', NULL, 1, NULL),
(25, 26, '', 'room-01.jpg', NULL, 0, '2015-10-12 17:39:25', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_page`
--

DROP TABLE IF EXISTS `wolf_page`;
CREATE TABLE IF NOT EXISTS `wolf_page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `breadcrumb` varchar(160) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` text,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `layout_id` int(11) unsigned DEFAULT NULL,
  `behavior_id` varchar(25) NOT NULL DEFAULT '',
  `status_id` int(11) unsigned NOT NULL DEFAULT '100',
  `newwindow` tinyint(1) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `published_on` datetime DEFAULT NULL,
  `valid_until` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `position` mediumint(6) unsigned DEFAULT '0',
  `is_protected` tinyint(1) NOT NULL DEFAULT '0',
  `needs_login` tinyint(1) NOT NULL DEFAULT '2',
  `type` varchar(10) NOT NULL DEFAULT 'content',
  `external_url` text,
  `location` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `wolf_page`
--

INSERT INTO `wolf_page` (`id`, `title`, `slug`, `breadcrumb`, `keywords`, `description`, `parent_id`, `layout_id`, `behavior_id`, `status_id`, `newwindow`, `created_on`, `published_on`, `valid_until`, `updated_on`, `created_by_id`, `updated_by_id`, `position`, `is_protected`, `needs_login`, `type`, `external_url`, `location`) VALUES
(1, 'HOTEL YAN', NULL, 'Hotel Yan Singapore', 'hotel yan,hotel in singapore', 'Hotel Yan Singapore', 0, 1, '', 100, 0, '2013-12-11 15:45:00', '2013-12-11 15:45:00', NULL, '2015-10-23 06:34:09', 1, 1, 0, 1, 0, 'content', NULL, 'top'),
(2, 'ROOMS', 'rooms', 'Rooms', NULL, NULL, 1, 14, '', 100, 0, '2015-01-19 14:02:23', '2015-01-19 14:02:23', NULL, '2015-10-08 15:59:19', 1, 1, 1, 0, 2, 'content', NULL, 'top'),
(3, 'BISTRO & BAR', 'bistro', 'bistro', NULL, NULL, 1, 17, '', 101, 0, '2015-01-19 14:02:57', '2015-01-19 14:02:57', NULL, '2015-10-22 14:45:06', 1, 1, 3, 0, 2, 'content', NULL, 'top'),
(4, 'Attractions', 'attractions', 'Attractions', NULL, NULL, 1, 19, '', 1, 0, '2015-01-19 14:03:42', '2015-01-19 14:03:42', NULL, '2015-10-08 15:59:19', 1, 1, 6, 0, 2, 'content', NULL, 'top'),
(5, 'OFFERS', 'offers', 'Offers', 'Hotel Yan', NULL, 1, 14, '', 100, 0, '2015-01-19 14:03:54', '2015-01-19 14:03:54', NULL, '2015-10-08 15:59:19', 1, 1, 2, 0, 2, 'content', NULL, 'top'),
(34, 'CONTACT US', 'contact', 'Contact', NULL, NULL, 1, 20, '', 100, 0, '2015-04-23 08:45:05', '2015-04-23 08:45:05', NULL, '2015-10-22 02:21:52', 4, 1, 5, 0, 2, 'content', NULL, 'top'),
(8, 'GALLERY', 'gallery', 'Gallery', NULL, NULL, 1, 13, '', 101, 0, '2015-01-19 14:04:51', '2015-01-19 14:04:51', NULL, '2015-10-17 08:16:12', 1, 1, 4, 0, 2, 'content', NULL, 'top'),
(14, '5 Reasons to Book Direct', 'bookdirect', '5 Reasons to Book Direct', NULL, NULL, 1, 2, '', 100, 0, '2015-01-19 14:06:32', '2015-01-19 14:06:32', NULL, '2015-10-11 14:02:06', 1, 1, 10, 0, 2, 'content', NULL, 'footer'),
(43, 'Best Rate Guarantee', 'best-rate-guarantee', 'Best Rate Guarantee', NULL, NULL, 1, 2, '', 100, 0, '2015-09-04 08:54:34', '2015-09-04 08:54:34', NULL, '2015-10-16 02:41:36', 1, 1, 11, 0, 2, 'content', NULL, 'footer'),
(45, 'ABOUT', 'about', 'ABOUT', NULL, NULL, 1, 2, '', 100, 0, '2015-10-16 06:57:46', '2015-10-16 06:57:46', NULL, '2015-10-22 01:18:22', 1, 1, 0, 0, 2, 'content', NULL, 'top');

-- --------------------------------------------------------

--
-- Table structure for table `wolf_page_part`
--

DROP TABLE IF EXISTS `wolf_page_part`;
CREATE TABLE IF NOT EXISTS `wolf_page_part` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `filter_id` varchar(25) DEFAULT NULL,
  `content` longtext,
  `content_html` longtext,
  `page_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `wolf_page_part`
--

INSERT INTO `wolf_page_part` (`id`, `name`, `filter_id`, `content`, `content_html`, `page_id`) VALUES
(1, 'body', NULL, NULL, NULL, 2),
(2, 'body', 'ckeditor', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\r\n', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\r\n', 3),
(3, 'body', 'ckeditor', NULL, NULL, 4),
(4, 'body', 'ckeditor', NULL, NULL, 5),
(7, 'body', 'ckeditor', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\r\n', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\r\n', 8),
(13, 'body', 'ckeditor', NULL, NULL, 14),
(16, 'body', 'ckeditor', '<div>Hotel Yan is Singapore&rsquo;s very first industrial-chic boutique hotel, set between two of the city-state&rsquo;s most distinct ethnic enclaves Kampong Glam &ndash; home of Singapore&rsquo;s old Malay royalty, and Little India.</div>\r\n', '<div>Hotel Yan is Singapore&rsquo;s very first industrial-chic boutique hotel, set between two of the city-state&rsquo;s most distinct ethnic enclaves Kampong Glam &ndash; home of Singapore&rsquo;s old Malay royalty, and Little India.</div>\r\n', 1),
(73, 'home-list', NULL, '<?php $this->includeSnippet(''homepage-list'') ?>', '<?php $this->includeSnippet(''homepage-list'') ?>', 1),
(79, 'dining-desc', 'ckeditor', '<p>&nbsp;</p>\r\n<ul>\r\n<li>City Square Mall (500m/ 6min walk)</li>\r\n<li>Mustafa Center (900m/ 9min walk)</li>\r\n<li>Bugis Street (2.5km/ 7min drive)</li>\r\n<li>Gardens by the Bay (6.5km/ 11min drive)</li>\r\n<li>Singapore Flyer (4km/ 7 min drive)</li>\r\n<li>Raffles City Shopping (3.2km/ 9min Drive)</li>\r\n<li>Clarke Quay (5km/ 10min drive)</li>\r\n</ul>\r\n<div>&nbsp;</div>\r\n<div>Feel free to approach our friendly staff at the front desk for direction&nbsp;</div>\r\n<div>&nbsp;</div>\r\n', '<p>&nbsp;</p>\r\n<ul>\r\n<li>City Square Mall (500m/ 6min walk)</li>\r\n<li>Mustafa Center (900m/ 9min walk)</li>\r\n<li>Bugis Street (2.5km/ 7min drive)</li>\r\n<li>Gardens by the Bay (6.5km/ 11min drive)</li>\r\n<li>Singapore Flyer (4km/ 7 min drive)</li>\r\n<li>Raffles City Shopping (3.2km/ 9min Drive)</li>\r\n<li>Clarke Quay (5km/ 10min drive)</li>\r\n</ul>\r\n<div>&nbsp;</div>\r\n<div>Feel free to approach our friendly staff at the front desk for direction&nbsp;</div>\r\n<div>&nbsp;</div>\r\n', 1),
(84, 'bottom-title', NULL, 'Popular Attractions and Surroundings', 'Popular Attractions and Surroundings', 1),
(85, 'bottom-readmore', NULL, '<!--<a href="<?php echo URL_PUBLIC ?>bistro" target="_self">READ MORE</a>-->', '<!--<a href="<?php echo URL_PUBLIC ?>bistro" target="_self">READ MORE</a>-->', 1),
(77, 'address', 'ckeditor', '\r\n<div class="row">\r\n<div class="main">Hotel Yan</div>\r\n</div>\r\n<div class="content fnb-detail">\r\n<div class="row" style="margin-top:15px;">\r\n<div class="title">Address</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail">162 Tyrwhitt Road, Singapore</div>\r\n</div>\r\n<div class="clear">&nbsp;</div>\r\n<div class="row">\r\n<div class="title">Contact No.</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail">+65 6805 1955</div>\r\n</div>\r\n<div class="clear">&nbsp;</div>\r\n<div class="row">\r\n<div class="title">Email</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail"><a href="mailto:reservations@hotel-yan.com " id="hotelyan-info">reservations@hotel-yan.com </a></div>\r\n</div>\r\n</div>\r\n<p>Hotel YAN can be found nestled along the historical stretch of Jalan Besar, a culturally and historically rich metal trading community. What was once a ship breaking district is today a quirky neighbourhood where modern cafes and eateries exist alongside traditional hardware shops. With only 8 minutes walking distance to Lavender MRT station and 10 minutes to Farrer Park MRT, Hotel YAN also provides easy access to the Central Business District and popular shopping street Orchard Road, making it the ideal choice for both leisure and business travellers.</p>\r\n', '\r\n<div class="row">\r\n<div class="main">Hotel Yan</div>\r\n</div>\r\n<div class="content fnb-detail">\r\n<div class="row" style="margin-top:15px;">\r\n<div class="title">Address</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail">162 Tyrwhitt Road, Singapore</div>\r\n</div>\r\n<div class="clear">&nbsp;</div>\r\n<div class="row">\r\n<div class="title">Contact No.</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail">+65 6805 1955</div>\r\n</div>\r\n<div class="clear">&nbsp;</div>\r\n<div class="row">\r\n<div class="title">Email</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail"><a href="mailto:reservations@hotel-yan.com " id="hotelyan-info">reservations@hotel-yan.com </a></div>\r\n</div>\r\n</div>\r\n<p>Hotel YAN can be found nestled along the historical stretch of Jalan Besar, a culturally and historically rich metal trading community. What was once a ship breaking district is today a quirky neighbourhood where modern cafes and eateries exist alongside traditional hardware shops. With only 8 minutes walking distance to Lavender MRT station and 10 minutes to Farrer Park MRT, Hotel YAN also provides easy access to the Central Business District and popular shopping street Orchard Road, making it the ideal choice for both leisure and business travellers.</p>\r\n', 34),
(58, 'attraction-list', NULL, '<?php $this->includeSnippet(''attraction-list''); ?>', '<?php $this->includeSnippet(''attraction-list''); ?>', 4),
(59, 'offers-list', NULL, '<?php $this->includeSnippet(''offers-list''); ?>', '<?php $this->includeSnippet(''offers-list''); ?>', 5),
(78, 'contact', NULL, '<?php \r\n\r\n//$email = ''info@hotel-yan.com'';\r\n$email = ''okstmtcc@yahoo.com'';\r\n\r\nTB_ContactForm($email); \r\n\r\n?>', '<?php \r\n\r\n//$email = ''info@hotel-yan.com'';\r\n$email = ''okstmtcc@yahoo.com'';\r\n\r\nTB_ContactForm($email); \r\n\r\n?>', 34),
(53, 'body', 'ckeditor', NULL, NULL, 34),
(64, 'room-list', NULL, '<?php $this->includeSnippet(''room-list'') ?>', '<?php $this->includeSnippet(''room-list'') ?>', 2),
(69, 'body', 'ckeditor', '<p>best rate</p>\r\n', '<p>best rate</p>\r\n', 43),
(82, 'readmore-link', 'ckeditor', NULL, NULL, 1),
(80, 'detail-list', 'ckeditor', '<div class="content">\r\n<div class="row">\r\n<div class="title">Operating Hours</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail">10:00 A.M - 9:00 P.M</div>\r\n</div>\r\n<div class="clear">&nbsp;</div>\r\n<div class="row">\r\n<div class="title">Contact No.</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail">+65 6111 6111</div>\r\n</div>\r\n<div class="clear">&nbsp;</div>\r\n<div class="row">\r\n<div class="title">Email</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail">BISTRAO@HOTELYAN.COM</div>\r\n</div>\r\n<div class="clear">&nbsp;</div>\r\n<div class="row">\r\n<div class="title">Follow US</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail">&nbsp;</div>\r\n</div>\r\n</div>\r\n', '<div class="content">\r\n<div class="row">\r\n<div class="title">Operating Hours</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail">10:00 A.M - 9:00 P.M</div>\r\n</div>\r\n<div class="clear">&nbsp;</div>\r\n<div class="row">\r\n<div class="title">Contact No.</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail">+65 6111 6111</div>\r\n</div>\r\n<div class="clear">&nbsp;</div>\r\n<div class="row">\r\n<div class="title">Email</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail">BISTRAO@HOTELYAN.COM</div>\r\n</div>\r\n<div class="clear">&nbsp;</div>\r\n<div class="row">\r\n<div class="title">Follow US</div>\r\n<div class="semicolon">:</div>\r\n<div class="detail">&nbsp;</div>\r\n</div>\r\n</div>\r\n', 3),
(81, 'fnb-content', NULL, '<?php $this->includeSnippet(''fnb-list'') ?>', '<?php $this->includeSnippet(''fnb-list'') ?>', 3),
(83, 'body', 'ckeditor', '<div>Decked out in rustic iron and wood, the hotel reflects the area&rsquo;s heritage as a warehouse and industrial district, remnants of which can still be seen today. Be greeted by casual elegance from the moment you step into the hotel lobby where high ceilings, washed concrete walls and exposed steel pipes epitomize the fuss-free design. Subtle accents add a touch of vibrancy while wide, open spaces seek to create a community of like-minded people in a place away from home.</div>\r\n<div>&nbsp;</div>\r\n<div>Hotel Yan&rsquo;s simplistic form and utilitarian appeal promises a refreshing and calming environment for urban dwellers and suburbanites alike.</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Enjoy the Hotel facilities and services by our friendly staff.</div>\r\n<div>&nbsp;</div>\r\n<div>Facilities:<br />\r\n<br />\r\n<ul>\r\n<li>High Speed Internet access at lobby and all guest rooms</li>\r\n<li>Laundry service</li>\r\n<li>Room Service&nbsp;(Coming soon)</li>\r\n<li>Dining&nbsp;(Coming soon)</li>\r\n<li>Handicapped User Friendly Facilities&nbsp;</li>\r\n<li>Elevator&nbsp;</li>\r\n</ul>\r\n</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n', '<div>Decked out in rustic iron and wood, the hotel reflects the area&rsquo;s heritage as a warehouse and industrial district, remnants of which can still be seen today. Be greeted by casual elegance from the moment you step into the hotel lobby where high ceilings, washed concrete walls and exposed steel pipes epitomize the fuss-free design. Subtle accents add a touch of vibrancy while wide, open spaces seek to create a community of like-minded people in a place away from home.</div>\r\n<div>&nbsp;</div>\r\n<div>Hotel Yan&rsquo;s simplistic form and utilitarian appeal promises a refreshing and calming environment for urban dwellers and suburbanites alike.</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Enjoy the Hotel facilities and services by our friendly staff.</div>\r\n<div>&nbsp;</div>\r\n<div>Facilities:<br />\r\n<br />\r\n<ul>\r\n<li>High Speed Internet access at lobby and all guest rooms</li>\r\n<li>Laundry service</li>\r\n<li>Room Service&nbsp;(Coming soon)</li>\r\n<li>Dining&nbsp;(Coming soon)</li>\r\n<li>Handicapped User Friendly Facilities&nbsp;</li>\r\n<li>Elevator&nbsp;</li>\r\n</ul>\r\n</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n', 45);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_page_setting`
--

DROP TABLE IF EXISTS `wolf_page_setting`;
CREATE TABLE IF NOT EXISTS `wolf_page_setting` (
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sequence` int(11) NOT NULL,
  UNIQUE KEY `id` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wolf_page_setting`
--

INSERT INTO `wolf_page_setting` (`name`, `value`, `sequence`) VALUES
('footer', '', 8),
('facebook_url', '', 1),
('youtube_url', '#', 6),
('trip_url', '', 7),
('instagram_url', '', 3),
('google_url', '', 4),
('twitter_url', '', 2),
('pinterest_url', '', 5),
('qash_url', '', 9),
('riyaz_url', '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_page_tag`
--

DROP TABLE IF EXISTS `wolf_page_tag`;
CREATE TABLE IF NOT EXISTS `wolf_page_tag` (
  `page_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL,
  UNIQUE KEY `page_id` (`page_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wolf_permission`
--

DROP TABLE IF EXISTS `wolf_permission`;
CREATE TABLE IF NOT EXISTS `wolf_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `wolf_permission`
--

INSERT INTO `wolf_permission` (`id`, `name`) VALUES
(1, 'admin_view'),
(2, 'admin_edit'),
(3, 'user_view'),
(4, 'user_add'),
(5, 'user_edit'),
(6, 'user_delete'),
(7, 'layout_view'),
(8, 'layout_add'),
(9, 'layout_edit'),
(10, 'layout_delete'),
(11, 'snippet_view'),
(12, 'snippet_add'),
(13, 'snippet_edit'),
(14, 'snippet_delete'),
(15, 'page_view'),
(16, 'page_add'),
(17, 'page_edit'),
(18, 'page_delete'),
(19, 'file_manager_view'),
(20, 'file_manager_upload'),
(21, 'file_manager_mkdir'),
(22, 'file_manager_mkfile'),
(23, 'file_manager_rename'),
(24, 'file_manager_chmod'),
(25, 'file_manager_delete'),
(26, 'backup_restore_view');

-- --------------------------------------------------------

--
-- Table structure for table `wolf_plugin_settings`
--

DROP TABLE IF EXISTS `wolf_plugin_settings`;
CREATE TABLE IF NOT EXISTS `wolf_plugin_settings` (
  `plugin_id` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `value` varchar(255) NOT NULL,
  UNIQUE KEY `plugin_setting_id` (`plugin_id`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wolf_plugin_settings`
--

INSERT INTO `wolf_plugin_settings` (`plugin_id`, `name`, `value`) VALUES
('archive', 'use_dates', '1'),
('file_manager', 'umask', '0022'),
('file_manager', 'dirmode', '0755'),
('file_manager', 'filemode', '0644'),
('file_manager', 'show_hidden', '0'),
('file_manager', 'show_backups', '1'),
('ckeditor', 'version', '2.1.0'),
('ckeditor', 'filemanager_enabled', '1'),
('ckeditor', 'filemanager_base', 'public/images'),
('ckeditor', 'filemanager_view', 'grid'),
('ckeditor', 'filemanager_images', 'a:4:{i:0;s:3:"gif";i:1;s:3:"jpg";i:2;s:4:"jpeg";i:3;s:3:"png";}'),
('ckeditor', 'filemanager_dateformat', 'd M Y H:i'),
('ckeditor', 'filemanager_browse_only', '0'),
('ckeditor', 'filemanager_upload_overwrite', '0'),
('ckeditor', 'filemanager_upload_images_only', '0'),
('ckeditor', 'filemanager_upload_size', '0'),
('multi_lang', 'style', 'tab'),
('multi_lang', 'langsource', 'uri'),
('mbcontact', 'recipients', 'leslie_wongsk@webstergy.com'),
('mbcontact', 'fail_header', 'Failed'),
('mbcontact', 'fail_body', 'Failed to send the email, please try again.'),
('mbcontact', 'send_header', 'Email Sent'),
('mbcontact', 'send_body', 'Email has been sent, please allow up to 72 hours for a reply.'),
('contact_me', 'version', '0.2.2'),
('contact_me', 'form_id', 'contact'),
('contact_me', 'fieldset_legend', 'Contact Form'),
('contact_me', 'subject_wrap_class', ''),
('contact_me', 'subject_id', 'subject'),
('contact_me', 'subject_label', 'Subject'),
('contact_me', 'subject_class', 'text required'),
('contact_me', 'subject_placeholder', ''),
('contact_me', 'subject_position', '1'),
('contact_me', 'subject_error', 'You must fill in a subject.'),
('contact_me', 'msg_wrap_class', ''),
('contact_me', 'msg_id', 'message'),
('contact_me', 'msg_label', 'Message'),
('contact_me', 'msg_class', 'text required'),
('contact_me', 'msg_placeholder', ''),
('contact_me', 'msg_position', '2'),
('contact_me', 'msg_error', 'You must fill in a message.'),
('contact_me', 'name_wrap_class', ''),
('contact_me', 'name_id', 'name'),
('contact_me', 'name_label', 'Name'),
('contact_me', 'name_class', 'text required'),
('contact_me', 'name_placeholder', ''),
('contact_me', 'name_position', '3'),
('contact_me', 'name_error', 'You must fill in your name.'),
('contact_me', 'email_wrap_class', ''),
('contact_me', 'email_id', 'email'),
('contact_me', 'email_label', 'E-mail'),
('contact_me', 'email_class', 'text required'),
('contact_me', 'email_placeholder', ''),
('contact_me', 'email_type', 'text'),
('contact_me', 'email_position', '4'),
('contact_me', 'email_error', 'You must fill in a valid Email address.'),
('contact_me', 'submit_value', 'Submit'),
('contact_me', 'submit_class', ''),
('contact_me', 'error_class', 'error'),
('contact_me', 'success_class', 'success'),
('contact_me', 'recaptcha_publickey', ''),
('contact_me', 'recaptcha_privatekey', ''),
('contact_me', 'recaptcha_wrap_class', 'captcha'),
('contact_me', 'recaptcha_theme', 'red'),
('contact_me', 'recaptcha_error', 'Incorrect reCAPTCHA entry.');

-- --------------------------------------------------------

--
-- Table structure for table `wolf_role`
--

DROP TABLE IF EXISTS `wolf_role`;
CREATE TABLE IF NOT EXISTS `wolf_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wolf_role`
--

INSERT INTO `wolf_role` (`id`, `name`) VALUES
(1, 'administrator'),
(2, 'developer'),
(3, 'editor');

-- --------------------------------------------------------

--
-- Table structure for table `wolf_role_permission`
--

DROP TABLE IF EXISTS `wolf_role_permission`;
CREATE TABLE IF NOT EXISTS `wolf_role_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  UNIQUE KEY `user_id` (`role_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wolf_role_permission`
--

INSERT INTO `wolf_role_permission` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(2, 1),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(3, 1),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(3, 22),
(3, 23),
(3, 24),
(3, 25);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_room`
--

DROP TABLE IF EXISTS `wolf_room`;
CREATE TABLE IF NOT EXISTS `wolf_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageid` int(10) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_name` text NOT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `filename_home` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `room_date` date NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_by_id` int(11) NOT NULL,
  `sequence` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `wolf_room`
--

INSERT INTO `wolf_room` (`id`, `pageid`, `name`, `url_name`, `url`, `description`, `short_description`, `filename`, `filename_home`, `room_date`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`, `sequence`) VALUES
(24, 0, 'Deluxe Double with Balcony View', '<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n', '#', '<div>\r\n	<div>\r\n		<span style="font-size: 14.44px; line-height: 21.66px;">Cosy, initimate with a touch of modern day affluent living. Our Deluxe room complements the journey of travellers with some necessary warmth.&nbsp;</span></div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<span style="font-size: 14.44px; line-height: 21.66px;">Deluxe double measures at 18sqm comes with Balcony View, High speed Wifi , Complimentary Minibar and added room facilities.</span></div>\r\n</div>\r\n<table border="1" width="100%">\r\n	<tbody>\r\n		<tr>\r\n			<td width="50%">\r\n				<ul>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Balcony View&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Complimentary Mini-Bar, replenished daily (Cold drinks, Snacks, Coffee &amp; Tea)</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">High speed Wifi internet&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">LED TV</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Sealy Mattress&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Electric Safe Box</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Bathroom toiletries (Toothbrush, Tooth Paste, Shaver, Handmade Soap, Sewing kit, amenity pouch)</span></li>\r\n				</ul>\r\n			</td>\r\n			<td>\r\n				<ul>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Bidet&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Rain shower and Standing Shower</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Electric Kettle</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Utility Design Still Stand</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Non-smoking room</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Hairdryer (On request)</span></li>\r\n				</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'Deluxe-Double-with-Balcony-View-new.jpg', '', '0000-00-00', '2015-10-11 07:34:56', '2015-10-22 14:55:28', 1, 1, 4),
(26, 0, 'Standard Double', '<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n', '#', '<div>\r\n	Standard Room measures 10sqm are natural, simple and uncluttered. A simple way of enjoying a cosy lifestyle.&nbsp;</div>\r\n<table border="1" width="100%">\r\n	<tbody>\r\n		<tr>\r\n			<td width="50%">\r\n				<ul>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Complimentary Mini-Bar, replenished daily (Cold drinks, Snacks, Coffee &amp; Tea)</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">High speed Wifi internet&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">LED TV</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Sealy Mattress&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Electric Safe Box</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Bathroom toiletries (Toothbrush, Tooth Paste, Shaver, Handmade Soap, Sewing kit, amenity pouch)<span class="Apple-tab-span" style="white-space:pre"> </span></span></li>\r\n				</ul>\r\n			</td>\r\n			<td>\r\n				<ul>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Bidet&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Rain shower and Standing Shower</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Electric Kettle</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Non-Smoking room</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Hairdryer (On request)</span></li>\r\n				</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'Standard-Double-new.png', '', '0000-00-00', '2015-10-16 07:25:14', '2015-10-22 14:55:14', 1, 1, 1),
(27, 0, 'Luxury Suite ', '<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n', '#', '<div>\r\n	<div>\r\n		<span style="font-size: 14.44px; line-height: 21.66px;">YAN Suite is lush and uncompromising in providing a home away from home for seasoned travellers who want only the best.</span></div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<span style="font-size: 14.44px; line-height: 21.66px;">Suite room measures 28sqm has added features of bathtub, seating area and King sized bed.&nbsp;</span></div>\r\n</div>\r\n<table border="1" style="font-size: 15.2px;" width="100%">\r\n	<tbody>\r\n		<tr>\r\n			<td width="50%">\r\n				<ul>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Complimentary Mini-Bar, replenished daily (Cold drinks, Snacks, Coffee &amp; Tea)</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">High speed Wifi internet&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">LED TV</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Sealy Mattress&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Electric Safe Box</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Bathroom toiletries (Toothbrush, Tooth Paste, Shaver, Handmade Soap, Sewing kit, amenity pouch)</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Bidet&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Rain shower and Standing Shower</span></li>\r\n				</ul>\r\n			</td>\r\n			<td>\r\n				<ul>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Bathtub&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Seating area</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">King Bed</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Utility Design Still Stand</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Iron and Ironing board&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Electric Kettle&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Non-Smoking room</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Hairdryer (On request)</span></li>\r\n				</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'Suite-(King)new.png', '', '0000-00-00', '2015-10-16 07:25:45', '2015-10-22 14:55:42', 1, 1, 7),
(28, 0, 'Superior Twin with Balcony View', '<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n', '#', '<div>\r\n	<div>\r\n		<div>\r\n			<span style="font-size: 14.44px; line-height: 21.66px;">Fuss-Free, Self-sufficient and sleek, at the same time fulfilling every need of a modern day business traveller.&nbsp;</span></div>\r\n		<div>\r\n			&nbsp;</div>\r\n		<div>\r\n			<span style="font-size: 14.44px; line-height: 21.66px;">Superior room measures from 12-15sqm comes with High speed Wifi and Complimentary Minibar.&nbsp;</span></div>\r\n	</div>\r\n	<table border="1" style="font-size: 15.2px;" width="100%">\r\n		<tbody>\r\n			<tr>\r\n				<td width="50%">\r\n					<ul>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Balcony View&nbsp;</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Complimentary Mini-Bar, replenished daily (Cold drinks, Snacks, Coffee &amp; Tea)</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">High speed Wifi internet&nbsp;</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">LED TV</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Sealy Mattress&nbsp;</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Electric Safe Box</span></li>\r\n					</ul>\r\n				</td>\r\n				<td>\r\n					<ul>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Bathroom toiletries (Toothbrush, Tooth Paste, Shaver, Handmade Soap, Sewing kit, amenity pouch)</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Bidet&nbsp;</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Rain shower and Standing Shower</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Electric Kettle</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Non-Smoking room</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Hairdryer (On request)</span></li>\r\n					</ul>\r\n				</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'Superior-Twin-with-Balcony-View-new.png', '', '0000-00-00', '2015-10-16 07:26:43', '2015-10-22 14:54:48', 1, 1, 3),
(25, 0, ' Superior Double with Balcony View', '<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n', '#', '<div>\r\n	<div>\r\n		<div>\r\n			<span style="font-size: 14.44px; line-height: 21.66px;">Fuss-Free, Self-sufficient and sleek, at the same time fulfilling every need of a modern day business traveller.&nbsp;</span></div>\r\n		<div>\r\n			&nbsp;</div>\r\n		<div>\r\n			<span style="font-size: 14.44px; line-height: 21.66px;">Superior room measures from 12-15sqm comes with High speed Wifi and Complimentary Minibar.&nbsp;</span></div>\r\n	</div>\r\n	<table border="1" style="font-size: 15.2px;" width="100%">\r\n		<tbody>\r\n			<tr>\r\n				<td width="50%">\r\n					<ul>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Balcony View&nbsp;</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Complimentary Mini-Bar, replenished daily (Cold drinks, Snacks, Coffee &amp; Tea)</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">High speed Wifi internet&nbsp;</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">LED TV</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Sealy Mattress&nbsp;</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Electric Safe Box</span></li>\r\n					</ul>\r\n				</td>\r\n				<td>\r\n					<ul>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Bathroom toiletries (Toothbrush, Tooth Paste, Shaver, Handmade Soap, Sewing kit, amenity pouch)</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Bidet&nbsp;</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Rain shower and Standing Shower</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Electric Kettle</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Non-Smoking room</span></li>\r\n						<li>\r\n							<span style="font-size: 14.44px; line-height: 21.66px;">Hairdryer (On request)</span></li>\r\n					</ul>\r\n				</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'Superior-Double-with-Balcony-View-new.png', 'sd.png', '0000-00-00', '2015-10-16 07:23:54', '2015-10-22 14:55:20', 1, 1, 2),
(29, 0, 'Deluxe Twin', '<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n<p>\r\n	&quot;</p>\r\n', '#', '<div>\r\n	<div>\r\n		<span style="font-size: 14.44px; line-height: 21.66px;">Cosy, initimate with a touch of modern day affluent living. Our Deluxe room complements the journey of travellers with some necessary warmth.&nbsp;</span></div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<span style="font-size: 14.44px; line-height: 21.66px;">Relax in our Deluxe twin room which measures 18sqm comes with 2 Super Single beds and added room facilities.</span></div>\r\n</div>\r\n<table border="1" style="font-size: 15.2px;" width="100%">\r\n	<tbody>\r\n		<tr>\r\n			<td width="50%">\r\n				<ul>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Courtyard View&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Complimentary Mini-Bar, replenished daily (Cold drinks, Snacks, Coffee &amp; Tea)</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">High speed Wifi internet&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">LED TV</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Sealy Mattress&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Electric Safe Box</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Bathroom toiletries (Toothbrush, Tooth Paste, Shaver, Handmade Soap, Sewing kit, amenity pouch)</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Bidet&nbsp;</span></li>\r\n				</ul>\r\n			</td>\r\n			<td>\r\n				<ul>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Rain shower and Standing Shower</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Electric Kettle</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Utility Design Still Stand</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Iron and Ironing board&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Non-smoking room&nbsp;</span></li>\r\n					<li>\r\n						<span style="font-size: 14.44px; line-height: 21.66px;">Hairdryer (On request)</span></li>\r\n				</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'dt1.jpg', '', '0000-00-00', '2015-10-22 01:30:13', '2015-10-22 14:55:33', 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_roomimage`
--

DROP TABLE IF EXISTS `wolf_roomimage`;
CREATE TABLE IF NOT EXISTS `wolf_roomimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomid` int(11) DEFAULT NULL,
  `title` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` text,
  `sequence` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `wolf_roomimage`
--

INSERT INTO `wolf_roomimage` (`id`, `roomid`, `title`, `filename`, `source`, `sequence`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`) VALUES
(19, 12, '', 'room-images2_2.jpg', NULL, 0, '2015-09-08 12:06:58', NULL, 1, NULL),
(20, 13, '', 'room-images2_3.jpg', NULL, 0, '2015-09-08 12:07:34', NULL, 1, NULL),
(21, 14, '', 'room-images2_4.jpg', NULL, 0, '2015-09-08 12:08:41', NULL, 1, NULL),
(22, 14, '', 'room-images_2.jpg', NULL, 0, '2015-09-08 12:08:52', NULL, 1, NULL),
(26, 15, '', 'room-images_2_1.jpg', NULL, 0, '2015-10-02 05:33:12', NULL, 1, NULL),
(27, 15, '', 'room-images2_2_1.jpg', NULL, 0, '2015-10-02 05:33:50', NULL, 1, NULL),
(28, 15, '', 'room-images2_2_2.jpg', NULL, 0, '2015-10-02 05:34:51', NULL, 1, NULL),
(29, 15, '', 'room-images2_2_3.jpg', NULL, 0, '2015-10-02 05:35:24', NULL, 1, NULL),
(30, 19, '', 'room-images2_3_1.jpg', NULL, 0, '2015-10-02 05:46:25', NULL, 1, NULL),
(33, 23, '', 'room-05_1.jpg', NULL, 0, '2015-10-11 09:27:22', NULL, 1, NULL),
(35, 26, '', 'sd-2.png', NULL, 0, '2015-10-22 01:54:46', NULL, 1, NULL),
(36, 25, '', 'sdbv2.png', NULL, 0, '2015-10-22 02:01:03', NULL, 1, NULL),
(37, 25, '', 'sd4.png', NULL, 0, '2015-10-22 02:04:32', NULL, 1, NULL),
(38, 28, '', 'sdbv2_1.png', NULL, 0, '2015-10-22 02:05:07', NULL, 1, NULL),
(39, 28, '', 'sd4_1.png', NULL, 0, '2015-10-22 02:05:15', NULL, 1, NULL),
(40, 24, '', 'ddbv2.jpg', NULL, 0, '2015-10-22 02:06:53', NULL, 1, NULL),
(41, 24, '', 'ddbv3.jpg', NULL, 0, '2015-10-22 02:07:23', NULL, 1, NULL),
(42, 24, '', 'ddbv4.jpg', NULL, 0, '2015-10-22 02:07:46', NULL, 1, NULL),
(43, 29, '', 'dt2.jpg', NULL, 0, '2015-10-22 02:09:29', NULL, 1, NULL),
(44, 29, '', 'dt3.png', NULL, 0, '2015-10-22 02:11:11', NULL, 1, NULL),
(45, 29, '', 'dt4.jpg', NULL, 0, '2015-10-22 02:11:38', NULL, 1, NULL),
(46, 27, '', 'ls2.png', NULL, 1, '2015-10-22 02:12:45', NULL, 1, NULL),
(47, 27, '', 'ls4.png', NULL, 3, '2015-10-22 02:13:29', NULL, 1, NULL),
(48, 27, '', 'ls5.jpg', NULL, 4, '2015-10-22 02:13:43', NULL, 1, NULL),
(49, 27, '', 'ls3.png', NULL, 2, '2015-10-22 02:14:18', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_secure_token`
--

DROP TABLE IF EXISTS `wolf_secure_token`;
CREATE TABLE IF NOT EXISTS `wolf_secure_token` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_url` (`username`,`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=836 ;

--
-- Dumping data for table `wolf_secure_token`
--

INSERT INTO `wolf_secure_token` (`id`, `username`, `url`, `time`) VALUES
(1, 'admin', '902d29694fe0006a29e87eb480111f3a032cda17a948934ea59196eb99b51b23', '1425286600.1341'),
(2, 'admin', 'f13ee1237120d1464b5f41b6b57ec522172cd1011fe2fb0dffca82901a7dc0fc', '1424761081.1234'),
(3, 'admin', 'ee7f0ee2b63a101517dd252e6b2de2be4b34368c0fb0711d5bf9b0ed4613c3ea', '1424758880.4787'),
(4, 'admin', '503d690ee8ba2a206ba14567185ecc18224dec200ded2bd94c1dd9ce54280013', '1423754696.1624'),
(5, 'admin', '78f8bf33914bb36686d8ee98b102f085e2520b81ec569d4470e60b9193a2a26f', '1423033104.3241'),
(6, 'admin', '04588316e70ffe7e0e99418052bf2bc79dd77fe728a0810376121f987d55fd8f', '1421847851.9773'),
(7, 'admin', '81488c4c769f355463f8965293321df28cf41d1f912f0204e60215b19232c6ee', '1425286400.3945'),
(8, 'admin', '2a36f666c05c765233c1e370fa601ca1f3a5ec682404df2f1eb02440b18018ca', '1425286533.4153'),
(9, 'admin', '7e97f6872990d1b7649c778d3af903d770bb60c3b53416cff23d157ff4fd03a6', '1425286533.4199'),
(10, 'admin', '4c87ebf783786c08b47f359ca6d88eb6d3ed3719b120c3c5759ee1e3ad88d4c9', '1425286533.424'),
(11, 'admin', '91ae731a31e09197f342053dcb2af29057030abbd2320a7a58be3b96b3ab192d', '1425286533.4286'),
(12, 'admin', '0b219cb16b7eae287e988efd0f905b677e69cff99a2312abd557130821582490', '1425286533.4333'),
(13, 'admin', '6592e68c5094a76f1aec7c0a97200f3e73073e59d054602d7cae714b70c47f97', '1425286533.4391'),
(14, 'admin', '9df158a67bff9c3975a2d331cc2f4b186c8179dccadbbaead04341cf418612f8', '1425286533.4448'),
(15, 'admin', '2c95ede78fbcb320689d50500379e8a381f882d4c1c2147d635479be51d3abb7', '1425286533.4498'),
(16, 'admin', 'd18c9bd30002e433143d8e1c1f9fd19db5d62b9688b864e7909080ac82b7654a', '1425286533.4553'),
(17, 'admin', '2171c0209f2848e7c1d58193582f788515e55e23e56d34aed3d1f71a23aba6f5', '1425286533.4593'),
(18, 'admin', '69cb5f4401afb6c4e24a3640faf6f38642bfecb40d5ab6b139179ebbc62a30bb', '1425286533.4633'),
(19, 'admin', '75a9a676cae274f652bd8bd7663e58e6e11725ac01ca0dfc234d548283251fd7', '1425286533.4674'),
(20, 'admin', '18eb2380abba74e3a98609aecb1136eb2881007d49490872763527142d85a22a', '1423034944.0813'),
(21, 'admin', '7f2eb4659884e50465258671aa4b990450ccd111c5485d9b85eb71b746576e46', '1425286533.4713'),
(22, 'admin', 'd694ca354eba315208b53a54ac71ca73bc86d399e177c146474a0c451dfc62ed', '1425286533.4758'),
(23, 'admin', '2107d40f79d6f95983f0e471341eff947d863ab5c064a05a63098897c01839f0', '1425286533.48'),
(24, 'admin', '36990b38120bb9ab0cec6d9e04a317b330ee8c18c912cfaba8ca7a0ffedf616c', '1423200471.0177'),
(25, 'careen', 'f13ee1237120d1464b5f41b6b57ec522172cd1011fe2fb0dffca82901a7dc0fc', '1421834519.6913'),
(26, 'careen', '902d29694fe0006a29e87eb480111f3a032cda17a948934ea59196eb99b51b23', '1421834519.7012'),
(27, 'careen', 'ee7f0ee2b63a101517dd252e6b2de2be4b34368c0fb0711d5bf9b0ed4613c3ea', '1421833835.2284'),
(28, 'careen', '36990b38120bb9ab0cec6d9e04a317b330ee8c18c912cfaba8ca7a0ffedf616c', '1421833618.6869'),
(29, 'careen', '2a36f666c05c765233c1e370fa601ca1f3a5ec682404df2f1eb02440b18018ca', '1421833582.0136'),
(30, 'careen', '7e97f6872990d1b7649c778d3af903d770bb60c3b53416cff23d157ff4fd03a6', '1421833582.0174'),
(31, 'careen', '4c87ebf783786c08b47f359ca6d88eb6d3ed3719b120c3c5759ee1e3ad88d4c9', '1421833582.0207'),
(32, 'careen', '91ae731a31e09197f342053dcb2af29057030abbd2320a7a58be3b96b3ab192d', '1421833582.0233'),
(33, 'careen', '0b219cb16b7eae287e988efd0f905b677e69cff99a2312abd557130821582490', '1421833582.026'),
(34, 'careen', '6592e68c5094a76f1aec7c0a97200f3e73073e59d054602d7cae714b70c47f97', '1421833582.0287'),
(35, 'careen', '9df158a67bff9c3975a2d331cc2f4b186c8179dccadbbaead04341cf418612f8', '1421833582.0313'),
(36, 'careen', '2c95ede78fbcb320689d50500379e8a381f882d4c1c2147d635479be51d3abb7', '1421833582.034'),
(37, 'careen', 'd18c9bd30002e433143d8e1c1f9fd19db5d62b9688b864e7909080ac82b7654a', '1421833582.0366'),
(38, 'careen', '2171c0209f2848e7c1d58193582f788515e55e23e56d34aed3d1f71a23aba6f5', '1421833582.0392'),
(39, 'careen', '69cb5f4401afb6c4e24a3640faf6f38642bfecb40d5ab6b139179ebbc62a30bb', '1421833582.0418'),
(40, 'careen', '75a9a676cae274f652bd8bd7663e58e6e11725ac01ca0dfc234d548283251fd7', '1421833582.0443'),
(41, 'careen', '7f2eb4659884e50465258671aa4b990450ccd111c5485d9b85eb71b746576e46', '1421833582.047'),
(42, 'careen', 'd694ca354eba315208b53a54ac71ca73bc86d399e177c146474a0c451dfc62ed', '1421833582.0496'),
(43, 'careen', '2107d40f79d6f95983f0e471341eff947d863ab5c064a05a63098897c01839f0', '1421833582.0523'),
(44, 'careen', '503d690ee8ba2a206ba14567185ecc18224dec200ded2bd94c1dd9ce54280013', '1421833559.4386'),
(45, 'careen', '7c2ae93b13b487c3ec09623233bb7773443dbee8e8936c1f78e4210a1a8b446c', '1421833541.12'),
(46, 'careen', '79cb975364027cee1b8fcdd70dd8096d904cc317b02a1a65e1b293e688ad2662', '1421833582.055'),
(47, 'careen', 'f0ecfde165fdaa9b90f9430dae8777f34a9df5e8923ce443627aaa93a7c054c4', '1421833582.0577'),
(48, 'careen', '16861bf1181d7f74fcaefd77464e2e643376600c050dcd7a08499f70cd1f1d88', '1421833582.0603'),
(49, 'admin', '79cb975364027cee1b8fcdd70dd8096d904cc317b02a1a65e1b293e688ad2662', '1425286533.4844'),
(50, 'admin', 'f0ecfde165fdaa9b90f9430dae8777f34a9df5e8923ce443627aaa93a7c054c4', '1425286533.4891'),
(51, 'admin', '16861bf1181d7f74fcaefd77464e2e643376600c050dcd7a08499f70cd1f1d88', '1425286533.4933'),
(52, 'admin', '1655860b6bcc0ee9a48d438fced0c73a97e662d61fd7806d2d94ef297ef70fd1', '1423290309.1215'),
(53, 'admin', '6e916faa089fa50cf76e54f4069304ebdb6ccce6b6b90d79fd10312fd976d1ea', '1422444562.5817'),
(54, 'admin', 'fe00feb134d6ffe994abc4ac1952f9b6c56eb8b69fe9835492fbd62c0ff61058', '1423798020.8587'),
(55, 'admin', 'ab1e27fab3639e3660242481685c1a472db02c0a5e838816d8f4118721b57282', '1421906224.0083'),
(56, 'admin', '31ce8be43214ad8e26aa467dab53eb1dd4a66da6400e42ecaa6afe644ed681ac', '1422193090.4133'),
(57, 'admin', '1e1ef2a6b94c03145d89d8cca09410c7ccaa1db9df58f5ade0be6010f10cb05a', '1422267294.9194'),
(58, 'admin', 'b42ff6d363686f68fa019227c29c4c86bf1cafce7313b52fcf8ee8ef83a39efd', '1422251666.6445'),
(59, 'admin', '6ba4b91b5c0be3f3923802a5217272d48d087f4947e1d96c367461a1f529bb4c', '1422267294.917'),
(60, 'admin', '607f06cc2644e8ed5be6a32aa177c9bd60b471be8c3f3ad0e5741ee7d9c58abb', '1422267296.8319'),
(61, 'admin', 'c81cc0e2e5973afef28081e8e7ae5705296bdfcf60d8fe2607524c423b2a0e63', '1423034431.9593'),
(62, 'admin', '966b6434c0478feef54c246d79eec1be6c066c6f2241eb4c4761ea97876f8c5b', '1421926435.0717'),
(63, 'admin', 'b353bbd0c8af6c7552a3f1c0324890c525830fde6ec405abe7f7da464eed331b', '1422430492.8642'),
(64, 'admin', 'c15ae3658fcb2c329c1d56ab5a3b3b455d90a28c29bc55e55991948caff49c81', '1422430491.6859'),
(65, 'admin', '188fffdb7ab65bced0060b1b0eeaf06bc002ed11e117c4bb3916f15897553389', '1422430494.7359'),
(66, 'admin', 'da2a6e9362c289e3b0c61f9e789f6a3fb3966615b856f8a373be93fcb7a28a58', '1422430491.6838'),
(67, 'admin', '08519ae4441a5c1badba8321e43b3f04df73948abfee063f0107047c7163c3d1', '1423205102.6316'),
(68, 'admin', '05a59385e3964a517b43e8bdc4fb99d37ecc7b8aeea0283b3a481268622f17d8', '1423290094.7209'),
(69, 'admin', '3c50e0a077bdd98214a3f5610dba9a568c7e8a20d3f39a7e0787c37c003c09ff', '1425286600.1144'),
(70, 'admin', '41e2d3b80de9489de3a76d11cbfbe443b64b0d9fdeae786983ac884c30d382b5', '1422267294.9068'),
(71, 'admin', '570a6857544b2d07c2109a732edbfac5146f73367f4807eee901edf3f5baa2f6', '1422186269.3481'),
(72, 'admin', '85bdf12c27cf97aeaedb4057a1e0325947277b53a1c7034a8bf4bf84018452eb', '1421944559.966'),
(73, 'admin', '23643f446210fdb10e5523b85ff8989a988b58e6175b5827fe90ca94c9c49086', '1424749920.4194'),
(74, 'admin', 'fe4b3969a7d49dcfd5c47e325ba4b7568b9627200d6d63a67be2a868c4229c95', '1425286543.198'),
(75, 'admin', 'e9fd7ee03917ff7e5bbb859a59e3cd68677aaadae849d965aed99a56d0ed6abd', '1425286543.2036'),
(76, 'admin', '670630dbbf6ca9ea3e0e77aebc2873295f2a99020ba19d6c6f6291d104c0edbf', '1422430469.7095'),
(77, 'admin', '72ae7ae28c5508d5af4ad8813e1f579267f232495b465b4a6337cdebdb746947', '1424749920.4696'),
(78, 'admin', '98e3304d022e7adb495ac3744729f8a48d1e98575c973c436fe19f8718d382b5', '1422251056.5131'),
(79, 'admin', 'aa81c25d2dac1b601280a2de62b9c661a07541272a93ff89ff7862ff7cc2cf71', '1424749920.4754'),
(80, 'admin', 'b1496a7180db9f4fdcb62901d948eef40cf5ea1b743e0d32fe8dba3eb6ecf64f', '1423034890.7098'),
(81, 'admin', '71bbd7bc83e579e0896673a4a44917b0c4ed985e2ede270067ca1f0c11efce20', '1423242632.0981'),
(82, 'admin', 'babc956fbaba63da09e51513ccf7f522c710345a8a55c3ea12acbe371fcd1330', '1424749920.5103'),
(83, 'admin', 'f52fa5070a814c177f06aea2b118c6b884dadd8116595f0107a3a3f60cfc72a0', '1424749920.5157'),
(84, 'admin', '0e2cba7acc5a007a8834c064f4dc56cf85af960534ebb3c390e83a46dd36502e', '1424749920.5218'),
(85, 'admin', '7c2ae93b13b487c3ec09623233bb7773443dbee8e8936c1f78e4210a1a8b446c', '1422186416.9977'),
(86, 'admin', '86208cb36e7de2d563276a0f67f7f68be35df36ce97d3945c8d0f27349c6ce91', '1423034926.2697'),
(87, 'admin', 'ba2403c4253f650abcd2c928b19d09ed003000230a5f0c4ca42a6564241a22bd', '1423124745.4923'),
(88, 'admin', '286ca02f564326da28ff3160aa9590267884e34a163fa77e80648bda015f5b1a', '1423026644.3626'),
(89, 'admin', '9ca14cd279790a6ccf613ad5be2a0a16155ea50d3cae9fd66b2d6a8e8649114f', '1423034959.9775'),
(90, 'admin', '4e4a170ace2565242102fb3206164d5e5045c92230dc9c3034d2c3527a4d3eca', '1422186131.6307'),
(91, 'admin', '4cdc94941ad36cd5d5960838aaaad4b9228277008f20f012c8cfce595d508020', '1422186435.1128'),
(92, 'admin', 'efd6601ab29c3a1364f4093347b4884418fbe7bcd007e4afb03966dac448f6f1', '1422186458.1955'),
(93, 'admin', '2c50b9c41a9f1a204e451f049d5725df7e11a2e107ba3efc15ed76d0d3907c9d', '1422186320.4024'),
(94, 'admin', '8d1bee6c792e5b56d91db6d9921591454bcf1d6a7a48741e0084e33cf3d87cda', '1424749920.4247'),
(95, 'admin', '0c73fbe1d4c3a5c34cb674d621ebb331535910cc1e06baad10d4dbe9260256f7', '1421978940.7076'),
(96, 'admin', '43851464886470cdd1eb58d86b03439e536412bc7a209cb5d3d61530fb2cc894', '1421979033.3624'),
(97, 'admin', '4f0062f05b0e21b0049a46cd1a4d3cfe925bfa74cb323a317db235dfaf5d6b85', '1421979016.0342'),
(98, 'admin', '517a1226e8495fd9f18267fdd9b5856cf2ecf3bb0e0c08c4e76b5aa70f13314b', '1421979033.3639'),
(99, 'admin', '8726cb96b6ad1e4f16448f51cdf4df3b89289f9632679af9fa8f0b74a50660b8', '1422186375.4488'),
(100, 'admin', '835898734fc185f58ecd0dc1375e0d6fbdc72df79624986d7d4bd923f732dc26', '1422186393.925'),
(101, 'admin', '4d77bb6030d7b27f2644cb18f504e09b99862b740507cc5c447a907560efcd6a', '1422198052.8023'),
(102, 'admin', '4a76e1677eb3da9dd25b51c3bb9400a6b7b9fc24c77d33a68c1e9ab8c7bba1af', '1422197049.8394'),
(103, 'admin', 'dada9ccd905159ccbbdfce724fbff66a3dcacfa7d785dc11aaa0a58936bbe15c', '1422198073.245'),
(104, 'admin', '6665ccabf0d4e77de2e9c07f9ca1c85dbb20bb1bd11d6fffc6bab1bce445aa5d', '1422198085.6884'),
(105, 'admin', 'd8625f80e8de801fa99dcde61aab23cc051556f2f951ee17f2c37cf253be0e6b', '1422199142.766'),
(106, 'admin', '4165ca9fbb95df045c30a3491f952ec8180e0b182af550d098e15eb1ee6d7387', '1422198904.6079'),
(107, 'admin', 'd1e73b4a22283a4ddafbb565e1840552752964a2c1e3ca77bc71e708e35c1f84', '1422251701.3842'),
(108, 'admin', '6fef8aa8df116bf3a757f1e030a7778ea6cdf68ccaef21594caff10028299484', '1422259036.9183'),
(109, 'admin', '96862891ed8642a02836772ca35f6df2c8fa17ea9fcf5b954385fd6acd1f144c', '1425286525.2007'),
(110, 'admin', '75e293d883cd61b7d84e7774ca78f95046d11457c02a2ba74fe4df0fda0fae16', '1423028340.4181'),
(111, 'admin', '82a890edda9bc2367cf6f1e4579e442b988750a3f7647eac91b060228d20db13', '1423034590.1402'),
(112, 'admin', '0387ffc63f7724855dc5cbae491caa2ef8948389b8c02a4e1bee3d14ccafd3b3', '1423034590.1424'),
(113, 'admin', '56cff78223675fe8b6b6d49fa105503531588cac960f517c3892e85cd2e9efcf', '1423034590.1443'),
(114, 'admin', '382fe2ffee5bbb373fdeadfdae176087b87647baa3fcbea943e3e4cf576da109', '1423034590.1463'),
(115, 'admin', 'df1694569c69d728cd2d5f85ffc7892072340a5bc334c7f0f40a0b92e5b43632', '1423034590.148'),
(116, 'admin', 'dc178edfbc57c45c9097ffdf362dd10a69c981bc088014f6fb13e938183681e7', '1423034590.1495'),
(117, 'admin', '6ab098295526786257d86f7320a932d951e836d8c736f3ed5f172ed4ae306e84', '1423034590.1512'),
(118, 'admin', 'bde1e8d8fdfdd1ce120262b316b6d19c945cee5d8a71fd13bdff995040e9f9b0', '1423034590.1531'),
(119, 'admin', '84a34aaf6577a57e83bab411b90c0e95b55ed1f74ecd4e858882561294050d6a', '1423034590.155'),
(120, 'admin', '2bf36e64488b98003013ff6c705a893bbe3a2c476b2f5f8a8159be51d73f0e42', '1423034590.1574'),
(121, 'admin', 'baefaf0851c3585ed8a870fbd66b05827caf28a8b99eeb2573f7d74836e4acd2', '1423034590.1599'),
(122, 'admin', 'f17be1802f6689a8963f48d1b642017ca6d9127506dbefccca9389ea352b60ec', '1423034590.1621'),
(123, 'admin', 'c66526a0fe0bee515920bea4c2efd5bad508450cadf887d139bfaa1c4452bb90', '1423034590.1639'),
(124, 'admin', '9fa02c89efb46b0dafeb24f0c216d79ae9fef73fe2ee77c63df95382f3d036ee', '1423034624.5265'),
(125, 'admin', '4dbc85018ae5c3d9d0b33fc36f018b37508e52339da128797fd6e9fc01eca84e', '1423034624.5286'),
(126, 'admin', '69da5fbf6c5fef1c5c8438041643c858c5e413cadcec3b4237e1c533adc9996e', '1423034624.5306'),
(127, 'admin', 'e38f0c55fac1ca8788eb187b8b4d01a1fbcd42ec4848886367689b39de8f258c', '1423034624.5326'),
(128, 'admin', 'af56b9081fcdba36983a4017556fde7854c22d8f47a15514491feba753e1ae0e', '1423034624.5348'),
(129, 'admin', '6ea3c4f79c971274e5c3c84145a26ba0692d37c631498a50eed2af93f82fe43a', '1423034573.1866'),
(130, 'admin', '15f0205a8f1d6a3b93c923cc3897c7fbf469bd6f580dd6d82b3c4c12a401d70f', '1423034594.4766'),
(131, 'admin', '2e71fc838b792fd65007efa288ede04688ff205cb3cebf9f797fd346767e6b82', '1423034595.9661'),
(132, 'admin', '357959a92302f0d75883ee4925fbedd548ddae4b360d4d7cd4681a52491a59e5', '1423034595.9682'),
(133, 'admin', '613c9e86ff6b71029e479c15fde8114d5fb513080a4d4d1974eeba9220ca6620', '1423034595.9722'),
(134, 'admin', '5a6920d182f209d2b1321b61cc4af86d4c902b2c4ff4ca77b880bbab7b18cca7', '1423034595.9742'),
(135, 'admin', 'c6cf05416ffecc1017c82d64c428ea14795646fee3d5c469384cc8d04ab5c6ad', '1423034624.5177'),
(136, 'admin', 'fbcfca49834a05bafa9746489a2b5b5714a746ea4dbc3e8950e01c35bfdd8e8d', '1423034624.5201'),
(137, 'admin', '8188845c86b497ac1fe086ad9a919cdb37ddc1397245b3f9996bfbda603dff66', '1423034624.5223'),
(138, 'admin', '78d8c6066b05f1114eaa71d383592978898555f35582930b5f2d3a286b6eb9cd', '1423034624.5244'),
(139, 'admin', 'f545ad23e3bb797e7d5e2213e7a8e4a58f8cf7f1166dfcf16b89c91e5783680d', '1423754858.3367'),
(140, 'admin', 'a165c6d4655ca9beafa1242e9b869751852ff208accfb0912ad08c7122c5a514', '1425286543.2091'),
(141, 'admin', '6845abb6a3924eeb727bcbbd0d86a6b630108f6c73b5a09f933c4f1ddc50b763', '1428000722.5067'),
(142, 'admin', '341cecae00b329d41eab1a514085cefb6025ae156de738023e6305c0b4705369', '1428000722.5494'),
(143, 'admin', 'e268e0d5a2423a7e1f1c00cf44e02493690084f3ff14e162182341c6ed005f3c', '1428000722.5572'),
(144, 'admin', '292436c866ebd49804c3e8981256c309e095e499f5e87459c107f6e0d10c5a2e', '1428000722.565'),
(145, 'admin', '507604c7fc310e01a06c133bdc3d600dd060a0a578729d7663dcd590d68662ff', '1428000722.5726'),
(146, 'admin', '0d9a80f8b5a812981d484008792f0e47da8f92c4b8e36122026f6dcfd1756929', '1428000722.5801'),
(147, 'admin', 'da8179ff94822e1544406a44eaaa233b8054b56d43dc828141704612ad4d79a7', '1428000722.5877'),
(148, 'admin', '5764fdf8b571c2560d916b6dcf735e09ae99749a066f35bc0700a2c5228ff827', '1428000722.5953'),
(149, 'admin', '27aa1f653d53e512dc314745be32d14ac6089168963672423d307073801624f6', '1428000722.6031'),
(150, 'admin', '15b3134d3bb762937b017e6346a38738622bbcca91c186501a499b0ac0092925', '1428000722.6108'),
(151, 'admin', '08389381b63098861d572376e2ca3f8f034e237c1efe383c2817e9388e7a4ee5', '1428000722.6342'),
(152, 'admin', 'd07578383f884c9b58c7fa136de07b87ac7929dadd0bfb9d4e25c5611408eec0', '1428000722.6432'),
(153, 'admin', '8035b8c6b80d1aa79d2d8d56dd91ff89095feb1a89596c98a44c227ede9df572', '1428000722.6513'),
(154, 'admin', '0ae976270f1ff0b4ffbde27e3caf77201195ee3a94712fc00ab483c3a8fb771b', '1428000722.659'),
(155, 'admin', '3f1103e3abe1c3448a0ef82b8ebc2dabaf2546626ca889dcdfcc73255f2ff490', '1428000722.667'),
(156, 'admin', 'fa67c1d14cdd553fb41915f47f2b040b3a28877c0ee842eb8864a57fcc8ae5e5', '1428000722.6746'),
(157, 'admin', '197da47d5c302fcfb2014b0b116fec11a142effa70701d98e76d4aaf65511cd7', '1428000722.6824'),
(158, 'admin', '3872a1f42bc0e7e28ba372d59cd1dc8821ba5419c8a599e8066d84d74e2964e8', '1428000722.6901'),
(159, 'admin', 'af9d5db7b30b99ff67d77259e89328359f8c20adf4f6cbde3f82a8776a5d2131', '1428000744.0578'),
(160, 'okstmtcc', '6845abb6a3924eeb727bcbbd0d86a6b630108f6c73b5a09f933c4f1ddc50b763', '1427729703.1175'),
(161, 'okstmtcc', '341cecae00b329d41eab1a514085cefb6025ae156de738023e6305c0b4705369', '1427729703.1271'),
(162, 'okstmtcc', 'e268e0d5a2423a7e1f1c00cf44e02493690084f3ff14e162182341c6ed005f3c', '1427729703.1367'),
(163, 'okstmtcc', '292436c866ebd49804c3e8981256c309e095e499f5e87459c107f6e0d10c5a2e', '1427729703.1465'),
(164, 'okstmtcc', '507604c7fc310e01a06c133bdc3d600dd060a0a578729d7663dcd590d68662ff', '1427729703.1562'),
(165, 'okstmtcc', '0d9a80f8b5a812981d484008792f0e47da8f92c4b8e36122026f6dcfd1756929', '1427729703.1659'),
(166, 'okstmtcc', 'da8179ff94822e1544406a44eaaa233b8054b56d43dc828141704612ad4d79a7', '1427729703.1755'),
(167, 'okstmtcc', '5764fdf8b571c2560d916b6dcf735e09ae99749a066f35bc0700a2c5228ff827', '1427729703.1852'),
(168, 'okstmtcc', '27aa1f653d53e512dc314745be32d14ac6089168963672423d307073801624f6', '1427729703.1949'),
(169, 'okstmtcc', '15b3134d3bb762937b017e6346a38738622bbcca91c186501a499b0ac0092925', '1427729703.2046'),
(170, 'okstmtcc', '08389381b63098861d572376e2ca3f8f034e237c1efe383c2817e9388e7a4ee5', '1427729703.2347'),
(171, 'okstmtcc', 'd07578383f884c9b58c7fa136de07b87ac7929dadd0bfb9d4e25c5611408eec0', '1427729703.2449'),
(172, 'okstmtcc', '8035b8c6b80d1aa79d2d8d56dd91ff89095feb1a89596c98a44c227ede9df572', '1427729703.2547'),
(173, 'okstmtcc', '0ae976270f1ff0b4ffbde27e3caf77201195ee3a94712fc00ab483c3a8fb771b', '1427729703.2646'),
(174, 'okstmtcc', '3f1103e3abe1c3448a0ef82b8ebc2dabaf2546626ca889dcdfcc73255f2ff490', '1427729703.2743'),
(175, 'okstmtcc', 'fa67c1d14cdd553fb41915f47f2b040b3a28877c0ee842eb8864a57fcc8ae5e5', '1427729703.2838'),
(176, 'okstmtcc', '197da47d5c302fcfb2014b0b116fec11a142effa70701d98e76d4aaf65511cd7', '1427729703.2935'),
(177, 'okstmtcc', '3872a1f42bc0e7e28ba372d59cd1dc8821ba5419c8a599e8066d84d74e2964e8', '1427729703.3031'),
(178, 'okstmtcc', 'af9d5db7b30b99ff67d77259e89328359f8c20adf4f6cbde3f82a8776a5d2131', '1427729809.4001'),
(179, 'okstmtcc', 'ae718b7f9ea1852e0df3952ee82a4c1a1d8b9a775e5307f37715739510b8ae44', '1427729803.3109'),
(180, 'okstmtcc', 'be14cc81dc46e758d88a42e2a173b69e2905c9b17ce6683eb81910dc4849cb3f', '1426818274.2125'),
(181, 'okstmtcc', '5a0c5b99933d795b2a887d5eec2ba3b8758c55c2fc3dd7dbb91e57cdeb1cce8e', '1425543510.8633'),
(182, 'admin', 'ae718b7f9ea1852e0df3952ee82a4c1a1d8b9a775e5307f37715739510b8ae44', '1427279650.1581'),
(183, 'okstmtcc', '0177976998a0677b7a37150e25d735bd6cdff2791296a667f99f3fbdf292382b', '1425893088.7887'),
(184, 'okstmtcc', 'fd110fcfe54bc72fc64ffc213f01e14dd6646c1b43a041e3e0afc7f79e149828', '1425893088.8081'),
(185, 'okstmtcc', 'b949b3f5e51eca94bc8eec3d99fe4bc95119e27e99da2b272193c5ad2832612e', '1425893088.8171'),
(186, 'okstmtcc', '0f6dc38ee41a8c1dd7090e2264a9d02a87b932347da20a6f1f297bc46cb92e6f', '1427713060.5796'),
(187, 'okstmtcc', '24a8f3630ef4bd0881dca73420f64de17ec5491935e42fb2c6ae65865484cd28', '1425816351.4453'),
(188, 'okstmtcc', 'f857c3be1286efb8b4771d6758057b42fe0b54e2c5b3019269b6e81bfdd47c8e', '1425893088.8275'),
(189, 'okstmtcc', 'df721b30694044b5441d416117047a898f29279ea7a7d8168f0218084e38ea2b', '1425816347.1474'),
(190, 'okstmtcc', '6b8c8996c0635242f0bc083e9f661922c4922d5f6f01b4c08b6a7652089068ca', '1425725154.8389'),
(191, 'okstmtcc', 'ff9ed091221d91cdead0c6fd926db37aaaf97731ec2356bcc9109318cb0f4287', '1427728808.4962'),
(192, 'okstmtcc', '28a3b55183462e70a6708e5f81b98dd0256e813271c5e00b7eb58dc5d26841bb', '1425717234.6421'),
(193, 'okstmtcc', '79f169f276d4259b4d8f2f99d92891ab5d71cfe7c949c91c75ccd3c6a0f84e4d', '1425893088.8485'),
(194, 'okstmtcc', 'f54c80f4d1d70e818d440b0a80b1cf10734ae9527ad057297bdae19abd8d8d40', '1425893088.8592'),
(195, 'okstmtcc', '285977958b0ad032ec8ef59431e40b561ebf15510de0947c05cb904b108fce9a', '1425816240.4093'),
(196, 'okstmtcc', '6be0f0d2c577510cc18ae971b2d2a9b28bd86da43a9d65c332cd86b290c2d85a', '1425893088.868'),
(197, 'okstmtcc', 'fcc2800911cf619092147737ba2834e1158bb66d828a077dccca2e313610fd1f', '1425725157.6645'),
(198, 'okstmtcc', '03c06265b36cd74e963f8d7f6447d7afc12672a020f2c0c50a11d400f9911595', '1425816512.517'),
(199, 'admin', 'be14cc81dc46e758d88a42e2a173b69e2905c9b17ce6683eb81910dc4849cb3f', '1426676219.3265'),
(200, 'admin', '3f7caac3fa4a9c5d89c03a55afa59aadf486d1aae7b8c47a42015d05d4760d8a', '1426611122.3229'),
(201, 'admin', 'd2d7129b097330d1d0c070113f287de1b75dffa0f479d743ef934b995715e175', '1426617655.2302'),
(202, 'admin', '90b10545bc5d0b51b3e9c731232f2be0bd4b4a8803bb27a3b4db561b2f383199', '1426707601.176'),
(203, 'admin', '28a3b55183462e70a6708e5f81b98dd0256e813271c5e00b7eb58dc5d26841bb', '1426745932.2058'),
(204, 'okstmtcc', '9a2ecdd655dd3ea44b754d83d2b40d11cb65ee5f96ee27fb79badf95520125a0', '1427170775.1348'),
(205, 'okstmtcc', 'a7b1e089e017c43c08dbb46c8ee603702fb0c0784dc4f18ed6fa21d063999152', '1427729707.1627'),
(206, 'okstmtcc', 'f70a1c2a0a12e16f4a1322407c2595b1766129363532755067d4f3f2b33c57cd', '1427729703.2144'),
(207, 'okstmtcc', 'a7fad7b5efe8a3a37e4cc46e8e4a32d4ff2a177bca7c332acbfe3ce8044c83c5', '1427729698.3375'),
(208, 'okstmtcc', '1c1e9e8d07d479bc8426d406b4353f05cd728f1d8af5d9bb9ec9b4f14f276168', '1427729703.2248'),
(209, 'admin', 'f70a1c2a0a12e16f4a1322407c2595b1766129363532755067d4f3f2b33c57cd', '1428000722.6185'),
(210, 'admin', '1c1e9e8d07d479bc8426d406b4353f05cd728f1d8af5d9bb9ec9b4f14f276168', '1428000722.6261'),
(211, 'admin', '27322d2486c73f98c863e1212599ebfeb577bcb33c6342df86f88af36ac0295f', '1428034553.5113'),
(212, 'admin', '182abb2efde1b734814a5f71dcb4d57fa389fac4fa9f7d67d3153e832ed55924', '1428034553.5191'),
(213, 'admin', 'dd9686f4482737426c71516616aca85f7c6bccf64febb659d80f730d66e826f1', '1428034553.5268'),
(214, 'admin', 'ce7bcfff76e3a4e368458b860a987ae3c9214a7c63d3184396c221354223eded', '1428034553.5346'),
(215, 'admin', 'fde84b5e2c7981b22c67835ae32ce5314c60b59765a3c4d8ce6aa35e171b8879', '1428034553.5428'),
(216, 'admin', '6d198dcfec69ef0260c7577b1bee9d0149300ddd575e4398fa2805d6e5eae8d3', '1428028698.1737'),
(217, 'admin', '2731ea8992e3d625376345aa03dc5c1fb735e277308570cb88493b91bae1f641', '1428034553.6026'),
(218, 'admin', 'bb25efe33d00e07f4bf3906aa22e694671f5c66401c49a4ef256b62bf100b68b', '1428027523.9849'),
(219, 'admin', 'e5030fc410795c9de5eeb69c7cbef8c9922f43588a09c89073505a304560b08e', '1428034553.5867'),
(220, 'admin', '217bce34b43b7390f318b31eca856c8e762a4eb19ecd9dfe70db5d0e48d8330e', '1428029250.3273'),
(221, 'admin', 'fddde6e7f4850ef93a32e965de763da007979ac83c18c44cffd0fb805afdfd95', '1428028391.829'),
(222, 'admin', '419599b5495f9941b5abf781052e57d71d4593d2ceec2fa0214200d5a6a1d7fe', '1428028410.8293'),
(223, 'admin', '80a1b33bdc967458f3e8e5ac823f2847ba8b5f34cdf94b6184748010ad0f3f02', '1428034553.5947'),
(224, 'admin', 'b0e623274d2e36b858cfb1cc0e67f25ca7160f0259e34616a72b9aa504480f27', '1428034553.618'),
(225, 'admin', 'd82a919c402c385b3d24dd31013613864cc2b0500c5cce27ee5b6d86b54eff27', '1428034553.6104'),
(226, 'admin', '244c2c8c7a10b021ce5b7e6af20421f97c5a3baf5227320d739242ce3ad9fe6d', '1428034553.6257'),
(227, 'admin', 'cfbf316af996a9e3526d3dd93b6b60ab6129dc511db04883038a719de7acf8ea', '1428034553.6334'),
(228, 'admin', '8acc5e66c0d8b6fac1dcc84ede5a95dfba360c14cbd9bda761180fbc1af229ca', '1428029417.5006'),
(229, 'admin', 'f91a897340cd287686be33bfbab354a431c8a9ed7ea98dae8bb1dc44f8310b0b', '1428029433.0042'),
(230, 'admin', '4fcb9ae7bc104324fa83e940d529586f6abbd7b8b4fd691279f8674529feabf6', '1428029438.84'),
(231, 'admin', '2f907bad503908765690284ff131c6320b0b1ff6fcf262cda602f8e3d9378f8d', '1428035129.6153'),
(232, 'admin', '42b32e95167f43d0c225677b918ce7030bdb77e388a37584cecd30cf7ac7e082', '1428029581.3422'),
(233, 'admin', '8435b16e04c741ede797bf2a9b1351d14807a8899df77dea88ed1133c0e64974', '1428027507.9858'),
(234, 'admin', '9e29440fcc49a019a3a0492afb375781ff37d15326ada8044afc38eb1741363e', '1428029573.0687'),
(235, 'admin', '3e3683da1425b7e262bea6fae8cd180704908fb7a013e57e3291cd91d1aef310', '1428027954.4884'),
(236, 'admin', 'd70c9b5e02fd09a9870f993b89958e53f2fb9e50da6f71190c49ade7dff6231d', '1428029594.3032'),
(237, 'admin', 'c2cf024c8f489bd53faae509892aa3225d1e6e8a9b82e5f2191b96305822eea6', '1428029588.0407'),
(238, 'admin', '36056d09c92bdc721bb02bcd51ff7627b41920e7fbd629ef4180776f07ce5242', '1428029599.9413'),
(239, 'admin', '24c5f9f35cd61ab16e359991837e1c3c2567de7f34098476bfd3a52acedf8c8e', '1428034553.556'),
(240, 'admin', '30c592a3f509c4a8dd48945e3ca6b3234e64ceadd1e929e02844cabfcfa05968', '1428034553.5671'),
(241, 'admin', '8bdc51f28a8c409fadd1cd5c53afa3e6b5ee0017b39a329a662b7eb7a5265482', '1428034553.5785'),
(242, 'admin', '89381b57c7d54e35382dd0b1f7fe00d417141969f6cc53e353cac163cc81bf4c', '1428028421.2284'),
(243, 'admin', 'ca26be0363ae7e22441ade280d162d48fafa2a3b1ba034b4be90510ed57d4a1c', '1428028672.0231'),
(244, 'admin', '4cf92d8cb002109af87f0d22c371651b0c5d7b9453a5a4d0e72e92fb543907cc', '1428028680.3767'),
(245, 'admin', '8faa9ea3732a2e2963fce8891ab2ee150f5d4c9d2fe134db0ea4c7b322a08d9b', '1428028431.4655'),
(246, 'admin', '722b36e50f8189178f87e56adecc5a03c159c7b3e22856d069ea755492c80926', '1428029610.1268'),
(247, 'admin', '16502ec0090ee27d9a136ceacb6a35b3d3f9dd458a3a43276e059e4dd2a14a38', '1428028662.3243'),
(248, 'admin', 'c0f9d100646c385221fe8921938b7a4472e821bdb7a4b5086576e3ed2244db72', '1428028667.9602'),
(249, 'admin', '44e5f711e1ce2a6533c93c52cbcf5fff244c316753618e2b728f17d9033158e7', '1428029621.9853'),
(250, 'admin', '6ff53b68c9b09eefca1e23add0a0197090fbf6f94e138f7dd76c9f52a5c4f4e2', '1428029631.7654'),
(251, 'admin', 'e0b5d094b60c5905d0a6557a388b9cb8dd1624f55bde3fb4aeca814c3099c3db', '1428029639.2222'),
(252, 'admin', '28f8db47b39047ee939ceb5ee99b6d6cf87b5be14fca1a1ef3c08ae8d52300f8', '1428028692.8276'),
(253, 'admin', '22fa51bb5b86dbaae3902ab004aedf02fb5da32982821dbc2d937a2b3fb6dbdb', '1428029662.6753'),
(254, 'admin', '66ff439dc348b7dd11b1d84eee6d5d50f9e20b4a533b3ed565c60788ab7b1403', '1428029646.7588'),
(255, 'admin', 'e9c9d01a0f0d77a4769f110ff3c63dd78575029e75143d24297080dce2ab130d', '1428028842.2995'),
(256, 'admin', '0c2c3b2488887055eb7e8de7688185440ab0e86e8b94b8ba9ca41ccb16827b02', '1428028847.2431'),
(257, 'admin', '666c521e0f250c8324d59ae8170b187e6d6bcd6c5f9d65b0a88f74966781e161', '1428028852.3632'),
(258, 'admin', 'be8cb3b8204eebc6eef6d5b1699ea871b8010c20effb5d8ce3d2f94c2410ca17', '1428029236.7528'),
(259, 'admin', '983d743341b0bab72b16d1e09f9d5c7676059b73a43eaa134bf34e2eb30707e8', '1428029655.8044'),
(260, 'admin', 'dccb57705c6f1b034db6b7ec06c96ce434efcc090e82a6aa85b0f36bdf604208', '1428029320.6149'),
(261, 'admin', '44fcff34bbd962da919c8527d007fd1f5f0e2cd0f64f7e0d733c640a74172421', '1428029670.5125'),
(262, 'admin', '8da380a664752cf048e058800ea6f0e8508775ee922d0d2c703175207765efc7', '1428029682.9318'),
(263, 'admin', '7b1b60e1c844a111e8e1f47458bc79b017bd40b2e02b57faa19d8372c5e2cbd4', '1428029474.8187'),
(264, 'okstmtcc', '2f907bad503908765690284ff131c6320b0b1ff6fcf262cda602f8e3d9378f8d', '1428069840.7811'),
(265, 'admin', '215e8bc7b32eca982a0db8fa2d46a021d163b24925e1c7e931668d94130da42a', '1428032430.0993'),
(266, 'admin', '57d0281eaaaa03c5c04802ee4a88b3c8fdb75e287d3a96eee016a38c78619217', '1428032430.1014'),
(267, 'admin', 'e493013d410e1133b5d1ce0b297b34ad334007bd28928088413088da7b9480a9', '1428032430.1035'),
(268, 'admin', '768403aea280a1370c1dc474c34c345c816cd23990113aaa958dbb58b9ab5293', '1428032436.8348'),
(269, 'admin', '89244392175cb76097a17e487421045dd64e3542be0147e8a9e0f044938fbc86', '1428032436.8398'),
(270, 'admin', 'e5d9b63a3011d2f4d5b0be6e31db6e033ae8f33c41fa428940f9a0d80d511547', '1428032432.7039'),
(271, 'admin', '0d8b5276aeb93d6872e21b49ca8b109c1d1f499855cb06dabf4ca38cc3e381ea', '1428032439.5986'),
(272, 'okstmtcc', '27322d2486c73f98c863e1212599ebfeb577bcb33c6342df86f88af36ac0295f', '1428069535.1608'),
(273, 'okstmtcc', '182abb2efde1b734814a5f71dcb4d57fa389fac4fa9f7d67d3153e832ed55924', '1428069535.1706'),
(274, 'okstmtcc', 'dd9686f4482737426c71516616aca85f7c6bccf64febb659d80f730d66e826f1', '1428069535.18'),
(275, 'okstmtcc', 'ce7bcfff76e3a4e368458b860a987ae3c9214a7c63d3184396c221354223eded', '1428069535.1892'),
(276, 'okstmtcc', 'fde84b5e2c7981b22c67835ae32ce5314c60b59765a3c4d8ce6aa35e171b8879', '1428069535.1985'),
(277, 'okstmtcc', 'e5030fc410795c9de5eeb69c7cbef8c9922f43588a09c89073505a304560b08e', '1428069535.2489'),
(278, 'okstmtcc', '80a1b33bdc967458f3e8e5ac823f2847ba8b5f34cdf94b6184748010ad0f3f02', '1428069535.2584'),
(279, 'okstmtcc', '2731ea8992e3d625376345aa03dc5c1fb735e277308570cb88493b91bae1f641', '1428069535.268'),
(280, 'okstmtcc', 'd82a919c402c385b3d24dd31013613864cc2b0500c5cce27ee5b6d86b54eff27', '1428069535.2774'),
(281, 'okstmtcc', 'b0e623274d2e36b858cfb1cc0e67f25ca7160f0259e34616a72b9aa504480f27', '1428069535.2866'),
(282, 'okstmtcc', '244c2c8c7a10b021ce5b7e6af20421f97c5a3baf5227320d739242ce3ad9fe6d', '1428069535.2959'),
(283, 'okstmtcc', 'cfbf316af996a9e3526d3dd93b6b60ab6129dc511db04883038a719de7acf8ea', '1428069535.3058'),
(284, 'okstmtcc', '9e29440fcc49a019a3a0492afb375781ff37d15326ada8044afc38eb1741363e', '1428045028.5787'),
(285, 'okstmtcc', 'c2cf024c8f489bd53faae509892aa3225d1e6e8a9b82e5f2191b96305822eea6', '1428045745.7068'),
(286, 'okstmtcc', '36056d09c92bdc721bb02bcd51ff7627b41920e7fbd629ef4180776f07ce5242', '1428045903.4851'),
(287, 'okstmtcc', '24c5f9f35cd61ab16e359991837e1c3c2567de7f34098476bfd3a52acedf8c8e', '1428069535.2137'),
(288, 'okstmtcc', '30c592a3f509c4a8dd48945e3ca6b3234e64ceadd1e929e02844cabfcfa05968', '1428069535.2266'),
(289, 'okstmtcc', '8bdc51f28a8c409fadd1cd5c53afa3e6b5ee0017b39a329a662b7eb7a5265482', '1428069535.2394'),
(290, 'okstmtcc', '722b36e50f8189178f87e56adecc5a03c159c7b3e22856d069ea755492c80926', '1428038013.965'),
(291, 'okstmtcc', '44e5f711e1ce2a6533c93c52cbcf5fff244c316753618e2b728f17d9033158e7', '1428038021.4349'),
(292, 'okstmtcc', '6ff53b68c9b09eefca1e23add0a0197090fbf6f94e138f7dd76c9f52a5c4f4e2', '1428038033.0241'),
(293, 'okstmtcc', 'e0b5d094b60c5905d0a6557a388b9cb8dd1624f55bde3fb4aeca814c3099c3db', '1428038043.2654'),
(294, 'okstmtcc', '66ff439dc348b7dd11b1d84eee6d5d50f9e20b4a533b3ed565c60788ab7b1403', '1428051664.7524'),
(295, 'okstmtcc', '983d743341b0bab72b16d1e09f9d5c7676059b73a43eaa134bf34e2eb30707e8', '1428038063.3417'),
(296, 'okstmtcc', '22fa51bb5b86dbaae3902ab004aedf02fb5da32982821dbc2d937a2b3fb6dbdb', '1428047635.9971'),
(297, 'okstmtcc', '7b1b60e1c844a111e8e1f47458bc79b017bd40b2e02b57faa19d8372c5e2cbd4', '1428047598.1425'),
(298, 'okstmtcc', '8da380a664752cf048e058800ea6f0e8508775ee922d0d2c703175207765efc7', '1428038089.111'),
(299, 'okstmtcc', '44fcff34bbd962da919c8527d007fd1f5f0e2cd0f64f7e0d733c640a74172421', '1428038091.4091'),
(300, 'okstmtcc', 'dccb57705c6f1b034db6b7ec06c96ce434efcc090e82a6aa85b0f36bdf604208', '1428038092.5448'),
(301, 'okstmtcc', '37585bf4a5f5d97d4aec92e2ee8641868294fd21f8fd236124a455a9c6d1d93e', '1428069664.0321'),
(302, 'okstmtcc', '27380c58ba125bc5b93613415c73d1908e8c6d4a39ca8d456d8e9f7108f7a922', '1428068749.9572'),
(303, 'okstmtcc', 'd65d91551c68261ea06a333277dd8242962f6a31ef0e1621c5bcd4069bd29188', '1428038898.588'),
(304, 'okstmtcc', '42b32e95167f43d0c225677b918ce7030bdb77e388a37584cecd30cf7ac7e082', '1428039221.3385'),
(305, 'okstmtcc', 'd70c9b5e02fd09a9870f993b89958e53f2fb9e50da6f71190c49ade7dff6231d', '1428045994.1105'),
(306, 'okstmtcc', 'fbe8e4170cab5d41e8a21c58e84acb0134d28cbf2e9e82dfbe1bcb7354788cc3', '1428069546.4583'),
(307, 'okstmtcc', '6ac8fec95f60364350dc82ba9f351ba5603bd32c54d095244fe986d062a0199d', '1428069539.8999'),
(308, 'okstmtcc', '8b3bec65a1b3af4f2d7e28ee87af72bf767d120f35fa19510236cce53e7add09', '1428069550.9892'),
(309, 'okstmtcc', '2c61cd8cedb2e63503a33e418ead519cb52ca900f3675fc18da9a68d45304612', '1429795213.7354'),
(310, 'okstmtcc', '871189d4f004b4c2417abb9055d50f000ba6967213ada017d43a61cb02a4bd33', '1429795213.8131'),
(311, 'okstmtcc', '3db9c69323592417126df80b9f671063933d177390f5424d50d4a41b45e1dc70', '1429795213.8353'),
(312, 'okstmtcc', '4c57c9f689b07d7a4e0e67217dbdd7b2dc953d5d664e9285fc5f2aa9fd4f1b5e', '1429795213.803'),
(313, 'okstmtcc', 'e289f3274fd242c04763457f6aecc0f3c48a376a027abe052c9bc8ad82ff57de', '1429778606.9203'),
(314, 'okstmtcc', '37a23dc8919f9adc100754370af754b9a147aec1a72c6e0dacf1d58fd069b300', '1429795213.8241'),
(315, 'okstmtcc', '01efe40d8069b99f3468fd332b777a5c1637020ed9d2e4f27ff5972a3ee38317', '1429795213.8458'),
(316, 'okstmtcc', '96ac0216387b99631449424c59bd4545add1d591c1d4c82ba9d8e818f4bc31b8', '1429795213.8762'),
(317, 'okstmtcc', '45d2284d6513421ac794331c3ff982d9ff1d489c36059871bc16580347a3c427', '1429795213.8567'),
(318, 'okstmtcc', '6c6ee123e09c235f82a03695bc65c0831f57e2b729875deb1fc308554336c99a', '1429778721.2387'),
(319, 'okstmtcc', '5c200fb943443cc1b186291b218ac8103559b447a070a4a392448b13c87bdd2e', '1429778705.4241'),
(320, 'okstmtcc', '91cac82091d469dc2a95e37f7cf8d91effda7c7e7be67cb7f25322862d90ec24', '1429795213.8861'),
(321, 'okstmtcc', '6899c7e25252e9088a8181166f428862ff224befb5c4dcbfcc6249b5fae4342d', '1429802403.0757'),
(322, 'okstmtcc', 'b752a12ed71ecb01dae461d4266a4ddd24217444d8b65ec1f07a2a7e9d8d5f4b', '1429778125.057'),
(323, 'okstmtcc', '80223c5dba7867dc8cba63418ea3485b400aa6541ecae7a4ee2d1338e14aa3b1', '1429778142.3542'),
(324, 'okstmtcc', 'b5a1acaf7681a6e87216b6dafd841f1edd178fc28d787723bb9a21ff6fb114ec', '1429778128.9375'),
(325, 'okstmtcc', '46efe39c2c1acdaaed46c69513362eae3db378db17c1182eb58b701214f3f370', '1429782387.4327'),
(326, 'okstmtcc', 'cc857a7d5f8903bf500eecba429e5e7749323d7fe1c1023acd49f9d4296e9a8a', '1429795288.2427'),
(327, 'okstmtcc', '250fa0b83728796068833d1c923006200febbbbb66452a7736d54b061ed0f38d', '1429778525.6031'),
(328, 'okstmtcc', 'a1e297f51e3b93e594d681b4f87af0607857c24db2baa1915e391f74ce856108', '1429786330.5394'),
(329, 'okstmtcc', 'ee8a086c7228cb8d3ef71cef083c6cd3d0ded5a24695f24f70ba743395137a78', '1429788198.4295'),
(330, 'okstmtcc', '323fa9d88700363780023114455fad438c33a105f6ea721c919155541f76a7b3', '1429778565.4529'),
(331, 'okstmtcc', '9b585d7de55ca2c07c9962c40436eafdad99082e034eb7b7fc03349b52609b23', '1429785737.8128'),
(332, 'okstmtcc', 'ff535d990ba3921dea58428712559761ebc8db133a6c3bcd69ff02404261ece2', '1429778636.0175'),
(333, 'okstmtcc', '7bec3db55b8b705e8d07b49a39dbe7390fbf0a68071b339e52f110bb4d9c3c7a', '1429778636.0318'),
(334, 'okstmtcc', '9b0ce49981ac75440cfcbcfb8a8fe9b360f224ee32c2954442b124167a3de4ee', '1429778636.0464'),
(335, 'okstmtcc', 'd19d7c8c3c892d9c29a875f016f32a801ed3604de6084635796c445ee3f21d8b', '1429778646.576'),
(336, 'okstmtcc', '09d22c3791b4ce6463906599e36e368c6343074dcf95bd14a4a5b7da239695f5', '1429778669.9243'),
(337, 'okstmtcc', '1094cca7be2299c67bab743c0aa4acb6d40df9fc1f03f6fa86e48e5c2701bb6c', '1429790471.6125'),
(338, 'okstmtcc', '28edd04ca07d133ab32dbe7add848fa028a2762ead76146b8303aaa641192323', '1429795213.8663'),
(339, 'okstmtcc', 'c7c4c1fb2a3a599776829e733d951de189ecded006e9fca6d2c2656f80a659e1', '1429778726.2149'),
(340, 'okstmtcc', '38e2db054d9fc7ee6d51b57708852887f9caebce144cc5d849606ea53aa68d7f', '1429778746.277'),
(341, 'okstmtcc', '2dff4a18e51154f20c8b9461d3a515ca19e022370a10253a8cc82910cc3990ca', '1429802350.8124'),
(342, 'okstmtcc', 'cf20a06de898fced9753755e518e9676245c2c22bfc385c26e3b6cfaec516ed4', '1429802316.409'),
(343, 'okstmtcc', '5c8603dd9cb264abdb9d01e73233e3094228fc2e2d80029affcde17c75102803', '1429800404.2821'),
(344, 'okstmtcc', 'a1398f4209669cdba33b87e4fb5531220615f4ea7d7618eb3a0b5ba2283d54c8', '1429795146.1345'),
(345, 'okstmtcc', '22fc141c05ed5aa79154072ca9abdc814255be65fb36c8a2d971cdc5dae123f0', '1429795189.8797'),
(346, 'okstmtcc', '560db8516b8451ecb855b2ab7b3c948b7387fcb651d9fbd6adffdf96d986e8ab', '1429795213.7509'),
(347, 'okstmtcc', 'a735b2edc656c92cd39e0d8c7df9454c5f989187a0e8cd20e453ef67fa30989e', '1429795213.7655'),
(348, 'okstmtcc', 'c92e32b53a1768c6b86153914dc631d67346ac87b3233359fb4dd7d6f2ff1b4f', '1429795213.7801'),
(349, 'okstmtcc', '8e9b7d550d40172f096b841d298c6152f906cca66aaa2c1080477904e985ef4b', '1429795213.7935'),
(350, 'okstmtcc', 'd9a59bd64067ec038d265dab133904bb9adaf867a841e5870b743c46f1de7c15', '1429801038.0935'),
(351, 'okstmtcc', 'fc0720b9f1fe75f379171a6a21cebef488b73f9cbcc2126b945b7d05fecf4495', '1429801038.0982'),
(352, 'okstmtcc', '7909bdaaec4ebae1a22750b54401f72d89521c657ef080033a2f7dc67c3140c9', '1429801038.1027'),
(353, 'okstmtcc', 'b28a6f192c49157ae900a727e7e544536f8d0f06e39d6671c2fe01cfad905ff2', '1429801038.1072'),
(354, 'okstmtcc', '93463542b14152ff996ce6b4c8eef2b7297e8b98cb6b3e6c356d74686abf64f9', '1429791204.8991'),
(355, 'okstmtcc', '2bc6ff8fafaf13e2bb6d967ebffa01fec3ff9db7eb9c060a400f8419d7fefbdb', '1429801038.1117'),
(356, 'okstmtcc', 'fd83a0432e04c8ac5b350aa7085078fba6a3f3ad4d1bfaa504a1dd4ec0c5b764', '1429801038.1164'),
(357, 'okstmtcc', '0d49b8263076ad391fe52ae66ae13ba3bb7e9853c9ec3bd93b2366bc9249993a', '1429801038.1213'),
(358, 'okstmtcc', '309d5b32287b49e72ada70b73672e0837bdeae1900d59a6528c1a13c3be88f78', '1429801038.1263'),
(359, 'okstmtcc', '5684a62a4e3d0ca9789a3bf0c004ff289af9b8a2a0e859fa1bfd8a0f4a131c9e', '1429801038.1311'),
(360, 'okstmtcc', 'ad19fd658034d0458539e6095513dc9266ae156d79e1db8f0675e6e19051ed39', '1429801038.1363'),
(361, 'okstmtcc', 'ad7a8be33024998335e25c386eb03ba0b382e7240bf0260ed7322a00b0f38d63', '1429801038.141'),
(362, 'okstmtcc', '748bf6663fa6c6f0ccb7c83aaae82dfa17dd151fdb5ee021543fffe9ab2a3c92', '1429801038.1457'),
(363, 'okstmtcc', '4a8a52c5a7ffb40eaf74dd522252b3af01465d8f8044af2dbb16540d256c3c14', '1429801038.1513'),
(364, 'okstmtcc', '768c2dd11806229dc4962325ad49adaeb5288758d54ee4492a6758c6cf797bcd', '1429801038.1569'),
(365, 'okstmtcc', 'b480530e9288657ffea43cd4d28218fcb82d509db924161fb434d7160ea8b32b', '1429795201.6566'),
(366, 'okstmtcc', 'c1976b8e571ee2c716d43cdb9a21efc356c0538ac1b723e9aaa350e7b8b7ee0e', '1429795204.0976'),
(367, 'okstmtcc', '5def47bf2f42f46cb29cb2ca8002dd5726327abec81566601d6dac5dd1a8401c', '1429795209.9392'),
(368, 'okstmtcc', '2bae1c9364a3391508079ce4b955d31d9c168a52cdf78cccfa03bd2141e2608b', '1429802402.1596'),
(369, 'okstmtcc', 'de358da483e8d7df95c576c43a8469ca70ae39ce15014a641172f0982c990365', '1429802402.1665'),
(370, 'okstmtcc', '39bb1986c31690bb4b223629100df7e4e420bb001e67131d14696456120a7e0a', '1429802402.1732'),
(371, 'okstmtcc', 'eb265f90e7ac212a7379e79749fce5a17f8c5a59a7fda0eb0dbbf78596dd5122', '1429802402.1799'),
(372, 'okstmtcc', '26b6c5df628d2b3b62034838a1bf96e5193354b6df03e3e53de3a3c591afd555', '1429802141.3239'),
(373, 'okstmtcc', 'c750ecad7922e02378dbf35e0dd4e7fd8bcb65fb1adba4f17294f9e06a588de7', '1429798705.5987'),
(374, 'okstmtcc', '12f03ca2d2d17e08ac8b4d779b27d02c11eec3f757705b1db9e47ee8bfe29154', '1429799956.7143'),
(375, 'okstmtcc', '6529b11e75a6f783f8b9556ac72f91d0898b5f24fa353a346bd51dd5b238981d', '1429800049.6288'),
(376, 'okstmtcc', '131d4a56ca101c6e2ca52bf274bc988b6c8c7eda1863617e05f5b3cef21ee627', '1429800003.9733'),
(377, 'okstmtcc', 'b8d06b318da57edac0eb5e3fdec17f2ce9adf87de1bf12bc2e28a58d2789bfe6', '1429800751.8321'),
(378, 'okstmtcc', '3f24960b73eb508184f199dce0e6e3bf0b48b9df02c0ee29869011ea9d66cc51', '1429800729.2308'),
(379, 'admin', 'fba886b40a241c7500d8813232d34acbaf09a4e8670cc981cd290e2bb985f080', '1438177849.0163'),
(380, 'admin', 'c55dcc980cc362c43c233c3c966cec60f49fe0bac401021e5cb707ecbe2d2be1', '1438177849.0199'),
(381, 'admin', '7f616f54bc220cb58c83d96a752a244d32805071e2ec6e4cdce87d12ab83a945', '1438177849.0231'),
(382, 'admin', '2d05ad3d3a91af1987c6ceba34c9d7d4557a3916671bcebdab170f2d6f02cd2c', '1438177849.0263'),
(383, 'admin', 'f853cc75b996ca3e70b95360f632b3a4ca6d1138fa74965cc4cd201dd12b0246', '1438177849.0295'),
(384, 'admin', 'b98e1f4fa2fdbf21bd704aa75168435542d0d02b3376b32fe011bd321c7aa839', '1438177849.0327'),
(385, 'admin', 'cd8f9a575d64d8aede802a339353517b6f2587db7617e541f215004a53a179ca', '1438177849.0359'),
(386, 'admin', '76eb5706b55b8d69678ec089ead6cfb332adac73cf43f87a19fb40f80f4079a4', '1438177849.0391'),
(387, 'admin', '518136e4add7d10cbd1762aa9436125c944b653fc30af5191f0cbeec09634627', '1438177849.0422'),
(388, 'admin', 'c0c14b8e4efa5192795f348c90cd89e60b85207bfea96754ca6e8ae5f6ac2446', '1438177849.0454'),
(389, 'admin', '8d729c3838af8085d1f13bc4a0e54057305d4c139a417c229ab87ddca71ccf52', '1438178079.6118'),
(390, 'admin', 'f6f5643b5cd0bba3b4fe55beec4f1504e6775e7c6d3ad7ec0931465a5c133349', '1430054809.1514'),
(391, 'admin', 'dd641dceb6505568984c1a7a6612c584e8e1d6bd69f7e77934466de2f778c66c', '1430054811.8189'),
(392, 'admin', '4c571985c6b7fb48e4056a706ac0f7f85e809f6f503a94c76836f6238e24db96', '1430054814.4476'),
(393, 'admin', '7ef3223bb190403dfa2247c1678264651bd8c1e1ed6ddf24f7c90c5422ff8c2e', '1430054816.4651'),
(394, 'admin', '584a8032a2fb2b36ffd086893ca0d1b3092068bfd5afb46e5f678b5b5a28ce0c', '1429846004.3375'),
(395, 'admin', '48bce589a0271c72f6f8ed7eb7339cd05452d813fe0a74b415cef425b79b62bc', '1436776333.3912'),
(396, 'admin', '37bdabb43f8d33a44bbe670b9d653193fc51579c0037ce128d441928216fd61e', '1430405534.8581'),
(397, 'admin', '9b57bf935098ca0922f3fc4941471c5956027739a1803d60b3ee62b415a5d40c', '1430311367.1899'),
(398, 'admin', '4ab8d3e91d457b806c101439b6bdb306c4977e2239baf8ab7646731e64231482', '1429805421.1733'),
(399, 'admin', '3d0837674275e948e67cb9c6bcae77a571dd064793bacf31c4e8da3cbdb7afaf', '1436852293.9975'),
(400, 'admin', '7dff4d3cfb1780d04d5c4ceb4bf6c2c7c9f86238643d7cf91ebcf3408b905d5b', '1430406229.1605'),
(401, 'admin', '2b1e625db2ed18693156aa61dc41effdd497fbe31f7fc1921eb0dc9643ffef9f', '1430406229.1764'),
(402, 'admin', 'a5b8ad9a0c2e996382f8e6848f01548d5468d29f8d91a2666cee63d46f08259c', '1430406229.1832'),
(403, 'admin', '84bebe8a4abe58ee12a86c00599ec5855efd2d8d0ed022e3250fd1d10db9b332', '1430406229.1987'),
(404, 'admin', '67473dae943324fad555649113a82d2f14a6a97ecb526808f61ae2d29a10e49b', '1429845908.1775'),
(405, 'admin', 'c11412fcf145491891667d79c0faa2aac47eb90d06acc17517ace166412c1ba2', '1429845717.8018'),
(406, 'admin', '92942034004ed86ada0b4cbbd44b501f875073509dcbb2488e68d15aa4b9fcdb', '1429845933.0231'),
(407, 'admin', 'e34fc7831a83f76b93ba5fca642e843822de2718528f1db856cd1494cfc57260', '1429845952.2605'),
(408, 'admin', '459dd093e72438731b102073d2929161aeb18803ac4c85f76e852a1c440027c3', '1430210899.4485'),
(409, 'admin', '921e64d409bdd010d8807603a6f5ccb6ea393c97f3cf98f728fb55107f78fd5e', '1430055557.1283'),
(410, 'admin', 'a5d7ef2f674569b22d773f7bbb623fa9b9ecec4ed52a5aed1adf043812a4af63', '1430318132.2715'),
(411, 'admin', '96a837842b3cab306880f35f22f0241d2204f43f09c1b7f2e5dacb4b58f243ec', '1430053665.6824'),
(412, 'admin', 'abcab034fca19ee243f00ecefa0302201e725693a5e94ea3c648142dc6008920', '1430401033.6592'),
(413, 'admin', '3a133e3bcc8f947e0e0654a868c220dd97551a354bb9d5a485eb596b383c20df', '1430402088.7644'),
(414, 'admin', '55349fc2e32d391be21f14b61d61d44237271728b3ea27f409d5567cce9e9849', '1430205445.0794'),
(415, 'admin', 'a2a834d4e21d3308763c2c098484690678d6260c88d8be93b369880a128bb5f4', '1430053887.3066'),
(416, 'admin', 'cd27bcdf9a8bfe783c68c4a871baa2c51ff4a333c616ac49861b4985cad23b81', '1430205549.1404'),
(417, 'admin', 'd8338943c4a75fd3623c8e903284ba925af4bdaccd8c427ad750234fe5d362fb', '1430406229.283'),
(418, 'admin', '2230d79ac149887bc0fa1378982229fac536dbe312a2fb4086eeae722fe8e86a', '1430053828.8455'),
(419, 'admin', '5a7a723e3c81630d2bc94b9720770b28d7e4b4c301f0b8c642e5a9eb6bd993cc', '1430406229.3615'),
(420, 'admin', '3179e5797a1249d73d36e308d28740701073bc2d3fcfdba033b06d5b985118b4', '1430053878.5557'),
(421, 'admin', '1e3c5ee16b991caf1b0531af6e31d8054d13a87b3aeb9f3436e268be8d0b573f', '1430406229.4247'),
(422, 'admin', '148daba16c99f3347f28ebe4ed005efe6462a353d2e46442c7fba95e36f6ce49', '1430406256.6242'),
(423, 'admin', '6a70f6d1b59775fcfff0c21e44084539d9f0a7822d52eb9c14f0c3c156d0487e', '1430406229.4518'),
(424, 'admin', '2d4b2bba256d229164b6934f6793f7b1352cc8136f061b68d7aabb15ea0aaf11', '1430207373.9709'),
(425, 'admin', '91d8f3fcf1939b386fa3e5c0360cb4686f22a11e73e2f4f726f615048f0399d1', '1430055476.6801'),
(426, 'admin', '5c75e51a81685cc9165000c97c8e2e73dd57681211b3ae3dfe7ebe0f9d73c78a', '1438157974.7475'),
(427, 'admin', 'be5c9bdc3a84f4fd16d3a9080ba5e39e851d9fa5cc5260de5ff1ea5d9bfc78eb', '1438157973.1449'),
(428, 'admin', '5b35bee0f8fb15b4617c0bbc6443965f8233740ae68b7583cff2814cbfbac20c', '1438157973.1502'),
(429, 'admin', 'f6d915c9f3f2f02ee926e763d07e8e6b0e0b98a50e2c24a700f20394a8bc04d1', '1438157973.1555'),
(430, 'admin', '707da999151e5a13158aea84e21316847b855cff4457e2d2bf7e18e133df5ad8', '1438157975.4293'),
(431, 'admin', '295dadfd9eb5c08020750600c19feca94bcfa8d331f69d17285574f61550d824', '1430055904.0886'),
(432, 'admin', 'a65eb78d5d1dd3a2ba9bf04f9961d25d1fd14b0fccfe3cdb528a949ae7994354', '1438177852.3465'),
(433, 'admin', '4daebee576e29301cde864b58d8ace9647ea0f8e2a686fa19ad508fe23b3ecc7', '1430116902.2642'),
(434, 'admin', '6cb0564737cef0bcf1385b00b250aeb24ef4442f482e20444f76d740431f0af0', '1430116882.3111'),
(435, 'admin', 'a3c91f14f205d61367f7db1e264f51d7b9ae5e2851482ae45e3f91aad76273d3', '1438157922.2195'),
(436, 'admin', '2f241e744a889a5d7381882e9ff74d26d9635870d93690609e9c7c5d483a2a51', '1438159237.4759'),
(437, 'admin', '1a154bf0d959cdaa0dfb4c25b6cad003b95ed86a460b374833c57486a249c495', '1430116895.4133'),
(438, 'admin', '73c9458a50ac5dd66ce80c0bde8cc360cdc053f550787c0ea86acacce147906c', '1430081660.3003'),
(439, 'admin', 'f4a897d8b63be41fdf6a201c9be85dd2fb6f998baab36e18f8773657adb742b3', '1430308933.9665'),
(440, 'admin', 'c12af6e1976d8364d9c346e36a1b592580ce3d627cb38daf6c91e5da079901d5', '1430309109.7582'),
(441, 'admin', '9189a2d9805f44fe23f5a0f0c99263ce4ce47de62d93ed6fb4173f14e39933d5', '1436775833.5966'),
(442, 'admin', '99f0906a43579e88d701ee8872694de4afb6b0ce0fbdd7ca4e314439f3f7f21a', '1436775833.5991'),
(443, 'admin', '6415ffe65b88b434211452bf33e8b38c438fb99a3087b9f9770b8cd28c6eb4e1', '1436775833.6017'),
(444, 'admin', '848ea968e5b524e09ffb319883d07fbbff59aee97b3bd71c39dd6e2896bfba48', '1436775833.6038'),
(445, 'admin', '75f54174e4d158c2d1cd86727c19a1ecbaca75bce27a0a2f4ea1524634b2b5db', '1436775833.6056'),
(446, 'admin', '28d5d404853945040e0e13d5a2da325a68d8c585176519d20c5e4c48374a578f', '1436775833.6073'),
(447, 'admin', '031b25d94befcd00b2b5cee23c870479731b52c29bdbd4722060d4bbd20daaf9', '1436775833.6126'),
(448, 'admin', 'fef3b858060cb8512ab6b79294b9407e4b85096bc988b34f5ff4940ee5a925d5', '1436775833.6186'),
(449, 'admin', '4177fde9a701e54f4425a8d6aabac66291ad2b33e21a65d2f825e6d719551dd7', '1436775833.6203'),
(450, 'admin', '596d5bf55ccffa1ae08f190f534b6f40ac05ffbfe046c7fa2eb265e720081565', '1436775844.4763'),
(451, 'admin', '298f6e6cc47e8277a311a51eacda6046b7f99a4aac9b052ea0c4735340e5be72', '1436775844.4782'),
(452, 'admin', '7119b5f75439fbcdc5c26c8e1f117dfd2266a1e919f5779f32b3cbeca41cd9e2', '1436775844.4802'),
(453, 'admin', '2bb6dd3f2d92578cd5832f47ac96e4033ee751b429edd80e04ea912eb460792f', '1436775844.4821'),
(454, 'admin', '0bafeaa373bce6ad4367d75c37fc7ab08e3b8757ffd4cfe9215b84c2401fe862', '1436775844.484'),
(455, 'admin', '69966e2c25adcce004668d79630d639e01c92ef46e14ab90384063362adbf9f6', '1436775833.6091'),
(456, 'admin', 'af60436bd1af14cf23b6d08fb4c9fe30c1ddbee34bfedd624d6cfec8b4afe1cf', '1430308871.0828'),
(457, 'admin', '765db7a413d0be21eb8064a2d55b5eeffba1709bf4c343cbcf1eb6987f577f25', '1436775833.6108'),
(458, 'admin', '901527b9185c3f6dbe09fb1e620beac1503b6666883d8bd476dc45ab08b492c0', '1430309092.1225'),
(459, 'admin', '35adc14d9fd19799977bdbfdf5f5892ca5c0953afeffe1ffdd1669f5006417e2', '1430311408.8678'),
(460, 'admin', '40c68663d32b6fa2c3ad2be8f3f3f6b91c066eea8eea6a5745869907a08f00d4', '1430391286.5333'),
(461, 'admin', 'fbd44943389e7fda7acff99d753a6cb6841bdf83fe40c5b6eae188d2ef0fb19f', '1436775844.462'),
(462, 'admin', '5d153c40e7fbd688fc7813e20d9b385f8bc16b40a150956e684d3b0dae940d40', '1436775844.4642'),
(463, 'admin', '17a44b4efc317a582b591e347815f6b3a678d7bad0875dccad1c8f1428a30f80', '1436775844.4661'),
(464, 'admin', '4c1b891f70b4499a5ebb8abc02ef6157ac49dfcd116d97526fdad6835672625a', '1436775844.4702'),
(465, 'admin', '8b5eb2823eec8a0ff790b46db9da889c5b376921628ae37529a060068ec106e5', '1436775844.4723'),
(466, 'admin', 'f18cc35e2a592bb4b15a62bb6d3a871c14f0aa134a30fa1e4a93d5f349f0a858', '1436775844.4743'),
(467, 'admin', 'ac160e8c59cc3a794ed014882d94ca4842e07e5da9a9f7d19379423a0c39ca06', '1436775844.4681'),
(468, 'admin', 'd762b823e6fa158b4e1467e8dc5adbf3fad0537ce40e2a80d40075ed96d5468a', '1436852518.03'),
(469, 'admin', '66ca792c1984208b0df17cd63bb10336b3a609899ee0b66da72fc7900c077cbb', '1436852551.3403'),
(470, 'admin', '1e156d0b997217158d398630ce6d0ced63b7d66b18356ae1edc74e3bf6897e33', '1436852569.2765'),
(471, 'admin', '34e0f91bd551ad4880dac66b67c8fabbc7243bcac1f8303db4bed43180a591af', '1436852610.6424'),
(472, 'admin', '368be21ec164a82843b69aaa2d6581a79d0fda11eae3caf5dacd3b4e6ec77bd1', '1438157806.3046'),
(473, 'admin', 'a27b96e8cf7d7ee2d8e8c83a2afc01747d18cca041bd191740bf1fd7ac8cb67d', '1436852678.0319'),
(474, 'admin', 'e4e34a3044b2fdbbc88107f46eaa4e1f924f7d08f33624bed84a6a36f88d00db', '1436852693.8227'),
(475, 'admin', '0668168d3694f1d043ee34a4e3b1065040a49742946a3e195826351674274635', '1436852744.5036'),
(476, 'admin', '0da368f9d5dc293661a05d12d094e297f5cd67f95a5fdc56c3630ecf1d2b1ca9', '1438178079.5846'),
(477, 'admin', '1441a2d1282901f2348cc82b14c52eb687de40ffd002a58adfc62d998ccde852', '1438177852.3443'),
(478, 'admin', 'f4f4c4db66cab4608a874da400a1f7ab1771a5850ed6ae26f8d08026d3e60946', '1444141416.6915'),
(479, 'admin', 'c9329a122b7e449dfcc9c851c65b07d7e3d428004a4f5169c7bf3b136a55a857', '1444141416.6879'),
(480, 'admin', '3dff313dff158e6aee2f88f2495c4649a448030c29d854a12c69ab5fe9af44f2', '1444141416.695'),
(481, 'admin', 'bc998c0a804488435a2228c3774986c087f7a4392fe92d61329cc4f4b997534f', '1444141416.6984'),
(482, 'admin', '98b8071bd09e3d60d9fae30471d6664ba0d510eb2268c3e6604483adaa30607d', '1444141416.7017'),
(483, 'admin', '61fd7cf1232749766fddc94d57f1f046385fadf3981c5dc6d1f9d7f7f6e60ee7', '1444141416.7121'),
(484, 'admin', 'ce72d0db8b72e8fe89db882bbee58ec4a8070673e37ab74d9223d3ba7e7761c0', '1444141416.7153'),
(485, 'admin', '23a6a18fb6aa2a6254cb538884ba5036da7a66915df6eb2cf971538259f90ef0', '1444141416.705'),
(486, 'admin', '9b499a1e5d9e5895a436f5d3a87ec070772da75ac92e6ce2103fb1c2537f1700', '1444141416.7219'),
(487, 'admin', 'e173368b45c3eebd029faf412e7ffcf70d59d0a2f091377138f1721c78e59aab', '1444141416.7088'),
(488, 'admin', '172371c8755eb4a077ec9f31347141dee7c5d230eeaa6307b4cc5586d5c54c80', '1444141416.7311'),
(489, 'admin', '17e9620233aac553a8a80b3eae9eecabe008539e1858407a08a05b328fad66b9', '1444141410.2031'),
(490, 'admin', '9bad48147544dc75d7c7b3b1d0bbb139063ce9cd13a3d3d6c229aa8f45da6ac7', '1441648402.0706'),
(491, 'admin', '02fc3a183dcb0791461e511cc8e97b37c7ca223d6ecfc597b7f8013e02a6bf2d', '1441648400.8916');
INSERT INTO `wolf_secure_token` (`id`, `username`, `url`, `time`) VALUES
(492, 'admin', '5527267c1ab75b86affb40e61f490950399e081d79b730b1d49a4af1e66d2547', '1442212202.9046'),
(493, 'admin', '49154943a578e7446b860b4222dce6800c61f61d78d47c87af5c19c45004b733', '1442400495.4473'),
(494, 'admin', '9bc8b0c50a8360f089427592e01b19746762067967bd37de95e681bb9a2ac688', '1442212207.3801'),
(495, 'admin', 'cb87a21be609f20d19692c6697fcbd266f1390b43b2a560039a2b5fdd457de96', '1443765221.805'),
(496, 'admin', '9823592370af7df431f4f275ca52acd475d20bd42e87f60e71e08e8d53cf8bc2', '1441647816.1887'),
(497, 'admin', 'f56b8ac75076397d09046bb25edad2f18b5b16909433610ca14128db1611e0ac', '1444137330.1929'),
(498, 'admin', 'af2343889b1e66b3374ef6efd17db2065f8fb3410f952b09d14ac90c5ea72e7a', '1441825793.2393'),
(499, 'admin', '5f5bc33be86a377a509d4042db91e6f185bf87ea3e3dbe67fd2fec0e11087bd7', '1441825767.9517'),
(500, 'admin', '65ed34b20acd8a1b420017781f233ecea8101b74adf164b6c1d79bf5ff170800', '1441825831.7212'),
(501, 'admin', '8d321f32d67d80fffe14109d555ce0c3bc683055d0c5ca7e5d807779a9ca4a15', '1442212234.7067'),
(502, 'admin', '0bfc01fd84c2074914a5ba84cd51a6739cbfb8138f4f57b9cfe8a01de55c7bec', '1441356893.1242'),
(503, 'admin', 'e24558ccfd085a2b6b57646548a0a40f652a2d3ae897bfba31924619b064df5d', '1444141416.7257'),
(504, 'admin', '9f6224297c7ea9ef471e85f5a972aee3f5969381d2ec43d2d1be029499d66952', '1444141416.7185'),
(505, 'admin', 'a6bb404479b68c0ca839f0296f4fcee4937fe659717bfb8920887376b86c8966', '1444141416.7291'),
(506, 'admin', '67e32d420f08a64ed6809b46ecc984d904cead4468ea0170fbb3b687165aead2', '1441820078.0001'),
(507, 'admin', '110bd40c5e383672ad9de046b319efb0c520df75c3cd6d5d49eb98b90edb979f', '1441820078.0074'),
(508, 'admin', '6e99cebf0155601f77faba25c0b2da25d3d3860e5fca7a6ac24f9d793dc204b2', '1441820078.0207'),
(509, 'admin', '55e290dc9cf3508acd4f3a60714dd30904e6736c7de6861a0991bc82ed70e470', '1441820078.0257'),
(510, 'admin', '2bbfe46b207044f4da943c0629c73f619f32a7f4862db0ff2da51f054bba088c', '1441820078.0352'),
(511, 'admin', 'fa3a6885079dbfaff8acca9baf6289a135bd29305016c357aa6b58c0ca89b89b', '1441820078.0403'),
(512, 'admin', '837918f736c605c0bc937a5828e59bad90f38e6b2fb14dca7c0ecab8f46d8377', '1441807854.5903'),
(513, 'admin', '0808844baab3e49032fc3b1dfb428b82d368aff23e22f3cf6f5dc1ff9a52f8a9', '1441820078.0448'),
(514, 'admin', '58cdb33569ed211e7c32f0f964e91467c66bb2831bb24368432c0ffb4629aec8', '1441820078.0497'),
(515, 'admin', 'dd07ba3e14aee2953e01e89ce3874c2d1cb25e44d9599135b7e11e7fafd297f7', '1441820078.0547'),
(516, 'admin', '5a99845ce7ed0d4035841b0871d5c4a6b154d8c935f639ca5247bc76325163a2', '1441820078.0591'),
(517, 'admin', 'b58f27dc879ca7f242fede373390d7354614ef293369feb184a26aa44312a116', '1441820078.0636'),
(518, 'admin', '5cc72e857ee9bf7d45628666814a2771f1f56dd8e6770c437bcf6db3288fe362', '1441820078.0693'),
(519, 'admin', 'f8b13758a246280ac83af1509690c0703311459e950813e638655e32a21d43c5', '1441820078.0748'),
(520, 'admin', '1baa86a1d6c61445db977c6a21fd14b1b40745b3bee01efc6f0ec5e335f191f0', '1443757714.416'),
(521, 'admin', '432db5ac11aa89ee608b13fe5e87264e76a578f8db6ab4fa5d8f7973c4e530a5', '1443758366.3838'),
(522, 'admin', '2eaabcc5c19e89b39b70af8ee975bba95a0ff9e48e7e2a1fa1a5d1f20acd6732', '1441362068.3935'),
(523, 'admin', '7894defb599f68598f660880c434c24788a2b7ae6b0c6121327015d4f404807c', '1441872819.8594'),
(524, 'admin', 'aaa102c0e9ec09617f1e81c79977fa1909ddf67b96b572f950604ff45e300686', '1441872819.8665'),
(525, 'admin', 'de5fc4fefcdeddc323aca9d0585a4e00d0ff8d67b0a3d7f7eab25c8af0923339', '1441825787.7872'),
(526, 'admin', '85c404ac5788182167365d932c385a0a9d94162cedaf715eb50b1d7f2a4c8fce', '1441825797.3802'),
(527, 'admin', '98fcf22efa667ec745fe41a853cd147f1c9bb1c54cc1828bc14dbf3f6c19f12e', '1441825854.2167'),
(528, 'admin', '8910011a07bf102094d4721e61ca8914e7cc0a115f1cc63cbebc054391ff4992', '1441713797.1081'),
(529, 'admin', 'f86ba817248e8d0aac0fa0a4a31a1dc93e4912fe762397dc14a8f7b9f78bcb01', '1441713797.1167'),
(530, 'admin', '2fb7cfa30801b6f0e5f3338d6b18dc1a78ebd47a800730c72928c4adf258759d', '1441713797.1307'),
(531, 'admin', '007f73e74fe477f3f16d3e5d9a8daeea25700a60c25a7135bbc95ad2393dcc35', '1441713797.1414'),
(532, 'admin', 'b28bc791b6755ed7b1062449f11d3bf44b9cb51b625aa482a4b9742d5c0e4c27', '1441713797.1473'),
(533, 'admin', 'c1243fcef40cd527d299f3fddc8f4352c84edf004ae7938434e79157ebf17b92', '1441713797.1543'),
(534, 'admin', '988ae82a3b3277ff1f23e1728bf17fe9e8a84f46c89eba79de631424a54405e5', '1441713797.1601'),
(535, 'admin', 'dd0e38ce42d44efec41f0240e1cc44e560d420f6278fec11302febfc760741e2', '1441713797.1661'),
(536, 'admin', 'f7dae8627dbcc116f79dcd1711633d63ec14fc0812740e8ba518883debb634e8', '1441872776.8139'),
(537, 'admin', '3cb142f6930780c706730f85283c315a57f9bd487276409f432348b8f870dcbb', '1441647410.8801'),
(538, 'admin', '43ca52ced8f5bf5fe0b3edeef63ce0ff38698a5bfe3f99018123aee1552a6074', '1441647414.6684'),
(539, 'admin', '38372f9aa8cae4bfb00eb81ae19267738bd6149338197bc551d58f5b47d918b5', '1441647417.9979'),
(540, 'admin', '159b19b7b4c37b82531c1509ff375a6db7f6932be74c619fad7d7f7f950bf326', '1441816913.2902'),
(541, 'admin', '6af0ce3a766f8fbc93ccc78d67d8cbdbdfee35da8adc226f127419c3470dd83a', '1441712772.2959'),
(542, 'admin', 'b72a2beadd6047f03064a43abe0cb3263153de58e5a76a7fb158c59354f1b42b', '1441712772.306'),
(543, 'admin', '8b1447dfdd419bae8c6195a7a416a4d450c979db605a9648f8e1cfc054bb5013', '1441712772.3162'),
(544, 'admin', 'badefedcefb9966d1aba5a05e03c44f5decadd8204075027f907465fd98ce6a8', '1441712772.3263'),
(545, 'admin', '78474b210b88b5752cf95bc991211e4e7ea89e4d41bbad64faa6cc3a41a5dd8d', '1441712772.3388'),
(546, 'admin', '9cd4841975a5e2097c2b5636836ca6eb243ca2c21163f01400347015ed1f4b9f', '1441712772.3482'),
(547, 'admin', 'ed30d9830a834fb28d4d6d0c57dc87b7befe7629b4dca7dc8575972fe8826468', '1441712772.3596'),
(548, 'admin', '956abc5f5c63aa92a65f32dd4a4640d84dba33c552bf31b6b10058aeb6fc610d', '1441963262.5641'),
(549, 'admin', 'c72fee77a033ce73a546cf1470a7da454c10e811deca59c1a52aaaa641ef53f3', '1441713023.1713'),
(550, 'admin', '2a181fb5d4804f6639f3dc1ad2eaf44274054e5aa91fcd90ba4a7cc3caef03dd', '1441712933.2157'),
(551, 'admin', '1326d4ffc2eccae687d857ec82f1cde91e6737633d8570071433345dcb0128de', '1441712938.8553'),
(552, 'admin', '481b4f2dc7ba16c6676512736ac13385fc0991ca3d85cafa6c070006e97a7204', '1441963262.5162'),
(553, 'admin', 'fa6c8e90cc1ba0171e57e38604aa5344ebfa8abf1ecf1d2bf3374b2d7f0289a4', '1441963262.5382'),
(554, 'admin', 'cd824e2cbf3e429cedf49deeb09fa89aeca9bb66f6c81243aa36adc4c30e559f', '1441963262.5444'),
(555, 'admin', 'b3d1c8008f3be61be107f6cb7557d1b9109ff98a879a4d9c3c9f523a9d806d43', '1441963262.5509'),
(556, 'admin', '7039e3d875c34a8a24c24c85168bd144e9e32c569681d78f60007ab157b499ae', '1441963262.5578'),
(557, 'admin', '4809206e3e9173d55f5c3fd262809da5e2b9f711213948fe9b0cd06391bb5c11', '1441963314.6609'),
(558, 'admin', '4ec957e6f77d62aed3720f30575f23e91197e481901911951f7f06d4cba2ab71', '1441713135.9536'),
(559, 'admin', '88e8421b6c02ae0d4b3224e152f4439899551508fb10abc24a09eb396eab11dd', '1441713149.0957'),
(560, 'admin', '3e9088535ccf9de831b55d5384e150c594ad0e28170767c33052494db5827577', '1441713160.8546'),
(561, 'admin', '5d143b01b166064abc168bc5f9542b8a890e5211b1b0770f186ed8075e0b97c0', '1441713174.7872'),
(562, 'admin', '5fdaab0abd31d7aebfc222fca767b4f6fbbe35441db9dff846193907ec121500', '1441713193.6099'),
(563, 'admin', 'a46bacdfa6513ee23806eaf66f0c39af07fe3e1833cc4ccb0d5bd28089952df0', '1443764770.0108'),
(564, 'admin', 'fd4b322d157828ad1f4179b3f479fff200e3bcb7cbcc0f9b6b75249b5e42ec9d', '1444137234.7405'),
(565, 'admin', '3b6841b5141b0aa008bf47994c3c6a37048ad01ef3d6d10bbd74a0e05dcbe6ba', '1444137221.036'),
(566, 'admin', '52f3c2c814089dd6f9be3f6684e6d01d005f95bf3d7909daf917c87b3e87a498', '1441878714.463'),
(567, 'admin', '4c892f4ad0f2fcb340459f327d5b142e3cfbfc580374478bc9b94fedb9e9b8e2', '1444137221.0426'),
(568, 'admin', 'b130840edeeaa6c8cffd6fb2852403ca393713dbb9dfda6b7dd663588eae9713', '1441878721.3836'),
(569, 'admin', 'cb0ad040df65a981e3ab3a6803e57f46b983bc9b3de846db0d5df3d8a0fcdfb3', '1444137221.049'),
(570, 'admin', 'bbb87e6de92deea67c7b37180fb1282acf292fb586575d41e246f9db164dfe2c', '1441878681.6287'),
(571, 'admin', 'ae4936aabdfabc86735e38a3a4142fddd204445acf003f6d4cb9dfda6e325f07', '1444137221.0557'),
(572, 'admin', '90b55e1fc4068b0c79f638e81552be742b54ad2eb89cf533a50d39cb06107272', '1443764763.6796'),
(573, 'admin', '9152338e3b321bbae704c09a22406dad6b55b728d0417aa2ce1fd0dd1685115d', '1444137221.0619'),
(574, 'admin', '59f8c478a3acbdc207ac0aae522d0e1d7bd2c89f6b826342f05494d5ff76f4bd', '1441716116.7891'),
(575, 'admin', '48edaba93c9ffced2903114a30e895ef60a89393cd48f1ee48b8332f653e97e8', '1441716461.164'),
(576, 'admin', '6835c5d1308e73a7f9964df0f1c08abb2995906e20ab5854c348839cb4603451', '1441716461.1721'),
(577, 'admin', '195c1865095462e573f44acc67f1c0eb3bb8383137201416ac06e1b793dee55e', '1441716461.1811'),
(578, 'admin', '020dc3e7c25ee715c2996a5e2618fdc00332f8d7e9beff2f136f3882dafcb8bd', '1441716461.1886'),
(579, 'admin', '0c1ea7ca94af97ecd8d72765f8f4140c9216344970dfcdb7b42d59f8bb6baf3d', '1441716461.1965'),
(580, 'admin', '3f893dd82a8242e3dad8eb92fb262a47925e040d69149408ef71a3684327be9e', '1441716461.2053'),
(581, 'admin', '9dc6f34d5bc90d62b0b55a91f45035b7e67450778d1b765ca89bc3b40daf478f', '1441716461.2144'),
(582, 'admin', '8f00e48349dfe76555e7cb775be4bf910f046fc5de455ce54ff82c3b2dec1e69', '1441716461.2239'),
(583, 'admin', 'a4bf8138938fc5b9bc929102fd4c76dc5e7491cb530d1134a0d41a52b9c57fb1', '1441717383.3424'),
(584, 'admin', 'db85fd45ae0ac9e1f3ec8c8b1a6142f1162a56e539e58909375d0cbcfae1619e', '1441717389.4167'),
(585, 'admin', 'a4f63bc133a9fb2dcfc2d53e395fe70c0330c8adf1900928e77cb70b76148b61', '1441717393.0774'),
(586, 'admin', '9beeb7ce4948a5f4943cca8ee47c5b14e0bc2e6fa31a18acf1ae48262049f4f8', '1441717395.0686'),
(587, 'admin', 'e89990eca26a1f345b8e0e33b94ed90d3ccc6b83350dd8debd4a45911a389368', '1441717553.2771'),
(588, 'admin', '29cac40527057873b0d89c21e40855107b88a485a51935bb1ba4bdc30fb1b6d0', '1444139385.6739'),
(589, 'admin', 'fc607100bbee0649a290caf45a01695c76ff6d271a08bd2f947861c202964f4f', '1444139385.6665'),
(590, 'admin', '553eb3b4697736e37110a1e38f17fde8bdbbb567aa0df4b62230080f37500a6a', '1441716905.6627'),
(591, 'admin', '9d9e69e8522e1cc54968d0a883f4e45526f1d60f7bca88bc38e3d9c658542530', '1444139393.5916'),
(592, 'admin', 'd6e9a394113f24a6b716edfa9687422218b929d52c46c84d35bfad10b29fb696', '1444139382.0934'),
(593, 'admin', '4a365f934d5006d9a7b609e8cdeb6d1c0809fc2223a2385bd1ef5571b599888d', '1441718798.9684'),
(594, 'admin', '57da963fd33407f4109476e74d1e09d6e486aae0520553fd5cbe4b334e0ff273', '1441718798.9739'),
(595, 'admin', '1b35bc9bd062558c29cea728551f1cd83cc48b1b1a48d1b49dd8f7ce137c05db', '1441718798.982'),
(596, 'admin', '92670f579552d2830ff999456c5d7d788171b3237d9846a01202c92c6f40f4a3', '1441718798.9876'),
(597, 'admin', 'a544c16a7e873a141a4a0d1c3d43c3af191cdab139055b4f4c0945f6a44dd813', '1441718798.9936'),
(598, 'admin', '05439b7730b290076278dbfe254e41a0dd72699ee84455adac3653c358bdee31', '1441718799.0006'),
(599, 'admin', '9d4e042bcf376baa966cec1c03d7192858ac3ecf13080a69f206da7c09ca6f82', '1441718799.0065'),
(600, 'admin', 'e8e197377e2a348ff5175bed1accd3cd31f36167a7eac66f64cdb88fccd6f2a7', '1443765144.5461'),
(601, 'admin', '3fac03954e5e692a842f49310eb8a098453641676d3a3b5b5efd1c7cfa9e7f9f', '1441719334.9152'),
(602, 'admin', 'b43cde7122db0d7c6d479d027f4a77c9fe49c95dc6f6e26a57015dbeb2f93935', '1443766932.8294'),
(603, 'admin', 'f82245dfb2cbfb40ad1a5f85a8b544783faac037f69b904e57b424277f16aa6e', '1442400854.4479'),
(604, 'admin', '6afc62bf7ee7b059460bbacadc638e55cf08b95bd38396acbd382a71e25d6a6a', '1443766932.8255'),
(605, 'admin', '0c70ca8820c7d358c56d8922af9082f90438a8b0f667227d9129fee7fd8ca6cf', '1441820078.0128'),
(606, 'admin', '8f283ead821a2bf1f6a8f41be6d7173d9388ef40d0bb20745e3137a959eb071f', '1441812253.3198'),
(607, 'admin', '0ebf4c3574b5daffb6563150477f4fe837a6ae74c18a84f2d6ffb6e13dca68d8', '1441820078.0301'),
(608, 'admin', '98655bdd9db9d9ca533d26d6b204a77f11fb200595ba20a6916a102a630ed16c', '1441873278.4701'),
(609, 'admin', '9320482de7dc6b6e454f900c5c92675a20e7003993987e7a142a35df2be2fb4e', '1441873153.167'),
(610, 'admin', '52c26d74cb497438e779f0ff914964a74a99c20d689d3e95296e35b2e58397e6', '1441873147.9128'),
(611, 'admin', '7c2c45ff9cd05644eb595983c0678caad3e075844ca52b7346961bfb8899fbd7', '1442293369.0525'),
(612, 'admin', 'fe908940310581156a5707aae5ad2437574ff59830d2a0e4782a481cd405de56', '1442293369.0492'),
(613, 'admin', 'b65295ae05aef134d44c859df8deab00e9ca1da8d5cc4f6a8a54244f1d504310', '1441878137.183'),
(614, 'admin', 'd7cad1231a0bd770f40f4593b370206f29c6c2f20ff63d5d14ea8d9f3aebeee9', '1441878164.5071'),
(615, 'admin', '7ab645f77254503b1d40424eb83e3175c6b0aafecde6836cca39f58254185fab', '1441878189.2331'),
(616, 'admin', '72a0c4948cd2c5bdedc5d0727431bace3acf5fe6390b0206b783bcf3be92dd1d', '1441878191.4333'),
(617, 'admin', 'd986032a8495a6f86b6d67dc3dc3ce3206bb2c95f46260393de02af94f7e9c99', '1441878590.452'),
(618, 'admin', 'b5fce252e955275f2fce5832fbb15a4882723916e9a32e52bbff4bb93dac6b0d', '1441878598.3856'),
(619, 'admin', '95528ae2d3cdb688e3a906907d9954db589be329a42200cf28cf6bb3d7a92a17', '1442293367.8062'),
(620, 'admin', '78130283dfbc59409d1b5b9ba213b6efe79652d6d6a570198e1a31f38ee99e00', '1443764785.4933'),
(621, 'admin', 'a2fbd4ce85fd12b6ecdca98c6247157fa708eb63082f8c321d0445218bb76538', '1444137221.0282'),
(622, 'admin', '90196193f46edb0b4fd265c723cdbea12836a6979557f62291e374ce0e6bcbea', '1443765275.0807'),
(623, 'admin', '87d23450307073ba72e552f5a6c57b2be5bffde158a2f7fa97487ae7f007cbd1', '1443766932.439'),
(624, 'admin', '7467e308b3d5724abc4e8d835e46b335546d5dfd7db8e8a0eb8d161c2d92c48b', '1444670151.765'),
(625, 'admin', '0c62712b16bd96436dac4bf278db8185aec2044877d664be184bdeaaaee42a15', '1444670151.7543'),
(626, 'admin', '4ed1e9ace2faf32aff1c6069a468072db5c5a2166df1996dd28f5268c78cf511', '1444670151.7735'),
(627, 'admin', '2a02caa023ff4adbf381be7ed0bde81334db9289f59e701053bad9e6b895ec34', '1444572071.2582'),
(628, 'admin', '54a029058df58d90657bbf915609717c06fb9ecc08adb5106f4141cb517ebeee', '1444670151.7962'),
(629, 'admin', 'e77ec699754baf0f93de1afddcc038b7da1c54e93b62271a2fc6d420f175e144', '1444670151.7875'),
(630, 'admin', 'f61ca3c6bab435e2dc6724bacafc6243d730ebc37e6b7f7b6bcdc45896c73789', '1444572173.4674'),
(631, 'admin', 'e379f9b91fbc68e1f2d46308f2bffc1479fb8965af0d452f1a1c4611daae392c', '1444572159.785'),
(632, 'admin', '7dfb20bfe05ac4c6aaa4cbc173742d4f07223f5343d0b2e9b061abcbcc532258', '1444670151.8066'),
(633, 'admin', 'bca44a60f72ac8179f2ddcc2723e7fc86cb551766c261214bd8e76bae9e6fc1d', '1444670151.8154'),
(634, 'admin', 'c01be048d75c12fb78e42f049c04ff228496093ae1161fc781da442c8bc9ef8a', '1444670151.7799'),
(635, 'admin', '06cc21a694d97ed58ef3b137b32ffe593fad141d8212b4756078e9ddb5627bc5', '1444572152.931'),
(636, 'admin', '3e5fafa0351f93793c0e1fb655bc3a07b602839e068258b44732b7829ff2dfaa', '1444572157.3061'),
(637, 'admin', 'e741a74dcd9ec6d4a51f8381a5cacef0ffe27b2f5d5a92cec89de8a4a0bf65be', '1444671759.8081'),
(638, 'admin', '14301d1212670346a0f4de4e1d989dc820c0925de2d1a1e042f5dfa91e0b4d17', '1444319654.3201'),
(639, 'admin', 'f4ab7acf0374bca8a02a88622d42afd4bbd25c78a4f663e8d14a9f3ca98928ae', '1444655781.4623'),
(640, 'admin', '2f9700d3410c2ad3fc16361e4feee3cb6e878e28e2ac81c9ab0fe911ab2fc1cd', '1444319798.4112'),
(641, 'admin', '63dd20ff8a9accf1a96c247d15bd6c61ceb62cffc7807e89e9fe441d70989fcb', '1444319814.1945'),
(642, 'admin', '2bee0e5558f0e8ea1096a9e4ee46445158a4c5542a33c88c81f404c06940f02e', '1444572116.0937'),
(643, 'admin', '34c50da1e584e5b2b45cc0030b2928d1fa31ef354417d15ecd977fccb5fc2e60', '1444572169.3766'),
(644, 'admin', '855f6dcd14d8f544cdd815a4528caf8430b5c6fc0c3fe42a089b966d0158ae1b', '1444319832.5623'),
(645, 'admin', 'b3609f123580ff24022eeb77d8ef5833f9ac6812cf1e8dd1bb9c1ab0fc227e28', '1444319838.3364'),
(646, 'admin', 'e20bcb22e454e1a63ad7a0527b47be4a0249ca282cde4506c9ee6f6f01a2be86', '1444319870.502'),
(647, 'admin', '794a2105871e3680fc783b4cc05af1aedbc95f4ec833f69e84f4df367a149fff', '1444563052.619'),
(648, 'admin', '696de7fb0b3b39dce6452b27b7bddd7098b33142aa9696c3421ca2d84ec45e9b', '1444573918.0214'),
(649, 'admin', 'c1c5f1a531f9eab847b00295431653408345a5bcb339ab8b07ace28dfd8388bd', '1444573922.4786'),
(650, 'admin', '4ad12ad64d75e794f4fc6ff73100e20fbb35a5b42a27d591d59d2ad445c29e3e', '1444319963.12'),
(651, 'admin', 'f9c1ac63bc91ef1c188ff0c8c78bb8350bb20557116ab652c6bdd1ee3a115d07', '1444573104.1791'),
(652, 'admin', 'fee9e765ec587f66c1b00fbfa3d9a609dcc727ce9f015ccaa6c1d308b54d00b5', '1444573903.8491'),
(653, 'admin', '5fbf20f1cc1955dcf36a292126bf429080fa6afac489c087c01c79ece453c9ef', '1444495845.908'),
(654, 'admin', '1e57ec2465d483ad7b996e7556de9758c0ee1735e62a89c6fbc0785ea72a2485', '1444548407.6814'),
(655, 'admin', '04c9d755e4b7db3cfe2b37409e4317eb8f57dbbb5db0776daaa2eaf680f85948', '1444548394.9877'),
(656, 'admin', '7807a312cf901032056506d5bb90b45b63618b912391bca2bfb6ee615797a414', '1444548399.5355'),
(657, 'admin', '906f1e9c6b7fe47473d5f1accfc23859ebc0e52956cae46153d5000bb0480409', '1444548402.0691'),
(658, 'admin', '4b955be88d371b8eb800c80b8b9dc1dafa27597b4c572cbc625e16d3a7016ac5', '1444548404.1544'),
(659, 'admin', 'daab70a14ea425df211dfb872d27441826e5957e7c23d2e4bf669d49c32968ac', '1444548405.9104'),
(660, 'admin', '940f03a8927431bd5706c32739a70225667a4d9c1c1848c9fba0871613310c1b', '1444545847.3081'),
(661, 'admin', '87fb617bc8b57f5f4a35aa306e1fd73403d8d3ed2f56c58bf296d7891366c3a0', '1444670890.2726'),
(662, 'admin', '90b444f651f5eb057746e2a06f3fbe3fb51fae3cf19b4c8e54a33bb9d617f81b', '1444670893.6182'),
(663, 'admin', '77bb1aea084740e087e095573e44ec2cf18146313c064d5d1b2d8de475b0e4c2', '1444670856.8223'),
(664, 'admin', '9289459bd8e028b17df93361c3306cdf69fbc79401811125f443ae619aafac3a', '1444563303.7601'),
(665, 'admin', 'c4bea00d06e8faa14f523fef824533255706f71ed57b2139095ed683c8669273', '1444548860.8297'),
(666, 'admin', '04f1d3e19a37d81aab4a8184423a02477f45cc9f719fcb68bce721db7d54f4ff', '1444548909.2389'),
(667, 'admin', '7ece78b36c696f1e3bcf5660048dfd5f91934bd948f6b9cbe10ac1543b4292f8', '1444658413.1495'),
(668, 'admin', 'cf5c21dc6ee62a2144cbdb3502d4fad789a13ba4710bf4a512889397d93c032c', '1444548916.1746'),
(669, 'admin', '7adcb8503d1844660a428e82e55271025aae2f49f097edded3fcb5bd950cc483', '1444658413.1438'),
(670, 'admin', 'dd615c012af5e7b92c5a50d531b49c86e48f64c37f1ca6de9338c7e286586070', '1444548923.5626'),
(671, 'admin', 'd1090215b42c0877087a3bd34560d583103d6e9def4517f9ccc10e54e53fab1e', '1444658413.1377'),
(672, 'admin', '778e9435310befa55192ba75daeb16567a52f54f432dd38f3275a822d7579479', '1444658432.291'),
(673, 'admin', '30754128f13dde4805284e75013e29c57ef95d2c1d2e9b92686eb575371f1108', '1444658413.1321'),
(674, 'admin', 'a8c1459cbba881407fcac4835e1b685e551370b8745dcb3bb093cb296be59699', '1444576258.8459'),
(675, 'admin', '8c00b6a11a19442f7308b82dfb19570769da1bb8f2db0a671112feba5b45ad6f', '1444658413.1225'),
(676, 'admin', '8495836dc5f777e8534e306af543caeb00b38ae28f5b09fc30b54aec5844097f', '1444556625.9622'),
(677, 'admin', 'd67f5334b062c2ba626524ebdfd7c0fac3b6b6e1475ffc288d55dcde42dce389', '1444576880.476'),
(678, 'admin', '4a00a6c4dc464b851c26719b69c8b095a92572ccfbae708b10d2ea1ad1790c67', '1444668658.6182'),
(679, 'admin', '101461fdec2c27e174e23473a7716d6a47b51dd66510cceb4868ba4a01590bdc', '1444576249.888'),
(680, 'admin', '69dbd24e89441176c40ed80168e7aa8e167b9b9129a8814fe7fb5cec3eea1008', '1444576249.89'),
(681, 'admin', '71a52a783e51a9f55eb9ba98d0118b8c4d5f53ebd2cf58ca8914cabf5e62cd38', '1444573980.362'),
(682, 'admin', 'b45eb30eb90f91c38df90a4237d03238d8418ec36c0029f543414f7cedf5effd', '1444576249.8917'),
(683, 'admin', 'ce745b46d231f7d69c9293eec04e031f81b6ddc4d98bd21905fc43d1bd942cd5', '1444576249.8934'),
(684, 'admin', '5d0904cebbb28bd873535fc3a9bbae8fc47e15e630cbe5327e18e74d5a52b8f7', '1444576249.8949'),
(685, 'admin', 'f5f04b6e0179e6ff62e5907ed34bba66577e31a1eb3633f4669583dbed08bf6c', '1444576249.8965'),
(686, 'admin', '7d0d6a378b6eb41af1fa873c73d7d3d939da8f2f92961642e43bbf9ae356b5d8', '1444576249.8981'),
(687, 'admin', '6f28d971ced970dff8da0a0bd670a94938e89d88662318d640e25a59269bf743', '1444576249.8998'),
(688, 'admin', '2ab06ce764d3abd39db0ee10ebc3c50fa3f97dadcb94092b7360616afeceb327', '1444576249.9013'),
(689, 'admin', '6fe90ae0ff08afc8d473921295351ac5ffa773130c483413169018bff7432a2b', '1444576249.9028'),
(690, 'admin', '4b0a9d9a6c35429ea8c76229956914a167d226f7be004df8796e1d39abf97c84', '1444576249.9044'),
(691, 'admin', '8f1c802eb978ca1ca28e9f9c3f7d6bb52c63c4687a26a72860dfd4e6a5ed76a7', '1444576249.9064'),
(692, 'admin', 'e870c4ff43754acfcbc24334329720307cbb02c188e723890e4de806a72cbd3c', '1444573985.2331'),
(693, 'admin', '9503ee06e9069948d1df9b2c9d667b0094483397bb9c0dc1d1e10d0bbc9b9ce5', '1444573985.2388'),
(694, 'admin', 'f58526a66a9c60b6e988b4977c7ecc48a22348aab00cf64fcc28404aa4979cac', '1444573985.2451'),
(695, 'admin', '57d53a6eb0a7303edcab7374b02639b52ec06a3b7c359028af7cffd6bdb08277', '1444573985.2504'),
(696, 'admin', 'f64463bd143587c7989b4d3110b32df77c1792f8b5915e67766871ae829b8809', '1444573985.2562'),
(697, 'admin', '51584d1596ac2beb511f8f8ef6cc386041410f834ce98f8e02d42da42b95ca07', '1444573985.263'),
(698, 'admin', 'a3e1cbce7f50f52815ccfc6590676b88ef674b8d6cdbea424cacd1ac12455c71', '1444573986.2239'),
(699, 'admin', '0315f47258d29444688d888718e95c1f0befa077afb4e7b73460f375f16a3ad9', '1444573986.2308'),
(700, 'admin', '7c659c1c22cbb68f6038b51fb1486f3869ac3e19753655ec0815ea1e46ceb2c2', '1444573986.2373'),
(701, 'admin', '1e85ea48b5fb4cdafabeaac10513a71b237154b0180068f87a0a0f4c4fa26bc6', '1444576371.5355'),
(702, 'admin', 'd953e0c7b111a11b0884b581d70cde91fb2edc61c7228fae632d236c2112ca47', '1444671732.6844'),
(703, 'admin', 'eb536187174720e10d7cb0fd17ec7d8da08652b994357f4a2b5998018d3639c9', '1444670940.6246'),
(704, 'admin', '7c67c4668e0fd79ef3f9ea877aa69717957cac514baaa03dbed685dbdbfe4280', '1444670980.8957'),
(705, 'admin', 'da2e7d8fd3113d4e28debddf7f8e26b4d81654f02ddf1bf49c346903825c422c', '1444671376.2721'),
(706, 'admin', '7b80e33d6fa62fd3df9f5e989f3400730b599a2191cb2f5af3517fba2462165c', '1444671759.8035'),
(707, 'admin', 'c33afd48a2a75dd785fda3bab6f4b5ed78e951d95487dcbadba49d5c5952a039', '1444671565.7406'),
(708, 'admin', 'e3e8c1f533d5ccbf1cfce0775b3047b3e6236dbdd25e58d1e714bb1ca1e52400', '1444671759.7974'),
(709, 'admin', '2d0e40da63e0b6290d56a955a15f249a852b1c600e59607914b4c3cc0fdc2a68', '1444671754.5793'),
(710, 'admin', '6a54270b811538e333b0cf8b5d35d265eb2e4080baf5cfe0018ce51b42b65115', '1444671759.7904'),
(711, 'admin', 'b211268c1642cd29d85fe6ee13d1cf546cb5ffe12623faadac2967d0a8be0c9a', '1444963225.9387'),
(712, 'admin', '5f2be17300039cc861f0c22f455e28afcee54a3c09059de65d322738df205610', '1444963225.9407'),
(713, 'admin', '43f3074209aad6cab02ed1b07f5c5fa5191d80404b877ebc01b9d45287357632', '1444963225.9425'),
(714, 'admin', 'ba5e7077f9fcbf1cb329163ae5de4e47cd092997ec62b44ad4b598848e132c8b', '1444963225.9442'),
(715, 'admin', 'a83d8c760de79e455cf6c483501137eb979785297624aa209ae5545eef8ad009', '1444963225.946'),
(716, 'admin', '32d12ecc21ecc0ff717c2e190c9bafa0de717eb289383be4c76535e013d06eba', '1444963225.9477'),
(717, 'admin', 'dbe4705fe7fb905cbc80bab554029215b699a75569d95993d5bd1ff379d7ee40', '1444963225.9494'),
(718, 'admin', '66ec7803a24afc3cb6127ec869aa9eefe93addabdc55dab601335cc86219b477', '1444963225.9511'),
(719, 'admin', '6e520603edb33ff406144f9deb0058605678d80fdd5238078756cafd356c18bf', '1444963462.0794'),
(720, 'admin', '28cf973d02f78da286d5ab2ce5f38d266015a8b93e3491b1f943603130054a8c', '1444705766.3096'),
(721, 'admin', 'bb57423a41e4d60f939b1510668f9ebe08e85296552b954f6aedfcc184911923', '1444705766.3108'),
(722, 'admin', '3d84a03d6067d9a17a3b77f365fcdc58f75a61b790aad7ff2a4295884c2071be', '1444705766.3119'),
(723, 'admin', '574921b3b7f085e8bd590b5435c5b5e00a2d4f06b5f88dfa512ba27f72d4f2c9', '1444705766.3131'),
(724, 'admin', '1202e8fbcf7185fad759ca7f728a5922b492f277a2064f64b72fc38e5966b64e', '1444705766.3143'),
(725, 'admin', 'ceb6e5d613b9cf74bd4d7065d8e10fc9da063e706fa1f6f1a2c44910383740e4', '1444913964.0818'),
(726, 'admin', '0914c93cebf7712fdcc7e2accaee56afbf99a39ad4103cfb90d4b94e9e252694', '1444913964.0831'),
(727, 'admin', 'bb1de811138fcab7fdfe91024a12ad3eb5fd2b2c409566b99282d7ae0240aac0', '1444913964.0842'),
(728, 'admin', '8b1f21aa9f5ba649b706275a98d08048a151b2859ee7fca18fdcd480c7f243c1', '1444687269.5019'),
(729, 'admin', '6750943c095419b9eb4e2d5b22cb79cf2accaf515bd877be517cdd57f77b8145', '1444705785.5011'),
(730, 'admin', 'a8650460f6d5e0a5846f21ec0ad6a1607bd7941c712b1d846a5b27803f87b256', '1444705776.1444'),
(731, 'admin', 'b8eb10db8f05ea690c1d201405e7f5472f17b33a0ea96556f0e27d89899e0f1b', '1444720497.0363'),
(732, 'admin', '2bfa0fda37a3d07b18ef77cbad03051fa0c0ab3d2cfff4e798235b0595548310', '1444720497.0387'),
(733, 'admin', '98c23a4e5cecc83ad4ac2f510508b1c857dc821bf8d124aacecebc682360f1cd', '1444720497.0519'),
(734, 'admin', '046a8cfd99f50b7e1250312bf5f24038f8ff171e20c905c9327f41b79f4a6ad5', '1444720497.0542'),
(735, 'admin', '0153add28ce19353a1e98ae1964c3e6f476cbf454555643038f66d7280984c4c', '1444720497.0573'),
(736, 'admin', '73cb43a9b5a331651314f64e1cd3ee87ed7db4c7f9281c1fcc5a6a590805ec64', '1444720497.0594'),
(737, 'admin', 'c1187339cd1c0cd6d2f92a821ef49f47aed970fa6babe1ba8a245f6b9993d1e9', '1444720497.0621'),
(738, 'admin', '5a5d88d374bd3df7350779d2f40dff097c06b200802a0c2674deba11508c2fcf', '1444720507.7629'),
(739, 'admin', '5ec1d61d7616a1cbfe5d34033ee95ca060adb5cf7aa8d2f2ad8e2948b530db50', '1444720507.7649'),
(740, 'admin', '529254997a2cae3e0581c36c14588b27c918c96c38169e926666fbf885a827d8', '1444720507.7669'),
(741, 'admin', 'b88d4d381e991ce66e68d5a196fc667bd909e0e152a5cc87aad0bbdf31347605', '1444720507.7688'),
(742, 'admin', 'fe3b2bdc9d2ad6be6360362bac025a365b9005bce70530e99999de61b55e84a3', '1444720507.7707'),
(743, 'admin', '2425ecbfd09d2691d4b07f399d599a36e8c4b34f92c547a4cdbc0f2da5d2e09b', '1444720499.3531'),
(744, 'admin', '4a60f6e2e0e62fe2d222a3d23faef3a079b81ec35ce51643bffddb35b0319ecf', '1444720499.3551'),
(745, 'admin', 'ccdc94b041eccdd0f77341aebcacc6e97ef8968506800af631883a2b16e12928', '1444720499.3569'),
(746, 'admin', 'c269111b4d87eb4e2bd0bc5da411ee03e2afa09e858d39c46558a285b23cba3a', '1444720499.3587'),
(747, 'admin', 'dbeb858eb57736e2303bef60e751f8655dc9f026fbd8fe2c0bd531ada52a630c', '1444720501.0807'),
(748, 'admin', '9a26408bb045db471c2ee9a3a01a4299e42d2174ca4d33a28f4c230b625017df', '1444720501.0833'),
(749, 'admin', '77a5bae086117bf5ceab08205dbf7d8d16964141aa1a15fe455299268f7be562', '1444720501.0857'),
(750, 'admin', '09dffc3211bdca993bef5947ab4d8a8c36cb4c75c438d58f18618889b4f5421c', '1444720501.0879'),
(751, 'admin', 'd12ddbee69eaccb21cd87c49d10f1b511acfdaf8d58e1477842f6e75a21ed87a', '1444720501.0899'),
(752, 'admin', '7fe1bc404de7c7d01802107965c85cfab115c7c23a0fff03b6c3135f8065c264', '1444720501.0915'),
(753, 'admin', 'e04c9e6bd0adbf1627cdda7f92b6b5395e85e8f6739689a2a330a0886fe92731', '1444720501.0932'),
(754, 'admin', '8aabe53afaaaab44ecc8a9bc6c51c0c9f8201cfd784622623fba3eab8532fd94', '1444720501.0952'),
(755, 'admin', '33e0f107824f8774eb08e09bdc021286831a85cc0efeddcb7820c13eb46bb09e', '1444720501.0969'),
(756, 'admin', '6b0f758ceb04ac9b8ee29e461ad2ee488847edd51443fad0d94a504aa88247fa', '1444720501.0988'),
(757, 'admin', '0d2be4a604ef32c1540932a6548a8e4aabfa08bc9cd08a045b81d8f7d3efcd3e', '1444720501.1008'),
(758, 'admin', '3016c6aeef23fcfd82b1ac5849f9a19f430afec8ef2d4d46313047291f88de04', '1444720501.1027'),
(759, 'admin', 'b8bc76e2633e3fdf2210a616df44f5d4431aafc8fc50aa8f5542debbd0da6fc2', '1444720501.1047'),
(760, 'admin', '155aed4ea02f22685b6bcf18ed2166dcbdc20c65fa54a733758d5d4d4dc1c15c', '1444720501.1065'),
(761, 'admin', '04a531bb14f5ec500131cc6aec9d8ef457980b7a9951772d7e212c1701c94b76', '1444720501.1085'),
(762, 'admin', '3dec7fcab03f8665a19ee401d3401b5e77d7f61b19a181967babc38c5cad1042', '1444720501.1101'),
(763, 'admin', 'be3dc78ad8c05f2d686c17a8f341a63a5925c44eb181b7ee55796443c431fd7f', '1444720501.112'),
(764, 'admin', 'ebcdc4a7f7850684c28d0770fa6602414f01c6860aec2ee9e73071bd23e5d579', '1444720501.1136'),
(765, 'admin', 'e2030b523c39f09a0dd063ec8258ff9f29cac86895cbe41b70c7dbc43bc4394e', '1444720501.1151'),
(766, 'admin', 'd8b5d1e89c44f999d15470c5547acef15eefeb618351488af04e64dfd596e9f6', '1444720507.7368'),
(767, 'admin', '23b55d56476ae1068815b5a3dfec9b66b1dbb81d9b14a9d6d54561e918f5089d', '1444720507.7392'),
(768, 'admin', '6f6d292d8aaccba7ca00a2ae77d4270ce0bbe01e18465fb32888aa378bbd8fe7', '1444720507.7415'),
(769, 'admin', '76e8ad1d29abd53a7340a023c5844945c99eabf24b7ec45b4eec2fba97c715e3', '1444720507.7442'),
(770, 'admin', 'fc02d084b8e830c47af49ac86daebf304b84914646da057656e276f35dab91fe', '1444720507.7468'),
(771, 'admin', '7730972e31e6c9a8686f8f35cb8eeb25263a4cf96ff6cba4cae46a39b1305e61', '1444720507.749'),
(772, 'admin', 'fa0ff6779a964040f98ce109496a11cdb51ca8d699290f7d87715070ec701eb9', '1444720507.7515'),
(773, 'admin', '16efc7ad3dc5c6da940f183f0ed32ddd94eee2d19d51eac11a7156e1f0ff1170', '1444720507.7535'),
(774, 'admin', 'a6c1fcb8ffc005674575c6fea79f43e0e46ff1dfa845cdc119c53f035998b08c', '1444720507.7554'),
(775, 'admin', '5763c5cf8e500766310ab26dc2508f0cee9bb33153a2e57ebf152c2b7960fb23', '1444720507.7574'),
(776, 'admin', 'ff247e8d5fe62e22d62101990ef6fc25c2bf9df9900806c63135a6da87d127cf', '1444720507.7601'),
(777, 'admin', '8b715086f64992bf73ff6f1e6f867105555bc508bc892a344848a35142ee0897', '1444720559.4529'),
(778, 'admin', 'ea9f05f9fa39de9ae9943a60716ea85f64791499c2e545fc3cb2c9645a98bbc6', '1444963462.0735'),
(779, 'admin', '1f7ee339a57ab3fd582ae07ff713e603be5a7c4dc9bf815f8d7604020e67333c', '1444913965.1261'),
(780, 'admin', '27c075e112dc27a5dd7d9f3118de9a8188e72fd4d03ac6f996dfc16ff315b7a8', '1444963155.8164'),
(781, 'admin', 'b17dd69ea550a110e8bb91b41fddfa728a02337b7467ec91dee581b72b5c4f38', '1444963297.1744'),
(782, 'admin', 'a3ae003e57e05fe04255389168f79bdfe300e7833a6da05645e91a8ccb170808', '1445583111.9702'),
(783, 'admin', 'b81d18d0e90bb3b5b91ee82c693a5eeb983e4f41d1287bfc83d552b0ca9883d7', '1445583111.9723'),
(784, 'admin', '23f5d977dffee57f7a4e8865fb9dc14a6c89c3e5e0cdff4f69967a1d7d9261a0', '1445583111.9744'),
(785, 'admin', '4f44717e98d40c053e4518a481bb042bd8f0f71de5419a5b8741dddc476ea8fc', '1445583111.9765'),
(786, 'admin', '86a3c4e09a280889a3a720792407f10565fd53220488ddda1d3b5f8d1e051eb5', '1445583111.9786'),
(787, 'admin', 'da88ba4e7cbea340849c98c14ea3d31e42cbbffe1fd64ffc984a1be97c145e82', '1445583111.9807'),
(788, 'admin', '2aee553a925788e618b9d312476b8a5b86d68fb4e1c5f75d3104c11e643cd424', '1445583111.9828'),
(789, 'admin', 'ed0eb42ac1c8389b2015c8b86377b213f7903e98ea782cd4dd2089b594e28567', '1445583111.9849'),
(790, 'admin', '8818369c555b5299a99f6c5b9d10b4e5abc462b9fbe60ea4bdf368119bd47670', '1445583115.9546'),
(791, 'admin', 'b82f0a1b50253ec35a1f5e20d8b76a11db01f1663dec06d93b38d53b8e55c85e', '1444978652.7786'),
(792, 'admin', '15d5f39821cc829853bfbe3df30af26eb35ac3bb59d2bc271ae8b228b7fe945d', '1445476702.36'),
(793, 'admin', 'd99cc8b65a4d9940be415edc6e5fa3f047525d5d0298fbfd6a6e22f0b1578a45', '1445583111.9679'),
(794, 'admin', '17390b778bc43c22313ace36b9bdf423e0cc54a26daccefbda0fce0c0a83a774', '1445583115.9429'),
(795, 'admin', '3c80c4adfea0a02c665f5db1d6dd608bc3cb6d2d5a05ed5e76e8359e32a88f12', '1445575038.8708'),
(796, 'admin', '3d299d0ba305443970097f0427b87b0ab45074f88744b86cd89d1d007bbb0afb', '1444978987.5914'),
(797, 'admin', 'aeb06503cb73df536f44ab836663f5e7193c646b853fd66559d700c41be5dffc', '1445480314.8886'),
(798, 'admin', 'a70fc6f5caa67a3c25da67dbeb68af18b078ad9451b9cf923f86c31bb37721ff', '1445575040.4062'),
(799, 'admin', '11a06eb02e14b424ecbdcc983c8613589dcad5fc13fb67f8b384d77c236a918a', '1445018364.4463'),
(800, 'admin', '69ac5dd22404e8dbc5d9f75780b07b731b13b33c716761477abc30a9eaab7d46', '1445575037.3496'),
(801, 'admin', 'fede972df8e1f30866b0a404ffa17c2f28928db44f2acf3d24d6e6080cebf8bb', '1444980164.2786'),
(802, 'admin', 'b44d12532f40ac66715a9c94bddb83ca3568dff97cb36a02077190d78f642655', '1444980167.2521'),
(803, 'admin', '2fac4561534ee111d33782d486de2c6ec3e10b9a290f72d1847c70d6f52da15c', '1444980168.376'),
(804, 'admin', 'ca3d9c2c9efb7b4ff9ecabdd7e872c41f89955b1adf8ed89fdede682c500902c', '1444980171.3148'),
(805, 'admin', 'a520a0bb7f446a5c3fb0c0fe637834da165f3688bd34874bcf39f99e620f3591', '1445525728.3469'),
(806, 'admin', 'f71a692d87d4d667673f85454e0d2e84c912ec3e289389abe2745653d520b4c3', '1445477350.6017'),
(807, 'admin', 'db85e599b0a93468ad446ea1a579ff5995d71e4b3627e1864827da5745bb4994', '1445525720.4115'),
(808, 'admin', 'a453234862511ad7a82159ff5eed97925ea6d94aeb59da0d92c218a85856661a', '1445575037.3466'),
(809, 'admin', '724cba0f4775af3819379f6bd047acade0527193235864599e2dfa0c837592d5', '1445575033.6728'),
(810, 'admin', 'c8acdbcbc6c98b2c2209d333ed470336ce97a8bcacc4026be921cc0590d9436d', '1445575037.3448'),
(811, 'admin', 'e1649d756d06a148c7bce84ecb4e41beaf5eda9bb2abc51fc94bade8b8d86c6e', '1445525742.6128'),
(812, 'admin', '4f23005e4720c3363813533c6b252a0091903f655bf10987a5608c9a4c569ebc', '1445575037.3526'),
(813, 'admin', '222932154a56012f0aab511ddcc14b478bb30440824bdb0553cc6c1811fd2560', '1445525688.8218'),
(814, 'admin', 'bb1e9a62f5e19ef1b3bb71b8a7887dca38c95ccdbeaa42bcfa0c0ed4f23fb92d', '1445575037.3481'),
(815, 'admin', '832da197862e9cbf715dd938f0cde1879b9b217136259d5f5403dff6d5963adb', '1445069766.4644'),
(816, 'admin', '70a0709f557df831efa1d678156f50648bef78524059dd3fb91be477428c9e41', '1445503378.1451'),
(817, 'admin', '14f62a8e139e1da9997e06a257356ff4e2792d80942fde131e8a384dc009ae65', '1445580711.5026'),
(818, 'admin', '1276d6e9ec60524ca4de0529ca99b05a7380045abf30ae907571c3b68aa930db', '1444984894.4835'),
(819, 'admin', '87d8ea3aeab40b45e432aae217e18385cb19fbbaf9b8fe83ae4e23616e3b85e7', '1444984894.485'),
(820, 'admin', '4674037cc0ebc78721688768606c3ebe4c87e667566e0d52e0505677af83ed03', '1444984894.4863'),
(821, 'admin', '7ed795556f0dfc08a31ddd6e4accd1d9842c1a5876d2bec956cc30f9764f01b1', '1444984894.4876'),
(822, 'admin', '5f56b0035fddb887b9e7abbc8df2d1022d5df858a5ce293585675066653188d3', '1444984894.4889'),
(823, 'admin', 'fea2655af5c9d00d60adca2feb0b914fbc6f923ad63feab14aa91c093639520b', '1444984894.4903'),
(824, 'admin', 'b279489bef6c9ed1ce1325cb107e9ea98aabf4e89e939c416ba988ae8e59ad7a', '1444984894.4916'),
(825, 'admin', 'eeab0e735bfe100daff8aa4d77f9615d7dc665a3912428ea6fc869ac0822c571', '1444984894.4928'),
(826, 'admin', '5aaa0b39f9b3bb35d6599236a3e905eadd58d4d83e6d9b772fda545e7cd6c659', '1444984894.4942'),
(827, 'admin', 'ff8f513ee9b6037cedee7a268e14e0fc2568dbd2dc5ccc9dcbcb9ec9b60e1abd', '1444984894.4955'),
(828, 'admin', '9c627cea228706e80674f8154a02c6f0a044ce9df352cb6aa5c1db1b2f908511', '1445525106.234'),
(829, 'admin', '0bf2ce8aa5885ac97ae018b662bab5c8df26c7e37215ef012fb453e5d036b000', '1445069737.3644'),
(830, 'admin', 'a5a9e8827e495ac0f41427ac5a0f7b7c5ededcc7a40b09214359a70eed7b30e2', '1445580704.0439'),
(831, 'admin', 'a06587362fc67cc6a8050868ff00fefb29dbb028025ec08c8f9eada7b1a669eb', '1445575044.4858'),
(832, 'admin', '66df0d6b283b53248c1131d3e6ec3de5785335f14cb8744e4fe54e443028c612', '1445525734.1602'),
(833, 'admin', '84df1c3f9c79ed7508d42957e72c9305bdd072b603a6e2aba5b97b0f376cccb1', '1445575037.3511'),
(834, 'admin', 'd44b7c0d437aaf6acbc08a07dcde009b0922ca2aacb042dbb0e4a0129523974d', '1445575046.226'),
(835, 'admin', 'fd4d166c7d8199446a6a6cf616289ff03923941c9056d758ef9ab959c54038c0', '1445574995.3317');

-- --------------------------------------------------------

--
-- Table structure for table `wolf_setting`
--

DROP TABLE IF EXISTS `wolf_setting`;
CREATE TABLE IF NOT EXISTS `wolf_setting` (
  `name` varchar(40) NOT NULL,
  `value` text NOT NULL,
  UNIQUE KEY `id` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wolf_setting`
--

INSERT INTO `wolf_setting` (`name`, `value`) VALUES
('admin_title', 'Hotel Yan'),
('admin_email', 'leslie_wongsk@webstergy.com'),
('language', 'en'),
('theme', 'black_and_white'),
('default_status_id', '100'),
('default_filter_id', 'ckeditor'),
('default_tab', 'page'),
('allow_html_title', 'on'),
('plugins', 'a:5:{s:12:"file_manager";i:1;s:8:"ckeditor";i:1;s:14:"page_not_found";i:1;s:14:"tb_contactform";i:1;s:5:"image";i:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `wolf_snippet`
--

DROP TABLE IF EXISTS `wolf_snippet`;
CREATE TABLE IF NOT EXISTS `wolf_snippet` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `filter_id` varchar(25) DEFAULT NULL,
  `content` text,
  `content_html` text,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `position` mediumint(6) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `wolf_snippet`
--

INSERT INTO `wolf_snippet` (`id`, `name`, `filter_id`, `content`, `content_html`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`, `position`) VALUES
(1, 'header', NULL, '<?php include("header.php");?>', '<?php include("header.php");?>', '2012-04-25 03:00:01', '2015-09-04 09:49:22', 1, 1, 2),
(40, 'footer', NULL, '<?php include("footer.php") ?>', '<?php include("footer.php") ?>', '2015-01-21 16:21:06', '2015-09-04 08:56:50', 1, 1, 16),
(2, 'meta-tag', NULL, '<meta charset="utf-8">\r\n<title><?php echo $this->breadcrumb(); ?></title>\r\n<?php echo ($this->description() != '''' ? ''<meta name="description" content="''.$this->description().''" />'' : ''''); ?>\r\n<?php echo ($this->keywords() != '''' ? ''<meta name="keywords" content="''.$this->keywords().''" />'' : ''''); ?>\r\n<meta property="og:title" content="<?php echo $this->title(); ?>" />\r\n<meta property="og:description" content="<?php echo ($this->description() != ''''?$this->description():''''); ?>" />\r\n\r\n<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\r\n\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>css/zerogrid.css">\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>css/style.css">\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>css/responsive.css">\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>css/ui/datepicker.css">\r\n\r\n<script src="<?php echo THEME_PATH; ?>js/jquery.min.js"></script>\r\n<script src="<?php echo THEME_PATH; ?>js/jquery-ui-1.11.0.min.js"></script>\r\n\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>js/slick/slick.css">\r\n<script src="<?php echo THEME_PATH; ?>js/slick/slick.min.js"></script>\r\n\r\n<script src="<?php echo THEME_PATH; ?>js/promo/promo.js"></script>\r\n\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>js/selectbox/css/jquery.selectbox.css">\r\n<script src="<?php echo THEME_PATH; ?>js/selectbox/jquery.selectbox-0.2.js"></script>\r\n\r\n<script src="<?php echo THEME_PATH; ?>js/pintgrid/pinterest.grid.js"></script>\r\n\r\n<script src="<?php echo THEME_PATH; ?>js/garand-sticky/jquery.sticky.js"></script>\r\n\r\n<!--[if lt IE 8]>\r\n   <div style='' clear: both; text-align:center; position: relative;''>\r\n     <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">\r\n       <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />\r\n    </a>\r\n  </div>\r\n<![endif]-->\r\n<!--[if lt IE 9]>\r\n	<script src="<?php echo THEME_PATH; ?>js/html5.js"></script>\r\n	<script src="<?php echo THEME_PATH; ?>js/css3-mediaqueries.js"></script>\r\n<![endif]-->\r\n\r\n<link rel="favourites icon" href="<?php echo THEME_PATH; ?>images/shortcut.gif" />', '<meta charset="utf-8">\r\n<title><?php echo $this->breadcrumb(); ?></title>\r\n<?php echo ($this->description() != '''' ? ''<meta name="description" content="''.$this->description().''" />'' : ''''); ?>\r\n<?php echo ($this->keywords() != '''' ? ''<meta name="keywords" content="''.$this->keywords().''" />'' : ''''); ?>\r\n<meta property="og:title" content="<?php echo $this->title(); ?>" />\r\n<meta property="og:description" content="<?php echo ($this->description() != ''''?$this->description():''''); ?>" />\r\n\r\n<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\r\n\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>css/zerogrid.css">\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>css/style.css">\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>css/responsive.css">\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>css/ui/datepicker.css">\r\n\r\n<script src="<?php echo THEME_PATH; ?>js/jquery.min.js"></script>\r\n<script src="<?php echo THEME_PATH; ?>js/jquery-ui-1.11.0.min.js"></script>\r\n\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>js/slick/slick.css">\r\n<script src="<?php echo THEME_PATH; ?>js/slick/slick.min.js"></script>\r\n\r\n<script src="<?php echo THEME_PATH; ?>js/promo/promo.js"></script>\r\n\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>js/selectbox/css/jquery.selectbox.css">\r\n<script src="<?php echo THEME_PATH; ?>js/selectbox/jquery.selectbox-0.2.js"></script>\r\n\r\n<script src="<?php echo THEME_PATH; ?>js/pintgrid/pinterest.grid.js"></script>\r\n\r\n<script src="<?php echo THEME_PATH; ?>js/garand-sticky/jquery.sticky.js"></script>\r\n\r\n<!--[if lt IE 8]>\r\n   <div style='' clear: both; text-align:center; position: relative;''>\r\n     <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">\r\n       <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />\r\n    </a>\r\n  </div>\r\n<![endif]-->\r\n<!--[if lt IE 9]>\r\n	<script src="<?php echo THEME_PATH; ?>js/html5.js"></script>\r\n	<script src="<?php echo THEME_PATH; ?>js/css3-mediaqueries.js"></script>\r\n<![endif]-->\r\n\r\n<link rel="favourites icon" href="<?php echo THEME_PATH; ?>images/shortcut.gif" />', '2012-05-07 03:26:52', '2015-10-12 14:39:03', 1, 1, 1),
(3, 'menubar', NULL, '<?php include("menu.php");?>', '<?php include("menu.php");?>', '2012-05-06 06:00:12', '2015-09-04 09:51:05', 1, 1, 3),
(56, 'hidden-datefield', NULL, '<?php $next_day = date("Y-m-d",strtotime("+1 days ")); ?>\r\n<input type=hidden id="checkInDate" class="checkInDate" value="<?php echo date(''Y-m-d'') ?>" autocomplete="off">\r\n<input type=hidden id="checkOutDate" class="checkOutDate" value="<?php echo $next_day ?>" autocomplete="off">\r\n', '<?php $next_day = date("Y-m-d",strtotime("+1 days ")); ?>\r\n<input type=hidden id="checkInDate" class="checkInDate" value="<?php echo date(''Y-m-d'') ?>" autocomplete="off">\r\n<input type=hidden id="checkOutDate" class="checkOutDate" value="<?php echo $next_day ?>" autocomplete="off">\r\n', '2015-04-23 09:08:24', NULL, 4, NULL, NULL),
(4, 'mobile-menu', NULL, '<?php\r\n                       \r\nfunction snippet_mobilemenubar($page_submenu){\r\n\r\n    $out = ''''; \r\n    $count = count($page_submenu->children(array()));\r\n   \r\n    if ($count>0 && $page_submenu->id!=1){\r\n      $out .= ''<div><ul>'';             \r\n    }\r\n\r\n    foreach ($page_submenu->children(array()) as $menuPage){\r\n\r\n      if($menuPage->location==''top''){\r\n          \r\n          if($menuPage->level()==1){\r\n\r\n              if($menuPage->type=="link"){\r\n                  $out .= ''<div class="column">''.$menuPage->extlink(strtoupper($menuPage->title), '''' ,$menuPage->external_url).snippet_mobilemenubar($menuPage).''</div>'';           \r\n              } else {\r\n                  $out .= ''<div class="column">''.$menuPage->link(strtoupper($menuPage->title), '''').snippet_mobilemenubar($menuPage).''</div>'';\r\n              }  \r\n\r\n          }else if($menuPage->level()>1){\r\n\r\n              if($menuPage->type=="link"){\r\n                  $out .= ''<li>''.$menuPage->extlink(strtoupper($menuPage->title), '''' ,$menuPage->external_url).snippet_mobilemenubar($menuPage).''</li>'';           \r\n              } else {\r\n                  $out .= ''<li>''.$menuPage->link(strtoupper($menuPage->title), '''').snippet_mobilemenubar($menuPage).''</li>'';\r\n              }  \r\n\r\n          }\r\n      }\r\n\r\n    } \r\n\r\n    if ($count>0 && $page_submenu->id!=1){\r\n      $out .= ''</ul></div>'';             \r\n    } \r\n\r\n    return $out;\r\n}\r\n?> \r\n\r\n      <div id="menu" class="m-menu"> <div class="span">MENU <img src="<?php echo THEME_PATH ?>images/mob-but.gif" width=25 align="absmiddle" /></div>\r\n        <ul>\r\n          <li class="categories">\r\n            <div>\r\n	<div class="column"><a href="<?php echo URL_PUBLIC ?>">HOME</a></div>\r\n      <?php echo snippet_mobilemenubar($this->find(''/'')); ?>\r\n    <div  class="column"><a href="#">ONLINE BOOKING</a></div>\r\n            </div>\r\n          </li>\r\n        </ul>\r\n      </div>\r\n', '<?php\r\n                       \r\nfunction snippet_mobilemenubar($page_submenu){\r\n\r\n    $out = ''''; \r\n    $count = count($page_submenu->children(array()));\r\n   \r\n    if ($count>0 && $page_submenu->id!=1){\r\n      $out .= ''<div><ul>'';             \r\n    }\r\n\r\n    foreach ($page_submenu->children(array()) as $menuPage){\r\n\r\n      if($menuPage->location==''top''){\r\n          \r\n          if($menuPage->level()==1){\r\n\r\n              if($menuPage->type=="link"){\r\n                  $out .= ''<div class="column">''.$menuPage->extlink(strtoupper($menuPage->title), '''' ,$menuPage->external_url).snippet_mobilemenubar($menuPage).''</div>'';           \r\n              } else {\r\n                  $out .= ''<div class="column">''.$menuPage->link(strtoupper($menuPage->title), '''').snippet_mobilemenubar($menuPage).''</div>'';\r\n              }  \r\n\r\n          }else if($menuPage->level()>1){\r\n\r\n              if($menuPage->type=="link"){\r\n                  $out .= ''<li>''.$menuPage->extlink(strtoupper($menuPage->title), '''' ,$menuPage->external_url).snippet_mobilemenubar($menuPage).''</li>'';           \r\n              } else {\r\n                  $out .= ''<li>''.$menuPage->link(strtoupper($menuPage->title), '''').snippet_mobilemenubar($menuPage).''</li>'';\r\n              }  \r\n\r\n          }\r\n      }\r\n\r\n    } \r\n\r\n    if ($count>0 && $page_submenu->id!=1){\r\n      $out .= ''</ul></div>'';             \r\n    } \r\n\r\n    return $out;\r\n}\r\n?> \r\n\r\n      <div id="menu" class="m-menu"> <div class="span">MENU <img src="<?php echo THEME_PATH ?>images/mob-but.gif" width=25 align="absmiddle" /></div>\r\n        <ul>\r\n          <li class="categories">\r\n            <div>\r\n	<div class="column"><a href="<?php echo URL_PUBLIC ?>">HOME</a></div>\r\n      <?php echo snippet_mobilemenubar($this->find(''/'')); ?>\r\n    <div  class="column"><a href="#">ONLINE BOOKING</a></div>\r\n            </div>\r\n          </li>\r\n        </ul>\r\n      </div>\r\n', '2014-08-14 10:27:27', '2015-10-12 16:50:58', 3, 1, 4),
(5, 'main-banner', NULL, '    <div class="slider-wrapper theme-default">\r\n\r\n        <div id="slider" class="nivoSlider">\r\n            <?php\r\n            $oBanner = new Banner();\r\n            $banners = $oBanner->findAllFrom("Banner","type=''home'' AND location=''background'' AND status=1 order by sequence,id");\r\n            foreach($banners as $banner){\r\n               if($banner->external_url!=""){\r\n                  echo ''<a href="''.$banner->external_url.''" title="''.$banner->name.''" target="_blank"><img src="''.URL_PUBLIC.''public/banner/''.$banner->filename.''" style="width:100%;" title="#htmlcaption''.$banner->id.''" /></a>'';\r\n               }else{\r\n                  echo ''<img src="''.URL_PUBLIC.''public/banner/''.$banner->filename.''" style="width:100%;" title="#htmlcaption''.$banner->id.''" />'';\r\n               }\r\n            }       \r\n          \r\n          ?>   \r\n        </div>\r\n\r\n        <?php\r\n            foreach($banners as $banner){\r\n            echo ''<div id="htmlcaption''.$banner->id.''" class="nivo-html-caption">'';\r\n                echo ''<div>''.$banner->caption.''</div>'';\r\n            echo ''</div>'';\r\n            }\r\n        ?>\r\n        \r\n    </div>\r\n', '    <div class="slider-wrapper theme-default">\r\n\r\n        <div id="slider" class="nivoSlider">\r\n            <?php\r\n            $oBanner = new Banner();\r\n            $banners = $oBanner->findAllFrom("Banner","type=''home'' AND location=''background'' AND status=1 order by sequence,id");\r\n            foreach($banners as $banner){\r\n               if($banner->external_url!=""){\r\n                  echo ''<a href="''.$banner->external_url.''" title="''.$banner->name.''" target="_blank"><img src="''.URL_PUBLIC.''public/banner/''.$banner->filename.''" style="width:100%;" title="#htmlcaption''.$banner->id.''" /></a>'';\r\n               }else{\r\n                  echo ''<img src="''.URL_PUBLIC.''public/banner/''.$banner->filename.''" style="width:100%;" title="#htmlcaption''.$banner->id.''" />'';\r\n               }\r\n            }       \r\n          \r\n          ?>   \r\n        </div>\r\n\r\n        <?php\r\n            foreach($banners as $banner){\r\n            echo ''<div id="htmlcaption''.$banner->id.''" class="nivo-html-caption">'';\r\n                echo ''<div>''.$banner->caption.''</div>'';\r\n            echo ''</div>'';\r\n            }\r\n        ?>\r\n        \r\n    </div>\r\n', '2012-05-30 04:23:59', '2015-04-23 13:34:18', 1, 4, 7),
(7, 'booking-form', NULL, '<?php include(''wolf/frontend/booking-form.php'') ?>', '<?php include(''wolf/frontend/booking-form.php'') ?>', '2014-02-25 08:05:59', '2015-04-03 09:52:09', 2, 4, 5),
(9, 'inner-banner', NULL, '    <div class="slider-wrapper theme-default">\r\n\r\n        <div id="slider" class="nivoSlider">\r\n            <?php\r\n            $oBanner = new Banner();\r\n	    //Get from own page\r\n	    $banners = $oBanner->findAllFrom("Banner","type=''inner'' AND page_id=''".$this->id."'' AND status=1");\r\n\r\n	if(Record::countFrom("Banner","type=''inner'' AND page_id=''".$this->id."'' AND status=1") == 0){\r\n\r\n	   //Get from parent page\r\n	   $banners = $oBanner->findAllFrom("Banner","type=''inner'' AND page_id=''".$this->parent->id."'' AND status=1");\r\n\r\n	    if(Record::countFrom("Banner","type=''inner'' AND page_id=''".$this->parent->id."'' AND status=1") == 0){\r\n		//Get from Main page\r\n		$banners = $oBanner->findAllFrom("Banner","type=''home'' AND location=''background'' AND status=1 order by sequence");\r\n	    }\r\n	\r\n	}\r\n\r\n            foreach($banners as $banner){\r\n               if($banner->external_url!=""){\r\n                  echo ''<a href="''.$banner->external_url.''" title="''.$banner->name.''" target="_blank"><img src="''.URL_PUBLIC.''public/banner/''.$banner->filename.''" style="width:100%;" title="" /></a>'';\r\n               }else{\r\n                  echo ''<img src="''.URL_PUBLIC.''public/banner/''.$banner->filename.''" style="width:100%;" title="" />'';\r\n               }\r\n            }       \r\n          \r\n          ?>   \r\n        </div>\r\n\r\n        <?php\r\n            foreach($banners as $banner){\r\n            //echo ''<div id="htmlcaption''.$banner->id.''" class="nivo-html-caption">'';\r\n                //echo ''<p>''.$banner->caption.''</p>'';\r\n            //echo ''</div>'';\r\n            }\r\n        ?>\r\n        \r\n    </div>', '    <div class="slider-wrapper theme-default">\r\n\r\n        <div id="slider" class="nivoSlider">\r\n            <?php\r\n            $oBanner = new Banner();\r\n	    //Get from own page\r\n	    $banners = $oBanner->findAllFrom("Banner","type=''inner'' AND page_id=''".$this->id."'' AND status=1");\r\n\r\n	if(Record::countFrom("Banner","type=''inner'' AND page_id=''".$this->id."'' AND status=1") == 0){\r\n\r\n	   //Get from parent page\r\n	   $banners = $oBanner->findAllFrom("Banner","type=''inner'' AND page_id=''".$this->parent->id."'' AND status=1");\r\n\r\n	    if(Record::countFrom("Banner","type=''inner'' AND page_id=''".$this->parent->id."'' AND status=1") == 0){\r\n		//Get from Main page\r\n		$banners = $oBanner->findAllFrom("Banner","type=''home'' AND location=''background'' AND status=1 order by sequence");\r\n	    }\r\n	\r\n	}\r\n\r\n            foreach($banners as $banner){\r\n               if($banner->external_url!=""){\r\n                  echo ''<a href="''.$banner->external_url.''" title="''.$banner->name.''" target="_blank"><img src="''.URL_PUBLIC.''public/banner/''.$banner->filename.''" style="width:100%;" title="" /></a>'';\r\n               }else{\r\n                  echo ''<img src="''.URL_PUBLIC.''public/banner/''.$banner->filename.''" style="width:100%;" title="" />'';\r\n               }\r\n            }       \r\n          \r\n          ?>   \r\n        </div>\r\n\r\n        <?php\r\n            foreach($banners as $banner){\r\n            //echo ''<div id="htmlcaption''.$banner->id.''" class="nivo-html-caption">'';\r\n                //echo ''<p>''.$banner->caption.''</p>'';\r\n            //echo ''</div>'';\r\n            }\r\n        ?>\r\n        \r\n    </div>', '2014-02-27 02:08:26', '2015-10-16 02:44:21', 2, 1, 10),
(13, 'css-links', NULL, '<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1">\r\n<link type="text/css" href="<?php echo THEME_PATH ?>css/tablet.css" rel="stylesheet" media="only screen and (max-width: 1024px)">\r\n<link type="text/css" href="<?php echo THEME_PATH ?>css/tablet2.css" rel="stylesheet" media="only screen and (max-width: 900px)">\r\n<link type="text/css" href="<?php echo THEME_PATH ?>css/mobile.css" rel="stylesheet" media="only screen and (max-width: 700px)">\r\n<link type="text/css" href="<?php echo THEME_PATH ?>css/mobile2.css" rel="stylesheet" media="only screen and (max-width: 768px) and (max-height: 480px)">\r\n', '<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1">\r\n<link type="text/css" href="<?php echo THEME_PATH ?>css/tablet.css" rel="stylesheet" media="only screen and (max-width: 1024px)">\r\n<link type="text/css" href="<?php echo THEME_PATH ?>css/tablet2.css" rel="stylesheet" media="only screen and (max-width: 900px)">\r\n<link type="text/css" href="<?php echo THEME_PATH ?>css/mobile.css" rel="stylesheet" media="only screen and (max-width: 700px)">\r\n<link type="text/css" href="<?php echo THEME_PATH ?>css/mobile2.css" rel="stylesheet" media="only screen and (max-width: 768px) and (max-height: 480px)">\r\n', '2014-06-06 03:17:15', '2015-04-03 07:38:31', 1, 4, 18),
(14, 'sitemap', NULL, '<?php\r\nfunction snippet_sitemap2($parent)\r\n{\r\n    $out = '''';\r\n    $childs = $parent->children();\r\n    if (count($childs) > 0)\r\n    {\r\n        $out = ''<ul>'';\r\n        foreach ($childs as $child) {\r\n            if($child->location==''top''){\r\n              if ($child->id != 14){\r\n                $out .= ''<li>''.$child->link('''',url_match($child->breadcrumb) ? '''': '''').''</li>'';               \r\n              }\r\n            }\r\n        }\r\n        $out.= ''</ul>'';\r\n    }\r\n    return $out;\r\n}\r\n?>    \r\n\r\n<div id="sitemap">\r\n<?php echo snippet_sitemap2($this->find(''/'')); ?>\r\n</div>\r\n', '<?php\r\nfunction snippet_sitemap2($parent)\r\n{\r\n    $out = '''';\r\n    $childs = $parent->children();\r\n    if (count($childs) > 0)\r\n    {\r\n        $out = ''<ul>'';\r\n        foreach ($childs as $child) {\r\n            if($child->location==''top''){\r\n              if ($child->id != 14){\r\n                $out .= ''<li>''.$child->link('''',url_match($child->breadcrumb) ? '''': '''').''</li>'';               \r\n              }\r\n            }\r\n        }\r\n        $out.= ''</ul>'';\r\n    }\r\n    return $out;\r\n}\r\n?>    \r\n\r\n<div id="sitemap">\r\n<?php echo snippet_sitemap2($this->find(''/'')); ?>\r\n</div>\r\n', '2014-10-16 02:13:51', '2015-04-03 07:40:37', 1, 4, 19),
(63, 'room-list', NULL, '<?php include("room-list.php");?>', '<?php include("room-list.php");?>', '2015-09-07 17:41:37', NULL, 1, NULL, NULL),
(65, 'offers-list', NULL, '<?php include("offer-list.php");?>', '<?php include("offer-list.php");?>', '2015-09-08 12:46:18', '2015-09-08 13:09:28', 1, 1, NULL),
(66, 'fnb-list', NULL, '<?php include("fnb-list.php");?>', '<?php include("fnb-list.php");?>', '2015-09-09 14:35:06', NULL, 1, NULL, NULL),
(67, 'homepage-list', NULL, '<?php include("homepage-list.php");?>', '<?php include("homepage-list.php");?>', '2015-09-09 16:42:06', NULL, 1, NULL, NULL),
(54, 'mobile-booking', NULL, '<div id="booking-wrapper" class="mobile">\r\n	<div id="booking-form">\r\n		<?php $this->includeSnippet(''booking-form''); ?>\r\n	</div>\r\n</div>', '<div id="booking-wrapper" class="mobile">\r\n	<div id="booking-form">\r\n		<?php $this->includeSnippet(''booking-form''); ?>\r\n	</div>\r\n</div>', '2015-02-06 05:29:45', '2015-09-11 09:45:04', 1, 1, 6),
(61, 'nivo-slider', NULL, '<script src="<?php echo THEME_PATH; ?>js/jquery.min.js"></script>\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>js/nivoSlider/nivo-slider.css">\r\n<script src="<?php echo THEME_PATH; ?>js/nivoSlider/jquery.nivo.slider.js"></script>\r\n<script>\r\n  jQuery.noConflict();\r\n  jQuery(document).ready(function(){\r\n    if(jQuery(''.nivoSlider'').find(''img'').size()==1){\r\n\r\n      jQuery(''#slider'').nivoSlider({\r\n        effect:''fade'',\r\n        directionNav: false,\r\n        controlNav: false,\r\n        manualAdvance: true\r\n      });\r\n\r\n    }else{\r\n\r\n      jQuery(''#slider'').nivoSlider({\r\n        effect:''fade'',\r\n        pauseTime:5000,\r\n        controlNav: true,\r\n        controlNavThumbs : false\r\n      }); \r\n\r\n    }\r\n  });\r\n</script>', '<script src="<?php echo THEME_PATH; ?>js/jquery.min.js"></script>\r\n<link rel="stylesheet" href="<?php echo THEME_PATH; ?>js/nivoSlider/nivo-slider.css">\r\n<script src="<?php echo THEME_PATH; ?>js/nivoSlider/jquery.nivo.slider.js"></script>\r\n<script>\r\n  jQuery.noConflict();\r\n  jQuery(document).ready(function(){\r\n    if(jQuery(''.nivoSlider'').find(''img'').size()==1){\r\n\r\n      jQuery(''#slider'').nivoSlider({\r\n        effect:''fade'',\r\n        directionNav: false,\r\n        controlNav: false,\r\n        manualAdvance: true\r\n      });\r\n\r\n    }else{\r\n\r\n      jQuery(''#slider'').nivoSlider({\r\n        effect:''fade'',\r\n        pauseTime:5000,\r\n        controlNav: true,\r\n        controlNavThumbs : false\r\n      }); \r\n\r\n    }\r\n  });\r\n</script>', '2015-04-27 06:28:32', '2015-04-27 06:30:30', 1, 1, NULL),
(68, 'logo_form', NULL, '<?php include("logo_form.php");?>', '<?php include("logo_form.php");?>', '2015-10-10 16:51:08', NULL, 1, NULL, NULL),
(69, 'gallery', NULL, '    <div class="slider-wrapper theme-default">\r\n\r\n        <div id="slider" class="nivoSlider">\r\n            <?php\r\n            $oGallery= new Gallery();\r\n	  \r\n	    $galleries = $oGallery->findAllFrom("Gallery","1=1 ORDER BY sequence,id");\r\n\r\n	    if(count($galleries) > 0){\r\n\r\n            	foreach($galleries as $gallery){\r\n            \r\n                  	echo ''<img src="''.URL_PUBLIC.''public/gallery/images/''.$gallery->filename.''" style="width:100%;" title="" />'';\r\n               \r\n            	}       \r\n            }\r\n          ?>   \r\n        </div>\r\n        \r\n    </div>', '    <div class="slider-wrapper theme-default">\r\n\r\n        <div id="slider" class="nivoSlider">\r\n            <?php\r\n            $oGallery= new Gallery();\r\n	  \r\n	    $galleries = $oGallery->findAllFrom("Gallery","1=1 ORDER BY sequence,id");\r\n\r\n	    if(count($galleries) > 0){\r\n\r\n            	foreach($galleries as $gallery){\r\n            \r\n                  	echo ''<img src="''.URL_PUBLIC.''public/gallery/images/''.$gallery->filename.''" style="width:100%;" title="" />'';\r\n               \r\n            	}       \r\n            }\r\n          ?>   \r\n        </div>\r\n        \r\n    </div>', '2015-10-17 08:15:48', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_tag`
--

DROP TABLE IF EXISTS `wolf_tag`;
CREATE TABLE IF NOT EXISTS `wolf_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `count` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wolf_user`
--

DROP TABLE IF EXISTS `wolf_user`;
CREATE TABLE IF NOT EXISTS `wolf_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(1024) DEFAULT NULL,
  `salt` varchar(1024) DEFAULT NULL,
  `language` varchar(5) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_failure` datetime DEFAULT NULL,
  `failure_count` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `wolf_user`
--

INSERT INTO `wolf_user` (`id`, `name`, `email`, `username`, `password`, `salt`, `language`, `last_login`, `last_failure`, `failure_count`, `created_on`, `updated_on`, `created_by_id`, `updated_by_id`) VALUES
(1, 'Administrator', 'leslie_wongsk@webstergy.com', 'admin', '5f40f4ac119b38ff13949748e442ced011ed1fd3c5ae192a3747f697197855c1b042cfbf29b142c1f9260c0f5867c324ce2b612dd87f8e0d66c2b0ba7d198c25', '3c04f2235d2557cc04305e39f51dd513a852834ae350259eb888fd7e2c342c22', 'en', '2015-10-23 06:32:10', '2015-10-22 14:39:02', 0, '2012-04-25 03:00:05', '2015-10-23 06:32:10', 1, NULL),
(4, 'ks', NULL, 'okstmtcc', 'ce2a49a1b2d8e8e68684cd352f3676b4a1207db8d1953b156a8907d79005e231543144191a4d2996c70518f29041325788a0515d89efdc396baf991744bd81f4', '27cec0fefbf8735a5978782831a69e22b01e4dc73c8f36f8d2b329d768545e98', 'en', '2015-04-23 08:36:03', '2015-04-30 10:51:26', 1, '2015-03-04 00:00:00', '2015-04-30 10:51:26', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wolf_user_online`
--

DROP TABLE IF EXISTS `wolf_user_online`;
CREATE TABLE IF NOT EXISTS `wolf_user_online` (
  `ipaddress` varchar(15) NOT NULL,
  `lastactive` int(10) NOT NULL,
  PRIMARY KEY (`ipaddress`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wolf_user_role`
--

DROP TABLE IF EXISTS `wolf_user_role`;
CREATE TABLE IF NOT EXISTS `wolf_user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  UNIQUE KEY `user_id` (`user_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wolf_user_role`
--

INSERT INTO `wolf_user_role` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 3),
(4, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
