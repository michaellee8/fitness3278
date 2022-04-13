SELECT DISTINCT I.iID, I.iname
FROM Ingredient I
         LEFT JOIN Recipe R on I.iID = R.iID
         LEFT JOIN Dish D on D.dID = R.dID
GROUP BY I.iID, I.iname
HAVING SUM(case when D.cuisine = 'Chinese' then 1 else 0 end) = 0
ORDER BY I.iID DESC