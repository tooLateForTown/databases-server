# Question 17
SELECT P.firstName,
       P.lastName,
       E.startDate AS FirstDayOfWork,
       ER1.title AS PrimaryRole,
       ER2.title AS SecondaryRole,
       ER3.title AS TertiaryRole,
       P.dateOfBirth,
       P.email,
       SUM(S.endTime - S.startTime) AS TotalHoursScheduled
FROM Employees E
JOIN Persons P ON E.personID = P.personID
JOIN Schedule S ON E.personID = S.personID
LEFT JOIN Infections I ON E.personID = I.personID
LEFT JOIN EmploymentRoles ER1 ON E.primaryEmploymentRoleID = ER1.employmentRoleID
LEFT JOIN EmploymentRoles ER2 ON E.secondaryEmploymentRoleID = ER2.employmentRoleID
LEFT JOIN EmploymentRoles ER3 ON E.tertiaryEmploymentRoleID = ER3.employmentRoleID
WHERE I.infectionTypeID IS NOT NULL
  AND I.date BETWEEN E.startDate AND CURDATE()
  AND (ER1.title = 'School Counselor' OR ER2.title = 'School Counselor' OR ER3.title = 'School Counselor')
GROUP BY P.personID, P.firstName, P.lastName, E.startDate, ER1.title, ER2.title, ER3.title, P.dateOfBirth, P.email
HAVING COUNT(I.infectionTypeID) >= 3
ORDER BY ER1.title ASC, P.firstName ASC, P.lastName ASC;
