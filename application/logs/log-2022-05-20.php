<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:02:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:02:52 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-05-20 13:02:53 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:03:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:04:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:04:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:04:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:07:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:21 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 129
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:07:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 23
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 77
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 221
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined variable: customer_permissions C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined variable: tax_value C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1798
ERROR - 2022-05-20 13:07:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5586
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5588
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5698
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5708
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:28 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:07:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 23
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 77
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 221
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined variable: customer_permissions C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined variable: tax_value C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1798
ERROR - 2022-05-20 13:07:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5586
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5588
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5698
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5708
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:34 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:07:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:07:48 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 129
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:07:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:08:19 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 23
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 77
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 221
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined variable: customer_permissions C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined variable: tax_value C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1798
ERROR - 2022-05-20 13:08:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5586
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5588
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5698
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5708
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:19 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:08:25 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 23
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 77
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 221
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined variable: customer_permissions C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined variable: tax_value C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1798
ERROR - 2022-05-20 13:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5586
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5588
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5698
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5708
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:25 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:08:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:08:49 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 129
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:08:53 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:12:41 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:12:58 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:13:04 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:13:50 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:13:57 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:14:04 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:14:12 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:14:20 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:14:31 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:14:41 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:15:58 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:16:45 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 23
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 77
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 221
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined variable: customer_permissions C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined variable: tax_value C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1798
ERROR - 2022-05-20 13:16:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5586
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5588
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5698
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5708
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:45 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:16:50 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 17
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 23
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined variable: contactid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 77
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined variable: customer_id C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 221
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined variable: customer_permissions C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 295
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: compnybranch C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 733
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined variable: tax_value C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 1798
ERROR - 2022-05-20 13:16:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5586
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5588
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5698
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined property: stdClass::$rel_type C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 5708
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6074
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:16:51 --> Severity: Notice --> Undefined index: staffid C:\xampp\htdocs\crm\application\views\admin\estimates\perfoma_invoice.php 6164
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:17:02 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:17:02 --> Severity: Notice --> Undefined variable: estimate_amount C:\xampp\htdocs\crm\application\views\admin\estimates\list.php 129
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:17:03 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:18:06 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:18:06 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:22:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:22:20 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:22:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:23:01 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:23:08 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:23:37 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:23:53 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:25:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:25:27 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:25:46 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:25:50 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:26:07 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:30:29 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:32:25 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:35:00 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:36:20 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:37:12 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:37:30 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:37:34 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:37:38 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:37:54 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:38:04 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:38:30 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:38:44 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:38:52 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:41:08 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:41:27 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:41:32 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:41:37 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:41:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:47:59 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:48:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:48:45 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:50 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:48:50 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:48:50 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:48:50 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:48:50 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:48:50 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:48:50 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:48:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:48:50 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:48:50 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:48:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:48:50 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:48:51 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:48:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:48:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:48:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:48:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:48:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:48:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:48:51 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:48:51 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:48:51 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Stock For Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-05-20 13:48:56 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-20 13:49:08 --> Could not find the language line "Delivery trip assigned"
