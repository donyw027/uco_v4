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


-- Dumping database structure for uco_v4
CREATE DATABASE IF NOT EXISTS `uco_v4` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `uco_v4`;

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
	(1, 'UCO Trading Solution Demo 1', 'Jl. Demo Company No. 1, Pasuruan', '+62-343-500001', 'info1@uco-demo.test', 'Bank Demo 1 - 12345678901', 'Manager 1', 'Export Manager 1'),
	(2, 'UCO Trading Solution Demo 2', 'Jl. Demo Company No. 2, Pasuruan', '+62-343-500002', 'info2@uco-demo.test', 'Bank Demo 2 - 12345678902', 'Manager 2', 'Export Manager 2'),
	(3, 'UCO Trading Solution Demo 3', 'Jl. Demo Company No. 3, Pasuruan', '+62-343-500003', 'info3@uco-demo.test', 'Bank Demo 3 - 12345678903', 'Manager 3', 'Export Manager 3'),
	(4, 'UCO Trading Solution Demo 4', 'Jl. Demo Company No. 4, Pasuruan', '+62-343-500004', 'info4@uco-demo.test', 'Bank Demo 4 - 12345678904', 'Manager 4', 'Export Manager 4'),
	(5, 'UCO Trading Solution Demo 5', 'Jl. Demo Company No. 5, Pasuruan', '+62-343-500005', 'info5@uco-demo.test', 'Bank Demo 5 - 12345678905', 'Manager 5', 'Export Manager 5'),
	(6, 'UCO Trading Solution Demo 6', 'Jl. Demo Company No. 6, Pasuruan', '+62-343-500006', 'info6@uco-demo.test', 'Bank Demo 6 - 12345678906', 'Manager 6', 'Export Manager 6'),
	(7, 'UCO Trading Solution Demo 7', 'Jl. Demo Company No. 7, Pasuruan', '+62-343-500007', 'info7@uco-demo.test', 'Bank Demo 7 - 12345678907', 'Manager 7', 'Export Manager 7'),
	(8, 'UCO Trading Solution Demo 8', 'Jl. Demo Company No. 8, Pasuruan', '+62-343-500008', 'info8@uco-demo.test', 'Bank Demo 8 - 12345678908', 'Manager 8', 'Export Manager 8'),
	(9, 'UCO Trading Solution Demo 9', 'Jl. Demo Company No. 9, Pasuruan', '+62-343-500009', 'info9@uco-demo.test', 'Bank Demo 9 - 12345678909', 'Manager 9', 'Export Manager 9'),
	(10, 'Uco Exportindo Constulting', 'Perum Majapahit, Pungging – Mojokerto', '+62-896-7257-4222', 'ucoexporindo@gmail.com', 'Bank BCA10 - 12345678910', 'Doni Wicaksono', 'Director');

-- Dumping structure for table uco_v4.currencies
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `currency_code` varchar(10) NOT NULL,
  `currency_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.customers: ~11 rows (approximately)
INSERT INTO `customers` (`id`, `customer_code`, `company_name`, `pic_name`, `email`, `phone`, `address`, `country`, `is_active`) VALUES
	(1, 'CUST-001', 'Customer 1 Trading', 'Customer PIC 1', 'customer1@mail.com', '+62-21-7700001', 'Jl. Customer No. 1, Jakarta', 'Indonesia', 1),
	(2, 'CUST-002', 'Customer 2 Trading', 'Customer PIC 2', 'customer2@mail.com', '+62-21-7700002', 'Jl. Customer No. 2, Jakarta', 'Indonesia', 1),
	(3, 'CUST-003', 'Customer 3 Trading', 'Customer PIC 3', 'customer3@mail.com', '+62-21-7700003', 'Jl. Customer No. 3, Jakarta', 'Indonesia', 1),
	(4, 'CUST-004', 'Customer 4 Trading', 'Customer PIC 4', 'customer4@mail.com', '+62-21-7700004', 'Jl. Customer No. 4, Jakarta', 'Indonesia', 1),
	(5, 'CUST-005', 'Customer 5 Trading', 'Customer PIC 5', 'customer5@mail.com', '+62-21-7700005', 'Jl. Customer No. 5, Jakarta', 'Indonesia', 1),
	(6, 'CUST-006', 'Customer 6 Trading', 'Customer PIC 6', 'customer6@mail.com', '+62-21-7700006', 'Jl. Customer No. 6, Jakarta', 'Indonesia', 1),
	(7, 'CUST-007', 'Customer 7 Trading', 'Customer PIC 7', 'customer7@mail.com', '+62-21-7700007', 'Jl. Customer No. 7, Jakarta', 'Indonesia', 1),
	(8, 'CUST-008', 'Customer 8 Trading', 'Customer PIC 8', 'customer8@mail.com', '+62-21-7700008', 'Jl. Customer No. 8, Jakarta', 'Indonesia', 1),
	(9, 'CUST-009', 'Customer 9 Trading', 'Customer PIC 9', 'customer9@mail.com', '+62-21-7700009', 'Jl. Customer No. 9, Jakarta', 'Indonesia', 1),
	(10, 'CUST-010', 'Customer 10 Trading', 'Customer PIC 10', 'customer10@mail.com', '+62-21-7700010', 'Jl. Customer No. 10, Jakarta', 'Indonesia', 1),
	(11, 'tes', '1', '2', '3', '4', '5', '6', 1);

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
	(11, 'PL', '202604', 3),
	(12, 'SO', '202604', 1),
	(13, 'INV', '202604', 36);

-- Dumping structure for table uco_v4.incoterms
CREATE TABLE IF NOT EXISTS `incoterms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `incoterm_code` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.incoterms: ~11 rows (approximately)
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
	(10, 'FAS', 'Free Alongside Ship'),
	(11, 'tes', 'tes');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.invoices: ~12 rows (approximately)
