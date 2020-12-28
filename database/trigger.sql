USE `ebook_store`;

DELIMITER //
DROP TRIGGER IF EXISTS book_status;
CREATE TRIGGER book_status AFTER UPDATE 
ON `ebook_store`.in_stock FOR EACH ROW
BEGIN 
	IF OLD.numstock <> 0 AND NEW.numstock = 0 THEN
		UPDATE `books` SET `books`.stock_status =  'OUT_OF_STOCK' WHERE `books`.ISBN = NEW.stockid;
	END IF;
    IF OLD.numstock = 0 AND NEW.numstock <> 0 THEN
		UPDATE `books` SET `books`.stock_status  = 'IN_STOCK' WHERE `books`.ISBN = NEW.stockid;
	END IF;
END ;
DELIMITER ;

DELIMITER //
DROP FUNCTION IF EXISTS find_warehouse;
CREATE FUNCTION find_warehouse (r_id INT)
RETURNS INT 
BEGIN 
	DECLARE warehouse_identity INT;
	SET warehouse_identity = 0;
	SELECT `to_warehouse` INTO warehouse_identity
	FROM ebook_store.stock_request
	WHERE stock_request.request_id = r_id;
	RETURNS warehouse_identity;
END ;
DELIMITER ;

DELIMITER //
CREATE TRIGGER stock_update AFTER UPDATE 
ON `ebook_store`.restock FOR EACH ROW
BEGIN 
	DECLARE storageid INT;
	SET storageid = find_warehouse(NEW.rid);

	IF NEW.stock_num <> 0 THEN
		UPDATE `in_stock` SET `in_stock`.numstock =  NEW.stock_num WHERE `in_stock`.storeid = storeid AND `in_stock`.stockid = NEW.rbookid;
	END IF;
END ;
DELIMITER ;

