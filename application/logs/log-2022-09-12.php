<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:34 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:20:35 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-12 10:20:36 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-08-28' AND '2022-10-09') ELSE (duedate BETWEEN '2022-08-28' AND '2022-10-09') END
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:26:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:11:17 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:12:36 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 12:13:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:55 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: client_branch C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 230
ERROR - 2022-09-12 14:23:56 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 230
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: site_ids C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 234
ERROR - 2022-09-12 14:23:56 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 234
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: client_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 236
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: flow C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 237
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: service_type C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 238
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 239
ERROR - 2022-09-12 14:23:56 --> Severity: Notice --> Undefined variable: service_type C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 919
ERROR - 2022-09-12 14:23:56 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') and payment_behalf = 1 and service_type = '' and status = 1' at line 1 - Invalid query: SELECT * FROM `tblclientpayment`  where client_id IN () and payment_behalf = 1 and service_type = '' and status = 1  
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:25:12 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:25:12 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:25:12 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:25:12 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:25:12 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:25:12 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:25:12 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:25:12 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:25:12 --> Severity: Notice --> Undefined variable: site_ids C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 236
ERROR - 2022-09-12 14:25:12 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 236
ERROR - 2022-09-12 14:25:12 --> Severity: Notice --> Undefined variable: client_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 238
ERROR - 2022-09-12 14:25:12 --> Severity: Notice --> Undefined variable: flow C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 239
ERROR - 2022-09-12 14:25:12 --> Severity: Notice --> Undefined variable: service_type C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 240
ERROR - 2022-09-12 14:25:12 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 241
ERROR - 2022-09-12 14:25:12 --> Severity: Notice --> Undefined variable: service_type C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 921
ERROR - 2022-09-12 14:25:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') and payment_behalf = 1 and service_type = '' and status = 1' at line 1 - Invalid query: SELECT * FROM `tblclientpayment`  where client_id IN () and payment_behalf = 1 and service_type = '' and status = 1  
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:26:46 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:26:46 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:26:46 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:26:46 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:26:46 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:26:46 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:26:46 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:26:46 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:26:46 --> Severity: Notice --> Undefined variable: client_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 238
ERROR - 2022-09-12 14:26:46 --> Severity: Notice --> Undefined variable: flow C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 239
ERROR - 2022-09-12 14:26:46 --> Severity: Notice --> Undefined variable: service_type C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 240
ERROR - 2022-09-12 14:26:46 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 241
ERROR - 2022-09-12 14:26:46 --> Severity: Notice --> Undefined variable: service_type C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 921
ERROR - 2022-09-12 14:26:46 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') and payment_behalf = 1 and service_type = '' and status = 1' at line 1 - Invalid query: SELECT * FROM `tblclientpayment`  where client_id IN () and payment_behalf = 1 and service_type = '' and status = 1  
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:27:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:27:25 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:27:25 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:27:25 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:27:25 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:27:25 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:27:25 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:27:25 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:27:25 --> Severity: Notice --> Undefined variable: flow C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 239
ERROR - 2022-09-12 14:27:25 --> Severity: Notice --> Undefined variable: service_type C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 240
ERROR - 2022-09-12 14:27:25 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 241
ERROR - 2022-09-12 14:27:25 --> Severity: Notice --> Undefined variable: service_type C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 921
ERROR - 2022-09-12 14:27:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') and payment_behalf = 1 and service_type = '' and status = 1' at line 1 - Invalid query: SELECT * FROM `tblclientpayment`  where client_id IN () and payment_behalf = 1 and service_type = '' and status = 1  
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:28:14 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:28:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:28:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:28:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:28:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:28:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:28:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:28:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:28:15 --> Severity: Notice --> Undefined variable: service_type C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 921
ERROR - 2022-09-12 14:28:15 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') and payment_behalf = 1 and service_type = '' and status = 1' at line 1 - Invalid query: SELECT * FROM `tblclientpayment`  where client_id IN () and payment_behalf = 1 and service_type = '' and status = 1  
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:29:08 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:29:08 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:29:08 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:29:08 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:29:08 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:29:08 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:29:08 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:29:08 --> Severity: Notice --> Undefined variable: service_type C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 934
ERROR - 2022-09-12 14:29:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') and status = 1 and service_type = ''' at line 1 - Invalid query: SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblclientwaveoff`  where client_id IN () and status = 1 and service_type = ''  
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:30:16 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:16 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:16 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:16 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:16 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:16 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:16 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') and status = 1 and service_type = '0'' at line 1 - Invalid query: SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblclientwaveoff`  where client_id IN () and status = 1 and service_type = '0'  
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:36 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:30:36 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:36 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:36 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:36 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:36 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:36 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:36 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:30:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') and status = 1 and service_type = '0'' at line 1 - Invalid query: SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblclientwaveoff`  where client_id IN () and status = 1 and service_type = '0'  
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:31:24 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:31:24 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:31:24 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:31:24 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:31:24 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:31:24 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:31:24 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:43 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:31:53 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:31:53 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:31:53 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:31:53 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:31:53 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:31:53 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:31:53 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:34:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:34:57 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:34:57 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:34:57 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:34:57 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:34:57 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:34:57 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:34:57 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:14 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:37:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:37:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:37:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:37:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:37:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:37:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:37:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:37:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:19:11 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 17:19:11 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 613
ERROR - 2022-09-12 17:19:11 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 688
ERROR - 2022-09-12 17:19:11 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:19:11 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:19:11 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:19:11 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:19:11 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:19:11 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:19:11 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:19:11 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:26 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 17:30:26 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 613
ERROR - 2022-09-12 17:30:26 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 688
ERROR - 2022-09-12 17:30:26 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:30:26 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:30:26 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:30:26 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:30:26 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:30:26 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:30:26 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:30:26 --> Severity: Notice --> Undefined variable: member C:\xampp\htdocs\crm\application\views\admin\staff\members.php 764
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:30:32 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:21 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:33 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 17:31:33 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 17:31:33 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 17:31:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 17:31:33 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-09-12 17:31:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-09-12 17:31:33 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-09-12 17:31:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-09-12 17:31:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 17:31:42 --> Severity: Notice --> Undefined index: info C:\xampp\htdocs\crm\application\controllers\admin\Staff.php 1266
ERROR - 2022-09-12 17:31:42 --> Severity: Notice --> Trying to get property 'staffid' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Staff.php 1266
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:43 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 17:31:47 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:09 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:11 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:30:14 --> Could not find the language line "Stock approve Successfully"
