# question 3i (Not working)
SELECT HeadOffices.name, HeadOffices.ministryID as HeadOfficeMinistryID, HeadOffices.Province, HeadOffices.firstName, HeadOffices.lastName,
       COUNT(Facilities.ministryID) as numFacilities, COUNT(Employees.personID) as Employees
FROM Ministries, Facilities, Employees, Students,
        (SELECT Ministries.ministryID, Ministries.name, Facilities.province as Province, Persons.firstName, Persons.lastName
        FROM Facilities, Ministries, Persons, Employees, EmploymentRoles
        WHERE Facilities.ministryID = Ministries.ministryID
          AND Employees.facilityID = Facilities.facilityID
          AND Persons.personID = Employees.personID
          AND Employees.primaryEmploymentRoleID = EmploymentRoles.employmentRoleID
          AND Facilities.isManagementHeadOffice=true
          AND EmploymentRoles.isHead = true) as HeadOffices
WHERE Facilities.ministryID = HeadOffices.ministryID
    AND Ministries.ministryID = HeadOffices.ministryID
    AND Employees.facilityID = Facilities.facilityID
    AND Employees.endDate IS NULL
GROUP BY Facilities.ministryID;

# Question 3-2
SELECT Facilities.name, COUNT(Employees.personID), COUNT(Students.personID)
FROM Facilities, Employees, Students
WHERE Facilities.city = 'Montréal'
    AND (Facilities.isSchoolPrimary = TRUE OR Facilities.isSchoolMiddle = TRUE OR Facilities.isSchoolHigh = TRUE)
    AND Employees.endDate IS NULL
    AND Employees.facilityID = Facilities.facilityID
    AND Students.facilityID = Facilities.facilityID
    AND Students.endDate IS NULL
GROUP BY Facilities.facilityID;
