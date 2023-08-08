SELECT
    E.emailDate,
    F.name AS sender_facility_name,
    E.receiver,
    E.subject,
    E.emailBody
FROM Emails AS E
JOIN Facilities AS F ON E.senderID = F.facilityID
WHERE E.senderID = 12 -- enter id number
ORDER BY E.emailDate;

