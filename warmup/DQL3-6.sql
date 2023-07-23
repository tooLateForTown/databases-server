# Question 3-6
SELECT Facilities.name AS FacilityName,
       Ministries.name AS MinistryName,
       Facilities.city,
       CONCAT(Persons.firstName, ' ', Persons.lastName) AS PrincipalName
FROM Facilities, Ministries, Persons, Employees
WHERE  Facilities.ministryID = Ministries.ministryID
    AND (Facilities.isSchoolPrimary = true
        OR  Facilities.isSchoolMiddle = true
        OR Facilities.isSchoolHigh = true)
    AND Facilities.facilityID = Employees.facilityID
    AND Employees.personID = Persons.personID
    AND Employees.primaryEmploymentRoleID = 10
    AND Facilities.facilityID NOT IN (
      SELECT DISTINCT E.facilityID
      FROM Employees E, Infections I
      WHERE E.personID = I.personID
  )
  AND Facilities.facilityID NOT IN (
      SELECT DISTINCT S.facilityID
      FROM Students S, Infections I
      WHERE S.personID = I.personID
  )
GROUP BY Facilities.facilityID, Facilities.name, Ministries.name, Facilities.city, Persons.firstName, Persons.lastName
ORDER BY Ministries.name ASC, Facilities.city ASC, Facilities.name ASC;
