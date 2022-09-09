<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 10:20:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 10:20:59 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-05-09 10:21:00 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-05-01' AND '2022-06-12') ELSE (duedate BETWEEN '2022-05-01' AND '2022-06-12') END
ERROR - 2022-05-09 12:19:42 --> Query error: Table 'crm.tblpredefinedreplies' doesn't exist - Invalid query: SELECT *
FROM `tblpredefinedreplies`
ERROR - 2022-05-09 12:23:14 --> Query error: Table 'crm.tblknowledgebase' doesn't exist - Invalid query: SELECT `slug`, `articleid`, `articlegroup`, `subject`, `tblknowledgebase`.`description`, `tblknowledgebase`.`active` as `active_article`, `tblknowledgebasegroups`.`active` as `active_group`, `name` as `group_name`, `staff_article`
FROM `tblknowledgebase`
LEFT JOIN `tblknowledgebasegroups` ON `tblknowledgebasegroups`.`groupid` = `tblknowledgebase`.`articlegroup`
ORDER BY `article_order` ASC
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 12:24:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:24:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tickets\add.php 116
ERROR - 2022-05-09 12:24:09 --> Query error: Table 'crm.tblknowledgebasegroups' doesn't exist - Invalid query: SELECT *
FROM `tblknowledgebasegroups`
WHERE `active` = 1
ORDER BY `group_order` ASC
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 12:29:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:29:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tickets\add.php 116
ERROR - 2022-05-09 12:29:09 --> Query error: Table 'crm.tblknowledgebasegroups' doesn't exist - Invalid query: SELECT *
FROM `tblknowledgebasegroups`
WHERE `active` = 1
ORDER BY `group_order` ASC
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 12:30:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 12:30:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tickets\add.php 116
ERROR - 2022-05-09 12:30:34 --> Query error: Table 'crm.tblknowledgebasegroups' doesn't exist - Invalid query: SELECT *
FROM `tblknowledgebasegroups`
WHERE `active` = 1
ORDER BY `group_order` ASC
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 13:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:37 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tickets\add.php 116
ERROR - 2022-05-09 13:42:37 --> Query error: Table 'crm.tblknowledgebasegroups' doesn't exist - Invalid query: SELECT *
FROM `tblknowledgebasegroups`
WHERE `active` = 1
ORDER BY `group_order` ASC
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 13:42:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:42:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tickets\add.php 116
ERROR - 2022-05-09 13:42:54 --> Query error: Table 'crm.tblknowledgebasegroups' doesn't exist - Invalid query: SELECT *
FROM `tblknowledgebasegroups`
WHERE `active` = 1
ORDER BY `group_order` ASC
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 13:44:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:44:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tickets\add.php 116
ERROR - 2022-05-09 13:44:55 --> Query error: Table 'crm.tblknowledgebasegroups' doesn't exist - Invalid query: SELECT *
FROM `tblknowledgebasegroups`
WHERE `active` = 1
ORDER BY `group_order` ASC
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-09 13:45:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-09 13:45:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tickets\add.php 116
ERROR - 2022-05-09 13:45:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\database_helper.php 691
ERROR - 2022-05-09 13:45:15 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\helpers\database_helper.php 712
ERROR - 2022-05-09 13:45:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tickets\add.php 124
