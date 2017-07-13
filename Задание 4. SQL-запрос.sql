SELECT DISTINCT game
FROM users
INNER JOIN payments
ON user_id=users.id
WHERE level>10
GROUP BY nickname, game
HAVING sum(amount) > 100
GO
