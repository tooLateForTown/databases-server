SELECT Ministries.name, firstName, lastName, Persons.city
FROM Ministries
JOIN Facilities ON Ministries.ministryID = Facilities.ministryID
JOIN Employees ON Facilities.facilityID = Employees.facilityID
JOIN Persons ON Employees.personID = Persons.personID
WHERE Facilities.isManagementHeadOffice = TRUE
    AND Employees.primaryEmploymentRoleID=1;




