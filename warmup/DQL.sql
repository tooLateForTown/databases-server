# question 3i (Not working)
SELECT HeadOffices.name, HeadOffices.ministryID as HeadOfficeMinistryID, HeadOffices.Province, HeadOffices.firstName, HeadOffices.lastName,
       COUNT(Facilities.ministryID) as numFacilities, COUNT(Employee.personID) as Employees
FROM Ministries, Facilities, Employee, Student,
        (SELECT Ministries.ministryID, Ministries.name, Facilities.province as Province, Persons.firstName, Persons.lastName
        FROM Facilities, Ministries, Persons, Employee, EmploymentRoles
        WHERE Facilities.ministryID = Ministries.ministryID
          AND Employee.facilityID = Facilities.facilityID
          AND Persons.personID = Employee.personID
          AND Employee.primaryEmploymentRoleID = EmploymentRoles.employmentRoleID
          AND Facilities.isManagementHeadOffice=true
          AND EmploymentRoles.isHead = true) as HeadOffices
WHERE Facilities.ministryID = HeadOffices.ministryID
    AND Ministries.ministryID = HeadOffices.ministryID
    AND Employee.facilityID = Facilities.facilityID
    AND Employee.endDate IS NULL
GROUP BY Facilities.ministryID;

SELECT Ministries.name, Facilities.province, Persons.firstName, Persons.lastName
FROM Facilities, Ministries, Persons, Employee, EmploymentRoles
WHERE Facilities.ministryID = Ministries.ministryID
  AND Employee.facilityID = Facilities.facilityID
  AND Persons.personID = Employee.personID
  AND Employee.primaryEmploymentRoleID = EmploymentRoles.employmentRoleID
  AND Facilities.isManagementHeadOffice=true
  AND EmploymentRoles.isHead = true;


SELECT Ministries.ministryID, Ministries.name, Facilities.province, Persons.firstName, Persons.lastName
        FROM Facilities, Ministries, Persons, Employee, EmploymentRoles
        WHERE Facilities.ministryID = Ministries.ministryID
          AND Employee.facilityID = Facilities.facilityID
          AND Persons.personID = Employee.personID
          AND Employee.primaryEmploymentRoleID = EmploymentRoles.employmentRoleID
          AND Facilities.isManagementHeadOffice=true
          AND EmploymentRoles.isHead = true