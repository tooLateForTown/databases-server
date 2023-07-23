# Part 3-3
SELECT
    P.firstName,
    P.lastName,
    P.dateOfBirth,
    P.medicare,
    P.medicareExpiryDate,
    P.phoneNumber,
    P.email
FROM
    Persons P, Students S, Infections I
WHERE S.personID = P.personID
    AND I.personID = P.personID
    AND S.endDate IS NULL
    AND S.facilityID = 4
    AND P.medicareExpiryDate < CURDATE()
    AND I.infectionTypeID = 1;



