<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 10:25:44 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-06 10:25:45 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-07-06 10:25:47 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 10:27:01 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 10:27:04 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 10:29:02 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-06 10:30:22 --> Severity: Warning --> Illegal string offset 'tax_amt' C:\xampp\htdocs\crm\application\controllers\admin\Purchasechallanreturn.php 414
ERROR - 2022-07-06 10:30:22 --> Severity: Warning --> Illegal string offset 'tax_amt' C:\xampp\htdocs\crm\application\controllers\admin\Purchasechallanreturn.php 414
ERROR - 2022-07-06 10:30:22 --> Severity: Warning --> Illegal string offset 'tax_amt' C:\xampp\htdocs\crm\application\controllers\admin\Purchasechallanreturn.php 414
ERROR - 2022-07-06 10:30:22 --> Severity: Warning --> Illegal string offset 'tax_amt' C:\xampp\htdocs\crm\application\controllers\admin\Purchasechallanreturn.php 414
ERROR - 2022-07-06 10:30:22 --> Severity: Notice --> Undefined variable: id C:\xampp\htdocs\crm\application\controllers\admin\Purchasechallanreturn.php 442
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 10:30:23 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 11:07:01 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 11:08:43 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 17:54:00 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-06 17:54:01 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-07-06 17:54:03 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 17:54:12 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-07-06 17:54:15 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-07-06 17:54:15 --> Severity: Notice --> Undefined variable: payment_info C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 152
ERROR - 2022-07-06 17:54:15 --> Severity: Notice --> Trying to get property 'category_id' of non-object C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 152
ERROR - 2022-07-06 17:54:15 --> Severity: Notice --> Undefined variable: payment_info C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 169
ERROR - 2022-07-06 17:54:15 --> Severity: Notice --> Trying to get property 'head_id' of non-object C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 169
ERROR - 2022-07-06 17:54:27 --> Query error: Unknown column 'tblclientbranch' in 'field list' - Invalid query: SELECT `tblclientbranch` FROM `tblclientbranch` where userid = '1' 
