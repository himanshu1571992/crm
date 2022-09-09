<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 10:15:28 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-07 10:15:29 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-07-07 10:15:31 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 10:15:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 10:16:53 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:23:50 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-07 11:23:50 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store\floorstore_varify.php 25
ERROR - 2022-07-07 11:23:50 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store\floorstore_varify.php 25
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:23:54 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:24:36 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-07 11:24:37 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 24
ERROR - 2022-07-07 11:24:37 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 24
ERROR - 2022-07-07 11:24:37 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:37 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:37 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:37 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:37 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:37 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:37 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:37 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:37 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:24:43 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-07 11:24:43 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:43 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:43 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:43 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:43 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:43 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:43 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:43 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:24:43 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:27:11 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-07 11:27:12 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\main_store_stock_report.php 24
ERROR - 2022-07-07 11:27:12 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\main_store_stock_report.php 24
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:27:24 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-07 11:27:24 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\floor_store_stock_report.php 24
ERROR - 2022-07-07 11:27:24 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\floor_store_stock_report.php 24
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 11:27:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-07 11:27:29 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\finished_goods_stock_report.php 24
ERROR - 2022-07-07 11:27:29 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\finished_goods_stock_report.php 24
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-07 15:56:23 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-07 15:56:24 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 24
ERROR - 2022-07-07 15:56:24 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 24
ERROR - 2022-07-07 15:56:24 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 15:56:24 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 15:56:24 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 15:56:24 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 15:56:24 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 15:56:24 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 15:56:24 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 15:56:24 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
ERROR - 2022-07-07 15:56:24 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 52
