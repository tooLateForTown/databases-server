# Question 3-8
SELECT InfectionTypes.name, Ministries.name, COUNT(Students.personID) AS TotalInfections
FROM InfectionTypes, Ministries, Infections, Students, Facilities
WHERE InfectionTypes.infectionTypeID = Infections.infectionTypeID
    AND Infections.personID = Students.personID
    AND  Students.facilityID = Facilities.facilityID
    AND Facilities.ministryID = Ministries.ministryID
GROUP BY InfectionTypes.name, Ministries.name
ORDER BY InfectionTypes.name ASC, TotalInfections DESC;
