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
    Employees E ON P.personID = E.personID  #todo only use current, ie:  endDate IS NULL
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
            InfectionTypes IT ON I.infectionTypeID = IT.name  #fixme must connect infections.infectiontypeID to InfectionTypes.InfectionTypeId
        WHERE
            IT.name = 'COVID-19' # fixme use ID, eg: 1
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
