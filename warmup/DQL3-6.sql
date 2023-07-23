# Question 3-6
SELECT Facilities.name AS FacilityName,
       Ministries.name AS MinistryName,
       Facilities.city,
       CONCAT(Persons.firstName, ' ', Persons.lastName) AS PrincipalName
FROM Facilities, Ministries, Persons, Employees
WHERE  Facilities.ministryID = Ministries.ministryID
    AND (Facilities.isSchoolPrimary = true
        OR  Facilities.isSchoolMiddle = true
        OR Facilities.isSchoolHigh = true)         #filter for Schools only
    AND Facilities.facilityID = Employees.facilityID
    AND Employees.personID = Persons.personID
    AND Employees.primaryEmploymentRoleID = 10  #filtering for principal
    AND Facilities.facilityID NOT IN (          #filter for employees without infections
      SELECT DISTINCT E.facilityID
      FROM Employees E, Infections I
      WHERE E.personID = I.personID
  )
  AND Facilities.facilityID NOT IN (            #filter for students without infections
      SELECT DISTINCT S.facilityID
      FROM Students S, Infections I
      WHERE S.personID = I.personID
  )
GROUP BY Facilities.facilityID, Facilities.name, Ministries.name, Facilities.city, Persons.firstName, Persons.lastName
ORDER BY Ministries.name ASC, Facilities.city ASC, Facilities.name ASC;


# Note: I Removed the infections so 2 schools will show up, Calgary High School and Yorktown Elementary.
# Fahad: Yorktown students and teachers had infections so i removed the infections and added a principle
#todo add principals to more schools and remove the students and employee infections