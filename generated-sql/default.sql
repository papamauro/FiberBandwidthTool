
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `uid` INTEGER NOT NULL AUTO_INCREMENT,
    `company` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`uid`),
    UNIQUE INDEX `user_u_f86ef3` (`username`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- requests
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `requests`;

CREATE TABLE `requests`
(
    `rid` INTEGER NOT NULL AUTO_INCREMENT,
    `completed` TINYINT(1),
    `result` INTEGER,
    `avg` TINYINT(1),
    `ext_uid` INTEGER,
    PRIMARY KEY (`rid`),
    INDEX `requests_fi_cf1b1d` (`ext_uid`),
    CONSTRAINT `requests_fk_cf1b1d`
        FOREIGN KEY (`ext_uid`)
        REFERENCES `user` (`uid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- web
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `web`;

CREATE TABLE `web`
(
    `web_id` INTEGER NOT NULL AUTO_INCREMENT,
    `internal_web_server` TINYINT(1),
    `page_size` INTEGER,
    `page_load_time` INTEGER,
    `concorrent_requests` INTEGER,
    `up_bandwidth` INTEGER,
    `down_bandwidth` INTEGER,
    `ext_rid` INTEGER,
    PRIMARY KEY (`web_id`),
    INDEX `web_fi_0061bb` (`ext_rid`),
    CONSTRAINT `web_fk_0061bb`
        FOREIGN KEY (`ext_rid`)
        REFERENCES `requests` (`rid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- video
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `video`;

CREATE TABLE `video`
(
    `video_id` INTEGER NOT NULL AUTO_INCREMENT,
    `uso_video` INTEGER,
    `numero_partecipanti_entrata` INTEGER,
    `numero_partecipanti_uscita` INTEGER,
    `risoluzione` INTEGER,
    `dinamicita_immagine` INTEGER,
    `fps` INTEGER,
    `sessioni_contemporanee` INTEGER,
    `ext_rid` INTEGER,
    `up_bandwidth` INTEGER,
    `down_bandwidth` INTEGER,
    PRIMARY KEY (`video_id`),
    INDEX `video_fi_0061bb` (`ext_rid`),
    CONSTRAINT `video_fk_0061bb`
        FOREIGN KEY (`ext_rid`)
        REFERENCES `requests` (`rid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- generic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `generic`;

CREATE TABLE `generic`
(
    `generic_id` INTEGER NOT NULL AUTO_INCREMENT,
    `numero_postazioni` INTEGER,
    `utilizzo_banda` INTEGER,
    `up_bandwidth` INTEGER,
    `down_bandwidth` INTEGER,
    `ext_rid` INTEGER,
    PRIMARY KEY (`generic_id`),
    INDEX `generic_fi_0061bb` (`ext_rid`),
    CONSTRAINT `generic_fk_0061bb`
        FOREIGN KEY (`ext_rid`)
        REFERENCES `requests` (`rid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- voip
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `voip`;

CREATE TABLE `voip`
(
    `void_id` INTEGER NOT NULL AUTO_INCREMENT,
    `uso_voip` TINYINT(1),
    `telefonate_contemporanee` INTEGER,
    `codec` INTEGER,
    `compressed_rtp` TINYINT(1),
    `l2_protocol` INTEGER,
    `up_bandwidth` INTEGER,
    `down_bandwidth` INTEGER,
    `ext_rid` INTEGER,
    PRIMARY KEY (`void_id`),
    INDEX `voip_fi_0061bb` (`ext_rid`),
    CONSTRAINT `voip_fk_0061bb`
        FOREIGN KEY (`ext_rid`)
        REFERENCES `requests` (`rid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- security
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `security`;

CREATE TABLE `security`
(
    `security_id` INTEGER NOT NULL AUTO_INCREMENT,
    `use_security` TINYINT(1),
    `external_mediaserver` TINYINT(1),
    `remote_access` TINYINT(1),
    `number_camera` INTEGER,
    `fps` INTEGER,
    `resolution` INTEGER,
    `h264_profile` INTEGER,
    `number_camera_viewed` INTEGER,
    `up_bandwidth` INTEGER,
    `down_bandwidth` INTEGER,
    `view_resolution` INTEGER,
    `ext_rid` INTEGER,
    PRIMARY KEY (`security_id`),
    INDEX `security_fi_0061bb` (`ext_rid`),
    CONSTRAINT `security_fk_0061bb`
        FOREIGN KEY (`ext_rid`)
        REFERENCES `requests` (`rid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- remote
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `remote`;

CREATE TABLE `remote`
(
    `remote_id` INTEGER NOT NULL AUTO_INCREMENT,
    `remote_used` TINYINT(1),
    `concurrent_access` INTEGER,
    `remote_service` INTEGER,
    `citrix_br` TINYINT(1),
    `office_band` INTEGER,
    `internet_band` INTEGER,
    `printing_band` INTEGER,
    `sd_video_band` INTEGER,
    `hd_video_band` INTEGER,
    `up_bandwidth` INTEGER,
    `down_bandwidth` INTEGER,
    `ext_rid` INTEGER,
    PRIMARY KEY (`remote_id`),
    INDEX `remote_fi_0061bb` (`ext_rid`),
    CONSTRAINT `remote_fk_0061bb`
        FOREIGN KEY (`ext_rid`)
        REFERENCES `requests` (`rid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- mail
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `mail`;

CREATE TABLE `mail`
(
    `mail_id` INTEGER NOT NULL AUTO_INCREMENT,
    `internal_mail_server` TINYINT(1),
    `mail_count` INTEGER,
    `send_mail_latency` INTEGER,
    `average_received_mail` INTEGER,
    `average_sended_mail` INTEGER,
    `mail_size` INTEGER,
    `up_bandwidth` INTEGER,
    `down_bandwidth` INTEGER,
    `ext_rid` INTEGER,
    PRIMARY KEY (`mail_id`),
    INDEX `mail_fi_0061bb` (`ext_rid`),
    CONSTRAINT `mail_fk_0061bb`
        FOREIGN KEY (`ext_rid`)
        REFERENCES `requests` (`rid`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
