SELECT 
    Persons.firstName, 
    Persons.lastName, 
    CASE 
        WHEN EmploymentRoles.title = 'Elementary Teacher' THEN 'Elementary'
        WHEN EmploymentRoles.title = 'Secondary Teacher' THEN 'Secondary'
        ELSE 'Other'
    END AS role
FROM 
    Schedule
    JOIN Employees ON Schedule.personID = Employees.personID AND Schedule.facilityID = Employees.facilityID
    JOIN Persons ON Employees.personID = Persons.personID
    JOIN EmploymentRoles ON Employees.primaryEmploymentRoleID = EmploymentRoles.employmentRoleID
WHERE 
    Schedule.facilityID = :facilityID AND
    Schedule.workDate BETWEEN DATE_SUB(NOW(), INTERVAL 2 WEEK) AND NOW()
ORDER BY 
    role ASC,
    Persons.firstName ASC;