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
    f.name AS facility_name,
    f.address,
    f.city,
    f.province,
    f.postalCode,
    f.phoneNumber,
    f.web,
    f.capacity,
    f.isManagementHeadOffice,
    f.isManagementGeneral,
    f.isSchoolPrimary,
    f.isSchoolMiddle,
    f.isSchoolHigh,
    p.firstName AS president_firstName,
    p.lastName AS president_lastName,
    (SELECT COUNT(e.personID) FROM Employees e WHERE e.facilityID = f.facilityID) AS num_employees
FROM
    Facilities f
LEFT JOIN
    Employees e ON f.facilityID = e.facilityID
LEFT JOIN
    Persons p ON e.personID = p.personID AND f.isManagementHeadOffice = 1
ORDER BY
    f.province ASC, f.city ASC,
    f.isSchoolPrimary DESC, f.isSchoolMiddle DESC, f.isSchoolHigh DESC,
    num_employees ASC;";
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
  AND S.workDate BETWEEN '1999-01-01' AND '2023-04-01'      # can choose any date range
ORDER BY F.name ASC, S.workDate ASC, S.startTime ASC;";
$q->title = "Schedule";
$q->brief_title = "Schedule";
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


