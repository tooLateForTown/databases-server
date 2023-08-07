SELECT
    emailDate,
    senderName,
    receiver,
    subject,
    emailBody
FROM Emails
WHERE senderID = 12 -- Replace with the ID of the given facility
ORDER BY emailDate ASC;
