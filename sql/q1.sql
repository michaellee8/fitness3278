SELECT I.iID, I.iname, R.usageDec
FROM Ingredient AS I
         JOIN Recipe R on I.iID = R.iID
         JOIN Dish D on D.dID = R.dID
WHERE D.dID = 2
ORDER BY I.iID DESC