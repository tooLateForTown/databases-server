# Question 3-7
SELECT VaccinationTypes.name AS VaccineType, COUNT(Vaccines.personID) AS TotalDoses
FROM VaccinationTypes, Vaccines, Students
WHERE VaccinationTypes.vaccinationTypeID = Vaccines.vaccinationTypeID
    AND Vaccines.personID = Students.personID
GROUP BY VaccinationTypes.name
ORDER BY TotalDoses DESC;
