-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2025 at 02:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `superv`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 - deactive, 1 - active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `role_id`, `username`, `email`, `first_name`, `last_name`, `image`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', 'admin@gmail.com', 'Admin', '.', '6897e49432f05.png', '$2y$10$UmZ3nP0JIUOI0CxLG/175efcigYJDbfg45Ga4cYz/YdZOshZ0GPMm', 1, NULL, '2025-08-09 23:15:16'),
(10, 7, 'delivery', 'delivery@gmail.com', 'Delivery', 'Manager', '5f6c395833e14.jpg', '$2y$10$658kJ38abUEn.d46DmYhQ.wNIy9fRE2TPDrNzeMODbxDWHWOwrqRS', 1, '2020-09-24 00:14:48', '2020-09-28 11:24:32'),
(11, 8, 'kitchen', 'kitchen@gmail.com', 'Kitchen', 'Manager', '60a934a18ff49.jpg', '$2y$10$PTTKwbg5AEHm4BBVUaes1uhlx1eZKeTJzD7M5pIQjPrDmGYaVzul2', 1, '2020-09-28 11:23:39', '2021-05-23 01:43:13'),
(13, 9, 'Shop', 'Shop@gmail.com', 'Shop', 'Shop', '6897e47d1b841.png', '$2y$10$RUdNAgMYdo8nyre2aFzoI.IPGmsZX1VqH5iVaZ4OinFpKgvwrZgoi', 1, '2025-08-09 23:14:53', '2025-08-09 23:14:53');

-- --------------------------------------------------------

--
-- Table structure for table `backups`
--

CREATE TABLE `backups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `backups`
--

INSERT INTO `backups` (`id`, `filename`, `created_at`, `updated_at`) VALUES
(3, '2022-04-24-121935-dump-superv.sql', '2022-04-24 06:19:35', '2022-04-24 06:19:35'),
(4, '2023-03-29-114729-dump-superv.sql', '2023-03-29 05:47:29', '2023-03-29 05:47:29'),
(5, '2023-03-29-115159-dump-superv.sql', '2023-03-29 05:51:59', '2023-03-29 05:51:59'),
(6, '2023-03-29-115326-dump-superv.sql', '2023-03-29 05:53:26', '2023-03-29 05:53:26'),
(7, '2023-03-29-115431-dump-superv.sql', '2023-03-29 05:54:32', '2023-03-29 05:54:32'),
(8, '2023-03-29-115433-dump-superv.sql', '2023-03-29 05:54:33', '2023-03-29 05:54:33'),
(9, '2025-08-08-232047-dump-superv.sql', '2025-08-08 20:20:47', '2025-08-08 20:20:47');

-- --------------------------------------------------------

--
-- Table structure for table `basic_extendeds`
--

CREATE TABLE `basic_extendeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `cookie_alert_status` tinyint(4) NOT NULL DEFAULT 1,
  `cookie_alert_text` blob DEFAULT NULL,
  `cookie_alert_button_text` varchar(255) DEFAULT NULL,
  `to_mail` varchar(255) DEFAULT NULL,
  `default_language_direction` varchar(20) NOT NULL DEFAULT 'ltr' COMMENT 'ltr / rtl',
  `blogs_meta_keywords` text DEFAULT NULL,
  `blogs_meta_description` text DEFAULT NULL,
  `is_facebook_pexel` tinyint(4) NOT NULL DEFAULT 0,
  `facebook_pexel_script` text DEFAULT NULL,
  `theme_version` varchar(70) DEFAULT 'default_service_category',
  `from_mail` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `is_smtp` tinyint(4) NOT NULL DEFAULT 0,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(30) DEFAULT NULL,
  `encryption` varchar(30) DEFAULT NULL,
  `smtp_username` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `slider_shape_img` varchar(255) DEFAULT NULL,
  `slider_bottom_img` varchar(255) DEFAULT NULL,
  `footer_bottom_img` varchar(255) DEFAULT NULL,
  `menu_section_title` varchar(255) DEFAULT NULL,
  `menu_section_subtitle` varchar(255) DEFAULT NULL,
  `menu_section_img` varchar(50) DEFAULT NULL,
  `special_section_title` varchar(255) DEFAULT NULL,
  `special_section_subtitle` varchar(255) DEFAULT NULL,
  `testimonial_bg_img` varchar(50) DEFAULT NULL,
  `table_section_title` varchar(255) NOT NULL,
  `table_section_subtitle` varchar(255) NOT NULL,
  `table_section_img` varchar(50) DEFAULT NULL,
  `base_currency_symbol` blob DEFAULT NULL,
  `base_currency_symbol_position` varchar(10) NOT NULL DEFAULT 'left',
  `base_currency_text` varchar(100) DEFAULT NULL,
  `base_currency_text_position` varchar(10) NOT NULL DEFAULT 'right',
  `base_currency_rate` decimal(8,2) NOT NULL DEFAULT 0.00,
  `hero_bg` varchar(50) DEFAULT NULL,
  `hero_section_bold_text` varchar(255) DEFAULT NULL,
  `hero_section_bold_text_font_size` int(11) NOT NULL DEFAULT 60,
  `hero_section_bold_text_color` varchar(20) NOT NULL DEFAULT 'FFFFFF',
  `hero_section_text` varchar(255) DEFAULT NULL,
  `hero_section_text_font_size` int(11) NOT NULL DEFAULT 18,
  `hero_section_text_color` varchar(20) NOT NULL DEFAULT 'FFFFFF',
  `hero_section_button_text` varchar(30) DEFAULT NULL,
  `hero_section_button_text_font_size` int(11) NOT NULL DEFAULT 14,
  `hero_section_button_color` varchar(20) NOT NULL DEFAULT 'FFFFFF',
  `hero_section_button_url` text DEFAULT NULL,
  `hero_section_button2_text` varchar(30) DEFAULT NULL,
  `hero_section_button2_text_font_size` int(11) DEFAULT 14,
  `hero_section_button2_url` text DEFAULT NULL,
  `hero_shape_img` varchar(50) DEFAULT NULL,
  `hero_bottom_img` varchar(50) DEFAULT NULL,
  `hero_section_video_link` varchar(255) DEFAULT NULL,
  `hero_side_img` varchar(50) DEFAULT NULL,
  `faq_title` varchar(255) DEFAULT NULL,
  `career_title` varchar(255) DEFAULT NULL,
  `career_details_title` varchar(255) DEFAULT NULL,
  `special_section_bg` varchar(50) DEFAULT NULL,
  `menu_version` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - menu with col-6, 2 - menu with col-12',
  `qrcode_url` text DEFAULT NULL,
  `qrcode_color` text DEFAULT NULL,
  `pusher_app_id` varchar(15) DEFAULT NULL,
  `pusher_app_key` varchar(30) DEFAULT NULL,
  `pusher_app_secret` varchar(30) DEFAULT NULL,
  `pusher_app_cluster` varchar(10) DEFAULT NULL,
  `is_facebook_login` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - Deactive',
  `facebook_app_id` varchar(100) DEFAULT NULL,
  `facebook_app_secret` varchar(100) DEFAULT NULL,
  `is_google_login` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - Deactive',
  `google_client_id` varchar(150) DEFAULT NULL,
  `google_client_secret` varchar(70) DEFAULT NULL,
  `timezone` varchar(125) DEFAULT 'UTC',
  `delivery_date_time_status` tinyint(4) NOT NULL DEFAULT 0,
  `delivery_date_time_required` tinyint(4) NOT NULL DEFAULT 0,
  `qr_image` varchar(100) DEFAULT NULL,
  `qr_color` varchar(50) NOT NULL DEFAULT '0',
  `qr_size` int(11) NOT NULL DEFAULT 250,
  `qr_style` varchar(50) NOT NULL DEFAULT 'square',
  `qr_eye_style` varchar(50) NOT NULL DEFAULT 'square',
  `qr_margin` int(11) NOT NULL DEFAULT 0,
  `qr_text` varchar(255) DEFAULT NULL,
  `qr_text_color` varchar(50) NOT NULL DEFAULT '000000',
  `qr_text_size` int(11) NOT NULL DEFAULT 15,
  `qr_text_x` int(11) NOT NULL DEFAULT 50,
  `qr_text_y` int(11) NOT NULL DEFAULT 50,
  `qr_inserted_image` varchar(50) DEFAULT NULL,
  `qr_inserted_image_size` int(11) NOT NULL DEFAULT 20,
  `qr_inserted_image_x` int(11) NOT NULL DEFAULT 50,
  `qr_inserted_image_y` int(11) NOT NULL DEFAULT 50,
  `qr_type` varchar(50) NOT NULL DEFAULT 'default' COMMENT 'default, image, text',
  `order_close` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 - order closed, 0 - order open',
  `order_close_message` varchar(255) NOT NULL DEFAULT 'Order is closed now!',
  `testimonial_side_img` varchar(255) DEFAULT NULL,
  `feature_section_bg_image` varchar(50) DEFAULT NULL,
  `special_section_bg_image` varchar(50) DEFAULT NULL,
  `footer_section_bg_image` varchar(50) DEFAULT NULL,
  `hero_section_button_two_color` varchar(20) DEFAULT NULL,
  `hero_section_author_name` varchar(30) DEFAULT NULL,
  `hero_section_author_image` varchar(50) DEFAULT NULL,
  `hero_section_author_designation` varchar(30) DEFAULT NULL,
  `intro_bg_image` varchar(50) DEFAULT NULL,
  `testimonial_section_top_shape_image` varchar(50) DEFAULT NULL,
  `testimonial_section_bottom_shape_image` varchar(50) DEFAULT NULL,
  `blog_section_bg_image` varchar(50) DEFAULT NULL,
  `hero_section_water_shape_text` varchar(255) DEFAULT NULL,
  `hero_section_water_shape_text_font_size` int(11) DEFAULT NULL,
  `hero_section_water_shape_text_color` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_extendeds`
--

INSERT INTO `basic_extendeds` (`id`, `language_id`, `cookie_alert_status`, `cookie_alert_text`, `cookie_alert_button_text`, `to_mail`, `default_language_direction`, `blogs_meta_keywords`, `blogs_meta_description`, `is_facebook_pexel`, `facebook_pexel_script`, `theme_version`, `from_mail`, `from_name`, `is_smtp`, `smtp_host`, `smtp_port`, `encryption`, `smtp_username`, `smtp_password`, `slider_shape_img`, `slider_bottom_img`, `footer_bottom_img`, `menu_section_title`, `menu_section_subtitle`, `menu_section_img`, `special_section_title`, `special_section_subtitle`, `testimonial_bg_img`, `table_section_title`, `table_section_subtitle`, `table_section_img`, `base_currency_symbol`, `base_currency_symbol_position`, `base_currency_text`, `base_currency_text_position`, `base_currency_rate`, `hero_bg`, `hero_section_bold_text`, `hero_section_bold_text_font_size`, `hero_section_bold_text_color`, `hero_section_text`, `hero_section_text_font_size`, `hero_section_text_color`, `hero_section_button_text`, `hero_section_button_text_font_size`, `hero_section_button_color`, `hero_section_button_url`, `hero_section_button2_text`, `hero_section_button2_text_font_size`, `hero_section_button2_url`, `hero_shape_img`, `hero_bottom_img`, `hero_section_video_link`, `hero_side_img`, `faq_title`, `career_title`, `career_details_title`, `special_section_bg`, `menu_version`, `qrcode_url`, `qrcode_color`, `pusher_app_id`, `pusher_app_key`, `pusher_app_secret`, `pusher_app_cluster`, `is_facebook_login`, `facebook_app_id`, `facebook_app_secret`, `is_google_login`, `google_client_id`, `google_client_secret`, `timezone`, `delivery_date_time_status`, `delivery_date_time_required`, `qr_image`, `qr_color`, `qr_size`, `qr_style`, `qr_eye_style`, `qr_margin`, `qr_text`, `qr_text_color`, `qr_text_size`, `qr_text_x`, `qr_text_y`, `qr_inserted_image`, `qr_inserted_image_size`, `qr_inserted_image_x`, `qr_inserted_image_y`, `qr_type`, `order_close`, `order_close_message`, `testimonial_side_img`, `feature_section_bg_image`, `special_section_bg_image`, `footer_section_bg_image`, `hero_section_button_two_color`, `hero_section_author_name`, `hero_section_author_image`, `hero_section_author_designation`, `intro_bg_image`, `testimonial_section_top_shape_image`, `testimonial_section_bottom_shape_image`, `blog_section_bg_image`, `hero_section_water_shape_text`, `hero_section_water_shape_text_font_size`, `hero_section_water_shape_text_color`) VALUES
(147, 176, 0, 0x596f757220657870657269656e6365206f6e207468697320736974652077696c6c20626520696d70726f76656420627920616c6c6f77696e6720636f6f6b6965732e, 'Allow Cookies', 'support@kingkebabrestaurant.com', 'ltr', 'lorem, dolor', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 1, '<!-- Facebook Pixel Code -->\r\n<script>\r\n!function(f,b,e,v,n,t,s)\r\n{if(f.fbq)return;n=f.fbq=function(){n.callMethod?\r\nn.callMethod.apply(n,arguments):n.queue.push(arguments)};\r\nif(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version=\'2.0\';\r\nn.queue=[];t=b.createElement(e);t.async=!0;\r\nt.src=v;s=b.getElementsByTagName(e)[0];\r\ns.parentNode.insertBefore(t,s)}(window, document,\'script\',\r\n\'https://connect.facebook.net/en_US/fbevents.js\');\r\nfbq(\'init\', \'2723323421236702\');\r\nfbq(\'track\', \'PageView\');\r\n</script>\r\n<noscript><img height=\"1\" width=\"1\" style=\"display:none\"\r\nsrc=\"https://www.facebook.com/tr?id=2723323421236702&ev=PageView&noscript=1\"\r\n/></noscript>\r\n<!-- End Facebook Pixel Code -->', 'default_service_category', 'support@kingkebabrestaurant.com', 'Superv', 1, 'nl1-sr12.supercp.com', '587', 'TLS', 'support@kingkebabrestaurant.com', 'ZAOP!~rSk~gb', '5f5a03b9351d9.png', '5fec644e710b9.png', '5f5b45239066f.png', 'Nos menus', 'Découvrez les menus alimentaires', '1599809670.png', 'Nos articles spéciaux proposés à prix réduit', 'VOIR TOUTE LA LISTE DES MENUS', '6460784cda617.jpg', 'Réservation de table', 'Réservez votre table', NULL, 0xe282ac, 'left', 'EUR', 'right', 0.86, '6460656344753.jpg', 'Le vrai goût du kebab authentique.', 60, 'FFFFFF', 'Un kebab comme vous ne l’avez jamais goûté… frais, parfaitement assaisonné et grillé au charbon pour une saveur inoubliable.', 18, 'FFFFFF', 'Voir les détails', 18, 'FFFFFF', '/menus', 'Réserver une table', 14, '/reservation/form', '64606531f13f4.png', '5fec641428443.png', 'https://www.youtube.com/watch?v=DzSSUU37ynQ', '6897dd5cc0b12.png', 'F.A.Q.', 'Career', 'Job Details', '1600010997.jpg', 1, 'https://codecanyon.kreativdev.com/superv/qr-menu', '3851FF', '1080494', 'bd457a6ed0c247922b06', '019547a8751eec9b83af', 'ap2', 0, '188100859706337', '73dc84a95f12657de1b1ebaa6cc7ba94', 0, '81856165251-cd0s41jcep43b3a33i3rc7pnp3jdvo0p.apps.googleusercontent.com', 'nLCYVG30u-bVIvhzSg-z52pi', 'Europe/Paris', 1, 1, '68966998363c3.svg', '18173D', 313, 'square', 'square', 0, 'Kreativ', '114C05', 14, 50, 50, '6896678b725bd.png', 20, 50, 50, 'default', 0, 'Order is closed now!', '1680940275.png', '6432711301a4f.jpg', '6432710879569.jpg', '643270decd777.jpg', 'D3A971', 'Hames Rodrigo', '642916deb895f.jpg', 'Founder & Ceo', '6412f4bbf028b.png', '1678963129.png', '1678948560.png', '641a9269c1419.png', 'Orange juccice', 50, 'FFD854');

-- --------------------------------------------------------

--
-- Table structure for table `basic_extras`
--

CREATE TABLE `basic_extras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `whatsapp_order_status_notification` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - disable, 1 - enable',
  `whatsapp_home_delivery` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - enabled, 1 - disabled',
  `whatsapp_pickup` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - enabled, 1 - disabled',
  `whatsapp_on_table` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - enabled, 1 - disabled',
  `twilio_sid` varchar(100) DEFAULT NULL,
  `twilio_token` varchar(100) DEFAULT NULL,
  `twilio_phone_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_extras`
--

INSERT INTO `basic_extras` (`id`, `whatsapp_order_status_notification`, `whatsapp_home_delivery`, `whatsapp_pickup`, `whatsapp_on_table`, `twilio_sid`, `twilio_token`, `twilio_phone_number`) VALUES
(1, 1, 1, 1, 1, 'AC87db7baafc84b106f2d59eee812b8f7e', '8a938c87f06427109910fde8a5794b5f', '+33 0426423743');

-- --------------------------------------------------------

--
-- Table structure for table `basic_settings`
--

CREATE TABLE `basic_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `favicon` varchar(50) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `preloader_status` tinyint(4) NOT NULL COMMENT '0 - deactive, 1 - active',
  `preloader` varchar(50) DEFAULT NULL,
  `website_title` varchar(255) DEFAULT NULL,
  `base_color` varchar(30) DEFAULT NULL,
  `secondary_base_color` varchar(20) DEFAULT NULL,
  `support_email` varchar(100) DEFAULT NULL,
  `support_phone` varchar(30) DEFAULT NULL,
  `breadcrumb` varchar(50) DEFAULT NULL,
  `footer_logo` varchar(50) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `newsletter_text` varchar(255) DEFAULT NULL,
  `copyright_text` blob DEFAULT NULL,
  `intro_section_title` varchar(50) DEFAULT NULL,
  `intro_title` varchar(255) DEFAULT NULL,
  `intro_text` text DEFAULT NULL,
  `intro_contact_text` varchar(255) DEFAULT NULL,
  `intro_contact_number` varchar(255) DEFAULT NULL,
  `intro_video_image` varchar(191) DEFAULT NULL,
  `intro_signature` varchar(191) DEFAULT NULL,
  `intro_video_link` varchar(191) DEFAULT NULL,
  `intro_main_image` varchar(191) DEFAULT NULL,
  `team_section_title` varchar(255) DEFAULT NULL,
  `team_section_subtitle` varchar(255) DEFAULT NULL,
  `contact_form_title` varchar(255) DEFAULT NULL,
  `contact_address` text DEFAULT NULL,
  `contact_number` text DEFAULT NULL,
  `contact_mails` text DEFAULT NULL,
  `contact_text` varchar(255) DEFAULT NULL,
  `latitude` varchar(191) DEFAULT NULL,
  `longitude` varchar(191) DEFAULT NULL,
  `map_zoom` int(11) NOT NULL DEFAULT 10,
  `contact_info_title` varchar(191) DEFAULT NULL,
  `tawk_to_script` text DEFAULT NULL,
  `google_analytics_script` text DEFAULT NULL,
  `is_recaptcha` tinyint(4) NOT NULL DEFAULT 0,
  `google_recaptcha_site_key` varchar(255) DEFAULT NULL,
  `google_recaptcha_secret_key` varchar(255) DEFAULT NULL,
  `is_tawkto` tinyint(4) NOT NULL DEFAULT 1,
  `is_disqus` tinyint(4) NOT NULL DEFAULT 1,
  `disqus_script` text DEFAULT NULL,
  `is_analytics` tinyint(4) NOT NULL DEFAULT 1,
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 - active, 0 - deactive',
  `maintenance_text` text DEFAULT NULL,
  `ips` text DEFAULT NULL,
  `testimonial_title` varchar(255) DEFAULT NULL,
  `blog_section_title` varchar(255) DEFAULT NULL,
  `blog_section_subtitle` varchar(191) DEFAULT NULL,
  `blog_title` varchar(255) DEFAULT NULL,
  `blog_details_title` varchar(255) DEFAULT NULL,
  `gallery_title` varchar(255) DEFAULT NULL,
  `team_title` varchar(255) DEFAULT NULL,
  `contact_title` varchar(255) DEFAULT NULL,
  `menu_title` varchar(191) DEFAULT NULL,
  `reservation_title` varchar(191) DEFAULT NULL,
  `items_title` varchar(191) DEFAULT NULL,
  `menu_details_title` varchar(191) DEFAULT NULL,
  `cart_title` varchar(191) DEFAULT NULL,
  `checkout_title` varchar(191) DEFAULT NULL,
  `error_title` varchar(255) DEFAULT NULL,
  `home_version` varchar(30) DEFAULT NULL,
  `feature_section` tinyint(4) NOT NULL DEFAULT 1,
  `intro_section` tinyint(4) NOT NULL DEFAULT 1,
  `testimonial_section` tinyint(4) NOT NULL DEFAULT 1,
  `team_section` tinyint(4) NOT NULL DEFAULT 1,
  `news_section` tinyint(4) NOT NULL DEFAULT 1,
  `menu_section` int(11) NOT NULL DEFAULT 1,
  `special_section` int(11) NOT NULL DEFAULT 1,
  `instagram_section` int(11) NOT NULL DEFAULT 1,
  `table_section` int(11) NOT NULL DEFAULT 1,
  `top_footer_section` tinyint(4) NOT NULL DEFAULT 1,
  `copyright_section` tinyint(4) NOT NULL DEFAULT 1,
  `is_quote` tinyint(4) NOT NULL DEFAULT 1,
  `office_time` varchar(255) DEFAULT NULL,
  `is_appzi` tinyint(4) NOT NULL DEFAULT 0,
  `appzi_script` text DEFAULT NULL,
  `is_addthis` tinyint(4) NOT NULL DEFAULT 0,
  `addthis_script` text DEFAULT NULL,
  `token_no_start` int(11) NOT NULL DEFAULT 1,
  `token_no` int(11) NOT NULL DEFAULT 0,
  `postal_code` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - enabled, 0 - disabled',
  `qr_call_waiter` tinyint(4) NOT NULL DEFAULT 1,
  `website_call_waiter` tinyint(4) NOT NULL DEFAULT 1,
  `is_whatsapp` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - enable, 0 - disable',
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `whatsapp_header_title` varchar(255) NOT NULL DEFAULT 'Chat with us on WhatsApp!',
  `whatsapp_popup_message` text DEFAULT NULL,
  `whatsapp_popup` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - enable, 0 - disable',
  `feature_title` text DEFAULT NULL,
  `testimonial_section_text` text DEFAULT NULL,
  `category_section_title` varchar(255) DEFAULT NULL,
  `intro_section_button_url` text DEFAULT NULL,
  `intro_section_button_text` varchar(50) DEFAULT NULL,
  `intro_section_video_button_url` text DEFAULT NULL,
  `intro_section_video_button_text` varchar(100) DEFAULT NULL,
  `intro_section_video_button_title` varchar(100) DEFAULT NULL,
  `intro_section_highlight_text` text DEFAULT NULL,
  `intro_section_bg_image` varchar(50) DEFAULT NULL,
  `intro_section_author_image` varchar(50) DEFAULT NULL,
  `intro_section_author_name` varchar(30) DEFAULT NULL,
  `intro_section_author_designation` varchar(50) DEFAULT NULL,
  `intro_section_top_shape_image` varchar(50) DEFAULT NULL,
  `intro_section_bottom_shape_image` varchar(50) DEFAULT NULL,
  `features_section_bg_color` varchar(30) DEFAULT NULL,
  `features_section_top_shape_image` varchar(50) DEFAULT NULL,
  `features_section_bottom_shape_image` varchar(50) DEFAULT NULL,
  `theme` varchar(50) NOT NULL DEFAULT 'multipurpose'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_settings`
--

