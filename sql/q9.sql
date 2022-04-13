SELECT DISTINCT COUNT(DISTINCT D.dID) as dishCount
FROM Ingredient I
         LEFT JOIN Recipe R on I.iID = R.iID
         LEFT JOIN Dish D on D.dID = R.dID
WHERE I.iname = 'Geoduck'
GROUP BY I.iID, I.iname
ORDER BY I.iID DESC