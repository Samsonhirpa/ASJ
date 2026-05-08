-- Editor-in-Chief technical and scope screening fields.
-- Apply only the ALTER statements for columns that are missing in your existing ASJ database.
-- This file intentionally contains ALTER SQL only; do not re-import the full database dump.

ALTER TABLE `tbl_manuscripts`
    ADD COLUMN `screeningStatus` ENUM('pending','passed','failed') DEFAULT 'pending' AFTER `status`;

ALTER TABLE `tbl_manuscripts`
    ADD COLUMN `screeningNotes` TEXT DEFAULT NULL AFTER `screeningStatus`;

ALTER TABLE `tbl_manuscripts`
    ADD COLUMN `decisionLetter` TEXT DEFAULT NULL AFTER `screeningNotes`;

ALTER TABLE `tbl_manuscripts`
    ADD COLUMN `assignedEditorId` INT(11) DEFAULT NULL AFTER `correspondingAuthorId`;

ALTER TABLE `tbl_manuscripts`
    ADD COLUMN `technicalScreeningNotes` TEXT DEFAULT NULL AFTER `screeningNotes`;

ALTER TABLE `tbl_manuscripts`
    ADD COLUMN `scopeScreeningNotes` TEXT DEFAULT NULL AFTER `technicalScreeningNotes`;

ALTER TABLE `tbl_manuscripts`
    ADD COLUMN `eicScreeningDecision` ENUM('pending','accepted','rejected') DEFAULT 'pending' AFTER `scopeScreeningNotes`;

ALTER TABLE `tbl_manuscripts`
    ADD COLUMN `eicScreenedBy` INT(11) DEFAULT NULL AFTER `eicScreeningDecision`;

ALTER TABLE `tbl_manuscripts`
    ADD COLUMN `eicScreenedDtm` DATETIME DEFAULT NULL AFTER `eicScreenedBy`;
