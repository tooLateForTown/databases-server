
# PERSONS STUFF

CREATE TABLE Ministries (
    ministryID int PRIMARY KEY,
    name varchar(100)
);

CREATE TABLE Facilities (
    facilityID int PRIMARY KEY,
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
    personID int PRIMARY KEY,
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
    email varchar(200)
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

