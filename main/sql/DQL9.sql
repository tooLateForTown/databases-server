#Question 9
SELECT P.firstName,
       P.lastName,
       ER.title,
       E.startDate AS StartDateOfWork,
       P.dateOfBirth,
       P.medicare,
       P.phoneNumber AS TelephoneNumber,
       P.address,
       P.city,
       P.province,
       F.postalCode,
       P.citizenship,
       P.email
FROM Employees E
JOIN Persons P ON E.personID = P.personID
JOIN Facilities F ON E.facilityID = F.facilityID
JOIN EmploymentRoles ER ON E.primaryEmploymentRoleID = ER.employmentRoleID
WHERE E.facilityID = 450            # pick facility ID
ORDER BY ER.title ASC, P.firstName ASC, P.lastName ASC;
