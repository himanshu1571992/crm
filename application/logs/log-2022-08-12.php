<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-08-12 11:09:31 --> Severity: Warning --> mysqli::query(): MySQL server has gone away C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2022-08-12 11:09:31 --> Severity: Warning --> mysqli::query(): Error reading result set's header C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2022-08-12 11:09:31 --> Query error: MySQL server has gone away - Invalid query: SHOW COLUMNS FROM `tbloptions`
ERROR - 2022-08-12 11:09:31 --> Query error: MySQL server has gone away - Invalid query: INSERT INTO `tblsessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('3c8gung1nao66rvnoaarrefk5i0grd5u', 'fe80::8866:496a:c6ba:fbba', 1660295371, '__ci_last_regenerate|i:1660295359;')
ERROR - 2022-08-12 11:09:31 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\crm\system\database\DB_driver.php:1782) C:\xampp\htdocs\crm\system\core\Common.php 570
ERROR - 2022-08-12 11:09:31 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2022-08-12 11:09:31 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:\xampp\tmp) Unknown 0
ERROR - 2022-08-12 11:09:31 --> Query error: MySQL server has gone away - Invalid query: SELECT RELEASE_LOCK('5b64c86a252f8963721a635baf75519d') AS ci_session_lock
ERROR - 2022-08-12 11:09:31 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\crm\system\database\DB_driver.php:1782) C:\xampp\htdocs\crm\system\core\Common.php 570
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-12 14:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:39:59 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-12 14:40:01 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
        WHEN "contract" THEN (SELECT subject FROM tblcontracts WHERE tblcontracts.id = tblstafftasks.rel_id)
        WHEN "estimate" THEN (SELECT id FROM tblestimates WHERE tblestimates.id = tblstafftasks.rel_id)
        WHEN "proposal" THEN (SELECT id FROM tblproposals WHERE tblproposals.id = tblstafftasks.rel_id)
        WHEN "invoice" THEN (SELECT id FROM tblinvoices WHERE tblinvoices.id = tblstafftasks.rel_id)
        WHEN "ticket" THEN (SELECT CONCAT(CONCAT("#", tbltickets.ticketid), " - ", tbltickets.subject) FROM tbltickets WHERE tbltickets.ticketid=tblstafftasks.rel_id)
        WHEN "lead" THEN (SELECT CASE tblleads.email WHEN "" THEN tblleads.name ELSE CONCAT(tblleads.name, " - ", tblleads.email) END FROM tblleads WHERE tblleads.id=tblstafftasks.rel_id)
        WHEN "customer" THEN (SELECT CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclients.userid and is_primary = 1) ELSE company END FROM tblclients WHERE tblclients.userid=tblstafftasks.rel_id)
        WHEN "project" THEN (SELECT CONCAT(CONCAT(CONCAT("#", tblprojects.id), " - ", tblprojects.name), " - ", (SELECT CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclients.userid and is_primary = 1) ELSE company END FROM tblclients WHERE userid=tblprojects.clientid)) FROM tblprojects WHERE tblprojects.id=tblstafftasks.rel_id)
        WHEN "expense" THEN (SELECT CASE expense_name WHEN "" THEN tblexpensescategories.name ELSE
         CONCAT(tblexpensescategories.name, ' (', tblexpenses.expense_name, ')') END FROM tblexpenses JOIN tblexpensescategories ON tblexpensescategories.id = tblexpenses.category WHERE tblexpenses.id=tblstafftasks.rel_id)
        ELSE NULL
        END) as rel_name, rel_id, status, CASE WHEN duedate IS NULL THEN startdate ELSE duedate END as date
FROM `tblstafftasks`
WHERE `status` != 5
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-07-31' AND '2022-09-11') ELSE (duedate BETWEEN '2022-07-31' AND '2022-09-11') END
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-12 14:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:06 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\finished_goods_stock_report.php 24
ERROR - 2022-08-12 14:40:06 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\finished_goods_stock_report.php 24
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-12 14:40:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-12 14:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:07 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\finished_goods_stock_report.php 24
ERROR - 2022-08-12 14:41:07 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\finished_goods_stock_report.php 24
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-12 14:41:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-12 14:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:41:38 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\finished_goods_stock_report.php 24
ERROR - 2022-08-12 14:41:38 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\finished_goods_stock_report.php 24
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:06 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-12 14:42:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-12 14:42:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-12 14:42:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
