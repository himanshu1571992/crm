<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 08:41:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:41 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-04 08:41:42 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 08:41:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:41:56 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 08:42:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 08:42:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:42:11 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 08:43:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 08:43:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 08:43:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 08:55:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 08:55:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 08:55:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 08:57:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:39 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-04 08:57:39 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-04 08:57:39 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-04 08:57:39 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-04 08:57:39 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-04 08:57:39 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-04 08:57:39 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-04 08:57:40 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-04 08:57:40 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-04 08:57:40 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 08:57:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 08:59:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 09:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 09:01:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:01:31 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 296
ERROR - 2022-08-04 09:01:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 296
ERROR - 2022-08-04 09:01:31 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 310
ERROR - 2022-08-04 09:01:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-04 09:01:31 --> Severity: Notice --> Trying to get property 'file' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 447
ERROR - 2022-08-04 09:01:31 --> Severity: Notice --> Trying to get property 'file' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 447
ERROR - 2022-08-04 09:01:31 --> Severity: Notice --> Trying to get property 'file' of non-object C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 449
ERROR - 2022-08-04 09:01:31 --> Severity: Notice --> Undefined variable: j C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 449
ERROR - 2022-08-04 09:01:31 --> Severity: Notice --> Undefined variable: j C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 449
ERROR - 2022-08-04 09:01:31 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-04 09:01:31 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-04 09:01:31 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-04 09:01:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-04 09:01:31 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-04 09:01:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-04 09:01:31 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-04 09:01:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-04 09:01:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 09:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 09:03:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 09:03:17 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 296
ERROR - 2022-08-04 09:03:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 296
ERROR - 2022-08-04 09:03:17 --> Severity: Notice --> Undefined variable: staff C:\xampp\htdocs\crm\application\views\admin\purchase\material_receipt.php 310
ERROR - 2022-08-04 09:03:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-04 09:03:17 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-04 09:03:17 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-04 09:03:17 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-04 09:03:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-04 09:03:17 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-04 09:03:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-04 09:03:17 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-04 09:03:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-04 09:03:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 17:27:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source_id C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 17:27:34 --> Severity: Notice --> Undefined property: stdClass::$source C:\xampp\htdocs\crm\application\views\admin\enquirycall\list.php 271
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 19:26:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 19:26:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:26:25 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 5
ERROR - 2022-08-04 19:26:25 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-04 19:26:25 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-04 19:26:25 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-04 19:26:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-04 19:26:25 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-04 19:26:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-04 19:26:25 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-04 19:26:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-04 19:26:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-04 19:26:25 --> Severity: Notice --> Undefined variable: rel_id C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 639
ERROR - 2022-08-04 19:26:25 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 1655
ERROR - 2022-08-04 19:26:25 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 1669
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 19:27:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 19:28:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:12 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 5
ERROR - 2022-08-04 19:28:12 --> Severity: Warning --> A non-numeric value encountered C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 304
ERROR - 2022-08-04 19:28:12 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-04 19:28:12 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-04 19:28:12 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-04 19:28:12 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-04 19:28:12 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-04 19:28:12 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-04 19:28:12 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-04 19:28:12 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-04 19:28:12 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-04 19:28:12 --> Severity: Notice --> Undefined variable: rel_id C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 639
ERROR - 2022-08-04 19:28:12 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 1655
ERROR - 2022-08-04 19:28:12 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 1669
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 19:28:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 19:28:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 19:28:55 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 5
ERROR - 2022-08-04 19:28:55 --> Severity: Warning --> A non-numeric value encountered C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 304
ERROR - 2022-08-04 19:28:55 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-04 19:28:55 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-04 19:28:55 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-04 19:28:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-04 19:28:55 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-04 19:28:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-04 19:28:55 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-04 19:28:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-04 19:28:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-04 19:28:55 --> Severity: Notice --> Undefined variable: rel_id C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 639
ERROR - 2022-08-04 19:28:55 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 1655
ERROR - 2022-08-04 19:28:55 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 1669
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-04 22:23:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-04 22:23:34 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 5
ERROR - 2022-08-04 22:23:34 --> Severity: Warning --> A non-numeric value encountered C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 304
ERROR - 2022-08-04 22:23:34 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-04 22:23:34 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-04 22:23:34 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-04 22:23:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-04 22:23:34 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-04 22:23:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-08-04 22:23:34 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-04 22:23:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-08-04 22:23:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-04 22:23:34 --> Severity: Notice --> Undefined variable: rel_id C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 639
ERROR - 2022-08-04 22:23:34 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 1655
ERROR - 2022-08-04 22:23:34 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\purchase\payment_invoice.php 1669
