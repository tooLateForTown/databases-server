
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
    postalCode char(6),
    phoneNumber varchar(12),
    web varchar(200),
    capacity int,
    isManagement bool,
    FOREIGN KEY (ministryID) REFERENCES Ministries(ministryID)
);

CREATE TABLE Persons (
    personID int PRIMARY KEY AUTO_INCREMENT,
    firstName varchar(100),
    lastName varchar(100)
);

CREATE TABLE Employees (
    personID int,
    facilityID int,
    PRIMARY KEY (personID, facilityID),
    FOREIGN KEY (personID) REFERENCES Persons(personID),
    FOREIGN KEY (facilityID) REFERENCES Ministries(ministryID)
);

CREATE TABLE Students (
    personID int,
    facilityID int,
    PRIMARY KEY (personID, facilityID),
    FOREIGN KEY (personID) REFERENCES Persons(personID),
    FOREIGN KEY (facilityID) REFERENCES Ministries(ministryID)
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