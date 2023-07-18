
# PERSONS STUFF

CREATE TABLE Ministries (
    ministryID int PRIMARY KEY AUTO_INCREMENT,
    name varchar(100)
);

CREATE TABLE Facilities (
    facilityID int PRIMARY KEY,
    ministryID int,
    name varchar(100),
    address varchar(100),
    city varchar(100),
    province char(2),
    postalCode char(6),
    phoneNumber varchar(12),
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
    telephone varchar(14),    #(514) 262-2822
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

CREATE TABLE EmploymentContract (
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
    FOREIGN KEY (primaryEmploymentRoleID) REFERENCES EmploymentRoles(employmentRoleID),
    FOREIGN KEY (primaryEmploymentRoleID) REFERENCES EmploymentRoles(employmentRoleID)
);

CREATE TABLE EnrollmentContract (
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

CREATE TABLE VaccinationTypes (
    vaccinationTypeID int PRIMARY KEY AUTO_INCREMENT,
    name varchar(100)
);

CREATE TABLE Vaccinations (
    vaccincationID int PRIMARY KEY AUTO_INCREMENT,
    date date,
    vaccinationTypeID int,
    dose decimal(6,2),
    dosageNumber int,
    personID int,
    FOREIGN KEY (personID) REFERENCES Persons(personID),
    FOREIGN KEY (vaccinationTypeID) REFERENCES VaccinationTypes(vaccinationTypeID)
);