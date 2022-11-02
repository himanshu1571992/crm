<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-11-02 05:39:54 --> Severity: Warning --> mysqli::query(): MySQL server has gone away C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2022-11-02 05:39:54 --> Severity: Warning --> mysqli::query(): Error reading result set's header C:\xampp\htdocs\crm\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2022-11-02 05:39:54 --> Query error: MySQL server has gone away - Invalid query: SELECT `data`
FROM `tblsessions`
WHERE `id` = '8ig292jht9j10bqq6v2cu5rbdocng347'
ERROR - 2022-11-02 05:39:54 --> Severity: Warning --> session_write_close(): Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2022-11-02 05:39:54 --> Severity: Warning --> session_write_close(): Failed to write session data using user defined save handler. (session.save_path: C:\xampp\tmp) Unknown 0
ERROR - 2022-11-02 05:39:54 --> Query error: MySQL server has gone away - Invalid query: SELECT RELEASE_LOCK('05729d31d220cdbbedb1900ac5cf0a34') AS ci_session_lock
ERROR - 2022-11-02 05:39:54 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\crm\system\core\Exceptions.php:271) C:\xampp\htdocs\crm\system\core\Common.php 570
ERROR - 2022-11-02 05:39:54 --> Severity: Warning --> Unknown: Failed to write session data (user). Please verify that the current setting of session.save_path is correct (C:\xampp\tmp) Unknown 0
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:12:43 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 10:12:46 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-11-02 10:12:46 --> Severity: Notice --> Undefined offset: 1 C:\xampp\htdocs\crm\application\helpers\widgets_helper.php 113
ERROR - 2022-11-02 10:12:57 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-10-30' AND '2022-12-11') ELSE (duedate BETWEEN '2022-10-30' AND '2022-12-11') END
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:40:06 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:41:29 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:41:30 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:50:50 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:50:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:58:09 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:58:10 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:01:45 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:04:06 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:04:33 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:05:23 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:06:09 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:06:18 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:06:41 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:07:00 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:07:07 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:10:02 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:10:24 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:11:27 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:12:00 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:13:08 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:13:49 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:14:01 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:23:18 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:24:50 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:24:55 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:25:07 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:25:14 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:25:18 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 11:25:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:25:54 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 11:26:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 11:26:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:28:37 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:28:54 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:29:10 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:30:13 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:30:41 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:30:49 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:30:50 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:30:50 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 11:31:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 11:31:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 11:36:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 11:36:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 11:44:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 11:45:08 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 07:31:56 --> Severity: error --> Exception: syntax error, unexpected '}', expecting ',' or ';' C:\xampp\htdocs\crm\application\controllers\admin\Complains.php 224
ERROR - 2022-11-02 07:32:23 --> Severity: error --> Exception: syntax error, unexpected '}', expecting ',' or ';' C:\xampp\htdocs\crm\application\controllers\admin\Complains.php 224
ERROR - 2022-11-02 07:33:21 --> Severity: error --> Exception: syntax error, unexpected '}', expecting ',' or ';' C:\xampp\htdocs\crm\application\controllers\admin\Complains.php 224
ERROR - 2022-11-02 07:34:23 --> Severity: error --> Exception: syntax error, unexpected '}', expecting ',' or ';' C:\xampp\htdocs\crm\application\controllers\admin\Complains.php 227
ERROR - 2022-11-02 07:34:27 --> Severity: error --> Exception: syntax error, unexpected '}', expecting ',' or ';' C:\xampp\htdocs\crm\application\controllers\admin\Complains.php 227
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:04:44 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 12:05:13 --> Severity: Notice --> Undefined property: stdClass::$resolve_till C:\xampp\htdocs\crm\application\controllers\admin\Complains.php 217
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:13:04 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:13:37 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:41:49 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 12:42:07 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:23:57 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:42:03 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:43:38 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:44:55 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:45:47 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:52:37 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:56:17 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:01:21 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:01:30 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:07:17 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:07:18 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 436
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:18:21 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:18:23 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 448
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:20:51 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:20:52 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 448
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:21:07 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:21:08 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 448
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:34:05 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:34:06 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 449
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:34:11 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:34:13 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 449
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:35:07 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:35:08 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 449
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:35:35 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:35:36 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 449
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:35:56 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:35:57 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 449
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:36:40 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:36:41 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 450
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:36:53 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:36:55 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 450
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:37:22 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:37:23 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 451
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:38:00 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:38:01 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 451
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:40:09 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:40:10 --> Severity: Notice --> Undefined variable: round C:\xampp\htdocs\crm\application\views\admin\chalan\view_satisfaction_details.php 451
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:43:02 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:43:26 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:44:30 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:45:57 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-02 14:46:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:46:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:46:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:46:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:46:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Request Decline"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 14:46:26 --> Could not find the language line "Request Approved by Petty Cash"
