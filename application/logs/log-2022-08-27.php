<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:26:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 09:26:57 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-27 09:26:59 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:27:02 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:30:43 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 09:31:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:13 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:04:14 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-27 18:04:16 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:22 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:04:31 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:04:32 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:06:17 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:06:18 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:14 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:15 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:07:47 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:07:47 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:08:37 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:08:38 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:12 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:12 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 315
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:35 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:36 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:09:57 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:09:58 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:30 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:11:39 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:11:40 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:16 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:25 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:48 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:49 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:12:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:12:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:19 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:19 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:25 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:26 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:15:43 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:19:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:36 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:40 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 18:22:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:04 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 19:03:04 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:04 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:04 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:04 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:04 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:04 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:04 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:04 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:04 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:04 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:04 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:05 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:03:25 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:07:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:07:44 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-27 19:18:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
ERROR - 2022-08-27 19:18:27 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 316
