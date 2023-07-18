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
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (77, 1, 'Québec City Middle School', '7700 Maple Road', 'Québec City', 'QC', 'G1X1Y1', '418-222-2222', 'www.quebeccitymiddleschool.qc.ca', 500);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (78, 1, 'Sherbrooke High School', '7800 Cedar Road', 'Sherbrooke', 'QC', 'G2X2Z2', '819-333-3333', 'www.sherbrookehigh.qc.ca', 1000);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (79, 1, 'Trois-Rivières Elementary School', '7900 Elm Avenue', 'Trois-Rivières', 'QC', 'G3X3B3', '819-444-4444', 'www.troisriviereselementary.qc.ca', 500);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (80, 1, 'Gatineau Secondary School', '8000 Pine Road', 'Gatineau', 'QC', 'G4X4C4', '819-555-5555', 'www.gatineausecondary.qc.ca', 900);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (81, 1, 'Drummondville Middle School', '8100 Elm Road', 'Drummondville', 'QC', 'G5X5D5', '819-666-6666', 'www.drummondvillemiddle.qc.ca', 600);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (82, 1, 'Saint-Jean-sur-Richelieu High School', '8200 Cedar Road', 'Saint-Jean-sur-Richelieu', 'QC', 'G6X6Z6', '450-777-7777', 'www.saintjeansurrichelieuhigh.qc.ca', 1200);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (83, 1, 'Rimouski Elementary School', '8300 Pine Avenue', 'Rimouski', 'QC', 'G7X7A7', '418-888-8888', 'www.rimouskielementary.qc.ca', 400);


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

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (163, 2, 'Toronto Middle School', '6300 Elm Avenue', 'Toronto', 'ON', 'M1X1Y1', '416-222-2222', 'www.torontomiddleschool.on.ca', 600);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (164, 2, 'Ottawa High School', '6400 Oak Road', 'Ottawa', 'ON', 'M2X2Z2', '613-333-3333', 'www.ottawahigh.on.ca', 1200);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (165, 2, 'Mississauga Elementary School', '6500 Pine Road', 'Mississauga', 'ON', 'M3X3B3', '905-444-4444', 'www.mississaugaelementary.on.ca', 500);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (166, 2, 'Brampton Secondary School', '6600 Cedar Road', 'Brampton', 'ON', 'M4X4C4', '905-555-5555', 'www.bramptonsecondary.on.ca', 1000);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (167, 2, 'Hamilton Middle School', '6700 Elm Road', 'Hamilton', 'ON', 'M5X5D5', '905-666-6666', 'www.hamiltonmiddle.on.ca', 700);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (168, 2, 'London High School', '6800 Pine Road', 'London', 'ON', 'M6X6Z6', '519-777-7777', 'www.londonhigh.on.ca', 1100);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (169, 2, 'Windsor Elementary School', '6900 Cedar Road', 'Windsor', 'ON', 'M7X7A7', '519-888-8888', 'www.windsorelementary.on.ca', 400);


