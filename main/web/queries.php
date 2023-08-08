<?php

class Query
{
    public $id = -1;
    public $sql = 'undefined';
    public $title = 'undefined';
    public $brief_title='undefined';
    public $ask_facility = false;
    public $ask_employee = false;
}

$queries = array();

# *** Query 8
$q = new Query();
$q->id = 8;
$q->sql="SELECT
F.name AS facility_name,
F.address,
F.city,
F.province,
F.postalCode,
F.phoneNumber,
F.web,
P.firstName AS president_firstName,
P.lastName AS president_lastName,
COUNT(E.personID) AS num_employees
FROM Facilities AS F
LEFT JOIN Employees AS E ON F.facilityID = E.facilityID
LEFT JOIN Persons AS P ON F.facilityID = P.personID
WHERE F.isManagementHeadOffice = true OR F.isManagementGeneral = true
GROUP BY F.facilityID, F.name, F.address, F.city, F.province, F.postalCode, F.phoneNumber, F.web, P.firstName, P.lastName, F.isManagementGeneral, F.isManagementHeadOffice
ORDER BY F.province, F.city, F.isManagementHeadOffice DESC, F.isManagementGeneral DESC, num_employees;";
$q->title = "Facilities";
$q->brief_title = "Facilities";
$queries[] = $q;

# *** Query 9
$q = new Query();
$q->id = 9;
$q->sql="SELECT P.firstName,
       P.lastName,
       E.startDate AS StartDateOfWork,
       P.dateOfBirth,
       P.medicare,
       P.phoneNumber AS TelephoneNumber,
       P.address,
       P.city,
       P.province,
       F.postalCode,
       P.citizenship,
       P.email
FROM Employees E
JOIN Persons P ON E.personID = P.personID
JOIN Facilities F ON E.facilityID = F.facilityID
WHERE E.facilityID = 450            # pick facility ID
ORDER BY E.primaryEmploymentRoleID ASC, P.firstName ASC, P.lastName ASC;";
$q->title = "Employees";
$q->brief_title = "Employees";
$queries[] = $q;

# *** Query 10
$q = new Query();
$q->id = 10;
$q->sql="SELECT F.name AS FacilityName,
DATE_FORMAT(S.workDate, '%Y-%m-%d') AS DayOfYear,
S.startTime,
S.endTime
FROM Schedule S
JOIN Facilities F ON S.facilityID = F.facilityID
WHERE S.personID = 5                                        # can pick any employee personID
AND (S.workDate BETWEEN '1999-01-01' AND '2023-04-01')      # can choose any date range
ORDER BY F.name ASC, S.workDate ASC, S.startTime ASC;";
$q->title = "Schedule";
$q->brief_title = "Schedule";
$queries[] = $q;

# *** Query 11
$q = new Query();
$q->id = 11;
$q->sql="SELECT
p.firstName AS teacher_firstName,
p.lastName AS teacher_lastName,
i.date AS date_of_infection,
f.name AS facility_name
FROM
Persons p
JOIN
Infections i ON p.personID = i.personID
JOIN
InfectionTypes it ON i.infectionTypeID = it.infectionTypeID
JOIN
Employees e ON p.personID = e.personID
JOIN
Facilities f ON e.facilityID = f.facilityID
WHERE
i.infectionTypeID = 1
AND i.date >= DATE_SUB(CURDATE(), INTERVAL 2 WEEK)
ORDER BY
f.name ASC, p.firstName ASC;";
$q->title = "All the teachers who have been infected by COVID-19 in the
past two weeks";
$q->brief_title = "Infected Teacher";
$queries[] = $q;

# *** Query 12
$q = new Query();
$q->id = 12;
$q->sql="SELECT
E.emailDate,
F.name AS sender_facility_name,
E.receiver,
E.subject,
E.emailBody
FROM Emails AS E
JOIN Facilities AS F ON E.senderID = F.facilityID
WHERE E.senderID = 12 -- enter id number
ORDER BY E.emailDate;";
$q->title = "List the emails generated by a given facility";
$q->brief_title = "Emails generated";
$queries[] = $q;

# *** Query 13
$q = new Query();
$q->id = 13;
$q->sql="SELECT
DISTINCT Persons.firstName,
Persons.lastName,
CASE
    WHEN EmploymentRoles.title = 'Elementary Teacher' THEN 'Elementary'
    WHEN EmploymentRoles.title = 'Secondary Teacher' THEN 'Secondary'
    ELSE 'Other'
END AS role
FROM
Schedule
JOIN Employees ON Schedule.personID = Employees.personID AND Schedule.facilityID = Employees.facilityID
JOIN Persons ON Employees.personID = Persons.personID
JOIN EmploymentRoles ON Employees.primaryEmploymentRoleID = EmploymentRoles.employmentRoleID
WHERE
Schedule.facilityID = 79 AND #input facilityID
Schedule.workDate BETWEEN DATE_SUB(NOW(), INTERVAL 2 WEEK) AND NOW()
ORDER BY
role ASC,
Persons.firstName ASC;";
$q->title = "Generate a list of all the teachers who have been on
schedule to work in the last two weeks";
$q->brief_title = "List Teachers Worked";
$queries[] = $q;