INSERT INTO `basic_settings` (`id`, `language_id`, `favicon`, `logo`, `preloader_status`, `preloader`, `website_title`, `base_color`, `secondary_base_color`, `support_email`, `support_phone`, `breadcrumb`, `footer_logo`, `footer_text`, `newsletter_text`, `copyright_text`, `intro_section_title`, `intro_title`, `intro_text`, `intro_contact_text`, `intro_contact_number`, `intro_video_image`, `intro_signature`, `intro_video_link`, `intro_main_image`, `team_section_title`, `team_section_subtitle`, `contact_form_title`, `contact_address`, `contact_number`, `contact_mails`, `contact_text`, `latitude`, `longitude`, `map_zoom`, `contact_info_title`, `tawk_to_script`, `google_analytics_script`, `is_recaptcha`, `google_recaptcha_site_key`, `google_recaptcha_secret_key`, `is_tawkto`, `is_disqus`, `disqus_script`, `is_analytics`, `maintenance_mode`, `maintenance_text`, `ips`, `testimonial_title`, `blog_section_title`, `blog_section_subtitle`, `blog_title`, `blog_details_title`, `gallery_title`, `team_title`, `contact_title`, `menu_title`, `reservation_title`, `items_title`, `menu_details_title`, `cart_title`, `checkout_title`, `error_title`, `home_version`, `feature_section`, `intro_section`, `testimonial_section`, `team_section`, `news_section`, `menu_section`, `special_section`, `instagram_section`, `table_section`, `top_footer_section`, `copyright_section`, `is_quote`, `office_time`, `is_appzi`, `appzi_script`, `is_addthis`, `addthis_script`, `token_no_start`, `token_no`, `postal_code`, `qr_call_waiter`, `website_call_waiter`, `is_whatsapp`, `whatsapp_number`, `whatsapp_header_title`, `whatsapp_popup_message`, `whatsapp_popup`, `feature_title`, `testimonial_section_text`, `category_section_title`, `intro_section_button_url`, `intro_section_button_text`, `intro_section_video_button_url`, `intro_section_video_button_text`, `intro_section_video_button_title`, `intro_section_highlight_text`, `intro_section_bg_image`, `intro_section_author_image`, `intro_section_author_name`, `intro_section_author_designation`, `intro_section_top_shape_image`, `intro_section_bottom_shape_image`, `features_section_bg_color`, `features_section_top_shape_image`, `features_section_bottom_shape_image`, `theme`) VALUES
(153, 176, '6897d415b4607.png', '6897d3fa77fb0.png', 1, '68965077e716b.gif', 'King Kebab', 'D3A971', '0A3041', 'support@kingkebabrestaurant.com', '+33 0426423743', '68966dc595a01.jpg', '6897d43e08f91.png', '\"Chez King Kebab, nous vous offrons une expérience culinaire unique où la tradition du kebab rencontre la fraîcheur des ingrédients de qualité, le tout préparé avec passion et grillé à la perfection pour satisfaire les palais les plus exigeants.\"', 'Subscribe to gate Latest News, Offer and connect With Us.', 0x436f7079726967687420c2a920323032352e20416c6c20726967687473207265736572766564206279204b696e67204b656261622e, 'Our Story', 'Fort de 20 ans d’expérience dans l’art du kebab', 'Notre Restaurant\r\nDepuis deux décennies, nous sélectionnons les meilleurs ingrédients frais pour vous garantir une qualité irréprochable et un goût unique à chaque bouchée.', 'Service Téléphonique 24/7', '+33 0426423743', '6897ea748e99a.jpg', '5f5b0ee606923.png', 'https://youtu.be/DzSSUU37ynQ', '68967e81b67b5.jpg', 'Our Team', 'Our Expert Members', 'Laisser une réponse', '20, avenue Marcel Nicolas', '+33 0426423743', 'support@kingkebabrestaurant.com', 'Pour toute question, réservation ou commande, n’hésitez pas à nous contacter.', '100', '110', 0, 'COORDONNÉES', '<!--Start of Tawk.to Script-->\r\n<script type=\"text/javascript\">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\ns1.async=true;\r\ns1.src=\'https://embed.tawk.to/5f5e445f4704467e89ee918d/default\';\r\ns1.charset=\'UTF-8\';\r\ns1.setAttribute(\'crossorigin\',\'*\');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n</script>\r\n<!--End of Tawk.to Script-->', '<!-- Global site tag (gtag.js) - Google Analytics -->\r\n<script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-137437974-2\"></script>\r\n<script>\r\n  window.dataLayer = window.dataLayer || [];\r\n  function gtag(){dataLayer.push(arguments);}\r\n  gtag(\'js\', new Date());\r\n\r\n  gtag(\'config\', \'UA-137437974-2\');\r\n</script>', 0, '6LcNapgfAAAAANlRx0HEcRXhjzD5ZzAV7FPpKmds', '6LcNapgfAAAAAHz1D4vlw3Qto7HFKPtmmW_T2nOR', 0, 1, '<script>\r\n    /**\r\n    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.\r\n    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */\r\n    /*\r\n    var disqus_config = function () {\r\n    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page\'s canonical URL variable\r\n    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page\'s unique identifier variable\r\n    };\r\n    */\r\n    (function() { // DON\'T EDIT BELOW THIS LINE\r\n    var d = document, s = d.createElement(\'script\');\r\n    s.src = \'https://superv-1.disqus.com/embed.js\';\r\n    s.setAttribute(\'data-timestamp\', +new Date());\r\n    (d.head || d.body).appendChild(s);\r\n    })();\r\n</script>', 0, 0, 'Error  404', 'testing2fgfgddd', 'Que disent nos clients ?', 'Notre Blog', 'Derniers flux d\'actualités', 'Latest Blog', 'Blog Details', 'Our Gallery', 'Team Members', 'Contactez-nous', 'Notre menu', 'Reserve Table', 'Nos articles', 'Item Details', 'Cart', 'Checkout', '404 Not Found', 'video', 1, 1, 1, 0, 1, 0, 0, 1, 0, 1, 1, 1, 'Mon to Friday  9Am - 11 Pm', 0, '<!-- Appzi: Capture Insightful Feedback -->\r\n<script async src=\"https://w.appzi.io/w.js?token=p5cpm\"></script>\r\n<!-- End Appzi -->', 0, '<!-- Go to www.addthis.com/dashboard to customize your tools -->\r\n<script type=\"text/javascript\" src=\"//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e74e0cf10c08cfa\"></script>', 1, 184, 1, 1, 1, 1, '+33 0426423743', 'Discutez avec nous sur WhatsApp !', 'Comment pouvons-nous vous aider?', 1, 'Découvrez nos kebabs les plus savoureux et appréciés par nos clients', 'ssffffffffffffffff', 'Discover Your Favorite Bakery And Pastry Foods', 'https://www.youtube.com/watch?v=GlrxcuEDyF8', 'Order Now', NULL, 'How To Place Order', 'fff', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', NULL, '640efc12b3d40.jpg', 'dfdff test', 'sdfdd test', '64313d1503aa7.png', '641ea69a4b116.png', '62401A', '64252e50659d6.png', '64252e5065dcb.png', 'multipurpose');

-- --------------------------------------------------------

--
-- Table structure for table `bcategories`
--

CREATE TABLE `bcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `serial_number` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bcategories`
--

INSERT INTO `bcategories` (`id`, `language_id`, `name`, `status`, `serial_number`) VALUES
(1, 176, 'Art Culinaire', 1, 1),
(3, 176, 'Notre Restaurant', 1, 2),
(4, 176, 'Spécialités Kebab', 1, 3),
(5, 176, 'Expérience Client', 1, 4),
(6, 176, 'Recettes & Secrets', 1, 5),
(12, 176, 'Actualités King Kebab', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT 0,
  `bcategory_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `content` blob DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `language_id`, `bcategory_id`, `title`, `slug`, `main_image`, `content`, `tags`, `meta_keywords`, `meta_description`, `serial_number`, `created_at`, `updated_at`) VALUES
(66, 176, 1, 'L\'Art du Kebab Authentique chez King Kebab', 'lart-du-kebab-authentique-chez-king-kebab', '1598694784.jpg', 0x4368657a204b696e67204b656261622c206e6f75732070657270c3a974756f6e73206c6120747261646974696f6e206d696c6cc3a96e61697265206475206b656261622061757468656e74697175652e204e6f7320636865667320657870c3a972696d656e74c3a973207072c3a9706172656e7420636861717565206b6562616220617665632070617373696f6e2c20656e207574696c6973616e742064657320c3a9706963657320736f69676e657573656d656e742073c3a96c656374696f6e6ec3a9657320657420646573207669616e646573206465207072656d69c3a87265207175616c6974c3a92e204c612063756973736f6e206c656e746520737572206e6f7472652062726f63686520747261646974696f6e6e656c6c6520676172616e74697420756e652073617665757220696e636f6d70617261626c6520657420756e652074656e64726574c3a920657863657074696f6e6e656c6c652e200d0a0d0a44c3a9636f757672657a206e6f74726520736563726574203a20756e206dc3a96c616e676520756e69717565206427c3a97069636573206f7269656e74616c6573207472616e736d69732064652067c3a96ec3a9726174696f6e20656e2067c3a96ec3a9726174696f6e2c20616c6c69616e74206c652063756d696e2070617266756dc3a92c206c652070617072696b612066756dc3a92c206574206c65732068657262657320667261c3ae63686573206465204dc3a9646974657272616ec3a9652e2043686171756520626f756368c3a96520766f7573207472616e73706f7274652064616e7320756e20766f796167652063756c696e616972652061757468656e74697175652076657273206c65732073617665757273206475204d6f79656e2d4f7269656e742e0d0a0d0a4e6f74726520656e676167656d656e7420656e76657273206c61207175616c6974c3a9207365207265666cc3a874652064616e73206368617175652064c3a97461696c203a2064752063686f6978206d696e757469657578206465206e6f7320666f75726e69737365757273206c6f6361757820c3a0206c61207072c3a97061726174696f6e2071756f74696469656e6e65206465206e6f73206d6172696e616465732e2056656e657a207361766f75726572206c27657863656c6c656e636520c3a02063686171756520766973697465206368657a204b696e67204b656261622e, 'kebab, authentique, tradition, épices, qualité', 'kebab, authentique, tradition, épices, qualité', 'Chez King Kebab, nous perpétuons la tradition millénaire du kebab authentique. Nos chefs expérimentés préparent chaque kebab avec passion, en utilisant des', 1, '2020-08-29 03:47:49', '2025-08-08 22:50:11'),
(67, 176, 6, 'Les Secrets de nos Marinades Orientales', 'les-secrets-de-nos-marinades-orientales', '1598694802.jpg', 0x4c6573206d6172696e6164657320736f6e74206c27c3a26d65206465206e6f73206b6562616273206368657a204b696e67204b656261622e20436861717565206d6174696e2c206e6f73206368656673207072c3a9706172656e74206176656320616d6f757220646573206d6172696e6164657320756e697175657320717569207375626c696d656e74206c6120736176657572206465206e6f73207669616e6465732e204c652070726f63657373757320636f6d6d656e6365206176616e74206c27617562652061766563206c612073c3a96c656374696f6e2064657320c3a97069636573206c657320706c757320667261c3ae636865732e0d0a0d0a4e6f747265206d6172696e616465207369676e617475726520636f6d62696e65206c2761696c20667261697320c3a963726173c3a92c206c652079616f7572742067726563206f6e6374756575782c206c276875696c652064276f6c697665206578747261207669657267652c20657420756e20626f7571756574206427c3a970696365732073656372c3a87465732e204c652074656d7073206465206d6172696e6164652076617269652073656c6f6e206c652074797065206465207669616e6465203a2032342068657572657320706f7572206c2761676e6561752c2031382068657572657320706f7572206c652062c59375662c2065742031322068657572657320706f7572206c6520706f756c65742e0d0a0d0a43657474652070617469656e63652063756c696e61697265207472616e73666f726d65206e6f73207669616e64657320656e2064c3a96c6963657320666f6e64616e74732071756920726176697373656e74206c657320706170696c6c65732e204c652072c3a973756c746174203f20446573206b6562616273206a75746575782c2070617266756dc3a97320657420697272c3a97369737469626c65732071756920666f6e74206c612072656e6f6d6dc3a965206465204b696e67204b656261622064616e7320746f757465206c612072c3a967696f6e2e, 'marinade, épices, tradition, secret, saveur', 'marinade, épices, tradition, secret, saveur', 'Les marinades sont l\'âme de nos kebabs chez King Kebab. Chaque matin, nos chefs préparent avec amour des marinades uniques qui subliment la saveur de nos vian', 2, '2020-08-29 03:50:37', '2025-08-08 22:50:11'),
(68, 176, 3, 'King Kebab : Une Histoire de Passion Culinaire', 'king-kebab-une-histoire-de-passion-culinaire', '1598694694.jpg', 0x4c27686973746f697265206465204b696e67204b6562616220636f6d6d656e636520696c2079206120706c757320646520323020616e73206176656320756e2072c3aa76652073696d706c65203a207061727461676572206c2761757468656e7469636974c3a9206465206c612063756973696e65206f7269656e74616c652061766563206e6f74726520636f6d6d756e617574c3a92e20466f6e64c3a92070617220756e652066616d696c6c652070617373696f6e6ec3a9652064652067617374726f6e6f6d69652c206e6f7472652072657374617572616e742065737420646576656e7520756e652072c3a966c3a972656e636520696e636f6e746f75726e61626c6520706f7572206c657320616d617465757273206465206b656261622061757468656e74697175652e0d0a0d0a4465206e6f732068756d626c65732064c3a9627574732064616e7320756e207065746974206c6f63616c20c3a0206e6f74726520657870616e73696f6e2061637475656c6c652c206e6f75732061766f6e7320746f756a6f757273206d61696e74656e75206e6f732076616c6575727320666f6e64616d656e74616c6573203a207175616c6974c3a920697272c3a970726f636861626c652c2073657276696365206368616c6575726575782c20657420726573706563742064657320747261646974696f6e732063756c696e616972657320616e6365737472616c65732e20436861717565206d656d627265206465206e6f74726520c3a9717569706520706172746167652063657474652070617373696f6e207175692073652072657373656e742064616e732063686171756520706c61742073657276692e0d0a0d0a41756a6f757264276875692c204b696e67204b65626162206163637565696c6c6520646573206d696c6c6965727320646520636c69656e7473207361746973666169747320636861717565206d6f69732c206d616973206e6f757320726573746f6e7320666964c3a86c657320c3a0206e6f747265207068696c6f736f70686965206172746973616e616c652e20436861717565206b6562616220657374207072c3a9706172c3a92061766563206c65206dc3aa6d6520736f696e206574206c61206dc3aa6d6520617474656e74696f6e206175782064c3a97461696c73207175276175207072656d696572206a6f75722e, 'histoire, passion, famille, tradition, authentique', 'histoire, passion, famille, tradition, authentique', 'L\'histoire de King Kebab commence il y a plus de 20 ans avec un rêve simple : partager l\'authenticité de la cuisine orientale avec notre communauté. Fondé p', 3, '2020-08-29 03:51:34', '2025-08-08 22:50:11'),
(69, 176, 3, 'Notre Menu : Diversité et Excellence', 'notre-menu-diversite-et-excellence', '1598694769.jpg', 0x4c65206d656e75206465204b696e67204b65626162207265666cc3a87465206c61207269636865737365206465206c612063756973696e65206f7269656e74616c65206d6f6465726e652e2041752d64656cc3a0206465206e6f73206b6562616273206cc3a967656e6461697265732c206e6f75732070726f706f736f6e7320756e652076617269c3a974c3a920646520706c61747320717569207361746973666f6e7420746f7573206c657320676fc3bb747320657420746f75746573206c657320656e766965732e20446573206772696c6c616465732070617266756dc3a96573206175782073616c6164657320667261c3ae636865732c20656e2070617373616e7420706172206e6f73206d657a7a6520747261646974696f6e6e656c732e0d0a0d0a4e6f73207370c3a96369616c6974c3a97320696e636c75656e74206c65204b6562616220526f79616c20c3a0206c2761676e656175206d6172696ec3a9203234682c206c65204b656261622056c3a967c3a974617269656e20617578206cc3a967756d6573206772696c6cc3a9732065742068616c6c6f756d692c206574206e6f7472652066616d6f7573204d6978204772696c6c20706f757220706172746167657220656e2066616d696c6c652e2043686171756520706c617420657374206163636f6d7061676ec3a9206465206e6f7320736175636573206d6169736f6e203a206c6120736175636520626c616e636865206372c3a96d657573652c206c61206861726973736120c3a9706963c3a9652c206574206e6f747265207361756365207370c3a96369616c65204b696e67204b656261622e0d0a0d0a506f757220636f6d706cc3a974657220766f74726520657870c3a97269656e63652c2064c3a9636f757672657a206e6f73206465737365727473206f7269656e746175782061757468656e746971756573203a2062616b6c6176612063726f757374696c6c616e74206175206d69656c2c206b756e65666520666f6e64616e742c206574206e6f74726520746972616d697375206f7269656e74616c20756e697175652e20556e65206578706c6f73696f6e20646520736176657572732071756920636f75726f6e6e652070617266616974656d656e7420766f747265207265706173206368657a204b696e67204b656261622e, 'menu, diversité, spécialités, desserts, sauces', 'menu, diversité, spécialités, desserts, sauces', 'Le menu de King Kebab reflète la richesse de la cuisine orientale moderne. Au-delà de nos kebabs légendaires, nous proposons une variété de plats qui satis', 4, '2020-08-29 03:52:49', '2025-08-08 22:50:11'),
(70, 176, 5, 'L\'Expérience Client au Cœur de nos Priorités', 'lexperience-client-au-coeur-de-nos-priorites', '1598694837.jpg', 0x4368657a204b696e67204b656261622c2063686171756520636c69656e742065737420756e20696e766974c3a9206427686f6e6e6575722e204e6f74726520c3a971756970652064c3a9766f75c3a965207327656e6761676520c3a0206f666672697220756e6520657870c3a97269656e63652063756c696e61697265206dc3a96d6f7261626c652064616e7320756e6520616d6269616e6365206368616c6575726575736520657420636f6e76697669616c652e2044c3a87320766f747265206172726976c3a9652c20766f757320736572657a206163637565696c6c692061766563206c6520736f7572697265206574206c6120686f73706974616c6974c3a9206cc3a967656e6461697265206f7269656e74616c652e0d0a0d0a4e6f747265207365727669636520636f6d7072656e6420706c75736965757273206f7074696f6e7320706f757220766f74726520636f6e666f7274203a20636f6d6d616e64652073757220706c6163652064616e73206e6f7472652073616c6c65206163637565696c6c616e74652c2073657276696365206465206c6976726169736f6e2072617069646520c3a020646f6d6963696c652c206574206f7074696f6e20c3a020656d706f7274657220706f757220766f732064c3a96a65756e65727320642761666661697265732e204e6f7573206e6f75732061646170746f6e7320c3a020766f74726520727974686d65206465207669652073616e7320636f6d70726f6d6574747265206c61207175616c6974c3a92e0d0a0d0a4c65732061766973206465206e6f7320636c69656e74732074c3a96d6f69676e656e74206465206e6f7472652073756363c3a873203a20224d65696c6c657572206b65626162206465206c612076696c6c65222c20225365727669636520696d7065636361626c65222c2022536176657572732061757468656e746971756573222e20436573207265746f757273206e6f7573206d6f746976656e742071756f74696469656e6e656d656e7420c3a0206d61696e74656e6972206e6f73207374616e6461726473206427657863656c6c656e636520657420c3a020696e6e6f76657220636f6e7374616d6d656e7420706f757220766f7573207375727072656e6472652e, 'service, client, expérience, qualité, accueil', 'service, client, expérience, qualité, accueil', 'Chez King Kebab, chaque client est un invité d\'honneur. Notre équipe dévouée s\'engage à offrir une expérience culinaire mémorable dans une ambiance chale', 5, '2020-08-29 03:53:57', '2025-08-08 22:50:11'),
(71, 176, 5, 'Fusce convallis enim non magna Duis lacus dignissim.', 'Fusce-convallis-enim-non-magna-Duis-lacus-dignissim.', '1598694875.jpg', 0x69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e, NULL, NULL, NULL, 6, '2020-08-29 03:54:35', '2020-08-29 03:54:35'),
(72, 176, 3, 'Non magna pharetra facilisis. lacus nulla dignissim.', 'Non-magna-pharetra-facilisis.-lacus-nulla-dignissim.', '1598694928.jpg', 0x69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e, NULL, NULL, NULL, 7, '2020-08-29 03:55:28', '2020-08-29 03:55:28'),
(73, 176, 3, 'Non magna pharetra facilisis. lacus nulla dignissim.', 'Non-magna-pharetra-facilisis.-lacus-nulla-dignissim.', '1598694962.jpg', 0x69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e, NULL, NULL, NULL, 8, '2020-08-29 03:56:02', '2020-08-29 03:56:02'),
(74, 176, 1, 'Fusce convallis enim non magna Duis lacus dignissim.', 'Fusce-convallis-enim-non-magna-Duis-lacus-dignissim.', '1598695007.jpg', 0x69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e, NULL, NULL, NULL, 9, '2020-08-29 03:56:47', '2020-08-29 03:56:47'),
(84, 176, 3, 'Nos Ingrédients : Fraîcheur et Qualité Garanties', 'nos-ingredients-fraicheur-et-qualite-garanties', NULL, 0x4c61207175616c6974c3a920657863657074696f6e6e656c6c65206465206e6f73206b6562616273207265706f73652073757220756e652073c3a96c656374696f6e207269676f757265757365206427696e6772c3a96469656e74732066726169732065742061757468656e7469717565732e204368657a204b696e67204b656261622c206e6f75732070726976696cc3a967696f6e73206c657320636972637569747320636f75727473206574206c65732070726f6475637465757273206c6f6361757820706f757220676172616e746972206c6120667261c3ae6368657572206d6178696d616c65206465206e6f732070726f64756974732e0d0a0d0a4e6f73206cc3a967756d657320736f6e74206c697672c3a9732071756f74696469656e6e656d656e74203a20746f6d61746573206a757465757365732c206f69676e6f6e732063726f7175616e74732c20636f6e636f6d62726573207261667261c3ae6368697373616e74732c2065742073616c616465207665727465206269656e2063726f7175616e74652e204e6f747265207061696e207069746120657374206375697420706c7573696575727320666f697320706172206a6f75722064616e73206e6f74726520666f757220747261646974696f6e6e656c2c20676172616e74697373616e742063657474652074657874757265206d6f656c6c6575736520657420636520676fc3bb7420696e636f6d70617261626c6520717569206163636f6d7061676e652070617266616974656d656e74206e6f73206b65626162732e0d0a0d0a4c6120747261c3a76162696c6974c3a9206465206e6f73207669616e6465732065737420756e65207072696f726974c3a9206162736f6c75652e204e6f7573207472617661696c6c6f6e73206578636c75736976656d656e7420617665632064657320c3a96c6576657572732063657274696669c3a973207175692072657370656374656e74206c65206269656e2dc3aa74726520616e696d616c206574206c6573206e6f726d6573206465207175616c6974c3a9206c657320706c75732073747269637465732e2043657474652065786967656e63652073652072657373656e742064616e732063686171756520626f756368c3a965206465206e6f73206b6562616273207361766f75726575782e, 'ingrédients, fraîcheur, qualité, local, traçabilité', 'ingrédients, fraîcheur, qualité, local, traçabilité', 'La qualité exceptionnelle de nos kebabs repose sur une sélection rigoureuse d\'ingrédients frais et authentiques. Chez King Kebab, nous privilégions les circ', 10, '2025-08-08 22:50:11', '2025-08-08 22:50:11'),
(85, 176, 3, 'Les Bienfaits Nutritionnels de la Cuisine Orientale', 'les-bienfaits-nutritionnels-de-la-cuisine-orientale', NULL, 0x4c612063756973696e65206f7269656e74616c652c20646f6e74204b696e67204b6562616220657374206c652072657072c3a973656e74616e7420666964c3a86c652c206f66667265206465206e6f6d6272657578206176616e7461676573206e7574726974696f6e6e656c7320736f7576656e74206dc3a9636f6e6e75732e204e6f7320706c61747320616c6c69656e742073617665757220657420c3a97175696c69627265206e7574726974696f6e6e656c2c206772c3a2636520c3a0206c277574696c69736174696f6e206427c3a97069636573206175782070726f707269c3a974c3a9732062c3a96ec3a9666971756573206574206427696e6772c3a96469656e7473206e61747572656c732e0d0a0d0a4c652063756d696e2c207072c3a973656e742064616e73206e6f73206d6172696e616465732c206661766f72697365206c6120646967657374696f6e20657420706f7373c3a86465206465732070726f707269c3a974c3a97320616e74692d696e666c616d6d61746f697265732e204c652070617072696b61206170706f7274652064657320616e74696f787964616e74732c2074616e64697320717565206c2761696c2066726169732072656e666f726365206c652073797374c3a86d6520696d6d756e6974616972652e204e6f73206cc3a967756d6573206772696c6cc3a97320636f6e73657276656e74206c6575727320766974616d696e6573206574206d696ec3a97261757820657373656e7469656c732e0d0a0d0a436f6e7472616972656d656e7420617578206964c3a96573207265c3a77565732c206e6f73206b65626162732070657576656e74207327696e74c3a9677265722070617266616974656d656e742064616e7320756e6520616c696d656e746174696f6e20c3a97175696c696272c3a9652e2052696368657320656e2070726f74c3a9696e6573206465207175616c6974c3a92c206163636f6d7061676ec3a973206465206cc3a967756d65732066726169732065742064652063c3a972c3a9616c657320636f6d706cc3a87465732c20696c7320636f6e7374697475656e7420756e20726570617320636f6d706c6574206574206e757472697469662e204368657a204b696e67204b656261622c206269656e206d616e6765722072696d65206176656320706c61697369722067757374617469662e, 'nutrition, santé, épices, équilibre, bienfaits', 'nutrition, santé, épices, équilibre, bienfaits', 'La cuisine orientale, dont King Kebab est le représentant fidèle, offre de nombreux avantages nutritionnels souvent méconnus. Nos plats allient saveur et éq', 11, '2025-08-08 22:50:11', '2025-08-08 22:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `bottomlinks`
--

CREATE TABLE `bottomlinks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bottomlinks`
--

INSERT INTO `bottomlinks` (`id`, `language_id`, `name`, `url`, `created_at`, `updated_at`) VALUES
(11, 169, 'Career', 'https://megasoft.biz/plusagency/services?category=9', NULL, NULL),
(12, 169, 'Terms of service', 'https://megasoft.biz/plusagency/services?category=9', NULL, NULL),
(13, 169, 'Refund policy', 'https://megasoft.biz/plusagency/services?category=9', NULL, NULL),
(14, 176, 'Privacy Policy', '/Privacy-Policy/4/page', NULL, NULL),
(15, 176, 'Terms & Conditions', '/Terms-&-Conditions/3/page', NULL, NULL),
(16, 176, 'About', '/About-Us/1/page', NULL, NULL),
(17, 177, 'link 1', 'https://megasoft.biz/alphasoft/', NULL, NULL),
(18, 177, 'link 2', 'https://megasoft.biz/alphasoft/', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT 'percentage, fixed',
  `value` decimal(11,2) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `minimum_spend` decimal(11,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `code`, `type`, `value`, `start_date`, `end_date`, `minimum_spend`, `created_at`, `updated_at`) VALUES
(2, 'KHABO60', 'KHABO60', 'fixed', 60.00, '12/24/2020', '12/30/2020', 180.00, '2020-12-23 02:23:36', '2020-12-23 02:23:36'),
(3, 'Victory Day', 'BIJOY16', 'percentage', 16.00, '12/16/2020', '01/07/2021', 10.00, '2020-12-23 02:32:55', '2020-12-24 04:54:59'),
(4, 'Special', 'Special14', 'percentage', 14.00, '12/29/2020', '01/09/2021', 400.00, '2020-12-23 03:54:07', '2020-12-24 08:54:42'),
(5, 'Shop Manager', '123456789', 'percentage', 10.00, '04/01/2023', '05/31/2023', 1.00, '2023-05-04 04:33:42', '2023-05-04 04:33:42');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(8, 'Drake', 'drake@gmail.com', '47347348', 'CA, USA', '2021-04-11 02:52:49', '2021-04-11 02:52:49'),
(9, 'Tom', 'tom@gmail.com', '4734734819', NULL, '2021-04-11 02:52:59', '2021-04-11 02:52:59'),
(10, 'jhon', 'jhon@gmail.com', '017200000', 'America', '2021-05-09 09:48:47', '2022-04-17 11:52:57'),
(11, 'jhon', 'jhon@gmail.com', '0172000001', NULL, '2021-05-09 09:51:58', '2021-05-09 09:51:58'),
(14, 'John', 'geniustest11@gmail.com', '262332', NULL, '2021-05-18 06:07:14', '2021-05-18 06:07:14'),
(34, NULL, NULL, NULL, NULL, '2025-08-08 22:30:39', '2025-08-08 22:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email_type` varchar(100) DEFAULT NULL,
  `email_subject` text DEFAULT NULL,
  `email_body` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `email_type`, `email_subject`, `email_body`) VALUES
(2, 'email_verification', 'Verify Your Email', 0x3c70207374796c653d226c696e652d6865696768743a20312e363b223e48656c6c6f3c623e207b637573746f6d65725f6e616d657d3c2f623e2c3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e506c6561736520636c69636b20746865206c696e6b2062656c6f7720746f2076657269667920796f757220656d61696c2e3c2f703e3c703e7b766572696669636174696f6e5f6c696e6b7d3c2f703e3c703e3c62723e3c2f703e3c703e4265737420526567617264732c3c2f703e3c703e7b776562736974655f7469746c657d3c2f703e),
(3, 'order_received', 'Order Received', 0x3c70207374796c653d226c696e652d6865696768743a20312e363b223e48656c6c6f207b637573746f6d65725f6e616d657d2c3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e596f7572206f7264657220686173206265656e2072656365697665642e3c62723e4f72646572204e756d6265723a20237b6f726465725f6e756d6265727d3c2f703e3c703e3c62723e506c6561736520636c69636b206f6e207468652062656c6f77206c696e6b20746f2073656520796f7572206f726465722064657461696c732e3c62723e7b6f726465725f6c696e6b7d3c2f703e3c703e3c62723e3c2f703e3c703e4265737420526567617264732c3c62723e7b776562736974655f7469746c657d3c2f703e),
(4, 'order_preparing', 'Preparing Your Order', 0x3c70207374796c653d226c696e652d6865696768743a20312e363b223e48656c6c6f207b637573746f6d65725f6e616d657d2c3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e4368656620686173207374617274656420707265706172696e6720796f7572206f72646572656420666f6f64732e3c62723e4f72646572204e756d6265723a266e6273703b20237b6f726465725f6e756d6265727d3c2f703e3c703e3c62723e506c6561736520636c69636b206f6e207468652062656c6f77206c696e6b20746f2073656520796f7572206f726465722064657461696c732e3c62723e7b6f726465725f6c696e6b7d3c2f703e3c703e3c62723e3c2f703e3c703e4265737420526567617264732c3c62723e7b776562736974655f7469746c657d3c2f703e),
(5, 'order_ready_to_pickup', 'Your Order is Ready to Pickup', 0x3c70207374796c653d226c696e652d6865696768743a20312e363b223e48656c6c6f207b637573746f6d65725f6e616d657d2c3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e596f7572206f7264657220697320726561647920746f207069636b75702e204f75722064656c6976657279206d616e2077696c6c207069636b20757020746865206f7264657220736f6f6e2e3c62723e4f72646572204e756d6265723a266e6273703b20237b6f726465725f6e756d6265727d3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e506c6561736520636c69636b206f6e207468652062656c6f77206c696e6b20746f2073656520796f7572206f726465722064657461696c732e3c62723e7b6f726465725f6c696e6b7d3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e3c2f703e3c703e4265737420526567617264732c3c62723e7b776562736974655f7469746c657d3c2f703e),
(6, 'order_ready_to_pickup_pick_up', 'Your order is ready to pick up', 0x3c70207374796c653d226c696e652d6865696768743a20312e363b223e48656c6c6f207b637573746f6d65725f6e616d657d2c3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e596f7572206f7264657220697320726561647920746f207069636b75702e20506c65617365207069636b757020796f7572206f7264657220617420796f75722063686f73656e206461746520262074696d652e3c62723e4f72646572204e756d6265723a266e6273703b20237b6f726465725f6e756d6265727d3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e506c6561736520636c69636b206f6e207468652062656c6f77206c696e6b20746f2073656520796f7572206f726465722064657461696c732e3c62723e7b6f726465725f6c696e6b7d3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e3c2f703e3c703e4265737420526567617264732c3c62723e7b776562736974655f7469746c657d3c2f703e),
(7, 'order_pickedup', 'Order has been pickedup', 0x3c703e48656c6c6f207b637573746f6d65725f6e616d657d2c3c2f703e3c703e3c62723e596f7572206f72646572206973207069636b656420757020666f722064656c69766572792e2049742077696c6c206265206172726976656420696e206120666577206d6f6d656e74732e3c62723e4f72646572204e756d6265723a20237b6f726465725f6e756d6265727d3c2f703e3c703e3c62723e506c6561736520636c69636b206f6e207468652062656c6f77206c696e6b20746f2073656520796f7572206f726465722064657461696c732e3c62723e7b6f726465725f6c696e6b7d3c2f703e3c703e3c62723e3c2f703e3c703e4265737420526567617264732c3c62723e7b776562736974655f7469746c657d3c2f703e),
(8, 'order_pickedup_pick_up', 'You have picked up Ordered Food', 0x3c703e48656c6c6f207b637573746f6d65725f6e616d657d2c3c2f703e3c703e3c62723e596f75722068617665207069636b656420757020796f7572206f72646572656420466f6f642e3c62723e4f72646572204e756d6265723a20237b6f726465725f6e756d6265727d3c2f703e3c703e3c62723e506c6561736520636c69636b206f6e207468652062656c6f77206c696e6b20746f2073656520796f7572206f726465722064657461696c732e3c62723e7b6f726465725f6c696e6b7d3c2f703e3c703e3c62723e3c2f703e3c703e4265737420526567617264732c3c62723e7b776562736974655f7469746c657d3c2f703e),
(9, 'order_delivered', 'Order has been Delivered', 0x3c70207374796c653d226c696e652d6865696768743a20312e363b223e48656c6c6f207b637573746f6d65725f6e616d657d2c3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e596f7572206f7264657220686173206265656e2064656c6976657265642e3c62723e4f72646572204e756d6265723a20237b6f726465725f6e756d6265727d3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e506c6561736520636c69636b206f6e207468652062656c6f77206c696e6b20746f2073656520796f7572206f726465722064657461696c732e3c62723e7b6f726465725f6c696e6b7d3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e3c2f703e3c703e4265737420526567617264732c3c62723e7b776562736974655f7469746c657d3c2f703e),
(10, 'order_cancelled', 'Order is Cancelled', 0x3c70207374796c653d226c696e652d6865696768743a20312e363b223e48656c6c6f203c623e7b637573746f6d65725f6e616d657d3c2f623e2c3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e596f7572206f7264657220686173206265656e2063616e63656c6c65642e3c62723e4f72646572204e756d6265723a207b6f726465725f6e756d6265727d3c2f703e3c703e3c62723e506c6561736520636c69636b206f6e207468652062656c6f77206c696e6b20746f2073656520796f7572206f726465722064657461696c732e3c62723e7b6f726465725f6c696e6b7d3c2f703e3c703e3c62723e3c2f703e3c703e4265737420526567617264732c3c62723e3c623e7b776562736974655f7469746c657d3c2f623e3c2f703e),
(11, 'order_ready_to_serve', 'Your order is ready to serve on table', 0x3c703e48656c6c6f207b637573746f6d65725f6e616d657d2c3c2f703e3c703e3c62723e596f7572206f7264657220697320726561647920746f207365727665206f6e207461626c652e205761697465722077696c6c2073657276657220746865206f7264657220696e2061206d6f6d656e742e3c62723e4f72646572204e756d6265723a20237b6f726465725f6e756d6265727d3c2f703e3c703e3c62723e506c6561736520636c69636b206f6e207468652062656c6f77206c696e6b20746f2073656520796f7572206f726465722064657461696c732e3c62723e7b6f726465725f6c696e6b7d3c2f703e3c703e3c62723e3c2f703e3c703e4265737420526567617264732c3c62723e7b776562736974655f7469746c657d3c2f703e),
(12, 'order_served', 'You order is served on table', 0x3c703e48656c6c6f207b637573746f6d65725f6e616d657d2c3c2f703e3c703e3c62723e596f7572206f7264657220697320736572766564206f6e20796f7572207461626c652e20456e6a6f7920796f757220466f6f642e3c62723e4f72646572204e756d6265723a20237b6f726465725f6e756d6265727d3c2f703e3c703e3c62723e506c6561736520636c69636b206f6e207468652062656c6f77206c696e6b20746f2073656520796f7572206f726465722064657461696c732e3c62723e7b6f726465725f6c696e6b7d3c2f703e3c703e3c62723e3c2f703e3c703e4265737420526567617264732c3c62723e7b776562736974655f7469746c657d3c2f703e),
(13, 'food_checkout', 'Order has been placed', 0x3c70207374796c653d226c696e652d6865696768743a20312e363b223e48656c6c6f207b637573746f6d65725f6e616d657d2c3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e596f7572206f7264657220686173206265656e20706c61636564207375636365737366756c6c792e205765206861766520617474616368656420616e20696e766f69636520696e2074686973206d61696c2e3c62723e4f72646572204e756d6265723a20237b6f726465725f6e756d6265727d3c2f703e3c703e3c62723e506c6561736520636c69636b206f6e207468652062656c6f77206c696e6b20746f2073656520796f7572206f726465722064657461696c732e3c62723e7b6f726465725f6c696e6b7d3c2f703e3c703e3c62723e3c2f703e3c703e4265737420526567617264732c3c62723e7b776562736974655f7469746c657d3c2f703e),
(14, 'reservation_accept', 'Reservation Request Accepted', 0x3c703e48656c6c6f207b637573746f6d65725f6e616d657d2c3c2f703e3c703e3c62723e596f75207265736572766174696f6e207265717565737420686173206265656e2061636365707465642e3c2f703e3c703e3c62723e3c2f703e3c703e4265737420526567617264732c3c62723e7b776562736974655f7469746c657d3c2f703e),
(15, 'reservation_reject', 'Reservation Request Rejected', 0x3c70207374796c653d226c696e652d6865696768743a20312e363b223e48656c6c6f207b637573746f6d65725f6e616d657d2c3c2f703e3c70207374796c653d226c696e652d6865696768743a20312e363b223e3c62723e596f75207265736572766174696f6e207265717565737420686173206265656e2072656a65637465642e3c2f703e3c703e3c62723e3c2f703e3c703e4265737420526567617264732c3c62723e7b776562736974655f7469746c657d3c2f703e);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT 0,
  `question` varchar(255) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `serial_number` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `language_id`, `question`, `answer`, `serial_number`) VALUES
