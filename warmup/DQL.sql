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
SELECT Facilities.facilityID, Facilities.name, Teachers.count as Teachers, Students.count as Students
FROM Facilities,
    (SELECT Facilities.facilityID,count(Employees.personID) as count
        FROM Facilities,Employees
        WHERE
            Employees.facilityID = Facilities.facilityID
            AND (Employees.primaryEmploymentRoleID = 11 OR primaryEmploymentRoleID = 12)
            AND Employees.endDate IS NULL
        GROUP BY Facilities.facilityID)
    as Teachers,
    (SELECT Facilities.facilityID, count(Students.personID) as count
        FROM Facilities, Students
        WHERE
            Students.facilityID = Facilities.facilityID
            AND Students.endDate IS NULL
        GROUP BY Facilities.facilityID)
    as Students
WHERE
    Facilities.facilityID = Teachers.facilityID
    AND Facilities.facilityID = Students.facilityID
    AND (Facilities.isSchoolPrimary = TRUE OR Facilities.isSchoolMiddle = TRUE OR Facilities.isSchoolHigh = TRUE)
GROUP BY Facilities.facilityID;

SELECT Facilities.facilityID, count(Students.personID) as count
FROM Facilities, Students
WHERE
    Students.facilityID = Facilities.facilityID
    AND Students.endDate IS NULL
GROUP BY Facilities.facilityID



# original
SELECT Facilities.name, COUNT(Employees.personID), COUNT(Students.personID)
FROM Facilities, Employees, Students
WHERE Facilities.city = 'Montréal'
    AND (Facilities.isSchoolPrimary = TRUE OR Facilities.isSchoolMiddle = TRUE OR Facilities.isSchoolHigh = TRUE)
    AND Employees.endDate IS NULL
    AND Employees.facilityID = Facilities.facilityID
    AND Students.facilityID = Facilities.facilityID
    AND Students.endDate IS NULL
GROUP BY Facilities.facilityID;
