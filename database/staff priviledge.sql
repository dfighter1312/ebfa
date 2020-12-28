DROP USER IF EXISTS 'staff'@'localhost';
CREATE USER 'staff'@'localhost' IDENTIFIED BY 'password';
GRANT SELECT, UPDATE on ebook_store.books to 'staff'@'localhost';
GRANT SELECT on ebook_store.authors to 'staff'@'localhost';
GRANT SELECT, UPDATE on ebook_store.orders to 'staff'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE on ebook_store.stock_request to 'staff'@'localhost';
GRANT SELECT on ebook_store.warehouse to 'staff'@'localhost';
GRANT SELECT on ebook_store.in_stock to 'staff'@'localhost';
SHOW GRANTS FOR 'staff'@'localhost';