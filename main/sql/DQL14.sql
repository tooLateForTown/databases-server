SELECT 
    Persons.firstName, 
    Persons.lastName, 
    SUM(TIMESTAMPDIFF(HOUR, Schedule.startTime, Schedule.endTime)) AS totalHours
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

