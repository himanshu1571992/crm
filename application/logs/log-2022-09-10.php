<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-09-10 10:41:57 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 10:41:57 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 10:42:01 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-10 10:42:09 --> Query error: Table 'crm1.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-08-28' AND '2022-10-09') ELSE (duedate BETWEEN '2022-08-28' AND '2022-10-09') END
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:03:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 20:03:54 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-10 20:03:56 --> Query error: Table 'crm1.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-08-28' AND '2022-10-09') ELSE (duedate BETWEEN '2022-08-28' AND '2022-10-09') END
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 20:23:12 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 21:40:43 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 21:40:44 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-10 21:40:48 --> Query error: Table 'crm1.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-08-28' AND '2022-10-09') ELSE (duedate BETWEEN '2022-08-28' AND '2022-10-09') END
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:02:59 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:02:59 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-10 22:03:01 --> Query error: Table 'crm1.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-08-28' AND '2022-10-09') ELSE (duedate BETWEEN '2022-08-28' AND '2022-10-09') END
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:03:37 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:04:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:09:03 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:10:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:51 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:11:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:02 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:06 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:11 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:25 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:12:43 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:13:57 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:09 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:16 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_year B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 22
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_type B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 22
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_year B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 22
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_type B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 22
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Notice --> Undefined variable: s_client_id B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:16 --> Severity: Warning --> in_array() expects parameter 2 to be array, null given B:\xampp\htdocs\crm\application\views\admin\report\client_payment_report.php 93
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:14:28 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:16 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:26 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:15:32 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:28 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "expense_purpose"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:16:51 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:17:03 --> Severity: Notice --> Undefined offset: 5 B:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-09-10 22:17:03 --> Severity: Notice --> Undefined offset: 6 B:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:25 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:17:30 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:01 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:18:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:27:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:28:55 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:32 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:40 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-10 22:36:47 --> Could not find the language line "Stock approve Successfully"
