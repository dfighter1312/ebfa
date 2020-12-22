INSERT INTO `ebook_store`.`authors` (`author_id`, `fname`, `lname`, `author_email`) VALUES ('1', 'Dan', 'Brown', 'danb@gmail.com');
INSERT INTO `ebook_store`.`authors` (`author_id`, `fname`, `lname`, `author_email`) VALUES ('2', 'Aoyama', 'Nanae', 'aone@gmail.com');
INSERT INTO `ebook_store`.`authors` (`author_id`, `fname`, `lname`, `author_email`) VALUES ('3', 'Paolo', 'Coelho', 'paolocoelho@gmail.com');
INSERT INTO `ebook_store`.`authors` (`author_id`, `fname`, `lname`, `author_email`) VALUES ('4', 'Yvonne', 'Vera', 'yvera@gmail.com');
INSERT INTO `ebook_store`.`authors` (`author_id`, `fname`, `lname`, `author_email`) VALUES ('5', 'Roger', 'Abrahams', 'rogerabra@gmail.com');

INSERT INTO `ebook_store`.`books` (`ISBN`, `Title`, `Year`, `Price`, `Publisher`, `stock_status`) VALUES ('1', 'The Alchemist', '2018', '25', 'Harper Collins', 'out of stock');
INSERT INTO `ebook_store`.`books` (`ISBN`, `Title`, `Year`, `Price`, `Publisher`, `stock_status`) VALUES ('2', 'A perfect day to be alone', '2010', '10', 'Kawade Shobo', 'in-stock');
INSERT INTO `ebook_store`.`books` (`ISBN`, `Title`, `Year`, `Price`, `Publisher`, `stock_status`) VALUES ('3', 'Da Vinci Code', '2003', '30', 'Doubleday Fiction', 'in-stock');
INSERT INTO `ebook_store`.`books` (`ISBN`, `Title`, `Year`, `Price`, `Publisher`, `stock_status`) VALUES ('4', 'Opening Spaces', '2010', '15', 'Pearson', 'in-stock');
INSERT INTO `ebook_store`.`books` (`ISBN`, `Title`, `Year`, `Price`, `Publisher`, `stock_status`) VALUES ('5', 'African Folktales', '2010', '20', 'Pantheon', 'out of stock');

INSERT INTO `ebook_store`.`written`(`wauthorid`,`wbookid`) VALUES (1,3);
INSERT INTO `ebook_store`.`written`(`wauthorid`,`wbookid`) VALUES (2,2);
INSERT INTO `ebook_store`.`written`(`wauthorid`,`wbookid`) VALUES (3,1);
INSERT INTO `ebook_store`.`written`(`wauthorid`,`wbookid`) VALUES (4,4);
INSERT INTO `ebook_store`.`written`(`wauthorid`,`wbookid`) VALUES (5,5);

INSERT INTO `ebook_store`.`category`(`catebookid`,`category_name`) VALUES (1, 'Philosphy');
INSERT INTO `ebook_store`.`category`(`catebookid`,`category_name`) VALUES (2, 'Novel');
INSERT INTO `ebook_store`.`category`(`catebookid`,`category_name`) VALUES (3, 'Novel');
INSERT INTO `ebook_store`.`category`(`catebookid`,`category_name`) VALUES (4, 'Scientific');
INSERT INTO `ebook_store`.`category`(`catebookid`,`category_name`) VALUES (5, 'folktales');
INSERT INTO `ebook_store`.`category`(`catebookid`,`category_name`) VALUES (1, 'Novel');

INSERT INTO `ebook_store`.`keyword`(`keybookid`,`keywords`) VALUES (1, 'Paolo');
INSERT INTO `ebook_store`.`keyword`(`keybookid`,`keywords`) VALUES (1, 'Best selling');
INSERT INTO `ebook_store`.`keyword`(`keybookid`,`keywords`) VALUES (1, 'Bible');
INSERT INTO `ebook_store`.`keyword`(`keybookid`,`keywords`) VALUES (2, 'Cat');
INSERT INTO `ebook_store`.`keyword`(`keybookid`,`keywords`) VALUES (2, 'Japanese');
INSERT INTO `ebook_store`.`keyword`(`keybookid`,`keywords`) VALUES (2, 'Adult');
INSERT INTO `ebook_store`.`keyword`(`keybookid`,`keywords`) VALUES (3, 'Drama');
INSERT INTO `ebook_store`.`keyword`(`keybookid`,`keywords`) VALUES (3, 'Dan Brown');
INSERT INTO `ebook_store`.`keyword`(`keybookid`,`keywords`) VALUES (3, 'Best selling');
INSERT INTO `ebook_store`.`keyword`(`keybookid`,`keywords`) VALUES (4, 'universe');
INSERT INTO `ebook_store`.`keyword`(`keybookid`,`keywords`) VALUES (4, 'spaces');
INSERT INTO `ebook_store`.`keyword`(`keybookid`,`keywords`) VALUES (5, 'folklore');

