SELECT
    p.firstName AS teacher_firstName,
    p.lastName AS teacher_lastName,
    i.date AS date_of_infection,
    f.name AS facility_name
FROM
    Persons p
JOIN
    Infections i ON p.personID = i.personID
JOIN
    InfectionTypes it ON i.infectionTypeID = it.infectionTypeID
JOIN
    Employees e ON p.personID = e.personID
JOIN
    Facilities f ON e.facilityID = f.facilityID
WHERE
    I.infectionTypeID = 1
    AND i.date >= DATE_SUB(CURDATE(), INTERVAL 2 WEEK)

ORDER BY
    f.name ASC, p.firstName ASC;
