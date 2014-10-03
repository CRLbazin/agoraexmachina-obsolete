DROP TABLE IF EXISTS `_temp_categories`;

CREATE TABLE `_temp_categories` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `sizeW` varchar(50) NOT NULL,
 `sizeH` varchar(50) NOT NULL,
 `color` varchar(50) NOT NULL,
 PRIMARY KEY  ( `id` )
)
ENGINE = InnoDB
CHARACTER SET = latin1
AUTO_INCREMENT = 8
ROW_FORMAT = COMPACT;

INSERT INTO `_temp_categories`(`id`, `name`)
   SELECT `id`, `name` FROM `categories`;

DROP TABLE `categories`;

ALTER TABLE `_temp_categories` RENAME `categories`;


DROP TABLE IF EXISTS `_temp_instances`;

CREATE TABLE `_temp_instances` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `descr` text NOT NULL,
 `image` varchar(255) NOT NULL,
 `deadline` date NOT NULL,
 `users` int(11) DEFAULT NULL,
 `categories` int(11) NOT NULL,
 `whoCanSeeTheInstance` varchar(255) NOT NULL,
 `whoCanVote` varchar(255) NOT NULL,
 `whoCanWriteVote` varchar(255) NOT NULL,
 `typeOfDelegation` varchar(255) NOT NULL,
 `quorumRequired` varchar(255) NOT NULL,
 `voteAccountingMethod` varchar(255) NOT NULL,
 PRIMARY KEY  ( `id` )
)
ENGINE = InnoDB
CHARACTER SET = latin1
AUTO_INCREMENT = 8
ROW_FORMAT = COMPACT;

INSERT INTO `_temp_instances`(`categories`,
                                    `deadline`,
                                    `descr`,
                                    `id`,
                                    `image`,
                                    `name`,
                                    `users`)
   SELECT `categories`,
          `deadline`,
          `descr`,
          `id`,
          `image`,
          `name`,
          `users`
     FROM `instances`;

DROP TABLE `instances`;

ALTER TABLE `_temp_instances` RENAME `instances`;


CREATE TABLE `instancesusers` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `whoCanSeeTheInstance` tinyint(1) NOT NULL,
 `whoCanVote` tinyint(1) NOT NULL,
 `whoCanWriteVote` tinyint(1) NOT NULL,
 `instances` int(11) NOT NULL,
 `users` int(11) NOT NULL,
 UNIQUE INDEX `id` ( `id` ),
 PRIMARY KEY  ( `id` )
)
ENGINE = MyISAM
CHARACTER SET = latin1
AUTO_INCREMENT = 17
ROW_FORMAT = FIXED;


DROP TABLE IF EXISTS `_temp_users`;

CREATE TABLE `_temp_users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `password` varchar(255) NOT NULL,
 `email` varchar(255) NOT NULL,
 `active` int(11) NOT NULL,
 `level` int(11) NOT NULL,
 `creationDate` date NOT NULL,
 PRIMARY KEY  ( `id` )
)
ENGINE = InnoDB
CHARACTER SET = latin1
AUTO_INCREMENT = 16
ROW_FORMAT = COMPACT;

INSERT INTO `_temp_users`(`active`,
                                `creationDate`,
                                `email`,
                                `id`,
                                `level`,
                                `name`,
                                `password`)
   SELECT `active`,
          `creationDate`,
          `email`,
          `id`,
          `level`,
          `name`,
          `password`
     FROM `users`;

DROP TABLE `users`;

ALTER TABLE `_temp_users` RENAME `users`;



update instances
set whoCanSeeTheInstance = 'allUsers',
whoCanVote = 'allUsers',
whoCanWriteVote = 'allUsers',
deadline = '2020-01-01'