# *** Query 14
$q = new Query();
$q->id = 14;
$q->sql="SELECT 
Persons.firstName, 
Persons.lastName, 
SUM(TIMESTAMPDIFF(HOUR, MAKETIME(Schedule.startTime DIV 100, Schedule.startTime MOD 100, 0), 
MAKETIME(Schedule.endTime DIV 100, Schedule.endTime MOD 100, 0))) AS totalHours
FROM 
Schedule
JOIN Employees ON Schedule.personID = Employees.personID AND Schedule.facilityID = Employees.facilityID
JOIN Persons ON Employees.personID = Persons.personID
WHERE 
Schedule.facilityID = 3 AND #input facilityID
Schedule.workDate BETWEEN '2018-01-01' AND '2023-08-08' # input startDate and endDate
GROUP BY 
Persons.firstName,
Persons.lastName
ORDER BY 
Persons.firstName ASC,
Persons.lastName ASC;";
$q->title = "For a given facility, give the total hours scheduled for every teacher during a
specific period";
$q->brief_title = "Total Hours Facility";
$queries[] = $q;

# *** Query 15
$q = new Query();
$q->id = 15;
$q->sql="SELECT province, name, capacity, TeacherInfections, StudentInfections FROM
((SELECT Facilities.facilityID,Facilities.province, Facilities.name, Facilities.capacity, COUNT(SI.personID) as StudentInfections
FROM Facilities
JOIN Students ON Facilities.facilityID = Students.facilityID
LEFT OUTER JOIN (SELECT Infections.* FROM Infections WHERE Infections.date BETWEEN date_sub(now(), INTERVAL 2 WEEK) AND NOW()) as SI
    ON SI.personID = Students.personID
WHERE Facilities.isSchoolHigh = TRUE
GROUP BY Facilities.facilityID) AS S

NATURAL JOIN

(SELECT Facilities.facilityID,Facilities.province, Facilities.name, Facilities.capacity,COUNT(EI.personID) as TeacherInfections
FROM Facilities
JOIN Employees ON Facilities.facilityID = Employees.facilityID
LEFT OUTER JOIN (SELECT Infections.* FROM Infections WHERE Infections.date BETWEEN date_sub(now(), INTERVAL 2 WEEK) AND NOW()) as EI
    ON EI.personID = Employees.personID
WHERE Facilities.isSchoolHigh = TRUE
GROUP BY Facilities.facilityID) AS E)
ORDER BY province, TeacherInfections;";
$q->title = "Number of infections in schools in the last 2 weeks";
$q->brief_title = "Infections in schools";
$queries[] = $q;

# *** Query 16
$q = new Query();
$q->id = 16;
$q->sql="SELECT P.firstName AS MinisterFirstName,
P.lastName AS MinisterLastName,
P.city AS MinisterCity,
COUNT(DISTINCT CASE WHEN F.isManagementHeadOffice OR F.isManagementGeneral THEN F.facilityID END) AS TotalManagementFacilities,
COUNT(DISTINCT CASE WHEN F.isSchoolPrimary OR F.isSchoolMiddle OR F.isSchoolHigh THEN F.facilityID END) AS TotalEducationalFacilities
FROM Ministries M
JOIN Facilities F ON M.ministryID = F.ministryID
JOIN Employees E ON F.facilityID = E.facilityID
JOIN Persons P ON E.personID = P.personID
WHERE E.primaryEmploymentRoleID = 1
GROUP BY M.ministryID, P.firstName, P.lastName, P.city
ORDER BY P.city ASC, TotalEducationalFacilities DESC;";
$q->title = "Total number of educational facilities that the minister is
currently administering.";
$q->brief_title = "Adminstering Number of Ministries";
$queries[] = $q;

# *** Query 17
$q = new Query();
$q->id = 17;
$q->sql="SELECT P.firstName,
P.lastName,
E.startDate AS FirstDayOfWork,
ER1.title AS PrimaryRole,
ER2.title AS SecondaryRole,
ER3.title AS TertiaryRole,
P.dateOfBirth,
P.email,
SUM(S.endTime - S.startTime) AS TotalHoursScheduled
FROM Employees E
JOIN Persons P ON E.personID = P.personID
JOIN Schedule S ON E.personID = S.personID
LEFT JOIN Infections I ON E.personID = I.personID
LEFT JOIN EmploymentRoles ER1 ON E.primaryEmploymentRoleID = ER1.employmentRoleID
LEFT JOIN EmploymentRoles ER2 ON E.secondaryEmploymentRoleID = ER2.employmentRoleID
LEFT JOIN EmploymentRoles ER3 ON E.tertiaryEmploymentRoleID = ER3.employmentRoleID
WHERE I.infectionTypeID IS NOT NULL
AND I.date BETWEEN E.startDate AND CURDATE()
AND (ER1.title = 'School Counselor' OR ER2.title = 'School Counselor' OR ER3.title = 'School Counselor')
GROUP BY P.personID, P.firstName, P.lastName, E.startDate, ER1.title, ER2.title, ER3.title, P.dateOfBirth, P.email
HAVING COUNT(I.infectionTypeID) >= 3
ORDER BY ER1.title ASC, P.firstName ASC, P.lastName ASC;"; 
$q->title = "Counselor(s) who are currently working and has been
infected by COVID-19 at least three times";
$q->brief_title = "Councelor infected by COVID-19 min times";
$queries[] = $q;

