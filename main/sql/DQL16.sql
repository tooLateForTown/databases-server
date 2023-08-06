SELECT Ministries.name, firstName, lastName, Presidents.city
FROM Ministries
JOIN Facilities ON Ministries.ministryID = Facilities.ministryID
LEFT JOIN ( SELECT *
            FROM Employees
                        JOIN Persons ON Employees.personID = Persons.personID
            WHERE primaryEmploymentRoleID = 1
) as Presidents

WHERE Facilities.isManagementHeadOffice = TRUE





