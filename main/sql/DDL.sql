
# PERSONS STUFF

CREATE TABLE Ministries (
    ministryID int PRIMARY KEY AUTO_INCREMENT,
    name varchar(100)
);

CREATE TABLE Facilities (
    facilityID int PRIMARY KEY AUTO_INCREMENT,
    ministryID int,
    name varchar(100),
    address varchar(100),
    city varchar(100),
    province char(2),
    postalCode varchar(7),
    phoneNumber varchar(14),
    web varchar(200),
    capacity int,
    isManagementHeadOffice bool DEFAULT false,
    isManagementGeneral bool DEFAULT false,
    isSchoolPrimary bool DEFAULT false,
    isSchoolMiddle bool DEFAULT false,
    isSchoolHigh bool DEFAULT false,
    FOREIGN KEY (ministryID) REFERENCES Ministries(ministryID)
);



CREATE TABLE Persons (
    personID int PRIMARY KEY AUTO_INCREMENT,
    firstName varchar(100),
    lastName varchar(100),
    dateOfBirth date,
    medicare varchar(14) NOT NULL UNIQUE , #example:  BOUF 1234 5678
    medicareExpiryDate date,
    phoneNumber varchar(14),    #(514) 262-2822
    address varchar(200),
    city varchar(100),
    province char(2),
    citizenship varchar(50),
    email varchar(200),
    isStudent bool DEFAULT false,
    isEmployee bool DEFAULT false
);

CREATE TABLE EmploymentRoles (
    employmentRoleID int PRIMARY KEY,
    title varchar(100),
    isHead bool DEFAULT false
);

CREATE TABLE Employees (
    personID int,
    facilityID int,
    startDate date,
    endDate date,
    primaryEmploymentRoleID int NOT NULL,
    secondaryEmploymentRoleID int,
    tertiaryEmploymentRoleID int,
    PRIMARY KEY (personID, facilityID, startDate),
    FOREIGN KEY (personID) REFERENCES Persons(personID),
    FOREIGN KEY (facilityID) REFERENCES Facilities(facilityID),
    FOREIGN KEY (primaryEmploymentRoleID) REFERENCES EmploymentRoles(employmentRoleID),
    FOREIGN KEY (secondaryEmploymentRoleID) REFERENCES EmploymentRoles(employmentRoleID),
    FOREIGN KEY (tertiaryEmploymentRoleID) REFERENCES EmploymentRoles(employmentRoleID)
);

CREATE TABLE Schedule (
    workDate date,
    personID int,
    facilityID int,
    startTime int,
    endTime int,
    PRIMARY KEY (personID, facilityID, workDate, startTime),
    FOREIGN KEY (personID, facilityID) REFERENCES Employees(personID, facilityID)
        ON DELETE CASCADE
);



CREATE TABLE Students (
    personID int,
    facilityID int,
    startDate date,
    endDate date,
    grade varchar(50), #eg: secondary 2
    PRIMARY KEY (personID, facilityID, startDate),
    FOREIGN KEY (personID) REFERENCES Persons(personID),
    FOREIGN KEY (facilityID) REFERENCES Facilities(facilityID)
);


# VACCINE AND INFECTION STUFF
CREATE TABLE InfectionTypes(
    infectionTypeID int PRIMARY KEY,
    name varchar(100)
);


CREATE TABLE Infections (
    personID int,
    date date,
    infectionTypeID int,
    PRIMARY KEY (personID, date),
    FOREIGN KEY (infectionTypeID) REFERENCES InfectionTypes(infectionTypeID),
    FOREIGN KEY (personID) REFERENCES Persons(personID)

);


CREATE TABLE VaccinationTypes (
    vaccinationTypeID int PRIMARY KEY,
    name varchar(100)
);

CREATE TABLE Vaccines (
    personID int,
    date date,
    vaccinationTypeID int,
    dose int,
    PRIMARY KEY (personID, date),
    FOREIGN KEY (personID) REFERENCES Persons(personID),
    FOREIGN KEY (vaccinationTypeID) REFERENCES VaccinationTypes(vaccinationTypeID)
);

#Email stuff
CREATE TABLE Emails (
    emailID int,
    emailDate date,
    senderID int,
    receiver varchar(200),
    subject varchar(200),
    emailBody varchar(1000),
    PRIMARY KEY (emailID),
    FOREIGN KEY (senderID) REFERENCES Facilities(facilityID)
);

# TRIGGERS
# helper triggers for Students and Employees
DROP TRIGGER IF EXISTS update_isStudent;
CREATE TRIGGER update_isStudent
    AFTER INSERT ON Students
    FOR EACH ROW BEGIN
        UPDATE Persons
        SET isStudent = true
        WHERE personID = NEW.personID;
    END;

DROP TRIGGER IF EXISTS update_isEmployee;
CREATE TRIGGER update_isEmployee
    AFTER INSERT ON Employees
    FOR EACH ROW BEGIN
        UPDATE Persons
        SET isEmployee = true
        WHERE personID = NEW.personID;
    END;

# Delete all schedules of an employee if the employee's employment endDate is updated to no longer be null.  Any schedules after that date are deleted
DROP TRIGGER IF EXISTS DeleteSchedulesOnEndDateUpdate;
CREATE TRIGGER DeleteSchedulesOnEndDateUpdate
AFTER UPDATE ON Employees
FOR EACH ROW
BEGIN
    IF NEW.endDate IS NOT NULL AND OLD.endDate IS NULL THEN
        DELETE FROM Schedule
        WHERE personID = NEW.personID
          AND facilityID = NEW.facilityID
          AND workDate > NEW.endDate;
    END IF;
END;





