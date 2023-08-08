# Question 16 - Fahad
SELECT P.firstName AS MinisterFirstName,
       P.lastName AS MinisterLastName,
       P.city AS MinisterCity,
       COUNT(DISTINCT CASE WHEN F.isManagementHeadOffice OR F.isManagementGeneral THEN F.facilityID END) AS TotalManagementFacilities,
       COUNT(DISTINCT CASE WHEN F.isSchoolPrimary OR F.isSchoolMiddle OR F.isSchoolHigh THEN F.facilityID END) AS TotalEducationalFacilities
FROM Ministries M
JOIN Facilities F ON M.ministryID = F.ministryID
JOIN Employees E ON F.facilityID = E.facilityID
JOIN Persons P ON E.personID = P.personID
WHERE E.primaryEmploymentRoleID = 1
GROUP BY M.ministryID, P.firstName, P.lastName, P.city
ORDER BY P.city ASC, TotalEducationalFacilities DESC;


# SELECT Ministries.name, firstName, lastName, Presidents.city
# FROM Ministries
# JOIN Facilities ON Ministries.ministryID = Facilities.ministryID
# LEFT JOIN ( SELECT *
#             FROM Employees
#                         JOIN Persons ON Employees.personID = Persons.personID
#             WHERE primaryEmploymentRoleID = 1
# ) as Presidents
#
# WHERE Facilities.isManagementHeadOffice = TRUE