#Alberta
INSERT INTO Ministries (ministryId, name) VALUES (3,'Ministry of Education Alberta');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (100, 3, 'Management Alberta Head Office', '100 Main Street', 'Calgary', 'AB', 'T1X 1Y1', '403-111-1111', 'www.alberta.educanada.ca', 2000, true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (101, 3, 'Calgary Elementary School', '200 Elm Avenue', 'Calgary', 'AB', 'T2X 2Y2', '403-222-2222', 'www.calgaryelementary.ab.ca', 500);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (102, 3, 'Calgary Secondary School', '300 Oak Street', 'Calgary', 'AB', 'T3X 3Y3', '403-333-3333', 'www.calgarysecondary.ab.ca', 800);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (128, 1, 'Edmonton Middle School', '2800 Elm Street', 'Edmonton', 'AB', 'T4X4Y4', '780-444-4444', 'www.edmontonmiddle.ab.ca', 400);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (129, 3, 'Calgary High School', '2900 Oak Road', 'Calgary', 'AB', 'T5X5Y5', '403-555-5555', 'www.calgaryhigh.ab.ca', 1000);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (130, 3, 'Banff Elementary School', '3000 Pine Avenue', 'Banff', 'AB', 'T6X6Z6', '403-666-6666', 'www.banffelementary.ab.ca', 500);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (131, 3, 'Fort McMurray Secondary School', '3100 Cedar Road', 'Fort McMurray', 'AB', 'T7X7A7', '780-777-7777', 'www.fortmcmurraysecondary.ab.ca', 900);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (132, 3, 'Lethbridge Middle School', '3200 Birch Avenue', 'Lethbridge', 'AB', 'T8X8B8', '403-888-8888', 'www.lethbridgemiddle.ab.ca', 600);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (133, 3, 'Red Deer High School', '3300 Oak Street', 'Red Deer', 'AB', 'T9X9C9', '403-999-9999', 'www.reddeerhigh.ab.ca', 1100);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (134, 3, 'Grande Prairie Elementary School', '3400 Elm Road', 'Grande Prairie', 'AB', 'T0X0D0', '780-123-4567', 'www.grandprairieelementary.ab.ca', 400);


#-- British Columbia (BC)
INSERT INTO Ministries (ministryId, name) VALUES (4,'Ministry of Education British Columbia');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (200, 4, 'Management British Columbia Head Office', '400 First Avenue', 'Vancouver', 'BC', 'V1X 1Z1', '604-111-1111', 'www.britishcolumbia.educanada.ca', 2000, true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (201, 4, 'Vancouver Elementary School', '500 Maple Road', 'Vancouver', 'BC', 'V2X 2Z2', '604-222-2222', 'www.vancouverschool.bc.ca', 600);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (202, 4, 'Vancouver Secondary School', '600 Cedar Street', 'Vancouver', 'BC', 'V3X 3Z3', '604-333-3333', 'www.vancouversecondary.bc.ca', 900);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (35, 1, 'Vancouver Middle School', '3500 Maple Street', 'Vancouver', 'BC', 'V1X1Y1', '604-222-2222', 'www.vancouvermiddle.bc.ca', 500);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (236, 4, 'Victoria High School', '3600 Cedar Road', 'Victoria', 'BC', 'V2X2Z2', '250-333-3333', 'www.victoriahigh.bc.ca', 900);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (237, 4, 'Kelowna Elementary School', '3700 Elm Avenue', 'Kelowna', 'BC', 'V3X3B3', '250-444-4444', 'www.kelownaelementary.bc.ca', 600);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (238, 4, 'Abbotsford Secondary School', '3800 Oak Street', 'Abbotsford', 'BC', 'V4X4C4', '604-555-5555', 'www.abbotsfordsecondary.bc.ca', 1000);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (239, 4, 'Prince George Middle School', '3900 Pine Road', 'Prince George', 'BC', 'V5X5D5', '250-666-6666', 'www.princegeorgemiddle.bc.ca', 700);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (240, 4, 'Nanaimo High School', '4000 Elm Avenue', 'Nanaimo', 'BC', 'V6X6Z6', '250-777-7777', 'www.nanaimohigh.bc.ca', 1200);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (241, 4, 'Kamloops Elementary School', '4100 Cedar Road', 'Kamloops', 'BC', 'V7X7A7', '250-888-8888', 'www.kamloopselementary.bc.ca', 400);

#-- Manitoba (MB)
INSERT INTO Ministries (ministryId, name) VALUES (5,'Ministry of Education Manitoba');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (300, 5, 'Management Manitoba Head Office', '700 Second Avenue', 'Winnipeg', 'MB', 'R1X 1A1', '204-111-1111', 'www.manitoba.educanada.ca', 2000, true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (301, 5, 'Winnipeg Elementary School', '800 Birch Street', 'Winnipeg', 'MB', 'R2X 2A2', '204-222-2222', 'www.winnipegschool.mb.ca', 700);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (302, 5, 'Winnipeg Secondary School', '900 Spruce Avenue', 'Winnipeg', 'MB', 'R3X 3A3', '204-333-3333', 'www.winnipegsecondary.mb.ca', 1000);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (342, 5, 'Winnipeg Middle School', '4200 Birch Avenue', 'Winnipeg', 'MB', 'R1X1Y1', '204-222-2222', 'www.winnipegmiddle.mb.ca', 600);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (343, 5, 'Brandon High School', '4300 Oak Street', 'Brandon', 'MB', 'R2X2Z2', '204-333-3333', 'www.brandonhigh.mb.ca', 1100);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (344, 5, 'Steinbach Elementary School', '4400 Elm Road', 'Steinbach', 'MB', 'R3X3B3', '204-444-4444', 'www.steinbachelementary.mb.ca', 500);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (345, 5, 'Thompson Secondary School', '4500 Pine Road', 'Thompson', 'MB', 'R4X4C4', '204-555-5555', 'www.thompsonsecondary.mb.ca', 900);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (346, 5, 'Portage la Prairie Middle School', '4600 Cedar Road', 'Portage la Prairie', 'MB', 'R5X5D5', '204-666-6666', 'www.portagelaprairiemiddle.mb.ca', 700);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (347, 5, 'Selkirk High School', '4700 Maple Street', 'Selkirk', 'MB', 'R6X6Z6', '204-777-7777', 'www.selkirkhigh.mb.ca', 1200);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (348, 5, 'Dauphin Elementary School', '4800 Elm Avenue', 'Dauphin', 'MB', 'R7X7A7', '204-888-8888', 'www.dauphinelementary.mb.ca', 400);

-- Newfoundland and Labrador (NL)
INSERT INTO Ministries (ministryId, name) VALUES (6,'Ministry of Education Newfoundalnd Labrador');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (400, 6, 'Management Newfoundland and Labrador Head Office', '1000 Water Street', 'St. John''s', 'NL', 'A1X 1B1', '709-111-1111', 'www.newfoundland.educanada.ca', 2000, true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (401, 6, 'St. John''s Elementary School', '1100 Pine Road', 'St. John''s', 'NL', 'A2X 2B2', '709-222-2222', 'www.stjohnsschool.nl.ca', 400);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (402, 6, 'St. John''s Secondary School', '1200 Oak Avenue', 'St. John''s', 'NL', 'A3X 3B3', '709-333-3333', 'www.stjohnssecondary.nl.ca', 800);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (449, 6, 'St. John''s Middle School', '4900 Pine Avenue', 'St. John''s', 'NL', 'A1X1Y1', '709-222-2222', 'www.stjohnsmiddle.nl.ca', 400);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (450, 6, 'Corner Brook High School', '5000 Elm Street', 'Corner Brook', 'NL', 'A2X2Z2', '709-333-3333', 'www.cornerbrookhigh.nl.ca', 900);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (451, 6, 'Gander Elementary School', '5100 Maple Road', 'Gander', 'NL', 'A3X3B3', '709-444-4444', 'www.ganderelementary.nl.ca', 500);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (452, 6, 'Mount Pearl Secondary School', '5200 Cedar Road', 'Mount Pearl', 'NL', 'A4X4C4', '709-555-5555', 'www.mountpearlsecondary.nl.ca', 900);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (453, 6, 'Labrador City Middle School', '5300 Elm Road', 'Labrador City', 'NL', 'A5X5D5', '709-666-6666', 'www.labradorcitymiddle.nl.ca', 600);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (454, 6, 'Stephenville High School', '5400 Pine Road', 'Stephenville', 'NL', 'A6X6Z6', '709-777-7777', 'www.stephenvillehigh.nl.ca', 1000);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (455, 6, 'Happy Valley-Goose Bay Elementary School', '5500 Cedar Road', 'Happy Valley-Goose Bay', 'NL', 'A7X7A7', '709-888-8888', 'www.happyvalleygoosebayelementary.nl.ca', 400);

-- Nova Scotia (NS)
INSERT INTO Ministries (ministryId, name) VALUES (7,'Ministry of Education Nova Scotia');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (500, 7, 'Management Nova Scotia Head Office', '1300 Main Street', 'Halifax', 'NS', 'B1X 1C1', '902-111-1111', 'www.novascotia.educanada.ca', 2000, true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (501, 7, 'Halifax Elementary School', '1400 Elm Road', 'Halifax', 'NS', 'B2X 2C2', '902-222-2222', 'www.halifaxschool.ns.ca', 500);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (502, 7, 'Halifax Secondary School', '1500 Oak Street', 'Halifax', 'NS', 'B3X 3C3', '902-333-3333', 'www.halifaxsecondary.ns.ca', 900);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (556, 7, 'Halifax Middle School', '5600 Maple Road', 'Halifax', 'NS', 'B1X1Y1', '902-222-2222', 'www.halifaxmiddle.ns.ca', 500);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (557, 7, 'Sydney High School', '5700 Cedar Road', 'Sydney', 'NS', 'B2X2Z2', '902-333-3333', 'www.sydneyhigh.ns.ca', 900);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (558, 7, 'Dartmouth Elementary School', '5800 Elm Avenue', 'Dartmouth', 'NS', 'B3X3B3', '902-444-4444', 'www.dartmouthelementary.ns.ca', 500);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (559, 7, 'Truro Secondary School', '5900 Pine Road', 'Truro', 'NS', 'B4X4C4', '902-555-5555', 'www.trurosecondary.ns.ca', 900);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (560, 7, 'Amherst Middle School', '6000 Elm Road', 'Amherst', 'NS', 'B5X5D5', '902-666-6666', 'www.amherstmiddle.ns.ca', 600);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (561, 7, 'Yarmouth High School', '6100 Cedar Road', 'Yarmouth', 'NS', 'B6X6Z6', '902-777-7777', 'www.yarmouthhigh.ns.ca', 1200);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (562, 7, 'New Glasgow Elementary School', '6200 Pine Avenue', 'New Glasgow', 'NS', 'B7X7A7', '902-888-8888', 'www.newglasgowelementary.ns.ca', 400);

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

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (670, 8, 'Charlottetown Middle School', '7000 Maple Street', 'Charlottetown', 'PE', 'C1X1Y1', '902-222-2222', 'www.charlottetownmiddleschool.pe.ca', 400);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (671, 8, 'Summerside High School', '7100 Cedar Road', 'Summerside', 'PE', 'C2X2Z2', '902-333-3333', 'www.summersidehigh.pe.ca', 900);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (672, 8, 'Montague Elementary School', '7200 Elm Avenue', 'Montague', 'PE', 'C3X3B3', '902-444-4444', 'www.montagueelementary.pe.ca', 500);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (673, 8, 'Stratford Secondary School', '7300 Pine Road', 'Stratford', 'PE', 'C4X4C4', '902-555-5555', 'www.stratfordsecondary.pe.ca', 900);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (674, 8, 'Souris Middle School', '7400 Elm Road', 'Souris', 'PE', 'C5X5D5', '902-666-6666', 'www.sourismiddle.pe.ca', 600);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (675, 8, 'Kensington High School', '7500 Cedar Road', 'Kensington', 'PE', 'C6X6Z6', '902-777-7777', 'www.kensingtonhigh.pe.ca', 1000);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (676, 8, 'Alberton Elementary School', '7600 Pine Avenue', 'Alberton', 'PE', 'C7X7A7', '902-888-8888', 'www.albertonelementary.pe.ca', 400);


-- Saskatchewan (SK)
INSERT INTO Ministries (ministryId, name) VALUES (9,'Ministry of Education Saskatchewan');
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementHeadOffice)
VALUES (700, 9, 'Management Saskatchewan Head Office', '2500 Main Street', 'Saskatoon', 'SK', 'S1X 1G1', '306-111-1111', 'www.saskatchewan.educanada.ca', 2000, true);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (701, 9, 'Saskatoon Elementary School', '2600 Elm Avenue', 'Saskatoon', 'SK', 'S2X 2G2', '306-222-2222', 'www.saskatoonschool.sk.ca', 600);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (702, 9, 'Saskatoon Secondary School', '2700 Cedar Street', 'Saskatoon', 'SK', 'S3X 3G3', '306-333-3333', 'www.saskatoonsecondary.sk.ca', 1000);
INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (784, 9, 'Saskatoon Middle School', '8400 Maple Street', 'Saskatoon', 'SK', 'S1X1Y1', '306-222-2222', 'www.saskatoonmiddleschool.sk.ca', 600);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (785, 9, 'Regina High School', '8500 Cedar Road', 'Regina', 'SK', 'S2X2Z2', '306-333-3333', 'www.reginahigh.sk.ca', 1100);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (786, 9, 'Prince Albert Elementary School', '8600 Elm Road', 'Prince Albert', 'SK', 'S3X3B3', '306-444-4444', 'www.princealbertelementary.sk.ca', 500);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (787, 9, 'Moose Jaw Secondary School', '8700 Pine Road', 'Moose Jaw', 'SK', 'S4X4C4', '306-555-5555', 'www.moosejawsecondary.sk.ca', 900);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (788, 9, 'Swift Current Middle School', '8800 Elm Avenue', 'Swift Current', 'SK', 'S5X5D5', '306-666-6666', 'www.swiftcurrentmiddle.sk.ca', 600);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (789, 9, 'North Battleford High School', '8900 Cedar Road', 'North Battleford', 'SK', 'S6X6Z6', '306-777-7777', 'www.northbattlefordhigh.sk.ca', 1000);

INSERT INTO Facilities (facilityID, ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity)
VALUES (790, 9, 'Yorkton Elementary School', '9000 Pine Avenue', 'Yorkton', 'SK', 'S7X7A7', '306-888-8888', 'www.yorktonelementary.sk.ca', 400);

-- End of Examples --


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
-- Ontario (ON)
INSERT INTO Persons (personID, firstName, lastName, medicare) VALUES (6,'Joe','Ontario','JONT 2922 1111');

INSERT INTO Employee(personID, facilityID, startDate, primaryEmploymentRoleID)
    VALUES (6,11,'2022-08-09',1);

-- Alberta (AB)
INSERT INTO Persons (personID, firstName, lastName, medicare)
VALUES (14, 'Jessica', 'Anderson', 'JAND 1111 2222');

INSERT INTO Employee (personID, facilityID, startDate, primaryEmploymentRoleID)
VALUES (14, 100, '2019-03-15', 2);


-- British Columbia (BC)
INSERT INTO Persons (personID, firstName, lastName, medicare)
VALUES (15, 'Michael', 'Taylor', 'MTAY 2222 3333');

INSERT INTO Employee (personID, facilityID, startDate, primaryEmploymentRoleID)
VALUES (15, 200, '2020-07-10', 1);


-- Manitoba (MB)
INSERT INTO Persons (personID, firstName, lastName, medicare)
VALUES (16, 'Stephanie', 'Miller', 'SMIL 3333 4444');

INSERT INTO Employee (personID, facilityID, startDate, primaryEmploymentRoleID)
VALUES (16, 300, '2017-06-25', 1);


-- Newfoundland and Labrador (NL)
INSERT INTO Persons (personID, firstName, lastName, medicare)
VALUES (17, 'David', 'Baker', 'DBAK 4444 5555');

INSERT INTO Employee (personID, facilityID, startDate, primaryEmploymentRoleID)
VALUES (17, 400, '2018-11-20', 2);


-- Nova Scotia (NS)
INSERT INTO Persons (personID, firstName, lastName, medicare)
VALUES (18, 'Jennifer', 'Clark', 'JCLA 5555 6666');

INSERT INTO Employee (personID, facilityID, startDate, primaryEmploymentRoleID)
VALUES (18, 500, '2021-02-05', 1);


-- Ontario (ON)
INSERT INTO Persons (personID, firstName, lastName, medicare)
VALUES (19, 'Matthew', 'Walker', 'MWAL 6666 7777');

INSERT INTO Employee (personID, facilityID, startDate, primaryEmploymentRoleID)
VALUES (19, 12, '2019-09-10', 2);


-- Prince Edward Island (PE)
INSERT INTO Persons (personID, firstName, lastName, medicare)
VALUES (110, 'Emily', 'Campbell', 'ECAM 7777 8888');

INSERT INTO Employee (personID, facilityID, startDate, primaryEmploymentRoleID)
VALUES (110, 600, '2020-12-01', 1);


-- Quebec (QC)
INSERT INTO Persons (personID, firstName, lastName, medicare)
VALUES (111, 'Daniel', 'Lefebvre', 'DLEF 8888 9999');

INSERT INTO Employee (personID, facilityID, startDate, primaryEmploymentRoleID)
VALUES (111, 4, '2019-08-15', 2);


-- Saskatchewan (SK)
INSERT INTO Persons (personID, firstName, lastName, medicare)
VALUES (112, 'Sophia', 'Murphy', 'SMUR 9999 0000');

INSERT INTO Employee (personID, facilityID, startDate, primaryEmploymentRoleID)
VALUES (112, 700, '2022-04-01', 1);



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




