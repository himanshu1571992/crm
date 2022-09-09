<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-28 10:18:00 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-28 10:18:01 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-06-28 10:18:03 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-05-29' AND '2022-07-10') ELSE (duedate BETWEEN '2022-05-29' AND '2022-07-10') END
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-28 10:18:33 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-28 10:24:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-28 10:24:38 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-28 10:24:39 --> Severity: Notice --> Undefined variable: mm C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 501
ERROR - 2022-06-28 10:24:39 --> Severity: Notice --> Undefined variable: yyyy C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 505
ERROR - 2022-06-28 10:24:39 --> Severity: Notice --> Undefined variable: purchase_othercharges C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1248
ERROR - 2022-06-28 10:24:39 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1248
ERROR - 2022-06-28 10:24:39 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-06-28 10:24:39 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-06-28 10:24:39 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-06-28 10:24:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-06-28 10:24:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-28 16:10:38 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-28 16:10:39 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-06-28 16:10:41 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-05-29' AND '2022-07-10') ELSE (duedate BETWEEN '2022-05-29' AND '2022-07-10') END
