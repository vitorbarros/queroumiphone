-- MySQL Script generated by MySQL Workbench
-- Sáb 23 Abr 2016 12:56:21 BRT
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema queroumiphone_sys_db
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `queroumiphone_sys_db` ;

-- -----------------------------------------------------
-- Schema queroumiphone_sys_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `queroumiphone_sys_db` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema queroumiphone_sys_db
-- -----------------------------------------------------
USE `queroumiphone_sys_db` ;

-- -----------------------------------------------------
-- Table `queroumiphone_sys_db`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `queroumiphone_sys_db`.`user` ;

CREATE TABLE IF NOT EXISTS `queroumiphone_sys_db`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `user_username` VARCHAR(200) NOT NULL,
  `user_password` VARCHAR(255) NOT NULL,
  `user_created_at` DATETIME NOT NULL,
  `user_updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `queroumiphone_sys_db`.`client`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `queroumiphone_sys_db`.`client` ;

CREATE TABLE IF NOT EXISTS `queroumiphone_sys_db`.`client` (
  `client_id` INT NOT NULL AUTO_INCREMENT,
  `client_name` VARCHAR(255) NOT NULL,
  `client_email` VARCHAR(200) NOT NULL,
  `client_cpf` VARCHAR(11) NOT NULL,
  `client_birthday` DATETIME NOT NULL,
  `client_created_at` DATETIME NOT NULL,
  `client_updated_at` DATETIME NOT NULL,
  `user` INT NOT NULL,
  PRIMARY KEY (`client_id`),
  INDEX `fk_client_user_idx` (`user` ASC),
  CONSTRAINT `fk_client_user`
    FOREIGN KEY (`user`)
    REFERENCES `queroumiphone_sys_db`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;