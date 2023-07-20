# question 3-1
SELECT HeadOffices.name, HeadOffices.ministryID as HeadOfficeMinistryID, HeadOffices.Province, HeadOffices.firstName, HeadOffices.lastName,
       FacilitiesPerMinistry.count as Facilities, EmployeesPerMinistry.count as Employees, StudentsPerMinistry.count as Students
FROM
    (SELECT Ministries.ministryID, Ministries.name, Facilities.province as Province, Persons.firstName, Persons.lastName
        FROM Facilities, Ministries, Persons, Employees, EmploymentRoles
        WHERE Facilities.ministryID = Ministries.ministryID
          AND Employees.facilityID = Facilities.facilityID
          AND Persons.personID = Employees.personID
          AND Employees.primaryEmploymentRoleID = EmploymentRoles.employmentRoleID
          AND Facilities.isManagementHeadOffice=true
          AND EmploymentRoles.isHead = true)
    AS HeadOffices,
    (SELECT Facilities.ministryID, COUNT(Facilities.facilityID) as count
        FROM Facilities
        GROUP BY Facilities.ministryID)
    AS FacilitiesPerMinistry,
    (SELECT Ministries.ministryID, COUNT(Employees.personID) as count
        FROM Ministries, Employees, Facilities
        WHERE Employees.facilityID = Facilities.facilityID
            AND Facilities.ministryID = Ministries.ministryID
            AND Employees.endDate IS NULL
        GROUP BY Ministries.ministryID)
    AS EmployeesPerMinistry,
    (SELECT Ministries.ministryID, COUNT(Students.personID) as count
        FROM Ministries, Students, Facilities
        WHERE Students.facilityID = Facilities.facilityID
            AND Facilities.ministryID = Ministries.ministryID
            AND Students.endDate IS NULL
        GROUP BY Ministries.ministryID)
    AS StudentsPerMinistry
WHERE FacilitiesPerMinistry.ministryID = HeadOffices.ministryID
    AND EmployeesPerMinistry.ministryID = HeadOffices.ministryID
    AND StudentsPerMinistry.ministryID = HeadOffices.ministryID
GROUP BY HeadOffices.ministryID
ORDER BY Facilities DESC;





