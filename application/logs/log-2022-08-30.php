<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-08-30 06:48:22 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2022-08-30 06:48:22 --> Severity: Warning --> mysqli::real_connect(): Error while reading greeting packet. PID=7220 C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2022-08-30 06:48:22 --> Severity: Warning --> mysqli::real_connect(): (HY000/2006): MySQL server has gone away C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2022-08-30 06:48:22 --> Unable to connect to the database
ERROR - 2022-08-30 06:49:41 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2022-08-30 06:49:41 --> Severity: Warning --> mysqli::real_connect(): Error while reading greeting packet. PID=5052 C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2022-08-30 06:49:41 --> Severity: Warning --> mysqli::real_connect(): (HY000/2006): MySQL server has gone away C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2022-08-30 06:49:41 --> Unable to connect to the database
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:22:01 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-30 10:22:03 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:22:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-08-30 10:22:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-08-30 10:22:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-08-30 10:22:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-08-30 10:22:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-08-30 10:22:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-08-30 10:22:15 --> Severity: Notice --> Undefined variable: year_id C:\xampp\htdocs\crm\application\views\admin\invoices\ledger.php 202
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:25 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:22:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:04 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:23:19 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:30:59 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:31:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 07:01:41 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2022-08-30 07:01:41 --> Unable to connect to the database
ERROR - 2022-08-30 07:01:43 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2022-08-30 07:01:43 --> Unable to connect to the database
ERROR - 2022-08-30 07:03:55 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2022-08-30 07:03:55 --> Unable to connect to the database
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:36:55 --> Severity: Notice --> Undefined variable: sdepartment_id C:\xampp\htdocs\crm\application\views\admin\requirement\requirement.php 66
ERROR - 2022-08-30 10:36:55 --> Severity: Notice --> Undefined variable: sdepartment_id C:\xampp\htdocs\crm\application\views\admin\requirement\requirement.php 66
ERROR - 2022-08-30 10:36:55 --> Severity: Notice --> Undefined variable: sdepartment_id C:\xampp\htdocs\crm\application\views\admin\requirement\requirement.php 66
ERROR - 2022-08-30 10:36:55 --> Severity: Notice --> Undefined variable: sdepartment_id C:\xampp\htdocs\crm\application\views\admin\requirement\requirement.php 66
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:36:55 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:32 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:33 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:33 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:33 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:33 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:33 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:33 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:33 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:37:34 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:06 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:38:49 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:38:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:18 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:39:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:39:29 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 340
ERROR - 2022-08-30 10:39:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 340
ERROR - 2022-08-30 10:39:29 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 354
ERROR - 2022-08-30 10:39:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-30 10:39:29 --> Severity: Notice --> Trying to get property 'file' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 434
ERROR - 2022-08-30 10:39:29 --> Severity: Notice --> Trying to get property 'file' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 434
ERROR - 2022-08-30 10:39:29 --> Severity: Notice --> Trying to get property 'file' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 436
ERROR - 2022-08-30 10:39:29 --> Severity: Notice --> Undefined variable: j C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 436
ERROR - 2022-08-30 10:39:29 --> Severity: Notice --> Undefined variable: j C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 436
ERROR - 2022-08-30 10:39:29 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-30 10:39:29 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-30 10:39:29 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-30 10:39:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-30 10:39:29 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-30 10:39:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-30 10:39:29 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-30 10:39:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-30 10:39:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-30 10:40:06 --> Severity: Notice --> Undefined index: product_123 C:\xampp\htdocs\crm\application\controllers\admin\Purchase.php 688
ERROR - 2022-08-30 10:40:06 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\models\Purchase_model.php 574
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Trip assigned"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:21 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-08-30 10:40:22 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Trip assigned"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:30 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Trip assigned"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:33 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-08-30 10:40:33 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-30 10:40:33 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-30 10:40:33 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-30 10:40:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-30 10:40:33 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-30 10:40:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-30 10:40:33 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-30 10:40:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-30 10:40:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Trip assigned"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:40:51 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-08-30 10:40:57 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:40:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:40:58 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:41:34 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 340
ERROR - 2022-08-30 10:41:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 340
ERROR - 2022-08-30 10:41:34 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 354
ERROR - 2022-08-30 10:41:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-30 10:41:34 --> Severity: Notice --> Trying to get property 'file' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 434
ERROR - 2022-08-30 10:41:34 --> Severity: Notice --> Trying to get property 'file' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 434
ERROR - 2022-08-30 10:41:34 --> Severity: Notice --> Trying to get property 'file' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 436
ERROR - 2022-08-30 10:41:34 --> Severity: Notice --> Undefined variable: j C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 436
ERROR - 2022-08-30 10:41:34 --> Severity: Notice --> Undefined variable: j C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 436
ERROR - 2022-08-30 10:41:34 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-30 10:41:34 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-30 10:41:34 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-30 10:41:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-30 10:41:34 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-30 10:41:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-30 10:41:34 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-30 10:41:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-30 10:41:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-30 10:41:38 --> Severity: Notice --> Undefined index: product_123 C:\xampp\htdocs\crm\application\controllers\admin\Purchase.php 3504
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:41 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Trip assigned"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:41:45 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Trip assigned"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:41:48 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-08-30 10:41:48 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-30 10:41:48 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-30 10:41:48 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-30 10:41:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-30 10:41:48 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-30 10:41:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-30 10:41:48 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-30 10:41:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-30 10:41:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Trip assigned"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-30 10:41:52 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 10:41:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:18 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:24:19 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:24:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:41 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:24:49 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:26:54 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:26:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:26:57 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:56:43 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:56:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:45 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:50 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:56:51 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:56:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:56:55 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:57:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:02 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:58:09 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:49 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:58:51 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:58:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:58:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:05 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 13:59:41 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 14:00:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:40:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 18:40:31 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:41:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 18:41:08 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-30 18:41:10 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:47 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:42:49 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:44:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:45:06 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 18:45:14 --> Query error: Unknown column 'start_date' in 'field list' - Invalid query: UPDATE `tblsoftwaretask` SET `developer_remark` = '', `start_date` = '2022-08-24', `end_date` = '', `status` = '2', `status_updated_by` = '1', `status_updated_at` = '2022-08-30 18:45:14'
WHERE `id` = '6'
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:46:58 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-30 18:47:10 --> Could not find the language line "Stock approve Successfully"
