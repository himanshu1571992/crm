<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 10:43:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 10:43:35 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-07-11 10:43:37 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-06-26' AND '2022-08-07') ELSE (duedate BETWEEN '2022-06-26' AND '2022-08-07') END
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 12:54:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 13:08:16 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 13:08:22 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 24
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 24
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:22 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 13:08:51 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:11:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:14:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 24
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 24
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:20 --> Severity: Notice --> Undefined variable: operator_id C:\xampp\htdocs\crm\application\views\admin\store\main_store_issue.php 61
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:14:24 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:15:18 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:15:23 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:15:23 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 16:15:23 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 16:15:23 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 16:15:23 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 16:15:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 16:15:23 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 16:15:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 16:15:23 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 16:15:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 16:15:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:15:36 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:15:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:15:48 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 16:15:48 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 16:15:48 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 16:15:48 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 16:15:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 16:15:48 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 16:15:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 16:15:48 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 16:15:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 16:15:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:16:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:16:50 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:16:51 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 16:16:51 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 16:16:51 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 16:16:51 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 16:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 16:16:51 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 16:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 16:16:51 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 16:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 16:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:17:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:17:35 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 16:17:35 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 16:17:35 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 16:17:35 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 16:17:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 16:17:35 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 16:17:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 16:17:35 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 16:17:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 16:17:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-07-11 16:18:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:04 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:18:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:18:04 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:18:04 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:18:04 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:26:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:27:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:27:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:27:36 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 16:27:37 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 17:49:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 17:49:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:10:40 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:10:44 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:10:44 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 18:10:44 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:10:44 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:10:44 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:10:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:10:44 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:10:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:10:44 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:10:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:10:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:11:07 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:11:16 --> Could not find the language line "Software Task Deleted succesfully"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:11:17 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:17:38 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:17:38 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 18:17:38 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:17:38 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:17:38 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:17:38 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:17:38 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:17:38 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:17:38 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:17:38 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:17:38 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:18:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:18:21 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 18:18:21 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:18:21 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:18:21 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:18:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:18:21 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:18:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:18:21 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:18:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:18:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:00 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:19:01 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 18:19:01 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:01 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:01 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:01 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:01 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:09 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:19:09 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 18:19:09 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:09 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:09 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:09 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:09 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:14 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:19:14 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 18:19:14 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:14 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:14 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:14 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:14 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:18 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:19:19 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 18:19:19 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:19 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:19 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:19 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:19 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:24 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:19:24 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 18:19:24 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:24 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:24 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:24 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:24 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:19:35 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 18:19:35 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:35 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:35 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:35 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:35 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-11 18:19:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-11 18:19:58 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\employees\add_software_task.php 3
ERROR - 2022-07-11 18:19:58 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:58 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-07-11 18:19:58 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-07-11 18:19:58 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-07-11 18:19:58 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-07-11 18:19:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
