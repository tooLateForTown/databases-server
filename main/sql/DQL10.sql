#Question 10
SELECT F.name AS FacilityName,
       DATE_FORMAT(S.workDate, '%Y-%m-%d') AS DayOfYear,
       S.startTime,
       S.endTime
FROM Schedule S
JOIN Facilities F ON S.facilityID = F.facilityID
WHERE S.personID = 5                                        # can pick any employee personID
  AND S.workDate BETWEEN '1999-01-01' AND '2023-04-01'      # can choose any date range
ORDER BY F.name ASC, S.workDate ASC, S.startTime ASC;
