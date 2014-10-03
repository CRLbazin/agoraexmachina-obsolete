DROP TABLE IF EXISTS `seeraiwer`.`_temp_instances`;

CREATE TABLE `seeraiwer`.`_temp_instances` (
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
 PRIMARY KEY  ( `id` )
)
ENGINE = InnoDB
CHARACTER SET = latin1
AUTO_INCREMENT = 2
ROW_FORMAT = COMPACT;

INSERT INTO `seeraiwer`.`_temp_instances`(`categories`,
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
     FROM `seeraiwer`.`instances`;

DROP TABLE `seeraiwer`.`instances`;

ALTER TABLE `seeraiwer`.`_temp_instances` RENAME `instances`;


CREATE TABLE `seeraiwer`.`instancesusers` (
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
AUTO_INCREMENT = 8
ROW_FORMAT = FIXED;