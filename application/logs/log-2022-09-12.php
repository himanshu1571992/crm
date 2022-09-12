<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-09-12 10:06:45 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:06:45 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:06:47 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-12 10:06:58 --> Query error: Table 'crm1.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:12:46 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:16:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:16:29 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:16:29 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1570
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1577
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1636
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined variable: product_code B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1636
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1655
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined variable: product_code B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1655
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:29 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1734
ERROR - 2022-09-12 10:16:30 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:18:23 --> Severity: Notice --> Undefined index: othercharges B:\xampp\htdocs\crm\application\models\Purchase_model.php 37
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:19:05 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:20:14 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:20:15 --> Severity: Notice --> Undefined variable: purchase_othercharges B:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1118
ERROR - 2022-09-12 10:20:15 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable B:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1118
ERROR - 2022-09-12 10:20:15 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:20:15 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:20:15 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:20:15 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:20:15 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:20:48 --> Severity: Notice --> Undefined variable: html B:\xampp\htdocs\crm\application\controllers\admin\Purchase.php 2859
ERROR - 2022-09-12 10:21:17 --> Severity: Notice --> Undefined index: hsn_code B:\xampp\htdocs\crm\application\controllers\admin\Purchase.php 3005
ERROR - 2022-09-12 10:22:27 --> Severity: Notice --> Undefined index: othercharges B:\xampp\htdocs\crm\application\models\Purchase_model.php 37
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:22:35 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:23:27 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 10:23:28 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:23:39 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Undefined variable: customer_id B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Undefined variable: contactid B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Undefined variable: customer_id B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Undefined variable: staff B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 339
ERROR - 2022-09-12 10:23:39 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 339
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Undefined variable: staff B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 346
ERROR - 2022-09-12 10:23:39 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:23:39 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Undefined variable: taxes B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-09-12 10:23:39 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Undefined variable: taxes B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-09-12 10:23:39 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-09-12 10:23:39 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1186
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1193
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1285
ERROR - 2022-09-12 10:23:39 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1292
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:07 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:14 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:26 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Undefined variable: customer_id B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Undefined variable: contactid B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 8
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Undefined variable: customer_id B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 14
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Undefined variable: staff B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 339
ERROR - 2022-09-12 10:24:27 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 339
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Undefined variable: staff B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 346
ERROR - 2022-09-12 10:24:27 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Trying to get property 'field_value' of non-object B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 521
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:24:27 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Undefined variable: taxes B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-09-12 10:24:27 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Undefined variable: taxes B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-09-12 10:24:27 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-09-12 10:24:27 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1186
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1193
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1285
ERROR - 2022-09-12 10:24:27 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\details.php 1292
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 10:24:55 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:25:20 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:25:21 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:25:21 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1570
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1577
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1636
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined variable: product_code B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1636
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1655
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined variable: product_code B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1655
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1734
ERROR - 2022-09-12 10:25:21 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:31:58 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:31:59 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:31:59 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1577
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1636
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined variable: product_code B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1636
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1655
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined variable: product_code B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1655
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1734
ERROR - 2022-09-12 10:31:59 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:36:19 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:36:19 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:36:19 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1636
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined variable: product_code B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1636
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1655
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined variable: product_code B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1655
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:19 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1734
ERROR - 2022-09-12 10:36:20 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:04 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:37:05 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:37:05 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined variable: product_code B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1636
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1655
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined variable: product_code B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1655
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1734
ERROR - 2022-09-12 10:37:05 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:37:43 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:37:44 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:37:44 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1655
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined variable: product_code B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1655
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1734
ERROR - 2022-09-12 10:37:44 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:38:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:38:23 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:38:23 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:23 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:24 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:24 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:24 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:24 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:24 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:24 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:24 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:24 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:24 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1682
ERROR - 2022-09-12 10:38:24 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:38:24 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1734
ERROR - 2022-09-12 10:38:24 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:39:03 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:39:04 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:39:04 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined index: is_temp B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1734
ERROR - 2022-09-12 10:39:04 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:41:39 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:41:40 --> Severity: Notice --> Undefined variable: purchase_othercharges B:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1118
ERROR - 2022-09-12 10:41:40 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable B:\xampp\htdocs\crm\application\views\admin\purchase\purchase_order.php 1118
ERROR - 2022-09-12 10:41:40 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:41:40 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:41:40 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:41:40 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:41:40 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:40 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:42:40 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:42:40 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:40 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1734
ERROR - 2022-09-12 10:42:41 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:42:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:42:45 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:42:45 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1602
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1611
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:45 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:42:46 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1734
ERROR - 2022-09-12 10:42:46 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:43:45 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:43:46 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:43:46 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1687
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1734
ERROR - 2022-09-12 10:43:46 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:44:37 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:44:37 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:44:37 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined index: sub_name B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1704
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1734
ERROR - 2022-09-12 10:44:37 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:45:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:45:55 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:45:55 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:45:55 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:45:55 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:45:55 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:45:55 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:45:55 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:45:55 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1734
ERROR - 2022-09-12 10:45:55 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:46:28 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:46:28 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:46:28 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:46:28 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:46:28 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:46:28 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:46:28 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:46:28 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:46:28 --> Severity: Notice --> Undefined variable: clientsate B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 1741
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:47:17 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:47:17 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:47:17 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:47:18 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:47:18 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:47:18 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:47:18 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:47:18 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:06 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:49:06 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:49:06 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:49:06 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:49:06 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:49:06 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:49:06 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:49:06 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:49:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:49:08 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:49:08 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:49:08 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:49:08 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:49:08 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:49:08 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:49:08 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:50:16 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:50:16 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:50:16 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:50:16 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:50:16 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:50:16 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:50:16 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 10:50:45 --> Severity: Notice --> Undefined index: othercharges B:\xampp\htdocs\crm\application\models\Purchase_model.php 37
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:50:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 10:51:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 10:51:08 --> Severity: Notice --> Undefined variable: mm B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 363
ERROR - 2022-09-12 10:51:08 --> Severity: Notice --> Undefined variable: yyyy B:\xampp\htdocs\crm\application\views\admin\purchase\purchaseorder_renewal.php 365
ERROR - 2022-09-12 10:51:08 --> Severity: Notice --> Undefined variable: base_currency B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:51:08 --> Severity: Notice --> Trying to get property 'name' of non-object B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-09-12 10:51:08 --> Severity: Notice --> Undefined variable: currencies B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:51:08 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-09-12 10:51:08 --> Severity: Warning --> Invalid argument supplied for foreach() B:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-09-12 12:35:03 --> Severity: Notice --> Undefined property: mysqli::$userid B:\xampp\htdocs\crm\application\controllers\Test_API.php 180
ERROR - 2022-09-12 12:35:03 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'GROUP BY userid,phonenumber,contact_type HAVING COUNT(userid) > 1 AND COUNT(p...' at line 1 - Invalid query: SELECT GROUP_CONCAT(id) as ids, count(*) as ttl_count FROM `tblcontacts` WHERE `userid` =  GROUP BY userid,phonenumber,contact_type HAVING COUNT(userid) > 1 AND COUNT(phonenumber) > 1 AND COUNT(contact_type) > 1
ERROR - 2022-09-12 12:36:19 --> Severity: Notice --> Undefined property: mysqli::$userid B:\xampp\htdocs\crm\application\controllers\Test_API.php 180
ERROR - 2022-09-12 12:36:19 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'GROUP BY userid,phonenumber,contact_type HAVING COUNT(userid) > 1 AND COUNT(p...' at line 1 - Invalid query: SELECT GROUP_CONCAT(id) as ids, count(*) as ttl_count FROM `tblcontacts` WHERE `userid` =  GROUP BY userid,phonenumber,contact_type HAVING COUNT(userid) > 1 AND COUNT(phonenumber) > 1 AND COUNT(contact_type) > 1
ERROR - 2022-09-12 13:38:09 --> Severity: Notice --> Undefined property: stdClass::$contact_type B:\xampp\htdocs\crm\application\controllers\Test_API.php 186
ERROR - 2022-09-12 13:38:10 --> Severity: Notice --> Undefined property: stdClass::$contact_type B:\xampp\htdocs\crm\application\controllers\Test_API.php 186
ERROR - 2022-09-12 13:48:17 --> Severity: Notice --> Undefined property: stdClass::$contact_type B:\xampp\htdocs\crm\application\controllers\Test_API.php 185
ERROR - 2022-09-12 13:48:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT `id` FROM `tblcontacts` WHERE `userid` = 12 AND `phonenumber` = 9819107444 AND `contact_type` = 
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:01:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:01:55 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-12 14:01:59 --> Query error: Table 'crm1.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:03:26 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:06:56 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:07:26 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:10:24 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:10:31 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:10:51 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:15:25 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:15:53 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:16:20 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:16:51 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:16:52 --> Severity: Notice --> Undefined property: App::$db B:\xampp\htdocs\crm\application\views\admin\tables\staff.php 46
ERROR - 2022-09-12 14:16:52 --> Severity: error --> Exception: Call to a member function last_query() on null B:\xampp\htdocs\crm\application\views\admin\tables\staff.php 46
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:17:26 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:17:28 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\views\admin\tables\staff.php 46
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:18:07 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:19:03 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:20:16 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:21:18 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:21:51 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:22:00 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:22:46 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:23:40 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:23:53 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:29:36 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:29:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:36 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:29:36 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:29:36 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:36 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:29:36 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:29:36 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:29:36 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:29:36 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:29:47 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:29:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:29:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:29:47 --> Could not find the language line "Performance Invoice Send to you for Approval"
ERROR - 2022-09-12 14:29:47 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:29:47 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:29:47 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:29:47 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:29:47 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:30:10 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:30:22 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Proposal Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:30:51 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:30:52 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Proposal Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:31:07 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:28 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:41:28 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-12 14:41:30 --> Query error: Table 'crm1.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:36 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:41:54 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:41:55 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-12 14:41:57 --> Query error: Table 'crm1.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:03 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Proposal Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:42:29 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:42:30 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Proposal Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "New Lead Assigned"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:42:37 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:26 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:48:26 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-09-12 14:48:28 --> Query error: Table 'crm1.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 14:48:41 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 14:48:43 --> Severity: Notice --> Undefined offset: 10 B:\xampp\htdocs\crm\application\helpers\datatables_helper.php 132
ERROR - 2022-09-12 18:50:55 --> Severity: Notice --> Array to string conversion B:\xampp\htdocs\crm\application\helpers\developer_helper.php 3899
ERROR - 2022-09-12 18:50:55 --> Query error: Table 'crm1.tbltask' doesn't exist - Invalid query: select * from tbltask where id = Array
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:04 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:52:24 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:45 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:57:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 18:58:39 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:01:23 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 19:03:12 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:03:13 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:08:55 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:09:20 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:09:43 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:10:41 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:10:46 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:11:41 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:13:40 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:04 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:11 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:23 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:37 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:15:47 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:16:00 --> Could not find the language line "Delivery challan assigned"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Stock For Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Trip assigned"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-09-12 19:16:06 --> Could not find the language line "Delivery challan assigned"
