CREATE TABLE IF NOT EXISTS `#__slideshow_galleries` (
  `slideshow_gallery_id` SERIAL,
  
  `title` varchar(250) NOT NULL,
  `ordering` int(11) UNSIGNED NOT NULL,

  PRIMARY KEY (`slideshow_gallery_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `#__slideshow_slides` (
	`slideshow_slide_id` SERIAL,
	
	`title` VARCHAR(250) NOT NULL,
	`link` VARCHAR(250) NOT NULL,
	`description1` TEXT NOT NULL COMMENT '@Filter("html")',
	`image1` VARCHAR( 250 ) NOT NULL ,
	`description2` TEXT NOT NULL COMMENT '@Filter("html")',
	`image2` VARCHAR( 250 ) NOT NULL ,

	`ordering` INT( 11 ) UNSIGNED NOT NULL ,
	`slideshow_gallery_id` BIGINT( 20 ) UNSIGNED NOT NULL
) ENGINE = INNODB;