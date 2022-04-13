SELECT DISTINCT I.iID, I.iname
FROM Dish D
         JOIN Recipe R on D.dID = R.dID
         JOIN Ingredient I on I.iID = R.iID
WHERE D.cuisine = 'Chinese'
GROUP BY I.iID, I.iname
HAVING SUM(case when D.introduction LIKE '%crab%' then 1 else 0 end) > 0
ORDER BY I.iID DESC