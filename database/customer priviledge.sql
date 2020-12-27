DROP USER IF EXISTS 'customer'@'%';
CREATE USER 'customer'@'%' IDENTIFIED BY 'password';
GRANT INSERT, UPDATE ON ebook_store.customer to 'customer'@'%';
GRANT INSERT, UPDATE, DELETE ON ebook_store.credit_card to 'customer'@'%';
GRANT UPDATE ON ebook_store.buy_order to 'customer'@'%';
GRANT UPDATE ON ebook_store.rent_order to 'customer'@'%';
SHOW GRANTS FOR customer;
