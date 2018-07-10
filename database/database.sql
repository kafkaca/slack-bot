-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isd_count` int(11) NOT NULL DEFAULT '1' COMMENT 'aynı tarihte max çalışan',
  `dt_wait` int(11) NOT NULL DEFAULT '30' COMMENT 'izin öncesi beklemesi gereken süre',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `departments` (`id`, `name`, `isd_count`, `dt_wait`) VALUES
(1,	'graphic',	1,	30),
(2,	'software',	1,	30);

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(10) unsigned NOT NULL,
  `can_login` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'giriş yapabilir mi ?',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(10) unsigned DEFAULT '1',
  `birthday` date DEFAULT NULL,
  `startw_date` date DEFAULT NULL,
  `endw_date` date DEFAULT NULL,
  `work_status` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `department_id` int(10) unsigned NOT NULL DEFAULT '1',
  `employee_type_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `user_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `employees` (`id`, `can_login`, `first_name`, `last_name`, `display_name`, `work_type`, `age`, `birthday`, `startw_date`, `endw_date`, `work_status`, `department_id`, `employee_type_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	1,	'Ali',	'Veli',	'Ali Veli',	'remote',	1,	'1985-06-06',	'2018-06-06',	NULL,	'1',	1,	1,	'2018-07-09 13:17:13',	'2018-07-09 13:17:13',	NULL),
(2,	1,	'Ahmet',	'Mehmet',	'Ahmet Mehmet',	'remote',	1,	'1985-06-06',	'2018-01-06',	NULL,	'1',	1,	1,	'2018-07-09 13:17:13',	'2018-07-09 13:17:13',	NULL);

DROP TABLE IF EXISTS `employee_types`;
CREATE TABLE `employee_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xtype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pv_days` int(11) NOT NULL DEFAULT '30' COMMENT 'ücretli izin günleri',
  `uv_days` int(11) NOT NULL DEFAULT '30' COMMENT 'ücretsiz izin günleri',
  `responsibilities` json DEFAULT NULL COMMENT 'bazı sorunluluklar',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `employee_types` (`id`, `xtype`, `pv_days`, `uv_days`, `responsibilities`) VALUES
(1,	'xtype',	30,	0,	'{}'),
(2,	'ytype',	45,	0,	'{}');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2016_06_01_000001_create_oauth_auth_codes_table',	1),
(4,	'2016_06_01_000002_create_oauth_access_tokens_table',	1),
(5,	'2016_06_01_000003_create_oauth_refresh_tokens_table',	1),
(6,	'2016_06_01_000004_create_oauth_clients_table',	1),
(7,	'2016_06_01_000005_create_oauth_personal_access_clients_table',	1),
(8,	'2018_07_08_100401_create_roles_table',	1),
(9,	'2018_07_08_100511_create_role_users_table',	1),
(10,	'2018_07_09_133802_create_departments_table',	1),
(11,	'2018_07_09_133802_create_employee_types_table',	1),
(12,	'2018_07_09_133802_create_employees_table',	1),
(13,	'2018_07_09_133802_create_rules_table',	1),
(14,	'2018_07_09_133802_create_temporary_data_table',	1),
(15,	'2018_07_09_133802_create_vacation_balance_table',	1),
(16,	'2018_07_09_133802_create_vacation_types_table',	1),
(17,	'2018_07_09_133802_create_vacations_table',	1);

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('ba5b43ca410c68473d33676b281c507389416031f6f6c28030d8fa787f3beacd3b92d246320f30d6',	1,	1,	'MyApp',	'[]',	0,	'2018-07-06 19:01:44',	'2018-07-06 19:01:44',	'2019-07-06 22:01:44'),
('c99db66d1083672e90aef2382a4ff0682a893064bd0f21ae13a2970a31e159828165b9d85e370afe',	1,	3,	'MyApp',	'[]',	0,	'2018-07-09 12:20:50',	'2018-07-09 12:20:50',	'2019-07-09 15:20:50');

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1,	NULL,	'Laravel Personal Access Client',	'V4Qe7JbjkeBnPdtxjgpKWV9Ldmp7OhoTH7GsvALU',	'http://localhost',	1,	0,	0,	'2018-07-06 18:41:56',	'2018-07-06 18:41:56'),
(2,	NULL,	'Laravel Password Grant Client',	'kdMZh03kZgPxdZg2Gsa1d5bS1Cxo4lOSlFTPWVjM',	'http://localhost',	0,	1,	0,	'2018-07-06 18:41:57',	'2018-07-06 18:41:57'),
(3,	NULL,	'Laravel Personal Access Client',	'HhOoGozgKt99OrbFKw84UWZ09BsKSs7qwgjZCUxh',	'http://localhost',	1,	0,	0,	'2018-07-09 12:19:13',	'2018-07-09 12:19:13'),
(4,	NULL,	'Laravel Password Grant Client',	'2hPC1UXCvpGMMNHfJNkn5qufpMuAzY66dlGrFebC',	'http://localhost',	0,	1,	0,	'2018-07-09 12:19:14',	'2018-07-09 12:19:14');

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'2018-07-06 18:41:57',	'2018-07-06 18:41:57'),
(2,	3,	'2018-07-09 12:19:13',	'2018-07-09 12:19:13');

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `slug`, `permissions`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	'admin',	'{\"create_post\": true, \"update_post\": true, \"employee_edit\": true}',	'2018-07-08 07:10:46',	'2018-07-08 07:10:46'),
(2,	'Employee',	'employee',	'{\"update_post\": true, \"publish_post\": true}',	'2018-07-08 07:10:46',	'2018-07-08 07:10:46');

