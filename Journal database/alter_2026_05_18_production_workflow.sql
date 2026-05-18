ALTER TABLE `tbl_manuscripts`
  ADD COLUMN `production_assigned_to` INT NULL AFTER `assignedEditorId`,
  ADD COLUMN `production_started_at` DATETIME NULL AFTER `production_assigned_to`,
  ADD COLUMN `production_status` VARCHAR(50) NULL AFTER `production_started_at`,
  ADD COLUMN `copyediting_notes` TEXT NULL,
  ADD COLUMN `grammar_checked` TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN `references_checked` TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN `page_numbers` VARCHAR(100) NULL,
  ADD COLUMN `layout_notes` TEXT NULL,
  ADD COLUMN `final_title` VARCHAR(500) NULL,
  ADD COLUMN `final_abstract` TEXT NULL,
  ADD COLUMN `final_keywords` TEXT NULL,
  ADD COLUMN `final_authors` TEXT NULL,
  ADD COLUMN `final_orcid_ids` TEXT NULL,
  ADD COLUMN `corresponding_email` VARCHAR(255) NULL,
  ADD COLUMN `doi_prefix` VARCHAR(50) NULL,
  ADD COLUMN `doi_suffix` VARCHAR(255) NULL,
  ADD COLUMN `full_doi` VARCHAR(255) NULL,
  ADD COLUMN `pub_volume` VARCHAR(20) NULL,
  ADD COLUMN `pub_issue` VARCHAR(20) NULL,
  ADD COLUMN `publication_date` DATE NULL;

CREATE TABLE IF NOT EXISTS `tbl_production_corrections` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `manuscriptId` INT NOT NULL,
  `page_number` VARCHAR(50) NOT NULL,
  `line_number` VARCHAR(50) NOT NULL,
  `correction_comment` TEXT NOT NULL,
  `submitted_by` INT NOT NULL,
  `createdDtm` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
);
