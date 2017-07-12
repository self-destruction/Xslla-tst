SELECT game 
FROM users, payments 
WHERE level>10 AND user_id=users.id 
GROUP BY game 
HAVING sum(amount) > 100
