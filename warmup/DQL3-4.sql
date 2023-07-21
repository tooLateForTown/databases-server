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


