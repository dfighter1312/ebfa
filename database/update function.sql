USE `ebook_store`;

DELIMITER //
DROP FUNCTION IF exists book_stock_update;
CREATE FUNCTION book_stock_update (b_id INT, b_status varchar(50))
RETURNS INT DETERMINISTIC
BEGIN 
	UPDATE `book` SET `status` = b_status WHERE `ISBN` = b_id;
	RETURN 1;
END;
DELIMITER;

DELIMITER //
DROP FUNCTION IF exists order_status_update;
CREATE FUNCTION order_status_update (o_id INT, o_status varchar(50))
RETURNS INT DETERMINISTIC
BEGIN 
    UPDATE `ebook_store`.`orders` SET `status` = o_status WHERE (`order_id` = o_id);
	RETURN 1;
END;
DELIMITER;

DELIMITER //
DROP FUNCTION IF exists order_status_update;
CREATE FUNCTION order_status_update (o_id INT, o_status varchar(50))
RETURNS INT DETERMINISTIC
BEGIN 
    UPDATE `ebook_store`.`orders` SET `status` = o_status WHERE (`order_id` = o_id);
	RETURN 1;
END;
DELIMITER;

DELIMITER //
DROP FUNCTION IF exists customer_update;
CREATE FUNCTION customer_update (cid INT, fname varchar(50), lname varchar(50), phoneno varchar(50), house varchar(50), city varchar(50), state_living varchar(50))

RETURNS INT DETERMINISTIC
BEGIN 
    UPDATE `customer` SET `first_name` = fname WHERE (`customer_id` = cid);
    UPDATE `customer` SET `last_name` = lname WHERE (`customer_id` = cid);
    UPDATE `customer` SET `phoneno` = phoneno WHERE (`customer_id` = cid);
    UPDATE `customer` SET `address` = house WHERE (`customer_id` = cid);
    UPDATE `customer` SET `city` = city WHERE (`customer_id` = cid);
    UPDATE `customer` SET `state` = state_living WHERE (`customer_id` = cid);
	RETURN 1;
END;
DELIMITER;

DELIMITER //
DROP FUNCTION IF exists payment_update;
CREATE FUNCTION payment_update (o_id INT, card_id INT, bank_branch varchar(50), bank_name varchar(50))
RETURNS INT DETERMINISTIC
BEGIN 
    UPDATE `credit_card` SET `card_id` = card_id WHERE (`owner_id` = o_id);
    UPDATE `credit_card` SET `bank_branch` = bank_branch WHERE (`owner_id` = o_id);
    UPDATE `credit_card` SET `bank_name` = card_id WHERE (`owner_id` = o_id);
	RETURN 1;
END;
DELIMITER;

DELIMITER //
DROP FUNCTION IF exists paymethod_update;
CREATE FUNCTION paymethod_update (cid INT, pmethod varchar(50))
RETURNS INT DETERMINISTIC
BEGIN 
    UPDATE orders a
    JOIN customer b
    ON a.customer_id = b.customer_id
    SET a.pmethod = pmethod
    WHERE b.customer_id = cid;
    RETURN 1;
END;
DELIMITER;