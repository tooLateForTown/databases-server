# Create Ministries and Facilities
INSERT INTO Ministries (name) VALUES ('Ministry of Education');  #ministryID=1
INSERT INTO Facilities (ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementGeneral)
VALUES (1,'Management Montréal Branch','1200 Blvd. Saint-Laurent','Montréal','QC','H197B2','514-222-2222','www.montreal.educanada.ca',2000,true);
INSERT INTO Facilities (ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (1,'Management Head Office','999 Ste-Catherine','Montréal','QC','H197B2','514-222-2222','www.montreal.educanada.ca',2000,true);
INSERT INTO Facilities (ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isSchoolMiddle, isSchoolHigh)
VALUES (1,'Laval Secondary School','1200 Blvd. Saint-Laurent','Laval','QC','H197B2','514-222-2222','laval.montreal.educanada.ca',2000,true,true);
INSERT INTO Facilities (ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isSchoolPrimary)
VALUES (1,'Rosemont Elementary School','100 Some Stree','Rosemont','QC','P197B2','514-222-4444','rosemont.montreal.educanada.ca',1000,true);

