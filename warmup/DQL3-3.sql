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
        MAX(S.startDate) AS latestStartDate  #fixme why are you considering start date?. For current students:  enddate IS NULL
    FROM
        Students S
    WHERE
        S.facilityID IN (SELECT facilityID FROM Facilities WHERE name = 'Rosemont Elementary School') # fixme should by by facility id number
    GROUP BY
        S.personID, S.facilityID
) AS LatestStudents ON P.personID = LatestStudents.personID
LEFT JOIN
    Students S ON LatestStudents.personID = S.personID AND LatestStudents.facilityID = S.facilityID AND LatestStudents.latestStartDate = S.startDate  #fixme ignore startdate
LEFT JOIN
    Infections I ON P.personID = I.personID
LEFT JOIN
    InfectionTypes IT ON I.infectionTypeID = IT.name  # fixme cannot be right
WHERE
    IT.name = 'COVID-19'  # fixme needs to be the id
    AND P.medicareExpiryDate < CURDATE()
ORDER BY
    P.medicareExpiryDate ASC;

