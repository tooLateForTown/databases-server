# Create Ministries and Facilities
INSERT INTO Ministries (ministryId, name) VALUES (1,'Ministry of Education Quebec');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementGeneral)
VALUES (1,1,'Management Montréal Branch','1200 Blvd. Saint-Laurent','Montréal','QC','H197B2','514-222-2222','www.montreal.educanada.ca',2000,true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (2,1,'Management Head Office','999 Ste-Catherine','Montréal','QC','H197B2','514-222-2222','www.montreal.educanada.ca',2000,true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isSchoolMiddle, isSchoolHigh)
VALUES (3,1,'Laval Secondary School','1200 Blvd. Saint-Laurent','Laval','QC','H197B2','514-222-2222','laval.montreal.educanada.ca',2000,true,true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isSchoolPrimary)
VALUES (4,1,'Rosemont Elementary School','100 Some Stree','Rosemont','QC','P197B2','514-222-4444','rosemont.montreal.educanada.ca',1000,true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isSchoolPrimary)
VALUES (5,1,'Westmount High School','120 Grosvenor','Westmount','QC','O197B2','514-212-4444','westmount.montreal.educanada.ca',40,false);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isSchoolPrimary)
VALUES (6,1,'John Rennie High School','120 I gorget','Pointe Claire','QC','T197B2','514-2s2-4444','rennie.montreal.educanada.ca',40,false);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isSchoolPrimary)
VALUES (7,1,'Evangeline','100 l\'Acadie','Montreal','QC','H8I1P0','514-212-4444','evangeline.montreal.educanada.ca',40,false);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isSchoolPrimary)
VALUES (8,1,'Evergreen Elementary','1000 Woodsy Street','Saint Lazazre','QC','J7T3P5','514-212-4444','evergreen.montreal.educanada.ca',40,true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isSchoolPrimary)
VALUES (9,1,'Hogwarts Elementary','100 Privet Druve','Laval','QC','J7T3P5','514-212-4444','hogwarts.montreal.educanada.ca',40,true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isSchoolPrimary)
VALUES (10,1,'St. Thomas High School','23937 Streetname street','Pointe Claire','QC','J7T3P5','514-212-4444','stthomas.montreal.educanada.ca',40,false);

