
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- albums
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `albums`;

CREATE TABLE `albums`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(40) NOT NULL,
    `artist1id` int(11) unsigned NOT NULL,
    `artist2id` int(11) unsigned NOT NULL,
    `dopylnitelnoinfo` TEXT NOT NULL,
    `year` int(6) unsigned NOT NULL,
    `image` VARCHAR(100) NOT NULL,
    `vid` tinyint(3) unsigned NOT NULL,
    `up_id` int(11) unsigned NOT NULL,
    `va` TINYINT(1) NOT NULL,
    `p1` int(11) unsigned NOT NULL,
    `p2` int(11) unsigned NOT NULL,
    `p3` int(11) unsigned NOT NULL,
    `p4` int(11) unsigned NOT NULL,
    `p5` int(11) unsigned NOT NULL,
    `p6` int(11) unsigned NOT NULL,
    `p7` int(11) unsigned NOT NULL,
    `p8` int(11) unsigned NOT NULL,
    `p9` int(11) unsigned NOT NULL,
    `p10` int(11) unsigned NOT NULL,
    `p11` int(11) unsigned NOT NULL,
    `p12` int(11) unsigned NOT NULL,
    `p13` int(11) unsigned NOT NULL,
    `p14` int(11) unsigned NOT NULL,
    `p15` int(11) unsigned NOT NULL,
    `p16` int(11) unsigned NOT NULL,
    `p17` int(11) unsigned NOT NULL,
    `p18` int(11) unsigned NOT NULL,
    `p19` int(11) unsigned NOT NULL,
    `p20` int(11) unsigned NOT NULL,
    `p21` int(11) unsigned NOT NULL,
    `p22` int(11) unsigned NOT NULL,
    `p23` int(11) unsigned NOT NULL,
    `p24` int(11) unsigned NOT NULL,
    `p25` int(11) unsigned NOT NULL,
    `p26` int(11) unsigned NOT NULL,
    `p27` int(11) unsigned NOT NULL,
    `p28` int(11) unsigned NOT NULL,
    `p29` int(11) unsigned NOT NULL,
    `p30` int(11) unsigned NOT NULL,
    `p31` int(11) unsigned NOT NULL,
    `p32` int(11) unsigned NOT NULL,
    `p33` int(11) unsigned NOT NULL,
    `p34` int(11) unsigned NOT NULL,
    `p35` int(11) unsigned NOT NULL,
    `p1n` VARCHAR(60) NOT NULL,
    `p2n` VARCHAR(60) NOT NULL,
    `p3n` VARCHAR(60) NOT NULL,
    `p4n` VARCHAR(60) NOT NULL,
    `p5n` VARCHAR(60) NOT NULL,
    `p6n` VARCHAR(60) NOT NULL,
    `p7n` VARCHAR(60) NOT NULL,
    `p8n` VARCHAR(60) NOT NULL,
    `p9n` VARCHAR(60) NOT NULL,
    `p10n` VARCHAR(60) NOT NULL,
    `p11n` VARCHAR(60) NOT NULL,
    `p12n` VARCHAR(60) NOT NULL,
    `p13n` VARCHAR(60) NOT NULL,
    `p14n` VARCHAR(60) NOT NULL,
    `p15n` VARCHAR(60) NOT NULL,
    `p16n` VARCHAR(60) NOT NULL,
    `p17n` VARCHAR(60) NOT NULL,
    `p18n` VARCHAR(60) NOT NULL,
    `p19n` VARCHAR(60) NOT NULL,
    `p20n` VARCHAR(60) NOT NULL,
    `p21n` VARCHAR(60) NOT NULL,
    `p22n` VARCHAR(60) NOT NULL,
    `p23n` VARCHAR(60) NOT NULL,
    `p24n` VARCHAR(60) NOT NULL,
    `p25n` VARCHAR(60) NOT NULL,
    `p26n` VARCHAR(60) NOT NULL,
    `p27n` VARCHAR(60) NOT NULL,
    `p28n` VARCHAR(60) NOT NULL,
    `p29n` VARCHAR(60) NOT NULL,
    `p30n` VARCHAR(60) NOT NULL,
    `p31n` VARCHAR(60) NOT NULL,
    `p32n` VARCHAR(60) NOT NULL,
    `p33n` VARCHAR(60) NOT NULL,
    `p34n` VARCHAR(60) NOT NULL,
    `p35n` VARCHAR(60) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `artistid` (`artist1id`),
    INDEX `artist2id` (`artist2id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- artists
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `artists`;

CREATE TABLE `artists`
(
    `name` VARCHAR(100) NOT NULL,
    `name_alternatives` VARCHAR(255) NOT NULL,
    `addedby` int(11) unsigned NOT NULL,
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `redirect_to_artist_id` INTEGER,
    `forbidden` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `redirect_to_artist_id` (`redirect_to_artist_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- bans
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `bans`;

CREATE TABLE `bans`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `ip` int(4) unsigned NOT NULL,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `username` VARCHAR(30) NOT NULL,
    `comment` TEXT,
    PRIMARY KEY (`id`),
    INDEX `ip` (`ip`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- chat
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `chat`;

CREATE TABLE `chat`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `message` TEXT NOT NULL,
    `username_id` int(11) unsigned,
    `username_name` VARCHAR(30) NOT NULL,
    `username_mood` VARCHAR(20),
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `ip` VARCHAR(50) NOT NULL,
    `lastEdit` DATETIME,
    `allowBan` TINYINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `username_id` (`username_id`),
    INDEX `lastEdit` (`lastEdit`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- chat_online
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `chat_online`;

CREATE TABLE `chat_online`
(
    `userId` int(11) unsigned,
    `username` VARCHAR(32) NOT NULL,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`username`),
    INDEX `userId` (`userId`),
    CONSTRAINT `chat_online_ibfk_1`
        FOREIGN KEY (`userId`)
        REFERENCES `users` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- comments
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments`
(
    `text` TEXT NOT NULL,
    `sendby` int(11) unsigned NOT NULL,
    `date` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `date_orig` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `edited` TINYINT(1) DEFAULT 0 NOT NULL,
    `zakoqpesen` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `zakoqpesen` (`zakoqpesen`),
    CONSTRAINT `komentari_ako_se_iztrie_pesenta`
        FOREIGN KEY (`zakoqpesen`)
        REFERENCES `lyric` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- edit_add_prevod
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `edit_add_prevod`;

CREATE TABLE `edit_add_prevod`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `text` TEXT NOT NULL,
    `ot` int(11) unsigned NOT NULL,
    `za_pesen` int(11) unsigned NOT NULL,
    `ip` VARCHAR(20) NOT NULL,
    `za_user_id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `za_user_id` (`za_user_id`),
    INDEX `za_pesen` (`za_pesen`),
    CONSTRAINT `prevodi_ako_se_iztrie_pesenta`
        FOREIGN KEY (`za_pesen`)
        REFERENCES `lyric` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- flood_control
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `flood_control`;

CREATE TABLE `flood_control`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `ip` int(4) unsigned NOT NULL,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `ip` (`ip`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- forum_posts
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `forum_posts`;

CREATE TABLE `forum_posts`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `post` TEXT NOT NULL,
    `poster` int(11) unsigned NOT NULL,
    `za_topic_id` int(11) unsigned NOT NULL,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `za_topic_id` (`za_topic_id`),
    CONSTRAINT `postove_ako_se_iztrie_temata`
        FOREIGN KEY (`za_topic_id`)
        REFERENCES `forum_topic` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- forum_razdel
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `forum_razdel`;

CREATE TABLE `forum_razdel`
(
    `name` VARCHAR(50) NOT NULL,
    `podredba` TINYINT(1) NOT NULL,
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `hidden` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- forum_topic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `forum_topic`;

CREATE TABLE `forum_topic`
(
    `topic_razdel` int(11) unsigned NOT NULL,
    `topic_name` VARCHAR(40) NOT NULL,
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `topic_pin` TINYINT(1) NOT NULL,
    `topic_starter` int(11) unsigned NOT NULL,
    `topic_posleden_post` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `priority` tinyint(3) unsigned NOT NULL,
    UNIQUE INDEX `topic_id` (`id`),
    INDEX `topic_razdel` (`topic_razdel`),
    CONSTRAINT `temi_ako_se_iztrie_razdel`
        FOREIGN KEY (`topic_razdel`)
        REFERENCES `forum_razdel` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- forum_topic_watchers
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `forum_topic_watchers`;

CREATE TABLE `forum_topic_watchers`
(
    `user_id` int(10) unsigned NOT NULL,
    `forum_topic_id` int(10) unsigned NOT NULL,
    PRIMARY KEY (`user_id`,`forum_topic_id`),
    INDEX `forum_topic_id` (`forum_topic_id`),
    CONSTRAINT `forum_topic_watchers_ibfk_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`),
    CONSTRAINT `forum_topic_watchers_ibfk_2`
        FOREIGN KEY (`forum_topic_id`)
        REFERENCES `forum_topic` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- glasuvane_posledni
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `glasuvane_posledni`;

CREATE TABLE `glasuvane_posledni`
(
    `text` TEXT NOT NULL,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `za` int(11) unsigned NOT NULL
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- languages
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages`
(
    `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- liubimi
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `liubimi`;

CREATE TABLE `liubimi`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `username` int(11) unsigned NOT NULL,
    `pesen` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `username` (`username`),
    INDEX `liubimi_ako_se_iztrie_pesenta` (`pesen`),
    CONSTRAINT `liubimi_ako_se_iztrie_pesenta`
        FOREIGN KEY (`pesen`)
        REFERENCES `lyric` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- log
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `text` TEXT NOT NULL,
    `data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- lyric_18
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `lyric_18`;

CREATE TABLE `lyric_18`
(
    `id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `lyric_18_ako_se_iztrie_pesenta`
        FOREIGN KEY (`id`)
        REFERENCES `lyric` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- lyric_editprotect
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `lyric_editprotect`;

CREATE TABLE `lyric_editprotect`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `pesen_id` int(11) unsigned NOT NULL,
    `user_id` int(11) unsigned NOT NULL,
    `vreme` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `pesen_id` (`pesen_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- lyric_redirect
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `lyric_redirect`;

CREATE TABLE `lyric_redirect`
(
    `deleted_id` int(11) unsigned NOT NULL,
    `redirect_id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`deleted_id`,`redirect_id`),
    INDEX `redirect_id` (`redirect_id`),
    CONSTRAINT `lyric_redirect_ibfk_1`
        FOREIGN KEY (`redirect_id`)
        REFERENCES `lyric` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- lyric_views
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `lyric_views`;

CREATE TABLE `lyric_views`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `lyric_id` int(11) unsigned NOT NULL,
    `ip` int(4) unsigned NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- novini
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `novini`;

CREATE TABLE `novini`
(
    `id` int(11) unsigned NOT NULL,
    `text` TEXT NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `check_ako_se_iztrie_temata`
        FOREIGN KEY (`id`)
        REFERENCES `forum_topic` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- permission_group_permissions
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `permission_group_permissions`;

CREATE TABLE `permission_group_permissions`
(
    `groupId` int(10) unsigned NOT NULL,
    `permissionId` int(10) unsigned NOT NULL,
    INDEX `groupId` (`groupId`),
    INDEX `permissionId` (`permissionId`),
    CONSTRAINT `permission_group_permissions_ibfk_1`
        FOREIGN KEY (`groupId`)
        REFERENCES `permission_groups` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `permission_group_permissions_ibfk_2`
        FOREIGN KEY (`permissionId`)
        REFERENCES `permissions` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- permission_group_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `permission_group_users`;

CREATE TABLE `permission_group_users`
(
    `groupId` int(10) unsigned NOT NULL,
    `userId` int(11) unsigned NOT NULL,
    PRIMARY KEY (`groupId`,`userId`),
    INDEX `userId` (`userId`),
    INDEX `groupId` (`groupId`),
    CONSTRAINT `permission_group_users_ibfk_1`
        FOREIGN KEY (`groupId`)
        REFERENCES `permission_groups` (`id`),
    CONSTRAINT `permission_group_users_ibfk_2`
        FOREIGN KEY (`userId`)
        REFERENCES `users` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- permission_groups
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `permission_groups`;

CREATE TABLE `permission_groups`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- permission_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `permission_users`;

CREATE TABLE `permission_users`
(
    `permissionId` int(10) unsigned NOT NULL,
    `userId` int(10) unsigned NOT NULL,
    PRIMARY KEY (`permissionId`,`userId`),
    INDEX `userId` (`userId`),
    CONSTRAINT `permission_users_ibfk_1`
        FOREIGN KEY (`permissionId`)
        REFERENCES `permissions` (`id`),
    CONSTRAINT `permission_users_ibfk_2`
        FOREIGN KEY (`userId`)
        REFERENCES `users` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- permissions
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `value` int(10) unsigned,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- phinxlog
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `phinxlog`;

CREATE TABLE `phinxlog`
(
    `version` BIGINT NOT NULL,
    `start_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `end_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- pm
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `pm`;

CREATE TABLE `pm`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `za` int(11) unsigned NOT NULL,
    `ot` int(11) unsigned NOT NULL,
    `text` TEXT NOT NULL,
    `otnosno` VARCHAR(150) NOT NULL,
    `data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `procheteno` TINYINT(1) NOT NULL,
    `ip` int(4) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `za` (`za`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- prevodi
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `prevodi`;

CREATE TABLE `prevodi`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(11) unsigned NOT NULL,
    `text` TEXT NOT NULL,
    `zaglavie` TEXT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `user_id` (`user_id`),
    CONSTRAINT `prevodi_ibfk_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- today
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `today`;

CREATE TABLE `today`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `date` DATE NOT NULL,
    `artist_id` int(11) unsigned,
    `text` TEXT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `artist_id` (`artist_id`),
    CONSTRAINT `today_ibfk_1`
        FOREIGN KEY (`artist_id`)
        REFERENCES `artists` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- lyric
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `lyric`;

CREATE TABLE `lyric`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `cache_title_full` TEXT NOT NULL,
    `cache_title_short` VARCHAR(280) NOT NULL,
    `uploaded_by` int(11) unsigned NOT NULL,
    `text` TEXT NOT NULL,
    `text_bg` TEXT,
    `artist1` int(11) unsigned NOT NULL,
    `artist2` int(11) unsigned NOT NULL,
    `artist3` int(11) unsigned NOT NULL,
    `artist4` int(11) unsigned NOT NULL,
    `artist5` int(11) unsigned NOT NULL,
    `artist6` int(11) unsigned NOT NULL,
    `title` VARCHAR(60) NOT NULL,
    `album1` int(11) unsigned NOT NULL,
    `album2` int(11) unsigned NOT NULL,
    `video` VARCHAR(100) NOT NULL,
    `video_vbox7` VARCHAR(100) NOT NULL,
    `video_vbox7_orig` VARCHAR(100) NOT NULL,
    `video_youtube` VARCHAR(100) NOT NULL,
    `video_youtube_orig` VARCHAR(100) NOT NULL,
    `video_metacafe` VARCHAR(150) NOT NULL,
    `video_metacafe_orig` VARCHAR(150) NOT NULL,
    `download` VARCHAR(255),
    `image` VARCHAR(100) NOT NULL,
    `podnovena` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `ip_upload` VARCHAR(30) NOT NULL,
    `dopylnitelnoinfo` TEXT NOT NULL,
    `glasa` int(11) unsigned NOT NULL,
    `views` int(11) unsigned NOT NULL,
    `popularity` int(11) unsigned NOT NULL,
    `stilraphiphop` TINYINT(1) NOT NULL,
    `stilhiphop` TINYINT(1) NOT NULL,
    `stileastcoast` TINYINT(1) NOT NULL,
    `language` tinyint(1) unsigned NOT NULL,
    `stilskit` TINYINT(1) NOT NULL,
    `stilelektronna` TINYINT(1) NOT NULL,
    `stilrok` TINYINT(1) NOT NULL,
    `stilrok_clas` TINYINT(1) NOT NULL,
    `stilrok_alt` TINYINT(1) NOT NULL,
    `stilrok_hard` TINYINT(1) NOT NULL,
    `stildisko` TINYINT(1) NOT NULL,
    `stillatam` TINYINT(1) NOT NULL,
    `stilsamba` TINYINT(1) NOT NULL,
    `stiltango` TINYINT(1) NOT NULL,
    `stilsalsa` TINYINT(1) NOT NULL,
    `stilklasi` TINYINT(1) NOT NULL,
    `stildetski` TINYINT(1) NOT NULL,
    `stilfolk` TINYINT(1) NOT NULL,
    `stilnarodna` TINYINT(1) NOT NULL,
    `stilchalga` TINYINT(1) NOT NULL,
    `stilpopfolk` TINYINT(1) NOT NULL,
    `stilmetal` TINYINT(1) NOT NULL,
    `stilmetal_heavy` TINYINT(1) NOT NULL,
    `stilmetal_power` TINYINT(1) NOT NULL,
    `stilmetal_death` TINYINT(1) NOT NULL,
    `stilmetal_nu` TINYINT(1) NOT NULL,
    `stilmetal_gothic` TINYINT(1) NOT NULL,
    `stilmetal_symphonic` TINYINT(1) NOT NULL,
    `stilsoundtrack` TINYINT(1) NOT NULL,
    `stildance` TINYINT(1) NOT NULL,
    `stilRnB` TINYINT(1) NOT NULL,
    `stilsoul` TINYINT(1) NOT NULL,
    `stilnew_rave` TINYINT(1) NOT NULL,
    `stilreggae` TINYINT(1) NOT NULL,
    `stilkantri` TINYINT(1) NOT NULL,
    `stilpunk` TINYINT(1) NOT NULL,
    `stilemo` TINYINT(1) NOT NULL,
    `stilbreakbeat` TINYINT(1) NOT NULL,
    `stilbigbeat` TINYINT(1) NOT NULL,
    `stiljaz` TINYINT(1) NOT NULL,
    `stilblus` TINYINT(1) NOT NULL,
    `stilelectronica` TINYINT(1) NOT NULL,
    `stilska` TINYINT(1) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `artist` (`artist1`),
    INDEX `artist2` (`artist2`),
    INDEX `artist3` (`artist3`),
    INDEX `artist4` (`artist4`),
    INDEX `artist6` (`artist6`),
    INDEX `artist5` (`artist5`),
    INDEX `glasa` (`glasa`),
    INDEX `vidqna` (`vidqna`),
    INDEX `populqrnost` (`populqrnost`),
    INDEX `fi_ic_language_fk` (`language`),
    CONSTRAINT `lyric_language_fk`
        FOREIGN KEY (`language`)
        REFERENCES `languages` (`id`)
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- lyric_votes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `lyric_votes`;

CREATE TABLE `lyric_votes`
(
    `za` int(11) unsigned NOT NULL,
    `ot` int(11) unsigned NOT NULL,
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`),
    INDEX `glasuvane_ako_se_iztrie_pesenta` (`za`),
    CONSTRAINT `glasuvane_ako_se_iztrie_pesenta`
        FOREIGN KEY (`za`)
        REFERENCES `lyric` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `username` VARCHAR(30) NOT NULL,
    `password` VARCHAR(32) NOT NULL,
    `password_mod` VARCHAR(32) NOT NULL,
    `password_mod_coockie` VARCHAR(32) NOT NULL,
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `mail` VARCHAR(37) NOT NULL,
    `class` INTEGER DEFAULT 0 NOT NULL,
    `classCustomName` VARCHAR(255),
    `avatar` VARCHAR(100),
    `about` TEXT NOT NULL,
    `reg_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `pozdrav` int(11) unsigned NOT NULL,
    `br_pesni` int(11) unsigned NOT NULL,
    `rajdane` VARCHAR(8) NOT NULL,
    `prevodi` int(10) unsigned NOT NULL,
    `autoplay` smallint(1) unsigned DEFAULT 1 NOT NULL,
    `skype` VARCHAR(50) NOT NULL,
    `activity_points` int(10) unsigned NOT NULL,
    `banned` DATETIME,
    `chatMessages` int(10) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `username` (`username`),
    UNIQUE INDEX `mail` (`mail`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
