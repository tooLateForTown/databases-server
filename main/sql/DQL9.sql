#Question 9
SELECT P.firstName,
       P.lastName,
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
WHERE E.facilityID = 450
ORDER BY E.primaryEmploymentRoleID ASC, P.firstName ASC, P.lastName ASC;
