SELECT
    f.name AS facility_name,
    f.address,
    f.city,
    f.province,
    f.postalCode,
    f.phoneNumber,
    f.web,
    f.capacity,
    f.isManagementHeadOffice,
    f.isManagementGeneral,
    f.isSchoolPrimary,
    f.isSchoolMiddle,
    f.isSchoolHigh,
    p.firstName AS president_firstName,
    p.lastName AS president_lastName,
    (SELECT COUNT(e.personID) FROM Employees e WHERE e.facilityID = f.facilityID) AS num_employees
FROM
    Facilities f
LEFT JOIN
    Employees e ON f.facilityID = e.facilityID
LEFT JOIN
    Persons p ON e.personID = p.personID AND f.isManagementHeadOffice = 1
ORDER BY
    f.province ASC, f.city ASC,
    f.isSchoolPrimary DESC, f.isSchoolMiddle DESC, f.isSchoolHigh DESC,
    num_employees ASC;
