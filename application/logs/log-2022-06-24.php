<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 11:37:30 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 11:37:30 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-06-24 11:37:31 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-05-29' AND '2022-07-10') ELSE (duedate BETWEEN '2022-05-29' AND '2022-07-10') END
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 11:37:49 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:14:01 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 12:14:01 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 129
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:14:07 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 23
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 77
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 221
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined variable: customer_permissions C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:07 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined variable: tax_value C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1800
ERROR - 2022-06-24 12:14:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5588
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5590
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5700
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5710
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-06-24 12:14:08 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-06-24 12:14:09 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 651
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:14:09 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 12:14:09 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 129
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:14:22 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:16:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 12:16:25 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 129
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:16:28 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:16:46 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 23
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 77
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 221
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined variable: customer_permissions C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined variable: tax_value C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1800
ERROR - 2022-06-24 12:16:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5588
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5590
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5700
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5710
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6076
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-06-24 12:16:47 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6166
ERROR - 2022-06-24 12:16:48 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 651
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:16:50 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 12:16:51 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 129
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:17:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:17:31 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 12:17:32 --> Severity: Notice --> Undefined variable: implodequery C:\xampp\htdocs\crm\application\views\admin\estimates\edit_proforma_challan.php 314
ERROR - 2022-06-24 12:17:32 --> Severity: Notice --> Undefined variable: service_type C:\xampp\htdocs\crm\application\views\admin\estimates\edit_proforma_challan.php 315
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:17:42 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 12:17:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 15:51:46 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 15:51:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 15:51:49 --> Severity: Notice --> Undefined variable: payment_info C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 152
ERROR - 2022-06-24 15:51:49 --> Severity: Notice --> Trying to get property 'category_id' of non-object C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 152
ERROR - 2022-06-24 15:51:49 --> Severity: Notice --> Undefined variable: payment_info C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 169
ERROR - 2022-06-24 15:51:49 --> Severity: Notice --> Trying to get property 'head_id' of non-object C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 169
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 15:51:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 15:52:01 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 15:52:07 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 15:52:07 --> Severity: Notice --> Undefined variable: payment_info C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 152
ERROR - 2022-06-24 15:52:07 --> Severity: Notice --> Trying to get property 'category_id' of non-object C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 152
ERROR - 2022-06-24 15:52:07 --> Severity: Notice --> Undefined variable: payment_info C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 169
ERROR - 2022-06-24 15:52:07 --> Severity: Notice --> Trying to get property 'head_id' of non-object C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 169
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 20:46:12 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 20:46:13 --> Severity: Notice --> Undefined variable: payment_info C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 152
ERROR - 2022-06-24 20:46:13 --> Severity: Notice --> Trying to get property 'category_id' of non-object C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 152
ERROR - 2022-06-24 20:46:13 --> Severity: Notice --> Undefined variable: payment_info C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 169
ERROR - 2022-06-24 20:46:13 --> Severity: Notice --> Trying to get property 'head_id' of non-object C:\xampp\htdocs\crm\application\views\admin\company_expense\add_paymentrequest.php 169
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 20:47:04 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 20:47:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 20:47:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-06-24 20:47:24 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Stock For Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Stock For Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Trip assigned"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-06-24 20:47:57 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Stock For Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Stock For Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Trip assigned"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-06-24 20:48:02 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Stock For Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Stock For Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Trip assigned"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-06-24 20:48:06 --> Could not find the language line "Performance Invoice Send to you for Approval"
