SELECT
    Persons.firstName,
    Persons.lastName,
    Persons.dateOfBirth,
    Persons.medicare,
    Persons.medicareExpiryDate,
    Persons.phoneNumber,
    Persons.email
FROM
    Students
JOIN
    Persons ON Students.personID = Persons.personID
WHERE
    Students.facilityID = (SELECT facilityID FROM Facilities WHERE name = 'Rosemont Elementary School')
    AND Students.personID IN (
        SELECT
            personID
        FROM
            Infections
        WHERE
            type = 'COVID-19'
    )
    AND Persons.medicareExpiryDate < CURDATE()
ORDER BY
    Persons.medicareExpiryDate ASC;