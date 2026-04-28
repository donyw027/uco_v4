-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table uco_v4.company_profile
CREATE TABLE IF NOT EXISTS `company_profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_name` varchar(150) DEFAULT NULL,
  `address` text,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `bank_info` text,
  `signature_name` varchar(100) DEFAULT NULL,
  `signature_title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.company_profile: ~10 rows (approximately)
INSERT INTO `company_profile` (`id`, `company_name`, `address`, `phone`, `email`, `bank_info`, `signature_name`, `signature_title`) VALUES
	(10, 'Uco Exportindo Constulting', 'Perum Majapahit, Pungging – Mojokerto', '+62-896-7257-4222', 'ucoexporindo@gmail.com', 'Mandiri - 1420026750074\r\nAccount Name : Uco Exportindo Constulting', 'Doni Wicaksono', 'Director Of Marketing');

-- Dumping structure for table uco_v4.currencies
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `currency_code` varchar(10) NOT NULL,
  `currency_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.currencies: ~10 rows (approximately)
INSERT INTO `currencies` (`id`, `currency_code`, `currency_name`) VALUES
	(1, 'USD', 'US Dollar'),
	(2, 'IDR', 'Indonesian Rupiah'),
	(3, 'EUR', 'Euro'),
	(4, 'JPY', 'Japanese Yen'),
	(5, 'SGD', 'Singapore Dollar'),
	(6, 'MYR', 'Malaysian Ringgit'),
	(7, 'CNY', 'Chinese Yuan'),
	(8, 'GBP', 'British Pound'),
	(9, 'AUD', 'Australian Dollar'),
	(10, 'THB', 'Thai Baht');

-- Dumping structure for table uco_v4.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(50) DEFAULT NULL,
  `company_name` varchar(150) NOT NULL,
  `pic_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text,
  `country` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.customers: ~11 rows (approximately)
INSERT INTO `customers` (`id`, `customer_code`, `company_name`, `pic_name`, `email`, `phone`, `address`, `country`, `is_active`) VALUES
	(1, 'CUST-001', 'Customer 1 Trading', 'Customer PIC 1', 'customer1@mail.com', '+62-21-7700001', 'Jl. Customer No. 1, Jakarta', 'Indonesia', 1),
	(2, 'CUST-002', 'Customer 2 Trading', 'Customer PIC 2', 'customer2@mail.com', '+62-21-7700002', 'Jl. Customer No. 2, Jakarta', 'Indonesia', 1),
	(3, 'CUST-003', 'Customer 3 Trading', 'Customer PIC 3', 'customer3@mail.com', '+62-21-7700003', 'Jl. Customer No. 3, Jakarta', 'Indonesia', 1);

-- Dumping structure for table uco_v4.document_sequences
CREATE TABLE IF NOT EXISTS `document_sequences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `doc_type` varchar(20) NOT NULL,
  `yyyymm` varchar(6) NOT NULL,
  `last_number` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_doc_seq` (`doc_type`,`yyyymm`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.document_sequences: ~13 rows (approximately)
INSERT INTO `document_sequences` (`id`, `doc_type`, `yyyymm`, `last_number`) VALUES
	(1, 'SO', '202603', 11),
	(2, 'PL', '202603', 11),
	(3, 'INV', '202603', 11),
	(4, 'GRN', '202603', 10),
	(5, 'PO', '202603', 10),
	(6, 'STK', '202603', 10),
	(7, 'ADJ', '202603', 10),
	(8, 'RTN', '202603', 10),
	(9, 'DO', '202603', 10),
	(10, 'SJ', '202603', 10),
	(11, 'PL', '202604', 5),
	(12, 'SO', '202604', 3),
	(13, 'INV', '202604', 84);

-- Dumping structure for table uco_v4.fee_slips
CREATE TABLE IF NOT EXISTS `fee_slips` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slip_no` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `slip_date` date NOT NULL,
  `period_text` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payee_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `position_text` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bank_account` text COLLATE utf8mb4_general_ci,
  `payment_term` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `currency_text` varchar(20) COLLATE utf8mb4_general_ci DEFAULT 'IDR',
  `description` text COLLATE utf8mb4_general_ci,
  `notes` text COLLATE utf8mb4_general_ci,
  `gross_fee` decimal(18,2) NOT NULL DEFAULT '0.00',
  `capital_contribution` decimal(18,2) NOT NULL DEFAULT '0.00',
  `deduction_amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `take_home_pay` decimal(18,2) NOT NULL DEFAULT '0.00',
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slip_no` (`slip_no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uco_v4.fee_slips: ~1 rows (approximately)
INSERT INTO `fee_slips` (`id`, `slip_no`, `slip_date`, `period_text`, `payee_name`, `position_text`, `bank_account`, `payment_term`, `currency_text`, `description`, `notes`, `gross_fee`, `capital_contribution`, `deduction_amount`, `tax_amount`, `take_home_pay`, `created_by`, `created_at`) VALUES
	(1, '31231', '2026-04-28', 'April 2026', '312', '123', '321', 'Monthly Fee Distribution', 'IDR', 'Fee distribution for consulting service related to:', 'Deduction is allocated as initial capital contribution based on mutual agreement.', 123132.00, 1231.00, 123.00, 12.00, 121766.00, 2, '2026-04-28 12:17:52');

