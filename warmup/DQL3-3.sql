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
        S.facilityID
    FROM
        Students S
    WHERE
        S.facilityID = '4'
        AND S.endDate IS NULL
    GROUP BY
        S.personID, S.facilityID
) LatestStudents ON P.personID = LatestStudents.personID
LEFT JOIN Infections I ON P.personID = I.personID
LEFT JOIN InfectionTypes IT ON I.infectionTypeID = IT.name
WHERE
    IT.infectionTypeID = '1'
    AND P.medicareExpiryDate < CURDATE()
ORDER BY
    P.medicareExpiryDate;