INSERT INTO `ebook_store`.`customer` VALUES ('1', 'A', 'BC', '0234912378', 'House1', 'City1', 'VN');
INSERT INTO `ebook_store`.`customer` VALUES ('2', 'B', 'CD', '0123812378', 'House2', 'City2', 'EN');
INSERT INTO `ebook_store`.`customer` VALUES ('3', 'C', 'DE', '0324897324', 'House3', 'City3', 'VN');
INSERT INTO `ebook_store`.`customer` VALUES ('4', 'D', 'XY', '021389723', 'House4', 'City2', 'VN');
INSERT INTO `ebook_store`.`customer` VALUES ('5', 'E', 'YZ', '012381382', 'House5', 'City3', 'EN');

INSERT INTO `ebook_store`.`credit_card` VALUES ('1', '13/12/27', 'BankA', 'Branch1', '1');
INSERT INTO `ebook_store`.`credit_card` VALUES ('2', '1/7/19', 'BankB', 'Branch1', '2');
INSERT INTO `ebook_store`.`credit_card` VALUES ('3', '4/4/20', 'BankA', 'Branch2', '2');
INSERT INTO `ebook_store`.`credit_card` VALUES ('5', '7/7/21', 'BankC', 'Branch1', '3');
INSERT INTO `ebook_store`.`credit_card` VALUES ('6', '2/3/19', 'BankE', 'Branch6', '4');


INSERT INTO `ebook_store`.`warehouse` VALUES ('1', '0923973929', 'PlaceA', 'City2', 'CN');
INSERT INTO `ebook_store`.`warehouse` VALUES ('2', '0218373129', 'PlaceB', 'City3', 'VN');
INSERT INTO `ebook_store`.`warehouse` VALUES ('3', '0328921387', 'PlaceC', 'City2', 'EN');
INSERT INTO `ebook_store`.`warehouse` VALUES ('4', '0139217378', 'PlaceD', 'City1', 'EN');
INSERT INTO `ebook_store`.`warehouse` VALUES ('5', '0101010101', 'PlaceE', 'City1', 'EN');

INSERT INTO `ebook_store`.`stock_request` (`request_id`, `publisher`, `request_date`, `to_warehouse`) VALUES (1, 'Harper Collins', '1/1/20', 3);
INSERT INTO `ebook_store`.`stock_request` (`request_id`, `publisher`, `request_date`, `to_warehouse`) VALUES (2, 'Pantheon', '4/4/20', 5);

INSERT INTO `ebook_store`.`restock` (`rid`, `rbookid`, `stock_num`) VALUES (1, 1, 100);
INSERT INTO `ebook_store`.`restock` (`rid`, `rbookid`, `stock_num`) VALUES (2, 5, 100);

INSERT INTO `ebook_store`.`in_stock` (`storeid`, `stockid`, `numstock`) VALUES (1, 2, 300);
INSERT INTO `ebook_store`.`in_stock` (`storeid`, `stockid`, `numstock`) VALUES (1, 3, 10);
INSERT INTO `ebook_store`.`in_stock` (`storeid`, `stockid`, `numstock`) VALUES (2, 4, 50);
INSERT INTO `ebook_store`.`in_stock` (`storeid`, `stockid`, `numstock`) VALUES (4, 4, 200);

INSERT INTO `ebook_store`.`orders` (`order_id`, `customer_id`, `pmethod`, `issue_date`, `status`, `total_cost`) VALUES ('1', '1', 'Credit Card', '1/1/20', 'Finished', '100');
INSERT INTO `ebook_store`.`orders` (`order_id`, `customer_id`, `pmethod`, `issue_date`, `status`, `total_cost`) VALUES ('2', '4', 'Cash', '2/2/20', 'Finished', '30');
INSERT INTO `ebook_store`.`orders` (`order_id`, `customer_id`, `pmethod`, `issue_date`, `status`, `total_cost`) VALUES ('3', '1', 'Credit Card', '3/2/20', 'Finished ', '30');
INSERT INTO `ebook_store`.`orders` (`order_id`, `customer_id`, `pmethod`, `issue_date`, `status`, `total_cost`) VALUES ('4', '5', 'Bank Deposit', '7/7/20', 'Shipping', '70');

INSERT INTO `ebook_store`.`buy_order` VALUES ('1', '1', '4');
INSERT INTO `ebook_store`.`buy_order` VALUES ('2', '3', '1');

INSERT INTO `ebook_store`.`rent_order` VALUES ('3', '3', '10/10/20');
INSERT INTO `ebook_store`.`rent_order` VALUES ('4', '2', '11/11/20');
INSERT INTO `ebook_store`.`rent_order` VALUES ('4', '1', '11/11/20');
INSERT INTO `ebook_store`.`rent_order` VALUES ('4', '3', '11/11/20');

