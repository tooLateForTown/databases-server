# question 3i (Not working)
SELECT HeadOffices.name,
       COUNT(Facilities.facilityID) as numFacilities

FROM Ministries, Facilities,
        (SELECT Ministries.name, Facilities.province, Persons.firstName, Persons.lastName
        FROM Facilities, Ministries, Persons, Employee, EmploymentRoles
        WHERE Facilities.ministryID = Ministries.ministryID
          AND Employee.facilityID = Facilities.facilityID
          AND Persons.personID = Employee.personID
          AND Employee.primaryEmploymentRoleID = EmploymentRoles.employmentRoleID
          AND Facilities.isManagementHeadOffice=true
          AND EmploymentRoles.isHead = true) as HeadOffices

GROUP BY Facilities.province;






SELECT Ministries.name, Facilities.province, Persons.firstName, Persons.lastName
FROM Facilities, Ministries, Persons, Employee, EmploymentRoles
WHERE Facilities.ministryID = Ministries.ministryID
  AND Employee.facilityID = Facilities.facilityID
  AND Persons.personID = Employee.personID
  AND Employee.primaryEmploymentRoleID = EmploymentRoles.employmentRoleID
  AND Facilities.isManagementHeadOffice=true
  AND EmploymentRoles.isHead = true;
