# Create Ministries and Facilities
INSERT INTO Ministries (name) VALUES ('Ministry of Education');  #ministryID=1
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementGeneral)
VALUES (1,1,'Management Montréal Branch','1200 Blvd. Saint-Laurent','Montréal','QC','H197B2','514-222-2222','www.montreal.educanada.ca',2000,true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (2,1,'Management Head Office','999 Ste-Catherine','Montréal','QC','H197B2','514-222-2222','www.montreal.educanada.ca',2000,true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isSchoolMiddle, isSchoolHigh)
VALUES (3,1,'Laval Secondary School','1200 Blvd. Saint-Laurent','Laval','QC','H197B2','514-222-2222','laval.montreal.educanada.ca',2000,true,true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isSchoolPrimary)
VALUES (4,1,'Rosemont Elementary School','100 Some Stree','Rosemont','QC','P197B2','514-222-4444','rosemont.montreal.educanada.ca',1000,true);

INSERT INTO EmploymentRoles (employmentRoleID, title, isHead) VALUES (1,'President',true);
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (2,'Secretary');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (3,'Specialized Personnel');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (4,'Security Personnel');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (5,'Other Personnel');
INSERT INTO EmploymentRoles (employmentRoleID, title, isHead) VALUES (10,'Principle', true);
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (11,'Teacher, Elementary');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (12,'Teacher, Secondary Math');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (13,'Teacher, Secondary Science');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (14,'School Counselor');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (15,'Program Director');
INSERT INTO EmploymentRoles (employmentRoleID, title) VALUES (16,'Administrator');




