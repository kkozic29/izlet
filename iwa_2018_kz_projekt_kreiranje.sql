-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema iwa_2018_kz_projekt
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema iwa_2018_kz_projekt
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `iwa_2018_kz_projekt` DEFAULT CHARACTER SET utf8 ;
USE `iwa_2018_kz_projekt` ;

-- -----------------------------------------------------
-- Table `iwa_2018_kz_projekt`.`tip_korisnika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2018_kz_projekt`.`tip_korisnika` (
  `tip_id` INT(10) NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`tip_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2018_kz_projekt`.`korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2018_kz_projekt`.`korisnik` (
  `korisnik_id` INT(10) NOT NULL AUTO_INCREMENT,
  `tip_id` INT(10) NOT NULL,
  `korisnicko_ime` VARCHAR(50) NOT NULL,
  `lozinka` VARCHAR(50) NOT NULL,
  `ime` VARCHAR(50) NOT NULL,
  `prezime` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NULL,
  `slika` TEXT NULL,
  PRIMARY KEY (`korisnik_id`),
  INDEX `fk_korisnik_tip_korisnika_idx` (`tip_id` ASC),
  CONSTRAINT `fk_korisnik_tip_korisnika`
    FOREIGN KEY (`tip_id`)
    REFERENCES `iwa_2018_kz_projekt`.`tip_korisnika` (`tip_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2018_kz_projekt`.`izlet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2018_kz_projekt`.`izlet` (
  `izlet_id` INT(10) NOT NULL AUTO_INCREMENT,
  `odrediste` VARCHAR(50) NOT NULL,
  `opis` TEXT NOT NULL,
  `datum_vrijeme_polaska` DATETIME NOT NULL,
  `ukupan_broj_mjesta` INT(10) NOT NULL,
  `slika` TEXT NOT NULL,
  `video` TEXT NULL,
  `organiziran` TINYINT(1) NULL,
  PRIMARY KEY (`izlet_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2018_kz_projekt`.`agencija`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2018_kz_projekt`.`agencija` (
  `agencija_id` INT(10) NOT NULL AUTO_INCREMENT,
  `moderator_id` INT(10) NOT NULL,
  `naziv` VARCHAR(50) NOT NULL,
  `opis` TEXT NOT NULL,
  PRIMARY KEY (`agencija_id`, `moderator_id`),
  INDEX `fk_udruga_korisnik1_idx` (`moderator_id` ASC),
  CONSTRAINT `fk_udruga_korisnik1`
    FOREIGN KEY (`moderator_id`)
    REFERENCES `iwa_2018_kz_projekt`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2018_kz_projekt`.`rezervacija`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2018_kz_projekt`.`rezervacija` (
  `rezervacija_id` INT(10) NOT NULL AUTO_INCREMENT,
  `agencija_id` INT(10) NOT NULL,
  `izlet_id` INT(10) NOT NULL,
  `broj_mjesta` INT(10) NOT NULL,
  INDEX `fk_agencija_has_korisnik_agencija1_idx` (`agencija_id` ASC),
  INDEX `fk_rezervacija_izlet1_idx` (`izlet_id` ASC),
  PRIMARY KEY (`rezervacija_id`),
  CONSTRAINT `fk_agencija_has_korisnik_agencija1`
    FOREIGN KEY (`agencija_id`)
    REFERENCES `iwa_2018_kz_projekt`.`agencija` (`agencija_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rezervacija_izlet1`
    FOREIGN KEY (`izlet_id`)
    REFERENCES `iwa_2018_kz_projekt`.`izlet` (`izlet_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2018_kz_projekt`.`predbiljezba`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2018_kz_projekt`.`predbiljezba` (
  `korisnik_id` INT(10) NOT NULL,
  `rezervacija_id` INT(10) NOT NULL,
  `status` TINYINT(1) NOT NULL,
  INDEX `fk_korisnik_has_izlet_korisnik2_idx` (`korisnik_id` ASC),
  INDEX `fk_potvrda_rezervacija1_idx` (`rezervacija_id` ASC),
  CONSTRAINT `fk_korisnik_has_izlet_korisnik2`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `iwa_2018_kz_projekt`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_potvrda_rezervacija1`
    FOREIGN KEY (`rezervacija_id`)
    REFERENCES `iwa_2018_kz_projekt`.`rezervacija` (`rezervacija_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE USER 'iwa_2018'@'localhost' IDENTIFIED BY 'foi2018';

GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `iwa_2018_kz_projekt`.* TO 'iwa_2018'@'localhost';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