INSERT INTO `invoices` (`id`, `sales_order_id`, `invoice_no`, `invoice_date`, `notes`, `total_amount`, `created_at`) VALUES
	(1, 1, 'INV-UCO/202603/0001', '2026-03-01', 'Sample invoice', 991350.00, '2026-03-09 06:02:47'),
	(2, 2, 'INV-UCO/202603/0002', '2026-03-02', 'Sample invoice', 943900.00, '2026-03-09 06:02:47'),
	(3, 3, 'INV-UCO/202603/0003', '2026-03-03', 'Sample invoice', 819100.00, '2026-03-09 06:02:47'),
	(4, 4, 'INV-UCO/202603/0004', '2026-03-04', 'Sample invoice', 882000.00, '2026-03-09 06:02:47'),
	(5, 5, 'INV-UCO/202603/0005', '2026-03-05', 'Sample invoice', 1024750.00, '2026-03-09 06:02:47'),
	(6, 6, 'INV-UCO/202603/0006', '2026-03-06', 'Sample invoice', 1085500.00, '2026-03-09 06:02:47'),
	(7, 7, 'INV-UCO/202603/0007', '2026-03-07', 'Sample invoice', 1107100.00, '2026-03-09 06:02:47'),
	(8, 8, 'INV-UCO/202603/0008', '2026-03-08', 'Sample invoice', 844200.00, '2026-03-09 06:02:47'),
	(9, 9, 'INV-UCO/202603/0009', '2026-03-09', 'Sample invoice', 826800.00, '2026-03-09 06:02:47'),
	(10, 10, 'INV-UCO/202603/0010', '2026-03-10', 'Sample invoice', 1012000.00, '2026-03-09 06:02:47'),
	(11, 11, 'INV-UCO/202603/0011', '2026-03-09', '', 61500.00, '2026-03-09 06:08:21'),
	(12, 12, 'INV-UCO/202604/0001', '2026-04-06', '', 351000.00, '2026-04-06 13:42:04');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.invoice_items: ~15 rows (approximately)
