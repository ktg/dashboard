-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2013 at 11:51 AM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wordpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_anythingpopup`
--

CREATE TABLE IF NOT EXISTS `wp_anythingpopup` (
  `pop_id` int(11) NOT NULL AUTO_INCREMENT,
  `pop_width` int(11) NOT NULL DEFAULT '380',
  `pop_height` int(11) NOT NULL DEFAULT '260',
  `pop_headercolor` varchar(10) NOT NULL DEFAULT '#4D4D4D',
  `pop_bordercolor` varchar(10) NOT NULL DEFAULT '#4D4D4D',
  `pop_header_fontcolor` varchar(10) NOT NULL DEFAULT '#FFFFFF',
  `pop_title` varchar(1024) NOT NULL DEFAULT 'Anything Popup',
  `pop_content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pop_caption` varchar(2024) NOT NULL DEFAULT 'Click to open popup',
  PRIMARY KEY (`pop_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_anythingpopup`
--

INSERT INTO `wp_anythingpopup` (`pop_id`, `pop_width`, `pop_height`, `pop_headercolor`, `pop_bordercolor`, `pop_header_fontcolor`, `pop_title`, `pop_content`, `pop_caption`) VALUES
(1, 380, 260, '#4D4D4D', '#4D4D4D', '#FFFFFF', 'Anything Popup', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'Click to open popup');

-- --------------------------------------------------------

--
-- Table structure for table `wp_commentmeta`
--

CREATE TABLE IF NOT EXISTS `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wp_commentmeta`
--


-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

CREATE TABLE IF NOT EXISTS `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Mr WordPress', '', 'http://wordpress.org/', '', '2013-05-04 17:16:05', '2013-05-04 17:16:05', 'Hi, this is a comment.\nTo delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.', 0, '1', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

CREATE TABLE IF NOT EXISTS `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wp_links`
--


-- --------------------------------------------------------

--
-- Table structure for table `wp_onclick_show_popup`
--

