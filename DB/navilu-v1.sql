/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.25-MariaDB : Database - navilu-v1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Data for the table `category` */

insert  into `category`(`id`,`name`,`status`,`created_at`,`updated_at`) values 
(1,'Kitchen',1,'2022-12-06 22:27:15','2022-12-07 22:49:06'),
(2,'Tile',1,'2022-12-07 22:49:15','2022-12-07 22:49:15'),
(3,'Fitting',1,'2022-12-07 22:49:24','2022-12-07 22:49:24'),
(4,'Catalogue',1,'2022-12-07 22:49:35','2022-12-07 22:49:35'),
(5,'Showroom',1,'2022-12-07 22:49:46','2022-12-07 22:49:46'),
(6,'Award',1,'2022-12-07 22:49:55','2022-12-07 22:49:55'),
(7,'Knowledge Base',1,'2022-12-07 22:50:13','2022-12-07 22:50:13');

/*Data for the table `failed_jobs` */

/*Data for the table `migrations` */

/*Data for the table `password_resets` */

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`status`,`created_at`,`updated_at`) values 
(1,'Add New Post',1,'2022-11-25 12:12:47','2022-11-29 07:17:18'),
(2,'Post on Approval',1,'2022-11-29 07:16:44','2022-11-29 07:16:44'),
(3,'Post on Schedule',1,'2022-12-05 05:55:29','2022-12-05 05:55:29'),
(4,'Post on Site',1,'2022-12-05 11:52:41','2022-12-05 11:52:41'),
(5,'Post on Expired',1,'2022-12-05 11:52:49','2022-12-05 11:52:49'),
(6,'Master',1,'2022-12-07 14:23:11','2022-12-07 14:23:11'),
(7,'Roles',1,'2022-12-05 11:53:00','2022-12-05 11:53:00'),
(8,'Users',1,'2022-12-05 11:53:04','2022-12-05 11:53:04');

/*Data for the table `personal_access_tokens` */

/*Data for the table `post_categories` */

insert  into `post_categories`(`id`,`post_id`,`category_id`,`status`,`created_at`,`updated_at`) values 
(7,1,1,1,'2022-12-21 09:41:16','2022-12-21 09:41:16'),
(9,2,1,1,'2022-12-21 10:07:28','2022-12-21 10:07:28'),
(10,2,4,1,'2022-12-21 10:07:28','2022-12-21 10:07:28'),
(11,3,3,1,'2022-12-21 10:29:55','2022-12-21 10:29:55'),
(12,3,4,1,'2022-12-21 10:29:55','2022-12-21 10:29:55'),
(13,4,2,1,'2022-12-21 10:32:32','2022-12-21 10:32:32');

/*Data for the table `post_images` */

insert  into `post_images`(`id`,`post_id`,`image_url`,`thumbnail`,`status`,`created_at`,`updated_at`) values 
(8,1,'storage/post/thumbnail/kichen5_large_1671615676.jpg','storage/post/thumbnail/kichen5_small_1671615676.jpg',1,'2022-12-21 09:41:16','2022-12-21 09:41:16'),
(9,2,'storage/post/thumbnail/kichen5_large_1671615765.jpg','storage/post/thumbnail/kichen5_small_1671615765.jpg',1,'2022-12-21 09:42:45','2022-12-21 09:42:45'),
(10,2,'storage/post/thumbnail/kitchen1_large_1671615765.jpeg','storage/post/thumbnail/kitchen1_small_1671615765.jpeg',1,'2022-12-21 09:42:45','2022-12-21 09:42:45'),
(11,2,'storage/post/thumbnail/kitchen2_large_1671615765.jpg','storage/post/thumbnail/kitchen2_small_1671615765.jpg',1,'2022-12-21 09:42:48','2022-12-21 09:42:48'),
(12,2,'storage/post/thumbnail/kitchen3_large_1671615768.jpg','storage/post/thumbnail/kitchen3_small_1671615768.jpg',1,'2022-12-21 09:42:50','2022-12-21 09:42:50'),
(13,3,'/storage/post/thumbnail/kichen5_large_1671618595.jpg','/storage/post/thumbnail/kichen5_small_1671618595.jpg',1,'2022-12-21 10:29:55','2022-12-21 10:29:55'),
(14,3,'/storage/post/thumbnail/kitchen1_large_1671618595.jpeg','/storage/post/thumbnail/kitchen1_small_1671618595.jpeg',1,'2022-12-21 10:29:56','2022-12-21 10:29:56'),
(15,3,'/storage/post/thumbnail/kitchen2_large_1671618596.jpg','/storage/post/thumbnail/kitchen2_small_1671618596.jpg',1,'2022-12-21 10:29:59','2022-12-21 10:29:59'),
(16,3,'/storage/post/thumbnail/kitchen3_large_1671618599.jpg','/storage/post/thumbnail/kitchen3_small_1671618599.jpg',1,'2022-12-21 10:30:01','2022-12-21 10:30:01'),
(17,3,'/storage/post/thumbnail/kitchen4_large_1671618601.jpeg','/storage/post/thumbnail/kitchen4_small_1671618601.jpeg',1,'2022-12-21 10:30:01','2022-12-21 10:30:01'),
(18,4,'/storage/post/thumbnail/kichen5_large_1671618752.jpg','/storage/post/thumbnail/kichen5_small_1671618752.jpg',1,'2022-12-21 10:32:32','2022-12-21 10:32:32'),
(19,4,'/storage/post/thumbnail/kitchen1_large_1671618752.jpeg','/storage/post/thumbnail/kitchen1_small_1671618752.jpeg',1,'2022-12-21 10:32:33','2022-12-21 10:32:33'),
(20,4,'/storage/post/thumbnail/kitchen2_large_1671618753.jpg','/storage/post/thumbnail/kitchen2_small_1671618753.jpg',1,'2022-12-21 10:32:36','2022-12-21 10:32:36'),
(21,4,'/storage/post/thumbnail/kitchen3_large_1671618756.jpg','/storage/post/thumbnail/kitchen3_small_1671618756.jpg',1,'2022-12-21 10:32:38','2022-12-21 10:32:38'),
(22,4,'/storage/post/thumbnail/kitchen4_large_1671618758.jpeg','/storage/post/thumbnail/kitchen4_small_1671618758.jpeg',1,'2022-12-21 10:32:38','2022-12-21 10:32:38');

