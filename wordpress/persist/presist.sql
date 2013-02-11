CREATE TABLE `{$wpdb->prefix}_persist` (
	`persist_name` VARCHAR(64) NOT NULL DEFAULT '',
	`persist_group` VARCHAR(64) NOT NULL DEFAULT '',
	`persist_value` LONGTEXT NOT NULL,
	`persist_expire` TIMESTAMP NULL DEFAULT NULL,
	`serialized` TINYINT(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`persist_name`),
	INDEX `persist_group` (`persist_group`)
)
COLLATE='utf8_general_ci'
ENGINE=MyISAM;