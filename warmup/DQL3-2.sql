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