<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:40 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 10:23:41 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-10-10 10:23:43 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-09-25' AND '2022-11-06') ELSE (duedate BETWEEN '2022-09-25' AND '2022-11-06') END
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:23:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:26:04 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:36:58 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:37:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:02 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Trip assigned"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:38:52 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-10-10 10:38:52 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Trip assigned"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:39:06 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Trip assigned"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:39:12 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Trip assigned"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:39:44 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Trip assigned"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:39:54 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Trip assigned"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:39:58 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Stock For Approval"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Trip assigned"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:13 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:31 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:40:40 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 10:41:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\crm\application\vendor\tecnickcom\tcpdf\tcpdf.php 17784
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 10:41:24 --> Could not find the language line "Warehouse"
ERROR - 2022-10-10 10:41:24 --> Severity: Notice --> Undefined index: group C:\xampp\htdocs\crm\application\views\admin\settings\all.php 168
ERROR - 2022-10-10 10:41:24 --> Severity: Notice --> Undefined index: group C:\xampp\htdocs\crm\application\views\admin\settings\all.php 168
ERROR - 2022-10-10 10:41:24 --> Severity: Notice --> Undefined index: group C:\xampp\htdocs\crm\application\views\admin\settings\all.php 168
ERROR - 2022-10-10 10:41:24 --> Severity: Notice --> Undefined index: group C:\xampp\htdocs\crm\application\views\admin\settings\all.php 168
ERROR - 2022-10-10 10:41:24 --> Severity: Notice --> Undefined variable: warehouse C:\xampp\htdocs\crm\application\views\admin\settings\all.php 193
ERROR - 2022-10-10 10:41:32 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\crm\application\vendor\tecnickcom\tcpdf\tcpdf.php 17784
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:32 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 10:41:33 --> Could not find the language line "Warehouse"
ERROR - 2022-10-10 10:41:33 --> Severity: Notice --> Undefined variable: warehouse C:\xampp\htdocs\crm\application\views\admin\settings\all.php 193
ERROR - 2022-10-10 10:41:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\crm\application\vendor\tecnickcom\tcpdf\tcpdf.php 17784
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 10:41:38 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 10:41:39 --> Could not find the language line "Warehouse"
ERROR - 2022-10-10 10:41:39 --> Severity: Notice --> Undefined variable: warehouse C:\xampp\htdocs\crm\application\views\admin\settings\all.php 193
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:39:18 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:40:31 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-10-10 16:44:49 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
ERROR - 2022-10-10 16:44:50 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\follow_up\follow_up.php 60