INSERT INTO `invoice_items` (`id`, `invoice_id`, `sales_order_item_id`, `qty`, `unit_price`, `amount`) VALUES
	(1, 1, 1, 52.00, 12000.00, 624000.00),
	(2, 2, 3, 54.00, 11850.00, 639900.00),
	(3, 3, 5, 56.00, 9500.00, 532000.00),
	(4, 4, 7, 58.00, 8700.00, 504600.00),
	(5, 5, 9, 60.00, 11100.00, 666000.00),
	(6, 6, 11, 62.00, 10250.00, 635500.00),
	(7, 7, 13, 64.00, 12500.00, 800000.00),
	(8, 8, 15, 66.00, 8300.00, 547800.00),
	(9, 9, 17, 68.00, 7800.00, 530400.00),
	(10, 10, 19, 70.00, 7600.00, 532000.00),
	(11, 11, 21, 1.00, 10250.00, 10250.00),
	(12, 11, 22, 2.00, 10250.00, 20500.00),
	(13, 11, 23, 3.00, 10250.00, 30750.00),
	(14, 12, 24, 12.00, 7800.00, 93600.00),
	(15, 12, 25, 33.00, 7800.00, 257400.00);

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `proposal_no` (`proposal_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uco_v4.manual_inquiries: ~0 rows (approximately)
INSERT INTO `manual_inquiries` (`id`, `proposal_no`, `proposal_date`, `recipient_company`, `recipient_address`, `recipient_pic`, `subject`, `opening_text`, `terms_text`, `closing_text`, `currency_text`, `created_by`, `created_at`) VALUES
	(1, 'INQ-UCO/202604/8801', '2026-04-14', 'PT. CANADA GREEN GATE', 'Pasuruan – Indonesia', 'PIC', 'Pengurusan Izin Penambahan Barang Jadi Kategori DHE SDA', 'Bersama ini kami menyampaikan penawaran jasa pengurusan perizinan penambahan barang jadi kategori DHE SDA yang akan berhubungan dengan KPPBC Pusat serta Kementerian Perdagangan Republik Indonesia.', '• Pembayaran: 30% saat SPK, 70% setelah izin terbit\r\n• Dokumen disiapkan oleh pihak perusahaan\r\n• Biaya belum termasuk perubahan regulasi tambahan', 'Demikian proposal ini kami sampaikan. Kami berharap dapat menjalin kerja sama yang baik dengan perusahaan Bapak/Ibu.', 'IDR', 1, '2026-04-14 13:04:38');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uco_v4.manual_inquiry_items: ~0 rows (approximately)
INSERT INTO `manual_inquiry_items` (`id`, `manual_inquiry_id`, `description`, `agency`, `duration_text`, `amount`) VALUES
	(1, 1, 'Registrasi & Izin Penambahan Barang Jadi (Calcium Soap & Shortening)', 'KPPBC Pusat & Kemendag', '±5 Hari Kerja', 32000000.00);

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
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_no` (`invoice_no`),
  KEY `currency_id` (`currency_id`),
  KEY `incoterm_id` (`incoterm_id`),
  KEY `payment_term_id` (`payment_term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uco_v4.manual_invoices: ~2 rows (approximately)
INSERT INTO `manual_invoices` (`id`, `invoice_no`, `invoice_date`, `customer_name`, `customer_address`, `customer_country`, `pic_name`, `currency_id`, `payment_term_text`, `incoterm_text`, `incoterm_id`, `payment_term_id`, `subject`, `notes`, `total_amount`, `created_by`, `created_at`) VALUES
	(2, 'INV-UCO/202604/0032', '2026-04-14', 'PT. CANADA GREEN GATE', 'Jl. Kraton Industri Raya No.03, Pejangkungan,Kec. Rembang, Pasuruan, Jawa Timur 67152 ', 'Pasuruan – Indonesia', '', 2, '30% saat SPK, 70% setelah izin terbit', NULL, 0, 30, 'Invoice', '-', 32000000.00, 1, '2026-04-14 13:53:15'),
	(3, 'INV-UCO/202604/0034', '2026-04-14', 'PT. CANADA GREEN GATE', 'Jl. Kraton Industri Raya No.03, Pejangkungan, Kec. Rembang, Pasuruan, Jawa Timur 67152', 'Pasuruan – Indonesia', '', 2, '30% saat SPK, 70% setelah izin terbit', NULL, 0, 30, 'Invoice', '', 35520000.00, 1, '2026-04-14 13:55:22');

-- Dumping structure for table uco_v4.manual_invoice_items
CREATE TABLE IF NOT EXISTS `manual_invoice_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `manual_invoice_id` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `qty` decimal(18,2) NOT NULL DEFAULT '0.00',
  `unit` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unit_price` decimal(18,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `manual_invoice_id` (`manual_invoice_id`),
  CONSTRAINT `fk_manual_invoice_items_header` FOREIGN KEY (`manual_invoice_id`) REFERENCES `manual_invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uco_v4.manual_invoice_items: ~0 rows (approximately)
INSERT INTO `manual_invoice_items` (`id`, `manual_invoice_id`, `description`, `qty`, `unit`, `unit_price`, `amount`) VALUES
	(2, 2, 'Registrasi & Izin Penambahan Barang Jadi (Calcium Soap & Shortening)', 1.00, '', 32000000.00, 32000000.00),
	(3, 3, 'Registrasi & Izin Penambahan Barang Jadi (Calcium Soap & Shortening)', 1.00, '', 32000000.00, 32000000.00),
	(4, 3, 'Tax (11%)', 1.00, '', 3520000.00, 3520000.00);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.packing_lists: ~14 rows (approximately)
INSERT INTO `packing_lists` (`id`, `sales_order_id`, `pl_no`, `pl_date`, `marks_numbers`, `total_packages`, `gross_weight`, `net_weight`, `cbm`, `created_at`) VALUES
	(1, 1, 'PL-UCO/202603/0001', '2026-03-01', 'Marks 1', 6.00, 226.00, 205.00, 1.2500, '2026-03-09 06:02:47'),
	(2, 2, 'PL-UCO/202603/0002', '2026-03-02', 'Marks 2', 7.00, 232.00, 210.00, 1.3000, '2026-03-09 06:02:47'),
	(3, 3, 'PL-UCO/202603/0003', '2026-03-03', 'Marks 3', 8.00, 238.00, 215.00, 1.3500, '2026-03-09 06:02:47'),
	(4, 4, 'PL-UCO/202603/0004', '2026-03-04', 'Marks 4', 9.00, 244.00, 220.00, 1.4000, '2026-03-09 06:02:47'),
	(5, 5, 'PL-UCO/202603/0005', '2026-03-05', 'Marks 5', 10.00, 250.00, 225.00, 1.4500, '2026-03-09 06:02:47'),
	(6, 6, 'PL-UCO/202603/0006', '2026-03-06', 'Marks 6', 11.00, 256.00, 230.00, 1.5000, '2026-03-09 06:02:47'),
	(7, 7, 'PL-UCO/202603/0007', '2026-03-07', 'Marks 7', 12.00, 262.00, 235.00, 1.5500, '2026-03-09 06:02:47'),
	(8, 8, 'PL-UCO/202603/0008', '2026-03-08', 'Marks 8', 13.00, 268.00, 240.00, 1.6000, '2026-03-09 06:02:47'),
	(9, 9, 'PL-UCO/202603/0009', '2026-03-09', 'Marks 9', 14.00, 274.00, 245.00, 1.6500, '2026-03-09 06:02:47'),
	(10, 10, 'PL-UCO/202603/0010', '2026-03-10', 'Marks 10', 15.00, 280.00, 250.00, 1.7000, '2026-03-09 06:02:47'),
	(11, 11, 'PL-UCO/202603/0011', '2026-03-09', '', 6.00, 1008.00, 960.00, 5.8800, '2026-03-09 06:08:18'),
	(12, 11, 'PL-UCO/202604/0001', '2026-04-06', '', 6.00, 1008.00, 960.00, 5.8800, '2026-04-06 12:38:55'),
	(13, 11, 'PL-UCO/202604/0002', '2026-04-06', '', 6.00, 1008.00, 960.00, 5.8800, '2026-04-06 13:41:13'),
	(14, 12, 'PL-UCO/202604/0003', '2026-04-06', '', 45.00, 7110.00, 6750.00, 41.8500, '2026-04-06 13:42:16');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.packing_list_items: ~21 rows (approximately)
INSERT INTO `packing_list_items` (`id`, `packing_list_id`, `sales_order_item_id`, `package_count`, `qty`, `net_weight`, `gross_weight`, `cbm`) VALUES
	(1, 1, 1, 6.00, 52.00, 205.00, 226.00, 1.2500),
	(2, 2, 3, 7.00, 54.00, 210.00, 232.00, 1.3000),
	(3, 3, 5, 8.00, 56.00, 215.00, 238.00, 1.3500),
	(4, 4, 7, 9.00, 58.00, 220.00, 244.00, 1.4000),
	(5, 5, 9, 10.00, 60.00, 225.00, 250.00, 1.4500),
	(6, 6, 11, 11.00, 62.00, 230.00, 256.00, 1.5000),
	(7, 7, 13, 12.00, 64.00, 235.00, 262.00, 1.5500),
	(8, 8, 15, 13.00, 66.00, 240.00, 268.00, 1.6000),
	(9, 9, 17, 14.00, 68.00, 245.00, 274.00, 1.6500),
	(10, 10, 19, 15.00, 70.00, 250.00, 280.00, 1.7000),
	(11, 11, 21, 1.00, 1.00, 160.00, 168.00, 0.9800),
	(12, 11, 22, 2.00, 2.00, 320.00, 336.00, 1.9600),
	(13, 11, 23, 3.00, 3.00, 480.00, 504.00, 2.9400),
	(14, 12, 21, 1.00, 1.00, 160.00, 168.00, 0.9800),
	(15, 12, 22, 2.00, 2.00, 320.00, 336.00, 1.9600),
	(16, 12, 23, 3.00, 3.00, 480.00, 504.00, 2.9400),
	(17, 13, 21, 1.00, 1.00, 160.00, 168.00, 0.9800),
	(18, 13, 22, 2.00, 2.00, 320.00, 336.00, 1.9600),
	(19, 13, 23, 3.00, 3.00, 480.00, 504.00, 2.9400),
	(20, 14, 24, 12.00, 12.00, 1800.00, 1896.00, 11.1600),
	(21, 14, 25, 33.00, 33.00, 4950.00, 5214.00, 30.6900);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.products: ~11 rows (approximately)
INSERT INTO `products` (`id`, `code`, `product_name`, `description`, `uom_id`, `sales_price`, `nw_unit`, `gw_unit`, `cbm_unit`, `package_unit`, `is_active`, `created_at`) VALUES
	(1, 'PRD-001', 'Used Cooking Oil A', 'Used Cooking Oil A sample master data', 2, 12000.00, 180.0000, 190.0000, 1.1000, 1.0000, 1, '2026-03-09 06:02:47'),
	(2, 'PRD-002', 'Used Cooking Oil B', 'Used Cooking Oil B sample master data', 2, 11850.00, 175.0000, 185.0000, 1.0800, 1.0000, 1, '2026-03-09 06:02:47'),
	(3, 'PRD-003', 'Crude Glycerin', 'Crude Glycerin sample master data', 1, 9500.00, 165.0000, 173.0000, 1.0200, 1.0000, 1, '2026-03-09 06:02:47'),
	(4, 'PRD-004', 'Palm Fatty Acid', 'Palm Fatty Acid sample master data', 1, 8700.00, 170.0000, 178.0000, 1.0400, 1.0000, 1, '2026-03-09 06:02:47'),
	(5, 'PRD-005', 'Biodiesel Feedstock', 'Biodiesel Feedstock sample master data', 2, 11100.00, 182.0000, 192.0000, 1.1200, 1.0000, 1, '2026-03-09 06:02:47'),
	(6, 'PRD-006', 'Animal Feed Oil', 'Animal Feed Oil sample master data', 2, 10250.00, 160.0000, 168.0000, 0.9800, 1.0000, 1, '2026-03-09 06:02:47'),
	(7, 'PRD-007', 'Recovered Cooking Oil Premium', 'Recovered Cooking Oil Premium sample master data', 2, 12500.00, 188.0000, 198.0000, 1.1500, 1.0000, 1, '2026-03-09 06:02:47'),
	(8, 'PRD-008', 'Industrial Grease Base', 'Industrial Grease Base sample master data', 1, 8300.00, 158.0000, 166.0000, 0.9700, 1.0000, 1, '2026-03-09 06:02:47'),
	(9, 'PRD-009', 'Soapstock Oil', 'Soapstock Oil sample master data', 1, 7800.00, 150.0000, 158.0000, 0.9300, 1.0000, 1, '2026-03-09 06:02:47'),
	(10, 'PRD-010', 'Brown Grease', 'Brown Grease sample master data', 1, 7600.00, 148.0000, 156.0000, 0.9100, 1.0000, 1, '2026-03-09 06:02:47'),
	(11, 'tes', '1', '1', 6, 10.00, 1.0000, 1.0000, 0.0100, 1.0000, 1, '2026-03-09 06:06:25');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.sales_orders: ~12 rows (approximately)
INSERT INTO `sales_orders` (`id`, `so_no`, `order_date`, `customer_id`, `currency_id`, `incoterm_id`, `payment_term_id`, `warehouse_id`, `destination_port`, `remarks`, `created_by`, `total_amount`, `status`, `created_at`) VALUES
	(1, 'SO-UCO/202603/0001', '2026-03-01', 1, 1, 2, 2, 1, 'Port 1', 'Sample order 1', 1, 175000.00, 'DRAFT', '2026-03-09 06:02:47'),
	(2, 'SO-UCO/202603/0002', '2026-03-02', 2, 2, 3, 3, 1, 'Port 2', 'Sample order 2', 1, 200000.00, 'DRAFT', '2026-03-09 06:02:47'),
	(3, 'SO-UCO/202603/0003', '2026-03-03', 3, 3, 4, 4, 1, 'Port 3', 'Sample order 3', 1, 225000.00, 'DRAFT', '2026-03-09 06:02:47'),
	(4, 'SO-UCO/202603/0004', '2026-03-04', 4, 4, 5, 5, 1, 'Port 4', 'Sample order 4', 1, 250000.00, 'CONFIRMED', '2026-03-09 06:02:47'),
	(5, 'SO-UCO/202603/0005', '2026-03-05', 5, 5, 6, 6, 1, 'Port 5', 'Sample order 5', 1, 275000.00, 'CONFIRMED', '2026-03-09 06:02:47'),
	(6, 'SO-UCO/202603/0006', '2026-03-06', 6, 6, 7, 7, 1, 'Port 6', 'Sample order 6', 1, 300000.00, 'CONFIRMED', '2026-03-09 06:02:47'),
	(7, 'SO-UCO/202603/0007', '2026-03-07', 7, 7, 8, 8, 1, 'Port 7', 'Sample order 7', 1, 325000.00, 'SHIPPED', '2026-03-09 06:02:47'),
	(8, 'SO-UCO/202603/0008', '2026-03-08', 8, 8, 9, 9, 1, 'Port 8', 'Sample order 8', 1, 350000.00, 'SHIPPED', '2026-03-09 06:02:47'),
	(9, 'SO-UCO/202603/0009', '2026-03-09', 9, 9, 10, 10, 1, 'Port 9', 'Sample order 9', 1, 375000.00, 'SHIPPED', '2026-03-09 06:02:47'),
	(10, 'SO-UCO/202603/0010', '2026-03-10', 10, 10, 1, 1, 1, 'Port 10', 'Sample order 10', 1, 400000.00, 'SHIPPED', '2026-03-09 06:02:47'),
	(11, 'SO-UCO/202603/0011', '2026-03-09', 11, 9, 2, 2, 1, 'sby', 'sby', 1, 61500.00, 'SHIPPED', '2026-03-09 06:08:14'),
	(12, 'SO-UCO/202604/0001', '2026-04-01', 6, 4, 2, 2, 5, 'tes', 'tes', 1, 351000.00, 'SHIPPED', '2026-04-06 13:41:55');

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.sales_order_items: ~25 rows (approximately)
INSERT INTO `sales_order_items` (`id`, `sales_order_id`, `product_id`, `description`, `qty`, `unit_price`, `amount`) VALUES
	(1, 1, 1, 'Item 1 for SO 1', 52.00, 12000.00, 624000.00),
	(2, 1, 2, 'Item 2 for SO 1', 31.00, 11850.00, 367350.00),
	(3, 2, 2, 'Item 1 for SO 2', 54.00, 11850.00, 639900.00),
	(4, 2, 3, 'Item 2 for SO 2', 32.00, 9500.00, 304000.00),
	(5, 3, 3, 'Item 1 for SO 3', 56.00, 9500.00, 532000.00),
	(6, 3, 4, 'Item 2 for SO 3', 33.00, 8700.00, 287100.00),
	(7, 4, 4, 'Item 1 for SO 4', 58.00, 8700.00, 504600.00),
	(8, 4, 5, 'Item 2 for SO 4', 34.00, 11100.00, 377400.00),
	(9, 5, 5, 'Item 1 for SO 5', 60.00, 11100.00, 666000.00),
	(10, 5, 6, 'Item 2 for SO 5', 35.00, 10250.00, 358750.00),
	(11, 6, 6, 'Item 1 for SO 6', 62.00, 10250.00, 635500.00),
	(12, 6, 7, 'Item 2 for SO 6', 36.00, 12500.00, 450000.00),
	(13, 7, 7, 'Item 1 for SO 7', 64.00, 12500.00, 800000.00),
	(14, 7, 8, 'Item 2 for SO 7', 37.00, 8300.00, 307100.00),
	(15, 8, 8, 'Item 1 for SO 8', 66.00, 8300.00, 547800.00),
	(16, 8, 9, 'Item 2 for SO 8', 38.00, 7800.00, 296400.00),
	(17, 9, 9, 'Item 1 for SO 9', 68.00, 7800.00, 530400.00),
	(18, 9, 10, 'Item 2 for SO 9', 39.00, 7600.00, 296400.00),
	(19, 10, 10, 'Item 1 for SO 10', 70.00, 7600.00, 532000.00),
	(20, 10, 1, 'Item 2 for SO 10', 40.00, 12000.00, 480000.00),
	(21, 11, 6, '1', 1.00, 10250.00, 10250.00),
	(22, 11, 6, '2', 2.00, 10250.00, 20500.00),
	(23, 11, 6, '3', 3.00, 10250.00, 30750.00),
	(24, 12, 9, '213', 12.00, 7800.00, 93600.00),
	(25, 12, 9, '32', 33.00, 7800.00, 257400.00);

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
INSERT INTO `stock_movements` (`id`, `warehouse_id`, `product_id`, `movement_date`, `movement_type`, `qty_in`, `qty_out`, `balance_after`, `reference_no`, `notes`, `created_by`, `created_at`) VALUES
	(1, 1, 1, '2026-03-01 08:00:00', 'OPENING', 1100.00, 0.00, 1100.00, 'OPEN-001', 'Opening stock for product 1', 1, '2026-03-09 06:02:47'),
	(2, 1, 2, '2026-03-02 08:00:00', 'OPENING', 1200.00, 0.00, 1200.00, 'OPEN-002', 'Opening stock for product 2', 1, '2026-03-09 06:02:47'),
	(3, 1, 3, '2026-03-03 08:00:00', 'OPENING', 1300.00, 0.00, 1300.00, 'OPEN-003', 'Opening stock for product 3', 1, '2026-03-09 06:02:47'),
	(4, 1, 4, '2026-03-04 08:00:00', 'OPENING', 1400.00, 0.00, 1400.00, 'OPEN-004', 'Opening stock for product 4', 1, '2026-03-09 06:02:47'),
	(5, 1, 5, '2026-03-05 08:00:00', 'OPENING', 1500.00, 0.00, 1500.00, 'OPEN-005', 'Opening stock for product 5', 1, '2026-03-09 06:02:47'),
	(6, 1, 6, '2026-03-06 08:00:00', 'OPENING', 1600.00, 0.00, 1600.00, 'OPEN-006', 'Opening stock for product 6', 1, '2026-03-09 06:02:47'),
	(7, 1, 7, '2026-03-07 08:00:00', 'OPENING', 1700.00, 0.00, 1700.00, 'OPEN-007', 'Opening stock for product 7', 1, '2026-03-09 06:02:47'),
	(8, 1, 8, '2026-03-08 08:00:00', 'OPENING', 1800.00, 0.00, 1800.00, 'OPEN-008', 'Opening stock for product 8', 1, '2026-03-09 06:02:47'),
	(9, 1, 9, '2026-03-09 08:00:00', 'OPENING', 1900.00, 0.00, 1900.00, 'OPEN-009', 'Opening stock for product 9', 1, '2026-03-09 06:02:47'),
	(10, 1, 10, '2026-03-10 08:00:00', 'OPENING', 2000.00, 0.00, 2000.00, 'OPEN-010', 'Opening stock for product 10', 1, '2026-03-09 06:02:47'),
	(11, 1, 6, '2026-03-09 13:08:36', 'SHIP', 0.00, 1.00, 1599.00, 'SO-UCO/202603/0011', 'Auto shipment from sales order', 1, '2026-03-09 06:08:36'),
	(12, 1, 6, '2026-03-09 13:08:36', 'SHIP', 0.00, 2.00, 1597.00, 'SO-UCO/202603/0011', 'Auto shipment from sales order', 1, '2026-03-09 06:08:36'),
	(13, 1, 6, '2026-03-09 13:08:36', 'SHIP', 0.00, 3.00, 1594.00, 'SO-UCO/202603/0011', 'Auto shipment from sales order', 1, '2026-03-09 06:08:36'),
	(14, 5, 9, '2026-04-06 00:00:00', 'IN', 100.00, 0.00, 100.00, 'ewq', 'ds', 1, '2026-04-06 13:44:04'),
	(15, 5, 9, '2026-04-06 20:44:19', 'SHIP', 0.00, 12.00, 88.00, 'SO-UCO/202604/0001', 'Auto shipment from sales order', 1, '2026-04-06 13:44:19'),
	(16, 5, 9, '2026-04-06 20:44:19', 'SHIP', 0.00, 33.00, 55.00, 'SO-UCO/202604/0001', 'Auto shipment from sales order', 1, '2026-04-06 13:44:19');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table uco_v4.suppliers: ~11 rows (approximately)
INSERT INTO `suppliers` (`id`, `company_name`, `pic_name`, `email`, `phone`, `address`, `country`) VALUES
	(1, 'Supplier 1', 'PIC Supplier 1', 'supplier1@mail.com', '+62-31-8800001', 'Jl. Supplier No. 1, Surabaya', 'Indonesia'),
	(2, 'Supplier 2', 'PIC Supplier 2', 'supplier2@mail.com', '+62-31-8800002', 'Jl. Supplier No. 2, Surabaya', 'Indonesia'),
	(3, 'Supplier 3', 'PIC Supplier 3', 'supplier3@mail.com', '+62-31-8800003', 'Jl. Supplier No. 3, Surabaya', 'Indonesia'),
	(4, 'Supplier 4', 'PIC Supplier 4', 'supplier4@mail.com', '+62-31-8800004', 'Jl. Supplier No. 4, Surabaya', 'Indonesia'),
	(5, 'Supplier 5', 'PIC Supplier 5', 'supplier5@mail.com', '+62-31-8800005', 'Jl. Supplier No. 5, Surabaya', 'Indonesia'),
	(6, 'Supplier 6', 'PIC Supplier 6', 'supplier6@mail.com', '+62-31-8800006', 'Jl. Supplier No. 6, Surabaya', 'Indonesia'),
	(7, 'Supplier 7', 'PIC Supplier 7', 'supplier7@mail.com', '+62-31-8800007', 'Jl. Supplier No. 7, Surabaya', 'Indonesia'),
	(8, 'Supplier 8', 'PIC Supplier 8', 'supplier8@mail.com', '+62-31-8800008', 'Jl. Supplier No. 8, Surabaya', 'Indonesia'),
	(9, 'Supplier 9', 'PIC Supplier 9', 'supplier9@mail.com', '+62-31-8800009', 'Jl. Supplier No. 9, Surabaya', 'Indonesia'),
	(10, 'Supplier 10', 'PIC Supplier 10', 'supplier10@mail.com', '+62-31-8800010', 'Jl. Supplier No. 10, Surabaya', 'Indonesia'),
	(11, 'tes', '1', '2', '3', '4', '5');

-- Dumping structure for table uco_v4.uoms
CREATE TABLE IF NOT EXISTS `uoms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uom_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
	(10, 'IBC'),
	(11, 'tes');

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
	(1, 'Administrator', 'admin', '$2y$12$raqM1AWvrWxfqMJFxQ6eneuF.8IiznoqPKp3tQ5vaWb528kHuDhCy', 'admin', 1, '2026-03-09 06:02:46'),
	(2, 'doni', 'doni', '$2y$10$xFf6ogs.jel.1GcDDw.P2eJIP9g5FjP9jF7QFIs.hTfTgR.3KUTnq', 'admin', 1, '2026-03-09 06:05:57'),
	(3, 'yoel', 'yoel', '$2y$10$dGZELlCH3rriA59Gg6mHouP402/hhKuaesAsIEkpQT4aW.vhEmnwy', 'admin', 1, '2026-03-09 06:06:05'),
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
	(2, 'WH-02', 'Tank Farm A', 'Location 2, East Java', 1),
	(3, 'WH-03', 'Tank Farm B', 'Location 3, East Java', 1),
	(4, 'WH-04', 'Transit Warehouse', 'Location 4, East Java', 1),
	(5, 'WH-05', 'Export Staging', 'Location 5, East Java', 1),
	(6, 'WH-06', 'Raw Material Yard', 'Location 6, East Java', 1),
	(7, 'WH-07', 'Finished Goods A', 'Location 7, East Java', 1),
	(8, 'WH-08', 'Finished Goods B', 'Location 8, East Java', 1),
	(9, 'WH-09', 'Overflow Storage', 'Location 9, East Java', 1),
	(10, 'WH-10', 'Sample Room', 'Location 10, East Java', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
