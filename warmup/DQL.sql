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
SELECT Facilities.facilityID, Facilities.name, Teachers.count as Teachers, StudentsPerSchool.count as Students, Covid19Teachers.infections as Teachers_Infected, Covid19Students.infections As Students_Infected, VaccinatedTeachers.count as Vaccinated_Teachers, VaccinatedStudents.count as Vaccinated_Students
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
            AND Infections.infectionTypeID = 1
        GROUP BY Facilities.facilityID)
    AS Covid19Teachers,
    (SELECT DISTINCT Facilities.facilityID, COUNT(Students.personID) as infections
        FROM Facilities, Students, Infections
        WHERE Students.facilityID = Facilities.facilityID
            AND Students.endDate IS NULL
            AND Infections.personID = Students.personID
            AND Infections.infectionTypeID = 1
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