CREATE TABLE IF NOT EXISTS `wp_onclick_show_popup` (
  `OnclickShowPopup_id` int(11) NOT NULL AUTO_INCREMENT,
  `OnclickShowPopup_title` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `OnclickShowPopup_text` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `OnclickShowPopup_status` char(3) NOT NULL DEFAULT 'No',
  `OnclickShowPopup_group` varchar(100) NOT NULL,
  `OnclickShowPopup_extra1` varchar(100) NOT NULL,
  `OnclickShowPopup_extra2` varchar(100) NOT NULL,
  `OnclickShowPopup_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`OnclickShowPopup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `wp_onclick_show_popup`
--

INSERT INTO `wp_onclick_show_popup` (`OnclickShowPopup_id`, `OnclickShowPopup_title`, `OnclickShowPopup_text`, `OnclickShowPopup_status`, `OnclickShowPopup_group`, `OnclickShowPopup_extra1`, `OnclickShowPopup_extra2`, `OnclickShowPopup_date`) VALUES
(1, 'This is the demo for Onclick show popup plugin.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'YES', 'Group1', '', '', '0000-00-00 00:00:00'),
(2, 'This is the demo for Onclick show popup plugin.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'YES', 'Group1', '', '', '0000-00-00 00:00:00'),
(3, 'This is the demo for Onclick show popup plugin.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'YES', 'Group1', '', '', '0000-00-00 00:00:00'),
(4, 'This is the demo for Onclick show popup plugin.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'YES', 'Group1', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wp_options`
--

CREATE TABLE IF NOT EXISTS `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=287 ;

--
-- Dumping data for table `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://dashboard.markisonline.co.uk', 'no'),
(2, 'blogname', 'wordpress', 'yes'),
(3, 'blogdescription', 'Your Dashboard for your business', 'yes'),
(4, 'users_can_register', '1', 'yes'),
(5, 'admin_email', '362531@gmail.com', 'yes'),
(6, 'start_of_week', '1', 'yes'),
(7, 'use_balanceTags', '0', 'yes'),
(8, 'use_smilies', '1', 'yes'),
(9, 'require_name_email', '1', 'yes'),
(10, 'comments_notify', '1', 'yes'),
(11, 'posts_per_rss', '10', 'yes'),
(12, 'rss_use_excerpt', '0', 'yes'),
(13, 'mailserver_url', 'mail.example.com', 'yes'),
(14, 'mailserver_login', 'login@example.com', 'yes'),
(15, 'mailserver_pass', 'password', 'yes'),
(16, 'mailserver_port', '110', 'yes'),
(17, 'default_category', '1', 'yes'),
(18, 'default_comment_status', 'open', 'yes'),
(19, 'default_ping_status', 'open', 'yes'),
(20, 'default_pingback_flag', '1', 'yes'),
(21, 'posts_per_page', '10', 'yes'),
(22, 'date_format', 'F j, Y', 'yes'),
(23, 'time_format', 'g:i a', 'yes'),
(24, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(25, 'links_recently_updated_prepend', '<em>', 'yes'),
(26, 'links_recently_updated_append', '</em>', 'yes'),
(27, 'links_recently_updated_time', '120', 'yes'),
(28, 'comment_moderation', '0', 'yes'),
(29, 'moderation_notify', '1', 'yes'),
(30, 'permalink_structure', '/%postname%/', 'yes'),
(31, 'gzipcompression', '0', 'yes'),
(32, 'hack_file', '0', 'yes'),
(33, 'blog_charset', 'UTF-8', 'yes'),
(34, 'moderation_keys', '', 'no'),
(35, 'active_plugins', 'a:1:{i:0;s:33:"anything-popup/anything-popup.php";}', 'yes'),
(36, 'home', 'http://dashboard.markisonline.co.uk', 'yes'),
(37, 'category_base', '', 'yes'),
(38, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(39, 'advanced_edit', '0', 'yes'),
(40, 'comment_max_links', '2', 'yes'),
(41, 'gmt_offset', '0', 'yes'),
(42, 'default_email_category', '1', 'yes'),
(43, 'recently_edited', '', 'no'),
(44, 'template', 'twentytwelve', 'yes'),
(45, 'stylesheet', 'twentytwelve', 'yes'),
(46, 'comment_whitelist', '1', 'yes'),
(47, 'blacklist_keys', '', 'no'),
(48, 'comment_registration', '0', 'yes'),
(49, 'html_type', 'text/html', 'yes'),
(50, 'use_trackback', '0', 'yes'),
(51, 'default_role', 'subscriber', 'yes'),
(52, 'db_version', '22441', 'yes'),
(53, 'uploads_use_yearmonth_folders', '1', 'yes'),
(54, 'upload_path', '', 'yes'),
(55, 'blog_public', '1', 'yes'),
(56, 'default_link_category', '2', 'yes'),
(57, 'show_on_front', 'page', 'yes'),
(58, 'tag_base', '', 'yes'),
(59, 'show_avatars', '1', 'yes'),
(60, 'avatar_rating', 'G', 'yes'),
(61, 'upload_url_path', '', 'yes'),
(62, 'thumbnail_size_w', '150', 'yes'),
(63, 'thumbnail_size_h', '150', 'yes'),
(64, 'thumbnail_crop', '1', 'yes'),
(65, 'medium_size_w', '300', 'yes'),
(66, 'medium_size_h', '300', 'yes'),
(67, 'avatar_default', 'mystery', 'yes'),
(68, 'large_size_w', '1024', 'yes'),
(69, 'large_size_h', '1024', 'yes'),
(70, 'image_default_link_type', 'file', 'yes'),
(71, 'image_default_size', '', 'yes'),
(72, 'image_default_align', '', 'yes'),
(73, 'close_comments_for_old_posts', '0', 'yes'),
(74, 'close_comments_days_old', '14', 'yes'),
(75, 'thread_comments', '1', 'yes'),
(76, 'thread_comments_depth', '5', 'yes'),
(77, 'page_comments', '0', 'yes'),
(78, 'comments_per_page', '50', 'yes'),
(79, 'default_comments_page', 'newest', 'yes'),
(80, 'comment_order', 'asc', 'yes'),
(81, 'sticky_posts', 'a:0:{}', 'yes'),
(82, 'widget_categories', 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(83, 'widget_text', 'a:0:{}', 'yes'),
(84, 'widget_rss', 'a:0:{}', 'yes'),
(85, 'uninstall_plugins', 'a:1:{s:29:"lightbox-pop/lightbox-pop.php";s:11:"lbx_destroy";}', 'no'),
(86, 'timezone_string', '', 'yes'),
(87, 'page_for_posts', '0', 'yes'),
(88, 'page_on_front', '6', 'yes'),
(89, 'default_post_format', '0', 'yes'),
(90, 'link_manager_enabled', '0', 'yes'),
(91, 'initial_db_version', '22441', 'yes'),
(92, 'wp_user_roles', 'a:5:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:62:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:9:"add_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}}', 'yes'),
(93, 'widget_search', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(94, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(95, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(96, 'widget_archives', 'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(97, 'widget_meta', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(98, 'sidebars_widgets', 'a:5:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar-2";a:0:{}s:9:"sidebar-3";a:0:{}s:13:"array_version";i:3;}', 'yes'),
(99, 'cron', 'a:4:{i:1368377849;a:1:{s:30:"wp_scheduled_auto_draft_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1368378968;a:3:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1368378997;a:1:{s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}s:7:"version";i:2;}', 'yes'),
(101, '_site_transient_update_core', 'O:8:"stdClass":3:{s:7:"updates";a:1:{i:0;O:8:"stdClass":9:{s:8:"response";s:6:"latest";s:8:"download";s:40:"http://wordpress.org/wordpress-3.5.1.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":4:{s:4:"full";s:40:"http://wordpress.org/wordpress-3.5.1.zip";s:10:"no_content";s:51:"http://wordpress.org/wordpress-3.5.1-no-content.zip";s:11:"new_bundled";s:52:"http://wordpress.org/wordpress-3.5.1-new-bundled.zip";s:7:"partial";b:0;}s:7:"current";s:5:"3.5.1";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"3.5";s:15:"partial_version";s:0:"";}}s:12:"last_checked";i:1368335803;s:15:"version_checked";s:5:"3.5.1";}', 'yes'),
(102, '_site_transient_update_plugins', 'O:8:"stdClass":3:{s:12:"last_checked";i:1368334354;s:7:"checked";a:2:{s:33:"anything-popup/anything-popup.php";s:3:"4.1";s:9:"hello.php";s:3:"1.6";}s:8:"response";a:0:{}}', 'yes'),
(284, '_site_transient_timeout_theme_roots', '1368336154', 'yes'),
(285, '_site_transient_theme_roots', 'a:1:{s:12:"twentytwelve";s:7:"/themes";}', 'yes'),
(255, '_site_transient_update_themes', 'O:8:"stdClass":3:{s:12:"last_checked";i:1368334354;s:7:"checked";a:1:{s:12:"twentytwelve";s:3:"1.1";}s:8:"response";a:0:{}}', 'yes'),
(106, 'dashboard_widget_options', 'a:4:{s:25:"dashboard_recent_comments";a:1:{s:5:"items";i:5;}s:24:"dashboard_incoming_links";a:5:{s:4:"home";s:26:"http://dashboard.markisonline.co.uk/wordpress";s:4:"link";s:102:"http://blogsearch.google.com/blogsearch?scoring=d&partner=wordpress&q=link:http://dashboard.markisonline.co.uk/";s:3:"url";s:135:"http://blogsearch.google.com/blogsearch_feeds?scoring=d&ie=utf-8&num=10&output=rss&partner=wordpress&q=link:http://dashboard.markisonline.co.uk/";s:5:"items";i:10;s:9:"show_date";b:0;}s:17:"dashboard_primary";a:7:{s:4:"link";s:26:"http://wordpress.org/news/";s:3:"url";s:31:"http://wordpress.org/news/feed/";s:5:"title";s:14:"WordPress Blog";s:5:"items";i:2;s:12:"show_summary";i:1;s:11:"show_author";i:0;s:9:"show_date";i:1;}s:19:"dashboard_secondary";a:7:{s:4:"link";s:28:"http://planet.wordpress.org/";s:3:"url";s:33:"http://planet.wordpress.org/feed/";s:5:"title";s:20:"Other WordPress News";s:5:"items";i:5;s:12:"show_summary";i:0;s:11:"show_author";i:0;s:9:"show_date";i:0;}}', 'yes'),
(107, 'can_compress_scripts', '1', 'yes'),
(266, '_transient_timeout_plugin_slugs', '1368291438', 'no'),
(267, '_transient_plugin_slugs', 'a:2:{i:0;s:33:"anything-popup/anything-popup.php";i:1;s:9:"hello.php";}', 'no'),
(268, '_transient_timeout_dash_de3249c4736ad3bd2cd29147c4a0d43e', '1368248238', 'no'),
(110, 'recently_activated', 'a:3:{s:41:"onclick-show-popup/onclick-show-popup.php";i:1367735073;s:29:"lightbox-pop/lightbox-pop.php";i:1367728232;s:41:"wp-jquery-lightbox/wp-jquery-lightbox.php";i:1367694250;}', 'yes'),
(252, '_site_transient_timeout_wporg_theme_feature_list', '1367953159', 'yes'),
(253, '_site_transient_wporg_theme_feature_list', 'a:0:{}', 'yes'),
(207, '_site_transient_timeout_browser_8596578b01c1fef7e847e027bea10b85', '1368498786', 'yes'),
(208, '_site_transient_browser_8596578b01c1fef7e847e027bea10b85', 'a:9:{s:8:"platform";s:7:"Windows";s:4:"name";s:7:"Firefox";s:7:"version";s:6:"3.6.11";s:10:"update_url";s:23:"http://www.firefox.com/";s:7:"img_src";s:50:"http://s.wordpress.org/images/browsers/firefox.png";s:11:"img_src_ssl";s:49:"https://wordpress.org/images/browsers/firefox.png";s:15:"current_version";s:2:"16";s:7:"upgrade";b:1;s:8:"insecure";b:0;}', 'yes'),
(273, 'rewrite_rules', 'a:69:{s:47:"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:42:"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:35:"category/(.+?)/page/?([0-9]{1,})/?$";s:53:"index.php?category_name=$matches[1]&paged=$matches[2]";s:17:"category/(.+?)/?$";s:35:"index.php?category_name=$matches[1]";s:44:"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:39:"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:32:"tag/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?tag=$matches[1]&paged=$matches[2]";s:14:"tag/([^/]+)/?$";s:25:"index.php?tag=$matches[1]";s:45:"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:40:"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:33:"type/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?post_format=$matches[1]&paged=$matches[2]";s:15:"type/([^/]+)/?$";s:33:"index.php?post_format=$matches[1]";s:48:".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$";s:18:"index.php?feed=old";s:20:".*wp-app\\.php(/.*)?$";s:19:"index.php?error=403";s:18:".*wp-register.php$";s:23:"index.php?register=true";s:32:"feed/(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:27:"(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:20:"page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:27:"comment-page-([0-9]{1,})/?$";s:38:"index.php?&page_id=6&cpage=$matches[1]";s:41:"comments/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:36:"comments/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:29:"comments/page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:44:"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:39:"search/(.+)/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:32:"search/(.+)/page/?([0-9]{1,})/?$";s:41:"index.php?s=$matches[1]&paged=$matches[2]";s:14:"search/(.+)/?$";s:23:"index.php?s=$matches[1]";s:47:"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:42:"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:35:"author/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?author_name=$matches[1]&paged=$matches[2]";s:17:"author/([^/]+)/?$";s:33:"index.php?author_name=$matches[1]";s:69:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]";s:39:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$";s:63:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]";s:56:"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:51:"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:44:"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]";s:26:"([0-9]{4})/([0-9]{1,2})/?$";s:47:"index.php?year=$matches[1]&monthnum=$matches[2]";s:43:"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:38:"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:31:"([0-9]{4})/page/?([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&paged=$matches[2]";s:13:"([0-9]{4})/?$";s:26:"index.php?year=$matches[1]";s:27:".?.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:".?.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:20:"(.?.+?)/trackback/?$";s:35:"index.php?pagename=$matches[1]&tb=1";s:40:"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:35:"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:28:"(.?.+?)/page/?([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&paged=$matches[2]";s:35:"(.?.+?)/comment-page-([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&cpage=$matches[2]";s:20:"(.?.+?)(/[0-9]+)?/?$";s:47:"index.php?pagename=$matches[1]&page=$matches[2]";s:27:"[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:"[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:20:"([^/]+)/trackback/?$";s:31:"index.php?name=$matches[1]&tb=1";s:40:"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?name=$matches[1]&feed=$matches[2]";s:35:"([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?name=$matches[1]&feed=$matches[2]";s:28:"([^/]+)/page/?([0-9]{1,})/?$";s:44:"index.php?name=$matches[1]&paged=$matches[2]";s:35:"([^/]+)/comment-page-([0-9]{1,})/?$";s:44:"index.php?name=$matches[1]&cpage=$matches[2]";s:20:"([^/]+)(/[0-9]+)?/?$";s:43:"index.php?name=$matches[1]&page=$matches[2]";s:16:"[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:26:"[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:46:"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:41:"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:41:"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";}', 'yes'),
(185, 'OnclickShowPopup_title', 'Onclick show popup', 'yes'),
(139, 'jqlb_help_text', '', 'yes'),
(140, 'jqlb_link_target', '_self', 'yes'),
(141, 'jqlb_automate', '1', 'yes'),
(142, 'jqlb_comments', '1', 'yes'),
(143, 'jqlb_resize_on_demand', '0', 'yes'),
(144, 'jqlb_show_download', '0', 'yes'),
(145, 'jqlb_navbarOnTop', '0', 'yes'),
(146, 'jqlb_resize_speed', '400', 'yes'),
(147, 'jqlb_slideshow_speed', '4000', 'yes'),
(148, 'xyz_credit_link', '0', 'yes'),
(155, 'xyz_lbx_right', '25', 'yes'),
(156, 'xyz_lbx_bottom', '25', 'yes'),
(184, '_transient_plugins_delete_result_1', '1', 'yes'),
(168, 'xyz_lbx_right_dim', '%', 'yes'),
(169, 'xyz_lbx_bottom_dim', '%', 'yes'),
(193, 'pop_id', 'RANDOM', 'yes'),
(189, 'OnclickShowPopup_random', 'YES', 'yes'),
(188, 'OnclickShowPopup_title_yes', 'YES', 'yes'),
(187, 'OnclickShowPopup_widget', 'Group1', 'yes'),
(186, 'OnclickShowPopup_theme', 'light_rounded', 'yes'),
(181, 'xyz_lbx_free_version', '2.1', 'yes'),
(182, '_site_transient_timeout_poptags_40cd750bba9870f18aada2478b24840a', '1367738779', 'yes'),
(183, '_site_transient_poptags_40cd750bba9870f18aada2478b24840a', 'a:40:{s:6:"widget";a:3:{s:4:"name";s:6:"widget";s:4:"slug";s:6:"widget";s:5:"count";s:4:"3734";}s:4:"post";a:3:{s:4:"name";s:4:"Post";s:4:"slug";s:4:"post";s:5:"count";s:4:"2373";}s:6:"plugin";a:3:{s:4:"name";s:6:"plugin";s:4:"slug";s:6:"plugin";s:5:"count";s:4:"2244";}s:5:"admin";a:3:{s:4:"name";s:5:"admin";s:4:"slug";s:5:"admin";s:5:"count";s:4:"1861";}s:5:"posts";a:3:{s:4:"name";s:5:"posts";s:4:"slug";s:5:"posts";s:5:"count";s:4:"1786";}s:7:"sidebar";a:3:{s:4:"name";s:7:"sidebar";s:4:"slug";s:7:"sidebar";s:5:"count";s:4:"1551";}s:7:"twitter";a:3:{s:4:"name";s:7:"twitter";s:4:"slug";s:7:"twitter";s:5:"count";s:4:"1276";}s:6:"google";a:3:{s:4:"name";s:6:"google";s:4:"slug";s:6:"google";s:5:"count";s:4:"1269";}s:8:"comments";a:3:{s:4:"name";s:8:"comments";s:4:"slug";s:8:"comments";s:5:"count";s:4:"1259";}s:6:"images";a:3:{s:4:"name";s:6:"images";s:4:"slug";s:6:"images";s:5:"count";s:4:"1213";}s:4:"page";a:3:{s:4:"name";s:4:"page";s:4:"slug";s:4:"page";s:5:"count";s:4:"1179";}s:5:"image";a:3:{s:4:"name";s:5:"image";s:4:"slug";s:5:"image";s:5:"count";s:4:"1080";}s:5:"links";a:3:{s:4:"name";s:5:"links";s:4:"slug";s:5:"links";s:5:"count";s:3:"956";}s:8:"facebook";a:3:{s:4:"name";s:8:"Facebook";s:4:"slug";s:8:"facebook";s:5:"count";s:3:"927";}s:3:"seo";a:3:{s:4:"name";s:3:"seo";s:4:"slug";s:3:"seo";s:5:"count";s:3:"913";}s:9:"shortcode";a:3:{s:4:"name";s:9:"shortcode";s:4:"slug";s:9:"shortcode";s:5:"count";s:3:"908";}s:9:"wordpress";a:3:{s:4:"name";s:9:"wordpress";s:4:"slug";s:9:"wordpress";s:5:"count";s:3:"785";}s:7:"gallery";a:3:{s:4:"name";s:7:"gallery";s:4:"slug";s:7:"gallery";s:5:"count";s:3:"780";}s:6:"social";a:3:{s:4:"name";s:6:"social";s:4:"slug";s:6:"social";s:5:"count";s:3:"745";}s:3:"rss";a:3:{s:4:"name";s:3:"rss";s:4:"slug";s:3:"rss";s:5:"count";s:3:"700";}s:7:"widgets";a:3:{s:4:"name";s:7:"widgets";s:4:"slug";s:7:"widgets";s:5:"count";s:3:"661";}s:5:"pages";a:3:{s:4:"name";s:5:"pages";s:4:"slug";s:5:"pages";s:5:"count";s:3:"654";}s:6:"jquery";a:3:{s:4:"name";s:6:"jquery";s:4:"slug";s:6:"jquery";s:5:"count";s:3:"653";}s:4:"ajax";a:3:{s:4:"name";s:4:"AJAX";s:4:"slug";s:4:"ajax";s:5:"count";s:3:"602";}s:5:"email";a:3:{s:4:"name";s:5:"email";s:4:"slug";s:5:"email";s:5:"count";s:3:"593";}s:5:"media";a:3:{s:4:"name";s:5:"media";s:4:"slug";s:5:"media";s:5:"count";s:3:"557";}s:10:"javascript";a:3:{s:4:"name";s:10:"javascript";s:4:"slug";s:10:"javascript";s:5:"count";s:3:"547";}s:5:"video";a:3:{s:4:"name";s:5:"video";s:4:"slug";s:5:"video";s:5:"count";s:3:"542";}s:10:"buddypress";a:3:{s:4:"name";s:10:"buddypress";s:4:"slug";s:10:"buddypress";s:5:"count";s:3:"537";}s:4:"feed";a:3:{s:4:"name";s:4:"feed";s:4:"slug";s:4:"feed";s:5:"count";s:3:"517";}s:5:"photo";a:3:{s:4:"name";s:5:"photo";s:4:"slug";s:5:"photo";s:5:"count";s:3:"500";}s:7:"content";a:3:{s:4:"name";s:7:"content";s:4:"slug";s:7:"content";s:5:"count";s:3:"499";}s:6:"photos";a:3:{s:4:"name";s:6:"photos";s:4:"slug";s:6:"photos";s:5:"count";s:3:"483";}s:4:"link";a:3:{s:4:"name";s:4:"link";s:4:"slug";s:4:"link";s:5:"count";s:3:"481";}s:5:"stats";a:3:{s:4:"name";s:5:"stats";s:4:"slug";s:5:"stats";s:5:"count";s:3:"443";}s:4:"spam";a:3:{s:4:"name";s:4:"spam";s:4:"slug";s:4:"spam";s:5:"count";s:3:"435";}s:8:"category";a:3:{s:4:"name";s:8:"category";s:4:"slug";s:8:"category";s:5:"count";s:3:"434";}s:5:"login";a:3:{s:4:"name";s:5:"login";s:4:"slug";s:5:"login";s:5:"count";s:3:"422";}s:7:"youtube";a:3:{s:4:"name";s:7:"youtube";s:4:"slug";s:7:"youtube";s:5:"count";s:3:"418";}s:5:"share";a:3:{s:4:"name";s:5:"Share";s:4:"slug";s:5:"share";s:5:"count";s:3:"413";}}', 'yes'),
(262, '_transient_timeout_dash_aa95765b5cc111c56d5993d476b1c2f0', '1368248215', 'no'),
(263, '_transient_dash_aa95765b5cc111c56d5993d476b1c2f0', '<div class="rss-widget"><p><strong>RSS Error</strong>: WP HTTP Error: Could not open handle for fopen() to http://planet.wordpress.org/feed/</p></div>', 'no'),
(264, '_transient_timeout_dash_4077549d03da2e451c8b5f002294ff51', '1368248221', 'no'),
(265, '_transient_dash_4077549d03da2e451c8b5f002294ff51', '<div class="rss-widget"><p><strong>RSS Error</strong>: WP HTTP Error: Could not open handle for fopen() to http://wordpress.org/news/feed/</p></div>', 'no'),
(269, '_transient_dash_de3249c4736ad3bd2cd29147c4a0d43e', '', 'no'),
(270, '_transient_timeout_dash_20494a3d90a6669585674ed0eb8dcd8f', '1368248239', 'no'),
(271, '_transient_dash_20494a3d90a6669585674ed0eb8dcd8f', '<p><strong>RSS Error</strong>: WP HTTP Error: Could not open handle for fopen() to http://blogsearch.google.com/blogsearch_feeds?scoring=d&ie=utf-8&num=10&output=rss&partner=wordpress&q=link:http://dashboard.markisonline.co.uk</p>', 'no'),
(279, 'theme_mods_twentytwelve', 'a:8:{s:16:"header_textcolor";s:3:"444";s:16:"background_color";s:6:"e6e6e6";s:16:"background_image";s:0:"";s:17:"background_repeat";s:6:"repeat";s:21:"background_position_x";s:4:"left";s:21:"background_attachment";s:5:"fixed";s:12:"header_image";s:91:"http://dashboard.markisonline.co.uk/wp-content/uploads/2013/05/cropped-wordpress_header_www_v211.jpg";s:17:"header_image_data";a:5:{s:13:"attachment_id";i:12;s:3:"url";s:91:"http://dashboard.markisonline.co.uk/wordpress/wp-content/uploads/2013/05/cropped-wordpress_header_www_v211.jpg";s:13:"thumbnail_url";s:91:"http://dashboard.markisonline.co.uk/wp-content/uploads/2013/05/cropped-wordpress_header_www_v211.jpg";s:5:"width";i:940;s:6:"height";i:198;}}', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

CREATE TABLE IF NOT EXISTS `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'add_services.php'),
(2, 2, '_edit_lock', '1367734933:1'),
(3, 2, '_edit_last', '1'),
(4, 6, '_edit_last', '1'),
(5, 6, '_edit_lock', '1368239805:1'),
(6, 6, '_wp_page_template', 'home.php'),
(7, 8, '_wp_attached_file', '2013/05/benevolence.jpg'),
(8, 8, '_wp_attachment_context', 'custom-header'),
(9, 8, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:700;s:6:"height";i:225;s:4:"file";s:23:"2013/05/benevolence.jpg";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:23:"benevolence-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:22:"benevolence-300x96.jpg";s:5:"width";i:300;s:6:"height";i:96;s:9:"mime-type";s:10:"image/jpeg";}s:14:"post-thumbnail";a:4:{s:4:"file";s:23:"benevolence-624x200.jpg";s:5:"width";i:624;s:6:"height";i:200;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:10:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";}}'),
(10, 8, '_wp_attachment_is_custom_header', 'twentytwelve'),
(11, 9, '_wp_attached_file', '2013/05/header_2.jpg'),
(12, 9, '_wp_attachment_context', 'custom-header'),
(13, 9, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:865;s:6:"height";i:180;s:4:"file";s:20:"2013/05/header_2.jpg";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:20:"header_2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:19:"header_2-300x62.jpg";s:5:"width";i:300;s:6:"height";i:62;s:9:"mime-type";s:10:"image/jpeg";}s:14:"post-thumbnail";a:4:{s:4:"file";s:20:"header_2-624x129.jpg";s:5:"width";i:624;s:6:"height";i:129;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:10:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";}}'),
(14, 9, '_wp_attachment_is_custom_header', 'twentytwelve'),
(15, 10, '_wp_attached_file', '2013/05/wordpress_header_www_v2.jpg'),
(16, 10, '_wp_attachment_context', 'custom-header'),
(17, 10, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:940;s:6:"height";i:198;s:4:"file";s:35:"2013/05/wordpress_header_www_v2.jpg";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:35:"wordpress_header_www_v2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:34:"wordpress_header_www_v2-300x63.jpg";s:5:"width";i:300;s:6:"height";i:63;s:9:"mime-type";s:10:"image/jpeg";}s:14:"post-thumbnail";a:4:{s:4:"file";s:35:"wordpress_header_www_v2-624x131.jpg";s:5:"width";i:624;s:6:"height";i:131;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:10:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";}}'),
(18, 10, '_wp_attachment_is_custom_header', 'twentytwelve'),
(19, 11, '_wp_attached_file', '2013/05/cropped-wordpress_header_www_v21.jpg'),
(20, 11, '_wp_attachment_context', 'custom-header'),
(21, 11, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:760;s:6:"height";i:198;s:4:"file";s:44:"2013/05/cropped-wordpress_header_www_v21.jpg";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:44:"cropped-wordpress_header_www_v21-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:43:"cropped-wordpress_header_www_v21-300x78.jpg";s:5:"width";i:300;s:6:"height";i:78;s:9:"mime-type";s:10:"image/jpeg";}s:14:"post-thumbnail";a:4:{s:4:"file";s:44:"cropped-wordpress_header_www_v21-624x162.jpg";s:5:"width";i:624;s:6:"height";i:162;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:10:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";}}'),
(22, 11, '_wp_attachment_is_custom_header', 'twentytwelve'),
(23, 12, '_wp_attached_file', '2013/05/cropped-wordpress_header_www_v211.jpg'),
(24, 12, '_wp_attachment_context', 'custom-header'),
(25, 12, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:940;s:6:"height";i:198;s:4:"file";s:45:"2013/05/cropped-wordpress_header_www_v211.jpg";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:45:"cropped-wordpress_header_www_v211-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:44:"cropped-wordpress_header_www_v211-300x63.jpg";s:5:"width";i:300;s:6:"height";i:63;s:9:"mime-type";s:10:"image/jpeg";}s:14:"post-thumbnail";a:4:{s:4:"file";s:45:"cropped-wordpress_header_www_v211-624x131.jpg";s:5:"width";i:624;s:6:"height";i:131;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:10:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";}}'),
(26, 12, '_wp_attachment_is_custom_header', 'twentytwelve'),
(27, 13, '_edit_last', '1'),
(28, 13, '_edit_lock', '1368250217:1'),
(29, 13, '_wp_page_template', 'add_services_setup.php');

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

CREATE TABLE IF NOT EXISTS `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2013-05-04 17:16:05', '2013-05-04 17:16:05', 'Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2013-05-04 17:16:05', '2013-05-04 17:16:05', '', 0, 'http://dashboard.markisonline.co.uk/?p=1', 0, 'post', '', 1),
(2, 1, '2013-05-04 17:16:05', '2013-05-04 17:16:05', 'This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\r\n\r\n<blockquote>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my blog. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin'' caught in the rain.)</blockquote>\r\n\r\n...or something like this:\r\n\r\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\r\n\r\nAs a new WordPress user, you should go to <a href="http://dashboard.markisonline.co.uk/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Add Services', '', 'publish', 'open', 'open', '', 'add-services', '', '', '2013-05-05 05:55:33', '2013-05-05 05:55:33', '', 0, 'http://dashboard.markisonline.co.uk/?page_id=2', 0, 'page', '', 0),
(4, 1, '2013-05-04 17:16:05', '2013-05-04 17:16:05', 'This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my blog. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin'' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href="http://dashboard.markisonline.co.uk/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'inherit', 'open', 'open', '', '2-revision', '', '', '2013-05-04 17:16:05', '2013-05-04 17:16:05', '', 2, 'http://dashboard.markisonline.co.uk/2-revision/', 0, 'revision', '', 0),
(5, 1, '2013-05-04 17:17:53', '2013-05-04 17:17:53', 'This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\r\n\r\n<blockquote>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my blog. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin'' caught in the rain.)</blockquote>\r\n\r\n...or something like this:\r\n\r\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\r\n\r\nAs a new WordPress user, you should go to <a href="http://dashboard.markisonline.co.uk/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Add Services', '', 'inherit', 'open', 'open', '', '2-revision-2', '', '', '2013-05-04 17:17:53', '2013-05-04 17:17:53', '', 2, 'http://dashboard.markisonline.co.uk/2-revision-2/', 0, 'revision', '', 0),
(6, 1, '2013-05-10 16:57:45', '2013-05-10 16:57:45', '', 'Home', '', 'publish', 'open', 'open', '', 'home', '', '', '2013-05-10 16:57:45', '2013-05-10 16:57:45', '', 0, 'http://dashboard.markisonline.co.uk/?page_id=6', 0, 'page', '', 0),
(7, 1, '2013-05-10 16:57:39', '2013-05-10 16:57:39', '', 'Home', '', 'inherit', 'open', 'open', '', '6-revision', '', '', '2013-05-10 16:57:39', '2013-05-10 16:57:39', '', 6, 'http://dashboard.markisonline.co.uk/6-revision/', 0, 'revision', '', 0),
(8, 1, '2013-05-11 04:10:39', '2013-05-11 04:10:39', 'http://dashboard.markisonline.co.uk/wp-content/uploads/2013/05/benevolence.jpg', 'benevolence.jpg', '', 'inherit', 'closed', 'open', '', 'benevolence-jpg', '', '', '2013-05-11 04:10:39', '2013-05-11 04:10:39', '', 0, 'http://dashboard.markisonline.co.uk/wp-content/uploads/2013/05/benevolence.jpg', 0, 'attachment', 'image/jpeg', 0),
(9, 1, '2013-05-11 04:14:28', '2013-05-11 04:14:28', 'http://dashboard.markisonline.co.uk/wp-content/uploads/2013/05/header_2.jpg', 'header_2.jpg', '', 'inherit', 'closed', 'open', '', 'header_2-jpg', '', '', '2013-05-11 04:14:28', '2013-05-11 04:14:28', '', 0, 'http://dashboard.markisonline.co.uk/wp-content/uploads/2013/05/header_2.jpg', 0, 'attachment', 'image/jpeg', 0),
(10, 1, '2013-05-11 04:16:28', '2013-05-11 04:16:28', 'http://dashboard.markisonline.co.uk/wp-content/uploads/2013/05/wordpress_header_www_v2.jpg', 'wordpress_header_www_v2.jpg', '', 'inherit', 'closed', 'open', '', 'wordpress_header_www_v2-jpg', '', '', '2013-05-11 04:16:28', '2013-05-11 04:16:28', '', 0, 'http://dashboard.markisonline.co.uk/wp-content/uploads/2013/05/wordpress_header_www_v2.jpg', 0, 'attachment', 'image/jpeg', 0),
(11, 1, '2013-05-11 04:17:59', '2013-05-11 04:17:59', 'http://dashboard.markisonline.co.uk/wp-content/uploads/2013/05/cropped-wordpress_header_www_v21.jpg', 'cropped-wordpress_header_www_v21.jpg', '', 'inherit', 'closed', 'open', '', 'cropped-wordpress_header_www_v21-jpg', '', '', '2013-05-11 04:17:59', '2013-05-11 04:17:59', '', 0, 'http://dashboard.markisonline.co.uk/wp-content/uploads/2013/05/cropped-wordpress_header_www_v21.jpg', 0, 'attachment', 'image/jpeg', 0),
(12, 1, '2013-05-11 04:23:01', '2013-05-11 04:23:01', 'http://dashboard.markisonline.co.uk/wp-content/uploads/2013/05/cropped-wordpress_header_www_v211.jpg', 'cropped-wordpress_header_www_v211.jpg', '', 'inherit', 'closed', 'open', '', 'cropped-wordpress_header_www_v211-jpg', '', '', '2013-05-11 04:23:01', '2013-05-11 04:23:01', '', 0, 'http://dashboard.markisonline.co.uk/wp-content/uploads/2013/05/cropped-wordpress_header_www_v211.jpg', 0, 'attachment', 'image/jpeg', 0),
(13, 1, '2013-05-11 05:11:26', '2013-05-11 05:11:26', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nNullam sagittis tellus ac ipsum faucibus egestas. Fusce\r\nvolutpat tempor elit sed faucibus. Fusce gravida turpis non\r\nnisi volutpat posuere. In in risus sem, non porta est.\r\nCurabitur eget ultrices enim. Phasellus ut leo eu nibh\r\nconsectetur facilisis a sit amet eros. Praesent a velit non\r\nturpis porttitor egestas nec ut diam. Sed sed nisl dui, sed\r\nauctor lectus. Nunc diam lacus, accumsan eu elementum\r\neget, porta sit amet urna.', 'Add services Setup', '', 'publish', 'open', 'open', '', 'add-services-setup', '', '', '2013-05-11 05:17:42', '2013-05-11 05:17:42', '', 0, 'http://dashboard.markisonline.co.uk/?page_id=13', 0, 'page', '', 0),
(14, 1, '2013-05-11 05:10:48', '2013-05-11 05:10:48', '', 'Add services Setup', '', 'inherit', 'open', 'open', '', '13-revision', '', '', '2013-05-11 05:10:48', '2013-05-11 05:10:48', '', 13, 'http://dashboard.markisonline.co.uk/13-revision/', 0, 'revision', '', 0),
(15, 1, '2013-05-11 05:11:26', '2013-05-11 05:11:26', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nNullam sagittis tellus ac ipsum faucibus egestas. Fusce\r\nvolutpat tempor elit sed faucibus. Fusce gravida turpis non\r\nnisi volutpat posuere. In in risus sem, non porta est.\r\nCurabitur eget ultrices enim. Phasellus ut leo eu nibh\r\nconsectetur facilisis a sit amet eros. Praesent a velit non\r\nturpis porttitor egestas nec ut diam. Sed sed nisl dui, sed\r\nauctor lectus. Nunc diam lacus, accumsan eu elementum\r\neget, porta sit amet urna.', 'Add services Setup', '', 'inherit', 'open', 'open', '', '13-revision-2', '', '', '2013-05-11 05:11:26', '2013-05-11 05:11:26', '', 13, 'http://dashboard.markisonline.co.uk/13-revision-2/', 0, 'revision', '', 0),
(16, 1, '2013-05-11 05:11:58', '2013-05-11 05:11:58', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nNullam sagittis tellus ac ipsum faucibus egestas. Fusce\r\nvolutpat tempor elit sed faucibus. Fusce gravida turpis non\r\nnisi volutpat posuere. In in risus sem, non porta est.\r\nCurabitur eget ultrices enim. Phasellus ut leo eu nibh\r\nconsectetur facilisis a sit amet eros. Praesent a velit non\r\nturpis porttitor egestas nec ut diam. Sed sed nisl dui, sed\r\nauctor lectus. Nunc diam lacus, accumsan eu elementum\r\neget, porta sit amet urna.', 'Add services Setup', '', 'inherit', 'open', 'open', '', '13-revision-3', '', '', '2013-05-11 05:11:58', '2013-05-11 05:11:58', '', 13, 'http://dashboard.markisonline.co.uk/13-revision-3/', 0, 'revision', '', 0),
(17, 1, '2013-05-11 05:13:04', '2013-05-11 05:13:04', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nNullam sagittis tellus ac ipsum faucibus egestas. Fusce\r\nvolutpat tempor elit sed faucibus. Fusce gravida turpis non\r\nnisi volutpat posuere. In in risus sem, non porta est.\r\nCurabitur eget ultrices enim. Phasellus ut leo eu nibh\r\nconsectetur facilisis a sit amet eros. Praesent a velit non\r\nturpis porttitor egestas nec ut diam. Sed sed nisl dui, sed\r\nauctor lectus. Nunc diam lacus, accumsan eu elementum\r\neget, porta sit amet urna.', 'Add services Setup', '', 'inherit', 'open', 'open', '', '13-revision-4', '', '', '2013-05-11 05:13:04', '2013-05-11 05:13:04', '', 13, 'http://dashboard.markisonline.co.uk/13-revision-4/', 0, 'revision', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_services`
--

CREATE TABLE IF NOT EXISTS `wp_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wp_services`
--


-- --------------------------------------------------------

--
-- Table structure for table `wp_services_master`
--

CREATE TABLE IF NOT EXISTS `wp_services_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon_offline` varchar(255) NOT NULL,
  `icon_online` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `wp_services_master`
--

INSERT INTO `wp_services_master` (`id`, `key`, `title`, `icon_offline`, `icon_online`) VALUES
(1, 'my_website', 'My website', 'icon-website-offline.jpg', 'icon-website.jpg'),
(2, 'google_places', 'Google places', 'icon-google-offline.jpg', 'icon-google.jpg'),
(3, 'facebook_page', 'Facebook Page', 'icon-facebook-offline.jpg', 'icon-facebook.jpg'),
(4, 'twitter ', 'Twitter', 'icon-twitter-offline.jpg', 'icon-twitter.jpg'),
(5, 'yell', 'Yell', 'icon-yell-offline.jpg', 'icon-yell.jpg'),
(6, 'trip_advisor', 'Trip Advisor', 'icon-tripadvisor-offline.jpg', 'icon-tripadvisor.jpg'),
(7, 'youtube', 'Youtube', 'icon-youtube-offline.jpg', 'icon-youtube.jpg'),
(8, 'instagram', 'Instagram', 'icon-instagram-offline.jpg', 'icon-instagram.jpg'),
(9, 'flickr', 'Flickr', 'icon-flickr-offline.jpg', 'icon-flickr.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

CREATE TABLE IF NOT EXISTS `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

CREATE TABLE IF NOT EXISTS `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

CREATE TABLE IF NOT EXISTS `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'first_name', ''),
(2, 1, 'last_name', ''),
(3, 1, 'nickname', 'admin'),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'comment_shortcuts', 'false'),
(7, 1, 'admin_color', 'fresh'),
(8, 1, 'use_ssl', '0'),
(9, 1, 'show_admin_bar_front', 'true'),
(10, 1, 'wp_capabilities', 'a:1:{s:13:"administrator";b:1;}'),
(11, 1, 'wp_user_level', '10'),
(12, 1, 'dismissed_wp_pointers', 'wp330_toolbar,wp330_saving_widgets,wp340_choose_image_from_library,wp340_customize_current_theme_link,wp350_media'),
(13, 1, 'show_welcome_panel', '1'),
(14, 1, 'wp_user-settings', 'editor=html'),
(15, 1, 'wp_user-settings-time', '1367687786'),
(16, 1, 'wp_dashboard_quick_press_last_post_id', '3');

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

CREATE TABLE IF NOT EXISTS `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$BsqQRpNXwEoly9VnXYXGeyCXMIOqnN.', 'admin', '362531@gmail.com', '', '2013-05-04 17:16:05', '', 0, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
