SELECT DISTINCT I.iID, COUNT(DISTINCT D.dID) as numOfKoreanDishes
FROM Ingredient I
         LEFT JOIN Recipe R on I.iID = R.iID
         LEFT JOIN Dish D on D.dID = R.dID
WHERE D.cuisine = 'Korean'
  AND I.madeIn = 'Japan'
GROUP BY I.iID, I.iname
ORDER BY I.iID DESC