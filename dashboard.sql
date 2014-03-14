--
-- Database: `dashboard`
--

CREATE TABLE IF NOT EXISTS `wp_pbsguw_services` (
  `key` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `list_description` varchar(255) NOT NULL,
  `tutorial_url` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY  (`key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `wp_pbsguw_users_services` (
  `id` int(11) NOT NULL auto_increment,
  `service_key` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL default '0',
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL default '1',
  `token` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_services`
--s

INSERT INTO `wp_pbsguw_services` (`key`, `title`, `list_description`, `tutorial_url`, `category`) VALUES
('my_website', 'My Website', 'Add and manage your own website with the dashboard or if you have not got a website, you might be interested in viewing a tutorial on how to build one.', 'http://www.thesitewizard.com/gettingstarted/startwebsite.shtml', 'market'),
('google_places', 'Google places', 'Google Places gets your business on Google Search, Maps, Google+ and mobile. This service is very useful for allowing customers to find you.', 'http://www.youtube.com/watch?v=S3v_EVhfPAA', 'market'),
('facebook', 'Facebook', 'Facebook is a very popular and well used website. It allows people to create profiles and communicate with each other.', 'https://www.facebook.com/', 'communicating'),
('twitter ', 'Twitter', 'Twitter allows fast communication with your audience through 140 characters.', 'http://www.youtube.com/watch?v=gcjvIgGGMnA', 'communicating'),
('yell', 'Yell', 'Yell is a popular online business directory, allowing customers to search and find you through the Yell search engine.', 'http://www.yell.com/help/yourbusiness/optimise1.html', 'market'),
('trip_advisor', 'Trip Advisor', 'Trip Advisor is a very popular service, which lists businesses by customer reviews and location. It allows customers to find, review and recommend your businesses.', 'http://www.tripadvisor.co.uk/Owners', 'market'),
('youtube', 'Youtube', 'YouTube is the most popular video sharing service on the Internet, allowing you to upload and share videos within communities and people in the world.', 'http://www.teachertrainingvideos.com/youTube/', 'multimedia'),
('instagram', 'Instagram', 'Instagram is a mobile application for taking and sharing photos. It is also a social network allowing you to create photo communities.', 'http://www.wikihow.com/Use-Instagram', 'multimedia'),
('flickr', 'Flickr', 'Flickr is an online photo management and photo sharing service. It also allows you to build an online photo sharing community.', 'http://www.youtube.com/watch?v=dVeZhYhmLzc', 'multimedia'),
('ebay', 'Ebay', 'Ebay is an e-commerce website, allowing you to sell and buy items online.', 'http://pages.ebay.com/help/account/gettingstarted.html', 'sell'),
('etsy', 'Etsy', 'Etsy is an e-commerce website, allowing you to sell and buy hand-made and vintage items online.', 'http://www.grovo.com/etsy', 'sell'),
('paypal', 'Paypal', 'Paypal is a quick and safe way of sending and receive money online.', 'http://www.youtube.com/watch?v=HSQ7dl8Zgrk', 'payment'),
('collect', 'Collect+', 'Parcels made easy. Send, collect and return parcels at your local corner shop, from early ''til late, 7 days a week.', 'http://www.collectplus.co.uk', 'packages'),
('email', 'Email', 'Email is the most popular way of sending electronic messages on the Internet. It give you a way of being reached and allows you to get in contact with businesses that are online.', 'http://dawn.thot.net/cd/1.html', 'communicating'),
('google_analytics', 'Google Analytics', 'Google Analytics allows you to find out who looks at your web pages.', 'http://www.youtube.com/watch?v=mm78xlsADgc', 'who'),
('credly', 'Credly', 'Credly offers a service for verifying, sharing and managing digital badges and credentials.', 'https://credly.com', 'business_community'),
('customer_base', 'Customer Base', 'Customer base allows you to find out about your customers and who visits your online web pages. It gives you a statistical analysis of your customers for each web service that you use.', 'http://www.google.com', 'who'),
('facebook_page', 'Facebook Page', 'A Facebook Page is for a business, organisation or brand to share their stories and connect with people. ', 'http://www.facebook.com/pages', 'communicating');
