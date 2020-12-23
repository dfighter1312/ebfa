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
END;
DELIMITER;
