# Create Ministries and Facilities
INSERT INTO Ministries (name) VALUES ('Ministry of Education');  #ministryID=1
INSERT INTO Facilities (ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagement)
VALUES (1,'Management Montréal Branch','1200 Blvd. Saint-Laurent','Montréal','QC','H197B2','514-222-2222','www.montreal.educanada.ca',2000,true);
INSERT INTO Facilities (ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagement)
VALUES (1,'Education Montréal Branch','1200 Blvd. Saint-Laurent','Montréal','QC','H197B2','514-222-2222','www.montreal.educanada.ca',2000,false);
INSERT INTO Facilities (ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagement)
VALUES (1,'Rosemont Elementary School','100 Some Stree','Rosemont','QC','P197B2','514-222-4444','rosemont.montreal.educanada.ca',1000,false);

