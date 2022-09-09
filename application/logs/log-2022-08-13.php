<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 10:07:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:07:46 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-13 10:07:47 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 10:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:09:44 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 10:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:19 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-13 10:10:20 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 10:10:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:10:47 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 10:11:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:08 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-13 10:11:09 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 10:11:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 10:11:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 10:11:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 10:12:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 10:14:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 10:14:24 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-13 10:14:25 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 11:11:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 24
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 24
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 11:11:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 11:11:48 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:48 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:48 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:48 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:48 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:48 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:48 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:48 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 11:11:48 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 18:35:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 24
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: warehouse_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 24
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:33 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 18:35:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: division_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 42
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:39 --> Severity: Notice --> Undefined variable: pro_category_id C:\xampp\htdocs\crm\application\views\admin\store_report\live_stock_report.php 70
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-13 18:35:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-13 18:35:59 --> Severity: Notice --> Undefined offset: 10 C:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
