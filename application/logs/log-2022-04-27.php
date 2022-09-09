<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:30 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-04-27 10:03:32 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-03-27' AND '2022-05-08') ELSE (duedate BETWEEN '2022-03-27' AND '2022-05-08') END
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:03:58 --> Severity: Notice --> Undefined variable: lead_data C:\xampp\htdocs\crm\application\views\admin\leads\new_list.php 333
ERROR - 2022-04-27 10:03:58 --> Severity: Notice --> Undefined variable: lead_data C:\xampp\htdocs\crm\application\views\admin\leads\new_list.php 336
ERROR - 2022-04-27 10:03:58 --> Severity: Notice --> Undefined variable: lead_data C:\xampp\htdocs\crm\application\views\admin\leads\new_list.php 339
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:06 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:04:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 267
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:05:48 --> Could not find the language line "Address"
ERROR - 2022-04-27 10:05:48 --> Severity: Notice --> Undefined variable: lead C:\xampp\htdocs\crm\application\views\admin\enquiry\lead.php 225
ERROR - 2022-04-27 10:05:48 --> Severity: Notice --> Undefined variable: productcomponent C:\xampp\htdocs\crm\application\views\admin\enquiry\lead.php 641
ERROR - 2022-04-27 10:05:48 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\enquiry\lead.php 641
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:16:21 --> Severity: Notice --> Undefined offset: 8 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:16:21 --> Severity: Notice --> Undefined offset: 9 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:16:22 --> Query error: Table 'crm.tblproposalstaffapproval' doesn't exist - Invalid query: SELECT * FROM `tblproposalstaffapproval` WHERE `lead_id`='99'
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:21:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: rel_type C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 608
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1101
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1101
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1101
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1101
ERROR - 2022-04-27 10:21:48 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1105
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: product_id C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1150
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: sac_code C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1192
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1101
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1101
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1101
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1101
ERROR - 2022-04-27 10:21:48 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1105
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: product_id C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1150
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: sac_code C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1192
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1101
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1101
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1101
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1101
ERROR - 2022-04-27 10:21:48 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1105
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: product_id C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1150
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined index: sac_code C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1192
ERROR - 2022-04-27 10:21:48 --> Severity: Notice --> Undefined variable: items_groups C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 66
ERROR - 2022-04-27 10:21:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 10:21:49 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 618
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:44 --> Severity: Notice --> Undefined variable: statuses C:\xampp\htdocs\crm\application\views\admin\lead_report\lead_profile.php 272
ERROR - 2022-04-27 10:23:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\lead_report\lead_profile.php 272
ERROR - 2022-04-27 10:23:44 --> Severity: Notice --> Undefined variable: statuses C:\xampp\htdocs\crm\application\views\admin\lead_report\lead_profile.php 277
ERROR - 2022-04-27 10:23:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 10:23:44 --> Severity: Notice --> Undefined variable: sources C:\xampp\htdocs\crm\application\views\admin\lead_report\lead_profile.php 283
ERROR - 2022-04-27 10:23:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 10:23:44 --> Severity: Notice --> Undefined variable: members C:\xampp\htdocs\crm\application\views\admin\lead_report\lead_profile.php 298
ERROR - 2022-04-27 10:23:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 10:23:44 --> Severity: Notice --> Undefined variable: lead_locked C:\xampp\htdocs\crm\application\views\admin\lead_report\lead_profile.php 469
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined index: company_category C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1291
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: color C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1470
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: profitper C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1470
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: color C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1470
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: profitper C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1470
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: rent_othercharges C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1644
ERROR - 2022-04-27 10:23:50 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1644
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: rent_othercharges C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1863
ERROR - 2022-04-27 10:23:50 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 1863
ERROR - 2022-04-27 10:23:50 --> Severity: Warning --> A non-numeric value encountered C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 2300
ERROR - 2022-04-27 10:23:50 --> Severity: Warning --> A non-numeric value encountered C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 2318
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: color C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 2324
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: profitper C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 2324
ERROR - 2022-04-27 10:23:50 --> Severity: Warning --> A non-numeric value encountered C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 2337
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: color C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 2324
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: profitper C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 2324
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: sale_othercharges C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 2506
ERROR - 2022-04-27 10:23:50 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 2506
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: sale_othercharges C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 2714
ERROR - 2022-04-27 10:23:50 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 2714
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: items_groups C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 66
ERROR - 2022-04-27 10:23:50 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: proposal C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 4638
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Trying to get property 'rel_id' of non-object C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 4638
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Undefined variable: proposal C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 4640
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Trying to get property 'rel_id' of non-object C:\xampp\htdocs\crm\application\views\admin\proposals\proposals.php 4640
ERROR - 2022-04-27 10:23:50 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 618
ERROR - 2022-04-27 10:23:51 --> Severity: Notice --> Undefined variable: for C:\xampp\htdocs\crm\application\controllers\admin\Terms_conditions.php 86
ERROR - 2022-04-27 10:23:51 --> Severity: Notice --> Undefined variable: type C:\xampp\htdocs\crm\application\controllers\admin\Terms_conditions.php 86
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:28:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:28:27 --> Severity: Notice --> Undefined offset: 8 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:28:27 --> Severity: Notice --> Undefined offset: 9 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:28:27 --> Query error: Table 'crm.tblproposalstaffapproval' doesn't exist - Invalid query: SELECT * FROM `tblproposalstaffapproval` WHERE `lead_id`='99'
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:01 --> Severity: Notice --> Undefined offset: 8 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:30:01 --> Severity: Notice --> Undefined offset: 9 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:30:02 --> Severity: Notice --> Undefined variable: proposalapproval C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:30:02 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:30:02 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:30:02 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:30:02 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:30:02 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:30:02 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:30:02 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:30:02 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:30:02 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:30:02 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:30:02 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:30:02 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:30:02 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:30:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 20
ERROR - 2022-04-27 10:30:02 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 113
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:30:58 --> Severity: Notice --> Undefined offset: 8 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:30:58 --> Severity: Notice --> Undefined offset: 9 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:30:58 --> Query error: Table 'crm.tbltags_in' doesn't exist - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS `tblproposals`.`id` AS `tblproposals.id`, subject, proposal_to, total, total_tax, date, open_till, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblproposals.id and rel_type="proposal" ORDER by tag_order ASC) as tags, datecreated, status ,currency,rel_id,rel_type,invoice_id,hash
    FROM tblproposals
    
    
    WHERE  ( YEAR(date) IN (2019, 2020, 2021, 2022)) AND year_id = 6
    
    ORDER BY open_till DESC
    LIMIT 0, 25
    
