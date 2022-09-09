<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-08-02 05:26:59 --> Severity: Warning --> mysqli::query(): MySQL server has gone away C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2022-08-02 05:26:59 --> Severity: Warning --> mysqli::query(): Error reading result set's header C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2022-08-02 05:26:59 --> Query error: MySQL server has gone away - Invalid query: SELECT `data`
FROM `tblsessions`
WHERE `id` = 'qpci7vde5urm8dhhcgjbo6hlggu4pa5i'
ERROR - 2022-08-02 05:26:59 --> Severity: Warning --> session_write_close(): Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2022-08-02 05:26:59 --> Severity: Warning --> session_write_close(): Failed to write session data using user defined save handler. (session.save_path: C:\xampp\tmp) Unknown 0
ERROR - 2022-08-02 05:26:59 --> Query error: MySQL server has gone away - Invalid query: SELECT RELEASE_LOCK('21f87418fe15d96364e5fe8b2d539490') AS ci_session_lock
ERROR - 2022-08-02 05:26:59 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\crm\system\core\Exceptions.php:271) C:\xampp\htdocs\crm\system\core\Common.php 570
ERROR - 2022-08-02 05:26:59 --> Severity: Warning --> Unknown: Failed to write session data (user). Please verify that the current setting of session.save_path is correct (C:\xampp\tmp) Unknown 0
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-02 09:40:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:40:57 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-02 09:40:58 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-02 09:41:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:41:54 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-02 09:41:54 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Trip assigned"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-08-02 09:42:29 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-08-02 09:42:29 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Trip assigned"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-08-02 09:42:41 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-08-02 09:42:41 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Trip assigned"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-08-02 09:42:47 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-08-02 09:42:47 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Stock For Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Trip assigned"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-08-02 09:42:49 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-08-02 09:42:49 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-02 09:43:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 09:43:04 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-02 09:43:05 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-02 18:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-02 18:16:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-02 18:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-02 18:16:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