DROP TABLE IF EXISTS `role_users`;
CREATE TABLE `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `role_users_user_id_role_id_unique` (`user_id`,`role_id`),
  KEY `role_users_role_id_foreign` (`role_id`),
  CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'2018-07-08 08:33:07',	'2018-07-08 08:33:07'),
(2,	2,	'2018-07-08 08:33:07',	'2018-07-08 08:33:07');

DROP TABLE IF EXISTS `rules`;
CREATE TABLE `rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rule_data` json DEFAULT NULL COMMENT 'bazı kurallar',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `rules` (`id`, `rule_name`, `rule_data`) VALUES
(1,	'vacation_rules',	'{\"min_out_date\": 30, \"max_vacatin_days\": 60}');

DROP TABLE IF EXISTS `temporary_data`;
CREATE TABLE `temporary_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `temp_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temp_data` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `temporary_data` (`id`, `temp_name`, `temp_data`) VALUES
(1,	'vacation_types',	'[{\"name\": \"Sick\", \"description\": \"Hastalıklar\"}, {\"name\": \"overtime\", \"description\": \"Fazla Mesai\"}]'),
(2,	'eployee_types',	'{}');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Gokhan Celik',	'root@gmail.com',	'$2y$10$wXzfZjvlU3LqE6tTwl7IzuDOI.af/k16Ld0Daspid71lTtfhlvZQS',	'8E4kC9dHcpCjBg3YnfWN8qAUB9uKVZoihgmz1SUa2KO8vZAByno4bxgpgJQD',	'2018-07-06 18:29:14',	'2018-07-06 18:29:14'),
(2,	'Ahmet Mehmet',	'employee@gmail.com',	'$2y$10$wXzfZjvlU3LqE6tTwl7IzuDOI.af/k16Ld0Daspid71lTtfhlvZQS',	'EBG6NcSw5sfaekCEBeYJohsRxuZERwxlw8GIlMiT45RcsTBPPfVACTYUtPFH',	'2018-07-06 18:29:14',	'2018-07-06 18:29:14');

DROP TABLE IF EXISTS `vacations`;
CREATE TABLE `vacations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) unsigned NOT NULL,
  `vacation_start` date NOT NULL,
  `vacation_end` date NOT NULL,
  `vacation_type_id` int(10) unsigned NOT NULL,
  `employee_note` text COLLATE utf8mb4_unicode_ci,
  `result_note` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','success','cancel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `request_at` date DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `vacations` (`id`, `employee_id`, `vacation_start`, `vacation_end`, `vacation_type_id`, `employee_note`, `result_note`, `status`, `request_at`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9,	1,	'2018-08-15',	'2018-08-30',	1,	NULL,	NULL,	'cancel',	'2018-07-10',	2,	'2018-07-09 16:03:40',	'2018-07-09 21:18:20',	NULL),
(17,	2,	'2018-08-15',	'2018-08-25',	1,	'çalışan notu',	'yönetici notu',	'success',	'2018-07-10',	2,	'2018-07-09 21:02:53',	'2018-07-09 21:02:53',	NULL),
(18,	2,	'2018-08-15',	'2018-08-25',	1,	'çalışan notu',	'yönetici notu',	'success',	'2018-07-10',	2,	'2018-07-09 21:04:07',	'2018-07-09 21:24:36',	NULL);

DROP TABLE IF EXISTS `vacation_balance`;
CREATE TABLE `vacation_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) unsigned NOT NULL,
  `kalan` int(11) NOT NULL DEFAULT '0',
  `kullanilan` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `vacation_types`;
CREATE TABLE `vacation_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'izin türü isim',
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `vacation_types` (`id`, `name`, `description`) VALUES
(1,	'sick',	'Hastalık Sağlık.'),
(2,	'overtime',	'Fazla mesai.');

-- 2018-07-10 00:42:35