(20, 176, 'Why this app is so awesome', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.', 1),
(21, 176, 'Why this app is so awesome', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.', 2),
(22, 176, 'Why this app is so awesome', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.', 3),
(23, 176, 'Why this app is so awesome', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.', 4),
(24, 176, 'Why this app is so awesome', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.', 5),
(25, 176, 'Why this app is so awesome', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.', 6),
(26, 176, 'Why this app is so awesome', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.', 7),
(27, 176, 'Why this app is so awesome', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.', 8),
(28, 176, 'Why this app is so awesome', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.', 9),
(29, 176, 'Why this app is so awesome', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.', 10);

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `serial_number` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `language_id`, `image`, `title`, `serial_number`, `created_at`, `updated_at`) VALUES
(38, 176, '1599804681.png', 'Fresh Items', 2, NULL, NULL),
(42, 176, '1598681208.png', 'Tasty Foods', 3, NULL, NULL),
(43, 176, '1598681487.png', 'Sweet Cheeses', 4, NULL, NULL),
(50, 176, '1598681561.jpg', 'Best Pizzas', 5, NULL, NULL),
(51, 176, '1598681630.jpg', 'Hot Snacks', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `language_id`, `title`, `image`, `serial_number`, `created_at`, `updated_at`) VALUES
(78, 176, 'Boti Kabab', '1598075956.jpg', 1, '2020-08-21 23:59:16', '2020-08-21 23:59:16'),
(79, 176, 'Chef Cooking', '1598076003.jpg', 2, '2020-08-22 00:00:03', '2020-08-22 00:00:03'),
(80, 176, 'Blackberry', '1598076734.jpg', 3, '2020-08-22 00:12:14', '2020-08-22 00:12:14'),
(81, 176, 'Cutting Vegetables', '1598076779.jpg', 4, '2020-08-22 00:12:59', '2020-08-22 00:12:59'),
(82, 176, 'Black Burger', '1598076815.jpg', 5, '2020-08-22 00:13:35', '2020-08-22 00:13:35'),
(83, 176, 'Wine Glasses', '1598076856.jpg', 6, '2020-08-22 00:14:16', '2020-08-22 00:14:16'),
(84, 176, 'Tomatoes', '1598076946.jpg', 7, '2020-08-22 00:15:46', '2020-08-22 00:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `endpoint` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `endpoint`, `created_at`, `updated_at`) VALUES
(3, 'https://fcm.googleapis.com/fcm/send/dRDyV7OmiFg:APA91bHVyRIr4Fex43DVFIM_CC6Ldo9hieQFcgewtgoLNGfK_fpIzFgGAAP_INoOTjnmOzSjg5K1qJUKKLefZuz5uQBj3YFFuyREw5YqWVQt7AJTeAfo-bfiFEz6-BytS3JoYseML_wt', '2020-12-26 07:38:28', '2020-12-26 07:38:28'),
(4, 'https://fcm.googleapis.com/fcm/send/dt--VeNXQpk:APA91bEXROqytusuQiBN-WidokRxoe_IH7kR6Qi6zXD1Ajx-XyQ4EtEoJxg62WwI-j0RFq2xUjBe-Is7h17zlUMntaf4mgCUeDFtLiW98h8xoOfL3ynutkpMHmyqoldRHVZDZGOQY98X', '2020-12-26 10:04:17', '2020-12-26 10:04:17'),
(5, 'https://fcm.googleapis.com/fcm/send/fetLuDtmxNg:APA91bHqqBZBZzCuFd8Ae3hGHo5q972ktIjfZuRzek59nJXiwdn88UBtnuU9IwaxVznCJGxn1SdhlOFZ8sIsGyVBoK-GIm6KCk0iTuvwc1e3o0H4hfunWZe-o98HQpIXpYDAkan0DiAy', '2021-03-24 07:37:03', '2021-03-24 07:37:03'),
(6, 'https://updates.push.services.mozilla.com/wpush/v2/gAAAAABgXhAyYoUVkJ8ymIaucMN78o9LdNIJ2ZhWATCMTUa79O7Q_6IWuwZlWOkNi33elgKb73GjntPc0ErLR7FF9b0UU0BNiDpJdsEv0uqcGKdNWkiYlAdlmNPaR0rKI8VivAkeCPzjYhykXGdYpXVpR3TxceTSpWBzxivvTpCTLQlUq72QNO8', '2021-03-26 11:47:44', '2021-03-26 11:47:44'),
(7, 'https://fcm.googleapis.com/fcm/send/cmWvhqu3tv8:APA91bFobMGJpxJvuqHpFU7Y5vtVZNcvsykv_So9xDDoCqKLewXINW8QbmIkpha9i7CJZPAoaZjST1cJPnwwa0rbp-VCk8LOWRoxcuIyyUlsOIFCMCOwysBSFZm_1eBbVV9aeyLSENGc', '2021-04-03 00:02:31', '2021-04-03 00:02:31'),
(8, 'https://fcm.googleapis.com/fcm/send/eh4uTNYjL8g:APA91bEX1UoNIWd9wkORCAREAofoRcvvbmRdDNMQwd1d-EZ0lbfCU5CUXewaZucNBK81XO0z6h0LnUaBFPHRlEDrUGm90vu_GHDd5lrndy3l6Otqf5i921YWUa-Xwn4i0MSW5uoPAeMQ', '2021-04-16 11:36:28', '2021-04-16 11:36:28'),
(9, 'https://fcm.googleapis.com/fcm/send/dObB80OmAaw:APA91bFv7cirSdv3z2G0IU7AlDsIylsVt5C2Z3q53ZUNLMlvlOIfQiOshMF-xKknu8706NDLq9PJyhl7eCdOZlzw-pxRrgsW-p2PjU9N1bePkHnYSIPnTp5a4g1N1tDQQQQWNDjy9slX', '2021-05-06 09:40:57', '2021-05-06 09:40:57'),
(10, 'https://fcm.googleapis.com/fcm/send/eZKf01giLZc:APA91bH4tmbQ3s4Lv-B9nztPSZW3yd7Y2uXC-60sHsGIhKkOlUxP6oC68n37Vtq-FBk-OlTVlU76weuJ_vrW0BliQoqvrNRb8xstdCONgBIs47-5fgbphTiuONZgUp1nDtX8LfcFM-Iy', '2021-05-23 00:31:34', '2021-05-23 00:31:34'),
(11, 'https://fcm.googleapis.com/fcm/send/cPVrToqh8P0:APA91bEiMbgqN8bDAhr0mbdzXPcFOvc77t1WzG17LnxbEo7shs1OJ-UhjuXbKMj71Nx0_EjBlZNmj4Nl44WiksfgkV3COShKvj02S_ZpkTe5fD6WFwtIlPZ6LO-IrH57t-lVOinUQkHw', '2022-03-08 11:07:58', '2022-03-08 11:07:58'),
(12, 'https://fcm.googleapis.com/fcm/send/eSdjeQS-6ec:APA91bFUxeQX0vknYUYO5cF4Bau2chgFvbcNkVDiWxQzJFCC-koRWSuqHWlB-CNygN8YDUgGxCLD5EVEx8MpSGHTxkTpypT7lCxo9MiYVJdRjmLkxlLilJmyI2277FKumLhLbQM55CmZ', '2022-03-25 09:37:15', '2022-03-25 09:37:15'),
(13, 'https://fcm.googleapis.com/fcm/send/fVC8cace-fw:APA91bEWCMtj2rRSwKQ1q6JQKrdw5X4JAk8FKP6kbWS9Zr7koUH_yRlG7mVwaycVt20EO7UYs0xe3DP26Xba3xGo4tPhS3Rjapa3i-2MNewsDloDPsDppAFkm-X4FKqpWqS_Vk6L9XMS', '2022-03-25 15:10:08', '2022-03-25 15:10:08'),
(14, 'https://fcm.googleapis.com/fcm/send/eAFjl2NwK-s:APA91bEp8b2PiBhmwX_zmnbBUTHukeW5vNABILeBOl5rsDHvN95kgd_3ywilHH9NfNnYpm7a7aJgNPXUc0gJ_7uaFuYjitNc-QRbXz7ys5ZGdtfSKOnGpiuyegInmd4Gzk2SpknKc4wc', '2022-03-26 05:55:51', '2022-03-26 05:55:51'),
(15, 'https://fcm.googleapis.com/fcm/send/cYxO9t_xdXE:APA91bGQ1gBBBwp_ci8cdd_QyMhpiNn_YQHz5T7jYq_Rpy361fJn38T1n4_JepcLWvTVcWKS0_rKSxDZwj98j4tcKJ4WDTYftcpmHSOwzZ_wHMo-DbmOg7OCmo1H5bmM_qzs1JwSsKq3', '2022-03-26 06:11:44', '2022-03-26 06:11:44'),
(16, 'https://fcm.googleapis.com/fcm/send/fL9PPVT6jlM:APA91bF1dsI1uMzo_fGgOiP-6G_LSRBmOpdao8C9sSPUtd4Pu9bvcJbOcFmiCbEKxdD2TGk6elsRlMa44pw4m73kcZy1Z6dWdk4uFxoqwF542pO4ZgneVD6DT1-2cCiMcadxvdHmQAQv', '2022-03-26 06:11:59', '2022-03-26 06:11:59'),
(17, 'https://fcm.googleapis.com/fcm/send/dvFmtOYkKOE:APA91bHpWKVtET2wBSGnEvLtLXpy5S150lRksdlSMTIDfiUNahnnOsJErkgga8EjvraIjSHkSe_epQEiN7naxS7w8vz9PmnOURQi4Bu4dBQj--WhHTyH50BPXBF_ZIVKcaOIlo3KVadt', '2022-03-26 06:33:01', '2022-03-26 06:33:01'),
(18, 'https://fcm.googleapis.com/fcm/send/fVc8RLnHZ6M:APA91bG2us8fW833NzlJ1ilqh8kkVoNrbKck6JZezNXegKjw8NwAm8vDovgpLndAmHNJA6gRfznPD_Rc8vwJ7XXOE3pE0KBokTaozkMq5M4UbPp8MReZ3ho6_iyqx9FrnXjnpxR9wxpa', '2022-03-28 13:24:40', '2022-03-28 13:24:40'),
(19, 'https://fcm.googleapis.com/fcm/send/fgbnPkwsCU8:APA91bGJfLBxkTgEtJePLRIsyfSu2BIPQ22BYwHpAhVrA4whhAdsiHpOSOVr4Vcmp_pTLgRfP2PisJm_fG7so9YU0lNjbXEYHQJ24RkHcDf2eI3mP_5_BM9ALtjdM78nUxodMPYY4k5x', '2022-03-29 07:23:02', '2022-03-29 07:23:02'),
(20, 'https://fcm.googleapis.com/fcm/send/ePVbno9kWtA:APA91bHQi13UwmBnf_z9erJ2VBB78MK_hfeRvQ2tDeLiDgHC4Sl71dDktuhYtjOEamBq_w75T9_Nu0tJqw3YPRPqKW09ObMCn9LiA6pbQKWNYnJujatjDFL0VzZAhB_RLPo8KAdadkqz', '2022-03-29 07:26:21', '2022-03-29 07:26:21'),
(21, 'https://fcm.googleapis.com/fcm/send/dgvxW5cNw5g:APA91bH8Au63veVx1bkKpGB0g_MxoQICgJ3bWaP-QtyowdorZUGcayo5xASkTEFjJri6IjOyvRP7WKCv4jbr4RxT4PD_zr-3AwHlpG00d8rDd-bTvzyvTK2Aj0r59zpKtNSEw8a99VlZ', '2022-03-29 09:33:41', '2022-03-29 09:33:41'),
(22, 'https://fcm.googleapis.com/fcm/send/dH8KnORYEVQ:APA91bEJFuFWl1iloiH44Fuot4Gnoh5p0aUxs_mtrPVsm7O3Dkjd8vELa2DeW9ETdHFcSBkyZt8g0dERLI7jZU3sz5Kv0UP8S2UuDgkRGHC3hRIDp9PdYR8srv-7y_EitmUEY8kBhE9M', '2022-03-29 09:49:54', '2022-03-29 09:49:54'),
(23, 'https://fcm.googleapis.com/fcm/send/eV2Fy6cICFg:APA91bH64deQsEs8og6oMqWSN0IV80-6IJtBR0MmRHwpm6vNvyY1Q-mVU8IK9x_BvxPuTNje_k1Ur6G1WhNqi_kmlCXQZoikKjkeOuLzQ0JjcoT5enML53YCw__PX9i_yathf5ajux8x', '2022-03-29 11:31:26', '2022-03-29 11:31:26'),
(24, 'https://fcm.googleapis.com/fcm/send/fjhrX4tX4Cc:APA91bGSxATfx2askizSwnj_XEEe1dirC38jMXFsCL-Nip69CVioMNbApRMS8_A3RzlWDBXI1sUm2DdSq0-OnXsqO1fror-THjD3R107bF_OBsJWSy4YfrBCdlqD_KZVP_MO3FJbIyIO', '2022-04-04 14:22:56', '2022-04-04 14:22:56'),
(25, 'https://fcm.googleapis.com/fcm/send/dMfJBWeK59g:APA91bHVx8OoUaqqaZROwpYLGi0oL_hpP27-BHhKWcsb_Cf3JhO_0nfblhoeyZWsntig9h4yIv20-lwaiIUVaKQcZ_GtyC1P4DWizrLSkGtYLUtO1Erv9Q5SN1gPfGFy9BN9-J9M17Qi', '2022-04-06 14:45:27', '2022-04-06 14:45:27'),
(26, 'https://fcm.googleapis.com/fcm/send/eFLG-3oEzKI:APA91bF934GtVfeJ3I-0pekZ3k2uYGQyExkei8SLug9CuMb0uXNj8p0kkc_kGPuzAbW0oVt3hlOWdNKmChP2aAWkPRwfGtkxgnDodUhkEZamoo92yi50N6Q65AOOGJVrydcjfVmWFoWF', '2022-05-25 12:10:23', '2022-05-25 12:10:23'),
(27, 'https://fcm.googleapis.com/fcm/send/ddjYk0PfZN4:APA91bHrypeB-IsqioQhnJ5YUV1nZxv-bIK5tKRJppgC4q2mcmEib9ng0gFFlm3_xs8jiHbzQ_KnQPxthBm3qaMnEyRFuv2r-jjs_xE5ie6kVK1zCKjNL1wE0nDC8Ftu-vlA0qtCDYs7', '2023-04-10 05:35:33', '2023-04-10 05:35:33'),
(28, 'https://fcm.googleapis.com/fcm/send/c6z1jcd4ug8:APA91bHU62xxRJMvKKsE2hAVbIP5aHsYN5kNXcyMJ1MJ7LU16BG1IJiHmangsq9yWPlFoIpPhKB_uIzldr7lr4jh01AqC5NS4tZVHYBZn_zrkZuWh1uOWPxtQQGudUwEc5XGFv_M1THK', '2023-04-10 07:46:43', '2023-04-10 07:46:43'),
(29, 'https://fcm.googleapis.com/fcm/send/eZJp6IVs6lo:APA91bHggwA-gOtuZj-610cq9vO2dR3OuTKsklGG4bHXztdyX4tIQsDX--944xanSG3DWa2wkq6EflFM0i-r-OXQCsFa2nGloFQCyDvOwTWPGaXSbD3LCXAzvqJ-K2SFOvvsMSFq8h-7', '2023-05-30 10:54:57', '2023-05-30 10:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `intro_points`
--

CREATE TABLE `intro_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `text` text DEFAULT NULL,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `intro_section_rating_point` int(11) DEFAULT NULL,
  `intro_section_rating_symbol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intro_points`
--

INSERT INTO `intro_points` (`id`, `language_id`, `icon`, `title`, `text`, `serial_number`, `created_at`, `updated_at`, `intro_section_rating_point`, `intro_section_rating_symbol`) VALUES
(3, 176, 'fab fa-accessible-icon', '100% Pure Food', 'We provide 100& Pure & handmade foods', 2, NULL, NULL, 74, '%'),
(7, 177, 'fab fa-accusoft', '???? ????', '???? ???????? ????????', 2, NULL, NULL, NULL, NULL),
(8, 177, 'fab fa-accessible-icon', '???? ????', '???? ???????? ???????? ????', 3, NULL, NULL, NULL, NULL),
(9, 176, 'fab fa-accusoft', '100% Pure Foods', 'We provide 100& Pure & handmade foods', 10, NULL, NULL, 100, '%'),
(19, 176, 'fab fa-accessible-icon', '111', NULL, 10, NULL, NULL, 10000, '%');

-- --------------------------------------------------------

--
-- Table structure for table `jcategories`
--

CREATE TABLE `jcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jcategories`
--

INSERT INTO `jcategories` (`id`, `language_id`, `name`, `status`, `serial_number`, `created_at`, `updated_at`) VALUES
(22, 176, 'Web Developer', 1, 1, '2019-12-21 20:34:11', '2020-02-10 21:01:36'),
(23, 176, 'Web Designer', 1, 2, '2019-12-21 20:34:22', '2020-02-10 21:01:30'),
(24, 176, 'Team Leader', 1, 3, '2019-12-21 20:35:02', '2020-02-10 21:39:34'),
(25, 176, 'IOS Developer', 1, 4, NULL, NULL),
(26, 176, 'Andriod Developer', 1, 5, '2019-12-21 20:35:27', '2020-02-10 21:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jcategory_id` int(11) DEFAULT NULL,
  `language_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `vacancy` int(11) DEFAULT NULL,
  `deadline` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `job_responsibilities` blob DEFAULT NULL,
  `employment_status` varchar(255) DEFAULT NULL,
  `educational_requirements` blob DEFAULT NULL,
  `experience_requirements` blob DEFAULT NULL,
  `additional_requirements` blob DEFAULT NULL,
  `job_location` varchar(255) DEFAULT NULL,
  `salary` blob DEFAULT NULL,
  `benefits` blob DEFAULT NULL,
  `read_before_apply` blob DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `jcategory_id`, `language_id`, `title`, `slug`, `vacancy`, `deadline`, `experience`, `job_responsibilities`, `employment_status`, `educational_requirements`, `experience_requirements`, `additional_requirements`, `job_location`, `salary`, `benefits`, `read_before_apply`, `email`, `serial_number`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(17, 22, 176, 'Software Engineer - Laravel, Vue JS', 'software-engineer-laravel-vue-js', 3, '12/31/2019', '3 to 4 year(s)', 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e6365642077697468205549206672616d65776f726b7320696e2067656e6572616c3b207765206c6f76652074686520416e67756c617220616e6420416e67756c6172206d6174657269616c2e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e63656420696e206275696c64696e672053696e676c652050616765204170706c69636174696f6e732028535041292026616d703b20696e746567726174696e672057656220285265737429204150492e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206d75737420686176652070726163746963616c20657870657269656e6365206f6e204e6f64652e6a732c20547970655363726970742c207765627061636b20616e64205468697264207061727479206c6962726172792e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520616e20696e2d646570746820756e6465727374616e64696e67206f662063726f73732062726f7773657220636f6d7061746962696c69747920616e6420796f7520646f206e6f7420637265617465206275677320666f72207375636820726561736f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752061726520706978656c2d7065726665637420696e2064657369676e20636f6e76657273696f6e7320616e6420796f75207468696e6b206f66206d6f62696c652d666972737420696d706c656d656e746174696f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 'Full-time', 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e6365642077697468205549206672616d65776f726b7320696e2067656e6572616c3b207765206c6f76652074686520416e67756c617220616e6420416e67756c6172206d6174657269616c2e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e63656420696e206275696c64696e672053696e676c652050616765204170706c69636174696f6e732028535041292026616d703b20696e746567726174696e672057656220285265737429204150492e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c62723e, 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e6365642077697468205549206672616d65776f726b7320696e2067656e6572616c3b207765206c6f76652074686520416e67756c617220616e6420416e67756c6172206d6174657269616c2e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e63656420696e206275696c64696e672053696e676c652050616765204170706c69636174696f6e732028535041292026616d703b20696e746567726174696e672057656220285265737429204150492e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520616e20696e2d646570746820756e6465727374616e64696e67206f662063726f73732062726f7773657220636f6d7061746962696c69747920616e6420796f7520646f206e6f7420637265617465206275677320666f72207375636820726561736f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752061726520706978656c2d7065726665637420696e2064657369676e20636f6e76657273696f6e7320616e6420796f75207468696e6b206f66206d6f62696c652d666972737420696d706c656d656e746174696f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 'Remote Job', 0x3c7370616e207374796c653d22666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e24323030303c2f7370616e3e3c62723e, 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520616e20696e2d646570746820756e6465727374616e64696e67206f662063726f73732062726f7773657220636f6d7061746962696c69747920616e6420796f7520646f206e6f7420637265617465206275677320666f72207375636820726561736f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752061726520706978656c2d7065726665637420696e2064657369676e20636f6e76657273696f6e7320616e6420796f75207468696e6b206f66206d6f62696c652d666972737420696d706c656d656e746174696f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 0x3c62723e, 'drop_your_cv@plusagency.com', 1, NULL, NULL, '2019-12-21 20:44:00', '2020-02-10 21:49:54'),
(18, 22, 176, 'PHP Developer - Laravel, Codeigniter', 'php-developer-laravel-codeigniter', 2, '12/31/2019', '2 to 3 year(s)', 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e6365642077697468205549206672616d65776f726b7320696e2067656e6572616c3b207765206c6f76652074686520416e67756c617220616e6420416e67756c6172206d6174657269616c2e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e63656420696e206275696c64696e672053696e676c652050616765204170706c69636174696f6e732028535041292026616d703b20696e746567726174696e672057656220285265737429204150492e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206d75737420686176652070726163746963616c20657870657269656e6365206f6e204e6f64652e6a732c20547970655363726970742c207765627061636b20616e64205468697264207061727479206c6962726172792e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520616e20696e2d646570746820756e6465727374616e64696e67206f662063726f73732062726f7773657220636f6d7061746962696c69747920616e6420796f7520646f206e6f7420637265617465206275677320666f72207375636820726561736f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752061726520706978656c2d7065726665637420696e2064657369676e20636f6e76657273696f6e7320616e6420796f75207468696e6b206f66206d6f62696c652d666972737420696d706c656d656e746174696f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 'Full-time', 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e6365642077697468205549206672616d65776f726b7320696e2067656e6572616c3b207765206c6f76652074686520416e67756c617220616e6420416e67756c6172206d6174657269616c2e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e63656420696e206275696c64696e672053696e676c652050616765204170706c69636174696f6e732028535041292026616d703b20696e746567726174696e672057656220285265737429204150492e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c62723e, 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e6365642077697468205549206672616d65776f726b7320696e2067656e6572616c3b207765206c6f76652074686520416e67756c617220616e6420416e67756c6172206d6174657269616c2e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e63656420696e206275696c64696e672053696e676c652050616765204170706c69636174696f6e732028535041292026616d703b20696e746567726174696e672057656220285265737429204150492e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206d75737420686176652070726163746963616c20657870657269656e6365206f6e204e6f64652e6a732c20547970655363726970742c207765627061636b20616e64205468697264207061727479206c6962726172792e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206d75737420686176652070726163746963616c20657870657269656e6365206f6e204e6f64652e6a732c20547970655363726970742c207765627061636b20616e64205468697264207061727479206c6962726172792e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520616e20696e2d646570746820756e6465727374616e64696e67206f662063726f73732062726f7773657220636f6d7061746962696c69747920616e6420796f7520646f206e6f7420637265617465206275677320666f72207375636820726561736f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752061726520706978656c2d7065726665637420696e2064657369676e20636f6e76657273696f6e7320616e6420796f75207468696e6b206f66206d6f62696c652d666972737420696d706c656d656e746174696f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 'California, USA', 0x3c7370616e207374796c653d22666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e2431303030202d2024313530303c2f7370616e3e3c62723e, 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206d75737420686176652070726163746963616c20657870657269656e6365206f6e204e6f64652e6a732c20547970655363726970742c207765627061636b20616e64205468697264207061727479206c6962726172792e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520616e20696e2d646570746820756e6465727374616e64696e67206f662063726f73732062726f7773657220636f6d7061746962696c69747920616e6420796f7520646f206e6f7420637265617465206275677320666f72207375636820726561736f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752061726520706978656c2d7065726665637420696e2064657369676e20636f6e76657273696f6e7320616e6420796f75207468696e6b206f66206d6f62696c652d666972737420696d706c656d656e746174696f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 0x3c666f6e7420636f6c6f723d2223666633623330223e2a50686f746f67726170683c2f666f6e743e266e6273703b6d75737420626520656e636c6f73656420776974682074686520726573756d652e3c62723e, 'drop_your_cv@plusagency.com', 2, NULL, NULL, '2019-12-21 21:14:03', '2020-02-10 21:49:54');
INSERT INTO `jobs` (`id`, `jcategory_id`, `language_id`, `title`, `slug`, `vacancy`, `deadline`, `experience`, `job_responsibilities`, `employment_status`, `educational_requirements`, `experience_requirements`, `additional_requirements`, `job_location`, `salary`, `benefits`, `read_before_apply`, `email`, `serial_number`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(19, 23, 176, 'Front End Software Engineer', 'Front-End-Software-Engineer', 5, '12/27/2019', '2 to 5 year(s)', 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e6365642077697468205549206672616d65776f726b7320696e2067656e6572616c3b207765206c6f76652074686520416e67756c617220616e6420416e67756c6172206d6174657269616c2e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e63656420696e206275696c64696e672053696e676c652050616765204170706c69636174696f6e732028535041292026616d703b20696e746567726174696e672057656220285265737429204150492e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206d75737420686176652070726163746963616c20657870657269656e6365206f6e204e6f64652e6a732c20547970655363726970742c207765627061636b20616e64205468697264207061727479206c6962726172792e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520616e20696e2d646570746820756e6465727374616e64696e67206f662063726f73732062726f7773657220636f6d7061746962696c69747920616e6420796f7520646f206e6f7420637265617465206275677320666f72207375636820726561736f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752061726520706978656c2d7065726665637420696e2064657369676e20636f6e76657273696f6e7320616e6420796f75207468696e6b206f66206d6f62696c652d666972737420696d706c656d656e746174696f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 'Full-time', 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206d75737420686176652070726163746963616c20657870657269656e6365206f6e204e6f64652e6a732c20547970655363726970742c207765627061636b20616e64205468697264207061727479206c6962726172792e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520616e20696e2d646570746820756e6465727374616e64696e67206f662063726f73732062726f7773657220636f6d7061746962696c69747920616e6420796f7520646f206e6f7420637265617465206275677320666f72207375636820726561736f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752061726520706978656c2d7065726665637420696e2064657369676e20636f6e76657273696f6e7320616e6420796f75207468696e6b206f66206d6f62696c652d666972737420696d706c656d656e746174696f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 0x3120746f20332079656172733c62723e, 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e6365642077697468205549206672616d65776f726b7320696e2067656e6572616c3b207765206c6f76652074686520416e67756c617220616e6420416e67756c6172206d6174657269616c2e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e63656420696e206275696c64696e672053696e676c652050616765204170706c69636174696f6e732028535041292026616d703b20696e746567726174696e672057656220285265737429204150492e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206d75737420686176652070726163746963616c20657870657269656e6365206f6e204e6f64652e6a732c20547970655363726970742c207765627061636b20616e64205468697264207061727479206c6962726172792e3c2f7370616e3e3c62723e, 'Paris, France', 0x3c7370616e207374796c653d22666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269662c20736f6c61696d616e6c6970693b223e4e65676f746961626c653c2f7370616e3e3c62723e, 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e6365642077697468205549206672616d65776f726b7320696e2067656e6572616c3b207765206c6f76652074686520416e67756c617220616e6420416e67756c6172206d6174657269616c2e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c7370616e207374796c653d226261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b223e596f75206861766520746f20626520657870657269656e63656420696e206275696c64696e672053696e676c652050616765204170706c69636174696f6e732028535041292026616d703b20696e746567726174696e672057656220285265737429204150492e3c2f7370616e3e3c62723e3c7370616e207374796c653d226261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c62723e3c7370616e207374796c653d226261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b223e596f75206d75737420686176652070726163746963616c20657870657269656e6365206f6e204e6f64652e6a732c20547970655363726970742c207765627061636b20616e64205468697264207061727479206c6962726172792e3c2f7370616e3e3c62723e3c7370616e207374796c653d226261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c2f7370616e3e3c62723e, 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e6365642077697468205549206672616d65776f726b7320696e2067656e6572616c3b207765206c6f76652074686520416e67756c617220616e6420416e67756c6172206d6174657269616c2e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e63656420696e206275696c64696e672053696e676c652050616765204170706c69636174696f6e732028535041292026616d703b20696e746567726174696e672057656220285265737429204150492e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206d75737420686176652070726163746963616c20657870657269656e6365206f6e204e6f64652e6a732c20547970655363726970742c207765627061636b20616e64205468697264207061727479206c6962726172792e3c2f7370616e3e3c62723e, 'drop_your_cv@plusagency.com', 3, NULL, NULL, '2019-12-21 21:15:20', '2020-02-10 21:49:54'),
(20, 24, 176, 'Agriculture Market Systems Leader', 'agriculture-market-systems-leader', 4, '12/28/2019', 'At least 7 year(s)', 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e6365642077697468205549206672616d65776f726b7320696e2067656e6572616c3b207765206c6f76652074686520416e67756c617220616e6420416e67756c6172206d6174657269616c2e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e63656420696e206275696c64696e672053696e676c652050616765204170706c69636174696f6e732028535041292026616d703b20696e746567726174696e672057656220285265737429204150492e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206d75737420686176652070726163746963616c20657870657269656e6365206f6e204e6f64652e6a732c20547970655363726970742c207765627061636b20616e64205468697264207061727479206c6962726172792e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520616e20696e2d646570746820756e6465727374616e64696e67206f662063726f73732062726f7773657220636f6d7061746962696c69747920616e6420796f7520646f206e6f7420637265617465206275677320666f72207375636820726561736f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752061726520706978656c2d7065726665637420696e2064657369676e20636f6e76657273696f6e7320616e6420796f75207468696e6b206f66206d6f62696c652d666972737420696d706c656d656e746174696f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 'Full-time', 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e6365642077697468205549206672616d65776f726b7320696e2067656e6572616c3b207765206c6f76652074686520416e67756c617220616e6420416e67756c6172206d6174657269616c2e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e63656420696e206275696c64696e672053696e676c652050616765204170706c69636174696f6e732028535041292026616d703b20696e746567726174696e672057656220285265737429204150492e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c62723e, 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e6365642077697468205549206672616d65776f726b7320696e2067656e6572616c3b207765206c6f76652074686520416e67756c617220616e6420416e67756c6172206d6174657269616c2e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520746f20626520657870657269656e63656420696e206275696c64696e672053696e676c652050616765204170706c69636174696f6e732028535041292026616d703b20696e746567726174696e672057656220285265737429204150492e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e57656c6c20766572736564207769746820416e67756c6172206d6f64756c6573206f7220796f752068617665206372656174656420637573746f6d20616e642077656220636f6d706f6e656e747320627920796f757273656c662e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520616e20696e2d646570746820756e6465727374616e64696e67206f662063726f73732062726f7773657220636f6d7061746962696c69747920616e6420796f7520646f206e6f7420637265617465206275677320666f72207375636820726561736f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752061726520706978656c2d7065726665637420696e2064657369676e20636f6e76657273696f6e7320616e6420796f75207468696e6b206f66206d6f62696c652d666972737420696d706c656d656e746174696f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 'California, USA', 0x2431303030202d2024313530303c62723e, 0x3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f75206861766520616e20696e2d646570746820756e6465727374616e64696e67206f662063726f73732062726f7773657220636f6d7061746962696c69747920616e6420796f7520646f206e6f7420637265617465206275677320666f72207375636820726561736f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752061726520706978656c2d7065726665637420696e2064657369676e20636f6e76657273696f6e7320616e6420796f75207468696e6b206f66206d6f62696c652d666972737420696d706c656d656e746174696f6e732e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e3c62723e3c2f7370616e3e3c7370616e207374796c653d22666f6e742d73697a653a2031302e3570743b206261636b67726f756e642d696d6167653a20696e697469616c3b206261636b67726f756e642d706f736974696f6e3a20696e697469616c3b206261636b67726f756e642d73697a653a20696e697469616c3b206261636b67726f756e642d7265706561743a20696e697469616c3b206261636b67726f756e642d6174746163686d656e743a20696e697469616c3b206261636b67726f756e642d6f726967696e3a20696e697469616c3b206261636b67726f756e642d636c69703a20696e697469616c3b206c696e652d6865696768743a20323870783b20666f6e742d66616d696c793a20417269616c2c2073616e732d73657269663b223e596f752073686f756c642068617665206b6e6f776c65646765206f66204353532070726570726f636573736f72732c204d6564696120717565726965732c20496d61676520636f6d7072657373696f6e20616e6420626520676f6f64207769746820646562756767696e672e3c2f7370616e3e3c62723e, 0x3c62723e, 'drop_your_cv@plusagency.com', 4, NULL, NULL, '2019-12-21 21:16:28', '2020-02-10 21:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 1,
  `rtl` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - LTR, 1- RTL',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `is_default`, `rtl`, `created_at`, `updated_at`) VALUES
(176, 'Français', 'fr', 1, 0, '2020-08-07 04:43:05', '2025-08-08 20:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `feature` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `language_id`, `name`, `rank`, `image`, `twitter`, `facebook`, `instagram`, `linkedin`, `feature`, `created_at`, `updated_at`) VALUES
(54, 176, 'Andress Pirlo', 'Manager, Superv', '1597749461.jpg', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 1, NULL, NULL),
(55, 176, 'Christina Grimmie', 'Master Chef', '1597749478.jpg', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 1, NULL, NULL),
(56, 176, 'Roza Bela', 'Burger Chef', '1597749496.jpg', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 1, NULL, NULL),
(57, 176, 'Cesc Fabrigus', 'Set Menu Chef', '1597749511.jpg', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 0, NULL, NULL),
(62, 176, 'Gondon Ramsay', 'Dessert Chef', '1598691630.jpg', 'https://twitter.com/', 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://www.instagram.com/', 0, NULL, NULL),
(63, 176, 'Frank Lampard', 'Beverage Chef', '1598691925.jpg', 'https://twitter.com/', 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://www.instagram.com/', 0, NULL, NULL),
(64, 176, 'Chistopher Helen', 'Waiter, Superv', '1598691992.jpg', 'https://twitter.com/', 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://www.instagram.com/', 0, NULL, NULL),
(65, 176, 'Chrissy Costanza', 'Waiter, Superv', '1598692028.jpg', 'https://twitter.com/', 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://www.instagram.com/', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `menus` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `language_id`, `menus`, `created_at`, `updated_at`) VALUES
(122, 176, '[{\"text\":\"Accueil\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"type\":\"home\"},{\"text\":\"Menu\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"type\":\"menu_1\"},{\"text\":\"À propos\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"type\":\"1\"},{\"text\":\"Blogs\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"type\":\"blogs\"},{\"text\":\"Contact\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"type\":\"contact\"}]', '2025-08-08 20:39:24', '2025-08-08 20:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_04_10_155226_add_pos_to_serving_methods', 1),
(5, '2021_04_10_161129_create_pos_payment_methods', 2),
(6, '2021_04_11_075502_create_customers_table', 3),
(7, '2021_04_11_151305_create_tables_table', 4),
(8, '2021_04_16_175547_add_qr_image_to_tables', 5),
(10, '2021_04_16_184950_add_qr_cols_to_table', 6),
(11, '2021_05_06_172702_add_image_to_tables', 7),
(12, '2021_05_06_182658_add_image_size_to_tables', 8),
(13, '2021_05_07_141846_change_defailt_image_size', 9),
(14, '2021_05_07_165729_drop_background_color_from_tables', 10),
(15, '2021_05_07_170622_add_image_position_cols_to_tables', 11),
(17, '2021_05_08_104914_add_type_and_text_cols_to_tables', 12),
(18, '2021_05_08_113457_add_default_value_to_text_color_in_tables', 13),
(19, '2021_05_08_174437_add_default_value_to_text_size_in_tables', 14),
(20, '2021_05_08_194033_add_qr_image_cols_to_basic_extendeds', 15),
(21, '2021_05_10_155349_add_gateway_type_to_product_orders', 16),
(24, '2021_05_11_180827_add_token_no_in_basic_settings', 17),
(25, '2021_05_11_181941_add_token_no_after_order_number_in_product_orders', 17),
(28, '2021_05_13_083313_create_postal_codes_table', 18),
(29, '2021_05_13_101831_add_postal_code_to_basic_settings', 19),
(32, '2021_05_16_105019_add_postal_code_to_product_orders', 20),
(33, '2021_05_18_130916_add_call_waiter_status_to_basic_settings', 21),
(34, '2021_05_18_194729_add_contact_infos_to_basic_settings', 22),
(36, '2021_05_19_081335_create_popups_table', 23),
(37, '2021_05_19_122217_drop_announcement_cols_from_basic_settings', 24),
(38, '2021_05_19_125220_drop_parent_link_col_from_basic_settings', 25),
(40, '2021_05_19_125534_add_whatsapp_chat_cols_to_basic_settings', 26),
(41, '2021_05_20_120604_add_order_close_cols_to_basic_extendeds', 27),
(42, '2022_03_13_165621_create_psub_categories_table', 28),
(43, '2022_03_13_180650_add_subcategory_id_to_products_table', 28),
(44, '2022_03_17_131144_add_free_delivery_amount_to_postal_codes', 29),
(45, '2022_03_17_194525_add_free_delivery_amount_to_shipping_charges', 30),
(46, '2022_04_18_133021_create_basic_extras', 31),
(49, '2022_04_19_155032_add_country_code_to_users_table', 32),
(51, '2022_04_21_120742_add_country_code_in_product_orders', 33),
(52, '2022_04_23_124847_add_whatsapp_order_notification_based_on_serving_methods', 34),
(53, '2022_04_23_144354_add_twilio_credentials_in_basic_extras', 35),
(54, '2022_05_25_195401_add_is_feature_in_psub_categories', 36),
(65, '2023_03_04_165637_create_intro_points_table', 37),
(66, '2023_03_05_124128_create_titles_table', 37),
(67, '2023_03_05_132538_add_column_to_basic_settings', 38),
(69, '2023_03_05_161748_add_column_testimonial_side_image_to_basic_extendeds', 39),
(71, '2023_03_05_171212_add_column_testimonial_section_text_to_basic_settings_table', 40),
(72, '2023_03_05_173430_add_column_category_section_title_and_special_section_title_to_basic_settings_table', 41),
(73, '2023_03_06_105842_add_column_background_image_to_basic_extendeds', 42),
(74, '2023_03_11_160511_add_column_hero_section_button_two_color_to_basic_extendeds', 43),
(76, '2023_03_11_163039_add_column_hero_section_autor_name_to_basic_extendeds', 44),
(77, '2023_03_13_103439_add_column_pricing_to_basic_extendeds', 45),
(84, '2023_03_13_130121_add_column_intro_to_basic_settings', 46),
(85, '2023_03_13_132216_add_column_rating_to_intro_points', 46),
(86, '2023_03_14_102250_add_column_intro_bg_image_to_basic_extendeds', 47),
(87, '2023_03_14_111304_alter_column_testimonial_bg_img_to_basic_extendeds', 48),
(89, '2023_03_14_130444_remove_column_special_section_title_to_basic_settings', 49),
(90, '2023_03_16_121332_add_column_top_bottom_shape_to_basic_extendeds', 50),
(91, '2023_03_16_161727_add_column_intro_section_shape_image_to_basic_settings', 51),
(93, '2023_03_20_110357_add_column_intro_section_coffee_theme_to_basic_settings', 52),
(94, '2023_03_22_111823_add_column_blog_section_bg_image_basic_extendeds', 53),
(95, '2023_03_25_145040_alter_column_hero_section_button_2_text_font_size_to_basic_extendeds', 54),
(96, '2023_03_30_130615_ad_column_water_shape_to_basic_extededs', 55),
(97, '2023_04_09_123201_alter_column_maintainance_to_basic_settings', 56),
(98, '2023_04_11_112615_delete_column_intro_section_button_font_size_and_intro_section_button_text_color_to_basic_settings', 57),
(99, '2023_04_11_124905_delete_column_to_hero_section_starting_price_and_hero_section_ending_price_to_basic_extendeds', 58),
(100, '2023_05_02_131139_alter_column_intro_title_to_basic_settings', 59),
(101, '2023_05_25_124230_add_colum_theme_to_basic_settings', 60);

-- --------------------------------------------------------

--
-- Table structure for table `offline_gateways`
--

CREATE TABLE `offline_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `instructions` blob DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `is_receipt` tinyint(4) NOT NULL DEFAULT 1,
  `receipt` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offline_gateways`
--

INSERT INTO `offline_gateways` (`id`, `name`, `short_description`, `instructions`, `status`, `serial_number`, `is_receipt`, `receipt`, `created_at`, `updated_at`) VALUES
(1, 'Offline Gateway 1', 'Please send your payment to the following account.\r\nBank Name: Lorem Ipsum.\r\nBeneficiary Name: John Doe.\r\nAccount Number/IBAN: 12345678', 0x3c70207374796c653d226c696e652d6865696768743a20312e383b223e3c666f6e7420666163653d2243697263756c61725374642d426f6f6b2c20417269616c2c2073616e732d7365726966223e43686173652042616e6b2069732074686520636f6e73756d65722062616e6b696e67206469766973696f6e206f66204a504d6f7267616e2043686173652e20556e6c696b652069747320636f6d70657469746f72732c2043686173652069732074616b696e6720737465707320746f20657870616e6420697473206272616e6368206e6574776f726b20696e206b6579206d61726b6574732e205468652062616e6b2063757272656e746c7920686173206e6561726c7920352c303030206272616e6368657320616e642031362c3030302041544d732e204163636f7264696e6720746f207468652062616e6b2c206e6561726c792068616c66206f662074686520636f756e747279e280997320686f757365686f6c64732061726520436861736520637573746f6d6572732e3c2f666f6e743e3c62723e3c2f703e, 1, 1, 1, NULL, '2020-09-17 01:06:39', '2023-04-11 04:42:23'),
(2, 'Offline Gateway 2', 'Please send your payment to the following account.\r\nBank Name: Lorem Ipsum.\r\nBeneficiary Name: John Doe.\r\nAccount Number/IBAN: 12345678', 0x3c70207374796c653d226c696e652d6865696768743a20312e383b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2043697263756c61725374642d426f6f6b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e42616e6b206f6620416d6572696361207365727665732061626f7574203636206d696c6c696f6e20636f6e73756d65727320616e6420736d616c6c20627573696e65737320636c69656e747320776f726c64776964652e204c696b65206d616e79206f662074686520626967676573742062616e6b732c2042616e6b206f6620416d6572696361206973206b6e6f776e20666f7220697473206469676974616c20696e6e6f766174696f6e2e20497420686173206d6f7265207468616e203337206d696c6c696f6e206469676974616c20636c69656e747320616e6420697320657870657269656e63696e67207375636365737320616674657220696e74726f647563696e6720697473207669727475616c20617373697374616e742c2045726963612c20746861742061737369737473206163636f756e7420686f6c64657273207769746820766172696f7573207461736b733c2f7370616e3e3c62723e3c2f703e, 1, 2, 0, NULL, '2020-09-17 01:07:37', '2021-01-01 02:12:22'),
(3, 'Cash On Delivery', NULL, 0x3c703e3c62723e3c2f703e, 1, 3, 0, NULL, '2020-09-17 02:05:36', '2020-09-17 02:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `variations` text DEFAULT NULL,
  `addons` text DEFAULT NULL,
  `variations_price` decimal(11,2) NOT NULL DEFAULT 0.00,
  `addons_price` decimal(11,2) NOT NULL,
  `product_price` decimal(11,2) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `product_order_id`, `product_id`, `user_id`, `title`, `qty`, `image`, `variations`, `addons`, `variations_price`, `addons_price`, `product_price`, `total`, `created_at`, `updated_at`) VALUES
(281, 157, 15, NULL, 'Set Menu - 1', 1, '1598683808.jpg', '{\"Spice_Level\":{\"name\":\"Mild\",\"price\":0},\"Ratio\":{\"name\":\"1:1\",\"price\":0}}', '\"\"', 0.00, 0.00, 2.00, 2.00, '2025-08-08 22:30:39', NULL),
(282, 157, 15, NULL, 'Set Menu - 1', 1, '1598683808.jpg', '{\"Spice_Level\":{\"name\":\"Mild\",\"price\":0},\"Ratio\":{\"name\":\"1:1\",\"price\":0}}', '[{\"name\":\"1pc Chicken\",\"price\":\"1.00\"}]', 0.00, 1.00, 2.00, 3.00, '2025-08-08 22:30:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_times`
--

CREATE TABLE `order_times` (
  `id` int(11) NOT NULL,
  `day` varchar(100) DEFAULT NULL,
  `start_time` varchar(100) DEFAULT NULL,
  `end_time` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_times`
--

INSERT INTO `order_times` (`id`, `day`, `start_time`, `end_time`) VALUES
(1, 'monday', '8:00 AM', '9:00 PM'),
(2, 'tuesday', '10:00 AM', '10:30 PM'),
(3, 'wednesday', '12:00 AM', '11:59 PM'),
(4, 'thursday', '8:00 AM', '11:59 PM'),
(5, 'friday', '4:00 PM', '9:00 PM'),
(6, 'saturday', '11:25 AM', '6:25 PM'),
(7, 'sunday', '2:21 PM', '4:19 PM');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `body` blob DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `language_id`, `name`, `title`, `subtitle`, `slug`, `body`, `status`, `serial_number`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 176, 'King Kebab', 'À propos de nous', 'Notre histoire et notre passion', 'King-Kebab', 0x3c703ec3802070726f706f73206465206e6f75730d0a20204e6f74726520686973746f697265206574206e6f7472652070617373696f6e3c2f703e3c703e3c62723e3c2f703e3c703e0d0a202020204368657a204b696e67204b656261622c206e6f75732063726f796f6e7320717565206c61207175616c6974c3a9206574206c6120747261646974696f6e20736f6e74206c65732070696c696572732064e28099756e6520657870c3a97269656e63652063756c696e616972652072c3a975737369652e2044657075697320706c757320646520323020616e732c206e6f74726520c3a971756970652064c3a9766f75c3a9652073e280996566666f726365206465207072c3a9706172657220636861717565206b656261622061766563206c6520706c7573206772616e6420736f696e2c20656e207574696c6973616e7420756e697175656d656e742064657320696e6772c3a96469656e7473206672616973206574207269676f7572657573656d656e742073c3a96c656374696f6e6ec3a9732e204e6f7573206e6f757320656e676167656f6e7320c3a020726573706563746572206c65732072656365747465732061757468656e74697175657320746f757420656e20696e6e6f76616e7420706f75722070726f706f73657220646573207361766575727320756e69717565732071756920736175726f6e7420726176697220746f7573206c65732070616c6169732e0d0a20203c2f703e0d0a20203c703e0d0a202020204e6f7472652070617373696f6e20706f7572206c612063756973696e65207365207265666cc3a874652064616e732063686171756520c3a974617065206465206c61207072c3a97061726174696f6e2c206465206c61206d6172696e61646520646573207669616e64657320c3a0206c612063756973736f6e2061752063686172626f6e20646520626f69732c2071756920646f6e6e6520c3a0206e6f7320706c61747320636520676fc3bb742066756dc3a920736920706172746963756c6965722e204e6f7573206174746163686f6e7320c3a967616c656d656e7420756e65206772616e646520696d706f7274616e636520c3a0206c61206469766572736974c3a9206465206e6f747265206d656e752c206f666672616e7420646573206f7074696f6e732071756920636f6e7669656e6e656e7420c3a020746f75732c2071756520766f757320736f79657a20616d6174657572206465207669616e64652c2076c3a967c3a974617269656e206f7520c3a0206c6120726563686572636865206465206e6f7576656c6c657320657870c3a97269656e63657320677573746174697665732e0d0a20203c2f703e0d0a20203c703e0d0a2020202041752d64656cc3a0206465206c61206e6f75727269747572652c204b696e67204b656261622065737420756e206c696575206fc3b920636f6e76697669616c6974c3a9206574206163637565696c206368616c65757265757820736f6e742061752063c5937572206465206e6f74726520736572766963652e204e6f757320736f75686169746f6e7320717565206368617175652076697369746520736f697420756e206d6f6d656e7420646520706c616973697220657420646520706172746167652c2071756520636520736f697420706f757220756e2064c3a96a65756e657220726170696465206f7520756e2064c3ae6e657220656e2066616d696c6c65206f7520656e74726520616d69732e204e6f74726520706572736f6e6e656c2065737420746f756a6f75727320646973706f6e69626c6520706f757220766f757320636f6e7365696c6c65722065742073e28099617373757265722071756520766f74726520657870c3a97269656e636520736f69742070617266616974652e0d0a20203c2f703e0d0a20203c703e0d0a20202020456e66696e2c206e6f757320736f6d6d657320666965727320646520636f6e7472696275657220c3a0206c6120766965206c6f63616c6520656e20736f7574656e616e742064657320666f75726e69737365757273206c6f6361757820657420656e207061727469636970616e7420c3a02064657320696e69746961746976657320636f6d6d756e61757461697265732e204368657a204b696e67204b656261622c206e6f7573206e6520666169736f6e732070617320717565207365727669722064657320706c6174732064c3a96c6963696575782c206e6f7573206372c3a96f6e7320756e652076c3a972697461626c6520636f6d6d756e617574c3a9206175746f7572206465206c612070617373696f6e20647520626f6e20676fc3bb742e0d0a20203c2f703e0d0a20203c703e0d0a2020202056656e657a2064c3a9636f7576726972206e6f74726520756e6976657273206574206c61697373657a2d766f75732074656e74657220706172206e6f73207370c3a96369616c6974c3a97320756e69717565732071756920666f6e74206c612072656e6f6d6dc3a965206465204b696e67204b656261622e0d0a20203c2f703e, 1, 1, 'kebab, restaurant kebab, kebab Paris, kebab traditionnel, viande grillée, cuisine orientale, sandwich kebab, sauce maison, fast food, spécialités kebab, repas rapide, King Kebab, kebab frais, restaurant halal, kebab poulet, kebab agneau', 'King Kebab vous offre des kebabs authentiques préparés avec des ingrédients frais et une cuisson parfaite au charbon de bois. Profitez de saveurs uniques dans un cadre chaleureux et convivial.', '2020-08-21 04:06:16', '2025-08-08 22:08:51'),
(3, 176, 'Conditions Générales', 'Conditions Générales', 'Conditions Générales', 'Conditions-Générales', 0x0d0a0d0a2020436f6e646974696f6e732047c3a96ec3a972616c65730d0a20203c703e0d0a20202020456e207574696c6973616e74206c6573207365727669636573206465204b696e67204b656261622c20766f757320616363657074657a20646520726573706563746572206c6573207072c3a973656e74657320636f6e646974696f6e732067c3a96ec3a972616c65732e204e6f7573206e6f7573206566666f72c3a76f6e7320646520676172616e746972206c61207175616c6974c3a9206465206e6f732070726f64756974732065742073657276696365732c206d616973206e6f75732064c3a9636c696e6f6e7320746f75746520726573706f6e736162696c6974c3a920656e206361732064e28099616c6c657267696573206f752064e28099696e746f6cc3a972616e63657320616c696d656e746169726573206e6f6e207369676e616cc3a965732e0d0a20203c2f703e0d0a20203c703e0d0a202020204c657320636f6d6d616e6465732070657576656e7420c3aa747265206d6f64696669c3a96573206f7520616e6e756cc3a965732064616e7320756e2064c3a96c616920726169736f6e6e61626c65206176616e74206c61207072c3a97061726174696f6e2e204e6f7573206e6f75732072c3a9736572766f6e73206c652064726f6974206465207265667573657220746f75746520636f6d6d616e646520717569206e6520726573706563746520706173206e6f7320706f6c697469717565732e0d0a20203c2f703e0d0a20203c703e0d0a202020204c6573207072697820616666696368c3a97320736f6e74207375736365707469626c6573206465206368616e6765722073616e73207072c3a9617669732e204c65732070726f6d6f74696f6e73206574206f6666726573207370c3a96369616c657320736f6e74206c696d6974c3a965732064616e73206c652074656d70732065742073656c6f6e20646973706f6e6962696c6974c3a92e0d0a20203c2f703e0d0a20203c703e0d0a202020204b696e67204b656261622073e28099656e6761676520c3a02070726f74c3a967657220766f7320646f6e6ec3a9657320706572736f6e6e656c6c657320636f6e666f726dc3a96d656e7420c3a0206c61206cc3a96769736c6174696f6e20656e20766967756575722e0d0a20203c2f703e0d0a20203c703e0d0a20202020506f757220746f757465207175657374696f6e206f752072c3a9636c616d6174696f6e2c20766575696c6c657a20636f6e746163746572206e6f747265207365727669636520636c69656e7420717569207365206665726120756e20706c616973697220646520766f75732061737369737465722e0d0a20203c2f703e0d0a, 1, 2, NULL, NULL, '2020-08-21 04:06:16', '2025-08-08 22:09:59'),
(4, 176, 'Politique Vie Privée', 'Politique de Confidentialité', 'Politique de Confidentialité', 'Politique-Vie-Privée', 0x0d0a0d0a2020506f6c69746971756520646520436f6e666964656e7469616c6974c3a90d0a20203c703e0d0a202020204368657a204b696e67204b656261622c206c612070726f74656374696f6e20646520766f7320646f6e6ec3a9657320706572736f6e6e656c6c65732065737420756e65207072696f726974c3a92e204e6f7573206e6f757320656e676167656f6e7320c3a02072657370656374657220766f747265207669652070726976c3a96520657420c3a02070726f74c3a9676572206c657320696e666f726d6174696f6e732071756520766f7573206e6f757320636f6e6669657a206c6f7273206465206ce280997574696c69736174696f6e206465206e6f747265207369746520776562206f75206465206e6f732073657276696365732e0d0a20203c2f703e0d0a20203c703e0d0a202020204c657320646f6e6ec3a9657320636f6c6c656374c3a965732c2074656c6c65732071756520766f747265206e6f6d2c206164726573736520652d6d61696c2c206e756dc3a9726f2064652074c3a96cc3a970686f6e652c206f7520696e666f726d6174696f6e7320646520636f6d6d616e64652c20736f6e74207574696c6973c3a9657320756e697175656d656e7420706f7572207472616974657220766f7320636f6d6d616e6465732c20616dc3a96c696f726572206e6f7320736572766963657320657420766f757320666f75726e697220756e65206d65696c6c6575726520657870c3a97269656e636520636c69656e742e0d0a20203c2f703e0d0a20203c703e0d0a202020204e6f7573206e6520706172746167656f6e73206a616d61697320766f7320646f6e6ec3a9657320706572736f6e6e656c6c65732061766563206465732074696572732073616e7320766f74726520636f6e73656e74656d656e742c2073617566207369206c61206c6f69206ce280996578696765206f7520706f75722061737375726572206c6520626f6e207472616974656d656e7420646520766f7320636f6d6d616e6465732028706172206578656d706c652c206176656320646573207365727669636573206465206c6976726169736f6e292e0d0a20203c2f703e0d0a20203c703e0d0a20202020566f7573206176657a206c652064726f69742064e28099616363c3a96465722c206465206d6f646966696572206f75206465207375707072696d657220766f7320646f6e6ec3a9657320706572736f6e6e656c6c657320c3a020746f7574206d6f6d656e742e20506f757220657865726365722063652064726f69742c20766575696c6c657a206e6f757320636f6e74616374657220766961206c657320636f6f72646f6e6ec3a9657320666f75726e69657320737572206e6f74726520736974652e0d0a20203c2f703e0d0a20203c703e0d0a202020204e6f7573207574696c69736f6e7320646573206d6573757265732064652073c3a96375726974c3a920617070726f707269c3a9657320706f75722070726f74c3a967657220766f7320696e666f726d6174696f6e7320636f6e74726520746f757420616363c3a873206e6f6e206175746f726973c3a92c207065727465206f7520646976756c676174696f6e2e0d0a20203c2f703e0d0a20203c703e0d0a20202020456e207574696c6973616e74206e6f732073657276696365732c20766f757320616363657074657a206c6573207465726d657320646520636574746520706f6c69746971756520646520636f6e666964656e7469616c6974c3a92e204e6f7573206e6f75732072c3a9736572766f6e73206c652064726f6974206465206d6f64696669657220636574746520706f6c69746971756520c3a020746f7574206d6f6d656e742c206574206c6573206368616e67656d656e7473207365726f6e74207075626c69c3a9732073757220636574746520706167652e0d0a20203c2f703e0d0a, 1, 3, NULL, NULL, '2020-08-21 04:06:16', '2025-08-08 22:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'manual',
  `information` mediumtext DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `subtitle`, `title`, `details`, `name`, `type`, `information`, `keyword`, `status`) VALUES
(6, NULL, NULL, NULL, 'Flutterwave', 'automatic', '{\"public_key\":\"FLWPUBK_TEST-54e1bcf960a5364fa3365240fe555615-X\",\"secret_key\":\"FLWSECK_TEST-85dc3d03f924083034da3af27ec45b39-X\",\"text\":\"Pay via your Flutterwave account.\"}', 'flutterwave', 1),
(9, NULL, NULL, NULL, 'Razorpay', 'automatic', '{\"key\":\"rzp_test_fV9dM9URYbqjm7\",\"secret\":\"nickxZ1du2ojPYVVRTDif2Xr\",\"text\":\"Pay via your Razorpay account.\"}', 'razorpay', 1),
(11, NULL, NULL, NULL, 'Paytm', 'automatic', '{\"merchant\":\"tkogux49985047638244\",\"secret\":\"LhNGUUKE9xCQ9xY8\",\"website\":\"WEBSTAGING\",\"industry\":\"Retail\",\"text\":\"Pay via your paytm account.\"}', 'paytm', 1),
(12, NULL, NULL, NULL, 'Paystack', 'automatic', '{\"key\":\"sk_test_45b0b207ffa006eeb5fc74ea35d01e673be15ade\",\"text\":\"Pay via your Paystack account.\"}', 'paystack', 1),
(13, NULL, NULL, NULL, 'Instamojo', 'automatic', '{\"key\":\"test_172371aa837ae5cad6047dc3052\",\"token\":\"test_4ac5a785e25fc596b67dbc5c267\",\"sandbox_check\":\"1\",\"text\":\"Pay via your Instamojo account.\"}', 'instamojo', 1),
(14, NULL, NULL, NULL, 'Stripe', 'automatic', '{\"key\":\"pk_test_UnU1Coi1p5qFGwtpjZMRMgJM\",\"secret\":\"sk_test_QQcg3vGsKRPlW6T3dXcNJsor\",\"text\":\"Pay via your Credit account.\"}', 'stripe', 1),
(15, NULL, NULL, NULL, 'Paypal', 'automatic', '{\"client_id\":\"AVYKFEw63FtDt9aeYOe9biyifNI56s2Hc2F1Us11hWoY5GMuegipJRQBfWLiIKNbwQ5tmqKSrQTU3zB3\",\"client_secret\":\"EJY0qOKliVg7wKsR3uPN7lngr9rL1N7q4WV0FulT1h4Fw3_e5Itv1mxSdbtSUwAaQoXQFgq-RLlk_sQu\",\"sandbox_check\":\"1\",\"text\":\"Pay via your PayPal account.\"}', 'paypal', 1),
(17, NULL, NULL, NULL, 'Mollie Payment', 'automatic', '{\"key\":\"test_m6BAuk4mJ7asBP52AtCWn3WjpK4Tv3\",\"text\":\"Pay via your Mollie Payment account.\"}', 'mollie', 1),
(18, NULL, NULL, NULL, 'PayUmoney', 'automatic', '{\"key\":\"gtKFFx\",\"salt\":\"eCwWELxi\",\"text\":\"Pay via your PayUmoney account.\"}', 'payumoney', 1),
(19, NULL, NULL, NULL, 'Mercado Pago', 'automatic', '{\"token\":\"TEST-705032440135962-041006-ad2e021853f22338fe1a4db9f64d1491-421886156\",\"sandbox_check\":\"1\",\"text\":\"Pay via your Mercado Pago account.\"}', 'mercadopago', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pcategories`
--

CREATE TABLE `pcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_feature` int(11) DEFAULT NULL,
  `tax` decimal(11,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pcategories`
--

INSERT INTO `pcategories` (`id`, `language_id`, `name`, `slug`, `image`, `status`, `is_feature`, `tax`, `created_at`, `updated_at`) VALUES
(21, 176, 'Sandwichs', 'Sandwichs', '68968f516345d.webp', 1, 1, 0.00, '2025-08-08 22:55:34', '2025-08-08 22:59:13'),
(22, 176, 'Menus', 'Menus', '68968f62e1496.webp', 1, 1, 0.00, '2025-08-08 22:55:34', '2025-08-08 22:59:30'),
(23, 176, 'Assiettes', 'Assiettes', '68968f72004b0.webp', 1, 1, 0.00, '2025-08-08 22:55:34', '2025-08-08 22:59:46'),
(24, 176, 'Menus Enfant', 'Menus-Enfant', '68968f831f56a.webp', 1, 1, 0.00, '2025-08-08 22:55:34', '2025-08-08 23:00:03'),
(27, 176, 'Tacos', 'Tacos', '68988cd87692b.webp', 1, 1, 0.00, '2025-08-09 11:04:20', '2025-08-10 11:13:12'),
(28, 176, 'Burger', 'Burger', '6897cf95ce26e.png', 1, 1, 0.00, '2025-08-09 11:04:20', '2025-08-09 21:45:41'),
(29, 176, 'Salade', 'Salade', '6897cffc400a7.png', 1, 1, 0.00, '2025-08-09 11:04:20', '2025-08-09 21:47:24'),
(31, 176, 'Nos Box', 'Nos-Box', '68988ccf55116.avif', 1, 1, 0.00, '2025-08-09 11:04:20', '2025-08-10 11:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `popups`
--

CREATE TABLE `popups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `background_image` varchar(100) DEFAULT NULL,
  `background_color` varchar(100) DEFAULT NULL,
  `background_opacity` decimal(8,2) NOT NULL DEFAULT 1.00,
  `title` varchar(255) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` text DEFAULT NULL,
  `button_color` varchar(20) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `delay` int(11) NOT NULL DEFAULT 1000 COMMENT 'in milisconds',
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - active, 0 - deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `popups`
--

INSERT INTO `popups` (`id`, `language_id`, `name`, `image`, `background_image`, `background_color`, `background_opacity`, `title`, `text`, `button_text`, `button_url`, `button_color`, `end_date`, `end_time`, `delay`, `serial_number`, `type`, `status`, `created_at`, `updated_at`) VALUES
(11, 176, 'Black Friday', '606d41536fa81.jpg', NULL, NULL, 1.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1500, 1, 1, 0, '2021-04-06 19:21:23', '2021-05-23 00:53:12'),
(12, 176, 'Monthend Sale', NULL, '606d41d50dd28.jpg', '451D53', 0.80, 'ENJOY 10% OFF', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.', 'Shop Now', 'http://example.com/', '451D53', NULL, NULL, 2000, 2, 2, 0, '2021-04-06 19:23:33', '2021-05-23 00:53:32'),
(13, 176, 'Summer Sale', NULL, '606d42e66ee81.jpg', 'FF2865', 0.70, 'Newsletter', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.', 'Subscribe', NULL, 'FF2865', NULL, NULL, 2000, 3, 3, 0, '2021-04-06 19:28:06', '2021-05-23 00:53:22'),
(14, 176, 'Winter Offer', '606d43711d16a.jpg', NULL, NULL, 1.00, 'Get 10% off your first order', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt', 'Shop Now', 'http://example.com/', 'FF2865', NULL, NULL, 1500, 4, 4, 0, '2021-04-06 19:30:25', '2021-05-23 00:53:46'),
(15, 176, 'Winter Sale', '606d43dfad35b.jpg', NULL, NULL, 1.00, 'Get 10% off your first order', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt', 'Subscribe', NULL, 'F8960D', NULL, NULL, 2000, 6, 5, 0, '2021-04-06 19:32:15', '2025-08-08 19:05:48'),
(16, 176, 'New Arrivals Saleu', NULL, '609a5fc14a725.jpg', NULL, 1.00, 'Hurry, Sale Ends This Friday', 'This is your last chance to save 30%', 'Yes,I Want to Save 30%', 'http://example.com/', '29A19C', '03/14/2022', '3:00 AM', 1500, 7, 6, 0, '2021-04-06 19:34:08', '2025-08-08 19:05:45'),
(17, 176, 'Flash Sale', '606d5691a51bf.jpg', NULL, '930077', 1.00, 'Hurry, Sale Ends This Friday', 'This is your last chance to save 30%', 'Yes,I Want to Save 30%', 'http://example.com/', 'FA00CA', '04/09/2022', '10:00 AM', 1500, 8, 7, 0, '2021-04-06 19:36:04', '2021-05-23 00:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `postal_codes`
--

CREATE TABLE `postal_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `postcode` varchar(50) DEFAULT NULL,
  `charge` decimal(11,2) NOT NULL DEFAULT 0.00,
  `free_delivery_amount` decimal(11,2) DEFAULT NULL,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postal_codes`
--

INSERT INTO `postal_codes` (`id`, `language_id`, `title`, `postcode`, `charge`, `free_delivery_amount`, `serial_number`, `created_at`, `updated_at`) VALUES
(1, 176, 'Croton On Hudson', '10520', 2.00, NULL, 1, '2021-05-13 03:59:27', '2022-03-17 13:43:15'),
(2, 176, 'Scarsdale', '10583', 1.00, NULL, 2, '2021-05-13 04:10:31', '2021-05-13 04:10:31'),
(3, 176, 'Washington', '20036', 0.00, NULL, 3, '2021-05-13 04:11:01', '2021-05-13 04:11:58'),
(4, 176, 'Williamsburg', '23185', 2.50, NULL, 4, '2021-05-13 04:11:43', '2022-03-17 13:42:26'),
(5, 176, 'Bynum', '36253', 2.00, 30.00, 1, '2022-03-17 09:06:19', '2022-03-17 09:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `pos_payment_methods`
--

CREATE TABLE `pos_payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 - active, 0 - deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos_payment_methods`
--

INSERT INTO `pos_payment_methods` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'On Cash', 1, '2021-04-11 00:57:46', '2021-04-11 00:57:57'),
(4, 'Paypal', 1, '2021-05-10 11:30:28', '2021-05-10 11:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `feature_image` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `variations` text DEFAULT NULL,
  `addons` text DEFAULT NULL,
  `current_price` decimal(11,2) NOT NULL DEFAULT 0.00,
  `previous_price` decimal(11,2) DEFAULT 0.00,
  `rating` decimal(11,2) NOT NULL DEFAULT 0.00,
  `status` int(11) NOT NULL DEFAULT 1,
  `is_feature` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_special` tinyint(4) NOT NULL DEFAULT 0,
  `subcategory_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `language_id`, `title`, `slug`, `category_id`, `feature_image`, `summary`, `description`, `variations`, `addons`, `current_price`, `previous_price`, `rating`, `status`, `is_feature`, `created_at`, `updated_at`, `is_special`, `subcategory_id`) VALUES
(69, 176, 'CROUSTY GOURMAND BŒUF', 'crousty-gourmand-boeuf', 21, '1754784323_CROUSTY_GOURMAND_B__UF.png', 'Sandwich croustillant au bœuf grillé avec légumes frais et sauce spéciale', 'Un délicieux sandwich avec du bœuf grillé tendre, accompagné de légumes frais croquants, de sauce blanche crémeuse et de notre sauce spéciale King Kebab. Servi dans un pain pita fraîchement cuit.', NULL, NULL, 7.00, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(70, 176, 'CROUSTY GOURMAND CHICKEN', 'crousty-gourmand-chicken', 21, '1754784323_CROUSTY_GOURMAND_CHICKEN.png', 'Sandwich croustillant au poulet grillé avec légumes frais et sauce spéciale', 'Sandwich savoureux avec du poulet grillé mariné dans nos épices orientales, légumes frais, fromage et sauce à l\'ail. Une explosion de saveurs dans chaque bouchée.', NULL, NULL, 7.00, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(71, 176, 'DOUBLE CHEEZ BURGER', 'double-cheez-burger', 21, '1754784323_DOUBLE_CHEEZ_BURGER.png', 'Burger avec double fromage, steak haché et légumes', 'Burger généreux avec deux tranches de fromage fondant, steak haché grillé, salade, tomates, oignons et sauce burger dans un pain brioche.', NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(72, 176, 'Cheese Burger', 'cheese-burger', 21, '1754784323_Cheese_Burger.png', 'Burger classique avec fromage et steak haché', 'Le classique indémodable : steak haché grillé, fromage fondu, salade, tomates et sauce burger dans un pain moelleux.', NULL, NULL, 5.50, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(73, 176, 'Maxi Galette Kebab', 'maxi-galette-kebab', 21, '1754784323_Maxi_Galette_Kebab.png', 'Grande galette avec kebab, légumes et sauce', 'Généreuse galette garnie de kebab d\'agneau mariné 24h, légumes frais, fromage et nos sauces maison. Parfait pour les gros appétits.', NULL, NULL, 12.00, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(74, 176, 'Chicken Burger', 'chicken-burger', 21, '1754784323_Chicken_Burger.png', 'Burger au poulet grillé avec légumes frais', 'Filet de poulet grillé mariné aux épices, salade croquante, tomates fraîches et sauce à l\'ail dans un pain brioche.', NULL, NULL, 5.50, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(75, 176, 'Galette Kebab', 'galette-kebab', 21, '1754784323_Galette_Kebab.png', 'Galette traditionnelle avec kebab et légumes', 'Galette garnie de kebab d\'agneau, légumes frais, oignons grillés et sauce blanche dans une galette moelleuse.', NULL, NULL, 7.50, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(76, 176, 'Maxi Cheese Burger', 'maxi-cheese-burger', 21, '1754784323_Maxi_Cheese_Burger.png', 'Version XXL du cheese burger classique', 'Version généreuse du cheese burger avec double steak, fromage supplémentaire et légumes frais.', NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(77, 176, 'Maxi Tacos 999g', 'maxi-tacos-999g', 21, '1754784323_Maxi_Tacos_999g.png', 'Tacos géant de 999g avec viande et légumes', 'Tacos géant garni de viande au choix, légumes, fromage, frites et sauces. Un défi pour les plus affamés !', NULL, NULL, 12.50, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(78, 176, 'Sandwich Américain', 'sandwich-americain', 21, '1754784323_Sandwich_Am__ricain.png', 'Sandwich à l\'américaine avec frites intégrées', 'Sandwich généreux avec viande grillée, frites, légumes, fromage et sauce dans un pain spécial.', NULL, NULL, 7.50, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(79, 176, 'Sandwich KEBAB', 'sandwich-kebab', 21, '1754784324_Sandwich_KEBAB.png', 'Le classique sandwich kebab King Kebab', 'Notre sandwich signature avec kebab d\'agneau mariné, légumes frais, oignons grillés et nos sauces maison.', NULL, NULL, 7.50, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(80, 176, 'Sandwich Kofte', 'sandwich-kofte', 21, '1754784324_Sandwich_Kofte.png', 'Sandwich avec kofte grillé et légumes', 'Délicieux sandwich avec kofte (boulettes de viande épicées), légumes frais et sauce yaourt mentholée.', NULL, NULL, 7.50, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(81, 176, 'Sandwich Maxi Kebab', 'sandwich-maxi-kebab', 21, '1754784324_Sandwich_Maxi_Kebab.png', 'Version XXL de notre sandwich kebab', 'Version généreuse de notre sandwich kebab avec double portion de viande et légumes supplémentaires.', NULL, NULL, 12.00, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(82, 176, 'Sandwich Paninis', 'sandwich-paninis', 21, '1754784324_Sandwich_Paninis.png', 'Panini grillé avec garniture au choix', 'Panini croustillant grillé avec garniture de viande, fromage et légumes, servi chaud.', NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(83, 176, 'Tacos', 'tacos', 21, '1754784324_Tacos.png', 'Tacos traditionnel avec viande et légumes', 'Tacos garni de viande au choix, légumes, fromage, frites et sauce dans une galette souple.', NULL, NULL, 8.00, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(84, 176, 'Tacos Mixte', 'tacos-mixte', 21, '1754784324_Tacos_Mixte.png', 'Tacos avec mélange de viandes', 'Tacos généreux avec mélange de kebab et poulet, légumes, fromage et sauces.', NULL, NULL, 9.50, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(85, 176, 'MENU CROUSTY GOURMAND BŒUF', 'menu-crousty-gourmand-boeuf', 22, '1754784324_MENU_CROUSTY_GOURMAND_B__UF.png', 'Menu avec sandwich crousty bœuf + frites + boisson', 'Menu complet avec notre sandwich crousty gourmand au bœuf, portion de frites maison et boisson au choix.', NULL, NULL, 10.50, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(86, 176, 'MENU CROUSTY GOURMAND CHICKEN', 'menu-crousty-gourmand-chicken', 22, '1754784324_MENU_CROUSTY_GOURMAND_CHICKEN.png', 'Menu avec sandwich crousty poulet + frites + boisson', 'Menu complet avec notre sandwich crousty gourmand au poulet, frites maison et boisson.', NULL, NULL, 10.50, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(87, 176, 'MENU Double CHEEZ', 'menu-double-cheez', 22, '1754784324_MENU_Double_CHEEZ.png', 'Menu avec double cheese burger + frites + boisson', 'Menu généreux avec double cheese burger, frites croustillantes et boisson fraîche.', NULL, NULL, 10.50, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(88, 176, 'Menu Américain', 'menu-americain', 22, '1754784324_Menu_Am__ricain.png', 'Menu avec sandwich américain + frites + boisson', 'Menu américain complet avec sandwich, frites intégrées supplémentaires et boisson.', NULL, NULL, 11.00, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(89, 176, 'Menu Cheese Burger', 'menu-cheese-burger', 22, '1754784324_Menu_Cheese_Burger.png', 'Menu avec cheese burger + frites + boisson', 'Menu classique avec cheese burger, frites dorées et boisson au choix.', NULL, NULL, 8.50, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(90, 176, 'Menu Chicken Burger', 'menu-chicken-burger', 22, '1754784324_Menu_Chicken_Burger.png', 'Menu avec chicken burger + frites + boisson', 'Menu avec burger au poulet grillé, frites maison et boisson rafraîchissante.', NULL, NULL, 8.50, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(91, 176, 'Menu Galette Kebab', 'menu-galette-kebab', 22, '1754784324_Menu_Galette_Kebab.png', 'Menu avec galette kebab + frites + boisson', 'Menu traditionnel avec galette kebab, frites et boisson pour un repas complet.', NULL, NULL, 11.00, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(92, 176, 'Menu Kebab', 'menu-kebab', 22, '1754784324_Menu_Kebab.png', 'Menu avec sandwich kebab + frites + boisson', 'Notre menu signature avec sandwich kebab, frites maison et boisson.', NULL, NULL, 11.00, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(93, 176, 'Menu Kofte', 'menu-kofte', 22, '1754784324_Menu_Kofte.png', 'Menu avec sandwich kofte + frites + boisson', 'Menu oriental avec sandwich kofte épicé, frites et boisson.', NULL, NULL, 11.00, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(94, 176, 'Menu Maxi Cheese Burger', 'menu-maxi-cheese-burger', 22, '1754784324_Menu_Maxi_Cheese_Burger.png', 'Menu avec maxi cheese burger + frites + boisson', 'Menu XXL avec maxi cheese burger, grande portion de frites et boisson.', NULL, NULL, 10.50, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(95, 176, 'Menu Maxi Galette Kebab', 'menu-maxi-galette-kebab', 22, '1754784324_Menu_Maxi_Galette_Kebab.png', 'Menu avec maxi galette kebab + frites + boisson', 'Menu généreux avec maxi galette kebab, grande portion de frites et boisson.', NULL, NULL, 15.50, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(96, 176, 'Menu Maxi Kebab', 'menu-maxi-kebab', 22, '1754784325_Menu_Maxi_Kebab.png', 'Menu avec maxi sandwich kebab + frites + boisson', 'Notre menu le plus généreux avec maxi sandwich kebab, frites et boisson.', NULL, NULL, 15.50, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(97, 176, 'Menu Maxi Tacos 999g', 'menu-maxi-tacos-999g', 22, '1754784325_Menu_Maxi_Tacos_999g.png', 'Menu avec maxi tacos 999g + frites + boisson', 'Menu défi avec notre tacos géant de 999g, frites et boisson. Pour les très gros appétits !', NULL, NULL, 16.00, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(98, 176, 'Menu Paninis', 'menu-paninis', 22, '1754784325_Menu_Paninis.png', 'Menu avec panini + frites + boisson', 'Menu avec panini grillé croustillant, frites dorées et boisson.', NULL, NULL, 10.50, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(99, 176, 'Menu Tacos', 'menu-tacos', 22, '1754784325_Menu_Tacos.png', 'Menu avec tacos + frites + boisson', 'Menu complet avec tacos garni, frites et boisson au choix.', NULL, NULL, 11.50, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(100, 176, 'Menu Tacos Mixte', 'menu-tacos-mixte', 22, '1754784325_Menu_Tacos_Mixte.png', 'Menu avec tacos mixte + frites + boisson', 'Menu avec tacos mixte (kebab + poulet), frites et boisson.', NULL, NULL, 13.00, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(101, 176, 'Assiette KOBANE (kebab kofte tenders)', 'assiette-kobane-kebab-kofte-tenders', 23, '1754784325_Assiette_KOBANE__kebab_kofte_tenders_.png', 'Assiette mixte avec kebab, kofte et tenders', 'Assiette généreuse combinant kebab d\'agneau, kofte épicé et tenders de poulet, servie avec riz, légumes grillés et sauces.', NULL, NULL, 15.00, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(102, 176, 'Assiette Kebab', 'assiette-kebab', 23, '1754784325_Assiette_Kebab.png', 'Assiette avec kebab, riz et légumes', 'Assiette traditionnelle avec kebab d\'agneau mariné, riz basmati, légumes grillés et sauces orientales.', NULL, NULL, 13.00, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(103, 176, 'Assiette Kofte', 'assiette-kofte', 23, '1754784325_Assiette_Kofte.png', 'Assiette avec kofte, riz et légumes', 'Assiette avec kofte (boulettes de viande épicées), riz parfumé et légumes de saison.', NULL, NULL, 13.00, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(104, 176, 'Assiette Poulet Crème', 'assiette-poulet-creme', 23, '1754784325_Assiette_Poulet_Cr__me.png', 'Assiette avec poulet à la crème, riz et légumes', 'Escalope de poulet en sauce crémeuse aux champignons, servie avec riz et légumes.', NULL, NULL, 13.00, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(105, 176, 'Assiette Saumon', 'assiette-saumon', 23, '1754784325_Assiette_Saumon.png', 'Assiette avec saumon grillé, riz et légumes', 'Pavé de saumon grillé aux herbes, accompagné de riz basmati et légumes vapeur.', NULL, NULL, 13.00, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(106, 176, 'Assiette Steak', 'assiette-steak', 23, '1754784325_Assiette_Steak.png', 'Assiette avec steak grillé, riz et légumes', 'Steak de bœuf grillé sauce poivre, servi avec riz et légumes sautés.', NULL, NULL, 13.00, 0.00, 0.00, 1, 0, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(107, 176, 'Menu Enfant', 'menu-enfant', 24, '1754784325_Menu_Enfant.png', 'Menu spécial pour les enfants avec petites portions', 'Menu adapté aux enfants avec mini sandwich ou nuggets, petite portion de frites, compote et petite boisson. Parfait pour les 3-12 ans.', NULL, NULL, 7.00, 0.00, 0.00, 1, 1, '2025-08-08 22:55:34', '2025-08-08 22:55:34', 0, NULL),
(108, 176, 'KEBAB', 'kebab', 23, '1754784326_KEBAB.png', 'Délicieux kebab servi avec frites et salade fraîche', 'Délicieux kebab servi avec frites et salade fraîche', NULL, NULL, 12.00, 12.00, 0.00, 1, 0, '2025-08-09 22:20:48', '2025-08-09 22:20:48', 0, NULL),
(109, 176, 'POULET', 'poulet', 23, '1754784326_POULET.png', 'Assiette de poulet grillé avec frites et salade fraîche', 'Assiette de poulet grillé avec frites et salade fraîche', NULL, NULL, 12.00, 12.00, 0.00, 1, 0, '2025-08-09 22:20:48', '2025-08-09 22:20:48', 0, NULL),
(110, 176, 'SAUMON', 'saumon', 23, '1754784326_SAUMON.png', 'Assiette de saumon grillé avec frites et salade fraîche', 'Assiette de saumon grillé avec frites et salade fraîche', NULL, NULL, 12.00, 12.00, 0.00, 1, 0, '2025-08-09 22:20:48', '2025-08-09 22:20:48', 0, NULL),
(111, 176, 'KOFTE', 'kofte', 23, '1754784326_KOFTE.png', 'Assiette de kofte avec frites et salade fraîche', 'Assiette de kofte avec frites et salade fraîche', NULL, NULL, 11.00, 11.00, 0.00, 1, 0, '2025-08-09 22:20:48', '2025-08-09 22:20:48', 0, NULL),
(112, 176, 'STEAK', 'steak', 23, '1754784326_STEAK.png', 'Assiette de steak avec frites et salade fraîche', 'Assiette de steak avec frites et salade fraîche', NULL, NULL, 11.00, 11.00, 0.00, 1, 0, '2025-08-09 22:20:48', '2025-08-09 22:20:48', 0, NULL),
(113, 176, 'KING', 'king', 23, '1754784326_KING.png', 'Assiette spéciale: KEBAB + KOFTE + TENDERS avec frites et salade fraîche', 'Assiette spéciale: KEBAB + KOFTE + TENDERS avec frites et salade fraîche', NULL, NULL, 14.00, 14.00, 0.00, 1, 0, '2025-08-09 22:20:48', '2025-08-09 22:20:48', 0, NULL),
(114, 176, 'FALAFEL', 'falafel', 29, '1754784326_FALAFEL.png', 'Salade fraîche avec falafels croustillants', NULL, NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-09 22:28:33', '2025-08-09 22:28:33', 0, NULL),
(115, 176, 'FETA', 'feta', 29, '1754784326_FETA.png', 'Salade grecque avec feta authentique', NULL, NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-09 22:28:33', '2025-08-09 22:28:33', 0, NULL),
(116, 176, 'THON', 'thon', 29, '1754784326_THON.png', 'Salade de thon frais avec légumes croquants', NULL, NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-09 22:28:33', '2025-08-09 22:28:33', 0, NULL),
(117, 176, 'TENDERS', 'tenders', 29, '1754784326_TENDERS.png', 'Salade avec tenders de poulet croustillants', NULL, NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-09 22:28:33', '2025-08-09 22:28:33', 0, NULL),
(118, 176, 'FROMAGE', 'fromage', 27, '1754784326_FROMAGE.png', 'Option végétarienne au fromage - Seul: €4.5, Menu: €7.5', NULL, NULL, NULL, 4.50, 0.00, 0.00, 1, 0, '2025-08-09 22:28:33', '2025-08-09 22:28:33', 0, NULL),
(119, 176, 'FALAFEL', 'falafel', 27, '1754784326_FALAFEL.png', 'Falafels végétariens délicieux - Seul: €6.5, Menu: €9.5', NULL, NULL, NULL, 6.50, 0.00, 0.00, 1, 0, '2025-08-09 22:28:33', '2025-08-09 22:28:33', 0, NULL),
(120, 176, 'TACOS SOFT', 'tacos-soft', 27, '1754784326_TACOS_SOFT.png', 'Tacos soft végétarien - Seul: €5, Menu: €8', NULL, NULL, NULL, 5.00, 0.00, 0.00, 1, 0, '2025-08-09 22:28:33', '2025-08-09 22:28:33', 0, NULL),
(121, 176, 'BELGE', 'belge', 27, '1754784326_BELGE.png', 'Option végétarienne belge - Seul: €5, Menu: €8', NULL, NULL, NULL, 5.00, 0.00, 0.00, 1, 0, '2025-08-09 22:28:33', '2025-08-09 22:28:33', 0, NULL),
(122, 176, 'TACOS FALAFEL', 'tacos-falafel', 27, '1754784326_TACOS_FALAFEL.png', 'Tacos falafel végétarien - Seul: €7, Menu: €10', NULL, NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-09 22:28:33', '2025-08-09 22:28:33', 0, NULL),
(123, 176, 'COMPOTE + CAPRISUN + JOUET', 'compote-caprisun-jouet', 24, '1754784327_COMPOTE___CAPRISUN___JOUET.png', 'Menu enfant avec compote, Capri-Sun et jouet', NULL, NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-09 22:28:33', '2025-08-09 22:28:33', 0, NULL),
(124, 176, 'BURGER + FRITES', 'burger-frites', 24, '1754784327_BURGER___FRITES.png', 'Menu enfant avec burger et frites', NULL, NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-09 22:28:33', '2025-08-09 22:28:33', 0, NULL),
(125, 176, 'NUGGETS + FRITES', 'nuggets-frites', 24, '1754784327_NUGGETS___FRITES.png', 'Menu enfant avec nuggets et frites', NULL, NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-09 22:28:33', '2025-08-09 22:28:33', 0, NULL),
(126, 176, 'VIANDE KEBAB + FRITES', 'viande-kebab-frites', 24, '1754784327_VIANDE_KEBAB___FRITES.png', 'Menu enfant avec viande kebab et frites', NULL, NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-09 22:28:33', '2025-08-09 22:28:33', 0, NULL),
(127, 176, 'KEBAB', 'kebab', 21, '1754784327_KEBAB.png', 'Délicieux sandwich kebab traditionnel - Seul: €7, Menu: €10.5', NULL, NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-09 22:30:08', '2025-08-09 22:30:08', 0, NULL),
(128, 176, 'MAXI KEBAB', 'maxi-kebab', 21, '1754784327_MAXI_KEBAB.png', 'Sandwich kebab extra large pour les gros appétits - Seul: €12, Menu: €15', NULL, NULL, NULL, 12.00, 0.00, 0.00, 1, 0, '2025-08-09 22:30:08', '2025-08-09 22:30:08', 0, NULL),
(129, 176, 'GALETTE (VIANDE AU CHOIX)', 'galette-viande-au-choix', 21, '1754784327_GALETTE__VIANDE_AU_CHOIX_.png', 'Galette avec viande de votre choix - Seul: €7.5, Menu: €10.5', NULL, NULL, NULL, 7.50, 0.00, 0.00, 1, 0, '2025-08-09 22:30:08', '2025-08-09 22:30:08', 0, NULL),
(130, 176, 'MAXI GALETTE (VIANDE AU CHOIX)', 'maxi-galette-viande-au-choix', 21, '1754784327_MAXI_GALETTE__VIANDE_AU_CHOIX_.png', 'Galette extra large avec viande de votre choix - Seul: €12, Menu: €15', NULL, NULL, NULL, 12.00, 0.00, 0.00, 1, 0, '2025-08-09 22:30:08', '2025-08-09 22:30:08', 0, NULL),
(131, 176, 'AMERICAIN', 'americain', 21, '1754784327_AMERICAIN.png', 'Sandwich américain classique - Seul: €7.5, Menu: €10.5', NULL, NULL, NULL, 7.50, 0.00, 0.00, 1, 0, '2025-08-09 22:30:08', '2025-08-09 22:30:08', 0, NULL),
(132, 176, 'KOFTE', 'kofte', 21, '1754784327_KOFTE.png', 'Sandwich kofte savoureux - Seul: €7.5, Menu: €10.5', NULL, NULL, NULL, 7.50, 0.00, 0.00, 1, 0, '2025-08-09 22:30:08', '2025-08-09 22:30:08', 0, NULL),
(133, 176, 'PANINI (VIANDE AU CHOIX)', 'panini-viande-au-choix', 21, '1754784327_PANINI__VIANDE_AU_CHOIX_.png', 'Panini avec viande de votre choix - Seul: €7, Menu: €10', NULL, NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-09 22:30:08', '2025-08-09 22:30:08', 0, NULL),
(134, 176, 'PETITE FRITE', 'petite-frite', 23, '1754784327_PETITE_FRITE.png', 'Portion de frites petite taille', NULL, NULL, NULL, 2.00, 0.00, 0.00, 1, 0, '2025-08-09 22:30:08', '2025-08-09 22:30:08', 0, NULL),
(135, 176, 'GRANDE FRITE', 'grande-frite', 23, '1754784327_GRANDE_FRITE.png', 'Portion de frites grande taille', NULL, NULL, NULL, 4.00, 0.00, 0.00, 1, 0, '2025-08-09 22:30:08', '2025-08-09 22:30:08', 0, NULL),
(136, 176, 'PETITE VIANDE', 'petite-viande', 23, '1754784327_PETITE_VIANDE.png', 'Portion de viande petite taille', NULL, NULL, NULL, 5.00, 0.00, 0.00, 1, 0, '2025-08-09 22:30:08', '2025-08-09 22:30:08', 0, NULL),
(137, 176, 'GRANDE VIANDE', 'grande-viande', 23, '1754784327_GRANDE_VIANDE.png', 'Portion de viande grande taille', NULL, NULL, NULL, 10.00, 0.00, 0.00, 1, 0, '2025-08-09 22:30:08', '2025-08-09 22:30:08', 0, NULL),
(138, 176, 'TACOS (1 VIANDE AU CHOIX)', 'tacos-1-viande-au-choix', 27, '1754784327_TACOS__1_VIANDE_AU_CHOIX_.png', 'Tacos avec 1 viande de votre choix - Seul: €8, Menu: €11', NULL, NULL, NULL, 8.00, 0.00, 0.00, 1, 0, '2025-08-09 22:31:17', '2025-08-09 22:31:17', 0, NULL),
(139, 176, 'TACOS MIXTE (2 VIANDES AU CHOIX)', 'tacos-mixte-2-viandes-au-choix', 27, '1754784328_TACOS_MIXTE__2_VIANDES_AU_CHOIX_.png', 'Tacos avec 2 viandes de votre choix - Seul: €9.5, Menu: €12.5', NULL, NULL, NULL, 9.50, 0.00, 0.00, 1, 0, '2025-08-09 22:31:17', '2025-08-09 22:31:17', 0, NULL),
(140, 176, 'MEGA TACOS (1 VIANDE AU CHOIX)', 'mega-tacos-1-viande-au-choix', 27, '1754784328_MEGA_TACOS__1_VIANDE_AU_CHOIX_.png', 'Mega tacos avec 1 viande de votre choix - Seul: €12.5, Menu: €15.5', NULL, NULL, NULL, 12.50, 0.00, 0.00, 1, 0, '2025-08-09 22:31:17', '2025-08-09 22:31:17', 0, NULL),
(141, 176, 'MEGA TACOS MIXTE (2 VIANDES AU CHOIX)', 'mega-tacos-mixte-2-viandes-au-choix', 27, '1754784328_MEGA_TACOS_MIXTE__2_VIANDES_AU_CHOIX_.png', 'Mega tacos avec 2 viandes de votre choix - Seul: €14.5, Menu: €17.5', NULL, NULL, NULL, 14.50, 0.00, 0.00, 1, 0, '2025-08-09 22:31:17', '2025-08-09 22:31:17', 0, NULL),
(142, 176, 'CHEESE BURGER', 'cheese-burger', 28, '1754784328_CHEESE_BURGER.png', 'Burger classique au fromage - Seul: €5.5, Menu: €8.5', NULL, NULL, NULL, 5.50, 0.00, 0.00, 1, 0, '2025-08-09 22:31:17', '2025-08-09 22:31:17', 0, NULL),
(143, 176, 'DOUBLE CHEESE BURGER', 'double-cheese-burger', 28, '1754784328_DOUBLE_CHEESE_BURGER.png', 'Burger double fromage - Seul: €7, Menu: €10', NULL, NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-09 22:31:17', '2025-08-09 22:31:17', 0, NULL),
(144, 176, 'CHICKEN', 'chicken', 28, '1754784328_CHICKEN.png', 'Burger au poulet - Seul: €5.5, Menu: €8.5', NULL, NULL, NULL, 5.50, 0.00, 0.00, 1, 0, '2025-08-09 22:31:17', '2025-08-09 22:31:17', 0, NULL),
(145, 176, 'CROUSTY GOURMAND (POULET OU BŒUF)', 'crousty-gourmand-poulet-ou-boeuf', 28, '1754784328_CROUSTY_GOURMAND__POULET_OU_B__UF_.png', 'Burger croustillant au poulet ou bœuf - Seul: €7, Menu: €10', NULL, NULL, NULL, 7.00, 0.00, 0.00, 1, 0, '2025-08-09 22:31:17', '2025-08-09 22:31:17', 0, NULL),
(146, 176, 'VEGGIE BURGER', 'veggie-burger', 28, '1754784328_VEGGIE_BURGER.png', 'Burger végétarien - Seul: €4, Menu: €7', NULL, NULL, NULL, 4.00, 0.00, 0.00, 1, 0, '2025-08-09 22:31:17', '2025-08-09 22:31:17', 0, NULL),
(147, 176, 'LE BIG CHÈVRE (POULET OU BŒUF)', 'le-big-chevre-poulet-ou-boeuf', 28, '1754784328_LE_BIG_CH__VRE__POULET_OU_B__UF_.png', 'Grand burger au poulet ou bœuf - Seul: €6.5, Menu: €9.5', NULL, NULL, NULL, 6.50, 0.00, 0.00, 1, 0, '2025-08-09 22:31:17', '2025-08-09 22:31:17', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(46, 15, '5f49f71d3e143.jpg', '2020-08-29 00:35:09', '2020-08-29 00:50:08'),
(47, 15, '5f49f71d55108.jpg', '2020-08-29 00:35:09', '2020-08-29 00:50:08'),
(48, 15, '5f49f71dc6ba6.jpg', '2020-08-29 00:35:09', '2020-08-29 00:50:08'),
(49, 15, '5f49f71dd6ec1.jpg', '2020-08-29 00:35:09', '2020-08-29 00:50:08'),
(50, 15, '5f49f71e2f633.jpg', '2020-08-29 00:35:10', '2020-08-29 00:50:08'),
(51, 15, '5f49f71e42478.jpg', '2020-08-29 00:35:10', '2020-08-29 00:50:08'),
(52, 16, '5f49fded6d5b2.jpg', '2020-08-29 01:04:13', '2020-08-29 01:05:55'),
(53, 16, '5f49fded8b2ff.jpg', '2020-08-29 01:04:13', '2020-08-29 01:05:55'),
(54, 16, '5f49fdedee30b.jpg', '2020-08-29 01:04:13', '2020-08-29 01:05:55'),
(55, 16, '5f49fdee1fb13.jpg', '2020-08-29 01:04:14', '2020-08-29 01:05:55'),
(56, 16, '5f49fdef73578.jpg', '2020-08-29 01:04:15', '2020-08-29 01:05:55'),
(57, 16, '5f49fdef7f5df.jpg', '2020-08-29 01:04:15', '2020-08-29 01:05:55'),
(58, 17, '5f49fe8727bdd.jpg', '2020-08-29 01:06:47', '2020-08-29 01:07:55'),
(59, 17, '5f49fe872b59b.jpg', '2020-08-29 01:06:47', '2020-08-29 01:07:55'),
(60, 17, '5f49fe879e5ef.jpg', '2020-08-29 01:06:47', '2020-08-29 01:07:55'),
(61, 17, '5f49fe87a12f7.jpg', '2020-08-29 01:06:47', '2020-08-29 01:07:55'),
(62, 17, '5f49fe880dc20.jpg', '2020-08-29 01:06:48', '2020-08-29 01:07:55'),
(63, 17, '5f49fe8813908.jpg', '2020-08-29 01:06:48', '2020-08-29 01:07:55'),
(64, 18, '5f49ff519ac98.jpg', '2020-08-29 01:10:09', '2020-08-29 01:10:27'),
(65, 18, '5f49ff519ae30.jpg', '2020-08-29 01:10:09', '2020-08-29 01:10:27'),
(66, 18, '5f49ff51ed17a.jpg', '2020-08-29 01:10:09', '2020-08-29 01:10:27'),
(67, 18, '5f49ff5202028.jpg', '2020-08-29 01:10:10', '2020-08-29 01:10:27'),
(68, 18, '5f49ff524eea1.jpg', '2020-08-29 01:10:10', '2020-08-29 01:10:27'),
(69, 18, '5f49ff5252441.jpg', '2020-08-29 01:10:10', '2020-08-29 01:10:27'),
(70, 19, '5f4a01291c821.jpg', '2020-08-29 01:18:01', '2020-08-29 01:20:27'),
(71, 19, '5f4a012922549.jpg', '2020-08-29 01:18:01', '2020-08-29 01:20:27'),
(72, 19, '5f4a012999765.jpg', '2020-08-29 01:18:01', '2020-08-29 01:20:27'),
(73, 19, '5f4a0129a1e11.jpg', '2020-08-29 01:18:01', '2020-08-29 01:20:27'),
(74, 19, '5f4a012a0afb0.jpg', '2020-08-29 01:18:02', '2020-08-29 01:20:27'),
(75, 19, '5f4a012a19c1a.jpg', '2020-08-29 01:18:02', '2020-08-29 01:20:27'),
(76, 20, '5f4a01c74d254.jpg', '2020-08-29 01:20:39', '2020-08-29 01:21:34'),
(77, 20, '5f4a01c751162.jpg', '2020-08-29 01:20:39', '2020-08-29 01:21:34'),
(78, 20, '5f4a01c79ed20.jpg', '2020-08-29 01:20:39', '2020-08-29 01:21:34'),
(79, 20, '5f4a01c7a43ff.jpg', '2020-08-29 01:20:39', '2020-08-29 01:21:34'),
(80, 20, '5f4a01c800d53.jpg', '2020-08-29 01:20:40', '2020-08-29 01:21:34'),
(81, 20, '5f4a01c80a3e0.jpg', '2020-08-29 01:20:40', '2020-08-29 01:21:34'),
(82, 21, '5f4a037b6863d.jpg', '2020-08-29 01:27:55', '2020-08-29 01:28:55'),
(83, 21, '5f4a037b6b021.jpg', '2020-08-29 01:27:55', '2020-08-29 01:28:55'),
(84, 21, '5f4a037c15972.jpg', '2020-08-29 01:27:56', '2020-08-29 01:28:55'),
(85, 21, '5f4a037c22754.jpg', '2020-08-29 01:27:56', '2020-08-29 01:28:55'),
(86, 21, '5f4a037c72b86.jpg', '2020-08-29 01:27:56', '2020-08-29 01:28:55'),
(87, 21, '5f4a037c74ebf.jpg', '2020-08-29 01:27:56', '2020-08-29 01:28:55'),
(88, 22, '5f4a04b809578.jpg', '2020-08-29 01:33:12', '2020-08-29 01:33:15'),
(89, 22, '5f4a04b809f46.jpg', '2020-08-29 01:33:12', '2020-08-29 01:33:15'),
(90, 22, '5f4a04b85664d.jpg', '2020-08-29 01:33:12', '2020-08-29 01:33:15'),
(91, 22, '5f4a04b8585c8.jpg', '2020-08-29 01:33:12', '2020-08-29 01:33:15'),
(92, 22, '5f4a04b8aac60.jpg', '2020-08-29 01:33:12', '2020-08-29 01:33:15'),
(93, 22, '5f4a04b8ac060.jpg', '2020-08-29 01:33:12', '2020-08-29 01:33:15'),
(94, 23, '5f4a05dd9711f.jpg', '2020-08-29 01:38:05', '2020-08-29 01:38:51'),
(95, 23, '5f4a05dd9bcdb.jpg', '2020-08-29 01:38:05', '2020-08-29 01:38:51'),
(96, 23, '5f4a05de52f5a.jpg', '2020-08-29 01:38:06', '2020-08-29 01:38:51'),
(97, 23, '5f4a05de69582.jpg', '2020-08-29 01:38:06', '2020-08-29 01:38:51'),
(98, 23, '5f4a05e04463c.jpg', '2020-08-29 01:38:08', '2020-08-29 01:38:51'),
(99, 23, '5f4a05e044bff.jpg', '2020-08-29 01:38:08', '2020-08-29 01:38:51'),
(100, 24, '5f4a061889d00.jpg', '2020-08-29 01:39:04', '2020-08-29 01:39:57'),
(101, 24, '5f4a0618aa724.jpg', '2020-08-29 01:39:04', '2020-08-29 01:39:57'),
(102, 24, '5f4a06191dde9.jpg', '2020-08-29 01:39:05', '2020-08-29 01:39:57'),
(103, 24, '5f4a06191d50e.jpg', '2020-08-29 01:39:05', '2020-08-29 01:39:57'),
(104, 24, '5f4a061968d00.jpg', '2020-08-29 01:39:05', '2020-08-29 01:39:57'),
(105, 24, '5f4a0619690fd.jpg', '2020-08-29 01:39:05', '2020-08-29 01:39:57'),
(106, 25, '5f4a06c5a0358.jpg', '2020-08-29 01:41:57', '2020-08-29 01:42:42'),
(107, 25, '5f4a06c5a2754.jpg', '2020-08-29 01:41:57', '2020-08-29 01:42:42'),
(108, 25, '5f4a06c606a64.jpg', '2020-08-29 01:41:58', '2020-08-29 01:42:42'),
(109, 25, '5f4a06c60966e.jpg', '2020-08-29 01:41:58', '2020-08-29 01:42:42'),
(110, 25, '5f4a06c64f8bd.jpg', '2020-08-29 01:41:58', '2020-08-29 01:42:42'),
(111, 25, '5f4a06c653d62.jpg', '2020-08-29 01:41:58', '2020-08-29 01:42:42'),
(112, 26, '5f4a07054dae3.jpg', '2020-08-29 01:43:01', '2020-08-29 01:44:32'),
(113, 26, '5f4a07058abce.jpg', '2020-08-29 01:43:01', '2020-08-29 01:44:32'),
(114, 26, '5f4a070632ac7.jpg', '2020-08-29 01:43:02', '2020-08-29 01:44:32'),
(115, 26, '5f4a070674ed0.jpg', '2020-08-29 01:43:02', '2020-08-29 01:44:32'),
(116, 26, '5f4a0706d92e5.jpg', '2020-08-29 01:43:02', '2020-08-29 01:44:32'),
(117, 26, '5f4a0706f13e7.jpg', '2020-08-29 01:43:02', '2020-08-29 01:44:32'),
(118, 27, '5f4a08969cfa5.jpg', '2020-08-29 01:49:42', '2020-08-29 01:53:55'),
(119, 27, '5f4a0896c48c7.jpg', '2020-08-29 01:49:42', '2020-08-29 01:53:55'),
(120, 27, '5f4a08972892b.jpg', '2020-08-29 01:49:43', '2020-08-29 01:53:55'),
(121, 27, '5f4a08974ce00.jpg', '2020-08-29 01:49:43', '2020-08-29 01:53:55'),
(122, 27, '5f4a089781191.jpg', '2020-08-29 01:49:43', '2020-08-29 01:53:55'),
(123, 27, '5f4a089795b4b.jpg', '2020-08-29 01:49:43', '2020-08-29 01:53:55'),
(125, 28, '5f4a09ba77c85.jpg', '2020-08-29 01:54:34', '2020-08-29 01:55:30'),
(126, 28, '5f4a09ba8bbdb.jpg', '2020-08-29 01:54:34', '2020-08-29 01:55:30'),
(127, 28, '5f4a09bab8d8b.jpg', '2020-08-29 01:54:34', '2020-08-29 01:55:30'),
(128, 28, '5f4a09bace806.jpg', '2020-08-29 01:54:34', '2020-08-29 01:55:30'),
(129, 28, '5f4a09bb1a543.jpg', '2020-08-29 01:54:35', '2020-08-29 01:55:30'),
(130, 28, '5f4a09bb2ae1b.jpg', '2020-08-29 01:54:35', '2020-08-29 01:55:30'),
(131, 29, '5f4a0a0001078.jpg', '2020-08-29 01:55:44', '2020-08-29 01:56:37'),
(132, 29, '5f4a0a0008941.jpg', '2020-08-29 01:55:44', '2020-08-29 01:56:37'),
(133, 29, '5f4a0a0046b52.jpg', '2020-08-29 01:55:44', '2020-08-29 01:56:37'),
(134, 29, '5f4a0a005230d.jpg', '2020-08-29 01:55:44', '2020-08-29 01:56:37'),
(135, 29, '5f4a0a0093455.jpg', '2020-08-29 01:55:44', '2020-08-29 01:56:37'),
(136, 29, '5f4a0a009b5fb.jpg', '2020-08-29 01:55:44', '2020-08-29 01:56:37'),
(137, 30, '5f4a0a5f82da3.jpg', '2020-08-29 01:57:19', '2020-08-29 01:58:56'),
(138, 30, '5f4a0a5f8deb4.jpg', '2020-08-29 01:57:19', '2020-08-29 01:58:56'),
(139, 30, '5f4a0a61094ab.jpg', '2020-08-29 01:57:21', '2020-08-29 01:58:56'),
(140, 30, '5f4a0a610a3ff.jpg', '2020-08-29 01:57:21', '2020-08-29 01:58:56'),
(141, 30, '5f4a0a614d32c.jpg', '2020-08-29 01:57:21', '2020-08-29 01:58:56'),
(142, 30, '5f4a0a614d5f1.jpg', '2020-08-29 01:57:21', '2020-08-29 01:58:56'),
(143, 31, '5f4a0ad4d5e81.jpg', '2020-08-29 01:59:16', '2020-08-29 02:00:10'),
(144, 31, '5f4a0ad4d72e7.jpg', '2020-08-29 01:59:16', '2020-08-29 02:00:10'),
(145, 31, '5f4a0ad53a175.jpg', '2020-08-29 01:59:17', '2020-08-29 02:00:10'),
(146, 31, '5f4a0ad54226c.jpg', '2020-08-29 01:59:17', '2020-08-29 02:00:10'),
(147, 31, '5f4a0ad586a4d.jpg', '2020-08-29 01:59:17', '2020-08-29 02:00:10'),
(148, 31, '5f4a0ad589b04.jpg', '2020-08-29 01:59:17', '2020-08-29 02:00:10'),
(149, 32, '5f4a0b377bda5.jpg', '2020-08-29 02:00:55', '2020-08-29 02:01:36'),
(150, 32, '5f4a0b378e9e2.jpg', '2020-08-29 02:00:55', '2020-08-29 02:01:36'),
(151, 32, '5f4a0b37c8f82.jpg', '2020-08-29 02:00:55', '2020-08-29 02:01:36'),
(152, 32, '5f4a0b37dc0e3.jpg', '2020-08-29 02:00:55', '2020-08-29 02:01:36'),
(153, 32, '5f4a0b3822f08.jpg', '2020-08-29 02:00:56', '2020-08-29 02:01:36'),
(154, 32, '5f4a0b38333f8.jpg', '2020-08-29 02:00:56', '2020-08-29 02:01:36'),
(155, 33, '5f4a0c1700047.jpg', '2020-08-29 02:04:39', '2020-08-29 02:05:47'),
(156, 33, '5f4a0c1717ac2.jpg', '2020-08-29 02:04:39', '2020-08-29 02:05:47'),
(157, 33, '5f4a0c174ea7f.jpg', '2020-08-29 02:04:39', '2020-08-29 02:05:47'),
(158, 33, '5f4a0c175bf91.jpg', '2020-08-29 02:04:39', '2020-08-29 02:05:47'),
(159, 33, '5f4a0c179799d.jpg', '2020-08-29 02:04:39', '2020-08-29 02:05:47'),
(160, 33, '5f4a0c17a19a0.jpg', '2020-08-29 02:04:39', '2020-08-29 02:05:47'),
(162, 34, '5f4a0c7e26013.jpg', '2020-08-29 02:06:22', '2020-08-29 02:07:12'),
(163, 34, '5f4a0c7e34d52.jpg', '2020-08-29 02:06:22', '2020-08-29 02:07:12'),
(164, 34, '5f4a0c7e69e61.jpg', '2020-08-29 02:06:22', '2020-08-29 02:07:12'),
(165, 34, '5f4a0c7e7bbc9.jpg', '2020-08-29 02:06:22', '2020-08-29 02:07:12'),
(166, 34, '5f4a0c7ec05e8.jpg', '2020-08-29 02:06:22', '2020-08-29 02:07:12'),
(167, 34, '5f4a0c7ece222.jpg', '2020-08-29 02:06:22', '2020-08-29 02:07:12'),
(168, 35, '5f4a0ce4ec541.jpg', '2020-08-29 02:08:04', '2020-08-29 02:08:52'),
(169, 35, '5f4a0ce5070e1.jpg', '2020-08-29 02:08:05', '2020-08-29 02:08:52'),
(170, 35, '5f4a0ce588b80.jpg', '2020-08-29 02:08:05', '2020-08-29 02:08:52'),
(171, 35, '5f4a0ce5963da.jpg', '2020-08-29 02:08:05', '2020-08-29 02:08:52'),
(172, 35, '5f4a0ce5cfd49.jpg', '2020-08-29 02:08:05', '2020-08-29 02:08:52'),
(173, 35, '5f4a0ce5e8329.jpg', '2020-08-29 02:08:05', '2020-08-29 02:08:52'),
(174, 36, '5f4a0d32821ba.jpg', '2020-08-29 02:09:22', '2020-08-29 02:10:00'),
(175, 36, '5f4a0d32895a9.jpg', '2020-08-29 02:09:22', '2020-08-29 02:10:00'),
(176, 36, '5f4a0d32c62e4.jpg', '2020-08-29 02:09:22', '2020-08-29 02:10:00'),
(177, 36, '5f4a0d32ca3e5.jpg', '2020-08-29 02:09:22', '2020-08-29 02:10:00'),
(178, 36, '5f4a0d3321a7b.jpg', '2020-08-29 02:09:23', '2020-08-29 02:10:00'),
(179, 36, '5f4a0d3328ae6.jpg', '2020-08-29 02:09:23', '2020-08-29 02:10:00'),
(182, 37, '5f4a0dc41b3c0.jpg', '2020-08-29 02:11:48', '2020-08-29 02:12:30'),
(183, 37, '5f4a0dc431759.jpg', '2020-08-29 02:11:48', '2020-08-29 02:12:30'),
(184, 37, '5f4a0dc473774.jpg', '2020-08-29 02:11:48', '2020-08-29 02:12:30'),
(185, 37, '5f4a0dc486595.jpg', '2020-08-29 02:11:48', '2020-08-29 02:12:30'),
(186, 37, '5f4a0dc4bf74e.jpg', '2020-08-29 02:11:48', '2020-08-29 02:12:30'),
(187, 37, '5f4a0dc4c9bdd.jpg', '2020-08-29 02:11:48', '2020-08-29 02:12:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_orders`
--

CREATE TABLE `product_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `billing_country` varchar(255) DEFAULT NULL,
  `billing_fname` varchar(255) DEFAULT NULL,
  `billing_lname` varchar(255) DEFAULT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `billing_city` varchar(255) DEFAULT NULL,
  `billing_email` varchar(255) DEFAULT NULL,
  `billing_country_code` varchar(10) DEFAULT NULL,
  `billing_number` varchar(255) DEFAULT NULL,
  `shpping_country` varchar(255) DEFAULT NULL,
  `shpping_fname` varchar(255) DEFAULT NULL,
  `shpping_lname` varchar(255) DEFAULT NULL,
  `shpping_address` varchar(255) DEFAULT NULL,
  `shpping_city` varchar(255) DEFAULT NULL,
  `shpping_email` varchar(255) DEFAULT NULL,
  `shpping_country_code` varchar(10) DEFAULT NULL,
  `shpping_number` varchar(255) DEFAULT NULL,
  `total` decimal(11,2) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `gateway_type` varchar(50) DEFAULT NULL,
  `currency_code` varchar(255) DEFAULT NULL,
  `currency_code_position` varchar(20) DEFAULT NULL,
  `currency_symbol` blob DEFAULT NULL,
  `currency_symbol_position` varchar(20) DEFAULT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `token_no` int(11) DEFAULT NULL,
  `shipping_method` varchar(255) DEFAULT NULL,
  `shipping_charge` decimal(11,2) DEFAULT NULL,
  `postal_code` text DEFAULT NULL,
  `postal_code_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 - post code based delivery enabled, 0 - post code based delivery disabled',
  `payment_status` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'pending',
  `txnid` varchar(255) DEFAULT NULL,
  `charge_id` varchar(255) DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `receipt` varchar(100) DEFAULT NULL,
  `order_notes` text DEFAULT NULL,
  `completed` varchar(20) NOT NULL DEFAULT 'no',
  `type` varchar(255) DEFAULT NULL,
  `serving_method` varchar(255) DEFAULT NULL,
  `pick_up_date` varchar(100) DEFAULT NULL,
  `pick_up_time` varchar(100) DEFAULT NULL,
  `waiter_name` varchar(255) DEFAULT NULL,
  `table_number` varchar(20) DEFAULT NULL,
  `tax` decimal(11,2) NOT NULL DEFAULT 0.00,
  `coupon` decimal(11,2) NOT NULL DEFAULT 0.00,
  `delivery_date` varchar(100) DEFAULT NULL,
  `delivery_time_start` varchar(100) DEFAULT NULL,
  `delivery_time_end` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_orders`
--

INSERT INTO `product_orders` (`id`, `user_id`, `billing_country`, `billing_fname`, `billing_lname`, `billing_address`, `billing_city`, `billing_email`, `billing_country_code`, `billing_number`, `shpping_country`, `shpping_fname`, `shpping_lname`, `shpping_address`, `shpping_city`, `shpping_email`, `shpping_country_code`, `shpping_number`, `total`, `method`, `gateway_type`, `currency_code`, `currency_code_position`, `currency_symbol`, `currency_symbol_position`, `order_number`, `token_no`, `shipping_method`, `shipping_charge`, `postal_code`, `postal_code_status`, `payment_status`, `order_status`, `txnid`, `charge_id`, `invoice_number`, `created_at`, `updated_at`, `receipt`, `order_notes`, `completed`, `type`, `serving_method`, `pick_up_date`, `pick_up_time`, `waiter_name`, `table_number`, `tax`, `coupon`, `delivery_date`, `delivery_time_start`, `delivery_time_end`) VALUES
(157, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5.25, NULL, NULL, 'EUR', 'right', 0xe282ac, 'left', 'HSsE-1754695839', 184, NULL, NULL, NULL, 0, 'Completed', 'pending', NULL, NULL, NULL, '2025-08-08 22:30:39', '2025-08-08 22:30:39', NULL, NULL, 'no', 'pos', 'on_table', NULL, NULL, NULL, '6', 0.25, 0.00, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `review` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `review`, `comment`, `created_at`, `updated_at`) VALUES
(6, 1, 6, 4, 'Hi', '2020-07-20 07:49:41', '2020-07-20 08:46:57'),
(7, 1, 11, 5, 'Great!', '2020-08-24 04:23:58', '2020-08-24 04:42:16'),
(8, 1, 13, 3, 'hello', '2020-08-25 00:45:14', '2020-08-25 00:45:14'),
(9, 2, 15, 5, 'Great product & Excellent service !! 5 Starsssss!', '2020-08-30 10:06:17', '2020-08-30 10:06:17'),
(10, 2, 17, 4, 'Good Quality but not satisfied with the delivery speed :(', '2020-08-30 10:07:05', '2020-08-30 10:07:05'),
(11, 2, 19, 3, 'Good product but there are chances to improve their services.', '2020-08-30 10:07:42', '2020-08-30 10:07:42'),
(12, 2, 20, 5, 'Really happy with my order, will order again & again !!!', '2020-08-30 10:08:19', '2020-08-30 10:08:19'),
(13, 2, 18, 1, 'Very unhygenic, not happy with their delivery service too !!', '2020-08-30 10:09:05', '2020-08-30 10:09:05'),
(14, 2, 16, 5, 'Very Tasty set menu, I am gonna refer this item to my friends too. Thanks a lot !!!!', '2020-08-30 10:09:49', '2020-08-30 10:09:49'),
(15, 2, 37, 5, 'Never drunk any tasty cold drink like this one !! Keep it up guys!!!', '2020-08-30 10:11:51', '2020-08-30 10:11:51'),
(16, 2, 34, 4, 'Very cold & fresh lemon Juice. But please maintain the level of salt . It was too saltyyy!!', '2020-08-30 10:13:08', '2020-08-30 10:13:08'),
(17, 2, 31, 1, 'Worst donut ever !!!!! Cannot believe what I just ate.', '2020-08-30 10:13:53', '2020-08-30 10:13:53'),
(18, 2, 38, 5, 'The mint flavor is awesome, great mixture of the mint & lemon !!!', '2020-08-31 00:47:52', '2020-08-31 00:47:52'),
(19, 2, 35, 5, 'Never drank a orange juice like this ! Awesome guys !!! Keep it up.', '2020-08-31 00:49:58', '2020-08-31 00:49:58'),
(20, 2, 32, 2, 'That is more like a biscuit than cookie. very bad !!!', '2020-08-31 00:50:41', '2020-08-31 00:50:41'),
(21, 2, 30, 4, 'Good but there are place to improve the item more.', '2020-08-31 00:53:21', '2020-08-31 00:53:21'),
(22, 2, 33, 3, 'The amount is ice is too much that it reduces the amount of coke !!!', '2020-08-31 00:53:59', '2020-08-31 00:53:59'),
(23, 2, 36, 5, 'Very fresh, healthy, tasty & organic juice. I will order again !!!', '2020-08-31 00:54:45', '2020-08-31 00:54:45'),
(24, 1, 38, 3, 'Awesome taste & quality but the delivery service is poor !!', '2020-08-31 00:59:56', '2020-08-31 00:59:56'),
(25, 1, 35, 5, 'Very fresh, hygenic, healthy & tasty juice. Proper mixture of salt, sugar & orange !!!', '2020-08-31 01:00:55', '2020-08-31 01:00:55'),
(26, 1, 32, 1, 'So bad taste & you guys need to improve the delivery service too !!!', '2020-08-31 01:01:31', '2020-08-31 01:01:31'),
(27, 1, 37, 4, 'Good shakes but please increase the amount of cream at the top', '2020-08-31 01:02:30', '2020-08-31 01:02:30'),
(28, 1, 34, 5, 'Very good & very fast delivery. Loved it !! gonna refer my friends too !', '2020-08-31 01:03:15', '2020-08-31 01:03:15'),
(29, 1, 31, 2, 'strawberry amount is too less, tastes like a biscuit.', '2020-08-31 01:03:55', '2020-08-31 01:04:16'),
(30, 1, 30, 4, 'You can add some chocolate at the top to make it better !!', '2020-08-31 01:04:52', '2020-08-31 01:04:52'),
(31, 1, 33, 4, 'Reduce the amount of ice & improve the delivery service please !', '2020-08-31 01:05:23', '2020-08-31 01:05:23'),
(32, 1, 36, 5, 'Decided to drink it regular, so fresh , healthy & tasty !!!', '2020-08-31 01:05:55', '2020-08-31 01:05:55'),
(33, 1, 20, 5, 'Never been disappointed with their products, will order again & again !!', '2020-08-31 01:08:51', '2020-08-31 01:08:51'),
(34, 1, 19, 5, 'Very fast delivery, the amount of the rice & chicken is more than enough <3 !', '2020-08-31 01:09:37', '2020-08-31 01:09:37'),
(35, 1, 18, 5, 'Loved it, superb taste. Want to rate more than 5 stars actually !!', '2020-08-31 01:10:21', '2020-08-31 01:10:21'),
(36, 1, 17, 4, 'Try to improve the delivery service, the food is good :)', '2020-08-31 01:11:06', '2020-08-31 01:11:06'),
(37, 1, 16, 3, 'The quality has dropped please make it like before :)', '2020-08-31 01:11:34', '2020-08-31 01:11:34'),
(38, 1, 15, 4, 'Very good & tasty food but the food amount is less than the price :(', '2020-08-31 01:12:35', '2020-08-31 01:12:35'),
(39, 1, 26, 5, 'Good one ! Loved the taste !!!', '2020-09-01 12:01:41', '2020-09-01 12:01:41'),
(40, 1, 25, 4, 'Burger is great but improve the delivery service !', '2020-09-01 12:02:14', '2020-09-01 12:02:14'),
(41, 1, 24, 1, 'Really disappointed with their behavior !', '2020-09-01 12:02:42', '2020-09-01 12:02:42'),
(42, 1, 23, 5, 'Great combination of fried chicken & Burger <3', '2020-09-01 12:03:16', '2020-09-01 12:03:16'),
(43, 1, 22, 4, 'The bun quality is poor. Overally, good', '2020-09-01 12:03:47', '2020-09-01 12:03:47'),
(44, 1, 21, 4, 'Too much onion instead increase the amount of cheese !', '2020-09-01 12:04:24', '2020-09-01 12:04:24'),
(45, 9, 17, 4, 'Liked the food', '2020-12-15 01:16:52', '2020-12-15 01:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `psub_categories`
--

CREATE TABLE `psub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_feature` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `psub_categories`
--

INSERT INTO `psub_categories` (`id`, `language_id`, `category_id`, `name`, `slug`, `status`, `is_feature`, `created_at`, `updated_at`) VALUES
(13, 177, 18, '??????????', NULL, 1, 1, '2022-05-29 03:39:05', '2022-05-29 05:10:11'),
(14, 177, 18, '??????', NULL, 1, 1, '2022-05-29 03:39:15', '2022-05-29 05:10:13'),
(15, 177, 18, '?????', NULL, 1, 1, '2022-05-29 03:39:26', '2022-05-29 05:10:15'),
(16, 177, 18, '??????', NULL, 1, 1, '2022-05-29 03:39:57', '2022-05-29 05:10:17'),
(17, 177, 17, '???? ??????', NULL, 1, 1, '2022-05-29 03:41:08', '2022-05-29 05:10:19'),
(18, 177, 17, '???? ???', NULL, 1, 1, '2022-05-29 03:41:22', '2022-05-29 05:10:21'),
(19, 177, 19, '????', NULL, 1, 1, '2022-05-29 03:42:30', '2022-05-29 05:10:23'),
(20, 177, 19, '???', NULL, 1, 1, '2022-05-29 03:42:41', '2022-05-29 05:10:25'),
(21, 177, 19, '????????? ???????', NULL, 1, 1, '2022-05-29 03:42:56', '2022-05-29 05:10:29'),
(24, 177, 16, '?????', '?????', 1, 1, '2022-05-29 05:13:55', '2022-05-29 05:17:44'),
(25, 177, 16, '?????', '?????', 1, 1, '2022-05-29 05:14:06', '2022-05-29 05:18:00'),
(26, 177, 16, 'sssss', NULL, 1, 0, '2023-05-02 05:50:52', '2023-05-02 05:50:52'),
(28, 177, 16, 'test1 AR', NULL, 1, 1, '2023-05-02 05:51:55', '2023-05-02 05:52:06'),
(29, 178, 20, 'demo subcategory', NULL, 1, 0, '2023-05-02 06:07:27', '2023-05-02 06:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `push_subscriptions`
--

CREATE TABLE `push_subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscribable_id` int(11) DEFAULT NULL,
  `subscribable_type` varchar(255) DEFAULT NULL,
  `endpoint` varchar(500) NOT NULL,
  `public_key` varchar(255) DEFAULT NULL,
  `auth_token` varchar(255) DEFAULT NULL,
  `content_encoding` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `push_subscriptions`
--

INSERT INTO `push_subscriptions` (`id`, `subscribable_id`, `subscribable_type`, `endpoint`, `public_key`, `auth_token`, `content_encoding`, `created_at`, `updated_at`) VALUES
(3, 4, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/dt--VeNXQpk:APA91bEXROqytusuQiBN-WidokRxoe_IH7kR6Qi6zXD1Ajx-XyQ4EtEoJxg62WwI-j0RFq2xUjBe-Is7h17zlUMntaf4mgCUeDFtLiW98h8xoOfL3ynutkpMHmyqoldRHVZDZGOQY98X', 'BEXtiHSUjJseqePlRDOqeeCDVSFvZdAyI8BupOIw0bIztqWL3W_pduNUd91A-3RzEHIYfmSfKjusX8B0JG1gOdk', 'GsDOuT4NTf6KGQt9RRVq0Q', NULL, '2020-12-26 10:04:17', '2020-12-26 10:04:17'),
(4, 5, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/fetLuDtmxNg:APA91bHqqBZBZzCuFd8Ae3hGHo5q972ktIjfZuRzek59nJXiwdn88UBtnuU9IwaxVznCJGxn1SdhlOFZ8sIsGyVBoK-GIm6KCk0iTuvwc1e3o0H4hfunWZe-o98HQpIXpYDAkan0DiAy', 'BBBfXhMcnTWXOPHP4l2UObEUf7RGMkxoOK5_G4nGhLC8kkXcBdMWNcuhxk0BsSIEdw0jWcZTQ_i_569oZDqEnc0', 'k-yJKI5UjvvHbYQACv-Nrw', NULL, '2021-03-24 07:37:03', '2021-03-24 07:37:03'),
(5, 6, 'App\\Models\\Guest', 'https://updates.push.services.mozilla.com/wpush/v2/gAAAAABgXhAyYoUVkJ8ymIaucMN78o9LdNIJ2ZhWATCMTUa79O7Q_6IWuwZlWOkNi33elgKb73GjntPc0ErLR7FF9b0UU0BNiDpJdsEv0uqcGKdNWkiYlAdlmNPaR0rKI8VivAkeCPzjYhykXGdYpXVpR3TxceTSpWBzxivvTpCTLQlUq72QNO8', 'BP6E_WEMY_Gq-nWKfidLIo4fI4kDlWB3XgnAPevTYRa8niS4TB0_OknMpwML1r_i-dWxE69eDU6e_TnUgufsd5E', 'yzcj6vcUg0WgFcQH6kC7kA', NULL, '2021-03-26 11:47:44', '2021-03-26 11:47:44'),
(6, 7, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/cmWvhqu3tv8:APA91bFobMGJpxJvuqHpFU7Y5vtVZNcvsykv_So9xDDoCqKLewXINW8QbmIkpha9i7CJZPAoaZjST1cJPnwwa0rbp-VCk8LOWRoxcuIyyUlsOIFCMCOwysBSFZm_1eBbVV9aeyLSENGc', 'BHKiK1CUzfBe51go0MhzpcrTdsa0qaLhyS4v-S-3U7p7piNG31Lv_awN0wHHqn4tK3KMACk1xiBS8d9vB1cgLKI', 'fgFmWWEiO9fQ1m-IDBOW3w', NULL, '2021-04-03 00:02:31', '2021-04-03 00:02:31'),
(7, 8, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/eh4uTNYjL8g:APA91bEX1UoNIWd9wkORCAREAofoRcvvbmRdDNMQwd1d-EZ0lbfCU5CUXewaZucNBK81XO0z6h0LnUaBFPHRlEDrUGm90vu_GHDd5lrndy3l6Otqf5i921YWUa-Xwn4i0MSW5uoPAeMQ', 'BMH-f875_KRifObIrwG57s-C4FT-X6NaQ0s8rTDEOK5kxlS_eCYT77cJjM2UsxuR3xAT49H_2ErlUPE1YnRtBUQ', 'x5mQe5dLhNw2H_x6j4jaOA', NULL, '2021-04-16 11:36:28', '2021-04-16 11:36:28'),
(8, 9, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/dObB80OmAaw:APA91bFv7cirSdv3z2G0IU7AlDsIylsVt5C2Z3q53ZUNLMlvlOIfQiOshMF-xKknu8706NDLq9PJyhl7eCdOZlzw-pxRrgsW-p2PjU9N1bePkHnYSIPnTp5a4g1N1tDQQQQWNDjy9slX', 'BD6AiJcjC3gwlLEYPJ2WBaozmaxp9-Q2XBtJOa9NvggCIhT2jN-cjkpGJS2uFMudkJJsvaxfQXpuhKjfYYrba3g', 'YywnXPOaIAiGmM_zru-29Q', NULL, '2021-05-06 09:40:57', '2021-05-06 09:40:57'),
(9, 10, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/eZKf01giLZc:APA91bH4tmbQ3s4Lv-B9nztPSZW3yd7Y2uXC-60sHsGIhKkOlUxP6oC68n37Vtq-FBk-OlTVlU76weuJ_vrW0BliQoqvrNRb8xstdCONgBIs47-5fgbphTiuONZgUp1nDtX8LfcFM-Iy', 'BB27dE5e2Bm7GTRujTwXihSJFtX1rwSXl1BUgLLWwI3jFdV5m-gvmSmbsVURyhtmbFmJrdUOAB4T8aVXJrUQsVo', 'gl9nLuDpTn82DcL_hIjndw', NULL, '2021-05-23 00:31:34', '2021-05-23 00:31:34'),
(10, 11, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/cPVrToqh8P0:APA91bEiMbgqN8bDAhr0mbdzXPcFOvc77t1WzG17LnxbEo7shs1OJ-UhjuXbKMj71Nx0_EjBlZNmj4Nl44WiksfgkV3COShKvj02S_ZpkTe5fD6WFwtIlPZ6LO-IrH57t-lVOinUQkHw', 'BFkWNoEXEsV0OhL7ry_yJngdJ9nSAuXv89yIgABu39xh53VUfgZqpaMNiz5w_yLqFcZ935BVRJ1h0tEm3QmqjaY', 'ozwxzjykXazMuvf1RxBK3w', NULL, '2022-03-08 11:07:58', '2022-03-08 11:07:58'),
(11, 12, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/eSdjeQS-6ec:APA91bFUxeQX0vknYUYO5cF4Bau2chgFvbcNkVDiWxQzJFCC-koRWSuqHWlB-CNygN8YDUgGxCLD5EVEx8MpSGHTxkTpypT7lCxo9MiYVJdRjmLkxlLilJmyI2277FKumLhLbQM55CmZ', 'BCe9VF_iGITjvarsEaQ0f22fLX8lLZbXeQPscs4JQyT2iW_w6NallOMSkeiSk9tnEJc2Grzt4dvbOis9YS2GyFk', 'fVnvCzgIc24uKKVwF6b0rA', NULL, '2022-03-25 09:37:15', '2022-03-25 09:37:15'),
(12, 13, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/fVC8cace-fw:APA91bEWCMtj2rRSwKQ1q6JQKrdw5X4JAk8FKP6kbWS9Zr7koUH_yRlG7mVwaycVt20EO7UYs0xe3DP26Xba3xGo4tPhS3Rjapa3i-2MNewsDloDPsDppAFkm-X4FKqpWqS_Vk6L9XMS', 'BLW-a2b-CPlH0E43datHyflA6OxN0IIpVKNh3_ITsz3H5XKsD_0GrS_JEW_CxnLnrFqO7SMjSAA7niVvvKzPwEw', 'IHXSSIH3ujQohnNsTkeqvw', NULL, '2022-03-25 15:10:08', '2022-03-25 15:10:08'),
(13, 14, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/eAFjl2NwK-s:APA91bEp8b2PiBhmwX_zmnbBUTHukeW5vNABILeBOl5rsDHvN95kgd_3ywilHH9NfNnYpm7a7aJgNPXUc0gJ_7uaFuYjitNc-QRbXz7ys5ZGdtfSKOnGpiuyegInmd4Gzk2SpknKc4wc', 'BE0Jighn2izrgHO7NzhtdaOCAw9GMFmTGmRkx84bmXevQvLyG-60cF1XPDIVRhjI2AmaU5UkXQ21Tzey3isS_1E', 'U_cZTnEOkcCl-JNn74xpGg', NULL, '2022-03-26 05:55:51', '2022-03-26 05:55:51'),
(14, 15, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/cYxO9t_xdXE:APA91bGQ1gBBBwp_ci8cdd_QyMhpiNn_YQHz5T7jYq_Rpy361fJn38T1n4_JepcLWvTVcWKS0_rKSxDZwj98j4tcKJ4WDTYftcpmHSOwzZ_wHMo-DbmOg7OCmo1H5bmM_qzs1JwSsKq3', 'BP7hrBFjwTu4WgVg2cRCQsTQqZWQVsNqqyaC1BOtpJreNbAHYy3_gY_UDojsdWqwiOnFEoNOoTcmTn13PxvR2cw', 'QumnEVX8v9ijINcYNHcXkg', NULL, '2022-03-26 06:11:44', '2022-03-26 06:11:44'),
(15, 16, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/fL9PPVT6jlM:APA91bF1dsI1uMzo_fGgOiP-6G_LSRBmOpdao8C9sSPUtd4Pu9bvcJbOcFmiCbEKxdD2TGk6elsRlMa44pw4m73kcZy1Z6dWdk4uFxoqwF542pO4ZgneVD6DT1-2cCiMcadxvdHmQAQv', 'BAS6X7QsadHhhmu6d9Vw3EaCWJj2b2Wy9YITG0MFStEV4Gb8VDZFhiIm1qIE9Ni-OP3krftkgYTE6M4Bg4WOReQ', 'CxwoglDSONZr0rYK-AR4LA', NULL, '2022-03-26 06:11:59', '2022-03-26 06:11:59'),
(16, 17, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/dvFmtOYkKOE:APA91bHpWKVtET2wBSGnEvLtLXpy5S150lRksdlSMTIDfiUNahnnOsJErkgga8EjvraIjSHkSe_epQEiN7naxS7w8vz9PmnOURQi4Bu4dBQj--WhHTyH50BPXBF_ZIVKcaOIlo3KVadt', 'BI33xxQv8EJZFF80Hyx-P4e8D8M5iMhPi6olDtwM_yQ2TXLuUMgoC2EK8fYfEsR2c32z0C2PssTuk14tEHAYHHY', 'bIvD5b7qsbv6mqcftsSyWQ', NULL, '2022-03-26 06:33:01', '2022-03-26 06:33:01'),
(17, 18, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/fVc8RLnHZ6M:APA91bG2us8fW833NzlJ1ilqh8kkVoNrbKck6JZezNXegKjw8NwAm8vDovgpLndAmHNJA6gRfznPD_Rc8vwJ7XXOE3pE0KBokTaozkMq5M4UbPp8MReZ3ho6_iyqx9FrnXjnpxR9wxpa', 'BI4KhyzTEY70WmY4jZchN0M4klUqNIsbGos7lIk6SMhkweV5P5qtWdw2z5GXVFZn3vgkPbl-ozGZ6zgJBQIP_kA', 'mZDMBSqnZpW-X6OEWsdt1Q', NULL, '2022-03-28 13:24:40', '2022-03-28 13:24:40'),
(18, 19, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/fgbnPkwsCU8:APA91bGJfLBxkTgEtJePLRIsyfSu2BIPQ22BYwHpAhVrA4whhAdsiHpOSOVr4Vcmp_pTLgRfP2PisJm_fG7so9YU0lNjbXEYHQJ24RkHcDf2eI3mP_5_BM9ALtjdM78nUxodMPYY4k5x', 'BMSdDc5maYAbAa8F3L-Vd1USadABzEWcUztaWRxgBk1Mz4ClvTrg8mQzXV_q7NUkYoCbC3vZ8CjfblbJlaVYDQg', 'JYpTiwRkwmPWtu0t5BEvng', NULL, '2022-03-29 07:23:02', '2022-03-29 07:23:02'),
(19, 20, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/ePVbno9kWtA:APA91bHQi13UwmBnf_z9erJ2VBB78MK_hfeRvQ2tDeLiDgHC4Sl71dDktuhYtjOEamBq_w75T9_Nu0tJqw3YPRPqKW09ObMCn9LiA6pbQKWNYnJujatjDFL0VzZAhB_RLPo8KAdadkqz', 'BJYVyojs6MHZ322rE7rCQmoqeF9BHfOmbPG2c_U7Pv9BVTAiZM1IoUGw9gixoZuCaMHmuCO_GyrYsVDOHZ5bq1M', 'EbkcDvNrbLb31wyxyMgxyg', NULL, '2022-03-29 07:26:21', '2022-03-29 07:26:21'),
(20, 21, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/dgvxW5cNw5g:APA91bH8Au63veVx1bkKpGB0g_MxoQICgJ3bWaP-QtyowdorZUGcayo5xASkTEFjJri6IjOyvRP7WKCv4jbr4RxT4PD_zr-3AwHlpG00d8rDd-bTvzyvTK2Aj0r59zpKtNSEw8a99VlZ', 'BMz4LqfWJZcdcEPgXJccF1ao7kxQ5176SUTI_nE6_2kcDGX2bHYeb1Q__2I8Vx0poSOvFSJhZckR28N5oc_XRII', 'FKpeggtAtAG-Fr2HYW1UDQ', NULL, '2022-03-29 09:33:41', '2022-03-29 09:33:41'),
(21, 22, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/dH8KnORYEVQ:APA91bEJFuFWl1iloiH44Fuot4Gnoh5p0aUxs_mtrPVsm7O3Dkjd8vELa2DeW9ETdHFcSBkyZt8g0dERLI7jZU3sz5Kv0UP8S2UuDgkRGHC3hRIDp9PdYR8srv-7y_EitmUEY8kBhE9M', 'BGYGP4RPbx_ItA6mesKRIpYMuilij5XV7aKNj4u0VhWX2L5eL1PgV4qlS6Rp8ruvy04J0JA5nV8GfatnmkyxpEg', 'J13QxHa4fFtWFbcofgxp0Q', NULL, '2022-03-29 09:49:54', '2022-03-29 09:49:54'),
(22, 23, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/eV2Fy6cICFg:APA91bH64deQsEs8og6oMqWSN0IV80-6IJtBR0MmRHwpm6vNvyY1Q-mVU8IK9x_BvxPuTNje_k1Ur6G1WhNqi_kmlCXQZoikKjkeOuLzQ0JjcoT5enML53YCw__PX9i_yathf5ajux8x', 'BJSRrN5bqx-Q0ZJAmPkZD6HraYwjGKo-Ls79nO-wTkiiJK4B87ocIw1xSGy4NplL7DPrviGevUPinoW95rH9FGo', 'wo-kNkXLQpNqbqUdvvxlRw', NULL, '2022-03-29 11:31:26', '2022-03-29 11:31:26'),
(23, 24, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/fjhrX4tX4Cc:APA91bGSxATfx2askizSwnj_XEEe1dirC38jMXFsCL-Nip69CVioMNbApRMS8_A3RzlWDBXI1sUm2DdSq0-OnXsqO1fror-THjD3R107bF_OBsJWSy4YfrBCdlqD_KZVP_MO3FJbIyIO', 'BCv7R4fibTLn5GeBd9ItJtSk3pAXtoy0_vGdDcYqD1OAVqP-we7doNBGyb5kwmoFWuNrYcqcDK4j9nmqtat2jS8', 'F4Bh1BXCJ4ElCNUYhlYEpw', NULL, '2022-04-04 14:22:56', '2022-04-04 14:22:56'),
(24, 25, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/dMfJBWeK59g:APA91bHVx8OoUaqqaZROwpYLGi0oL_hpP27-BHhKWcsb_Cf3JhO_0nfblhoeyZWsntig9h4yIv20-lwaiIUVaKQcZ_GtyC1P4DWizrLSkGtYLUtO1Erv9Q5SN1gPfGFy9BN9-J9M17Qi', 'BFnEhSqjkzRKNzObnvrebeVoy_RhIVnpxhKQ3H5ACaXK5gfbdkwxXhgLQtwTGypp6_stQ7xdXd5LlIQpv44YBZs', '8WigyorhUXnwfrUXwAi26A', NULL, '2022-04-06 14:45:27', '2022-04-06 14:45:27'),
(25, 26, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/eFLG-3oEzKI:APA91bF934GtVfeJ3I-0pekZ3k2uYGQyExkei8SLug9CuMb0uXNj8p0kkc_kGPuzAbW0oVt3hlOWdNKmChP2aAWkPRwfGtkxgnDodUhkEZamoo92yi50N6Q65AOOGJVrydcjfVmWFoWF', 'BNhbs0yBnUjiWbiLhQsXjR4QKSL4XgnPG90SUs5gtkHD4FrOwn1V62gOUBO1bjIGj5oqR8j-3zKjGHLaPCEZuCI', 'NoxAW9LgVmrUxNOcIePDww', NULL, '2022-05-25 12:10:23', '2022-05-25 12:10:23'),
(26, 27, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/ddjYk0PfZN4:APA91bHrypeB-IsqioQhnJ5YUV1nZxv-bIK5tKRJppgC4q2mcmEib9ng0gFFlm3_xs8jiHbzQ_KnQPxthBm3qaMnEyRFuv2r-jjs_xE5ie6kVK1zCKjNL1wE0nDC8Ftu-vlA0qtCDYs7', 'BMbq5BZB64P6zkalym9HtYBaHk_D2-HfF4cewQKD54CdVfmu-axKqPuBt1S6z2zKMOyxoTgamAJj_r68zAXkarY', '0L3fcWHSQ0EUNTPJ1U5o8w', NULL, '2023-04-10 05:35:33', '2023-04-10 05:35:33'),
(27, 28, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/c6z1jcd4ug8:APA91bHU62xxRJMvKKsE2hAVbIP5aHsYN5kNXcyMJ1MJ7LU16BG1IJiHmangsq9yWPlFoIpPhKB_uIzldr7lr4jh01AqC5NS4tZVHYBZn_zrkZuWh1uOWPxtQQGudUwEc5XGFv_M1THK', 'BP8wsKuMUhGdPmNWoyMJVFcEEISFpqpb6q4GWjh_nXdqVrLhLMyjCYehZOa4zYwTPakUoFR9peaS2jt10fxQUHk', '_-t7eG5DZKzXwEcwoaA2xQ', NULL, '2023-04-10 07:46:43', '2023-04-10 07:46:43'),
(28, 29, 'App\\Models\\Guest', 'https://fcm.googleapis.com/fcm/send/eZJp6IVs6lo:APA91bHggwA-gOtuZj-610cq9vO2dR3OuTKsklGG4bHXztdyX4tIQsDX--944xanSG3DWa2wkq6EflFM0i-r-OXQCsFa2nGloFQCyDvOwTWPGaXSbD3LCXAzvqJ-K2SFOvvsMSFq8h-7', 'BEbOX-LoYumTFSCNdDrIUg90a9SYUcom7clsKBbU00kKGtDfoLUoevn9GgLLuvsdYPkuAgoGkvAWhhJNhB8aK0o', 'AcUgE_pVVYgUXK8M0Uc2gw', NULL, '2023-05-30 10:54:57', '2023-05-30 10:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_inputs`
--

CREATE TABLE `reservation_inputs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT 0,
  `type` tinyint(4) DEFAULT NULL COMMENT '1-text, 2-select, 3-checkbox, 4-textarea, 5-datepicker, 6-timepicker',
  `label` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `placeholder` varchar(255) DEFAULT NULL,
  `required` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 - required, 0 - optional',
  `order_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation_inputs`
--

INSERT INTO `reservation_inputs` (`id`, `language_id`, `type`, `label`, `name`, `placeholder`, `required`, `order_number`, `created_at`, `updated_at`) VALUES
(30, 176, 1, 'Phone', 'Phone', 'Enter Phone Number', 1, 2, '2021-05-17 05:34:42', '2023-04-01 08:24:17'),
(31, 176, 1, 'Number of Persons', 'Number_of_Persons', 'Enter Number of Persons', 1, 1, '2021-05-17 05:34:53', '2023-04-01 08:24:17'),
(36, 176, 5, 'Check-in Date', 'Check-in_Date', 'Enter Check-in Date', 1, 3, '2021-05-17 05:58:05', '2021-05-17 05:58:05'),
(37, 176, 6, 'Check-in Time', 'Check-in_Time', 'Enter Check-in Time', 1, 4, '2021-05-17 05:58:16', '2021-05-17 05:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_input_options`
--

CREATE TABLE `reservation_input_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_input_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `permissions` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(7, 'Delivery Manager', '[\"Dashboard\",\"Order Management\"]', '2020-09-24 00:13:52', '2021-05-21 05:28:11'),
(8, 'Kitchen Manager', '[\"Dashboard\",\"Table Reservation\",\"Product Management\",\"Order Management\"]', '2020-09-28 11:23:56', '2020-12-31 05:45:18'),
(9, 'Shop Manager', '[\"Dashboard\",\"POS\"]', '2023-03-04 03:48:36', '2023-03-04 03:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `serving_methods`
--

CREATE TABLE `serving_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `gateways` text DEFAULT NULL,
  `serial_number` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `website_menu` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 - deactive on website menu, 1 - active on website menu',
  `qr_menu` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 - deactive on qr menu, 1 - active on qr menu',
  `qr_payment` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - deactive, 1 - active',
  `pos` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - active for POS, 0 - deactive for POS'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `serving_methods`
--

INSERT INTO `serving_methods` (`id`, `name`, `value`, `gateways`, `serial_number`, `note`, `website_menu`, `qr_menu`, `qr_payment`, `pos`) VALUES
(1, 'On Table', 'on_table', '[\"1\",\"2\",\"3\"]', 1, 'Choose this method, if you are in restaurant', 1, 1, 1, 1),
(2, 'Pick Up', 'pick_up', '[\"1\",\"2\",\"3\"]', 2, 'Choose this, if you want to pick up the food from Restaurant', 1, 1, 1, 1),
(3, 'Home Delivery', 'home_delivery', '[\"1\",\"2\",\"3\"]', 3, 'Choose this, if you want the order to be served at your doorstep.', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `charge` decimal(11,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `free_delivery_amount` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `title`, `language_id`, `text`, `charge`, `created_at`, `updated_at`, `free_delivery_amount`) VALUES
(7, 'Within 2 days', 176, 'Come & take a seat in Superv Restaurant', 1.00, '2020-08-30 07:51:46', '2022-03-17 14:13:10', 45.00),
(8, 'Within 4 days', 176, 'Come & grab your orders from Superv Restaurant', 2.00, '2020-08-30 07:52:30', '2020-12-13 07:16:23', NULL),
(9, 'Urgent Delivery', 176, 'Order & your order will be arrived to your doorstep', 5.00, '2020-08-30 07:53:51', '2020-12-13 07:15:53', NULL),
(13, 'Inside Dhaka', 176, 'custom', 1.25, '2022-03-17 13:47:40', '2022-03-17 14:07:46', 40.00);

-- --------------------------------------------------------

--
-- Table structure for table `sitemaps`
--

CREATE TABLE `sitemaps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sitemap_url` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sitemaps`
--

INSERT INTO `sitemaps` (`id`, `sitemap_url`, `filename`, `created_at`, `updated_at`) VALUES
(2, 'http://localhost/superv/without_license/superv-1.2/', 'sitemap5f5e377957033.xml', '2020-09-13 09:15:26', '2020-09-13 09:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `button_text1` varchar(191) DEFAULT NULL,
  `button_url1` varchar(191) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `bg_image` varchar(191) DEFAULT NULL,
  `serial_number` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title_color` varchar(255) DEFAULT NULL,
  `text_color` varchar(255) DEFAULT NULL,
  `button_color` varchar(255) DEFAULT NULL,
  `title_font_size` int(11) NOT NULL DEFAULT 60,
  `text_font_size` int(11) NOT NULL DEFAULT 18,
  `button_text_font_size` int(11) NOT NULL DEFAULT 14,
  `button_text1_font_size` int(11) NOT NULL DEFAULT 14
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `language_id`, `text`, `title`, `button_text`, `button_url`, `button_text1`, `button_url1`, `image`, `bg_image`, `serial_number`, `created_at`, `updated_at`, `title_color`, `text_color`, `button_color`, `title_font_size`, `text_font_size`, `button_text_font_size`, `button_text1_font_size`) VALUES
(24, 176, 'Nunc molestie mi nunc, nec accumsan libero dignissim sit amet. Fusce sit amet tincidunt metus. Nunc eu risus sus-cipit massa dapibu.', 'Mexican Grilled Chicken Sub Sandwich...', 'Add to Cart', 'https://gizmoder.com/demo/html/omnivus/omnivus/index.html', 'Book a Table', 'https://gizmoder.com/demo/html/omnivus/omnivus/index.html', '1598069700.png', '1609328203.jpg', 3, '2020-08-17 03:49:17', '2020-12-30 11:36:43', 'FFFFFF', 'FFFFFF', 'FFFFFF', 60, 18, 14, 14),
(28, 176, 'Nunc molestie mi nunc, nec accumsan libero dignissim sit amet. Fusce sit amet tincidunt metus. Nunc eu risus sus-cipit massa dapibu.', 'Burger King Grilled Chicken Burger...', 'Add to Cart', 'https://megasoft.biz/plusagency/about-us/page', 'Book a Table', 'https://megasoft.biz/plusagency/about-us/page', '1598069651.png', '1609328189.jpg', 2, '2020-08-20 23:41:41', '2020-12-30 11:36:29', 'FFFFFF', 'FFFFFF', 'FFFFFF', 60, 18, 14, 14),
(29, 176, 'Nunc molestie mi nunc, nec accumsan libero dignissim sit amet. Fusce sit amet tincidunt metus. Nunc eu risus sus-cipit massa dapibu.', 'Mexican Chicken Cheese Toaster Pizza', 'Add to Cart', 'https://megasoft.biz/plusagency/about-us/page', 'Book a Table', 'https://megasoft.biz/plusagency/about-us/page', '1598680778.png', '1609328176.jpg', 1, '2020-08-20 23:41:41', '2020-12-30 11:36:16', 'FFFFFF', 'FFFFFF', 'FFFFFF', 60, 18, 14, 14);

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `serial_number` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `icon`, `url`, `serial_number`) VALUES
(1, 'fab fa-facebook-f', 'https://www.facebook.com/', 1),
(2, 'fab fa-twitter', 'https://twitter.com/', 2),
(3, 'fab fa-linkedin-in', 'https://bd.linkedin.com/', 3),
(4, 'fab fa-instagram', 'https://www.instagram.com/', 4);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'user1@gmail.com', NULL, NULL),
(2, 'user5@gmail.com', NULL, NULL),
(8, 'ben@gmail.com', NULL, NULL),
(9, 'drop_your_cv@plusagency.com', NULL, NULL),
(10, 'user34@gmail.com', NULL, NULL),
(12, 'client@gmail.com', NULL, NULL),
(14, 'user@gmail.com', NULL, NULL),
(15, 'saifislamfci@gmail.com', NULL, NULL),
(16, 'dfd@gmail.com', NULL, NULL),
(17, 'saifislamdf@gmail.com', NULL, NULL),
(18, 'tyuyu@gmail.com', NULL, NULL),
(19, 'dkdj@gmail.com', NULL, NULL),
(20, 'geniusteddst11@gmail.com', NULL, NULL),
(21, 'saifislauuumfci@gmail.com', NULL, NULL),
(22, 'gffff@gmail.com', NULL, NULL),
(23, 'dd@gmil.com', NULL, NULL),
(24, '1212@gmail.com', NULL, NULL),
(25, 'saifkkkk@gmail.com', NULL, NULL),
(26, '2222@gmail.com', NULL, NULL),
(27, 'dfs@gmail.com', NULL, NULL),
(28, 'ssd@gmail.com', NULL, NULL),
(29, 'ss@gmail.com', NULL, NULL),
(30, 'kjklfdlf@gmail.com', NULL, NULL),
(31, 'saifss@gmail.com', NULL, NULL),
(32, 'sdfsss@gmail.com', NULL, NULL),
(33, 'kjdk@gmail.com', NULL, NULL),
(34, 'dd@gmail.com', NULL, NULL),
(35, 'aa@gmail.com', NULL, NULL),
(36, 'sss@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_no` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - active, 2 - deactive',
  `qr_image` varchar(100) DEFAULT NULL,
  `color` varchar(50) NOT NULL DEFAULT '000000',
  `size` int(11) NOT NULL DEFAULT 250,
  `style` varchar(50) NOT NULL DEFAULT 'square',
  `eye_style` varchar(50) NOT NULL DEFAULT 'square',
  `margin` int(11) NOT NULL DEFAULT 0,
  `text` varchar(255) DEFAULT NULL,
  `text_color` varchar(50) DEFAULT '000000',
  `text_size` int(11) DEFAULT 15,
  `text_x` int(11) NOT NULL DEFAULT 50,
  `text_y` int(11) NOT NULL DEFAULT 50,
  `image` varchar(50) DEFAULT NULL,
  `image_size` int(11) NOT NULL DEFAULT 20,
  `image_x` int(11) NOT NULL DEFAULT 50,
  `image_y` int(11) NOT NULL DEFAULT 50,
  `type` varchar(50) NOT NULL DEFAULT 'default' COMMENT 'default, image, text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `table_no`, `status`, `qr_image`, `color`, `size`, `style`, `eye_style`, `margin`, `text`, `text_color`, `text_size`, `text_x`, `text_y`, `image`, `image_size`, `image_x`, `image_y`, `type`) VALUES
(7, 1, 1, '60a926ef3406d.png', '520606', 272, 'square', 'circle', 0, NULL, NULL, NULL, 50, 50, '60a926ea0a451.png', 20, 50, 50, 'text'),
(8, 2, 1, '60a92703adfed.png', '000000', 250, 'square', 'square', 0, NULL, '000000', 15, 50, 50, NULL, 20, 50, 50, 'text'),
(10, 3, 1, '60a9262e62d6b.png', '000000', 250, 'square', 'square', 0, NULL, '000000', 15, 50, 50, NULL, 20, 50, 50, 'default'),
(11, 4, 1, '60a9263865d0b.png', '000000', 250, 'square', 'square', 0, NULL, '000000', 15, 50, 50, NULL, 20, 50, 50, 'default'),
(12, 5, 1, '60a9263ea193e.png', '000000', 250, 'square', 'square', 0, NULL, '000000', 15, 50, 50, NULL, 20, 50, 50, 'default'),
(13, 6, 1, '60a9264514cdb.png', '000000', 250, 'square', 'square', 0, NULL, '000000', 15, 50, 50, NULL, 20, 50, 50, 'default'),
(14, 7, 1, '60a9264bc926e.png', '000000', 250, 'square', 'square', 0, NULL, '000000', 15, 50, 50, NULL, 20, 50, 50, 'default'),
(15, 8, 1, '60a92651a1323.png', '000000', 250, 'square', 'square', 0, NULL, '000000', 15, 50, 50, NULL, 20, 50, 50, 'default'),
(16, 9, 1, '60a92658b0ffd.png', '000000', 250, 'square', 'square', 0, NULL, '000000', 15, 50, 50, NULL, 20, 50, 50, 'default'),
(17, 10, 1, '60a9265ec7cd9.png', '000000', 250, 'square', 'square', 0, NULL, '000000', 15, 50, 50, NULL, 20, 50, 50, 'default'),
(18, 11, 1, '60a9266999054.png', '000000', 250, 'square', 'square', 0, NULL, '000000', 15, 50, 50, NULL, 20, 50, 50, 'default'),
(19, 12, 1, '60a92674c0125.png', '000000', 250, 'square', 'square', 0, NULL, '000000', 15, 50, 50, NULL, 20, 50, 50, 'default'),
(20, 13, 1, NULL, '000000', 250, 'square', 'square', 0, NULL, '000000', 15, 50, 50, NULL, 20, 50, 50, 'default');

-- --------------------------------------------------------

--
-- Table structure for table `table_books`
--

CREATE TABLE `table_books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fields` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_books`
--

INSERT INTO `table_books` (`id`, `name`, `email`, `fields`, `status`, `created_at`, `updated_at`) VALUES
(17, 'Johnson', 'johnson@gmail.com', '{\"Phone\":\"12536236\",\"Time\":\"01:00 AM\",\"Date\":\"09/17/2020\",\"Person\":\"5\"}', 1, '2020-09-28 04:26:07', '2020-09-28 04:26:07'),
(18, 'Shop Manager', 'geniustest11@gmail.com', '{\"Phone\":\"0000\",\"Number_of_Persons\":\"dd\",\"Check-in_Date\":\"04/28/2023\",\"Check-in_Time\":\"12:30 AM\"}', 2, '2023-04-01 07:16:37', '2023-04-01 09:54:57'),
(19, 'saif', 'saifislamfci@gmail.com', '{\"Phone\":\"+1 (325) 953-9791\",\"Number_of_Persons\":\"367\",\"Check-in_Date\":\"04/28/2023\",\"Check-in_Time\":\"12:30 AM\"}', 1, '2023-04-01 07:23:08', '2023-04-01 07:23:08'),
(20, 'Colleen Quinn', 'xozuvasyb@mailinator.com', '{\"Phone\":\"+1 (661) 231-4055\",\"Number_of_Persons\":\"745\",\"Check-in_Date\":\"09-Jan-2019\",\"Check-in_Time\":\"Natus cumque vitae c\"}', 1, '2023-04-01 08:39:42', '2023-04-01 08:39:42'),
(21, 'Forrest Schneider', 'luzes@mailinator.com', '{\"Phone\":\"+1 (568) 155-7075\",\"Number_of_Persons\":\"843\",\"Check-in_Date\":\"26-Dec-2010\",\"Check-in_Time\":\"Nulla ea in in repel\"}', 1, '2023-04-01 08:39:57', '2023-04-01 08:39:57'),
(22, 'Margaret Mcintosh', 'xutipiket@mailinator.com', '{\"Phone\":\"+1 (293) 968-7159\",\"Number_of_Persons\":\"442\",\"Check-in_Date\":\"01-Jul-1998\",\"Check-in_Time\":\"Id enim labore a cil\"}', 1, '2023-04-01 08:40:06', '2023-04-01 08:40:06'),
(23, 'Sebastian Bates', 'rozuzyru@mailinator.com', '{\"Phone\":\"+1 (696) 469-4161\",\"Number_of_Persons\":\"273\",\"Check-in_Date\":\"14-Feb-1994\",\"Check-in_Time\":\"Quis mollitia blandi\"}', 1, '2023-04-01 08:41:58', '2023-04-01 08:41:58'),
(24, 'Shop Manager', 'saifislamfci@gmail.com', '{\"Phone\":\"+1 (325) 953-9791\",\"Number_of_Persons\":\"367\",\"Check-in_Date\":\"04/18/2023\",\"Check-in_Time\":\"12:00 AM\"}', 1, '2023-04-01 08:46:46', '2023-04-01 08:46:46'),
(25, 'Noelani Cash', 'vumetinuki@mailinator.com', '{\"Phone\":\"+1 (851) 394-4129\",\"Number_of_Persons\":\"778\",\"Check-in_Date\":\"05-Mar-1980\",\"Check-in_Time\":\"Fuga Aut saepe ipsu\"}', 1, '2023-04-01 08:47:23', '2023-04-01 08:47:23'),
(26, 'Jordan Knapp', 'tibala@mailinator.com', '{\"Phone\":\"+1 (741) 169-1304\",\"Number_of_Persons\":\"45\",\"Check-in_Date\":\"17-Dec-2009\",\"Check-in_Time\":\"Nemo quidem non ulla\"}', 1, '2023-04-01 08:47:49', '2023-04-01 08:47:49'),
(27, 'Velma Barron', 'xyxuseb@mailinator.com', '{\"Phone\":\"+1 (311) 658-7908\",\"Number_of_Persons\":\"894\",\"Check-in_Date\":\"23-Oct-2002\",\"Check-in_Time\":\"Qui praesentium cons\"}', 2, '2023-04-01 08:49:23', '2023-04-01 09:55:25'),
(28, 'Herrod Nash', 'mytevo@mailinator.com', '{\"Phone\":\"+1 (823) 799-6105\",\"Number_of_Persons\":\"852\",\"Check-in_Date\":\"22-Mar-2014\",\"Check-in_Time\":\"Quia culpa molestiae\"}', 2, '2023-04-01 08:49:29', '2023-04-01 09:55:14'),
(29, 'Nolan Lynch', 'kydod@mailinator.com', '{\"Phone\":\"+1 (557) 477-3754\",\"Number_of_Persons\":\"540\",\"Check-in_Date\":\"09-Nov-1984\",\"Check-in_Time\":\"Dolorum aut fugiat v\"}', 2, '2023-04-01 08:49:45', '2023-04-01 09:54:48'),
(30, 'Randall Hinton', 'tuwopimare@mailinator.com', '{\"Phone\":\"+1 (635) 895-6164\",\"Number_of_Persons\":\"593\",\"Check-in_Date\":\"28-Apr-2002\",\"Check-in_Time\":\"Quis in amet delect\"}', 1, '2023-04-02 05:31:31', '2023-04-02 05:31:31'),
(31, 'Yoshi Houston', 'majyzymo@mailinator.com', '{\"Phone\":\"+1 (385) 518-3457\",\"Number_of_Persons\":\"864\",\"Check-in_Date\":\"12-May-1984\",\"Check-in_Time\":\"Quae fuga Dolor ill\"}', 1, '2023-04-02 05:31:39', '2023-04-02 05:31:39'),
(32, 'khaled ahmed', 'khaledahmedhaggagy@gmail.com', '{\"Phone\":\"01204593124\",\"Number_of_Persons\":\"12\",\"Check-in_Date\":\"08/26/2025\",\"Check-in_Time\":\"01:30 AM\"}', 1, '2025-08-08 21:08:22', '2025-08-08 21:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `serial_number` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `language_id`, `image`, `comment`, `name`, `rank`, `rating`, `serial_number`, `created_at`, `updated_at`) VALUES
(24, 176, '1597736067.png', 'Le rapport qualité-prix est excellent, surtout pour la quantité généreuse servie. Les portions sont copieuses, et on sent vraiment que les produits utilisés sont de haute qualité. C’est l’endroit idéal pour un repas rapide mais savoureux, que ce soit seul ou entre amis.', 'Emma Watson', 'client', 5, 1, NULL, NULL),
(25, 176, '1597749691.png', 'Ce que j’adore chez King Kebab, c’est la cuisson parfaite de la viande, juteuse et tendre à la fois. Les épices sont bien dosées, ce qui offre un équilibre parfait entre goût relevé et saveur douce. Un vrai régal pour les papilles et un incontournable de la ville.', 'Amelia Hanna', 'client', 5, 4, NULL, NULL),
(28, 176, '1598692556.png', 'L’accueil chaleureux et le service impeccable font de chaque visite une expérience agréable. Le personnel est toujours à l’écoute et prêt à conseiller les clients, ce qui rend ce lieu unique et convivial. Sans oublier la qualité exceptionnelle des plats qui me donne envie d’y retourner souvent.', 'Marcos Reus', 'client', 5, 2, NULL, NULL),
(29, 176, '1598692612.png', 'Le King Kebab est un véritable joyau culinaire. Chaque bouchée est une explosion de saveurs grâce à des ingrédients frais et une préparation soignée qui respecte la tradition. Je recommande vivement ce restaurant à tous les amateurs de kebab authentique.', 'Rebeca Isabella', 'client', 5, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `country_code` char(3) NOT NULL,
  `timezone` varchar(125) NOT NULL DEFAULT '',
  `gmt_offset` float(10,2) DEFAULT NULL,
  `dst_offset` float(10,2) DEFAULT NULL,
  `raw_offset` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`country_code`, `timezone`, `gmt_offset`, `dst_offset`, `raw_offset`) VALUES
('AD', 'Europe/Andorra', 1.00, 2.00, 1.00),
('AE', 'Asia/Dubai', 4.00, 4.00, 4.00),
('AF', 'Asia/Kabul', 4.50, 4.50, 4.50),
('AG', 'America/Antigua', -4.00, -4.00, -4.00),
('AI', 'America/Anguilla', -4.00, -4.00, -4.00),
('AL', 'Europe/Tirane', 1.00, 2.00, 1.00),
('AM', 'Asia/Yerevan', 4.00, 4.00, 4.00),
('AO', 'Africa/Luanda', 1.00, 1.00, 1.00),
('AQ', 'Antarctica/Casey', 8.00, 8.00, 8.00),
('AQ', 'Antarctica/Davis', 7.00, 7.00, 7.00),
('AQ', 'Antarctica/DumontDUrville', 10.00, 10.00, 10.00),
('AQ', 'Antarctica/Mawson', 5.00, 5.00, 5.00),
('AQ', 'Antarctica/McMurdo', 13.00, 12.00, 12.00),
('AQ', 'Antarctica/Palmer', -3.00, -4.00, -4.00),
('AQ', 'Antarctica/Rothera', -3.00, -3.00, -3.00),
('AQ', 'Antarctica/South_Pole', 13.00, 12.00, 12.00),
('AQ', 'Antarctica/Syowa', 3.00, 3.00, 3.00),
('AQ', 'Antarctica/Vostok', 6.00, 6.00, 6.00),
('AR', 'America/Argentina/Buenos_Aires', -3.00, -3.00, -3.00),
('AR', 'America/Argentina/Catamarca', -3.00, -3.00, -3.00),
('AR', 'America/Argentina/Cordoba', -3.00, -3.00, -3.00),
('AR', 'America/Argentina/Jujuy', -3.00, -3.00, -3.00),
('AR', 'America/Argentina/La_Rioja', -3.00, -3.00, -3.00),
('AR', 'America/Argentina/Mendoza', -3.00, -3.00, -3.00),
('AR', 'America/Argentina/Rio_Gallegos', -3.00, -3.00, -3.00),
('AR', 'America/Argentina/Salta', -3.00, -3.00, -3.00),
('AR', 'America/Argentina/San_Juan', -3.00, -3.00, -3.00),
('AR', 'America/Argentina/San_Luis', -3.00, -3.00, -3.00),
('AR', 'America/Argentina/Tucuman', -3.00, -3.00, -3.00),
('AR', 'America/Argentina/Ushuaia', -3.00, -3.00, -3.00),
('AS', 'Pacific/Pago_Pago', -11.00, -11.00, -11.00),
('AT', 'Europe/Vienna', 1.00, 2.00, 1.00),
('AU', 'Antarctica/Macquarie', 11.00, 11.00, 11.00),
('AU', 'Australia/Adelaide', 10.50, 9.50, 9.50),
('AU', 'Australia/Brisbane', 10.00, 10.00, 10.00),
('AU', 'Australia/Broken_Hill', 10.50, 9.50, 9.50),
('AU', 'Australia/Currie', 11.00, 10.00, 10.00),
('AU', 'Australia/Darwin', 9.50, 9.50, 9.50),
('AU', 'Australia/Eucla', 8.75, 8.75, 8.75),
('AU', 'Australia/Hobart', 11.00, 10.00, 10.00),
('AU', 'Australia/Lindeman', 10.00, 10.00, 10.00),
('AU', 'Australia/Lord_Howe', 11.00, 10.50, 10.50),
('AU', 'Australia/Melbourne', 11.00, 10.00, 10.00),
('AU', 'Australia/Perth', 8.00, 8.00, 8.00),
('AU', 'Australia/Sydney', 11.00, 10.00, 10.00),
('AW', 'America/Aruba', -4.00, -4.00, -4.00),
('AX', 'Europe/Mariehamn', 2.00, 3.00, 2.00),
('AZ', 'Asia/Baku', 4.00, 5.00, 4.00),
('BA', 'Europe/Sarajevo', 1.00, 2.00, 1.00),
('BB', 'America/Barbados', -4.00, -4.00, -4.00),
('BD', 'Asia/Dhaka', 6.00, 6.00, 6.00),
('BE', 'Europe/Brussels', 1.00, 2.00, 1.00),
('BF', 'Africa/Ouagadougou', 0.00, 0.00, 0.00),
('BG', 'Europe/Sofia', 2.00, 3.00, 2.00),
('BH', 'Asia/Bahrain', 3.00, 3.00, 3.00),
('BI', 'Africa/Bujumbura', 2.00, 2.00, 2.00),
('BJ', 'Africa/Porto-Novo', 1.00, 1.00, 1.00),
('BL', 'America/St_Barthelemy', -4.00, -4.00, -4.00),
('BM', 'Atlantic/Bermuda', -4.00, -3.00, -4.00),
('BN', 'Asia/Brunei', 8.00, 8.00, 8.00),
('BO', 'America/La_Paz', -4.00, -4.00, -4.00),
('BQ', 'America/Kralendijk', -4.00, -4.00, -4.00),
('BR', 'America/Araguaina', -3.00, -3.00, -3.00),
('BR', 'America/Bahia', -3.00, -3.00, -3.00),
('BR', 'America/Belem', -3.00, -3.00, -3.00),
('BR', 'America/Boa_Vista', -4.00, -4.00, -4.00),
('BR', 'America/Campo_Grande', -3.00, -4.00, -4.00),
('BR', 'America/Cuiaba', -3.00, -4.00, -4.00),
('BR', 'America/Eirunepe', -5.00, -5.00, -5.00),
('BR', 'America/Fortaleza', -3.00, -3.00, -3.00),
('BR', 'America/Maceio', -3.00, -3.00, -3.00),
('BR', 'America/Manaus', -4.00, -4.00, -4.00),
('BR', 'America/Noronha', -2.00, -2.00, -2.00),
('BR', 'America/Porto_Velho', -4.00, -4.00, -4.00),
('BR', 'America/Recife', -3.00, -3.00, -3.00),
('BR', 'America/Rio_Branco', -5.00, -5.00, -5.00),
('BR', 'America/Santarem', -3.00, -3.00, -3.00),
('BR', 'America/Sao_Paulo', -2.00, -3.00, -3.00),
('BS', 'America/Nassau', -5.00, -4.00, -5.00),
('BT', 'Asia/Thimphu', 6.00, 6.00, 6.00),
('BW', 'Africa/Gaborone', 2.00, 2.00, 2.00),
('BY', 'Europe/Minsk', 3.00, 3.00, 3.00),
('BZ', 'America/Belize', -6.00, -6.00, -6.00),
('CA', 'America/Atikokan', -5.00, -5.00, -5.00),
('CA', 'America/Blanc-Sablon', -4.00, -4.00, -4.00),
('CA', 'America/Cambridge_Bay', -7.00, -6.00, -7.00),
('CA', 'America/Creston', -7.00, -7.00, -7.00),
('CA', 'America/Dawson', -8.00, -7.00, -8.00),
('CA', 'America/Dawson_Creek', -7.00, -7.00, -7.00),
('CA', 'America/Edmonton', -7.00, -6.00, -7.00),
('CA', 'America/Glace_Bay', -4.00, -3.00, -4.00),
('CA', 'America/Goose_Bay', -4.00, -3.00, -4.00),
('CA', 'America/Halifax', -4.00, -3.00, -4.00),
('CA', 'America/Inuvik', -7.00, -6.00, -7.00),
('CA', 'America/Iqaluit', -5.00, -4.00, -5.00),
('CA', 'America/Moncton', -4.00, -3.00, -4.00),
('CA', 'America/Montreal', -5.00, -4.00, -5.00),
('CA', 'America/Nipigon', -5.00, -4.00, -5.00),
('CA', 'America/Pangnirtung', -5.00, -4.00, -5.00),
('CA', 'America/Rainy_River', -6.00, -5.00, -6.00),
('CA', 'America/Rankin_Inlet', -6.00, -5.00, -6.00),
('CA', 'America/Regina', -6.00, -6.00, -6.00),
('CA', 'America/Resolute', -6.00, -5.00, -6.00),
('CA', 'America/St_Johns', -3.50, -2.50, -3.50),
('CA', 'America/Swift_Current', -6.00, -6.00, -6.00),
('CA', 'America/Thunder_Bay', -5.00, -4.00, -5.00),
('CA', 'America/Toronto', -5.00, -4.00, -5.00),
('CA', 'America/Vancouver', -8.00, -7.00, -8.00),
('CA', 'America/Whitehorse', -8.00, -7.00, -8.00),
('CA', 'America/Winnipeg', -6.00, -5.00, -6.00),
('CA', 'America/Yellowknife', -7.00, -6.00, -7.00),
('CC', 'Indian/Cocos', 6.50, 6.50, 6.50),
('CD', 'Africa/Kinshasa', 1.00, 1.00, 1.00),
('CD', 'Africa/Lubumbashi', 2.00, 2.00, 2.00),
('CF', 'Africa/Bangui', 1.00, 1.00, 1.00),
('CG', 'Africa/Brazzaville', 1.00, 1.00, 1.00),
('CH', 'Europe/Zurich', 1.00, 2.00, 1.00),
('CI', 'Africa/Abidjan', 0.00, 0.00, 0.00),
('CK', 'Pacific/Rarotonga', -10.00, -10.00, -10.00),
('CL', 'America/Santiago', -3.00, -4.00, -4.00),
('CL', 'Pacific/Easter', -5.00, -6.00, -6.00),
('CM', 'Africa/Douala', 1.00, 1.00, 1.00),
('CN', 'Asia/Chongqing', 8.00, 8.00, 8.00),
('CN', 'Asia/Harbin', 8.00, 8.00, 8.00),
('CN', 'Asia/Kashgar', 8.00, 8.00, 8.00),
('CN', 'Asia/Shanghai', 8.00, 8.00, 8.00),
('CN', 'Asia/Urumqi', 8.00, 8.00, 8.00),
('CO', 'America/Bogota', -5.00, -5.00, -5.00),
('CR', 'America/Costa_Rica', -6.00, -6.00, -6.00),
('CU', 'America/Havana', -5.00, -4.00, -5.00),
('CV', 'Atlantic/Cape_Verde', -1.00, -1.00, -1.00),
('CW', 'America/Curacao', -4.00, -4.00, -4.00),
('CX', 'Indian/Christmas', 7.00, 7.00, 7.00),
('CY', 'Asia/Nicosia', 2.00, 3.00, 2.00),
('CZ', 'Europe/Prague', 1.00, 2.00, 1.00),
('DE', 'Europe/Berlin', 1.00, 2.00, 1.00),
('DE', 'Europe/Busingen', 1.00, 2.00, 1.00),
('DJ', 'Africa/Djibouti', 3.00, 3.00, 3.00),
('DK', 'Europe/Copenhagen', 1.00, 2.00, 1.00),
('DM', 'America/Dominica', -4.00, -4.00, -4.00),
('DO', 'America/Santo_Domingo', -4.00, -4.00, -4.00),
('DZ', 'Africa/Algiers', 1.00, 1.00, 1.00),
('EC', 'America/Guayaquil', -5.00, -5.00, -5.00),
('EC', 'Pacific/Galapagos', -6.00, -6.00, -6.00),
('EE', 'Europe/Tallinn', 2.00, 3.00, 2.00),
('EG', 'Africa/Cairo', 2.00, 2.00, 2.00),
('EH', 'Africa/El_Aaiun', 0.00, 0.00, 0.00),
('ER', 'Africa/Asmara', 3.00, 3.00, 3.00),
('ES', 'Africa/Ceuta', 1.00, 2.00, 1.00),
('ES', 'Atlantic/Canary', 0.00, 1.00, 0.00),
('ES', 'Europe/Madrid', 1.00, 2.00, 1.00),
('ET', 'Africa/Addis_Ababa', 3.00, 3.00, 3.00),
('FI', 'Europe/Helsinki', 2.00, 3.00, 2.00),
('FJ', 'Pacific/Fiji', 13.00, 12.00, 12.00),
('FK', 'Atlantic/Stanley', -3.00, -3.00, -3.00),
('FM', 'Pacific/Chuuk', 10.00, 10.00, 10.00),
('FM', 'Pacific/Kosrae', 11.00, 11.00, 11.00),
('FM', 'Pacific/Pohnpei', 11.00, 11.00, 11.00),
('FO', 'Atlantic/Faroe', 0.00, 1.00, 0.00),
('FR', 'Europe/Paris', 1.00, 2.00, 1.00),
('GA', 'Africa/Libreville', 1.00, 1.00, 1.00),
('GB', 'Europe/London', 0.00, 1.00, 0.00),
('GD', 'America/Grenada', -4.00, -4.00, -4.00),
('GE', 'Asia/Tbilisi', 4.00, 4.00, 4.00),
('GF', 'America/Cayenne', -3.00, -3.00, -3.00),
('GG', 'Europe/Guernsey', 0.00, 1.00, 0.00),
('GH', 'Africa/Accra', 0.00, 0.00, 0.00),
('GI', 'Europe/Gibraltar', 1.00, 2.00, 1.00),
('GL', 'America/Danmarkshavn', 0.00, 0.00, 0.00),
('GL', 'America/Godthab', -3.00, -2.00, -3.00),
('GL', 'America/Scoresbysund', -1.00, 0.00, -1.00),
('GL', 'America/Thule', -4.00, -3.00, -4.00),
('GM', 'Africa/Banjul', 0.00, 0.00, 0.00),
('GN', 'Africa/Conakry', 0.00, 0.00, 0.00),
('GP', 'America/Guadeloupe', -4.00, -4.00, -4.00),
('GQ', 'Africa/Malabo', 1.00, 1.00, 1.00),
('GR', 'Europe/Athens', 2.00, 3.00, 2.00),
('GS', 'Atlantic/South_Georgia', -2.00, -2.00, -2.00),
('GT', 'America/Guatemala', -6.00, -6.00, -6.00),
('GU', 'Pacific/Guam', 10.00, 10.00, 10.00),
('GW', 'Africa/Bissau', 0.00, 0.00, 0.00),
('GY', 'America/Guyana', -4.00, -4.00, -4.00),
('HK', 'Asia/Hong_Kong', 8.00, 8.00, 8.00),
('HN', 'America/Tegucigalpa', -6.00, -6.00, -6.00),
('HR', 'Europe/Zagreb', 1.00, 2.00, 1.00),
('HT', 'America/Port-au-Prince', -5.00, -4.00, -5.00),
('HU', 'Europe/Budapest', 1.00, 2.00, 1.00),
('ID', 'Asia/Jakarta', 7.00, 7.00, 7.00),
('ID', 'Asia/Jayapura', 9.00, 9.00, 9.00),
('ID', 'Asia/Makassar', 8.00, 8.00, 8.00),
('ID', 'Asia/Pontianak', 7.00, 7.00, 7.00),
('IE', 'Europe/Dublin', 0.00, 1.00, 0.00),
('IL', 'Asia/Jerusalem', 2.00, 3.00, 2.00),
('IM', 'Europe/Isle_of_Man', 0.00, 1.00, 0.00),
('IN', 'Asia/Kolkata', 5.50, 5.50, 5.50),
('IO', 'Indian/Chagos', 6.00, 6.00, 6.00),
('IQ', 'Asia/Baghdad', 3.00, 3.00, 3.00),
('IR', 'Asia/Tehran', 3.50, 4.50, 3.50),
('IS', 'Atlantic/Reykjavik', 0.00, 0.00, 0.00),
('IT', 'Europe/Rome', 1.00, 2.00, 1.00),
('JE', 'Europe/Jersey', 0.00, 1.00, 0.00),
('JM', 'America/Jamaica', -5.00, -5.00, -5.00),
('JO', 'Asia/Amman', 2.00, 3.00, 2.00),
('JP', 'Asia/Tokyo', 9.00, 9.00, 9.00),
('KE', 'Africa/Nairobi', 3.00, 3.00, 3.00),
('KG', 'Asia/Bishkek', 6.00, 6.00, 6.00),
('KH', 'Asia/Phnom_Penh', 7.00, 7.00, 7.00),
('KI', 'Pacific/Enderbury', 13.00, 13.00, 13.00),
('KI', 'Pacific/Kiritimati', 14.00, 14.00, 14.00),
('KI', 'Pacific/Tarawa', 12.00, 12.00, 12.00),
('KM', 'Indian/Comoro', 3.00, 3.00, 3.00),
('KN', 'America/St_Kitts', -4.00, -4.00, -4.00),
('KP', 'Asia/Pyongyang', 9.00, 9.00, 9.00),
('KR', 'Asia/Seoul', 9.00, 9.00, 9.00),
('KW', 'Asia/Kuwait', 3.00, 3.00, 3.00),
('KY', 'America/Cayman', -5.00, -5.00, -5.00),
('KZ', 'Asia/Almaty', 6.00, 6.00, 6.00),
('KZ', 'Asia/Aqtau', 5.00, 5.00, 5.00),
('KZ', 'Asia/Aqtobe', 5.00, 5.00, 5.00),
('KZ', 'Asia/Oral', 5.00, 5.00, 5.00),
('KZ', 'Asia/Qyzylorda', 6.00, 6.00, 6.00),
('LA', 'Asia/Vientiane', 7.00, 7.00, 7.00),
('LB', 'Asia/Beirut', 2.00, 3.00, 2.00),
('LC', 'America/St_Lucia', -4.00, -4.00, -4.00),
('LI', 'Europe/Vaduz', 1.00, 2.00, 1.00),
('LK', 'Asia/Colombo', 5.50, 5.50, 5.50),
('LR', 'Africa/Monrovia', 0.00, 0.00, 0.00),
('LS', 'Africa/Maseru', 2.00, 2.00, 2.00),
('LT', 'Europe/Vilnius', 2.00, 3.00, 2.00),
('LU', 'Europe/Luxembourg', 1.00, 2.00, 1.00),
('LV', 'Europe/Riga', 2.00, 3.00, 2.00),
('LY', 'Africa/Tripoli', 2.00, 2.00, 2.00),
('MA', 'Africa/Casablanca', 0.00, 0.00, 0.00),
('MC', 'Europe/Monaco', 1.00, 2.00, 1.00),
('MD', 'Europe/Chisinau', 2.00, 3.00, 2.00),
('ME', 'Europe/Podgorica', 1.00, 2.00, 1.00),
('MF', 'America/Marigot', -4.00, -4.00, -4.00),
('MG', 'Indian/Antananarivo', 3.00, 3.00, 3.00),
('MH', 'Pacific/Kwajalein', 12.00, 12.00, 12.00),
('MH', 'Pacific/Majuro', 12.00, 12.00, 12.00),
('MK', 'Europe/Skopje', 1.00, 2.00, 1.00),
('ML', 'Africa/Bamako', 0.00, 0.00, 0.00),
('MM', 'Asia/Rangoon', 6.50, 6.50, 6.50),
('MN', 'Asia/Choibalsan', 8.00, 8.00, 8.00),
('MN', 'Asia/Hovd', 7.00, 7.00, 7.00),
('MN', 'Asia/Ulaanbaatar', 8.00, 8.00, 8.00),
('MO', 'Asia/Macau', 8.00, 8.00, 8.00),
('MP', 'Pacific/Saipan', 10.00, 10.00, 10.00),
('MQ', 'America/Martinique', -4.00, -4.00, -4.00),
('MR', 'Africa/Nouakchott', 0.00, 0.00, 0.00),
('MS', 'America/Montserrat', -4.00, -4.00, -4.00),
('MT', 'Europe/Malta', 1.00, 2.00, 1.00),
('MU', 'Indian/Mauritius', 4.00, 4.00, 4.00),
('MV', 'Indian/Maldives', 5.00, 5.00, 5.00),
('MW', 'Africa/Blantyre', 2.00, 2.00, 2.00),
('MX', 'America/Bahia_Banderas', -6.00, -5.00, -6.00),
('MX', 'America/Cancun', -6.00, -5.00, -6.00),
('MX', 'America/Chihuahua', -7.00, -6.00, -7.00),
('MX', 'America/Hermosillo', -7.00, -7.00, -7.00),
('MX', 'America/Matamoros', -6.00, -5.00, -6.00),
('MX', 'America/Mazatlan', -7.00, -6.00, -7.00),
('MX', 'America/Merida', -6.00, -5.00, -6.00),
('MX', 'America/Mexico_City', -6.00, -5.00, -6.00),
('MX', 'America/Monterrey', -6.00, -5.00, -6.00),
('MX', 'America/Ojinaga', -7.00, -6.00, -7.00),
('MX', 'America/Santa_Isabel', -8.00, -7.00, -8.00),
('MX', 'America/Tijuana', -8.00, -7.00, -8.00),
('MY', 'Asia/Kuala_Lumpur', 8.00, 8.00, 8.00),
('MY', 'Asia/Kuching', 8.00, 8.00, 8.00),
('MZ', 'Africa/Maputo', 2.00, 2.00, 2.00),
('NA', 'Africa/Windhoek', 2.00, 1.00, 1.00),
('NC', 'Pacific/Noumea', 11.00, 11.00, 11.00),
('NE', 'Africa/Niamey', 1.00, 1.00, 1.00),
('NF', 'Pacific/Norfolk', 11.50, 11.50, 11.50),
('NG', 'Africa/Lagos', 1.00, 1.00, 1.00),
('NI', 'America/Managua', -6.00, -6.00, -6.00),
('NL', 'Europe/Amsterdam', 1.00, 2.00, 1.00),
('NO', 'Europe/Oslo', 1.00, 2.00, 1.00),
('NP', 'Asia/Kathmandu', 5.75, 5.75, 5.75),
('NR', 'Pacific/Nauru', 12.00, 12.00, 12.00),
('NU', 'Pacific/Niue', -11.00, -11.00, -11.00),
('NZ', 'Pacific/Auckland', 13.00, 12.00, 12.00),
('NZ', 'Pacific/Chatham', 13.75, 12.75, 12.75),
('OM', 'Asia/Muscat', 4.00, 4.00, 4.00),
('PA', 'America/Panama', -5.00, -5.00, -5.00),
('PE', 'America/Lima', -5.00, -5.00, -5.00),
('PF', 'Pacific/Gambier', -9.00, -9.00, -9.00),
('PF', 'Pacific/Marquesas', -9.50, -9.50, -9.50),
('PF', 'Pacific/Tahiti', -10.00, -10.00, -10.00),
('PG', 'Pacific/Port_Moresby', 10.00, 10.00, 10.00),
('PH', 'Asia/Manila', 8.00, 8.00, 8.00),
('PK', 'Asia/Karachi', 5.00, 5.00, 5.00),
('PL', 'Europe/Warsaw', 1.00, 2.00, 1.00),
('PM', 'America/Miquelon', -3.00, -2.00, -3.00),
('PN', 'Pacific/Pitcairn', -8.00, -8.00, -8.00),
('PR', 'America/Puerto_Rico', -4.00, -4.00, -4.00),
('PS', 'Asia/Gaza', 2.00, 3.00, 2.00),
('PS', 'Asia/Hebron', 2.00, 3.00, 2.00),
('PT', 'Atlantic/Azores', -1.00, 0.00, -1.00),
('PT', 'Atlantic/Madeira', 0.00, 1.00, 0.00),
('PT', 'Europe/Lisbon', 0.00, 1.00, 0.00),
('PW', 'Pacific/Palau', 9.00, 9.00, 9.00),
('PY', 'America/Asuncion', -3.00, -4.00, -4.00),
('QA', 'Asia/Qatar', 3.00, 3.00, 3.00),
('RE', 'Indian/Reunion', 4.00, 4.00, 4.00),
('RO', 'Europe/Bucharest', 2.00, 3.00, 2.00),
('RS', 'Europe/Belgrade', 1.00, 2.00, 1.00),
('RU', 'Asia/Anadyr', 12.00, 12.00, 12.00),
('RU', 'Asia/Irkutsk', 9.00, 9.00, 9.00),
('RU', 'Asia/Kamchatka', 12.00, 12.00, 12.00),
('RU', 'Asia/Khandyga', 10.00, 10.00, 10.00),
('RU', 'Asia/Krasnoyarsk', 8.00, 8.00, 8.00),
('RU', 'Asia/Magadan', 12.00, 12.00, 12.00),
('RU', 'Asia/Novokuznetsk', 7.00, 7.00, 7.00),
('RU', 'Asia/Novosibirsk', 7.00, 7.00, 7.00),
('RU', 'Asia/Omsk', 7.00, 7.00, 7.00),
('RU', 'Asia/Sakhalin', 11.00, 11.00, 11.00),
('RU', 'Asia/Ust-Nera', 11.00, 11.00, 11.00),
('RU', 'Asia/Vladivostok', 11.00, 11.00, 11.00),
('RU', 'Asia/Yakutsk', 10.00, 10.00, 10.00),
('RU', 'Asia/Yekaterinburg', 6.00, 6.00, 6.00),
('RU', 'Europe/Kaliningrad', 3.00, 3.00, 3.00),
('RU', 'Europe/Moscow', 4.00, 4.00, 4.00),
('RU', 'Europe/Samara', 4.00, 4.00, 4.00),
('RU', 'Europe/Volgograd', 4.00, 4.00, 4.00),
('RW', 'Africa/Kigali', 2.00, 2.00, 2.00),
('SA', 'Asia/Riyadh', 3.00, 3.00, 3.00),
('SB', 'Pacific/Guadalcanal', 11.00, 11.00, 11.00),
('SC', 'Indian/Mahe', 4.00, 4.00, 4.00),
('SD', 'Africa/Khartoum', 3.00, 3.00, 3.00),
('SE', 'Europe/Stockholm', 1.00, 2.00, 1.00),
('SG', 'Asia/Singapore', 8.00, 8.00, 8.00),
('SH', 'Atlantic/St_Helena', 0.00, 0.00, 0.00),
('SI', 'Europe/Ljubljana', 1.00, 2.00, 1.00),
('SJ', 'Arctic/Longyearbyen', 1.00, 2.00, 1.00),
('SK', 'Europe/Bratislava', 1.00, 2.00, 1.00),
('SL', 'Africa/Freetown', 0.00, 0.00, 0.00),
('SM', 'Europe/San_Marino', 1.00, 2.00, 1.00),
('SN', 'Africa/Dakar', 0.00, 0.00, 0.00),
('SO', 'Africa/Mogadishu', 3.00, 3.00, 3.00),
('SR', 'America/Paramaribo', -3.00, -3.00, -3.00),
('SS', 'Africa/Juba', 3.00, 3.00, 3.00),
('ST', 'Africa/Sao_Tome', 0.00, 0.00, 0.00),
('SV', 'America/El_Salvador', -6.00, -6.00, -6.00),
('SX', 'America/Lower_Princes', -4.00, -4.00, -4.00),
('SY', 'Asia/Damascus', 2.00, 3.00, 2.00),
('SZ', 'Africa/Mbabane', 2.00, 2.00, 2.00),
('TC', 'America/Grand_Turk', -5.00, -4.00, -5.00),
('TD', 'Africa/Ndjamena', 1.00, 1.00, 1.00),
('TF', 'Indian/Kerguelen', 5.00, 5.00, 5.00),
('TG', 'Africa/Lome', 0.00, 0.00, 0.00),
('TH', 'Asia/Bangkok', 7.00, 7.00, 7.00),
('TJ', 'Asia/Dushanbe', 5.00, 5.00, 5.00),
('TK', 'Pacific/Fakaofo', 13.00, 13.00, 13.00),
('TL', 'Asia/Dili', 9.00, 9.00, 9.00),
('TM', 'Asia/Ashgabat', 5.00, 5.00, 5.00),
('TN', 'Africa/Tunis', 1.00, 1.00, 1.00),
('TO', 'Pacific/Tongatapu', 13.00, 13.00, 13.00),
('TR', 'Europe/Istanbul', 2.00, 3.00, 2.00),
('TT', 'America/Port_of_Spain', -4.00, -4.00, -4.00),
('TV', 'Pacific/Funafuti', 12.00, 12.00, 12.00),
('TW', 'Asia/Taipei', 8.00, 8.00, 8.00),
('TZ', 'Africa/Dar_es_Salaam', 3.00, 3.00, 3.00),
('UA', 'Europe/Kiev', 2.00, 3.00, 2.00),
('UA', 'Europe/Simferopol', 2.00, 4.00, 4.00),
('UA', 'Europe/Uzhgorod', 2.00, 3.00, 2.00),
('UA', 'Europe/Zaporozhye', 2.00, 3.00, 2.00),
('UG', 'Africa/Kampala', 3.00, 3.00, 3.00),
('UM', 'Pacific/Johnston', -10.00, -10.00, -10.00),
('UM', 'Pacific/Midway', -11.00, -11.00, -11.00),
('UM', 'Pacific/Wake', 12.00, 12.00, 12.00),
('US', 'America/Adak', -10.00, -9.00, -10.00),
('US', 'America/Anchorage', -9.00, -8.00, -9.00),
('US', 'America/Boise', -7.00, -6.00, -7.00),
('US', 'America/Chicago', -6.00, -5.00, -6.00),
('US', 'America/Denver', -7.00, -6.00, -7.00),
('US', 'America/Detroit', -5.00, -4.00, -5.00),
('US', 'America/Indiana/Indianapolis', -5.00, -4.00, -5.00),
('US', 'America/Indiana/Knox', -6.00, -5.00, -6.00),
('US', 'America/Indiana/Marengo', -5.00, -4.00, -5.00),
('US', 'America/Indiana/Petersburg', -5.00, -4.00, -5.00),
('US', 'America/Indiana/Tell_City', -6.00, -5.00, -6.00),
('US', 'America/Indiana/Vevay', -5.00, -4.00, -5.00),
('US', 'America/Indiana/Vincennes', -5.00, -4.00, -5.00),
('US', 'America/Indiana/Winamac', -5.00, -4.00, -5.00),
('US', 'America/Juneau', -9.00, -8.00, -9.00),
('US', 'America/Kentucky/Louisville', -5.00, -4.00, -5.00),
('US', 'America/Kentucky/Monticello', -5.00, -4.00, -5.00),
('US', 'America/Los_Angeles', -8.00, -7.00, -8.00),
('US', 'America/Menominee', -6.00, -5.00, -6.00),
('US', 'America/Metlakatla', -8.00, -8.00, -8.00),
('US', 'America/New_York', -5.00, -4.00, -5.00),
('US', 'America/Nome', -9.00, -8.00, -9.00),
('US', 'America/North_Dakota/Beulah', -6.00, -5.00, -6.00),
('US', 'America/North_Dakota/Center', -6.00, -5.00, -6.00),
('US', 'America/North_Dakota/New_Salem', -6.00, -5.00, -6.00),
('US', 'America/Phoenix', -7.00, -7.00, -7.00),
('US', 'America/Shiprock', -7.00, -6.00, -7.00),
('US', 'America/Sitka', -9.00, -8.00, -9.00),
('US', 'America/Yakutat', -9.00, -8.00, -9.00),
('US', 'Pacific/Honolulu', -10.00, -10.00, -10.00),
('UY', 'America/Montevideo', -2.00, -3.00, -3.00),
('UZ', 'Asia/Samarkand', 5.00, 5.00, 5.00),
('UZ', 'Asia/Tashkent', 5.00, 5.00, 5.00),
('VA', 'Europe/Vatican', 1.00, 2.00, 1.00),
('VC', 'America/St_Vincent', -4.00, -4.00, -4.00),
('VE', 'America/Caracas', -4.50, -4.50, -4.50),
('VG', 'America/Tortola', -4.00, -4.00, -4.00),
('VI', 'America/St_Thomas', -4.00, -4.00, -4.00),
('VN', 'Asia/Ho_Chi_Minh', 7.00, 7.00, 7.00),
('VU', 'Pacific/Efate', 11.00, 11.00, 11.00),
('WF', 'Pacific/Wallis', 12.00, 12.00, 12.00),
('WS', 'Pacific/Apia', 14.00, 13.00, 13.00),
('YE', 'Asia/Aden', 3.00, 3.00, 3.00),
('YT', 'Indian/Mayotte', 3.00, 3.00, 3.00),
('ZA', 'Africa/Johannesburg', 2.00, 2.00, 2.00),
('ZM', 'Africa/Lusaka', 2.00, 2.00, 2.00),
('ZW', 'Africa/Harare', 2.00, 2.00, 2.00);

-- --------------------------------------------------------

--
-- Table structure for table `time_frames`
--

CREATE TABLE `time_frames` (
  `id` int(11) NOT NULL,
  `day` varchar(100) DEFAULT NULL,
  `start` varchar(100) DEFAULT NULL,
  `end` varchar(100) DEFAULT NULL,
  `max_orders` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_frames`
--

INSERT INTO `time_frames` (`id`, `day`, `start`, `end`, `max_orders`) VALUES
(1, 'monday', '10:00 AM', '11:00 AM', 20),
(3, 'monday', '02:00 PM', '03:00 PM', 7),
(4, 'wednesday', '10:00 AM', '12:00 PM', 30);

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `section` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ulinks`
--

CREATE TABLE `ulinks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulinks`
--

INSERT INTO `ulinks` (`id`, `language_id`, `name`, `url`, `created_at`, `updated_at`) VALUES
(36, 176, 'Contact', '/contact', NULL, NULL),
(37, 176, 'Blogs', '/blogs', NULL, NULL),
(38, 176, 'Team', '/team', NULL, NULL),
(39, 176, 'Gallery', '/gallery', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `billing_fname` varchar(255) DEFAULT NULL,
  `billing_lname` varchar(255) DEFAULT NULL,
  `billing_photo` varchar(255) DEFAULT NULL,
  `billing_username` varchar(255) DEFAULT NULL,
  `billing_email` varchar(255) DEFAULT NULL,
  `billing_number` varchar(255) DEFAULT NULL,
  `billing_city` varchar(255) DEFAULT NULL,
  `billing_state` varchar(255) DEFAULT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `billing_country` varchar(255) DEFAULT NULL,
  `shpping_fname` varchar(255) DEFAULT NULL,
  `shpping_lname` varchar(255) DEFAULT NULL,
  `shpping_photo` varchar(255) DEFAULT NULL,
  `shpping_username` varchar(255) DEFAULT NULL,
  `shpping_email` varchar(255) DEFAULT NULL,
  `shpping_number` varchar(255) DEFAULT NULL,
  `shpping_city` varchar(255) DEFAULT NULL,
  `shpping_state` varchar(255) DEFAULT NULL,
  `shpping_address` varchar(255) DEFAULT NULL,
  `shpping_country` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `verification_link` text DEFAULT NULL,
  `email_verified` varchar(20) NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `billing_country_code` varchar(10) DEFAULT NULL,
  `shipping_country_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `photo`, `username`, `email`, `password`, `number`, `city`, `state`, `address`, `country`, `remember_token`, `billing_fname`, `billing_lname`, `billing_photo`, `billing_username`, `billing_email`, `billing_number`, `billing_city`, `billing_state`, `billing_address`, `billing_country`, `shpping_fname`, `shpping_lname`, `shpping_photo`, `shpping_username`, `shpping_email`, `shpping_number`, `shpping_city`, `shpping_state`, `shpping_address`, `shpping_country`, `status`, `verification_link`, `email_verified`, `created_at`, `updated_at`, `provider`, `provider_id`, `billing_country_code`, `shipping_country_code`) VALUES
(1, 'Samiul Alim', 'Pratik', '16507803311597919925.jpg', 'Pratik11', 'geniustest11@gmail.com', '$2y$10$Mt3Z6/TlW/xwLEBKmr4WwuEJdIXYZL6FN/ckbvEzQ3ozvqEibHAV2', '+8801689583182', 'California', 'California', 'Address America, Inc.\r\n5454 I 55 North\r\nJackson, Mississippi 39211', 'USA', 'UPjmspW9t9GoAdS0IjRh9q3heoWwGrSSWKBUv8IATiFBS3CHJvF7hij2OL7x', 'jhon', 'due', NULL, 'jhon due', 'jhon@gmail.com', '1689583182', 'USA', 'USA', 'America', 'America', 'jhon', 'due', NULL, 'jhondue', 'jhon@gmail.com', '16895831821', 'US', 'US', 'Amarica', 'America', 1, 'fe76220b5388111d003a1058d5e40ac3', 'Yes', '2020-06-22 04:48:05', '2023-05-13 06:44:41', NULL, NULL, '+880', '+880'),
(2, 'John', 'Mikel', '15988000003.png', 'Mikel007', 'mikel@gmail.com', '$2y$10$OHlZWozb9quLWem6bhCVn.bbmTskN1b6zrJX54Stx0FVMe85n71gq', '67097604344', 'Oklahoma', 'Oklahoma', 'Oklahoma, USA', 'United States', 'r0zQPdDnXFMDktXEmuFAmAcCswO1QeEXdVmN8qy4YFEMyftMF8sarv9Q60Z3', 'John', 'Mikel', NULL, NULL, 'john@gmail.com', '36473871339', 'New York', 'New York', 'New York, USA', 'USA', 'John', 'Mikel', NULL, NULL, 'mikel@gmail.com', '36237343742', 'California', 'California', 'California, USA', 'USA', 1, '18cbbab1fde0cff2579803dd8de1d0ec', 'Yes', '2020-08-30 09:03:54', '2020-08-30 09:12:03', NULL, NULL, NULL, NULL),
(9, 'Samiul', 'Pratik', '1608015525rp01.jpg', 'KreativDev', 'kreativdev.envato@gmail.com', '$2a$12$q3ufqQBuDkVaHvu4/cftYe1ic2/HqCMd6hI9TNyBbMXAO745y2V5a', '01689583182', 'Dhaka', 'Dhaka', 'House - 44, Road - 3, Sector - 11, Uttara, Dhaka', 'Bangladesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'Yes', '2020-12-13 02:24:28', '2020-12-15 00:59:55', 'google', '112335104463784291574', NULL, NULL),
(10, NULL, NULL, NULL, 'pratik', 'pratik.anwar@gmail.com', '$2y$10$GEdJL7IR/Fo5nC.khvYDBuhX89MVLwQen.RoDd7jU1WQsN4QtO2OS', NULL, NULL, NULL, NULL, NULL, '1VXRjtx32XTwcvWQMrZZPfnysdw9w85UwN9LdTWgQN1lUnfssbnPxKOKJcYX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'b2a8101879aa4253970ff74dbd4fc351', 'Yes', '2022-04-24 09:06:28', '2022-04-24 09:10:26', NULL, NULL, NULL, NULL),
(11, NULL, NULL, NULL, 'ruzygu', 'ganarimapu@mailinator.com', '$2y$10$TPUu9qlp6VhVDpti0S0YLuK7zlyVHkPBY2UiVRymdBa5EvuSywP4u', NULL, NULL, NULL, NULL, NULL, 'p0SWm1oZueNEd9Ynzd1MiCllJWg3e3fLJYUEGzaRui3iGAD1bO224r5zkpPU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '4c8cca308fbe7821540c3a202b15e1df', 'Yes', '2023-03-11 05:22:59', '2023-03-26 04:15:22', NULL, NULL, NULL, NULL),
(12, NULL, NULL, NULL, 'ramuqeb', 'saifislamfci@gmail.com', '$2y$10$LrywN6ZFKdkHGuGC7eYWBexIKDhe3A1IykGoNHnU8Gd8kp0XA8Gz2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '03e3a81d2689981c977336ebeb3b34e7', 'Yes', '2023-03-11 05:23:37', '2023-03-26 04:15:30', NULL, NULL, NULL, NULL),
(13, NULL, NULL, NULL, 'saiful islam Sharif', 'saifislamfci22@gmail.com', '$2y$10$hXeWtn6xqJuC8e1E4nI1YeyFLdzoXqT8ccsVqkx/d9PYHxI8q12HS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ad4f44ad5dbaf2a3595c699330df5b46', 'Yes', '2023-04-02 05:42:18', '2023-04-02 05:42:18', NULL, NULL, NULL, NULL),
(14, 'dd', 'ss', '1681102866blog-13.jpg', 'saiful islam Sharif 33', 'saifislamfci33@gmail.com', '$2a$12$u3nhn3ZONGwvy624ah2R1.qQRMgr3OAkNNiy4BXBjglf7Dhl34Sha', '0187336555', 'Consectetur repudian', 'dd', 'dd', 'dd', NULL, 'saiful Isalam', 'Sharif', NULL, NULL, 'saifulislamsharif@gmail.com', '01872330', 'ss', 'aaa', 'aa', 'aaa', 'sss', 'dd', NULL, NULL, 'ddd@gmail.com', '0456654425', 'sss', 'ddd', 'ss', 'ddd', 1, 'fedd874526d313ddc5ff5deaa6c55bb9', 'yes', '2023-04-02 05:42:50', '2023-04-10 05:01:06', NULL, NULL, '+7840', '+7840'),
(15, NULL, NULL, NULL, 'akash', 'akesh@gmail.com', '$2y$10$OwF9qy.u.eb4kqFOEvBznOAC/YnfwoADBNMxq19Sh/Jca5GYnUxa6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '6ed50b907822b58b54e756cd7e7a1da4', 'yes', '2023-04-16 10:29:53', '2023-04-16 10:29:53', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backups`
--
ALTER TABLE `backups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_extendeds`
--
ALTER TABLE `basic_extendeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_extras`
--
ALTER TABLE `basic_extras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_settings`
--
ALTER TABLE `basic_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bcategories`
--
ALTER TABLE `bcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bottomlinks`
--
ALTER TABLE `bottomlinks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guests_endpoint_unique` (`endpoint`);

--
-- Indexes for table `intro_points`
--
ALTER TABLE `intro_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jcategories`
--
ALTER TABLE `jcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offline_gateways`
--
ALTER TABLE `offline_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_times`
--
ALTER TABLE `order_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pcategories`
--
ALTER TABLE `pcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popups`
--
ALTER TABLE `popups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `popups_language_id_foreign` (`language_id`);

--
-- Indexes for table `postal_codes`
--
ALTER TABLE `postal_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postal_codes_language_id_foreign` (`language_id`);

--
-- Indexes for table `pos_payment_methods`
--
ALTER TABLE `pos_payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_orders`
--
ALTER TABLE `product_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `psub_categories`
--
ALTER TABLE `psub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `push_subscriptions`
--
ALTER TABLE `push_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `push_subscriptions_endpoint_unique` (`endpoint`);

--
-- Indexes for table `reservation_inputs`
--
ALTER TABLE `reservation_inputs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation_input_options`
--
ALTER TABLE `reservation_input_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serving_methods`
--
ALTER TABLE `serving_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitemaps`
--
ALTER TABLE `sitemaps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_books`
--
ALTER TABLE `table_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`country_code`,`timezone`);

--
-- Indexes for table `time_frames`
--
ALTER TABLE `time_frames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulinks`
--
ALTER TABLE `ulinks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `backups`
--
ALTER TABLE `backups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `basic_extendeds`
--
ALTER TABLE `basic_extendeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `basic_extras`
--
ALTER TABLE `basic_extras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `basic_settings`
--
ALTER TABLE `basic_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `bcategories`
--
ALTER TABLE `bcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `bottomlinks`
--
ALTER TABLE `bottomlinks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `intro_points`
--
ALTER TABLE `intro_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jcategories`
--
ALTER TABLE `jcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `offline_gateways`
--
ALTER TABLE `offline_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT for table `order_times`
--
ALTER TABLE `order_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pcategories`
--
ALTER TABLE `pcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `popups`
--
ALTER TABLE `popups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `postal_codes`
--
ALTER TABLE `postal_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pos_payment_methods`
--
ALTER TABLE `pos_payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;

--
-- AUTO_INCREMENT for table `product_orders`
--
ALTER TABLE `product_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `psub_categories`
--
ALTER TABLE `psub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `push_subscriptions`
--
ALTER TABLE `push_subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `reservation_inputs`
--
ALTER TABLE `reservation_inputs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `reservation_input_options`
--
ALTER TABLE `reservation_input_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `serving_methods`
--
ALTER TABLE `serving_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sitemaps`
--
ALTER TABLE `sitemaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `table_books`
--
ALTER TABLE `table_books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `time_frames`
--
ALTER TABLE `time_frames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ulinks`
--
ALTER TABLE `ulinks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `popups`
--
ALTER TABLE `popups`
  ADD CONSTRAINT `popups_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `postal_codes`
--
ALTER TABLE `postal_codes`
  ADD CONSTRAINT `postal_codes_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