-- Dumping structure for table uco_v4.incoterms
CREATE TABLE IF NOT EXISTS `incoterms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `incoterm_code` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.incoterms: ~10 rows (approximately)
INSERT INTO `incoterms` (`id`, `incoterm_code`, `description`) VALUES
	(1, 'FOB', 'Free On Board'),
	(2, 'CIF', 'Cost Insurance and Freight'),
	(3, 'EXW', 'Ex Works'),
	(4, 'CNF', 'Cost and Freight'),
	(5, 'DAP', 'Delivered at Place'),
	(6, 'DDP', 'Delivered Duty Paid'),
	(7, 'FCA', 'Free Carrier'),
	(8, 'CPT', 'Carriage Paid To'),
	(9, 'CIP', 'Carriage and Insurance Paid To'),
	(10, 'FAS', 'Free Alongside Ship');

-- Dumping structure for table uco_v4.invoices
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sales_order_id` int NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `invoice_date` date NOT NULL,
  `notes` text,
  `total_amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_no` (`invoice_no`),
  KEY `fk_inv_so` (`sales_order_id`),
  CONSTRAINT `fk_inv_so` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.invoices: ~12 rows (approximately)
INSERT INTO `invoices` (`id`, `sales_order_id`, `invoice_no`, `invoice_date`, `notes`, `total_amount`, `created_at`) VALUES
	(14, 14, 'INV-UCO/202604/0084', '2026-04-28', '', 1476000.00, '2026-04-28 13:13:48');

