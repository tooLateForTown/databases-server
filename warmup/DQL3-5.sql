SELECT
    M.name AS ministry_name,
    F.name AS facility_name,
    F.city AS facility_city,
    P.firstName,
    P.lastName,
    P.email
FROM
    Persons P
JOIN
    Employees E ON P.personID = E.personID AND E.endDate IS NULL
JOIN
    Facilities F ON E.facilityID = F.facilityID
JOIN
    Ministries M ON F.ministryID = M.ministryID
WHERE
    P.personID IN (
        SELECT
            I.personID
        FROM
            Infections I
        JOIN
            InfectionTypes IT ON I.infectionTypeID = IT.infectionTypeID
        WHERE
            IT.infectionTypeID = '1'
    )
    AND P.personID NOT IN (
        SELECT
            V.personID
        FROM
            Vaccines V
    )
ORDER BY
    M.name,
    F.city,
    F.name;


SELECT Employees.personID FROM Employees, Infections
WHERE endDate IS NULL
AND Infections.personID = Employees.personID
AND Infections.infectionTypeID =1
