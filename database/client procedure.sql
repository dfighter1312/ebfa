USE `ebook_store`;

DELIMITER //
DROP PROCEDURE if EXISTS  search_by_cate //
CREATE PROCEDURE
	search_by_cate(cate varchar(50))
BEGIN
    SELECT 
        books.title
    FROM
        books
	JOIN
		category
	ON books.ISBN = category.catebookid
    WHERE
        category_name = cate
    ;    
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  search_by_authors //
CREATE PROCEDURE
	search_by_authors(aut varchar(50))
BEGIN
    SELECT bookwritten.*
	FROM (
	SELECT *
	FROM books 
	JOIN written 
	ON books.ISBN = written.wbookid) bookwritten
	JOIN authors
	ON bookwritten.wauthorid = authors.author_id
	where authors.fname = aut
    ;    
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  search_by_keywords //
CREATE PROCEDURE
	search_by_keywords(keyw varchar(50))
BEGIN
    SELECT *
	FROM books, keyword
	WHERE keywords = keyw AND books.ISBN = keyword.keybookid
    ;    
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  search_by_years //
CREATE PROCEDURE
	search_by_years(ypub INT)
BEGIN
   SELECT * 
	FROM books
	WHERE books.year = ypub
    ;    
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  bought_in_month //
CREATE PROCEDURE
	bought_in_month(m  INT, cid INT)
BEGIN
  SELECT Title 
FROM customer 
JOIN
(SELECT * 
	FROM books 
	JOIN
		(SELECT * 
		FROM orders 
		JOIN
			(SELECT *
			FROM rent_order a
			LEFT JOIN buy_order b 
			ON a.roid = b.oid) c
		ON orders.order_id = c.oid  OR orders.order_id = c.roid) d
	ON books.ISBN = d.buyid OR books.ISBN = d.rentid) e

ON customer.customer_id = e.customer_id
WHERE customer.customer_id = cid AND MONTH(issue_date) = m
;    
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  trans_in_month //
CREATE PROCEDURE
	trans_in_month(m INT, cid INT)
BEGIN
   SELECT order_id, pmethod, issue_date, status, total_cost
	FROM customer a
	JOIN orders b
	ON a.customer_id = b.customer_id
	WHERE MONTH(issue_date) = m AND a.customer_id = cid
    ;    
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  failed_trans_in_month //
CREATE PROCEDURE
	failed_trans_in_month(m INT, cid INT)
BEGIN
   SELECT order_id, pmethod, issue_date, status, total_cost
	FROM customer a
	JOIN orders b
	ON a.customer_id = b.customer_id
	WHERE MONTH(issue_date) = m AND a.customer_id = cid AND status = 'Failed'
    ;    
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  uncompleted_trans_in_month //
CREATE PROCEDURE
	uncompleted_trans_in_month(m INT, cid INT)
BEGIN
  SELECT order_id, pmethod, issue_date, status, total_cost
	FROM customer a
	JOIN orders b
	ON a.customer_id = b.customer_id
	WHERE MONTH(issue_date) = m AND a.customer_id = cid AND status = 'Pending'
    ;    
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  authors_in_category //
CREATE PROCEDURE
	authors_in_category(cate varchar(50))
BEGIN
  SELECT fname, lname
FROM
(SELECT*
FROM 
(SELECT *
FROM books
JOIN category
ON books.ISBN = category.catebookid
WHERE category_name = cate) a
JOIN written
ON a.ISBN = written.wbookid) b
JOIN authors
ON b.wauthorid = authors.author_id
    ;    
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  authors_in_keywords //
CREATE PROCEDURE
	authors_in_keywords(keyw varchar(50))
BEGIN
SELECT fname, lname
FROM
(SELECT*
FROM 
(SELECT *
FROM books
JOIN keyword
ON books.ISBN = keyword.keybookid
WHERE keywords = keyw) a
JOIN written
ON a.ISBN = written.wbookid) b
JOIN authors
on b.wauthorid = authors.author_id
    ;    
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  book_by_genre_purchased //
CREATE PROCEDURE
	book_by_genre_purchased(genre varchar(50), cid INT)
BEGIN
SELECT Title 
FROM customer 
JOIN
(SELECT *
FROM category
JOIN
(SELECT * 
	FROM books 
	JOIN
		(SELECT * 
		FROM orders 
		JOIN
			(SELECT *
			FROM rent_order a
			LEFT JOIN buy_order b 
			ON a.roid = b.oid) c
		ON orders.order_id = c.oid  OR orders.order_id = c.roid) d
	ON books.ISBN = d.buyid OR books.ISBN = d.rentid) e
ON category.catebookid = e.ISBN 
WHERE category_name = genre) finishing
ON customer.customer_id = finishing.customer_id
WHERE customer.customer_id = cid
    ;    
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  most_purchased_made //
CREATE PROCEDURE
	most_purchased_made(cid INT,  m INT, y INT)
BEGIN
SELECT order_id, sum(quantity)
FROM orders, buy_order, customer
WHERE orders.order_id = buy_order.oid AND MONTH(orders.issue_date) = m AND YEAR(orders.issue_date) = y AND orders.customer_id = customer.customer_id AND customer.customer_id = cid
GROUP BY order_id
ORDER BY sum(quantity) DESC
    ;    
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  both_trans //
CREATE PROCEDURE
	both_trans(cid INT,  m INT, y INT)
BEGIN
SELECT Title 
FROM customer 
JOIN
(SELECT * 
	FROM books 
	JOIN
		(SELECT * 
		FROM orders 
		JOIN
			(SELECT *
			FROM rent_order a
			JOIN buy_order b 
			ON a.roid = b.oid) c
		ON orders.order_id = c.oid  AND orders.order_id = c.roid) d
	ON books.ISBN = d.buyid AND books.ISBN = d.rentid) e

ON customer.customer_id = e.customer_id
WHERE customer.customer_id = cid AND MONTH(issue_date) = m AND YEAR(issue_date) = y;    
END//
delimiter ;


