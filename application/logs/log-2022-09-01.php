<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:27:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-01 12:27:30 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-01 12:27:32 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-09-01 12:39:00 --> Query error: Unknown column 'staff_id' in 'field list' - Invalid query: SELECT staff_id,firstname FROM `tblstaff` WHERE active = 1 AND joining_date <= '2021-4-01' 
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:05 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-01 12:40:05 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-01 12:40:06 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-09-01 12:40:22 --> Severity: Warning --> file_get_contents(): SSL operation failed with code 1. OpenSSL Error messages:
error:1416F086:SSL routines:tls_process_server_certificate:certificate verify failed C:\xampp\htdocs\crm\application\controllers\admin\Salary_new.php 104
ERROR - 2022-09-01 12:40:22 --> Severity: Warning --> file_get_contents(): Failed to enable crypto C:\xampp\htdocs\crm\application\controllers\admin\Salary_new.php 104
ERROR - 2022-09-01 12:40:22 --> Severity: Warning --> file_get_contents(https://mustafa-pc/crm/Salary_cron/generate_salary?month=08&amp;year=2022): failed to open stream: operation failed C:\xampp\htdocs\crm\application\controllers\admin\Salary_new.php 104
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-01 12:40:22 --> Could not find the language line "Stock approve Successfully"