ERROR - 2022-04-27 10:30:59 --> Severity: Notice --> Undefined variable: proposalapproval C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:30:59 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:30:59 --> Query error: Table 'crm.tbltags_in' doesn't exist - Invalid query: SELECT *
FROM `tbltags_in`
WHERE `rel_id` = '99'
AND `rel_type` = 'proposal'
ORDER BY `tag_order` ASC
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:31:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:31:05 --> Severity: Notice --> Undefined offset: 8 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:31:05 --> Severity: Notice --> Undefined offset: 9 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:31:05 --> Query error: Table 'crm.tbltags_in' doesn't exist - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS `tblproposals`.`id` AS `tblproposals.id`, subject, proposal_to, total, total_tax, date, open_till, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblproposals.id and rel_type="proposal" ORDER by tag_order ASC) as tags, datecreated, status ,currency,rel_id,rel_type,invoice_id,hash
    FROM tblproposals
    
    
    WHERE  ( YEAR(date) IN (2019, 2020, 2021, 2022)) AND year_id = 6
    
    ORDER BY open_till DESC
    LIMIT 0, 25
    
ERROR - 2022-04-27 10:31:05 --> Severity: Notice --> Undefined variable: proposalapproval C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:31:05 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:31:05 --> Query error: Table 'crm.tbltags_in' doesn't exist - Invalid query: SELECT *
FROM `tbltags_in`
WHERE `rel_id` = '99'
AND `rel_type` = 'proposal'
ORDER BY `tag_order` ASC
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:26 --> Severity: Notice --> Undefined offset: 8 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:36:27 --> Severity: Notice --> Undefined variable: proposalapproval C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:36:27 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:36:27 --> Query error: Table 'crm.tbltags_in' doesn't exist - Invalid query: SELECT *
FROM `tbltags_in`
WHERE `rel_id` = '99'
AND `rel_type` = 'proposal'
ORDER BY `tag_order` ASC
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:36:53 --> Severity: Notice --> Undefined offset: 8 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:36:53 --> Severity: Notice --> Undefined variable: proposalapproval C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:36:53 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:36:53 --> Query error: Table 'crm.tbltags_in' doesn't exist - Invalid query: SELECT *
FROM `tbltags_in`
WHERE `rel_id` = '99'
AND `rel_type` = 'proposal'
ORDER BY `tag_order` ASC
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:40:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:40:33 --> Severity: Notice --> Undefined offset: 8 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:40:33 --> Severity: Notice --> Undefined variable: proposalapproval C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:40:33 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:40:33 --> Query error: Table 'crm.tbltags_in' doesn't exist - Invalid query: SELECT *
FROM `tbltags_in`
WHERE `rel_id` = '99'
AND `rel_type` = 'proposal'
ORDER BY `tag_order` ASC
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:41:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:41:46 --> Severity: Notice --> Undefined offset: 8 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:41:46 --> Severity: Notice --> Undefined variable: proposalapproval C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:41:46 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:41:46 --> Query error: Table 'crm.tbltags_in' doesn't exist - Invalid query: SELECT *
FROM `tbltags_in`
WHERE `rel_id` = '99'
AND `rel_type` = 'proposal'
ORDER BY `tag_order` ASC
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:44:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined offset: 8 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined variable: proposalapproval C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:44:58 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 47
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:44:58 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 351
ERROR - 2022-04-27 10:44:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 20
ERROR - 2022-04-27 10:44:58 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 113
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:45:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:45:35 --> Severity: Notice --> Undefined offset: 8 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 10:45:35 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 10:45:35 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 10:45:35 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 10:45:35 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 10:45:35 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 10:45:35 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 10:45:35 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 10:45:35 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 10:45:35 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 10:45:35 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 10:45:35 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 10:45:35 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 10:45:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 20
ERROR - 2022-04-27 10:45:35 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 113
ERROR - 2022-04-27 10:47:06 --> Query error: Table 'crm.tblitems' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblitems`
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:48:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1073
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1073
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1073
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1073
ERROR - 2022-04-27 10:48:49 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1077
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: product_id C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1122
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: sac_code C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1160
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1073
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1073
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1073
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1073
ERROR - 2022-04-27 10:48:49 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1077
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: product_id C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1122
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: sac_code C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1160
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1073
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1073
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1073
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1073
ERROR - 2022-04-27 10:48:49 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1077
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: product_id C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1122
ERROR - 2022-04-27 10:48:49 --> Severity: Notice --> Undefined index: sac_code C:\xampp\htdocs\crm\application\views\admin\proposals\revice_quotation.php 1160
ERROR - 2022-04-27 10:48:50 --> Severity: Notice --> Undefined variable: items_groups C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 66
ERROR - 2022-04-27 10:48:50 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 10:48:51 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 618
ERROR - 2022-04-27 10:50:32 --> Query error: Table 'crm.tblitems' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblitems`
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:51:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 9
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 9
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 12
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 39
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 111
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined variable: customer_permissions C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 148
ERROR - 2022-04-27 10:51:11 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 148
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined property: stdClass::$client_branch_name C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 366
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1074
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1074
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1074
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1074
ERROR - 2022-04-27 10:51:11 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1076
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: sac_code C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1127
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1074
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1074
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1074
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1074
ERROR - 2022-04-27 10:51:11 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1076
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: sac_code C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1127
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1074
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1074
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1074
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1074
ERROR - 2022-04-27 10:51:11 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1076
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined index: sac_code C:\xampp\htdocs\crm\application\views\admin\proposals\perfoma_invoice.php 1127
ERROR - 2022-04-27 10:51:11 --> Severity: Notice --> Undefined variable: items_groups C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 66
ERROR - 2022-04-27 10:51:11 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 10:51:12 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 618
ERROR - 2022-04-27 10:51:12 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 618
ERROR - 2022-04-27 10:52:59 --> Query error: Table 'crm.tblitems' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblitems`
ERROR - 2022-04-27 10:53:27 --> Severity: Notice --> Undefined index: rel_id C:\xampp\htdocs\crm\application\controllers\admin\Estimates.php 562
ERROR - 2022-04-27 10:53:27 --> Severity: Notice --> Undefined index: rel_id C:\xampp\htdocs\crm\application\controllers\admin\Estimates.php 564
ERROR - 2022-04-27 10:53:27 --> Severity: Notice --> Undefined index: rel_id C:\xampp\htdocs\crm\application\controllers\admin\Estimates.php 565
ERROR - 2022-04-27 10:53:27 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\controllers\admin\Estimates.php 567
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:53:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 23
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 77
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 221
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined variable: customer_permissions C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined property: stdClass::$rel_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 687
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 689
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined variable: tax_value C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1798
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1933
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1933
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1933
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1933
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1937
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: sac_code C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 2022
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1933
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1933
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1933
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1933
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1937
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: sac_code C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 2022
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1933
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1933
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1933
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1933
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1937
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: sac_code C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 2022
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined variable: items_groups C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 66
ERROR - 2022-04-27 10:53:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5660
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5662
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5772
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5782
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6148
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6148
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6148
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6238
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6238
ERROR - 2022-04-27 10:53:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6238
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:55:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:55:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 20
ERROR - 2022-04-27 10:55:59 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 113
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:56:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:04 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 20
ERROR - 2022-04-27 10:56:04 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 113
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:56:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 20
ERROR - 2022-04-27 10:56:14 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 113
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 10:56:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$rel_id C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 48
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 49
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$show_shipping_on_invoice C:\xampp\htdocs\crm\application\views\admin\invoices\billing_and_shipping_template.php 34
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$payment_due_date C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 293
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$recurring C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 306
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$po_wo_number C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 326
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$cancel_overdue_reminders C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 339
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$vendor_code C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 464
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$transportation_charges C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 524
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$transportation_charges C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 531
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$transportation_charges C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 534
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined variable: productcomponent C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 636
ERROR - 2022-04-27 10:56:21 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 636
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined variable: label C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 761
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 789
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 789
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 789
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 789
ERROR - 2022-04-27 10:56:21 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 791
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 789
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 789
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 789
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 789
ERROR - 2022-04-27 10:56:21 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 791
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 789
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 789
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 789
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 789
ERROR - 2022-04-27 10:56:21 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 791
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2630
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2631
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2685
ERROR - 2022-04-27 10:56:21 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2689
ERROR - 2022-04-27 10:56:22 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 618
ERROR - 2022-04-27 10:58:49 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 45
ERROR - 2022-04-27 10:58:49 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 52
ERROR - 2022-04-27 10:58:49 --> Severity: Notice --> Undefined property: stdClass::$items C:\xampp\htdocs\crm\application\models\Invoices_model.php 68
ERROR - 2022-04-27 10:58:49 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\helpers\sales_helper.php 906
ERROR - 2022-04-27 10:58:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\sales_helper.php 1219
ERROR - 2022-04-27 10:58:49 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 74
ERROR - 2022-04-27 10:58:49 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 82
ERROR - 2022-04-27 10:58:49 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 82
ERROR - 2022-04-27 10:58:49 --> Query error: Table 'crm.tblitems' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblitems`
ERROR - 2022-04-27 10:58:49 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\crm\system\core\Exceptions.php:271) C:\xampp\htdocs\crm\system\core\Common.php 570
ERROR - 2022-04-27 11:01:03 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 45
ERROR - 2022-04-27 11:01:03 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 52
ERROR - 2022-04-27 11:01:03 --> Severity: Notice --> Undefined property: stdClass::$items C:\xampp\htdocs\crm\application\models\Invoices_model.php 68
ERROR - 2022-04-27 11:01:03 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\helpers\sales_helper.php 906
ERROR - 2022-04-27 11:01:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\sales_helper.php 1219
ERROR - 2022-04-27 11:01:03 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 74
ERROR - 2022-04-27 11:01:03 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 82
ERROR - 2022-04-27 11:01:03 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 82
ERROR - 2022-04-27 11:01:13 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 45
ERROR - 2022-04-27 11:01:13 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 52
ERROR - 2022-04-27 11:01:13 --> Severity: Notice --> Undefined property: stdClass::$items C:\xampp\htdocs\crm\application\models\Invoices_model.php 68
ERROR - 2022-04-27 11:01:13 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\helpers\sales_helper.php 906
ERROR - 2022-04-27 11:01:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\sales_helper.php 1219
ERROR - 2022-04-27 11:01:13 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 74
ERROR - 2022-04-27 11:01:13 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 82
ERROR - 2022-04-27 11:01:13 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 82
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 45
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 52
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined property: stdClass::$items C:\xampp\htdocs\crm\application\models\Invoices_model.php 68
ERROR - 2022-04-27 11:02:02 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\helpers\sales_helper.php 906
ERROR - 2022-04-27 11:02:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\sales_helper.php 1219
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 74
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 82
ERROR - 2022-04-27 11:02:02 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 82
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:02:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined property: stdClass::$rel_id C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 109
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 111
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined variable: label C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1464
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:02:02 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1524
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:02:02 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1524
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:02:02 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1524
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined variable: items_groups C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 66
ERROR - 2022-04-27 11:02:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 5013
ERROR - 2022-04-27 11:02:02 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 5015
ERROR - 2022-04-27 11:02:03 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 5123
ERROR - 2022-04-27 11:02:03 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 5131
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 45
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 52
ERROR - 2022-04-27 11:03:18 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\helpers\sales_helper.php 906
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Uninitialized string offset: 0 C:\xampp\htdocs\crm\application\helpers\sales_helper.php 906
ERROR - 2022-04-27 11:03:18 --> Severity: Warning --> Illegal string offset 'rel_id' C:\xampp\htdocs\crm\application\helpers\sales_helper.php 906
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Uninitialized string offset: 0 C:\xampp\htdocs\crm\application\helpers\sales_helper.php 906
ERROR - 2022-04-27 11:03:18 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\sales_helper.php 1219
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 75
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:03:18 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:03:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined property: stdClass::$rel_id C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 109
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 111
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined variable: label C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1464
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:18 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1524
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:18 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1524
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:18 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1524
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined variable: items_groups C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 66
ERROR - 2022-04-27 11:03:18 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 5013
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 5015
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 5123
ERROR - 2022-04-27 11:03:18 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 5131
ERROR - 2022-04-27 11:03:35 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 45
ERROR - 2022-04-27 11:03:35 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 52
ERROR - 2022-04-27 11:03:35 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 75
ERROR - 2022-04-27 11:03:35 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:03:35 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:03:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined property: stdClass::$rel_id C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 109
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 111
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined variable: label C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1464
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:36 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1524
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:36 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1524
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1520
ERROR - 2022-04-27 11:03:36 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 1524
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined variable: items_groups C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 66
ERROR - 2022-04-27 11:03:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 5013
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 5015
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 5123
ERROR - 2022-04-27 11:03:36 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\invoices.php 5131
ERROR - 2022-04-27 11:05:12 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 45
ERROR - 2022-04-27 11:05:12 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 52
ERROR - 2022-04-27 11:05:12 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 75
ERROR - 2022-04-27 11:05:12 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:05:12 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:05:12 --> Query error: Table 'crm.tblitems' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblitems`
ERROR - 2022-04-27 11:05:31 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 45
ERROR - 2022-04-27 11:05:31 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 52
ERROR - 2022-04-27 11:05:31 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 75
ERROR - 2022-04-27 11:05:31 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:05:31 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:05:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined property: stdClass::$rel_id C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 54
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 55
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined variable: label C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 872
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 900
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 900
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 900
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 900
ERROR - 2022-04-27 11:05:32 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 902
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 900
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 900
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 900
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 900
ERROR - 2022-04-27 11:05:32 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 902
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined index: rental_price_cat_a C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 900
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined index: rental_price_cat_b C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 900
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined index: rental_price_cat_c C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 900
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined index: rental_price_cat_d C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 900
ERROR - 2022-04-27 11:05:32 --> Severity: Warning --> Division by zero C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 902
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined variable: items_groups C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 66
ERROR - 2022-04-27 11:05:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 2688
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 2689
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 2743
ERROR - 2022-04-27 11:05:32 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\invoices\renew_invoice.php 2747
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:08:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:25 --> Query error: Table 'crm.tblcreditnotes' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblcreditnotes`
WHERE `clientid` = '91'
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:08:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:08:34 --> Query error: Table 'crm.tblcreditnotes' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblcreditnotes`
WHERE `clientid` = '1'
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:11:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:11:43 --> Severity: Notice --> Undefined variable: countries C:\xampp\htdocs\crm\application\views\admin\clients\groups\profile.php 359
ERROR - 2022-04-27 11:11:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 11:11:43 --> Severity: Notice --> Undefined variable: countries C:\xampp\htdocs\crm\application\views\admin\clients\groups\profile.php 376
ERROR - 2022-04-27 11:11:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:12:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:49 --> Severity: Notice --> Undefined variable: countries C:\xampp\htdocs\crm\application\views\admin\clients\groups\profile.php 359
ERROR - 2022-04-27 11:12:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 11:12:49 --> Severity: Notice --> Undefined variable: countries C:\xampp\htdocs\crm\application\views\admin\clients\groups\profile.php 376
ERROR - 2022-04-27 11:12:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 11:12:55 --> Could not find the language line "ClientBranch"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:12:56 --> Severity: Notice --> Undefined variable: countries C:\xampp\htdocs\crm\application\views\admin\clients\groups\profile.php 359
ERROR - 2022-04-27 11:12:56 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 11:12:56 --> Severity: Notice --> Undefined variable: countries C:\xampp\htdocs\crm\application\views\admin\clients\groups\profile.php 376
ERROR - 2022-04-27 11:12:56 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 11:13:08 --> Query error: Table 'crm.tblservices' doesn't exist - Invalid query: SELECT *
FROM `tblservices`
ORDER BY `serviceid` ASC
ERROR - 2022-04-27 11:13:33 --> Query error: Table 'crm.tblservices' doesn't exist - Invalid query: SELECT *
FROM `tblservices`
ORDER BY `serviceid` ASC
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:14:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:14:26 --> Query error: Table 'crm.tblservices' doesn't exist - Invalid query: SELECT *
FROM `tblservices`
ORDER BY `serviceid` ASC
ERROR - 2022-04-27 11:16:05 --> Query error: Table 'crm.tblservices' doesn't exist - Invalid query: SELECT *
FROM `tblservices`
ORDER BY `serviceid` ASC
ERROR - 2022-04-27 11:16:17 --> Query error: Table 'crm.tblservices' doesn't exist - Invalid query: SELECT *
FROM `tblservices`
ORDER BY `serviceid` ASC
ERROR - 2022-04-27 11:19:03 --> Query error: Table 'crm.tblservices' doesn't exist - Invalid query: SELECT *
FROM `tblservices`
ORDER BY `serviceid` ASC
ERROR - 2022-04-27 11:20:21 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 75
ERROR - 2022-04-27 11:20:21 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:20:21 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:20:21 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 75
ERROR - 2022-04-27 11:20:21 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:20:21 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:20:21 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 309
ERROR - 2022-04-27 11:20:21 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 483
ERROR - 2022-04-27 11:20:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 483
ERROR - 2022-04-27 11:20:21 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 497
ERROR - 2022-04-27 11:20:21 --> Severity: Notice --> Undefined variable: prototal C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 513
ERROR - 2022-04-27 11:20:21 --> Query error: Table 'crm.tblcredits' doesn't exist - Invalid query: SELECT SUM(`amount`) AS `amount`
FROM `tblcredits`
WHERE `invoice_id` = '91'
ERROR - 2022-04-27 11:20:21 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\crm\system\core\Exceptions.php:271) C:\xampp\htdocs\crm\system\core\Common.php 570
ERROR - 2022-04-27 11:20:38 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 75
ERROR - 2022-04-27 11:20:38 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:20:38 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:20:38 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 75
ERROR - 2022-04-27 11:20:38 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:20:38 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:20:38 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 309
ERROR - 2022-04-27 11:20:38 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 483
ERROR - 2022-04-27 11:20:38 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 483
ERROR - 2022-04-27 11:20:38 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 497
ERROR - 2022-04-27 11:20:38 --> Severity: Notice --> Undefined variable: prototal C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 513
ERROR - 2022-04-27 11:20:38 --> Query error: Table 'crm.tblcredits' doesn't exist - Invalid query: SELECT SUM(`amount`) AS `amount`
FROM `tblcredits`
WHERE `invoice_id` = '91'
ERROR - 2022-04-27 11:20:38 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\crm\system\core\Exceptions.php:271) C:\xampp\htdocs\crm\system\core\Common.php 570
ERROR - 2022-04-27 11:22:32 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 75
ERROR - 2022-04-27 11:22:32 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:22:32 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:22:32 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 75
ERROR - 2022-04-27 11:22:32 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:22:32 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 11:22:32 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 309
ERROR - 2022-04-27 11:22:32 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 483
ERROR - 2022-04-27 11:22:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 483
ERROR - 2022-04-27 11:22:32 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 497
ERROR - 2022-04-27 11:22:32 --> Severity: Notice --> Undefined variable: prototal C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 513
ERROR - 2022-04-27 11:22:32 --> Query error: Table 'crm.tblcredits' doesn't exist - Invalid query: SELECT SUM(`amount`) AS `amount`
FROM `tblcredits`
WHERE `invoice_id` = '91'
ERROR - 2022-04-27 11:22:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\crm\system\core\Exceptions.php:271) C:\xampp\htdocs\crm\system\core\Common.php 570
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:32:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:49:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:49:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:50:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:50:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 11:50:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 11:50:52 --> Severity: Notice --> Undefined variable: lead_data C:\xampp\htdocs\crm\application\views\admin\leads\new_list.php 333
ERROR - 2022-04-27 11:50:52 --> Severity: Notice --> Undefined variable: lead_data C:\xampp\htdocs\crm\application\views\admin\leads\new_list.php 336
ERROR - 2022-04-27 11:50:52 --> Severity: Notice --> Undefined variable: lead_data C:\xampp\htdocs\crm\application\views\admin\leads\new_list.php 339
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:06:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:06:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:24 --> Severity: Notice --> Undefined offset: 8 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-04-27 12:06:24 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 12:06:24 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 12:06:24 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 12:06:24 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 12:06:24 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 12:06:24 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 12:06:24 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 12:06:24 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 12:06:24 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 12:06:24 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 12:06:24 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 12:06:24 --> Severity: Notice --> Undefined index: lastname C:\xampp\htdocs\crm\application\views\admin\proposals\proposals_preview_template.php 352
ERROR - 2022-04-27 12:06:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 20
ERROR - 2022-04-27 12:06:24 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 113
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:06:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:06:29 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-04-27 12:06:30 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-03-27' AND '2022-05-08') ELSE (duedate BETWEEN '2022-03-27' AND '2022-05-08') END
ERROR - 2022-04-27 12:10:17 --> Query error: Table 'crm.tblitems' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblitems`
ERROR - 2022-04-27 12:11:03 --> Severity: Notice --> Undefined index: rel_id C:\xampp\htdocs\crm\application\controllers\admin\Chalan.php 693
ERROR - 2022-04-27 12:11:03 --> Severity: Notice --> Undefined index: rel_id C:\xampp\htdocs\crm\application\controllers\admin\Chalan.php 695
ERROR - 2022-04-27 12:11:03 --> Severity: Notice --> Undefined index: rel_id C:\xampp\htdocs\crm\application\controllers\admin\Chalan.php 696
ERROR - 2022-04-27 12:11:03 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\controllers\admin\Chalan.php 698
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:11:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:12:15 --> Severity: Notice --> Undefined index: assignid C:\xampp\htdocs\crm\application\models\Estimates_model.php 33
ERROR - 2022-04-27 12:12:15 --> Query error: Unknown column 'challandate' in 'field list' - Invalid query: INSERT INTO `tblcreatedchalanmst` (`clientid`, `site_id`, `billing_street`, `billing_city`, `billing_state`, `billing_zip`, `shipping_street`, `shipping_city`, `shipping_state`, `shipping_zip`, `shipping_country`, `work_no`, `workdate`, `status`, `challandate`, `chalanno`, `office_person`, `office_person_number`, `site_person`, `site_person_number`, `adminnote`, `rel_type`, `rel_id`, `pro_id`, `warehouse_id`, `service_type`, `product_json`, `note`, `terms_and_conditions`, `currency`, `group_id`, `datecreated`, `addedfrom`, `billing_branch_id`, `approve_status`) VALUES ('91', '98', '106, GROUND FLOOR, \"B\" WING,EXPRESS ZONE MALL, , W.E. HIGHWAY,, MALAD (E)', 'Mumbai', 'Maharashtra', ' 400 097 ', ' C/O. Bridgestone India Pvt.Ltd H.P. Chowk Chakan Talegaon RoadNear Hyundai Company, Chakan, Pune ', 'Pune', 'Maharashtra', '411041', '', '', '2022-04-27', '6', '2022-04-27', '0008/CH-RT/21-22', 'Himanshu', '7021108505', 'kapil p', '999775585', 'test', 'estimate', '149', '21,121,120', '1', '1', '[{\"product_id\":\"21\",\"product_qty\":\"1.00\"},{\"product_id\":\"121\",\"product_qty\":\"1.00\"},{\"product_id\":\"120\",\"product_qty\":\"1.00\"}]', '', '01). Payment Term: 100% advance.<br>02). Other Charges other than mentioned if incurred shall be charged extra at actual.<br>03). Loading & Unloading of Equipment/Material at Client\'s site will not be in SCHACH\'S scope.', 3, '1', '2022-04-27 12:12:15', '1', '1', 0)
ERROR - 2022-04-27 12:12:24 --> Severity: Notice --> Undefined index: rel_id C:\xampp\htdocs\crm\application\controllers\admin\Chalan.php 693
ERROR - 2022-04-27 12:12:24 --> Severity: Notice --> Undefined index: rel_id C:\xampp\htdocs\crm\application\controllers\admin\Chalan.php 695
ERROR - 2022-04-27 12:12:24 --> Severity: Notice --> Undefined index: rel_id C:\xampp\htdocs\crm\application\controllers\admin\Chalan.php 696
ERROR - 2022-04-27 12:12:24 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\controllers\admin\Chalan.php 698
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:14:28 --> Query error: Table 'crm.tblprojectmembers' doesn't exist - Invalid query: SELECT COUNT(*) as total FROM tblprojects WHERE status=1 AND id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7) UNION ALL SELECT COUNT(*) as total FROM tblprojects WHERE status=2 AND id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7) UNION ALL SELECT COUNT(*) as total FROM tblprojects WHERE status=3 AND id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7) UNION ALL SELECT COUNT(*) as total FROM tblprojects WHERE status=5 AND id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7) UNION ALL SELECT COUNT(*) as total FROM tblprojects WHERE status=4 AND id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7)
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:02 --> Severity: Notice --> Undefined variable: implodequery C:\xampp\htdocs\crm\application\views\admin\chalan\edit_challan.php 371
ERROR - 2022-04-27 12:15:02 --> Severity: Notice --> Undefined variable: service_type C:\xampp\htdocs\crm\application\views\admin\chalan\edit_challan.php 372
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:09 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:15:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:16:05 --> Query error: Table 'crm.tblprojectmembers' doesn't exist - Invalid query: SELECT COUNT(*) as total FROM tblprojects WHERE status=1 AND id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7) UNION ALL SELECT COUNT(*) as total FROM tblprojects WHERE status=2 AND id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7) UNION ALL SELECT COUNT(*) as total FROM tblprojects WHERE status=3 AND id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7) UNION ALL SELECT COUNT(*) as total FROM tblprojects WHERE status=5 AND id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7) UNION ALL SELECT COUNT(*) as total FROM tblprojects WHERE status=4 AND id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7)
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:23:21 --> Query error: Table 'crm.tblprojectmembers' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblprojects`
WHERE `id` IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7)
ERROR - 2022-04-27 12:24:03 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:03 --> Severity: Notice --> Trying to get property 'total' of non-object C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:03 --> Severity: Notice --> Undefined offset: 1 C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:03 --> Severity: Notice --> Trying to get property 'total' of non-object C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:03 --> Severity: Notice --> Undefined offset: 2 C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:03 --> Severity: Notice --> Trying to get property 'total' of non-object C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:03 --> Severity: Notice --> Undefined offset: 3 C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:03 --> Severity: Notice --> Trying to get property 'total' of non-object C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:03 --> Severity: Notice --> Undefined offset: 4 C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:03 --> Severity: Notice --> Trying to get property 'total' of non-object C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:24:04 --> Query error: Table 'crm.tblprojectmembers' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblprojects`
WHERE `id` IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7)
ERROR - 2022-04-27 12:24:04 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\crm\system\core\Exceptions.php:271) C:\xampp\htdocs\crm\system\core\Common.php 570
ERROR - 2022-04-27 12:24:40 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:40 --> Severity: Notice --> Trying to get property 'total' of non-object C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:40 --> Severity: Notice --> Undefined offset: 1 C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:40 --> Severity: Notice --> Trying to get property 'total' of non-object C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:40 --> Severity: Notice --> Undefined offset: 2 C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:40 --> Severity: Notice --> Trying to get property 'total' of non-object C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:40 --> Severity: Notice --> Undefined offset: 3 C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:40 --> Severity: Notice --> Trying to get property 'total' of non-object C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:40 --> Severity: Notice --> Undefined offset: 4 C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:40 --> Severity: Notice --> Trying to get property 'total' of non-object C:\xampp\htdocs\crm\application\models\Dashboard_model.php 180
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:24:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:24:41 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:25:02 --> Query error: Table 'crm.tblprojectmembers' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblprojects`
WHERE `id` IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7)
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:25:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:10 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-04-27 12:25:32 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-03-27' AND '2022-05-08') ELSE (duedate BETWEEN '2022-03-27' AND '2022-05-08') END
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:25:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:25:39 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-04-27 12:25:40 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-03-27' AND '2022-05-08') ELSE (duedate BETWEEN '2022-03-27' AND '2022-05-08') END
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:26:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:36 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-04-27 12:26:37 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-03-27' AND '2022-05-08') ELSE (duedate BETWEEN '2022-03-27' AND '2022-05-08') END
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:45 --> Query error: Table 'crm.tblprojectmembers' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblprojects`
WHERE `id` IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7)
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:47 --> Query error: Table 'crm.tblprojectmembers' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblprojects`
WHERE `id` IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7)
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:26:48 --> Query error: Table 'crm.tblprojectmembers' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblprojects`
WHERE `id` IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7)
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:27:10 --> Query error: Table 'crm.tblprojectmembers' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblprojects`
WHERE `id` IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=7)
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:28:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:01 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-04-27 12:28:02 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-03-27' AND '2022-05-08') ELSE (duedate BETWEEN '2022-03-27' AND '2022-05-08') END
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:28:17 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-04-27 12:28:18 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-03-27' AND '2022-05-08') ELSE (duedate BETWEEN '2022-03-27' AND '2022-05-08') END
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:32:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:33:00 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-04-27 12:33:00 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-03-27' AND '2022-05-08') ELSE (duedate BETWEEN '2022-03-27' AND '2022-05-08') END
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 12:47:42 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:55:37 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:55:38 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:55:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:55:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:55:40 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 5
ERROR - 2022-04-27 12:55:40 --> Severity: Notice --> Undefined variable: productcomponent C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 947
ERROR - 2022-04-27 12:55:40 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 947
ERROR - 2022-04-27 12:55:40 --> Severity: Notice --> Undefined variable: debitnote_othercharges C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 1613
ERROR - 2022-04-27 12:55:40 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 1613
ERROR - 2022-04-27 12:55:40 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-04-27 12:55:40 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-04-27 12:55:40 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-04-27 12:55:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-04-27 12:55:40 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-04-27 12:55:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-04-27 12:55:40 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-04-27 12:55:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-04-27 12:55:40 --> Severity: Notice --> Undefined variable: items_groups C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 66
ERROR - 2022-04-27 12:55:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 12:55:40 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 3639
ERROR - 2022-04-27 12:55:40 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 3653
ERROR - 2022-04-27 12:55:41 --> Severity: Notice --> Undefined index: state_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 180
ERROR - 2022-04-27 12:55:41 --> Severity: Notice --> Undefined index: city_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 181
ERROR - 2022-04-27 12:55:41 --> Severity: Notice --> Undefined index: name C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:55:41 --> Severity: Notice --> Undefined index: location C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:55:41 --> Severity: Notice --> Undefined index: address C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:55:41 --> Severity: Notice --> Undefined index: description C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:55:41 --> Severity: Notice --> Undefined index: state_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:55:41 --> Severity: Notice --> Undefined index: city_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:55:41 --> Severity: Notice --> Undefined index: landmark C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:55:41 --> Severity: Notice --> Undefined index: pincode C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 12:56:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 12:56:24 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 5
ERROR - 2022-04-27 12:56:24 --> Severity: Notice --> Undefined variable: productcomponent C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 947
ERROR - 2022-04-27 12:56:24 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 947
ERROR - 2022-04-27 12:56:24 --> Severity: Notice --> Undefined variable: debitnote_othercharges C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 1613
ERROR - 2022-04-27 12:56:24 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 1613
ERROR - 2022-04-27 12:56:24 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-04-27 12:56:24 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-04-27 12:56:24 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-04-27 12:56:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-04-27 12:56:24 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-04-27 12:56:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-04-27 12:56:24 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-04-27 12:56:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-04-27 12:56:24 --> Severity: Notice --> Undefined variable: items_groups C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 66
ERROR - 2022-04-27 12:56:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 12:56:24 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 3639
ERROR - 2022-04-27 12:56:24 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 3653
ERROR - 2022-04-27 12:56:25 --> Severity: Notice --> Undefined index: state_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 180
ERROR - 2022-04-27 12:56:25 --> Severity: Notice --> Undefined index: city_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 181
ERROR - 2022-04-27 12:56:25 --> Severity: Notice --> Undefined index: name C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:56:25 --> Severity: Notice --> Undefined index: location C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:56:25 --> Severity: Notice --> Undefined index: address C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:56:25 --> Severity: Notice --> Undefined index: description C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:56:25 --> Severity: Notice --> Undefined index: state_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:56:25 --> Severity: Notice --> Undefined index: city_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:56:25 --> Severity: Notice --> Undefined index: landmark C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 12:56:25 --> Severity: Notice --> Undefined index: pincode C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-04-27 13:03:09 --> Query error: Table 'crm.tblitems' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tblitems`
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 13:04:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 13:04:52 --> Severity: Notice --> Undefined variable: mm C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 500
ERROR - 2022-04-27 13:04:52 --> Severity: Notice --> Undefined variable: yyyy C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 504
ERROR - 2022-04-27 13:04:52 --> Severity: Notice --> Undefined variable: purchase_othercharges C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1209
ERROR - 2022-04-27 13:04:52 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1209
ERROR - 2022-04-27 13:04:52 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-04-27 13:04:52 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-04-27 13:04:52 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-04-27 13:04:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-04-27 13:04:52 --> Severity: Notice --> Undefined variable: items_groups C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 66
ERROR - 2022-04-27 13:04:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 13:04:52 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 2494
ERROR - 2022-04-27 13:04:52 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 2508
ERROR - 2022-04-27 13:04:52 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 2703
ERROR - 2022-04-27 13:04:52 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 2717
ERROR - 2022-04-27 13:04:53 --> Severity: Notice --> Undefined variable: for C:\xampp\htdocs\crm\application\controllers\admin\Terms_conditions.php 86
ERROR - 2022-04-27 13:04:53 --> Severity: Notice --> Undefined variable: type C:\xampp\htdocs\crm\application\controllers\admin\Terms_conditions.php 86
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:48:00 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-04-27 15:48:00 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-03-27' AND '2022-05-08') ELSE (duedate BETWEEN '2022-03-27' AND '2022-05-08') END
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:48:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:48:09 --> Query error: Table 'crm.tbltaskstimers' doesn't exist - Invalid query: SELECT `task_id`, `start_time`, `end_time`, `staff_id`, `tbltaskstimers`.`hourly_rate`, `name`, `tbltaskstimers`.`id`, `rel_id`, `rel_type`
FROM `tbltaskstimers`
LEFT JOIN `tblstafftasks` ON `tblstafftasks`.`id` = `tbltaskstimers`.`task_id`
WHERE `staff_id` = '7'
ERROR - 2022-04-27 15:50:30 --> Query error: Table 'crm.tbltaskstimers' doesn't exist - Invalid query: SELECT `task_id`, `start_time`, `end_time`, `staff_id`, `tbltaskstimers`.`hourly_rate`, `name`, `tbltaskstimers`.`id`, `rel_id`, `rel_type`
FROM `tbltaskstimers`
LEFT JOIN `tblstafftasks` ON `tblstafftasks`.`id` = `tbltaskstimers`.`task_id`
WHERE `staff_id` = '7'
ERROR - 2022-04-27 15:52:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\models\Staff_model.php 1034
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:52:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:52:30 --> Query error: Table 'crm.tbldepartments' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tbldepartments`
WHERE `email` = 'abhay@schachengineers.com'
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:53:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:22 --> Query error: Table 'crm.tbldepartments' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tbldepartments`
WHERE `email` = 'abhay@schachengineers.com'
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:53:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:53:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:53:54 --> Query error: Table 'crm.tbldepartments' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tbldepartments`
WHERE `email` = 'abhishek@schachengineers.com'
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:57:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:57:53 --> Query error: Table 'crm.tbldepartments' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tbldepartments`
WHERE `email` = 'abhishek@schachengineers.com'
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:58:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:59:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-04-27 15:59:26 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Stock For Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Stock For Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-04-27 15:59:28 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:29 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-04-27 15:59:29 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-04-27 15:59:29 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-04-27 15:59:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-04-27 15:59:29 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-04-27 15:59:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-04-27 15:59:29 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-04-27 15:59:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-04-27 15:59:29 --> Severity: Notice --> Undefined variable: items_groups C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 66
ERROR - 2022-04-27 15:59:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-04-27 15:59:43 --> Severity: Notice --> Undefined index: info C:\xampp\htdocs\crm\application\controllers\admin\Staff.php 1260
ERROR - 2022-04-27 15:59:43 --> Severity: Notice --> Trying to get property 'staffid' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Staff.php 1260
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Stock For Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Stock For Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-04-27 15:59:43 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 15:59:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 16:06:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 16:06:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:56 --> Severity: Notice --> Undefined index: assign C:\xampp\htdocs\crm\application\controllers\admin\Bank_payments.php 71
ERROR - 2022-04-27 16:06:56 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\controllers\admin\Bank_payments.php 72
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 16:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 16:06:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 16:07:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 17:40:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 18:14:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 18:14:55 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 75
ERROR - 2022-04-27 18:14:55 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 18:14:55 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 18:14:55 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 75
ERROR - 2022-04-27 18:14:55 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 18:14:55 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 18:14:55 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 309
ERROR - 2022-04-27 18:14:55 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 483
ERROR - 2022-04-27 18:14:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 483
ERROR - 2022-04-27 18:14:55 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 497
ERROR - 2022-04-27 18:14:55 --> Severity: Notice --> Undefined variable: prototal C:\xampp\htdocs\crm\application\views\themes\perfex\views\invoicehtml.php 513
ERROR - 2022-04-27 18:14:55 --> Query error: Table 'crm.tblcredits' doesn't exist - Invalid query: SELECT SUM(`amount`) AS `amount`
FROM `tblcredits`
WHERE `invoice_id` = '63'
ERROR - 2022-04-27 18:14:55 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\crm\system\core\Exceptions.php:271) C:\xampp\htdocs\crm\system\core\Common.php 570
ERROR - 2022-04-27 20:31:54 --> Query error: Table 'crm.tblproposalcomments' doesn't exist - Invalid query: SELECT *
FROM `tblproposalcomments`
WHERE `proposalid` = '100'
ORDER BY `dateadded` ASC
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 20:32:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 20:36:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:39 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 45
ERROR - 2022-04-27 20:36:39 --> Severity: Notice --> Undefined index: type C:\xampp\htdocs\crm\application\models\Invoices_model.php 52
ERROR - 2022-04-27 20:36:39 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\crm\application\models\Invoices_model.php 75
ERROR - 2022-04-27 20:36:39 --> Severity: Notice --> Undefined variable: total_othercharge C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 20:36:39 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 83
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 20:36:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 20:36:49 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-04-27 20:36:50 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-03-27' AND '2022-05-08') ELSE (duedate BETWEEN '2022-03-27' AND '2022-05-08') END
ERROR - 2022-04-27 21:43:34 --> Query error: Unknown column 'add' in 'where clause' - Invalid query: SELECT * FROM `tblmenuassigned` where `staff_id`='1' and menu_id IN (318) and `add` = '1' 
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:44:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:44:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:44:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:45:08 --> Query error: Unknown column 'add' in 'where clause' - Invalid query: SELECT * FROM `tblmenuassigned` where `staff_id`='1' and menu_id IN (318) and `add` = '1' 
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:45:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:46:16 --> Query error: Unknown column 'add' in 'where clause' - Invalid query: SELECT * FROM `tblmenuassigned` where `staff_id`='1' and menu_id IN (318) and `add` = '1' 
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:47:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:49:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Trip assigned"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-04-27 21:51:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-04-27 21:51:36 --> Severity: Notice --> Undefined variable: lead_data C:\xampp\htdocs\crm\application\views\admin\leads\new_list.php 333
ERROR - 2022-04-27 21:51:36 --> Severity: Notice --> Undefined variable: lead_data C:\xampp\htdocs\crm\application\views\admin\leads\new_list.php 336
ERROR - 2022-04-27 21:51:36 --> Severity: Notice --> Undefined variable: lead_data C:\xampp\htdocs\crm\application\views\admin\leads\new_list.php 339
