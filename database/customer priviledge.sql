GRANT SELECT, INSERT, UPDATE ON ebook_store.customer to 'customer'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON ebook_store.credit_card to 'customer'@'%';
GRANT SELECT, UPDATE ON ebook_store.buy_order to 'customer'@'%';
GRANT SELECT, UPDATE ON ebook_store.rent_order to 'customer'@'%';
SHOW GRANTS FOR customer;