/*Data for the table `post_tags` */

insert  into `post_tags`(`id`,`post_id`,`tag_id`,`status`,`created_at`,`updated_at`) values 
(13,1,1,1,'2022-12-21 09:41:16','2022-12-21 09:41:16'),
(14,1,2,1,'2022-12-21 09:41:16','2022-12-21 09:41:16'),
(17,2,2,1,'2022-12-21 10:07:28','2022-12-21 10:07:28'),
(18,2,3,1,'2022-12-21 10:07:28','2022-12-21 10:07:28'),
(19,3,3,1,'2022-12-21 10:29:55','2022-12-21 10:29:55'),
(20,4,3,1,'2022-12-21 10:32:32','2022-12-21 10:32:32');

/*Data for the table `posts` */

insert  into `posts`(`id`,`transaction_Id`,`post_now`,`title`,`text_color`,`home_page_status`,`posting_type`,`schedule_date`,`post_end_date`,`reschedule_count`,`comment`,`rating_id`,`content`,`youtube_link`,`post_image`,`approval_status`,`force_stop_status`,`status`,`created_at`,`updated_at`,`sample`) values 
(1,1,1,'Kitchen Posts','#000000',0,1,'2022-12-19 17:57:57',NULL,1,NULL,NULL,NULL,NULL,'1',1,0,1,'2022-12-19 12:33:43','2022-12-21 09:41:16',NULL),
(2,1,1,'kitchen 2','#000000',0,1,'2022-12-19 18:05:44',NULL,1,NULL,NULL,NULL,NULL,'1',1,0,1,'2022-12-19 12:35:59','2022-12-21 10:07:28',NULL),
(3,1,1,'s1','#000000',0,1,'2022-12-21 15:59:12',NULL,1,NULL,NULL,NULL,NULL,'1',0,0,1,'2022-12-21 10:29:55','2022-12-21 10:29:55',NULL),
(4,1,1,'v1','#000000',1,1,'2022-12-21 16:00:02',NULL,1,'hii',10,NULL,NULL,'1',1,0,1,'2022-12-21 10:32:32','2022-12-21 10:32:32',NULL);

/*Data for the table `ratings` */

insert  into `ratings`(`id`,`name`,`status`,`created_at`,`updated_at`) values 
(1,'1',1,'2022-12-14 12:23:50','2022-12-14 12:23:50'),
(2,'2',1,'2022-12-14 12:23:52','2022-12-14 12:23:52'),
(3,'3',1,'2022-12-14 12:23:53','2022-12-14 12:23:53'),
(4,'4',1,'2022-12-14 12:23:54','2022-12-14 12:23:54'),
(5,'5',1,'2022-12-14 12:23:56','2022-12-14 12:23:56'),
(6,'6',1,'2022-12-14 12:23:57','2022-12-14 12:23:57'),
(7,'7',1,'2022-12-14 12:23:58','2022-12-14 12:23:58'),
(8,'8',1,'2022-12-14 12:23:59','2022-12-14 12:23:59'),
(9,'9',1,'2022-12-14 12:24:01','2022-12-14 12:24:01'),
(10,'10',1,'2022-12-14 12:24:07','2022-12-14 12:24:07');

/*Data for the table `role_master` */

/*Data for the table `roles` */

/*Data for the table `tags` */

insert  into `tags`(`id`,`name`,`status`,`created_at`,`updated_at`) values 
(1,'Tag1',1,'2022-12-19 12:24:27','2022-12-19 12:24:27'),
(2,'tag 2',1,'2022-12-19 12:24:32','2022-12-19 12:24:32'),
(3,'tag 3',1,'2022-12-19 12:24:39','2022-12-19 12:24:39');

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`status`,`auth_level`,`role`,`profile_pic`,`created_at`,`updated_at`) values 
(4,'dhana1','d@gmail.com',NULL,'$2y$10$CHJ1AG4yoRLFl5K0lldw9u44/wu/8.WBkcyun12/GNPGuP3Q.OgwC',NULL,1,9,NULL,'1669358714.jpeg','2022-11-25 06:06:34','2022-11-25 06:45:14');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
