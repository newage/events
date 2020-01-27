-- -----------------------------------------------------
-- Table `tasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(15) NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `dt_created` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `t_name_idx` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `entities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `entities` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(15) NULL,
  `owner_id` INT UNSIGNED NOT NULL,
  `external_id` INT UNSIGNED NOT NULL,
  `dt_created` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `e_name_idx` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tasks_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tasks_log` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `task_id` INT UNSIGNED NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `entity_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tl_tasks_idx` (`task_id` ASC),
  INDEX `fk_tl_entities_idx` (`entity_id` ASC),
  INDEX `tl_search_idx` (`user_id` ASC, `entity_id` ASC),
  CONSTRAINT `fk_tl_tasks`
    FOREIGN KEY (`task_id`)
        REFERENCES `tasks` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
  CONSTRAINT `fk_tl_entities`
    FOREIGN KEY (`entity_id`)
        REFERENCES `entities` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `entity_properties`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `entity_properties` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `entity_id` INT UNSIGNED NOT NULL,
  `property_name` VARCHAR(20) NULL,
  `property_value` VARCHAR(45) NULL,
  `task_id` INT UNSIGNED NOT NULL,
  `tasks_sum` INT NOT NULL,
  `description` VARCHAR(255) NULL,
  `dt_created` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_ep_entity_idx` (`entity_id` ASC),
  INDEX `fk_ep_tasks_idx` (`task_id` ASC),
  CONSTRAINT `fk_ep_entity`
    FOREIGN KEY (`entity_id`)
        REFERENCES `entities` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
  CONSTRAINT `fk_ep_tasks`
    FOREIGN KEY (`task_id`)
        REFERENCES `tasks` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `events_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_log` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `property_id` INT UNSIGNED NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `entity_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_el_entity_idx` (`entity_id` ASC),
  INDEX `fk_el_entity_property_idx` (`property_id` ASC),
  INDEX `el_search_idx` (`user_id` ASC, `entity_id` ASC),
  CONSTRAINT `fk_el_entity`
     FOREIGN KEY (`entity_id`)
         REFERENCES `entities` (`id`)
         ON DELETE CASCADE
         ON UPDATE CASCADE,
  CONSTRAINT `fk_el_entity_property`
     FOREIGN KEY (`property_id`)
         REFERENCES `entity_properties` (`id`)
         ON DELETE CASCADE
         ON UPDATE CASCADE)
ENGINE = InnoDB;