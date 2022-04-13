SELECT DISTINCT D.dID, COUNT(DISTINCT I.iID) AS numOfIngredients
FROM Dish D
         JOIN Recipe R on D.dID = R.dID
         JOIN Ingredient I on I.iID = R.iID
GROUP BY D.dID, D.dname, D.dname, D.cuisine, D.vegetarian
HAVING 3 <= numOfIngredients
   AND numOfIngredients <= 5
ORDER BY D.dID DESC