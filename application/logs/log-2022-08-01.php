<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-01 08:50:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:20 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-01 08:50:21 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-01 08:50:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:26 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 129
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-01 08:50:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 08:50:36 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 129
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-01 09:17:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 09:17:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 20
ERROR - 2022-08-01 09:17:08 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 113
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-01 14:33:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-01 14:34:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-01 15:39:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-01 18:43:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-01 18:43:07 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-01 18:43:08 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
