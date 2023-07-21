SELECT
    P.firstName,
    P.lastName,
    P.dateOfBirth,
    P.medicare,
    P.medicareExpiryDate,
    P.phoneNumber,
    P.email
FROM
    Persons P
JOIN (
    SELECT
        S.personID,
        S.facilityID,
        MAX(S.startDate) AS latestStartDate
    FROM
        Students S
    WHERE
        S.facilityID IN (SELECT facilityID FROM Facilities WHERE name = 'Rosemont Elementary School')
    GROUP BY
        S.personID, S.facilityID
) AS LatestStudents ON P.personID = LatestStudents.personID
LEFT JOIN
    Students S ON LatestStudents.personID = S.personID AND LatestStudents.facilityID = S.facilityID AND LatestStudents.latestStartDate = S.startDate
LEFT JOIN
    Infections I ON P.personID = I.personID
LEFT JOIN
    InfectionTypes IT ON I.infectionTypeID = IT.name
WHERE
    IT.name = 'COVID-19'
    AND P.medicareExpiryDate < CURDATE()
ORDER BY
    P.medicareExpiryDate ASC;

