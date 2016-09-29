-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `company`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `company` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NULL,
  `email` VARCHAR(45) NOT NULL,
  `more` VARCHAR(200) NULL,
  `status` ENUM('AVAILABLE','DELETED') NULL DEFAULT 'AVAILABLE',
  `logo` VARCHAR(100) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campaign`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `campaign` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `company_id` INT NOT NULL,
  `initial_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `final_date` DATETIME NOT NULL,
  `status` ENUM('NEW','IN_PROGRESS','DONE','DELETED') NOT NULL DEFAULT 'NEW',
  `description` TEXT NULL,
  `default_password` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_campaign_company`
    FOREIGN KEY (`company_id`)
    REFERENCES `company` (`id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_campaign_company_idx` ON `campaign` (`company_id` ASC);


-- -----------------------------------------------------
-- Table `question_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `question_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `more` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `question`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `question` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `question_text` VARCHAR(300) NOT NULL,
  `question_type_id` INT NOT NULL,
  `actuaria_360` ENUM('YES','NO') NOT NULL DEFAULT 'NO',
  `work` ENUM('YES','NO') NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_question_question_type1`
    FOREIGN KEY (`question_type_id`)
    REFERENCES `question_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_question_question_type1_idx` ON `question` (`question_type_id` ASC);


-- -----------------------------------------------------
-- Table `level`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `level` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `campaign_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `level` INT NOT NULL,
  `more` TEXT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_level_campaign1`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_level_campaign1_idx` ON `level` (`campaign_id` ASC);


-- -----------------------------------------------------
-- Table `campaign_has_question`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `campaign_has_question` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `campaign_id` INT NOT NULL,
  `question_id` INT NOT NULL,
  `level_id` INT NOT NULL,
  `question_type_id` INT NOT NULL,
  `customized` ENUM('YES','NO') NOT NULL DEFAULT 'NO',
  `question_customed` VARCHAR(300) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_campaign_has_question_campaign1`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_campaign_has_question_question1`
    FOREIGN KEY (`question_id`)
    REFERENCES `question` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_campaign_has_question_level1`
    FOREIGN KEY (`level_id`)
    REFERENCES `level` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_campaign_has_question_question_type1`
    FOREIGN KEY (`question_type_id`)
    REFERENCES `question_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_campaign_has_question_question1_idx` ON `campaign_has_question` (`question_id` ASC);

CREATE INDEX `fk_campaign_has_question_campaign1_idx` ON `campaign_has_question` (`campaign_id` ASC);

CREATE INDEX `fk_campaign_has_question_level1_idx` ON `campaign_has_question` (`level_id` ASC);

CREATE INDEX `fk_campaign_has_question_question_type1_idx` ON `campaign_has_question` (`question_type_id` ASC);


-- -----------------------------------------------------
-- Table `employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `employee` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `campaign_id` INT NOT NULL,
  `identificator` VARCHAR(10) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `be_evaluated` ENUM('YES','NO') NOT NULL DEFAULT 'YES',
  `gender` ENUM('M','F') NULL,
  `level` INT NULL DEFAULT 0,
  `area` VARCHAR(60) NULL,
  `position` VARCHAR(100) NULL,
  `email` VARCHAR(100) NULL,
  `age` VARCHAR(45) NULL,
  `income` VARCHAR(45) NULL,
  `same_level` INT NOT NULL DEFAULT 0,
  `upper_level` INT NOT NULL DEFAULT 0,
  `lower_level` INT NOT NULL DEFAULT 0,
  `image` TEXT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_employee_campaign1`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'i';

CREATE INDEX `fk_employee_campaign1_idx` ON `employee` (`campaign_id` ASC);


-- -----------------------------------------------------
-- Table `answer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `answer` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `evaluated_id` INT NOT NULL,
  `evaluator_id` INT NOT NULL,
  `question_id` INT NOT NULL,
  `campaign_id` INT NOT NULL,
  `score` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_answer_campaign1`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_answer_person1`
    FOREIGN KEY (`evaluated_id`)
    REFERENCES `employee` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_answer_person2`
    FOREIGN KEY (`evaluator_id`)
    REFERENCES `employee` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_answer_campaign_has_question1`
    FOREIGN KEY (`question_id`)
    REFERENCES `campaign_has_question` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_answer_campaign1_idx` ON `answer` (`campaign_id` ASC);

CREATE INDEX `fk_answer_person1_idx` ON `answer` (`evaluated_id` ASC);

CREATE INDEX `fk_answer_person2_idx` ON `answer` (`evaluator_id` ASC);

CREATE INDEX `fk_answer_campaign_has_question1_idx` ON `answer` (`question_id` ASC);


-- -----------------------------------------------------
-- Table `campaign_settings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `campaign_settings` (
  `id` INT NULL AUTO_INCREMENT,
  `campaign_id` INT NOT NULL,
  `upper_level` INT NOT NULL DEFAULT 1,
  `same_level` INT NOT NULL DEFAULT 1,
  `lower_level` INT NOT NULL DEFAULT 1,
  `upper_level_weight` DOUBLE NOT NULL DEFAULT 0,
  `same_level_weight` DOUBLE NOT NULL DEFAULT 0,
  `lower_level_weight` DOUBLE NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_evaluator_settings_campaign1`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_evaluator_settings_campaign1_idx` ON `campaign_settings` (`campaign_id` ASC);


-- -----------------------------------------------------
-- Table `assignations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `assignations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `campaign_id` INT NOT NULL,
  `evaluated_id` INT NOT NULL,
  `evaluator_id` INT NOT NULL,
  `personalized` ENUM('YES','NO') NOT NULL DEFAULT 'NO',
  `status` ENUM('NEW','INCOMPLETE','COMPLETE') NOT NULL DEFAULT 'NEW',
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_assignations_campaign1`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assignations_employee1`
    FOREIGN KEY (`evaluated_id`)
    REFERENCES `employee` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assignations_employee2`
    FOREIGN KEY (`evaluator_id`)
    REFERENCES `employee` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_assignations_campaign1_idx` ON `assignations` (`campaign_id` ASC);

CREATE INDEX `fk_assignations_employee1_idx` ON `assignations` (`evaluated_id` ASC);

CREATE INDEX `fk_assignations_employee2_idx` ON `assignations` (`evaluator_id` ASC);


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NULL,
  `password` TEXT NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `employee_id` INT NULL,
  `campaign_id` INT NULL,
  `company_id` INT NULL,
  `status` ENUM('NEW','PASSWORD') NOT NULL DEFAULT 'NEW',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `area`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `area` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `campaign_id` INT NOT NULL,
  `name` VARCHAR(60) NOT NULL,
  `description` TEXT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_area_campaign1`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_area_campaign1_idx` ON `area` (`campaign_id` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

