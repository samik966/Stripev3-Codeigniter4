CREATE TABLE `pay_customer` (
  `c_id` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `pay_transactions` (
  `pay_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `transact_id` varchar(255) NOT NULL,
  `transact_amt` decimal(10,0) NOT NULL,
  `transact_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `pay_customer`
  ADD PRIMARY KEY (`c_id`);

ALTER TABLE `pay_transactions`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `c_id` (`c_id`);


ALTER TABLE `pay_customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `pay_transactions`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `pay_transactions`
  ADD CONSTRAINT `pay_transactions_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `pay_customer` (`c_id`);