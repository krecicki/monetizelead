-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 04, 2021 at 07:55 PM
-- Server version: 5.5.62-cll
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haxorcobra`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `api_key` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `api_key`) VALUES
(1, 'ab3df-34fcf-34fab-9bc23-44af8');

-- --------------------------------------------------------

--
-- Table structure for table `app_keys`
--

CREATE TABLE `app_keys` (
  `id` int(11) NOT NULL,
  `stripe_secret_key` varchar(50) NOT NULL,
  `stripe_publishable_key` varchar(100) NOT NULL,
  `twilio_sid` varchar(100) NOT NULL,
  `twilio_auth_token` varchar(100) NOT NULL,
  `twilio_phone_number` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_keys`
--

INSERT INTO `app_keys` (`id`, `stripe_secret_key`, `stripe_publishable_key`, `twilio_sid`, `twilio_auth_token`, `twilio_phone_number`) VALUES
(1, 'stripe secret key', 'stripe publishable key', 'Twilio SID Here ex. AC81d67...', 'Twilio Auth Token Here .. ex. 796e83917963d8', 'Your Twilio Number +13472180000');

-- --------------------------------------------------------

--
-- Table structure for table `conversion_logs`
--

CREATE TABLE `conversion_logs` (
  `id` int(4) NOT NULL,
  `ip` varchar(39) NOT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `aff_id` int(4) NOT NULL,
  `click_hash` varchar(64) NOT NULL,
  `rdir_offerid` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_purchases`
--

CREATE TABLE `customer_purchases` (
  `id` int(11) NOT NULL,
  `stripeEmail_email_username` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Buyers stripe purchase email also login username.',
  `token` varchar(40) CHARACTER SET utf8 NOT NULL COMMENT 'Lead identification token generated on original lead form submit. ',
  `purchased_timestamp` int(11) DEFAULT NULL,
  `stripeToken` varchar(60) DEFAULT NULL,
  `units_sold` int(11) NOT NULL DEFAULT '0',
  `cost` decimal(10,0) DEFAULT '0',
  `phone_no` varchar(20) NOT NULL,
  `lead_types` varchar(200) NOT NULL,
  `notes` varchar(160) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_purchases`
--

INSERT INTO `customer_purchases` (`id`, `stripeEmail_email_username`, `token`, `purchased_timestamp`, `stripeToken`, `units_sold`, `cost`, `phone_no`, `lead_types`, `notes`) VALUES
(76, 'test@test.com', 'e2d296f0-4d61-462a-84de-061545d4156f', 1506377385, 'tok_BT0njnQOUH4fmm', 0, 0, '+17025240748', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `customer_reversals`
--

CREATE TABLE `customer_reversals` (
  `id` int(11) NOT NULL,
  `stripeEmail_email_username` varchar(255) NOT NULL,
  `token` varchar(40) NOT NULL,
  `purchased_timestamp` int(11) NOT NULL,
  `stripeToken` varchar(60) NOT NULL,
  `units_sold` int(11) NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `lead_types` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_reversals`
--

INSERT INTO `customer_reversals` (`id`, `stripeEmail_email_username`, `token`, `purchased_timestamp`, `stripeToken`, `units_sold`, `cost`, `phone_no`, `lead_types`) VALUES
(33, 'test@test.com', '9bc92481-e014-40fb-aef4-1ce10157705c', 1495823183, 'tok_AjFd4vGcfdvwbY', 0, 0, '+13097167555', '');

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `options` varchar(2000) NOT NULL,
  `required` int(11) NOT NULL,
  `profile` int(11) NOT NULL,
  `edit` int(11) NOT NULL,
  `help_text` varchar(500) NOT NULL,
  `register` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `custom_fields`
--

INSERT INTO `custom_fields` (`ID`, `name`, `type`, `options`, `required`, `profile`, `edit`, `help_text`, `register`) VALUES
(1, 'Company Name', 0, '', 0, 1, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `custom_settings`
--

CREATE TABLE `custom_settings` (
  `id` int(11) NOT NULL,
  `header_color` varchar(8) NOT NULL DEFAULT '#101010',
  `button_color` varchar(8) NOT NULL DEFAULT '#5cb85c',
  `button_hover_color` int(11) NOT NULL DEFAULT '444444',
  `button_border_color` varchar(8) NOT NULL DEFAULT '#4cae4c',
  `lead_sms_template` varchar(255) NOT NULL,
  `charge_sms_template` varchar(255) NOT NULL,
  `monetizecontact_background_color` varchar(255) DEFAULT NULL,
  `monetizecontact_redirect` varchar(255) DEFAULT NULL,
  `lead_cost` decimal(10,0) NOT NULL DEFAULT '10',
  `lead_rate_limit` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_settings`
--

INSERT INTO `custom_settings` (`id`, `header_color`, `button_color`, `button_hover_color`, `button_border_color`, `lead_sms_template`, `charge_sms_template`, `monetizecontact_background_color`, `monetizecontact_redirect`, `lead_cost`, `lead_rate_limit`) VALUES
(32, '273544', '888888', 444444, '666666', '|username|, you have |leadname| from the zipcode |leadzipcode| waiting for you to call or text. They just submitted this information moments ago. Buy the lead first here |leadurl|', 'Lead Purchase Receipt\r\nName: |leadname|\r\nEmail: |email|\r\nPhone: |phone|\r\nUnique Lead ID: |token|', 'FFFFFF', 'http://paste-a-website-address-here.com', 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `ID` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`ID`, `title`, `message`) VALUES
(1, 'Forgot Your Password', 'Dear [NAME],\r\n<br /><br />\r\nSomeone (hopefully you) requested a password reset at [SITE_URL].\r\n<br /><br />\r\nTo reset your password, please follow the following link: [EMAIL_LINK]\r\n<br /><br />\r\nIf you did not reset your password, please kindly ignore  this email.\r\n<br /><br />\r\nYours, <br />\r\n[SITE_NAME]'),
(2, 'Email Activation', 'Dear [NAME],\r\n<br /><br />\r\nSomeone (hopefully you) has registered an account on [SITE_NAME] using this email address.\r\n<br /><br />\r\nPlease activate the account by following this link: [EMAIL_LINK]\r\n<br /><br />\r\nIf you did not register an account, please kindly ignore  this email.\r\n<br /><br />\r\nYours, <br />\r\n[SITE_NAME]');

-- --------------------------------------------------------

--
-- Table structure for table `home_stats`
--

CREATE TABLE `home_stats` (
  `ID` int(11) NOT NULL,
  `google_members` int(11) NOT NULL DEFAULT '0',
  `facebook_members` int(11) NOT NULL DEFAULT '0',
  `twitter_members` int(11) NOT NULL DEFAULT '0',
  `total_members` int(11) NOT NULL DEFAULT '0',
  `new_members` int(11) NOT NULL DEFAULT '0',
  `active_today` int(11) NOT NULL DEFAULT '0',
  `timestamp` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `home_stats`
--

INSERT INTO `home_stats` (`ID`, `google_members`, `facebook_members`, `twitter_members`, `total_members`, `new_members`, `active_today`, `timestamp`) VALUES
(1, 0, 0, 0, 3, 0, 1, 1559262274);

-- --------------------------------------------------------

--
-- Table structure for table `ipn_log`
--

CREATE TABLE `ipn_log` (
  `ID` int(11) NOT NULL,
  `data` text,
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `IP` varchar(500) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ip_block`
--

CREATE TABLE `ip_block` (
  `ID` int(11) NOT NULL,
  `IP` varchar(500) NOT NULL DEFAULT '',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `reason` varchar(1000) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lead_types`
--

CREATE TABLE `lead_types` (
  `id` int(11) NOT NULL,
  `lead_type` varchar(50) NOT NULL,
  `cost` decimal(10,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lead_types`
--

INSERT INTO `lead_types` (`id`, `lead_type`, `cost`) VALUES
(5, 'test', 10),
(23, 'contactform', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `ID` int(11) NOT NULL,
  `IP` varchar(500) NOT NULL DEFAULT '',
  `username` varchar(500) NOT NULL DEFAULT '',
  `count` int(11) NOT NULL DEFAULT '0',
  `timestamp` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`ID`, `IP`, `username`, `count`, `timestamp`) VALUES
(1, '68.224.130.129', 'nina@krecicki.com', 1, 1494539140),
(2, '68.224.130.129', 'choiceinternetbrands@gmail.com', 1, 1494539145),
(3, '39.37.151.214', 'mshahbazsaleem@gmail.com', 2, 1494625708),
(4, '68.224.130.129', 'cody@krecicki.com', 1, 1494705562),
(5, '68.224.130.129', 'mshahbazsaleem@gmail.com', 1, 1494711600),
(6, '68.224.130.129', 'mshahbazsaleem@gmail.com', 3, 1495145451),
(7, '68.224.130.129', 'cck', 3, 1495206595),
(8, '68.224.130.129', 'krecicki.advertising@gmail.com', 2, 1495236391),
(9, '68.224.130.129', 'cck@krecicki.com', 1, 1495243645),
(10, '68.224.130.129', 'krecicki.advertising@gmail.com', 2, 1495243792),
(11, '68.224.130.129', 'krecicki.advertising@gmail.com', 1, 1495248980),
(12, '68.224.130.129', 'cck@krecicki.com', 1, 1495298768),
(13, '68.224.130.129', 'cck@krecicki.com', 1, 1495302642),
(14, '39.37.145.41', 'cck@krecicki.com', 1, 1495302733),
(15, '68.224.130.129', 'cib', 2, 1495406082),
(16, '107.77.228.156', 'cody@krecicki.com', 2, 1495480742),
(17, '68.224.130.129', 'cody@krecicki.com', 1, 1495503398),
(18, '73.28.32.180', 'santiz2009@gmail.com', 1, 1495592167),
(19, '68.224.130.129', 'cody@krecicki.com', 5, 1495662884),
(20, '68.224.130.129', 'krecicki.advertising@gmail.com', 2, 1495665395),
(21, '119.155.25.251', 'test', 1, 1495735994),
(22, '119.155.25.251', 'mshahbazsaleem@gmail.com', 3, 1495746584),
(23, '68.224.130.129', 'cody@krecicki.com', 2, 1495815870),
(24, '68.224.130.129', 'cody@krecicki.com', 1, 1495820304),
(25, '68.224.130.129', 'cody@krecicki.com', 1, 1495821476),
(26, '205.235.219.11', 'Philip', 1, 1495821530),
(27, '24.120.10.114', 'cody@krecicki.com', 1, 1506351072),
(28, '24.120.10.114', 'krecicki.advertising@gmail.com', 3, 1506353566),
(29, '174.223.3.1', 'leadgenerationsources@gmail.com', 1, 1508961460),
(30, '106.192.9.27', 'demo', 1, 1514996905),
(31, '59.94.153.28', 'demo', 1, 1515146928),
(32, '202.142.103.130', 'cody@krecicki.com', 4, 1515164291),
(33, '202.142.103.130', 'admin/admin', 1, 1515164318),
(34, '61.2.16.82', 'chouhan', 2, 1516634598),
(35, '202.142.125.15', 'demo', 1, 1517239432),
(36, '117.206.194.59', 'demo', 2, 1517240042),
(37, '98.160.215.180', 'krecicki.advertising@gmail.com', 2, 1520212627),
(38, '98.160.215.180', 'cody@krecicki.com', 1, 1524600999),
(39, '98.160.215.180', 'cody@krecicki.com', 1, 1532196243),
(40, '120.29.118.106', 'cody@krecicki.com', 1, 1557475626);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(4) NOT NULL,
  `ip` varchar(39) NOT NULL,
  `aff_id` int(4) NOT NULL,
  `click_hash` varchar(64) NOT NULL,
  `failed` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `ID` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL DEFAULT '',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `IP` varchar(500) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_logs`
--

CREATE TABLE `payment_logs` (
  `ID` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '0',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `email` varchar(500) NOT NULL DEFAULT '',
  `processor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_plans`
--

CREATE TABLE `payment_plans` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `hexcolor` varchar(6) NOT NULL DEFAULT '',
  `fontcolor` varchar(6) NOT NULL DEFAULT '',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `days` int(11) NOT NULL DEFAULT '0',
  `sales` int(11) NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pending_users`
--

CREATE TABLE `pending_users` (
  `token` char(40) NOT NULL,
  `username` varchar(45) NOT NULL,
  `tstamp` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

CREATE TABLE `questionnaire` (
  `id` int(4) UNSIGNED NOT NULL,
  `ip` varchar(35) NOT NULL,
  `timestamp` int(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `aff_id` varchar(10) NOT NULL,
  `click_hash` varchar(255) NOT NULL,
  `failed` int(1) NOT NULL,
  `token` char(40) NOT NULL,
  `units_sold` int(11) NOT NULL DEFAULT '0',
  `has_submitted` int(11) NOT NULL DEFAULT '0',
  `lead_types` varchar(200) NOT NULL,
  `notes` varchar(160) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questionnaire`
--

INSERT INTO `questionnaire` (`id`, `ip`, `timestamp`, `email`, `name`, `phone`, `aff_id`, `click_hash`, `failed`, `token`, `units_sold`, `has_submitted`, `lead_types`, `notes`) VALUES
(260, '73.28.32.180', 1495505543, 'Joe@joe.com', 'Joe', '2395954097', '', '', 0, '9d500a33-dfaf-4267-b747-19ad3c081df7', 0, 1, '', '0'),
(261, '68.224.130.101', 1495374925, 'phone@call.com', 'Phone Call', '8976753452', '', '', 0, '38878efb-ef0a-4956-b77f-1c2655d053cd', 0, 1, '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire_deleted`
--

CREATE TABLE `questionnaire_deleted` (
  `id` int(4) UNSIGNED NOT NULL,
  `ip` varchar(35) NOT NULL,
  `timestamp` int(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `aff_id` varchar(10) NOT NULL,
  `click_hash` varchar(255) NOT NULL,
  `failed` int(1) NOT NULL,
  `token` char(40) NOT NULL,
  `units_sold` int(11) NOT NULL DEFAULT '0',
  `has_submitted` int(11) NOT NULL DEFAULT '0',
  `deleted_timestamp` int(50) NOT NULL,
  `lead_types` varchar(200) NOT NULL,
  `notes` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reset_log`
--

CREATE TABLE `reset_log` (
  `ID` int(11) NOT NULL,
  `IP` varchar(500) NOT NULL DEFAULT '',
  `timestamp` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reset_log`
--

INSERT INTO `reset_log` (`ID`, `IP`, `timestamp`) VALUES
(1, '68.224.130.129', 1495206612),
(2, '68.224.130.129', 1495662940),
(3, '119.155.25.251', 1495736029),
(4, '98.160.215.180', 1537403899);

-- --------------------------------------------------------

--
-- Table structure for table `site_layouts`
--

CREATE TABLE `site_layouts` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `layout_path` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_layouts`
--

INSERT INTO `site_layouts` (`ID`, `name`, `layout_path`) VALUES
(1, 'Basic', 'layout/layout.php'),
(2, 'Titan', 'layout/titan_layout.php');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `ID` int(11) NOT NULL,
  `site_name` varchar(500) NOT NULL,
  `site_desc` varchar(500) NOT NULL,
  `upload_path` varchar(500) NOT NULL,
  `upload_path_relative` varchar(500) NOT NULL,
  `site_email` varchar(500) NOT NULL,
  `site_logo` varchar(1000) NOT NULL DEFAULT 'logo.png',
  `register` int(11) NOT NULL,
  `disable_captcha` int(11) NOT NULL,
  `date_format` varchar(25) NOT NULL,
  `avatar_upload` int(11) NOT NULL DEFAULT '1',
  `file_types` varchar(500) NOT NULL,
  `twitter_consumer_key` varchar(255) NOT NULL,
  `twitter_consumer_secret` varchar(255) NOT NULL,
  `disable_social_login` int(11) NOT NULL,
  `facebook_app_id` varchar(255) NOT NULL,
  `facebook_app_secret` varchar(255) NOT NULL,
  `google_client_id` varchar(255) NOT NULL,
  `google_client_secret` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  `paypal_email` varchar(1000) NOT NULL,
  `paypal_currency` varchar(100) NOT NULL DEFAULT 'USD',
  `payment_enabled` int(11) NOT NULL,
  `payment_symbol` varchar(5) NOT NULL DEFAULT '$',
  `global_premium` int(11) NOT NULL,
  `install` int(11) NOT NULL DEFAULT '1',
  `login_protect` int(11) NOT NULL,
  `activate_account` int(11) NOT NULL,
  `default_user_role` int(11) NOT NULL,
  `secure_login` int(11) NOT NULL,
  `stripe_secret_key` varchar(1000) NOT NULL,
  `stripe_publish_key` varchar(1000) NOT NULL,
  `google_recaptcha` int(11) NOT NULL,
  `google_recaptcha_secret` varchar(255) NOT NULL,
  `google_recaptcha_key` varchar(255) NOT NULL,
  `logo_option` int(11) NOT NULL,
  `layout` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`ID`, `site_name`, `site_desc`, `upload_path`, `upload_path_relative`, `site_email`, `site_logo`, `register`, `disable_captcha`, `date_format`, `avatar_upload`, `file_types`, `twitter_consumer_key`, `twitter_consumer_secret`, `disable_social_login`, `facebook_app_id`, `facebook_app_secret`, `google_client_id`, `google_client_secret`, `file_size`, `paypal_email`, `paypal_currency`, `payment_enabled`, `payment_symbol`, `global_premium`, `install`, `login_protect`, `activate_account`, `default_user_role`, `secure_login`, `stripe_secret_key`, `stripe_publish_key`, `google_recaptcha`, `google_recaptcha_secret`, `google_recaptcha_key`, `logo_option`, `layout`) VALUES
(1, 'Monetize Lead Lead Sales App', 'Buy real-time leads by text message.', 'uploads', 'uploads', 'cody@choiceinternetbrands.com', '4ef5f6207612ca28ac6cb21a5f4ee191.png', 0, 1, 'm/d/y', 1, 'gif|png|jpg|jpeg', '', '', 1, '', '', '', '', 1028, '', 'USD', 0, '$', 0, 0, 1, 0, 5, 1, '', '', 0, '', '', 1, 'layout/layout.php');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `token` varchar(255) NOT NULL DEFAULT '',
  `customer_ID` varchar(255) NOT NULL DEFAULT '',
  `IP` varchar(500) NOT NULL DEFAULT '',
  `username` varchar(25) NOT NULL DEFAULT '',
  `first_name` varchar(25) NOT NULL DEFAULT '',
  `last_name` varchar(25) NOT NULL DEFAULT '',
  `avatar` varchar(1000) NOT NULL DEFAULT 'default.png',
  `joined` int(11) NOT NULL DEFAULT '0',
  `joined_date` varchar(10) NOT NULL DEFAULT '',
  `online_timestamp` int(11) NOT NULL DEFAULT '0',
  `oauth_provider` varchar(40) NOT NULL DEFAULT '',
  `oauth_id` varchar(1000) NOT NULL DEFAULT '',
  `oauth_token` varchar(1500) NOT NULL DEFAULT '',
  `oauth_secret` varchar(500) NOT NULL DEFAULT '',
  `email_notification` int(11) NOT NULL DEFAULT '1',
  `aboutme` varchar(1000) NOT NULL DEFAULT '',
  `points` decimal(10,2) NOT NULL DEFAULT '0.00',
  `premium_time` int(11) NOT NULL DEFAULT '0',
  `user_role` int(11) NOT NULL DEFAULT '0',
  `premium_planid` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `activate_code` varchar(255) NOT NULL DEFAULT '',
  `phone_no` varchar(20) NOT NULL,
  `stripe_subscription_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `email`, `password`, `token`, `customer_ID`, `IP`, `username`, `first_name`, `last_name`, `avatar`, `joined`, `joined_date`, `online_timestamp`, `oauth_provider`, `oauth_id`, `oauth_token`, `oauth_secret`, `email_notification`, `aboutme`, `points`, `premium_time`, `user_role`, `premium_planid`, `active`, `activate_code`, `phone_no`, `stripe_subscription_id`) VALUES
(1, 'cody@krecicki.com', '$2a$12$1f9b0exRLoBs0RqeU4MkTu1v/0YYRtIPC0suHDwvtMokapI6xnoRW', '91b7312b41daaf2d3120d659b5e5bf48', '', '68.224.130.129', 'admin', 'Admin', 'User', '268e456bdc85786fc5c77b6a93c31a29.jpg', 1494353114, '5-2017', 1559262274, '', '', '', '', 1, '', 0.00, 0, 1, 0, 0, '', '', ''),
(9, 'krecicki.advertising@gmail.com', '$2a$12$tehKZraDQbh57lPBfIUJW.eWz5feDBfD3RniFYLyu5Bqgke5SKGOC', '3539dd06bb4fc6c346f7279818fcc27d', '', '68.224.130.129', 'dev2', 'Cody', 'Krecicki', '075a2b3dd20c4692bb212962b583a545.png', 1495207801, '5-2017', 1520985796, '', '', '', '', 1, '', 0.00, 0, 5, 0, 1, '', '+17025240748', ''),
(10, 'cody123@krecicki.com', '$2a$12$L9vTv0.nzVS0eKKCzTXuM.I1eB8tsqLICGZtejm6X.Q0HzCsaPSRW', '', '', '98.160.215.180', 'billy', 'Cody', 'Krecicki', 'default.png', 1534471363, '8-2018', 0, '', '', '', '', 1, '', 0.00, 0, 5, 0, 1, '', '+17025240748', ''),
(11, 'test@gmail.com', '$2a$12$7aDRqGH..f/RIPNzyemUk.9dAl2zJYW.BG6fF8DnIxBZJOBmYJNZa', '', 'cus_KHgHve616etEAB', '51.81.153.23', 'haxorcobra', 'Gina', 'Burgess', 'default.png', 1632461178, '09-2021', 0, '', '', '', '', 1, '', 0.00, 0, 1, 0, 1, '', '8564855744', 'si_KHgHanTlgNyaAx');

-- --------------------------------------------------------

--
-- Table structure for table `user_custom_fields`
--

CREATE TABLE `user_custom_fields` (
  `ID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `fieldid` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_custom_fields`
--

INSERT INTO `user_custom_fields` (`ID`, `userid`, `fieldid`, `value`) VALUES
(1, 6, 1, ''),
(2, 7, 1, 'Choice Internet Brands, Inc.'),
(3, 8, 1, 'CIB'),
(4, 9, 1, 'CIB'),
(5, 12, 1, 'Zab'),
(6, 14, 1, 'Rebel Yell Agency'),
(7, 15, 1, 'ZRE Enterprises Inc'),
(8, 16, 1, 'OnlineMommy247,LLC'),
(9, 1, 1, ''),
(10, 10, 1, 'catmouse');

-- --------------------------------------------------------

--
-- Table structure for table `user_events`
--

CREATE TABLE `user_events` (
  `ID` int(11) NOT NULL,
  `IP` varchar(255) NOT NULL DEFAULT '',
  `event` varchar(255) NOT NULL DEFAULT '',
  `timestamp` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `ID` int(11) NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  `default` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`ID`, `name`, `default`) VALUES
(1, 'Default Group', 1),
(2, 'Insurance Buyers', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_users`
--

CREATE TABLE `user_group_users` (
  `ID` int(11) NOT NULL,
  `groupid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group_users`
--

INSERT INTO `user_group_users` (`ID`, `groupid`, `userid`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4),
(4, 1, 5),
(5, 1, 6),
(6, 1, 7),
(7, 1, 8),
(8, 1, 9),
(9, 1, 12),
(10, 1, 14),
(11, 1, 15),
(12, 1, 16),
(13, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_lead_types`
--

CREATE TABLE `user_lead_types` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lead_type_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_lead_types`
--

INSERT INTO `user_lead_types` (`id`, `user_id`, `lead_type_id`) VALUES
(15, 7, 1),
(29, 9, 23),
(6, 8, 1),
(27, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `admin` int(11) NOT NULL DEFAULT '0',
  `admin_settings` int(11) NOT NULL DEFAULT '0',
  `admin_members` int(11) NOT NULL DEFAULT '0',
  `admin_payment` int(11) NOT NULL DEFAULT '0',
  `banned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`ID`, `name`, `admin`, `admin_settings`, `admin_members`, `admin_payment`, `banned`) VALUES
(1, 'Admin', 1, 0, 0, 0, 0),
(2, 'Member Manager', 0, 0, 1, 0, 0),
(3, 'Admin Settings', 0, 1, 0, 0, 0),
(5, 'Member', 0, 0, 0, 0, 0),
(6, 'Banned', 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_customer_purchases`
-- (See below for the actual view)
--
CREATE TABLE `v_customer_purchases` (
`cost` decimal(10,0)
,`purchase_date` varchar(7)
,`phone_no` varchar(20)
,`lead_types` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_lead_purchases`
-- (See below for the actual view)
--
CREATE TABLE `v_lead_purchases` (
`id` int(11)
,`email` varchar(100)
,`name` varchar(255)
,`phone` varchar(20)
,`aff_id` varchar(10)
,`token` char(40)
,`purchased_date` varchar(40)
,`phone_no` varchar(20)
,`lead_types` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_lead_reversals`
-- (See below for the actual view)
--
CREATE TABLE `v_lead_reversals` (
`id` int(11)
,`email` varchar(100)
,`name` varchar(255)
,`phone` varchar(20)
,`aff_id` varchar(10)
,`token` char(40)
,`purchased_date` varchar(40)
,`phone_no` varchar(20)
,`lead_types` varchar(200)
);

-- --------------------------------------------------------

--
-- Structure for view `v_customer_purchases`
--
DROP TABLE IF EXISTS `v_customer_purchases`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_customer_purchases`  AS  select `customer_purchases`.`cost` AS `cost`,date_format(from_unixtime(`customer_purchases`.`purchased_timestamp`),'%c-%Y') AS `purchase_date`,`customer_purchases`.`phone_no` AS `phone_no`,`customer_purchases`.`lead_types` AS `lead_types` from `customer_purchases` ;

-- --------------------------------------------------------

--
-- Structure for view `v_lead_purchases`
--
DROP TABLE IF EXISTS `v_lead_purchases`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_lead_purchases`  AS  select `customer_purchases`.`id` AS `id`,`questionnaire`.`email` AS `email`,`questionnaire`.`name` AS `name`,`questionnaire`.`phone` AS `phone`,`questionnaire`.`aff_id` AS `aff_id`,`questionnaire`.`token` AS `token`,date_format(from_unixtime(`customer_purchases`.`purchased_timestamp`),'%Y/%b/%d') AS `purchased_date`,`customer_purchases`.`phone_no` AS `phone_no`,`questionnaire`.`lead_types` AS `lead_types` from (`questionnaire` join `customer_purchases` on((`questionnaire`.`token` = `customer_purchases`.`token`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_lead_reversals`
--
DROP TABLE IF EXISTS `v_lead_reversals`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_lead_reversals`  AS  select `customer_reversals`.`id` AS `id`,`questionnaire`.`email` AS `email`,`questionnaire`.`name` AS `name`,`questionnaire`.`phone` AS `phone`,`questionnaire`.`aff_id` AS `aff_id`,`questionnaire`.`token` AS `token`,date_format(from_unixtime(`customer_reversals`.`purchased_timestamp`),'%Y/%b/%d') AS `purchased_date`,`customer_reversals`.`phone_no` AS `phone_no`,`customer_reversals`.`lead_types` AS `lead_types` from (`questionnaire` join `customer_reversals` on((`questionnaire`.`token` = convert(`customer_reversals`.`token` using utf8)))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_keys`
--
ALTER TABLE `app_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversion_logs`
--
ALTER TABLE `conversion_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_purchases`
--
ALTER TABLE `customer_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_reversals`
--
ALTER TABLE `customer_reversals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `custom_settings`
--
ALTER TABLE `custom_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `home_stats`
--
ALTER TABLE `home_stats`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ipn_log`
--
ALTER TABLE `ipn_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ip_block`
--
ALTER TABLE `ip_block`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lead_types`
--
ALTER TABLE `lead_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payment_plans`
--
ALTER TABLE `payment_plans`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pending_users`
--
ALTER TABLE `pending_users`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionnaire_deleted`
--
ALTER TABLE `questionnaire_deleted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_log`
--
ALTER TABLE `reset_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `site_layouts`
--
ALTER TABLE `site_layouts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_custom_fields`
--
ALTER TABLE `user_custom_fields`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_events`
--
ALTER TABLE `user_events`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_group_users`
--
ALTER TABLE `user_group_users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_lead_types`
--
ALTER TABLE `user_lead_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app_keys`
--
ALTER TABLE `app_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `conversion_logs`
--
ALTER TABLE `conversion_logs`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_purchases`
--
ALTER TABLE `customer_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `customer_reversals`
--
ALTER TABLE `customer_reversals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `custom_settings`
--
ALTER TABLE `custom_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_stats`
--
ALTER TABLE `home_stats`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ipn_log`
--
ALTER TABLE `ipn_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ip_block`
--
ALTER TABLE `ip_block`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_types`
--
ALTER TABLE `lead_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_logs`
--
ALTER TABLE `payment_logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_plans`
--
ALTER TABLE `payment_plans`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `questionnaire_deleted`
--
ALTER TABLE `questionnaire_deleted`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reset_log`
--
ALTER TABLE `reset_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_custom_fields`
--
ALTER TABLE `user_custom_fields`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_events`
--
ALTER TABLE `user_events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_group_users`
--
ALTER TABLE `user_group_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_lead_types`
--
ALTER TABLE `user_lead_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
