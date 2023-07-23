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

# Question 3-2
SELECT Facilities.name, Teachers.count as Teachers, StudentsPerSchool.count as Students, Covid19Teachers.infections as Teachers_Infected, Covid19Students.infections As Students_Infected, VaccinatedTeachers.count as Vaccinated_Teachers, VaccinatedStudents.count as Vaccinated_Students
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
    as StudentsPerSchool,
    (SELECT DISTINCT Facilities.facilityID, COUNT(Employees.personID) as infections
        FROM Facilities, Employees, Infections
        WHERE Employees.facilityID = Facilities.facilityID
            AND Employees.endDate IS NULL
            AND (Employees.primaryEmploymentRoleID = 11 OR primaryEmploymentRoleID = 12)
            AND Infections.personID = Employees.personID
        GROUP BY Facilities.facilityID)
    AS Covid19Teachers,
    (SELECT DISTINCT Facilities.facilityID, COUNT(Students.personID) as infections
        FROM Facilities, Students, Infections
        WHERE Students.facilityID = Facilities.facilityID
            AND Students.endDate IS NULL
            AND Infections.personID = Students.personID
        GROUP BY Facilities.facilityID)
    AS Covid19Students,
    (SELECT Facilities.facilityID,COUNT(Employees.personID) as count
        FROM Facilities,Employees,Vaccines
        WHERE
            Employees.facilityID = Facilities.facilityID
            AND Vaccines.personID = Employees.personID
            AND Vaccines.dose = 1
            AND (Employees.primaryEmploymentRoleID = 11 OR primaryEmploymentRoleID = 12)
            AND Employees.endDate IS NULL
        GROUP BY Facilities.facilityID)
    AS VaccinatedTeachers,
    (SELECT Facilities.facilityID,COUNT(Students.personID) as count
        FROM Facilities,Students,Vaccines
        WHERE
            Students.facilityID = Facilities.facilityID
            AND Vaccines.personID = Students.personID
            AND Vaccines.dose = 1
            AND Students.endDate IS NULL
        GROUP BY Facilities.facilityID)
    AS VaccinatedStudents
WHERE
    Facilities.facilityID = Teachers.facilityID
    AND Facilities.facilityID = StudentsPerSchool.facilityID
    AND Facilities.facilityID = Covid19Teachers.facilityID
    AND Facilities.facilityID = Covid19Students.facilityID
    AND Facilities.facilityID = VaccinatedTeachers.facilityID
    AND Facilities.facilityID = VaccinatedStudents.facilityID
    AND (Facilities.isSchoolPrimary = TRUE OR Facilities.isSchoolMiddle = TRUE OR Facilities.isSchoolHigh = TRUE)
    AND Facilities.city = 'Montréal'
GROUP BY Facilities.name
ORDER BY Facilities.name;

# Part 3-3
SELECT
    P.firstName,
    P.lastName,
    P.dateOfBirth,
    P.medicare,
    P.medicareExpiryDate,
    P.phoneNumber,
    P.email
FROM
    Persons P, Students S, Infections I
WHERE S.personID = P.personID
    AND I.personID = P.personID
    AND S.endDate IS NULL
    AND S.facilityID = 4
    AND P.medicareExpiryDate < CURDATE()
    AND I.infectionTypeID = 1;

# Part 3-4
WITH RecentInfections AS (
    SELECT date, name as InfectionType, personID
    FROM Infections, InfectionTypes
    WHERE Infections.infectionTypeID = InfectionTypes.infectionTypeID
        AND date >= DATE_SUB(NOW(), INTERVAL 2 WEEK)
),
LavalStudents AS (
    SELECT Students.personID
    FROM Facilities, Students
    WHERE Facilities.facilityID = Students.facilityID
        AND Students.endDate IS NULL
        AND Facilities.city = 'Laval')
SELECT firstName, lastName, dateOfBirth, InfectionType, RecentInfections.date AS InfectionDate, phoneNumber, email
FROM RecentInfections,LavalStudents, Persons
WHERE RecentInfections.personID = LavalStudents.personID
    AND LavalStudents.personID = Persons.personID
    AND LavalStudents.personID IN
        (SELECT personID FROM RecentInfections GROUP BY personID HAVING COUNT(*)>=2)
ORDER BY firstName, lastName, RecentInfections.date;


# Part 3-5

SELECT
    M.name AS ministry_name,
    F.name AS facility_name,
    F.city AS facility_city,
    P.firstName,
    P.lastName,
    P.email
FROM
    Persons P
JOIN
    Employees E ON P.personID = E.personID AND E.endDate IS NULL
JOIN
    Facilities F ON E.facilityID = F.facilityID
JOIN
    Ministries M ON F.ministryID = M.ministryID
WHERE
    P.personID IN (
        SELECT
            I.personID
        FROM
            Infections I
        WHERE
            I.infectionTypeID = 1
    )
    AND P.personID NOT IN (
        SELECT
            V.personID
        FROM
            Vaccines V
    )
ORDER BY
    M.name,
    F.city,
    F.name;

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

# Question 3-7
SELECT VaccinationTypes.name AS VaccineType, COUNT(Vaccines.personID) AS TotalDoses
FROM VaccinationTypes, Vaccines, Students
WHERE VaccinationTypes.vaccinationTypeID = Vaccines.vaccinationTypeID
    AND Vaccines.personID = Students.personID
GROUP BY VaccinationTypes.name
ORDER BY TotalDoses DESC;

# Question 3-8
SELECT InfectionTypes.name, Ministries.name, COUNT(DISTINCT Students.personID) AS TotalInfections
FROM InfectionTypes, Ministries, Infections, Students, Facilities
WHERE InfectionTypes.infectionTypeID = Infections.infectionTypeID
    AND Infections.personID = Students.personID
    AND  Students.facilityID = Facilities.facilityID
    AND Facilities.ministryID = Ministries.ministryID
GROUP BY InfectionTypes.name, Ministries.name
ORDER BY InfectionTypes.name ASC, TotalInfections DESC;



