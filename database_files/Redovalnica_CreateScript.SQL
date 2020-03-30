CREATE TABLE IF NOT EXISTS `User`
(
  `UserID` Int NOT NULL AUTO_INCREMENT,
  `CredentialsID` Int,
  `RoleID` Int,
  `Name` Varchar(30) NOT NULL,
  `Surname` Varchar(30) NOT NULL,
  `CreatedOn` Datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastSeen` Datetime,
  `Active` Tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`UserID`)
);

CREATE INDEX `IX_Relationship1` ON `User` (`CredentialsID`);

CREATE INDEX `IX_Relationship2` ON `User` (`RoleID`);

CREATE TABLE IF NOT EXISTS `Credentials`
(
  `CredentialsID` Int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Email` Varchar(255) NOT NULL,
  `Username` Varchar(30),
  `Password` Varchar(64) NOT NULL,
  `Salt` Varchar(64) NOT NULL
);

CREATE TABLE IF NOT EXISTS `Subjects`
(
  `SubjectID` Int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `CreatedBy` Int,
  `Title` Varchar(30) NOT NULL,
  `Shortcode` Char(3) NOT NULL,
  `Active` Tinyint NOT NULL DEFAULT 1
);

CREATE INDEX `IX_Relationship3` ON `Subjects` (`CreatedBy`);

CREATE TABLE IF NOT EXISTS `UserRole`
(
  `RoleID` Int NOT NULL AUTO_INCREMENT,
  `Role` Varchar(30) NOT NULL,
  PRIMARY KEY (`RoleID`)
);

CREATE TABLE IF NOT EXISTS `Lesson`
(
  `LessonID` Int NOT NULL AUTO_INCREMENT,
  `SubjectID` Int,
  `LecturerID` Int,
  `UserID` Int,
  `Start` Time NOT NULL,
  `End` Time NOT NULL,
  `DayOfWeek` Tinyint NOT NULL,
  `Classroom` Varchar(10) DEFAULT '/',
  `Active` Tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`LessonID`)
);

CREATE INDEX `IX_Relationship4` ON `Lesson` (`SubjectID`);

CREATE INDEX `IX_Relationship5` ON `Lesson` (`LecturerID`);

CREATE INDEX `IX_Relationship7` ON `Lesson` (`UserID`);

CREATE TABLE IF NOT EXISTS `Lecturer`
(
  `LecturerID` Int NOT NULL AUTO_INCREMENT,
  `Name` Varchar(30) NOT NULL,
  `Surname` Varchar(30) NOT NULL,
  `Email` Varchar(255),
  PRIMARY KEY (`LecturerID`)
);

CREATE TABLE IF NOT EXISTS `Grades`
(
  `GradeID` Int NOT NULL AUTO_INCREMENT,
  `SubjectID` Int,
  `UserID` Int,
  `Grade` Tinyint NOT NULL,
  `Type` Enum('ustno', 'pisno', 'izdelek') NOT NULL,
  `DateReceived` Datetime DEFAULT CURRENT_TIMESTAMP,
  `Active` Tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`GradeID`)
);

CREATE INDEX `IX_Relationship6` ON `Grades` (`SubjectID`);

CREATE INDEX `IX_Relationship8` ON `Grades` (`UserID`);

CREATE TABLE IF NOT EXISTS `Examinations`
(
  `ExaminationID` Int NOT NULL AUTO_INCREMENT,
  `SubjectID` Int,
  `UserID` Int,
  `Type` Enum('ustno', 'pisno') NOT NULL,
  `Date` Datetime NOT NULL,
  `Active` Tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`ExaminationID`)
);

CREATE INDEX `IX_Relationship9` ON `Examinations` (`UserID`);

CREATE INDEX `IX_Relationship10` ON `Examinations` (`SubjectID`);

CREATE TABLE IF NOT EXISTS `Reminders`
(
  `ReminderID` Int NOT NULL AUTO_INCREMENT,
  `Title` Varchar(30) NOT NULL,
  `Content` Text NOT NULL,
  `CreatedOn` Datetime DEFAULT CURRENT_TIMESTAMP,
  `RemindSecondsBefore` Int DEFAULT 86400,
  `DateUntil` Datetime NOT NULL,
  `UserID` Int,
  PRIMARY KEY (`ReminderID`)
);

CREATE INDEX `IX_Relationship11` ON `Reminders` (`UserID`);

CREATE TABLE IF NOT EXISTS `UnfollowedSubjects`
(
  `SubjectID` Int NOT NULL,
  `UserID` Int NOT NULL
);

ALTER TABLE `UnfollowedSubjects` ADD PRIMARY KEY (`SubjectID`, `UserID`);

ALTER TABLE `User` ADD CONSTRAINT `Has_account` FOREIGN KEY (`CredentialsID`) REFERENCES `Credentials` (`CredentialsID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `User` ADD CONSTRAINT `Has_role_of` FOREIGN KEY (`RoleID`) REFERENCES `UserRole` (`RoleID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `Subjects` ADD CONSTRAINT `Created_subjects` FOREIGN KEY (`CreatedBy`) REFERENCES `User` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `Lesson` ADD CONSTRAINT `Lesson_subject` FOREIGN KEY (`SubjectID`) REFERENCES `Subjects` (`SubjectID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `Lesson` ADD CONSTRAINT `Teaches` FOREIGN KEY (`LecturerID`) REFERENCES `Lecturer` (`LecturerID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `Grades` ADD CONSTRAINT `Graded_at` FOREIGN KEY (`SubjectID`) REFERENCES `Subjects` (`SubjectID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `Lesson` ADD CONSTRAINT `Relationship7` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `Grades` ADD CONSTRAINT `Received_grade` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `Examinations` ADD CONSTRAINT `Will_be_examined` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `Examinations` ADD CONSTRAINT `Examination_at` FOREIGN KEY (`SubjectID`) REFERENCES `Subjects` (`SubjectID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `Reminders` ADD CONSTRAINT `Has_reminders` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `UnfollowedSubjects` ADD CONSTRAINT `Subject_unfollowed` FOREIGN KEY (`SubjectID`) REFERENCES `Subjects` (`SubjectID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `UnfollowedSubjects` ADD CONSTRAINT `User_unfollowed` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
