<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-10 10:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:02:52 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-10 10:02:53 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-10 10:21:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:09 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 115
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-10 10:21:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 20
ERROR - 2022-08-10 10:21:13 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 113
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-10 10:21:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:18 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 20
ERROR - 2022-08-10 10:21:18 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 113
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-10 10:21:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:22 --> Severity: Notice --> Undefined property: stdClass::$show_shipping_on_invoice C:\xampp\htdocs\crm\application\views\admin\invoices\billing_and_shipping_template.php 34
ERROR - 2022-08-10 10:21:22 --> Severity: Notice --> Undefined variable: label C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 772
ERROR - 2022-08-10 10:21:22 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2651
ERROR - 2022-08-10 10:21:22 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2652
ERROR - 2022-08-10 10:21:22 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2706
ERROR - 2022-08-10 10:21:22 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2710
ERROR - 2022-08-10 10:21:23 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 651
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-10 10:21:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:21:55 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-10 10:21:56 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-10 10:22:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-10 10:23:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-10 10:25:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 3 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 167
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 19 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 256 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 256 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 22 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 21 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 30 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 180 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 180 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 41 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 252 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 252 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 1 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 167
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 14 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 238 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 238 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 27 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 181 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 181 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 37 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 129 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 129 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 177 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 177 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 138 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 138 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 198 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 198 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 270 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 270 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 9 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 44 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 44 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 36 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 190 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 190 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 38 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 193 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 193 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 40 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 5 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 182 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 182 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 13 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 23 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 23 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 23 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 34 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 31 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 18 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:25:40 --> Severity: Notice --> Undefined offset: 6 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-10 10:31:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 3 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 167
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 30 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 180 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 180 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 1 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 167
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 37 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 129 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 129 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 177 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 177 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 41 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 270 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 270 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 9 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 44 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 44 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 13 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 23 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 179
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 23 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 180
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 27 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 5 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 6 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 36 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 31 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
ERROR - 2022-08-10 10:32:03 --> Severity: Notice --> Undefined offset: 40 C:\xampp\htdocs\crm\application\views\admin\production_department\production_chart_report.php 173
