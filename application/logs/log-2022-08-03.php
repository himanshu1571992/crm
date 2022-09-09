<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 08:34:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:06 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-08-03 08:34:07 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 08:34:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 08:39:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 09:33:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:14 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 115
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 09:33:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 23
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 77
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 221
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined variable: customer_permissions C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined variable: tax_value C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1800
ERROR - 2022-08-03 09:33:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5588
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5590
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5700
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5710
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-08-03 09:33:36 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 16:08:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 16:08:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:52 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 115
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 16:08:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:08:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 20
ERROR - 2022-08-03 16:08:58 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 113
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 16:09:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:09:04 --> Severity: Notice --> Undefined property: stdClass::$show_shipping_on_invoice C:\xampp\htdocs\crm\application\views\admin\invoices\billing_and_shipping_template.php 34
ERROR - 2022-08-03 16:09:04 --> Severity: Notice --> Undefined variable: label C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 772
ERROR - 2022-08-03 16:09:04 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2651
ERROR - 2022-08-03 16:09:04 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2652
ERROR - 2022-08-03 16:09:04 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2706
ERROR - 2022-08-03 16:09:04 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2710
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 16:12:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:38 --> Severity: Notice --> Undefined property: stdClass::$show_shipping_on_invoice C:\xampp\htdocs\crm\application\views\admin\invoices\billing_and_shipping_template.php 34
ERROR - 2022-08-03 16:12:38 --> Severity: Notice --> Undefined variable: label C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 772
ERROR - 2022-08-03 16:12:38 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2651
ERROR - 2022-08-03 16:12:38 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2652
ERROR - 2022-08-03 16:12:38 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2706
ERROR - 2022-08-03 16:12:38 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2710
ERROR - 2022-08-03 16:12:45 --> Severity: Notice --> Undefined variable: otherchargeamt C:\xampp\htdocs\crm\application\models\Invoices_model.php 515
ERROR - 2022-08-03 16:12:45 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 515
ERROR - 2022-08-03 16:12:45 --> Severity: Notice --> Undefined variable: otherchargesaleamt C:\xampp\htdocs\crm\application\models\Invoices_model.php 516
ERROR - 2022-08-03 16:12:45 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 516
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 16:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 16:13:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:37 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 20
ERROR - 2022-08-03 16:13:37 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 113
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 16:13:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:42 --> Severity: Notice --> Undefined property: stdClass::$show_shipping_on_invoice C:\xampp\htdocs\crm\application\views\admin\invoices\billing_and_shipping_template.php 34
ERROR - 2022-08-03 16:13:42 --> Severity: Notice --> Undefined variable: label C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 772
ERROR - 2022-08-03 16:13:42 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2651
ERROR - 2022-08-03 16:13:42 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2652
ERROR - 2022-08-03 16:13:42 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2706
ERROR - 2022-08-03 16:13:42 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\invoices_new.php 2710
ERROR - 2022-08-03 16:13:43 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 651
ERROR - 2022-08-03 16:13:55 --> Severity: Notice --> Undefined variable: otherchargeamt C:\xampp\htdocs\crm\application\models\Invoices_model.php 515
ERROR - 2022-08-03 16:13:55 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 515
ERROR - 2022-08-03 16:13:55 --> Severity: Notice --> Undefined variable: otherchargesaleamt C:\xampp\htdocs\crm\application\models\Invoices_model.php 516
ERROR - 2022-08-03 16:13:55 --> Severity: Warning --> array_sum() expects parameter 1 to be array, null given C:\xampp\htdocs\crm\application\models\Invoices_model.php 516
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 16:13:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 17:05:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 17:25:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 17:25:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 17:26:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 17:57:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:38 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 17:57:38 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 17:57:38 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 17:57:38 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 17:57:38 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 17:57:38 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 17:57:38 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 17:57:38 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 17:57:38 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 17:57:38 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 17:57:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 17:57:41 --> Severity: Notice --> Undefined variable: purchase_othercharges C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1114
ERROR - 2022-08-03 17:57:41 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1114
ERROR - 2022-08-03 17:57:41 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-03 17:57:41 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-08-03 17:57:41 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-03 17:57:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-08-03 17:57:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 18:00:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 18:01:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 18:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 18:02:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 18:02:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 18:03:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 18:07:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:16 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 18:07:16 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 18:07:16 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 18:07:16 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 18:07:16 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 18:07:16 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 18:07:16 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 18:07:16 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 18:07:16 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 18:07:16 --> Severity: Warning --> Use of undefined constant vv - assumed 'vv' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\crm\application\views\admin\purchase\view.php 373
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 18:07:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 18:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 18:16:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:36 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 115
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 18:16:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:42 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 20
ERROR - 2022-08-03 18:16:42 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\crm\application\views\admin\tasks\tasks_filter_by.php 113
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 18:16:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-08-03 18:20:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
