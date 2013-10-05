SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `sport`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sport` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `slug` VARCHAR(45) NOT NULL ,
  `in_home` VARCHAR(45) NOT NULL ,
  `duration` SMALLINT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `league`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `league` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_sport` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `show_icon` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_league_sport1_idx` (`id_sport` ASC) ,
  CONSTRAINT `fk_league_sport1`
    FOREIGN KEY (`id_sport` )
    REFERENCES `sport` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `event`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `event` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_league` INT NOT NULL ,
  `name` VARCHAR(240) NOT NULL ,
  `dt` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_event_league1_idx` (`id_league` ASC) ,
  CONSTRAINT `fk_event_league1`
    FOREIGN KEY (`id_league` )
    REFERENCES `league` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `source`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `source` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_event` INT NOT NULL ,
  `code` TEXT NOT NULL ,
  `order` SMALLINT(2) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_source_event_idx` (`id_event` ASC) ,
  CONSTRAINT `fk_source_event`
    FOREIGN KEY (`id_event` )
    REFERENCES `event` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ad` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `code` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lang`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lang` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `iso` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `i18n`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `i18n` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_lang` INT NOT NULL ,
  `table` VARCHAR(200) NOT NULL ,
  `field` VARCHAR(200) NOT NULL ,
  `value` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_i18n_lang1_idx` (`id_lang` ASC) ,
  CONSTRAINT `fk_i18n_lang1`
    FOREIGN KEY (`id_lang` )
    REFERENCES `lang` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
