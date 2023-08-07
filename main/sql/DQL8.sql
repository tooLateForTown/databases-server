SELECT
    f.name AS facility_name,
    f.address,
    f.city,
    f.province,
    f.postalCode,
    f.phoneNumber,
    f.web,
    p.firstName AS president_firstName,
    p.lastName AS president_lastName,
    COUNT(E.personID) AS num_employees
FROM Facilities AS F
LEFT JOIN Employees AS E ON F.facilityID = E.facilityID
LEFT JOIN Persons AS P ON F.facilityID = P.personID
WHERE (F.isManagementHeadOffice = true OR F.isManagementGeneral = true)
GROUP BY F.name, F.address, F.city, F.province, F.postalCode, F.phoneNumber, F.web, p.firstName, p.lastName, F.isManagementHeadOffice, F.isManagementGeneral
ORDER BY F.province, F.city, F.isManagementHeadOffice DESC, F.isManagementGeneral DESC, num_employees;


