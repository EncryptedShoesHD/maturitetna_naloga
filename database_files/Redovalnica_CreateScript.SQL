/*
Created: 2/27/2020
Modified: 2/29/2020
Model: MySQL 8.0
Database: MySQL 8.0
*/

-- Create tables section -------------------------------------------------

-- Table User

CREATE TABLE `User`
(
  `UserID` Int NOT NULL AUTO_INCREMENT,
  `CredentialsID` Int,
  `RoleID` Int,
  `Name` Varchar(30) NOT NULL,
  `Surname` Varchar(30) NOT NULL,
  `CreatedOn` Datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastSeen` Datetime,
  `Active` Bool NOT NULL DEFAULT 1,
  PRIMARY KEY (`UserID`)
)
;

CREATE INDEX `IX_Relationship1` ON `User` (`CredentialsID`)
;

CREATE INDEX `IX_Relationship2` ON `User` (`RoleID`)
;

-- Table Credentials

CREATE TABLE `Credentials`
(
  `CredentialsID` Int NOT NULL AUTO_INCREMENT,
  `Email` Varchar(255) NOT NULL,
  `Username` Varchar(30),
  `Password` Varchar(64) NOT NULL,
  PRIMARY KEY (`CredentialsID`)
)
;

-- Table Subjects

CREATE TABLE `Subjects`
(
  `SubjectID` Int NOT NULL,
  `CreatedBy` Int,
  `Title` Varchar(30) NOT NULL,
  `Shortcode` Char(3) NOT NULL,
  `Active` Bool NOT NULL DEFAULT 1
)
;

CREATE INDEX `IX_Relationship3` ON `Subjects` (`CreatedBy`)
;

ALTER TABLE `Subjects` ADD PRIMARY KEY (`SubjectID`)
;

-- Table UserRole

CREATE TABLE `UserRole`
(
  `RoleID` Int NOT NULL AUTO_INCREMENT,
  `Role` Varchar(30) NOT NULL,
  PRIMARY KEY (`RoleID`)
)
;

-- Table Lesson

CREATE TABLE `Lesson`
(
  `LessonID` Int NOT NULL AUTO_INCREMENT,
  `SubjectID` Int,
  `LecturerID` Int,
  `UserID` Int,
  `Start` Time NOT NULL,
  `End` Time NOT NULL,
  `DayOfWeek` Tinyint NOT NULL,
  `Classroom` Varchar(10) DEFAULT /,
  `Active` Bool NOT NULL DEFAULT 1,
  PRIMARY KEY (`LessonID`)
)
;

CREATE INDEX `IX_Relationship4` ON `Lesson` (`SubjectID`)
;

CREATE INDEX `IX_Relationship5` ON `Lesson` (`LecturerID`)
;

CREATE INDEX `IX_Relationship7` ON `Lesson` (`UserID`)
;

-- Table Lecturer

CREATE TABLE `Lecturer`
(
  `LecturerID` Int NOT NULL AUTO_INCREMENT,
  `Name` Varchar(30) NOT NULL,
  `Surname` Varchar(30) NOT NULL,
  `Email` Varchar(255),
  PRIMARY KEY (`LecturerID`)
)
;

-- Table Grades

CREATE TABLE `Grades`
(
  `GradeID` Int NOT NULL AUTO_INCREMENT,
  `SubjectID` Int,
  `UserID` Int,
  `Grade` Tinyint NOT NULL,
  `Type` Enum('ustno', 'pisno', 'izdelek') NOT NULL,
  `DateReceived` Datetime DEFAULT CURRENT_TIMESTAMP,
  `Active` Bool NOT NULL DEFAULT 1,
  PRIMARY KEY (`GradeID`)
)
;

CREATE INDEX `IX_Relationship6` ON `Grades` (`SubjectID`)
;

CREATE INDEX `IX_Relationship8` ON `Grades` (`UserID`)
;

-- Table Examinations

CREATE TABLE `Examinations`
(
  `ExaminationID` Int NOT NULL AUTO_INCREMENT,
  `SubjectID` Int,
  `UserID` Int,
  `Type` Enum('ustno', 'pisno') NOT NULL,
  `Date` Datetime NOT NULL,
  `Active` Bool NOT NULL DEFAULT 1,
  PRIMARY KEY (`ExaminationID`)
)
;

CREATE INDEX `IX_Relationship9` ON `Examinations` (`UserID`)
;

CREATE INDEX `IX_Relationship10` ON `Examinations` (`SubjectID`)
;

-- Table Reminders

CREATE TABLE `Reminders`
(
  `ReminderID` Int NOT NULL AUTO_INCREMENT,
  `Title` Varchar(30) NOT NULL,
  `Content` Text NOT NULL,
  `CreatedOn` Char(20) DEFAULT CURRENT_TIMESTAMP,
  `RemindSecondsBefore` Int DEFAULT 86400,
  `DateUntil` Datetime NOT NULL,
  `UserID` Int,
  PRIMARY KEY (`ReminderID`)
)
;

CREATE INDEX `IX_Relationship11` ON `Reminders` (`UserID`)
;

-- Table UnfollowedSubjects

CREATE TABLE `UnfollowedSubjects`
(
  `SubjectID` Int NOT NULL,
  `UserID` Int NOT NULL
)
;

ALTER TABLE `UnfollowedSubjects` ADD PRIMARY KEY (`SubjectID`, `UserID`)
;

-- Create foreign keys (relationships) section -------------------------------------------------

ALTER TABLE `User` ADD CONSTRAINT `Has_account` FOREIGN KEY (`CredentialsID`) REFERENCES `Credentials` (`CredentialsID`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `User` ADD CONSTRAINT `Has_role_of` FOREIGN KEY (`RoleID`) REFERENCES `UserRole` (`RoleID`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Subjects` ADD CONSTRAINT `Created_subjects` FOREIGN KEY (`CreatedBy`) REFERENCES `User` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Lesson` ADD CONSTRAINT `Lesson_subject` FOREIGN KEY (`SubjectID`) REFERENCES `Subjects` (`SubjectID`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Lesson` ADD CONSTRAINT `Teaches` FOREIGN KEY (`LecturerID`) REFERENCES `Lecturer` (`LecturerID`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Grades` ADD CONSTRAINT `Graded_at` FOREIGN KEY (`SubjectID`) REFERENCES `Subjects` (`SubjectID`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Lesson` ADD CONSTRAINT `Relationship7` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Grades` ADD CONSTRAINT `Received_grade` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Examinations` ADD CONSTRAINT `Will_be_examined` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Examinations` ADD CONSTRAINT `Examination_at` FOREIGN KEY (`SubjectID`) REFERENCES `Subjects` (`SubjectID`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Reminders` ADD CONSTRAINT `Has_reminders` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `UnfollowedSubjects` ADD CONSTRAINT `Subject_unfollowed` FOREIGN KEY (`SubjectID`) REFERENCES `Subjects` (`SubjectID`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `UnfollowedSubjects` ADD CONSTRAINT `User_unfollowed` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT
;


