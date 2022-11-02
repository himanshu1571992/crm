<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 09:37:29 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 09:37:32 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-11-01 09:37:33 --> Severity: Notice --> Undefined offset: 1 C:\xampp\htdocs\crm\application\helpers\widgets_helper.php 113
ERROR - 2022-11-01 09:37:41 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 09:37:54 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 09:38:14 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:02:33 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:02:34 --> Severity: Notice --> Undefined property: stdClass::$po_date C:\xampp\htdocs\crm\application\views\admin\report\vendor_payments_report.php 83
ERROR - 2022-11-01 10:02:34 --> Severity: Notice --> Undefined property: stdClass::$vendor_id C:\xampp\htdocs\crm\application\views\admin\report\vendor_payments_report.php 84
ERROR - 2022-11-01 10:02:34 --> Severity: Notice --> Undefined property: stdClass::$totalamount C:\xampp\htdocs\crm\application\views\admin\report\vendor_payments_report.php 85
ERROR - 2022-11-01 10:02:34 --> Severity: Notice --> Undefined property: stdClass::$po_date C:\xampp\htdocs\crm\application\views\admin\report\vendor_payments_report.php 83
ERROR - 2022-11-01 10:02:34 --> Severity: Notice --> Undefined property: stdClass::$vendor_id C:\xampp\htdocs\crm\application\views\admin\report\vendor_payments_report.php 84
ERROR - 2022-11-01 10:02:34 --> Severity: Notice --> Undefined property: stdClass::$totalamount C:\xampp\htdocs\crm\application\views\admin\report\vendor_payments_report.php 85
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:03:07 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:03:09 --> Severity: Notice --> Undefined property: stdClass::$po_date C:\xampp\htdocs\crm\application\views\admin\report\vendor_payments_report.php 83
ERROR - 2022-11-01 10:03:09 --> Severity: Notice --> Undefined property: stdClass::$vendor_id C:\xampp\htdocs\crm\application\views\admin\report\vendor_payments_report.php 84
ERROR - 2022-11-01 10:03:09 --> Severity: Notice --> Undefined property: stdClass::$totalamount C:\xampp\htdocs\crm\application\views\admin\report\vendor_payments_report.php 85
ERROR - 2022-11-01 10:03:09 --> Severity: Notice --> Undefined property: stdClass::$po_date C:\xampp\htdocs\crm\application\views\admin\report\vendor_payments_report.php 83
ERROR - 2022-11-01 10:03:09 --> Severity: Notice --> Undefined property: stdClass::$vendor_id C:\xampp\htdocs\crm\application\views\admin\report\vendor_payments_report.php 84
ERROR - 2022-11-01 10:03:09 --> Severity: Notice --> Undefined property: stdClass::$totalamount C:\xampp\htdocs\crm\application\views\admin\report\vendor_payments_report.php 85
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:03:56 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:04:39 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:08:00 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:08:50 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:10:01 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:10:15 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:11:19 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:12:59 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:13:45 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:14:14 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:14:54 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:15:09 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:15:16 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:17:33 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:18:09 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:18:17 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:18:34 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:24:42 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:24:59 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:25:42 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:25:43 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:25:43 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:25:43 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:25:43 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:28:57 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:33:23 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:34:17 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:34:51 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:34:57 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:35:02 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:35:14 --> Severity: Notice --> Undefined variable: tax_amt C:\xampp\htdocs\crm\application\helpers\mypdf_helper.php 3771
ERROR - 2022-11-01 10:35:14 --> Severity: Notice --> Undefined variable: tax_amt C:\xampp\htdocs\crm\application\helpers\mypdf_helper.php 3771
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:36:28 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:36:49 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:37:38 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:42:22 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:42:37 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 10:42:44 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 13:50:20 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 13:50:22 --> Severity: Notice --> Undefined variable: purchase_othercharges C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1117
ERROR - 2022-11-01 13:50:22 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1117
ERROR - 2022-11-01 13:50:22 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 13:50:22 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 13:50:22 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 13:50:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 13:50:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 13:50:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:50:53 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 13:51:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 13:51:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 13:51:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:51:34 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 13:51:34 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 13:51:34 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 13:51:34 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 354
ERROR - 2022-11-01 13:51:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 354
ERROR - 2022-11-01 13:51:34 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 361
ERROR - 2022-11-01 13:51:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 13:51:35 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 536
ERROR - 2022-11-01 13:51:35 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 13:51:35 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 13:51:35 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 13:51:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 13:51:35 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 13:51:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 13:51:35 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 13:51:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 13:51:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 13:51:35 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1205
ERROR - 2022-11-01 13:51:35 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1212
ERROR - 2022-11-01 13:51:35 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1304
ERROR - 2022-11-01 13:51:35 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1311
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 13:55:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:55:04 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 13:55:04 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 13:55:04 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 13:55:04 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 354
ERROR - 2022-11-01 13:55:04 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 354
ERROR - 2022-11-01 13:55:05 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 361
ERROR - 2022-11-01 13:55:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 13:55:05 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 536
ERROR - 2022-11-01 13:55:05 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 13:55:05 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 13:55:05 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 13:55:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 13:55:05 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 13:55:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 13:55:05 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 13:55:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 13:55:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 13:55:05 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1205
ERROR - 2022-11-01 13:55:05 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1212
ERROR - 2022-11-01 13:55:05 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1304
ERROR - 2022-11-01 13:55:05 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1311
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 13:57:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 359
ERROR - 2022-11-01 13:57:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 359
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 366
ERROR - 2022-11-01 13:57:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 541
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 13:57:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 13:57:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 13:57:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 13:57:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1210
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1217
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1309
ERROR - 2022-11-01 13:57:14 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1316
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 13:57:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 357
ERROR - 2022-11-01 13:57:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 357
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 364
ERROR - 2022-11-01 13:57:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 539
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 13:57:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 13:57:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 13:57:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 13:57:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1208
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1215
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1307
ERROR - 2022-11-01 13:57:34 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1314
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:02:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 369
ERROR - 2022-11-01 14:02:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 369
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 376
ERROR - 2022-11-01 14:02:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 551
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:02:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:02:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:02:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:02:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1220
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1227
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1319
ERROR - 2022-11-01 14:02:33 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1326
ERROR - 2022-11-01 14:04:54 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:04:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:54 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:04:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:04:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 369
ERROR - 2022-11-01 14:04:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 369
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 376
ERROR - 2022-11-01 14:04:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 551
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:04:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:04:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:04:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:04:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1220
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1227
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1319
ERROR - 2022-11-01 14:04:55 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1326
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:05:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 369
ERROR - 2022-11-01 14:05:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 369
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 376
ERROR - 2022-11-01 14:05:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 551
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:05:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:05:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:05:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:05:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1220
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1227
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1319
ERROR - 2022-11-01 14:05:32 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1326
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:05:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 369
ERROR - 2022-11-01 14:05:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 369
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 376
ERROR - 2022-11-01 14:05:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 551
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:05:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:05:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:05:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:05:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1220
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1227
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1319
ERROR - 2022-11-01 14:05:52 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1326
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:07:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 384
ERROR - 2022-11-01 14:07:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 384
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 391
ERROR - 2022-11-01 14:07:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 566
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:07:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:07:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:07:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:07:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1235
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1242
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1334
ERROR - 2022-11-01 14:07:40 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1341
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:07:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 384
ERROR - 2022-11-01 14:08:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 384
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 391
ERROR - 2022-11-01 14:08:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 566
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:08:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:08:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:08:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:08:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1235
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1242
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1334
ERROR - 2022-11-01 14:08:00 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1341
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:29:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 399
ERROR - 2022-11-01 14:29:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 399
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 406
ERROR - 2022-11-01 14:29:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 581
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:29:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:29:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:29:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:29:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1250
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1257
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1349
ERROR - 2022-11-01 14:29:26 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1356
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:35:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 423
ERROR - 2022-11-01 14:35:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 423
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 430
ERROR - 2022-11-01 14:35:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 605
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:35:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:35:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:35:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:35:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1274
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1281
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1373
ERROR - 2022-11-01 14:35:02 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1380
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:36:13 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 423
ERROR - 2022-11-01 14:36:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 423
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 430
ERROR - 2022-11-01 14:36:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 605
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:36:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:36:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:36:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:36:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1274
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1281
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1373
ERROR - 2022-11-01 14:36:14 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1380
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:37:08 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 454
ERROR - 2022-11-01 14:37:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 454
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 461
ERROR - 2022-11-01 14:37:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 636
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:37:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:37:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:37:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:37:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1305
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1312
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1404
ERROR - 2022-11-01 14:37:09 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1411
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:37:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 454
ERROR - 2022-11-01 14:37:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 454
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 461
ERROR - 2022-11-01 14:37:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 636
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:37:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:37:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:37:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:37:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1305
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1312
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1404
ERROR - 2022-11-01 14:37:57 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1411
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:39:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 454
ERROR - 2022-11-01 14:39:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 454
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 461
ERROR - 2022-11-01 14:39:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 636
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:39:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:39:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:39:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:39:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1305
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1312
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1404
ERROR - 2022-11-01 14:39:00 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1411
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:39:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 454
ERROR - 2022-11-01 14:39:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 454
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 461
ERROR - 2022-11-01 14:39:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 636
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:39:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:39:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:39:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:39:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1305
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1312
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1404
ERROR - 2022-11-01 14:39:44 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1411
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:41:59 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 462
ERROR - 2022-11-01 14:42:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 462
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 469
ERROR - 2022-11-01 14:42:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 644
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:42:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:42:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:42:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:42:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1313
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1320
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1412
ERROR - 2022-11-01 14:42:00 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1419
ERROR - 2022-11-01 14:42:01 --> Severity: Notice --> Undefined variable: purchase_othercharges C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1117
ERROR - 2022-11-01 14:42:01 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1117
ERROR - 2022-11-01 14:42:01 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:42:01 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:42:01 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:42:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:42:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:42:33 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 462
ERROR - 2022-11-01 14:42:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 462
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 469
ERROR - 2022-11-01 14:42:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 644
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:42:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:42:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:42:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:42:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1313
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1320
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1412
ERROR - 2022-11-01 14:42:33 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1419
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:42:47 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 14:42:48 --> Severity: Notice --> Undefined variable: purchase_othercharges C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1117
ERROR - 2022-11-01 14:42:48 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1117
ERROR - 2022-11-01 14:42:48 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:42:48 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:42:48 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:42:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:42:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Request Decline"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Request Approved, Pay by Petty Cash"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Expense approve Successfully"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Expense Decline"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Leave Decline"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Petty Cash Request Approved Successfully"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:49:40 --> Could not find the language line "Request Approved by Petty Cash"
ERROR - 2022-11-01 14:49:41 --> Severity: Notice --> Undefined variable: purchase_othercharges C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1117
ERROR - 2022-11-01 14:49:41 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1117
ERROR - 2022-11-01 14:49:41 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:49:41 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:49:41 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:49:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:49:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:49:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 456
ERROR - 2022-11-01 14:49:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 456
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 463
ERROR - 2022-11-01 14:49:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 644
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:49:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:49:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:49:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:49:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1313
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1320
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1412
ERROR - 2022-11-01 14:49:45 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1419
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Expenses Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-01 14:51:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 438
ERROR - 2022-11-01 14:51:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 438
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 445
ERROR - 2022-11-01 14:51:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Trying to get property 'field_value' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 626
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:51:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:51:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:51:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-11-01 14:51:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1295
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1302
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1394
ERROR - 2022-11-01 14:51:55 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1401
