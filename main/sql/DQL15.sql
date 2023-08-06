SELECT province, name, capacity, TeacherInfections, StudentInfections FROM
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
ORDER BY province, TeacherInfections;