#Ontario
INSERT INTO Ministries (ministryId, name) VALUES (2,'Ministry of Education Ontario');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (11, 2,'Ontario Ministry Head Office','999 Ste-Catherine','Toronto','ON','H197B2','514-222-2222','www.montreal.educanada.ca',2000,true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (12, 2, 'Health Center Calgary', '789 Oak Street', 'Calgary', 'AB', 'T2P 3E8', '403-333-3333', 'www.healthcentercalgary.ca', 400);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (13, 2, 'Health Center Calgary', '789 Oak Street', 'Calgary', 'AB', 'T2P 3E8', '403-333-3333', 'www.healthcentercalgary.ca', 400);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (14, 2, 'Health Center Vancouver', '456 Elm Street', 'Vancouver', 'BC', 'V6C 1H2', '604-222-2222', 'www.healthcentervancouver.ca', 300);

#Alberta
INSERT INTO Ministries (ministryId, name) VALUES (3,'Ministry of Education Alberta');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (100, 3, 'Management Alberta Head Office', '100 Main Street', 'Calgary', 'AB', 'T1X 1Y1', '403-111-1111', 'www.alberta.educanada.ca', 2000, true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (101, 3, 'Calgary Elementary School', '200 Elm Avenue', 'Calgary', 'AB', 'T2X 2Y2', '403-222-2222', 'www.calgaryelementary.ab.ca', 500);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (102, 3, 'Calgary Secondary School', '300 Oak Street', 'Calgary', 'AB', 'T3X 3Y3', '403-333-3333', 'www.calgarysecondary.ab.ca', 800);

#-- British Columbia (BC)
INSERT INTO Ministries (ministryId, name) VALUES (4,'Ministry of Education British Columbia');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (200, 4, 'Management British Columbia Head Office', '400 First Avenue', 'Vancouver', 'BC', 'V1X 1Z1', '604-111-1111', 'www.britishcolumbia.educanada.ca', 2000, true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (201, 4, 'Vancouver Elementary School', '500 Maple Road', 'Vancouver', 'BC', 'V2X 2Z2', '604-222-2222', 'www.vancouverschool.bc.ca', 600);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (202, 4, 'Vancouver Secondary School', '600 Cedar Street', 'Vancouver', 'BC', 'V3X 3Z3', '604-333-3333', 'www.vancouversecondary.bc.ca', 900);

#-- Manitoba (MB)
INSERT INTO Ministries (ministryId, name) VALUES (5,'Ministry of Education Manitoba');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (300, 5, 'Management Manitoba Head Office', '700 Second Avenue', 'Winnipeg', 'MB', 'R1X 1A1', '204-111-1111', 'www.manitoba.educanada.ca', 2000, true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (301, 5, 'Winnipeg Elementary School', '800 Birch Street', 'Winnipeg', 'MB', 'R2X 2A2', '204-222-2222', 'www.winnipegschool.mb.ca', 700);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (302, 5, 'Winnipeg Secondary School', '900 Spruce Avenue', 'Winnipeg', 'MB', 'R3X 3A3', '204-333-3333', 'www.winnipegsecondary.mb.ca', 1000);

-- Newfoundland and Labrador (NL)
INSERT INTO Ministries (ministryId, name) VALUES (6,'Ministry of Education Newfoundalnd Labrador');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (400, 6, 'Management Newfoundland and Labrador Head Office', '1000 Water Street', 'St. John''s', 'NL', 'A1X 1B1', '709-111-1111', 'www.newfoundland.educanada.ca', 2000, true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (401, 6, 'St. John''s Elementary School', '1100 Pine Road', 'St. John''s', 'NL', 'A2X 2B2', '709-222-2222', 'www.stjohnsschool.nl.ca', 400);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (402, 6, 'St. John''s Secondary School', '1200 Oak Avenue', 'St. John''s', 'NL', 'A3X 3B3', '709-333-3333', 'www.stjohnssecondary.nl.ca', 800);

-- Nova Scotia (NS)
INSERT INTO Ministries (ministryId, name) VALUES (7,'Ministry of Education Nova Scotia');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (500, 7, 'Management Nova Scotia Head Office', '1300 Main Street', 'Halifax', 'NS', 'B1X 1C1', '902-111-1111', 'www.novascotia.educanada.ca', 2000, true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (501, 7, 'Halifax Elementary School', '1400 Elm Road', 'Halifax', 'NS', 'B2X 2C2', '902-222-2222', 'www.halifaxschool.ns.ca', 500);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (502, 7, 'Halifax Secondary School', '1500 Oak Street', 'Halifax', 'NS', 'B3X 3C3', '902-333-3333', 'www.halifaxsecondary.ns.ca', 900);

# -- Ontario (ON)
# INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
# VALUES (16, 1, 'Management Ontario Head Office', '1600 Yonge Street', 'Toronto', 'ON', 'M1X 1D1', '416-111-1111', 'www.ontario.educanada.ca', 2000, true);
#
# INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
# VALUES (17, 1, 'Toronto Elementary School', '1700 Maple Avenue', 'Toronto', 'ON', 'M2X 2D2', '416-222-2222', 'www.torontoschool.on.ca', 600);
#
# INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
# VALUES (18, 1, 'Toronto Secondary School', '1800 Cedar Road', 'Toronto', 'ON', 'M3X 3D3', '416-333-3333', 'www.torontosecondary.on.ca', 1000);

-- Prince Edward Island (PE)
INSERT INTO Ministries (ministryId, name) VALUES (8,'Ministry of Education PEI');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (600, 8, 'Management Prince Edward Island Head Office', '1900 Park Street', 'Charlottetown', 'PE', 'C1X 1E1', '902-111-1111', 'www.princeedwardisland.educanada.ca', 2000, true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (601, 8, 'Charlottetown Elementary School', '2000 Elm Road', 'Charlottetown', 'PE', 'C2X 2E2', '902-222-2222', 'www.charlottetownschool.pe.ca', 400);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (602, 8, 'Charlottetown Secondary School', '2100 Oak Avenue', 'Charlottetown', 'PE', 'C3X 3E3', '902-333-3333', 'www.charlottetownsecondary.pe.ca', 800);


-- Saskatchewan (SK)
INSERT INTO Ministries (ministryId, name) VALUES (9,'Ministry of Education Saskatchewan');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (700, 9, 'Management Saskatchewan Head Office', '2500 Main Street', 'Saskatoon', 'SK', 'S1X 1G1', '306-111-1111', 'www.saskatchewan.educanada.ca', 2000, true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (701, 9, 'Saskatoon Elementary School', '2600 Elm Avenue', 'Saskatoon', 'SK', 'S2X 2G2', '306-222-2222', 'www.saskatoonschool.sk.ca', 600);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (702, 9, 'Saskatoon Secondary School', '2700 Cedar Street', 'Saskatoon', 'SK', 'S3X 3G3', '306-333-3333', 'www.saskatoonsecondary.sk.ca', 1000);



INSERT INTO EmploymentRoles (employmentRoleID, title, isHead) VALUES (1,'President',true);
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (2,'Secretary');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (3,'Specialized Personnel');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (4,'Security Personnel');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (5,'Other Personnel');
INSERT INTO EmploymentRoles (employmentRoleID, title, isHead) VALUES (10,'Principle', true);
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (11,'Teacher, Elementary');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (12,'Teacher, Secondary');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (13,'Math');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (14,'English');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (15,'School Counselor');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (16,'Program Director');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (17,'Administrator');

#People
# School personnel
INSERT INTO Persons (personID, firstName, lastName, medicare) VALUES (1,'Khaled','Jabobo','KJAB 0000 1111');
INSERT INTO Employee(personID, facilityID, startDate, primaryEmploymentRoleID, secondaryEmploymentRoleID, tertiaryEmploymentRoleID)
    VALUES (1,3,'2020-01-01',12,13,15);
INSERT INTO Persons (personID, firstName, lastName, medicare) VALUES (2,'Captain','Underpants','CUND 0000 1111');
INSERT INTO Employee(personID, facilityID, startDate, primaryEmploymentRoleID)
    VALUES (2,3,'2020-01-01',10);
INSERT INTO Persons (personID, firstName, lastName, medicare) VALUES (4,'Roger','Smith','RSMI 2827 2282');
INSERT INTO Employee(personID, facilityID, startDate, primaryEmploymentRoleID, endDate)
    VALUES (4,4,'2022-01-15',11, '2022-09-15');
INSERT INTO Employee(personID, facilityID, startDate, primaryEmploymentRoleID, endDate)
    VALUES (4,3,'2022-09-16',12, '2023-02-15');
INSERT INTO Employee(personID, facilityID, startDate, primaryEmploymentRoleID)
    VALUES (4,4,'2023-02-16',11);


# Minsters
INSERT INTO Persons (personID, firstName, lastName, medicare) VALUES (3,'Bernanrd','Drainville','BDRA 0000 1111');
INSERT INTO Employee(personID, facilityID, startDate, primaryEmploymentRoleID)
    VALUES (3,2,'2018-01-01',1);
INSERT INTO Persons (personID, firstName, lastName, medicare) VALUES (6,'Joe','Ontario','JONT 2922 1111');
INSERT INTO Employee(personID, facilityID, startDate, primaryEmploymentRoleID)
    VALUES (6,11,'2022-08-09',1);



# Mintstry Workers
INSERT INTO Persons (personID, firstName, lastName, medicare) VALUES (5,'Alfred','McDonaold>','AMCK 2922 1111');
INSERT INTO Employee(personID, facilityID, startDate, primaryEmploymentRoleID)
    VALUES (5,2,'1999-01-01',2);


# INFECTION Stuff
# Vaccine Types
INSERT INTO VaccinationTypes VALUE (1,'Pfizer');
INSERT INTO VaccinationTypes VALUE (2,'Moderna');
INSERT INTO VaccinationTypes VALUE (3,'AstraZeneca');
INSERT INTO VaccinationTypes VALUE (4,'Johnson & Johnson');

# Infections
INSERT INTO Infections (personID, date, type) VALUES (1,'2021-07-29', 'COVID-19');
INSERT INTO Infections (personID, date, type) VALUES (2,'2020-01-22', 'SARS-Cov-2 Variant');

#vaccines
INSERT INTO Vaccinations (personID, date, vaccinationTypeID,dose) VALUES (1,'2020-01-30', 1, 1);
INSERT INTO Vaccinations (personID, date, vaccinationTypeID,dose) VALUES (1,'2021-01-30', 3, 2);
INSERT INTO Vaccinations (personID, date, vaccinationTypeID,dose) VALUES (5,'2021-01-20', 1, 1);
INSERT INTO Vaccinations (personID, date, vaccinationTypeID,dose) VALUES (5,'2022-03-25', 2, 2);




