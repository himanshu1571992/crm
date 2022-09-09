<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:12:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:16 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-05-13 10:12:18 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:12:29 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:12:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:12:31 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 5
ERROR - 2022-05-13 10:12:31 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-05-13 10:12:31 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-05-13 10:12:31 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-05-13 10:12:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-05-13 10:12:31 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-05-13 10:12:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-05-13 10:12:31 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-05-13 10:12:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-05-13 10:12:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-05-13 10:12:31 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 3513
ERROR - 2022-05-13 10:12:31 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 3527
ERROR - 2022-05-13 10:12:32 --> Severity: Notice --> Undefined index: state_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 180
ERROR - 2022-05-13 10:12:32 --> Severity: Notice --> Undefined index: city_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 181
ERROR - 2022-05-13 10:12:32 --> Severity: Notice --> Undefined index: name C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 10:12:32 --> Severity: Notice --> Undefined index: location C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 10:12:32 --> Severity: Notice --> Undefined index: address C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 10:12:32 --> Severity: Notice --> Undefined index: description C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 10:12:32 --> Severity: Notice --> Undefined index: state_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 10:12:32 --> Severity: Notice --> Undefined index: city_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 10:12:32 --> Severity: Notice --> Undefined index: landmark C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 10:12:32 --> Severity: Notice --> Undefined index: pincode C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 10:12:36 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 651
ERROR - 2022-05-13 10:15:00 --> Query error: Unknown column 'sac_hsn' in 'field list' - Invalid query: INSERT INTO `tbldebitnote` (`staff_id`, `branch_id`, `clientid`, `site_id`, `challan_id`, `challan_number`, `invoice_id`, `billing_street`, `billing_city`, `billing_state`, `billing_zip`, `shipping_street`, `shipping_city`, `shipping_state`, `shipping_zip`, `dabit_note_date`, `delivery_pickup_date`, `debit_note_for`, `debit_note_type`, `qty_hours`, `number`, `sac_hsn`, `dn_number`, `year_id`, `other_charges_tax`, `adminnote`, `terms_and_conditions`, `note`, `finalsubtotalamount`, `finaldiscountpercentage`, `finaldiscountamount`, `totalamount`, `tax_type`, `status`, `created_date`) VALUES ('1', '1', '91', '9', 0, 'CHA123', '91', '106, GROUND FLOOR, \"B\" WING,EXPRESS ZONE MALL, , W.E. HIGHWAY,, MALAD (E)', 'Mumbai', 'Maharashtra', ' 400 097 ', ' C/O. Citibank NA FIFC,Plot No. C-54 and C-55,Mumbai- 400051.', 'Mumbai', 'Maharashtra', '400051', '2022-05-13', '2022-05-13', '2', '1', '2', '4001/D/22-23', '1', '4001', '7', '2', 'test', '1)Debit note T&amp;C', '', '261', '', '0', '261', '1', 1, '2022-05-13')
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:28:17 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:28:32 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:32 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 5
ERROR - 2022-05-13 10:28:32 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-05-13 10:28:32 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-05-13 10:28:32 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-05-13 10:28:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-05-13 10:28:32 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-05-13 10:28:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-05-13 10:28:32 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-05-13 10:28:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-05-13 10:28:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-05-13 10:28:32 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 3513
ERROR - 2022-05-13 10:28:32 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 3527
ERROR - 2022-05-13 10:28:33 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 651
ERROR - 2022-05-13 10:28:33 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 651
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:28:38 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:30:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:30:22 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:30:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:30:35 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:33:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:34:10 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:34:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 10:34:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 11:19:09 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 11:19:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:47 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 5
ERROR - 2022-05-13 11:19:47 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-05-13 11:19:47 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-05-13 11:19:47 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-05-13 11:19:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-05-13 11:19:47 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-05-13 11:19:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-05-13 11:19:47 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-05-13 11:19:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-05-13 11:19:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-05-13 11:19:47 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 3512
ERROR - 2022-05-13 11:19:47 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 3526
ERROR - 2022-05-13 11:19:48 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 651
ERROR - 2022-05-13 11:19:48 --> Severity: Notice --> Trying to get property 'client_cat_id' of non-object C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 651
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 11:19:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 11:19:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:19:57 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 5
ERROR - 2022-05-13 11:19:57 --> Severity: Notice --> Undefined variable: base_currency C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-05-13 11:19:57 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 23
ERROR - 2022-05-13 11:19:57 --> Severity: Notice --> Undefined variable: currencies C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-05-13 11:19:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 27
ERROR - 2022-05-13 11:19:57 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-05-13 11:19:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 43
ERROR - 2022-05-13 11:19:57 --> Severity: Notice --> Undefined variable: taxes C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-05-13 11:19:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\views\admin\invoice_items\item.php 54
ERROR - 2022-05-13 11:19:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\crm\application\helpers\fields_helper.php 331
ERROR - 2022-05-13 11:19:57 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 3512
ERROR - 2022-05-13 11:19:57 --> Severity: Notice --> Undefined variable: clientsate C:\xampp\htdocs\crm\application\views\admin\debit_note\add.php 3526
ERROR - 2022-05-13 11:19:58 --> Severity: Notice --> Undefined index: state_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 180
ERROR - 2022-05-13 11:19:58 --> Severity: Notice --> Undefined index: city_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 181
ERROR - 2022-05-13 11:19:58 --> Severity: Notice --> Undefined index: name C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 11:19:58 --> Severity: Notice --> Undefined index: location C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 11:19:58 --> Severity: Notice --> Undefined index: address C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 11:19:58 --> Severity: Notice --> Undefined index: description C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 11:19:58 --> Severity: Notice --> Undefined index: state_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 11:19:58 --> Severity: Notice --> Undefined index: city_id C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 11:19:58 --> Severity: Notice --> Undefined index: landmark C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 11:19:58 --> Severity: Notice --> Undefined index: pincode C:\xampp\htdocs\crm\application\controllers\admin\Site_manager.php 182
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Leave Approve Successfully"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Trip assigned"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Challan Delivery Completed"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-05-13 11:24:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-05-13 11:24:14 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-05-13 11:24:15 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
