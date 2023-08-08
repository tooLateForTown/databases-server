# Question 14 - Sam
SELECT
    Persons.firstName, 
    Persons.lastName, 
   SUM(TIMESTAMPDIFF(HOUR, MAKETIME(Schedule.startTime DIV 100, Schedule.startTime MOD 100, 0), 
   MAKETIME(Schedule.endTime DIV 100, Schedule.endTime MOD 100, 0))) AS totalHours
FROM 
    Schedule
    JOIN Employees ON Schedule.personID = Employees.personID AND Schedule.facilityID = Employees.facilityID
    JOIN Persons ON Employees.personID = Persons.personID
WHERE 
    Schedule.facilityID = :facilityID AND
    Schedule.workDate BETWEEN :startDate AND :endDate
GROUP BY 
    Persons.firstName,
    Persons.lastName
ORDER BY 
    Persons.firstName ASC,
    Persons.lastName ASC;

