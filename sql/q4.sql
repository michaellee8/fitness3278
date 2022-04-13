SELECT DISTINCT D.dID, D.dname
FROM Dish D
         JOIN Recipe R on D.dID = R.dID
         JOIN Ingredient I on I.iID = R.iID
GROUP BY D.dID, D.dname, D.dname, D.cuisine, D.vegetarian
HAVING SUM(case when I.iname = 'King Crab Legs' AND I.madeIn = 'Alaska' then 1 else 0 end) > 0
ORDER BY D.dID DESC