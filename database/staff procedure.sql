USE `ebook_store`;

DELIMITER //
DROP PROCEDURE if EXISTS  id_purchased //
CREATE PROCEDURE
	id_purchased(today date)
BEGIN
    SELECT ISBN
FROM orders, buy_order, books
WHERE orders.issue_date = today AND orders.order_id = buy_order.oid 
								AND buy_order.buyid = books.ISBN;
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  total_id_purchased //
CREATE PROCEDURE
	total_id_purchased(today date)
BEGIN
SELECT ISBN, SUM(quantity)
FROM orders, buy_order, books
WHERE orders.issue_date = today AND orders.order_id = buy_order.oid AND buy_order.buyid = books.ISBN
GROUP BY ISBN;
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  authors_most_purchased//
CREATE PROCEDURE
	authors_most_purchased (today date)
BEGIN
SELECT fname, lname, SUM(quantity)
FROM orders, buy_order, authors, written
WHERE orders.issue_date = today AND orders.order_id = buy_order.oid AND buy_order.buyid = written.wbookid AND written.wauthorid = authors.author_id
GROUP BY fname, lname
ORDER BY SUM(quantity) DESC;
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  authors_most_purchased_month//
CREATE PROCEDURE
	authors_most_purchased_month (m INT, y INT)
BEGIN
SELECT fname, lname, SUM(quantity)
FROM orders, buy_order, authors, written
WHERE MONTH(orders.issue_date) = m AND YEAR(orders.issue_date) = y AND orders.order_id = buy_order.oid AND buy_order.buyid = written.wbookid AND written.wauthorid = authors.author_id
GROUP BY fname, lname
ORDER BY SUM(quantity) DESC;
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  printed_book_purchased//
CREATE PROCEDURE
	 printed_book_purchased (today date)
BEGIN
SELECT buyid, SUM(quantity)
FROM orders, buy_order
WHERE orders.issue_date = today AND orders.order_id = buy_order.oid AND buy_order.buyid IN
(SELECT eISBN
FROM ebook);
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  ebook_purchased//
CREATE PROCEDURE
	 ebook_purchased (today date)
BEGIN
SELECT buyid, SUM(quantity)
FROM orders, buy_order
WHERE orders.issue_date = today AND orders.order_id = buy_order.oid  AND buy_order.quantity = 0 AND buy_order.buyid IN
(SELECT eISBN
FROM ebook);
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  ebook_rented//
CREATE PROCEDURE
	 ebook_rented (today date)
BEGIN
SELECT COUNT(*)
FROM orders, rent_order, books
WHERE orders.issue_date = today AND orders.order_id = rent_order.roid AND buy_order.buyid = books.ISBN;
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  most_bought_month//
CREATE PROCEDURE
	 most_bought_month (m INT, y int)
BEGIN
SELECT ISBN, title, sum(quantity)
FROM orders, buy_order, books
WHERE MONTH(orders.issue_date) = m AND YEAR(orders.issue_date) = y AND orders.order_id = buy_order.oid AND buy_order.buyid = books.ISBN
GROUP BY ISBN
ORDER BY SUM(quantity) DESC;
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  purchased_by_cards//
CREATE PROCEDURE
	  purchased_by_cards (today date)
BEGIN
SELECT *
FROM orders
WHERE pmethod = 'credit' AND orders.issue_date = today;
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  purchased_by_cards_troubled//
CREATE PROCEDURE
	  purchased_by_cards_troubled (today date)
BEGIN
SELECT *
FROM orders
WHERE pmethod = 'credit' AND status = 'error' AND orders.issue_date = today;
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  warehouse_books//
CREATE PROCEDURE
	  warehouse_books (today date)
BEGIN
SELECT rbookid, to_warehouse, stock_num
FROM restock, stock_request
WHERE restock.rbookid = stock_request.request_id AND stock_num < 10 AND request_date = today;
END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  warehouse_books_month//
CREATE PROCEDURE
	  warehouse_books_month (m INT, y INT)
BEGIN
SELECT rbookid, to_warehouse, SUM(stock_num)
FROM restock, stock_request
WHERE restock.rbookid = stock_request.request_id AND MONTH(request_date) = m AND YEAR(request_date) = y
GROUP BY rbookid, to_warehouse;END//
delimiter ;

DELIMITER //
DROP PROCEDURE if EXISTS  most_exported_book//
CREATE PROCEDURE
	  most_exported_book (m INT, y INT)
BEGIN
SELECT buyid, SUM(quantity)
FROM orders, buy_order
WHERE MONTH(orders.issue_date) = m AND YEAR(orders.issue_date) = y AND status = 'Shipped' AND orders.order_id = buy_order.oid AND buy_order.buyid IN
(SELECT eISBN
FROM ebook);
delimiter ;