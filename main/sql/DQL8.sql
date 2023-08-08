SELECT
    F.name AS facility_name,
    F.address,
    F.city,
    F.province,
    F.postalCode,
    F.phoneNumber,
    F.web,
    P.firstName AS president_firstName,
    P.lastName AS president_lastName,
    COUNT(E.personID) AS num_employees
FROM Facilities AS F
LEFT JOIN Employees AS E ON F.facilityID = E.facilityID
LEFT JOIN Persons AS P ON F.facilityID = P.personID
WHERE F.isManagementHeadOffice = true OR F.isManagementGeneral = true
GROUP BY F.facilityID, F.name, F.address, F.city, F.province, F.postalCode, F.phoneNumber, F.web, P.firstName, P.lastName, F.isManagementGeneral, F.isManagementHeadOffice
ORDER BY F.province, F.city, F.isManagementHeadOffice DESC, F.isManagementGeneral DESC, num_employees;



