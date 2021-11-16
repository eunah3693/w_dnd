CREATE DATABASE  IF NOT EXISTS `dndlifecare` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `dndlifecare`;
-- MariaDB dump 10.18  Distrib 10.4.16-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: dndlifecare
-- ------------------------------------------------------
-- Server version	10.4.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `address_tbl`
--

DROP TABLE IF EXISTS `address_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `user_idx` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `tel` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `zip` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `addr1` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `addr2` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `msg` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='회원배송지정보';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alarm_tbl`
--

DROP TABLE IF EXISTS `alarm_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alarm_tbl` (
  `idx` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_idx` bigint(20) unsigned NOT NULL COMMENT '유저 인덱스',
  `sender_idx` bigint(20) unsigned NOT NULL COMMENT '보낸 회원 인덱스',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '내용',
  `related_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'url',
  `is_check` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1: 확인, 0: 비확인',
  `type` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '임시삭제',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=970 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_push_tbl`
--

DROP TABLE IF EXISTS `app_push_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_push_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '?dndlifecare?',
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `memo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_column` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `banner_tbl`
--

DROP TABLE IF EXISTS `banner_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner_tbl` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_idx` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint(4) DEFAULT NULL COMMENT '노출 순서',
  `is_public` tinyint(1) NOT NULL DEFAULT 1 COMMENT '노출여부 0 비공개 1공개',
  `position` enum('top','center','bottom') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_idx` int(11) NOT NULL,
  `page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '노출될 배너 페이지',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'T:상단 C:중간 B:하단 N:미적용',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='배너';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `board_tbl`
--

DROP TABLE IF EXISTS `board_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `board_tbl` (
  `idx` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_idx` bigint(20) unsigned NOT NULL COMMENT '유저 인덱스',
  `user_idx2` bigint(20) unsigned NOT NULL COMMENT '답변자 인덱스',
  `parent_idx` int(11) DEFAULT NULL,
  `category` enum('공지사항','이벤트','자주하는질문','이용문의','이용안내','펫시피','이용약관','개인정보처리방침') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '게시물 종류',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '제목',
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '서브제목',
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '내용',
  `content2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '내용2(답변)',
  `answered_at` timestamp NULL DEFAULT NULL,
  `top_fixed` int(11) NOT NULL DEFAULT 0,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_file_idx` int(11) DEFAULT NULL,
  `thum_file_idx` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0 COMMENT '출력 순서',
  `hidden` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT '감추기',
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '임시삭제',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=2426 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bookmark_tbl`
--

DROP TABLE IF EXISTS `bookmark_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookmark_tbl` (
  `idx` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_idx` bigint(20) unsigned NOT NULL COMMENT '유저 인덱스',
  `post_idx` bigint(20) unsigned DEFAULT NULL COMMENT '게시판 인덱스',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '임시삭제',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `config_tbl`
--

DROP TABLE IF EXISTS `config_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `config_tbl` WRITE;
/*!40000 ALTER TABLE `config_tbl` DISABLE KEYS */;
INSERT INTO `config_tbl` VALUES (3,'트릿','def_mis_treat','기본 미션 트릿 획득 확률',1,'2021-01-31 23:11:09',NULL,NULL),(4,'이벤트','default_event_perc','기본 이벤트 당첨  확률',10,'2021-01-31 23:11:09','2021-04-09 02:57:13',NULL),(5,'트릿','post_like_treat','포스트 좋아요 획득 트릿 ',1,'2021-01-31 23:11:09',NULL,NULL),(6,'레벨','level_exp_proportion','레벨업 시 오르는 경험치 확률',1.07,'2021-01-31 23:11:09','2021-03-15 03:08:01',NULL),(7,'레벨','fix_exp_level','고정 경험치 레벨',50,'2021-01-31 23:11:09',NULL,NULL),(15,'레벨','default_start_exp','기본 경험치',100,'2021-01-31 23:11:09',NULL,NULL),(9,'앱','footer_nav','하단바 사용 여부 (0:비사용 1:사용)',1,'2021-01-31 23:55:10',NULL,NULL),(10,'피드','report_count','신고 카운터 자동 블락처리 한도',3,'2021-01-31 23:55:10',NULL,NULL),(11,'미션','weekly_issuance_number','주간미션 발급 갯수',3,'2021-02-04 16:44:53',NULL,NULL),(12,'미션','weekly_issuance_day','주간미션 발급 요일 (0:일요일)',0,'2021-02-04 16:45:37',NULL,NULL),(13,'미션','weekly_page','(사용안함) 최근 주간미션 발급 한 페이지',5,'2021-02-04 20:38:43','2021-04-05 05:25:24',NULL),(14,'트릿','post_like_limit','포스트 좋아요 트릿 획득 가능한 하루 한도',5,'2021-02-14 22:58:27',NULL,NULL),(16,'레벨','default_exp_proportion','기본 경험치 획득 확률',1,'2021-04-05 06:58:27',NULL,NULL),(17,'미션','consecutive_booster','연속 보상 부스터 기간',7,'2021-04-05 06:58:27',NULL,NULL),(18,'트릿','consecutive_point_before','연속 보상 트릿 금액 ( 부스터 기간 전 )',10,'2021-04-05 06:58:27',NULL,NULL),(19,'트릿','consecutive_point_after','연속 보상 트릿 금액 ( 부스터 기간 후 )',15,'2021-04-05 06:58:27',NULL,NULL),(21,'미션','weekly_issuance_last_idx','주간미션 마지막(최근) 발급 인덱스',57,'2021-04-05 06:58:27','2021-04-05 06:24:31',NULL);
/*!40000 ALTER TABLE `config_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_tbl`
--

DROP TABLE IF EXISTS `device_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `fcm` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `os` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `uuid` (`uuid`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dogs_breed_tbl`
--

DROP TABLE IF EXISTS `dogs_breed_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dogs_breed_tbl` (
  `idx` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `breed` varchar(64) NOT NULL DEFAULT '0' COMMENT '견종',
  `visible` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '노출여부',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=223 DEFAULT CHARSET=utf8mb4 COMMENT='개품종';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `event_join_tbl`
--

DROP TABLE IF EXISTS `event_join_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_join_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `user_idx` int(11) NOT NULL,
  `event_idx` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 탈락 1: 당첨 2: 기타',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='이벤트 참여';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `event_review_tbl`
--

DROP TABLE IF EXISTS `event_review_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_review_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `user_idx` int(11) NOT NULL,
  `order_idx` int(11) NOT NULL,
  `event_idx` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` tinyint(1) unsigned NOT NULL DEFAULT 5,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `file_idx` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='리뷰';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `event_tbl`
--

DROP TABLE IF EXISTS `event_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '카테고리',
  `user_idx` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preview` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '미리보기',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: 공개 0:비공개',
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `order` int(11) DEFAULT NULL COMMENT '순서',
  `participation_count` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '참여횟수 없을시 무제한',
  `participation_point` int(11) NOT NULL COMMENT '참여금액',
  `perc` float NOT NULL DEFAULT 0 COMMENT '백분율',
  `stock` int(11) NOT NULL DEFAULT 0 COMMENT '재고 ( 당첨자 수 )',
  `thum_file_idx` int(11) DEFAULT NULL COMMENT '썸네일 사진',
  `main_file_idx` int(11) DEFAULT NULL COMMENT '메인 사진',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='이벤트 및 교환 응모';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `files_tbl`
--

DROP TABLE IF EXISTS `files_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files_tbl` (
  `idx` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_idx` bigint(20) unsigned DEFAULT NULL,
  `table_name` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '테이블명',
  `table_idx` int(11) DEFAULT NULL COMMENT '테이블인덱스',
  `real_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '저장경로',
  `orgin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '오리지널 이름',
  `size` int(11) NOT NULL COMMENT '파일사이즈',
  `mime_type` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '파일타입',
  `is_public` tinyint(1) NOT NULL DEFAULT 1 COMMENT '공개여부',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '임시삭제',
  `is_encoding` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`idx`),
  KEY `files_tbl_user_idx_index` (`user_idx`)
) ENGINE=MyISAM AUTO_INCREMENT=885 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `google2fa_secret_tbl`
--

DROP TABLE IF EXISTS `google2fa_secret_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `google2fa_secret_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `user_idx` int(11) NOT NULL,
  `id` varchar(255) NOT NULL,
  `google2fa_secret` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='시크릿코드 발급 로그 테이블';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`(250))
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `like_tbl`
--

DROP TABLE IF EXISTS `like_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `like_tbl` (
  `idx` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_idx` bigint(20) unsigned NOT NULL COMMENT '유저 인덱스',
  `post_idx` int(11) DEFAULT NULL COMMENT '게시판 인덱스',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '임시삭제',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=247 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log_app_push_tbl`
--

DROP TABLE IF EXISTS `log_app_push_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_app_push_tbl` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_single` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: 단체 1:개별',
  `mar_idx` int(11) DEFAULT NULL COMMENT '마케팅 인덱스',
  `user_idx` int(11) DEFAULT NULL COMMENT '받는사람 user_idx',
  `sender_idx` int(11) DEFAULT NULL COMMENT '보낸사람',
  `request` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `success` int(11) NOT NULL DEFAULT 0,
  `fail` int(11) NOT NULL DEFAULT 0,
  `created_at` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='앱푸쉬로그';
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `app_push_tbl` WRITE;
/*!40000 ALTER TABLE `app_push_tbl` DISABLE KEYS */;
INSERT INTO `app_push_tbl` VALUES (1,'event','?dndlifecare?','교환소에 당첨되었습니다. 배송지를 입력해주세요!',NULL,'push_event',NULL,NULL,NULL),(2,'post_like','?dndlifecare?','$1님이 게시글을 좋아합니다.',NULL,'push_like',NULL,NULL,NULL),(3,'post_reply','?dndlifecare?','$1님이 댓글을 달았습니다. $2',NULL,'push_reply',NULL,NULL,NULL),(4,'mention','?dndlifecare?','$1님이 회원님을 언급했습니다.',NULL,'push_reply',NULL,NULL,NULL),(5,'reply_like','?dndlifecare?','$1님이 회원님의 댓글을 좋아합니다.',NULL,'push_like',NULL,NULL,NULL),(8,'join','?dndlifecare?','회원가입을 축하드립니다! 펫을 등록하고 미션을 즐겨보세요!',NULL,'push_agree',NULL,NULL,NULL),(6,'level_up','?dndlifecare?','레벨업을 축하드립니다! $2',NULL,'push_agree',NULL,NULL,NULL),(7,'report','?dndlifecare?','다수의 신고로 인해 회원님의 게시글이 블라인드 처리되었습니다.',NULL,'push_agree',NULL,NULL,NULL),(9,'myqna','?dndlifecare?','1:1 문의에 답변이달렸습니다.',NULL,'push_agree',NULL,NULL,NULL);
/*!40000 ALTER TABLE `app_push_tbl` ENABLE KEYS */;
UNLOCK TABLES;
--
-- Table structure for table `log_exp_tbl`
--

DROP TABLE IF EXISTS `log_exp_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_exp_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `user_idx` bigint(20) NOT NULL,
  `exp` int(11) NOT NULL,
  `memo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=218 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `marketing_tbl`
--

DROP TABLE IF EXISTS `marketing_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marketing_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `category` enum('메일','문자','앱푸쉬','알림톡') COLLATE utf8mb4_bin DEFAULT NULL COMMENT '마케팅 종류 ',
  `title` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL COMMENT '제목',
  `content` text COLLATE utf8mb4_bin DEFAULT NULL COMMENT '내용',
  `count` int(11) DEFAULT NULL COMMENT '전송수',
  `user_idx` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mission_bookmark_tbl`
--

DROP TABLE IF EXISTS `mission_bookmark_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission_bookmark_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `user_idx` int(11) NOT NULL,
  `is_daily` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1: 일일미션(일일미션일경우 mission_idx = mission_pool_tbl.idx)\r\n0: 기타미션 mission_idx = mission_tbl.idx 참조',
  `mission_idx` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `index2` (`is_daily`,`mission_idx`,`user_idx`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='미션 북마크';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mission_pool_tbl`
--

DROP TABLE IF EXISTS `mission_pool_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission_pool_tbl` (
  `idx` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `precede_idx` bigint(20) NOT NULL DEFAULT 0 COMMENT '선행미션 없을시 선행미션 없음',
  `is_public` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1: 공개, 0: 비공개',
  `user_idx` int(11) DEFAULT NULL COMMENT '비공개 미션일때 공유할수있는 유저. 인덱스 | 로구분',
  `category` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '일일, 주간, 스토리 미션',
  `group` tinyint(2) DEFAULT NULL COMMENT '스토리퀘스트의 그룹 0:퍼피스토리,  1:성견스토리 2:노령견스토리 등등 USER_TBL테이블에 story_mission_type을 참조함',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '제목',
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '서브제목',
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '내용',
  `youtube` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '유튭',
  `goal` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '목표',
  `how` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '방법',
  `tips` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '팁1',
  `tips2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '팁2(히든)',
  `target` set('활발한 성격','추격 본능','분리불안','강한 호기심','12개월 이하','급한 성격','통제 불가','낮은 사회성','모든 강아지','속털 많은귀','사료가 주식','주로 실내활동','폭풍 털갈이','유대감 부족','잦은 공격성','외향적 성격','사회화 시기','활발한 성격','무기력한 성격','집중력 결핍','질주 본능','약한 치아','다이어트','소심한 성격','복종훈련','낮은 사회성','잦은 공격성','짖음 증상','강한 경계심','접힌 귀','높은 식탐','예민한 피부','강한 고집','적은 운동량','예민한 성격','많은 치태치석','덤벙대는 성격','심혈관 질환','적은 산책량','낮은 혈액순환') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '''활발한 성격'', ''추격 본능'', ''분리불안'', ''강한 호기심'', ''12개월 이하'', ''급한 성격'', ''통제 불가'', ''낮은 사회성'', ''모든 강아지'', ''속털 많은귀'', ''사료가 주식'', ''주로 실내활동'', ''폭풍 털갈이'', ''유대감 부족'', ''잦은 공격성'', ''외향적 성격'', ''사회화 시기'', ''활발한 성격'', ''무기력한 성격'', ''집중력 결핍'', ''질주 본능'', ''약한 치아'', ''다이어트'', ''소심한 성격'', ''복종훈련'', ''낮은 사회성'', ''잦은 공격성'', ''짖음 증상'', ''강한 경계심'', ''접힌 귀'', ''높은 식탐'', ''예민한 피부'', ''강한 고집'', ''적은 운동량'', ''예민한 성격'', ''많은 치태치석'', ''덤벙대는 성격'', ''심혈관 질환'',''적은 산책량'',''낮은 혈액순환''',
  `preview` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '미리보기',
  `difficulty` tinyint(4) DEFAULT 1 COMMENT '난이도',
  `point` int(11) DEFAULT 0 COMMENT '지급포인트',
  `success_point` int(11) DEFAULT 0 COMMENT '성공포임트',
  `tag` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp` int(11) DEFAULT 0 COMMENT '경험치',
  `participation_count` int(11) DEFAULT 1 COMMENT '참여 횟수',
  `cooldown` int(11) DEFAULT 0 COMMENT '단위 분 0일이 사용안함',
  `thum_file_idx` int(11) DEFAULT NULL COMMENT '썸네일 파일인덱스 ( 도전미션에 노출 )',
  `startdate` datetime DEFAULT NULL COMMENT '미션 시작시간',
  `enddate` datetime DEFAULT NULL COMMENT '미션 종료시간',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '임시삭제',
  `main_file_idx` int(11) DEFAULT NULL COMMENT '대표, 메인파일인덱스 ( 미션상세페이지 상단 )',
  PRIMARY KEY (`idx`),
  KEY `mission_tbl_is_public_index` (`is_public`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mission_tbl`
--

DROP TABLE IF EXISTS `mission_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `mission_pool_idx` int(11) NOT NULL COMMENT '미션풀 인덱스',
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='미션 발행';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mission_user_status_tbl`
--

DROP TABLE IF EXISTS `mission_user_status_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission_user_status_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `mission_idx` int(11) NOT NULL,
  `post_idx` int(11) DEFAULT NULL,
  `status` tinyint(4) unsigned NOT NULL DEFAULT 0 COMMENT '0 : 미진행, 찜상태\r\n1 : 진행중\r\n2 : 완료\r\n3 : 검수중\r\n4 : 기타 ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='유저 미션 상태';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `order_tbl`
--

DROP TABLE IF EXISTS `order_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_tbl` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_idx` int(10) unsigned NOT NULL,
  `event_idx` int(11) DEFAULT NULL COMMENT '이밴트 번호',
  `count` int(11) DEFAULT NULL COMMENT '갯수',
  `delivery_num` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '배송송장',
  `status` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '배송준비중\r\n배송진행중\r\n배송완료\r\n교환신청\r\n반품신청\r\n교환완료\r\n반품완료\r\n취소신청\r\n취소신청완료',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addr1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addr2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pet_tbl`
--

DROP TABLE IF EXISTS `pet_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pet_tbl` (
  `idx` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_idx` bigint(20) unsigned NOT NULL COMMENT '회원고유인덱스',
  `is_main` tinyint(1) DEFAULT 0,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '이름',
  `breed` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '종',
  `birth` date DEFAULT NULL,
  `sex` enum('M','F') COLLATE utf8mb4_unicode_ci DEFAULT 'M',
  `memo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_idx` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '임시삭제',
  PRIMARY KEY (`idx`),
  KEY `pet_tbl_user_idx_foreign` (`user_idx`),
  KEY `pet_tbl_name_index` (`name`),
  KEY `pet_tbl_breed_index` (`breed`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `popup_tbl`
--

DROP TABLE IF EXISTS `popup_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `popup_tbl` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_idx` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint(4) DEFAULT NULL COMMENT '노출 순서',
  `is_public` tinyint(1) NOT NULL DEFAULT 1 COMMENT '노출여부 0 비공개 1공개',
  `file_idx` int(11) DEFAULT NULL,
  `page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '노출될 팝업 페이지',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'T:상단 C:중간 B:하단 N:미적용',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='팝업';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `post_tbl`
--

DROP TABLE IF EXISTS `post_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_tbl` (
  `idx` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pet_idx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '펫인덱스',
  `user_idx` int(11) DEFAULT NULL,
  `mission_idx` bigint(20) unsigned DEFAULT NULL COMMENT '미션인덱스',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '내용',
  `parent_idx` bigint(20) DEFAULT NULL COMMENT '부모 인덱스 인덱스가 있을시 댓글',
  `report` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 : 미진행, 찜상태\\n1 : 진행중\\n2 : 완료\\n3 : 검수중\\n4 : 기타 ',
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '임시삭제',
  PRIMARY KEY (`idx`),
  KEY `reply_index` (`parent_idx`),
  KEY `mission_user_tbl_mission_idx_foreign` (`mission_idx`)
) ENGINE=MyISAM AUTO_INCREMENT=953 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `report_tbl`
--

DROP TABLE IF EXISTS `report_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `user_idx` int(11) DEFAULT NULL,
  `post_idx` int(11) DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `index2` (`user_idx`,`post_idx`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='신고게시물';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tag_tbl`
--

DROP TABLE IF EXISTS `tag_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_tbl` (
  `idx` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '태그',
  `post_idx` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '테이블이름',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '임시삭제',
  PRIMARY KEY (`idx`),
  UNIQUE KEY `post_idx_tag` (`tag`,`post_idx`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=759 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `treat_tbl`
--

DROP TABLE IF EXISTS `treat_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `treat_tbl` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `user_idx` bigint(20) NOT NULL,
  `treat` int(11) NOT NULL,
  `memo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=530 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_tbl`
--

DROP TABLE IF EXISTS `user_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_tbl` (
  `idx` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '아이디',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '비밀번호',
  `nickname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '닉네임',
  `name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '사용자 이름',
  `email` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '이메일 ',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 일반 1: 관리자',
  `birth` date DEFAULT NULL COMMENT '생일',
  `tel` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '전화번호',
  `sex` enum('M','F') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '성별',
  `interset` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '흥미 |로 구분',
  `level` int(11) DEFAULT 1 COMMENT '회원레벨',
  `exp` bigint(20) NOT NULL DEFAULT 0 COMMENT '도달경험치',
  `treat` int(11) NOT NULL DEFAULT 0 COMMENT '포인트',
  `memo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '메모',
  `my_feed` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '마이피드 소개글',
  `is_password_change` tinyint(1) NOT NULL DEFAULT 0 COMMENT '패스워드 변경 여부 true일경우 변경',
  `last_password_change` datetime DEFAULT NULL COMMENT '마지막 패스워드 변경일',
  `last_login_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '마지막 로그인',
  `sms_agree` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `sms_agree_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'sms동의 수신동의 날짜',
  `email_agree` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `email_agree_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '이메일 수신동의 날짜',
  `push_agree` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `push_agree_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '앱푸쉬 수신동의 날짜',
  `push_like` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `push_reply` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `push_event` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `alimtalk_agree` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `alimtalk_agree_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '알림톡 수신동의 날짜',
  `privacy_agree_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '개인정보처리방침 동의날짜',
  `terms_agree_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '이용약관 동의날짜',
  `login_fail` smallint(6) NOT NULL DEFAULT 0 COMMENT '로그인 실패횟수',
  `out_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '탈퇴사유',
  `login_ip` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '로그인 아이피',
  `login_device` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '로그인 디바이스',
  `is_sns` tinyint(1) DEFAULT 0 COMMENT 'sns 연동여부',
  `sns_type` enum('K','N','G','F') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'K:카카오톡, N:네이버, G:구글, F:페이스북',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Y','S','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y' COMMENT 'Y: 정상회원 S:정지/블랙리스트 회원 , D:탈퇴회원',
  `fcm_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Firebase cloud messaging token',
  `file_idx` int(11) DEFAULT NULL COMMENT '회원사진',
  `story_mission_type` tinyint(2) DEFAULT NULL COMMENT '0: 퍼피 1:성견 2:노령견',
  `story_mission_pet` int(11) DEFAULT NULL,
  `is_story_mission_complete` tinyint(1) DEFAULT 0 COMMENT '0:스토리미션 미완료 1:스토리미션 완료',
  `access_level` int(11) NOT NULL DEFAULT 1,
  `access_db` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'read,insert,update,delete',
  `google2fa_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '임시삭제',
  `access_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refresh_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_un` (`email`),
  KEY `user_tbl_name_index` (`name`),
  KEY `user_tbl_nickname_index` (`nickname`),
  KEY `is_admin_index` (`is_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'dndlifecare'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-07 17:29:37