-- Dumping structure for table uco_v4.invoice_items
CREATE TABLE IF NOT EXISTS `invoice_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_id` int NOT NULL,
  `sales_order_item_id` int NOT NULL,
  `qty` decimal(18,2) NOT NULL DEFAULT '0.00',
  `unit_price` decimal(18,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `fk_invitem_inv` (`invoice_id`),
  KEY `fk_invitem_soitem` (`sales_order_item_id`),
  CONSTRAINT `fk_invitem_inv` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_invitem_soitem` FOREIGN KEY (`sales_order_item_id`) REFERENCES `sales_order_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.invoice_items: ~15 rows (approximately)
INSERT INTO `invoice_items` (`id`, `invoice_id`, `sales_order_item_id`, `qty`, `unit_price`, `amount`) VALUES
	(17, 14, 27, 123.00, 12000.00, 1476000.00);

-- Dumping structure for table uco_v4.manual_inquiries
CREATE TABLE IF NOT EXISTS `manual_inquiries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proposal_no` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `proposal_date` date NOT NULL,
  `recipient_company` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `recipient_address` text COLLATE utf8mb4_general_ci,
  `recipient_pic` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `opening_text` text COLLATE utf8mb4_general_ci,
  `terms_text` text COLLATE utf8mb4_general_ci,
  `closing_text` text COLLATE utf8mb4_general_ci,
  `currency_text` varchar(20) COLLATE utf8mb4_general_ci DEFAULT 'IDR',
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `document_type` enum('commercial_proposal','business_proposal','quotation','service_offer') COLLATE utf8mb4_general_ci DEFAULT 'commercial_proposal',
  `offer_type` enum('product','service','product_service') COLLATE utf8mb4_general_ci DEFAULT 'product',
  `validity_offer` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lead_time` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `scope_of_work` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proposal_no` (`proposal_no`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uco_v4.manual_inquiries: ~2 rows (approximately)
INSERT INTO `manual_inquiries` (`id`, `proposal_no`, `proposal_date`, `recipient_company`, `recipient_address`, `recipient_pic`, `subject`, `opening_text`, `terms_text`, `closing_text`, `currency_text`, `created_by`, `created_at`, `document_type`, `offer_type`, `validity_offer`, `lead_time`, `scope_of_work`) VALUES
	(1, 'INQ-UCO/202604/8801', '2026-04-14', 'PT. CANADA GREEN GATE', 'Pasuruan – Indonesia', 'PIC', 'Pengurusan Izin Penambahan Barang Jadi Kategori DHE SDA', 'Bersama ini kami menyampaikan penawaran jasa pengurusan perizinan penambahan barang jadi kategori DHE SDA yang akan berhubungan dengan KPPBC Pusat serta Kementerian Perdagangan Republik Indonesia.', '• Pembayaran: 30% saat SPK, 70% setelah izin terbit\r\n• Dokumen disiapkan oleh pihak perusahaan\r\n• Biaya belum termasuk perubahan regulasi tambahan', 'Demikian proposal ini kami sampaikan. Kami berharap dapat menjalin kerja sama yang baik dengan perusahaan Bapak/Ibu.', 'IDR', 1, '2026-04-14 13:04:38', 'commercial_proposal', 'product', NULL, NULL, NULL),
	(3, 'INQ-UCO/202604/1831', '2026-04-25', 'UCO Exportindo Consulting', 'Email: sales@ucoexportindo.com\r\nIndonesia', '', 'OFFER SHEET USED COOKING OIL (UCO)', 'Product: Used Cooking Oil (UCO)', 'Net 30 Days before shipment by T/T\r\nAll banking charges are borne by the buyer.', 'NOTES\r\n-Final quantity subject to mutual agreement\r\n-Product availability subject to stock confirmation\r\n-SGS / inspection can be arranged upon request\r\n-Packaging and loading details will be confirmed before shipment\r\n-Prices are subject to market fluctuation and may change without prior notice\r\n\r\nWe look forward to establishing long-term business cooperation with your esteemed company.\r\n\r\nBest Regards,', 'USD', 2, '2026-04-25 13:35:05', 'commercial_proposal', 'product', NULL, NULL, NULL),
	(4, 'INQ-UCO/202604/4567', '2026-04-28', 'PT Sentosa', 'Malang ID', 'Doni', 'Commercial Offer for Product Supply &amp; Consulting Service', 'Thank you for your interest in our products and services. We are pleased to submit this offer for your review and consideration.', '• Price is subject to final scope, quantity, and destination confirmation.\r\n• Payment term will be agreed before project execution or shipment.\r\n• Banking charges, tax, customs duties, and third-party fees are excluded unless stated otherwise.', 'We hope this offer meets your requirements. Please feel free to contact us for further discussion or adjustment.', 'IDR', 3, '2026-04-28 13:24:59', 'commercial_proposal', 'product_service', '7 days from issued date', 'To be confirmed', 'Product supply, sourcing support, export/import consultation, documentation assistance, and coordination based on client requirements.');

-- Dumping structure for table uco_v4.manual_inquiry_items
CREATE TABLE IF NOT EXISTS `manual_inquiry_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `manual_inquiry_id` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `agency` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duration_text` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `manual_inquiry_id` (`manual_inquiry_id`),
  CONSTRAINT `fk_manual_inquiry_items_header` FOREIGN KEY (`manual_inquiry_id`) REFERENCES `manual_inquiries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uco_v4.manual_inquiry_items: ~4 rows (approximately)
INSERT INTO `manual_inquiry_items` (`id`, `manual_inquiry_id`, `description`, `agency`, `duration_text`, `amount`) VALUES
	(1, 1, 'Registrasi & Izin Penambahan Barang Jadi (Calcium Soap & Shortening)', 'KPPBC Pusat & Kemendag', '±5 Hari Kerja', 32000000.00),
	(3, 3, 'FFA: 2–5% | MI: ≤ 2%', '', 'KG', 1.40),
	(4, 3, 'FFA: 5–10% | MI: ≤ 2%', '', 'KG', 1.15),
	(5, 3, 'FFA: 10–15% | MI: ≤ 2%', '', 'KG', 1.05),
	(8, 4, 'Used Cooking Oil Supply / Export Documentation Assistance', 'Supplier / Customs / Related Authority', 'To be confirmed', 12000000.00);

-- Dumping structure for table uco_v4.manual_invoices
CREATE TABLE IF NOT EXISTS `manual_invoices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `invoice_date` date NOT NULL,
  `customer_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_address` text COLLATE utf8mb4_general_ci,
  `customer_country` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pic_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `currency_id` int DEFAULT NULL,
  `payment_term_text` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `incoterm_text` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `incoterm_id` int DEFAULT NULL,
  `payment_term_id` int DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `total_amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `subtotal_amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `total_discount_amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `total_tax_amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `paid_amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `balance_amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_no` (`invoice_no`),
  KEY `currency_id` (`currency_id`),
  KEY `incoterm_id` (`incoterm_id`),
  KEY `payment_term_id` (`payment_term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uco_v4.manual_invoices: ~2 rows (approximately)
INSERT INTO `manual_invoices` (`id`, `invoice_no`, `invoice_date`, `customer_name`, `customer_address`, `customer_country`, `pic_name`, `currency_id`, `payment_term_text`, `incoterm_text`, `incoterm_id`, `payment_term_id`, `subject`, `notes`, `total_amount`, `subtotal_amount`, `total_discount_amount`, `total_tax_amount`, `paid_amount`, `balance_amount`, `created_by`, `created_at`) VALUES
	(7, 'INV-UCO/202604/0082', '2026-04-15', 'PT. CANADA GREEN GATE', 'Jl. Kraton Industri Raya No.03,  Pejangkungan,Kec. Rembang, Pasuruan, Jawa Timur 67152\r\n', 'Pasuruan – Indonesia', '', 2, '30% saat SPK, 70% setelah izin terbit', '-', NULL, NULL, 'Invoice', '-', 32640000.00, 32000000.00, 0.00, 640000.00, 9600000.00, 23040000.00, 2, '2026-04-15 14:44:57');

-- Dumping structure for table uco_v4.manual_invoice_items
CREATE TABLE IF NOT EXISTS `manual_invoice_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `manual_invoice_id` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `qty` decimal(18,2) NOT NULL DEFAULT '0.00',
  `unit` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unit_price` decimal(18,2) NOT NULL DEFAULT '0.00',
  `discount_percent` decimal(8,2) NOT NULL DEFAULT '0.00',
  `tax_percent` decimal(8,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(18,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `manual_invoice_id` (`manual_invoice_id`),
  CONSTRAINT `fk_manual_invoice_items_header` FOREIGN KEY (`manual_invoice_id`) REFERENCES `manual_invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uco_v4.manual_invoice_items: ~1 rows (approximately)
INSERT INTO `manual_invoice_items` (`id`, `manual_invoice_id`, `description`, `qty`, `unit`, `unit_price`, `discount_percent`, `tax_percent`, `subtotal`, `discount_amount`, `tax_amount`, `amount`) VALUES
	(8, 7, 'Biaya Jasa - Registrasi & Izin Penambahan Barang Jadi (Calcium Soap & Shortening)', 1.00, '', 32000000.00, 0.00, 2.00, 32000000.00, 0.00, 640000.00, 32640000.00);

-- Dumping structure for table uco_v4.packing_lists
CREATE TABLE IF NOT EXISTS `packing_lists` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sales_order_id` int NOT NULL,
  `pl_no` varchar(50) NOT NULL,
  `pl_date` date NOT NULL,
  `marks_numbers` text,
  `total_packages` decimal(18,2) NOT NULL DEFAULT '0.00',
  `gross_weight` decimal(18,2) NOT NULL DEFAULT '0.00',
  `net_weight` decimal(18,2) NOT NULL DEFAULT '0.00',
  `cbm` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pl_no` (`pl_no`),
  KEY `fk_pl_so` (`sales_order_id`),
  CONSTRAINT `fk_pl_so` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.packing_lists: ~14 rows (approximately)
INSERT INTO `packing_lists` (`id`, `sales_order_id`, `pl_no`, `pl_date`, `marks_numbers`, `total_packages`, `gross_weight`, `net_weight`, `cbm`, `created_at`) VALUES
	(16, 14, 'PL-UCO/202604/0005', '2026-04-28', '', 123.00, 23370.00, 22140.00, 135.3000, '2026-04-28 13:13:45');

-- Dumping structure for table uco_v4.packing_list_items
CREATE TABLE IF NOT EXISTS `packing_list_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `packing_list_id` int NOT NULL,
  `sales_order_item_id` int NOT NULL,
  `package_count` decimal(18,2) NOT NULL DEFAULT '0.00',
  `qty` decimal(18,2) NOT NULL DEFAULT '0.00',
  `net_weight` decimal(18,2) NOT NULL DEFAULT '0.00',
  `gross_weight` decimal(18,2) NOT NULL DEFAULT '0.00',
  `cbm` decimal(18,4) NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  KEY `fk_pli_pl` (`packing_list_id`),
  KEY `fk_pli_soitem` (`sales_order_item_id`),
  CONSTRAINT `fk_pli_pl` FOREIGN KEY (`packing_list_id`) REFERENCES `packing_lists` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pli_soitem` FOREIGN KEY (`sales_order_item_id`) REFERENCES `sales_order_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.packing_list_items: ~21 rows (approximately)
INSERT INTO `packing_list_items` (`id`, `packing_list_id`, `sales_order_item_id`, `package_count`, `qty`, `net_weight`, `gross_weight`, `cbm`) VALUES
	(23, 16, 27, 123.00, 123.00, 22140.00, 23370.00, 135.3000);

-- Dumping structure for table uco_v4.payment_terms
CREATE TABLE IF NOT EXISTS `payment_terms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `term_name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.payment_terms: ~10 rows (approximately)
INSERT INTO `payment_terms` (`id`, `term_name`, `description`) VALUES
	(1, 'T/T in advance', 'Full payment before shipment'),
	(2, '30% DP 70% before shipment', 'Deposit and balance before shipment'),
	(3, 'Net 7 days', 'Payment within 7 days'),
	(4, 'Net 14 days', 'Payment within 14 days'),
	(5, 'Net 30 days', 'Payment within 30 days'),
	(6, 'CAD', 'Cash against documents'),
	(7, 'LC at sight', 'Letter of credit at sight'),
	(8, '50% advance 50% before BL', 'Split payment term'),
	(9, 'Monthly billing', 'Billed monthly'),
	(10, 'Consignment', 'Pay after goods sold');

-- Dumping structure for table uco_v4.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `description` text,
  `uom_id` int DEFAULT NULL,
  `sales_price` decimal(18,2) NOT NULL DEFAULT '0.00',
  `nw_unit` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `gw_unit` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `cbm_unit` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `package_unit` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_products_uom` (`uom_id`),
  CONSTRAINT `fk_products_uom` FOREIGN KEY (`uom_id`) REFERENCES `uoms` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.products: ~11 rows (approximately)
INSERT INTO `products` (`id`, `code`, `product_name`, `description`, `uom_id`, `sales_price`, `nw_unit`, `gw_unit`, `cbm_unit`, `package_unit`, `is_active`, `created_at`) VALUES
	(1, 'PRD-001', 'Used Cooking Oil A', 'Used Cooking Oil A sample master data', 2, 12000.00, 180.0000, 190.0000, 1.1000, 1.0000, 1, '2026-03-09 06:02:47'),
	(2, 'PRD-002', 'Used Cooking Oil B', 'Used Cooking Oil B sample master data', 2, 11850.00, 175.0000, 185.0000, 1.0800, 1.0000, 1, '2026-03-09 06:02:47');

-- Dumping structure for table uco_v4.sales_orders
CREATE TABLE IF NOT EXISTS `sales_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `so_no` varchar(50) NOT NULL,
  `order_date` date NOT NULL,
  `customer_id` int NOT NULL,
  `currency_id` int DEFAULT NULL,
  `incoterm_id` int DEFAULT NULL,
  `payment_term_id` int DEFAULT NULL,
  `warehouse_id` int DEFAULT NULL,
  `destination_port` varchar(150) DEFAULT NULL,
  `remarks` text,
  `created_by` int DEFAULT NULL,
  `total_amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `status` enum('DRAFT','CONFIRMED','SHIPPED') NOT NULL DEFAULT 'DRAFT',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `so_no` (`so_no`),
  KEY `fk_so_customer` (`customer_id`),
  KEY `fk_so_currency` (`currency_id`),
  KEY `fk_so_incoterm` (`incoterm_id`),
  KEY `fk_so_payment_term` (`payment_term_id`),
  KEY `fk_so_warehouse` (`warehouse_id`),
  KEY `fk_so_user` (`created_by`),
  CONSTRAINT `fk_so_currency` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_so_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `fk_so_incoterm` FOREIGN KEY (`incoterm_id`) REFERENCES `incoterms` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_so_payment_term` FOREIGN KEY (`payment_term_id`) REFERENCES `payment_terms` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_so_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_so_warehouse` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.sales_orders: ~12 rows (approximately)
INSERT INTO `sales_orders` (`id`, `so_no`, `order_date`, `customer_id`, `currency_id`, `incoterm_id`, `payment_term_id`, `warehouse_id`, `destination_port`, `remarks`, `created_by`, `total_amount`, `status`, `created_at`) VALUES
	(14, 'SO-UCO/202604/0003', '2026-04-28', 3, 2, 5, 10, 1, '321', '23123', 3, 1476000.00, 'CONFIRMED', '2026-04-28 13:13:43');

-- Dumping structure for table uco_v4.sales_order_items
CREATE TABLE IF NOT EXISTS `sales_order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sales_order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `description` text,
  `qty` decimal(18,2) NOT NULL DEFAULT '0.00',
  `unit_price` decimal(18,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `fk_so_item_so` (`sales_order_id`),
  KEY `fk_so_item_product` (`product_id`),
  CONSTRAINT `fk_so_item_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `fk_so_item_so` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.sales_order_items: ~25 rows (approximately)
INSERT INTO `sales_order_items` (`id`, `sales_order_id`, `product_id`, `description`, `qty`, `unit_price`, `amount`) VALUES
	(27, 14, 1, '', 123.00, 12000.00, 1476000.00);

-- Dumping structure for table uco_v4.stock_movements
CREATE TABLE IF NOT EXISTS `stock_movements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `warehouse_id` int NOT NULL,
  `product_id` int NOT NULL,
  `movement_date` datetime NOT NULL,
  `movement_type` enum('OPENING','IN','OUT','SHIP','ADJUSTMENT') NOT NULL,
  `qty_in` decimal(18,2) NOT NULL DEFAULT '0.00',
  `qty_out` decimal(18,2) NOT NULL DEFAULT '0.00',
  `balance_after` decimal(18,2) NOT NULL DEFAULT '0.00',
  `reference_no` varchar(100) DEFAULT NULL,
  `notes` text,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_stock_wh` (`warehouse_id`),
  KEY `fk_stock_prod` (`product_id`),
  KEY `fk_stock_user` (`created_by`),
  CONSTRAINT `fk_stock_prod` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_stock_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_stock_wh` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.stock_movements: ~16 rows (approximately)

-- Dumping structure for table uco_v4.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_name` varchar(150) NOT NULL,
  `pic_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text,
  `country` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.suppliers: ~11 rows (approximately)
INSERT INTO `suppliers` (`id`, `company_name`, `pic_name`, `email`, `phone`, `address`, `country`) VALUES
	(1, 'Supplier 1', 'PIC Supplier 1', 'supplier1@mail.com', '+62-31-8800001', 'Jl. Supplier No. 1, Surabaya', 'Indonesia'),
	(2, 'Supplier 2', 'PIC Supplier 2', 'supplier2@mail.com', '+62-31-8800002', 'Jl. Supplier No. 2, Surabaya', 'Indonesia'),
	(3, 'Supplier 3', 'PIC Supplier 3', 'supplier3@mail.com', '+62-31-8800003', 'Jl. Supplier No. 3, Surabaya', 'Indonesia');

-- Dumping structure for table uco_v4.uoms
CREATE TABLE IF NOT EXISTS `uoms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uom_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.uoms: ~11 rows (approximately)
INSERT INTO `uoms` (`id`, `uom_name`) VALUES
	(1, 'KG'),
	(2, 'LTR'),
	(3, 'DRUM'),
	(4, 'PCS'),
	(5, 'BOX'),
	(6, 'BAG'),
	(7, 'TON'),
	(8, 'PALLET'),
	(9, 'JERIGEN'),
	(10, 'IBC');

-- Dumping structure for table uco_v4.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'admin',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `is_active`, `created_at`) VALUES
	(2, 'doni', 'doni', '$2y$10$xFf6ogs.jel.1GcDDw.P2eJIP9g5FjP9jF7QFIs.hTfTgR.3KUTnq', 'admin', 1, '2026-03-09 06:05:57'),
	(3, 'rizky', 'rizky', '$2y$10$19RWWu/QMOmeibRsOj9l6O4jrszaY8PKfutrK4kYv35werPChGn.6', 'admin', 1, '2026-03-09 06:06:05'),
	(4, 'dika', 'dika', '$2y$10$6IiuhiHHaqKY5S8mKu/dWekMn10sqtHdfizkZRYdAwy1vkGaCDP8W', 'admin', 1, '2026-03-09 06:06:09');

-- Dumping structure for table uco_v4.warehouses
CREATE TABLE IF NOT EXISTS `warehouses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `warehouse_name` varchar(100) NOT NULL,
  `location` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.warehouses: ~10 rows (approximately)
INSERT INTO `warehouses` (`id`, `code`, `warehouse_name`, `location`, `is_active`) VALUES
	(1, 'WH-01', 'Main Warehouse', 'Location 1, East Java', 1),
	(7, 'WH-07', 'Finished Goods A', 'Location 7, East Java', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
