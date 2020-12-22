GRANT SELECT, INSERT, UPDATE ON ebook_store.customer to 'customer'@'%';
GRANT SELECT, INSERT, UPDATE ON ebook_store.credit_card to 'customer'@'%';
GRANT SELECT, UPDATE ON ebook_store.orders to 'customer'@'%';
SHOW GRANTS FOR customer;
