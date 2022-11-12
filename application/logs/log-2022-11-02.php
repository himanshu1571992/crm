<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:13:51 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:13:52 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-11-02 10:13:54 --> Query error: Table 'crm.tblstafftasks' doesn't exist - Invalid query: SELECT name as title, id, (CASE rel_type
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
AND CASE WHEN duedate IS NULL THEN (startdate BETWEEN '2022-10-30' AND '2022-12-11') ELSE (duedate BETWEEN '2022-10-30' AND '2022-12-11') END
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:15:34 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:16:55 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:16:55 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:55 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:55 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:16:56 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:18:19 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:18:20 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:14 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:42 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:19:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:19:44 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:31 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-11-02 10:20:31 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\crm\application\views\admin\dashboard\widgets\user_data.php 51
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:42 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:50 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:20:56 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:15 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:33 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:39 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:21:44 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:41 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:22:45 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:48 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:30:51 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:30:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:07 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:07 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:31:30 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:33:39 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 10:34:13 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:35:27 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:36:00 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 13:39:08 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 18:31:31 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:44 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:09:50 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Undefined variable: complain_info C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:09:51 --> Severity: Notice --> Trying to get property 'client_id' of non-object C:\xampp\htdocs\crm\application\views\admin\complains\add.php 59
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:19 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:43 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:48 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:56 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:10:57 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:01 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:11 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:26 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:31 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Delivery challan allotted to you assign"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Petty Cash department (Factory Pettycash) alloted to you"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "New Task Alloted to you"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Petty Cash Request Send to you for Approval"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Stock For Approval"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Trip assigned"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Leave Request Send to you for Approval"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Request Send to you for Approval"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Challan Hand-Over for Accept"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Delivery trip assigned"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:47 --> Could not find the language line "Challan Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:11:52 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:21 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:25 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:12:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:16 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:14:53 --> Could not find the language line "Stock approve Successfully"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Request Approved Successfully"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Employee Confimed as a Petty Cash department Manger"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Proforma Invoice Send to you for Approval"
ERROR - 2022-11-02 19:15:03 --> Could not find the language line "Stock approve Successfully"
